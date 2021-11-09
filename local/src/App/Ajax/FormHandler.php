<?php

namespace InfoSystems\App\Ajax;

use Bitrix\Main\Application;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\COption;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Loader;
use Bitrix\Sale\Fuser;
use InfoSystems\Crm\CrmManager;
use InfoSystems\Tools\IblockTools;
use InfoSystems\Forms\FormsManager;

/**
 * Class FormHandler
 * @package InfoSystems\App\Ajax
 */
class FormHandler extends AbstractRequestHandler
{
    /**
     * FormHandler constructor.
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;

        $this->includeModules();
    }

    /**
     * @return bool
     */
    public function includeModules(): bool
    {
        return
            Loader::includeModule('form') &&
            Loader::includeModule('iblock') &&
            Loader::includeModule('catalog') &&
            Loader::includeModule('sale');
    }

    /**
     * @param int $productId
     *
     * Description fields CRM:
     *      ContactLastName - Фамилия
     *      ContactName - Имя
     *      ContactSecondName - Отчество
     *      ContactPost - Должность
     *      ContactEmail - E-mail
     *      ContactPhone - Телефон
     *      Assigned - Ответственный
     *      UfCrm1625043753232 - Материалы для обучения (Файлы)
     *      UfCrm1551186755 - Дата начала курса
     *      ProductsProductPropertyDuration - Продолжительность курса
     *      Формат обучения
     *      ProductsProductPropertyProgEvent - Программа курса
     *      Сертификат/Диплом/Свидетельство об обучении
     *      Статус оплаты (статус сделки)
     *      UfCrm1548175238 - Договор
     *      ProductsProduct - Товар
     *
     */
    public function sendOrder(int $productId): void
    {
        $response = new Response();

        try {
            if (!$this->request->isAjaxRequest()) {
                throw new \Bitrix\Main\SystemException('Некорректный запрос');
            }

            $data = $this->request->getPostList()->toArray();

            if (!$formId = $data['WEB_FORM_ID']) {
                throw new \Bitrix\Main\SystemException('Не указан идентификатор формы');
            }

            /**
             * Проверка полей формы
             */
            FormsManager::checkForm($formId, $data);

            /**
             * Добавление результата формы
             */
            $resultId = FormsManager::resultAdd($formId, $data);

            if (!$resultId) {
                throw new \Bitrix\Main\SystemException('Ошибка добавления результата формы');
            }

            /**
             * Получаем данные о продукте
             */
            $product = IblockTools::getElement($productId);

            /**
             * Получаем список ответов
             */
            $resultAnswers = FormsManager::getResultAnswer($formId, $resultId);

            /**
             * Устанавливаем значение поля результата
             */
            \CFormResult::SetField($resultId, 'product', [
                $resultAnswers['product']['ANSWER_ID'] => $product['NAME']
            ]);

            $email = $resultAnswers['email']['USER_TEXT'];
            $cUser = \Bitrix\Main\UserTable::getList([
                'select' => ['ID'],
                'filter' => [
                    'LOGIC' => 'OR',
                    ['=EMAIL' => $email],
                    ['=LOGIN' => $email]
                ]
            ])->fetch();
            if ($cUser) {
                $userId = $cUser['ID'];
            }

            global $USER;
            if (!$USER->IsAuthorized() && !$cUser) {
                $firstName = $resultAnswers['first_name']['USER_TEXT'];
                $lastName = $resultAnswers['last_name']['USER_TEXT'];
                $secondName = $resultAnswers['second_name']['USER_TEXT'];

                $email = $resultAnswers['email']['USER_TEXT'];
                $name = $firstName . ($lastName ? (' ' . $secondName) : '');
                $password = randString(7);

                $USER->Register($email, $name, null, $password, $password, $email);
                \Bitrix\Main\Diag\Debug::writeToFile([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'user' => $USER->GetID()
                ], __METHOD__.':'.__LINE__);
                if ($userId = $USER->GetID()) {
                    $user_fields_add = ['PERSONAL_PHONE'=>$resultAnswers['phone']['USER_TEXT']];
                    $USER->Update($USER->GetID(), $user_fields_add);
                }
            }


            /**
             * Получаем цену товара
             */
            $price = \Bitrix\Catalog\Model\Price::getList([
                'filter' => ['PRODUCT_ID' => $productId ],
                'limit' => 1
            ])->fetch();

            /**
             * Формирование корзины
             */
            $basket = \Bitrix\Sale\Basket::create(\Bitrix\Main\Application::getInstance()->getContext()->getSite());
            $item = $basket->createItem('catalog', $productId);
            $item->setFields([
                'QUANTITY' => 1,
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                'PRODUCT_PROVIDER_CLASS' => '\Bitrix\Catalog\Product\CatalogProvider',
                'PRICE' => round($price['PRICE']),
                'NAME'  => $product['NAME'],
                'DETAIL_PAGE_URL' => $product['DETAIL_PAGE_URL']
            ]);

            /**
             * Формирование заказа
             */
            global $USER;
            $order = \Bitrix\Sale\Order::create(
                \Bitrix\Main\Application::getInstance()->getContext()->getSite(),
                $userId ? $userId:\Bitrix\Sale\Fuser::getId(),
                \Bitrix\Currency\CurrencyManager::getBaseCurrency()
            );
            $order->setPersonTypeId(1);
            $order->setBasket($basket);

            $order->setField('USER_DESCRIPTION', $resultAnswers['comment']['USER_TEXT']);

            /**
             * Установка отгрузки
             */
            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem(
                \Bitrix\Sale\Delivery\Services\Manager::getObjectById(1)
            );

            /**
             * Установка оплаты
             */
            $paymentCollection = $order->getPaymentCollection();
            $payment = $paymentCollection->createItem(
                \Bitrix\Sale\PaySystem\Manager::getObjectById(3)
            );
            $payment->setField('SUM', $order->getPrice());
            $payment->setField('CURRENCY', $order->getCurrency());

            /**
             * Сохранение заказа
             */
            $result = $order->save();

            if (!$result->isSuccess()) {
                throw new \Bitrix\Main\SystemException(implode('<br/> ', $result->getErrors()));
            }

            /**
             * Создание контакта
             */
            $email = $resultAnswers['email']['USER_TEXT'];
            $phone = $resultAnswers['phone']['USER_TEXT'];
            $contacts = null;
            if ($email) {
                $contacts = CrmManager::getContactsByEmail($email);
            }

            if ($phone && !is_array($contacts)) {
                $contacts = CrmManager::getContactsByPhone($phone);
            }

            if (!is_array($contacts)) {
                $lastName = $resultAnswers['last_name']['USER_TEXT'];
                $firstName = $resultAnswers['first_name']['USER_TEXT'];
                $secondName = $resultAnswers['second_name']['USER_TEXT'];

                $contacts = CrmManager::createContact([
                    'NAME' => $firstName,
                    'LAST_NAME' => $lastName,
                    'SECOND_NAME' => $secondName,
                    'EMAIL' => $email,
                    'PHONE' => $phone,
                ]);
            }

            /**
             * Создание сделки
             */
            $fields = [];
            foreach ($order->getBasket()->getBasketItems() as $item) {
                $fields = [
                    'STAGE_ID' => 'C9:NEW',
                    'TITLE' => $product['NAME'], // Название
                    'OPPORTUNITY' => $item->getPrice(), // Сумма
                    'CURRENCY_ID' => $order->getCurrency(), // Валюта
                    'SOURCE_ID' => 'WEB', // Источник
                    'CATEGORY_ID' => 9,
                    'UF_CRM_1613565609' => 1246, // Способ оплаты
                    'UF_CRM_1548068937' => (new DateTime())->toString(),// Дата оплаты
                    'UF_CRM_1580379762' => $item->getPrice(), // Сумма оплаты
                    'UF_CRM_1580283395' => 881, // Тип сделки (обучение),
                    'UF_CRM_1628167728264' => $order->getId()
                ];
            }


            if (is_array($contacts)) {
                $contact = current($contacts);
                $fields['CONTACT_ID'] = $contact['ID'];
                $fields['UF_CRM_1545916718'] = $contact['ID'];
            }

            if (is_numeric($contacts)) {
                $fields['CONTACT_ID'] = $contacts;
                $fields['UF_CRM_1545916718'] = $contacts;
            }

            $properties = IblockTools::getProperties(
                $product['IBLOCK_ID'],
                $product['ID']
            );

            foreach ($properties as $property) {
                if ($property['CODE'] == 'MANAGER' && $property['VALUE']) {
                    $manager = \Bitrix\Iblock\ElementTable::getList([
                        'filter' => ['=ID' => $property['VALUE']],
                        'limit' => 1
                    ])->fetch();

                    if ($manager) {
                        $propertyEmail = \CIBlockElement::GetProperty($manager['IBLOCK_ID'], $manager['ID'], ['sort' => 'asc'], ['CODE'=>'POST_MAIL'])->Fetch();

                        $fields['UF_CRM_1617289913042'] = $propertyEmail['VALUE'];
                    }
                }

                if ($property['CODE'] == 'DATE' && $property['VALUE']) {
                    $fields['UF_CRM_1579608242'] = $property['VALUE'];
                }


                if ($property['CODE'] == 'DATES' && is_array($property['VALUE'])) {
                    $fields['UF_CRM_1579608261'] = end($property['VALUE']);
                }


                if ($property['CODE'] == 'CITY' && $property['VALUE']) {
                    $fields['UF_CRM_5CA301F3AF832'] = $property['VALUE'];
                }
            }

            $dealId = CrmManager::createDeal($fields);

            if ($dealId) {
                foreach ($order->getBasket()->getBasketItems() as $item) {
                    $data = [
                        'PRODUCT_ID' => $product['EXTERNAL_ID'],
                        'PRICE'      => $item->getPrice(),
                        'QUANTITY'   => $item->getQuantity()
                    ];
                    CrmManager::setProductDeal($dealId, $data);
                }
            }
            /**
             * Заполнение свойств заказа
             */
            $propertyCollection = $order->getPropertyCollection();
            foreach ($propertyCollection->getGroups() as $group)
            {
                foreach ($propertyCollection->getGroupProperties($group['ID']) as $property)
                {
                    $prop = $property->getProperty();

                    switch ($prop ['CODE']) {
                        case 'FIO':
                            $fio = '';
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= $resultAnswers['last_name']['USER_TEXT'];
                            }
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= ' '.$resultAnswers['first_name']['USER_TEXT'];
                            }
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= ' '.$resultAnswers['second_name']['USER_TEXT'];
                            }
                            $property->setValue($fio);
                            break;

                        case 'PHONE':
                            $property->setValue($resultAnswers['phone']['USER_TEXT']);
                            break;

                        case 'EMAIL':
                            $property->setValue($resultAnswers['email']['USER_TEXT']);
                            break;

                        case 'COMPANY':
                            $property->setValue($resultAnswers['company']['USER_TEXT']);
                            break;

                        case 'HOW_KNOW':
                            $property->setValue($resultAnswers['know']['USER_TEXT']);
                            break;

                        case 'REQUISITES':
                            $property->setValue($resultAnswers['requisites']['USER_TEXT']);
                            break;

                        case 'SUBSCRIBE':
                            if (!empty($resultAnswers['subscribe'])) {
                                $property->setValue('Y');
                            }
                            break;

                        case 'FORM_STUDY':
                            $property->setValue($product['PROPERTIES']['FORM_TRAINING_NEW']['VALUE']);
                            break;

                        case 'PLACE_STUDY':
                            $property->setValue($product['PROPERTIES']['CITY']['VALUE']);
                            break;

                        case 'MANAGER':
                            if ($product['PROPERTIES']['MANAGER']['VALUE']) {
                                $manager = \Bitrix\Iblock\ElementTable::getList([
                                    'filter' => [
                                        '=ID' => $product['PROPERTIES']['MANAGER']['VALUE']
                                    ],
                                    'limit' => 1
                                ])->fetch();
                                $property->setValue($manager['NAME']);
                            }
                            break;

                        case 'CONTACT':
                            if (is_array($contacts)) {
                                $contact = current($contacts);
                                $property->setValue($contact['ID']);
                            } elseif (is_numeric($contacts)) {
                                $property->setValue($contacts);
                            }
                            break;

                        case 'DEAL':
                            if ($dealId) {
                                $property->setValue($dealId);
                            }
                            break;
                    }
                }
            }
            /**
             * Сохранение заказа
             */
            $result = $order->save();

            if (!$result->isSuccess()) {
                throw new \Bitrix\Main\SystemException(implode('<br/> ', $result->getErrors()));
            }
            $response->setMessage('Заявка успешно отправлена');
        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }

        $response->send();
    }
    public function sendPayOrder(int $productId): void
    {
        $response = new Response();

        try {
            // if (!$this->request->isAjaxRequest()) {
            //     throw new \Bitrix\Main\SystemException('Некорректный запрос');
            // }

            $data = $this->request->getPostList()->toArray();

            if (!$formId = $data['WEB_FORM_ID']) {
                throw new \Bitrix\Main\SystemException('Не указан идентификатор формы');
            }
            logger(print_r($data,true));
            /**
             * Проверка полей формы
             */
            FormsManager::checkForm($formId, $data);

            /**
             * Добавление результата формы
             */
            $resultId = FormsManager::resultAdd($formId, $data);

            if (!$resultId) {
                throw new \Bitrix\Main\SystemException('Ошибка добавления результата формы');
            }

            /**
             * Получаем данные о продукте
             */
            $product = IblockTools::getElement($productId);

            /**
             * Получаем список ответов
             */
            $resultAnswers = FormsManager::getResultAnswer($formId, $resultId);
            \COption::SetOptionString("main","captcha_registration","N");
            /**
             * Устанавливаем значение поля результата
             */
            // \CFormResult::SetField($resultId, 'product', [
            //     $resultAnswers['product']['ANSWER_ID'] => $product['NAME']
            // ]);
            // logger(print_r($resultAnswers,true));

            $email = $resultAnswers['email']['USER_TEXT'];
            $cUser = \Bitrix\Main\UserTable::getList([
                'select' => ['ID'],
                'filter' => [
                    'LOGIC' => 'OR',
                    ['=EMAIL' => $email],
                    ['=LOGIN' => $email]
                ]
            ])->fetch();
            if ($cUser) {
                $userId = $cUser['ID'];
            }

            global $USER;
            if (!$USER->IsAuthorized() && !$cUser) {
                $firstName = $resultAnswers['first_name']['USER_TEXT'];
                $lastName = $resultAnswers['last_name']['USER_TEXT'];
                $secondName = $resultAnswers['second_name']['USER_TEXT'];

                $email = $resultAnswers['email']['USER_TEXT'];
                $name = $firstName . ($lastName ? (' ' . $secondName) : '');
                $password = randString(7);

                $test = $USER->Register($email, $name, null, $password, $password, $email);
                \Bitrix\Main\Diag\Debug::writeToFile([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'user' => $USER->GetID()
                ], __METHOD__.':'.__LINE__);
                if ($userId = $USER->GetID()) {
                    $user_fields_add = ['PERSONAL_PHONE'=>$resultAnswers['phone']['USER_TEXT']];
                    $USER->Update($USER->GetID(), $user_fields_add);
                }
            }
            // logger(print_r($test,true));
            
            // logger('=======');
            // logger(print_r($userId,true));

            /**
             * Получаем цену товара
             */
            $price = \Bitrix\Catalog\Model\Price::getList([
                'filter' => ['PRODUCT_ID' => $productId ],
                'limit' => 1
            ])->fetch();

            /**
             * Формирование корзины
             */
            $basket = \Bitrix\Sale\Basket::create(\Bitrix\Main\Application::getInstance()->getContext()->getSite());
            $item = $basket->createItem('catalog', $productId);
            $item->setFields([
                'QUANTITY' => 1,
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                'PRODUCT_PROVIDER_CLASS' => '\Bitrix\Catalog\Product\CatalogProvider',
                'PRICE' => round($price['PRICE']),
                'NAME'  => $product['NAME'],
                'DETAIL_PAGE_URL' => $product['DETAIL_PAGE_URL']
            ]);

            /**
             * Формирование заказа
             */
            global $USER;
            $order = \Bitrix\Sale\Order::create(
                \Bitrix\Main\Application::getInstance()->getContext()->getSite(),
                $userId ? $userId:\Bitrix\Sale\Fuser::getId(),
                \Bitrix\Currency\CurrencyManager::getBaseCurrency()
            );
            $order->setPersonTypeId(1);
            $order->setBasket($basket);

            /**
             * Заполнение свойств заказа
             */
            $propertyCollection = $order->getPropertyCollection();
            foreach ($propertyCollection->getGroups() as $group)
            {
                foreach ($propertyCollection->getGroupProperties($group['ID']) as $property)
                {
                    $prop = $property->getProperty();

                    switch ($prop ['CODE']) {
                        case 'FIO':
                            $fio = '';
                            if ($resultAnswers['last_name']['USER_TEXT']) {
                                $fio .= $resultAnswers['last_name']['USER_TEXT'];
                            }
                            if ($resultAnswers['first_name']['USER_TEXT']) {
                                $fio .= ' '.$resultAnswers['first_name']['USER_TEXT'];
                            }
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= ' '.$resultAnswers['second_name']['USER_TEXT'];
                            }
                            $property->setValue($fio);
                            break;

                        case 'PHONE':
                            $property->setValue($resultAnswers['phone']['USER_TEXT']);
                            break;

                        case 'EMAIL':
                            $property->setValue($resultAnswers['email']['USER_TEXT']);
                            break;
                        case 'USER_DESCRIPTION':
                            $property->setValue($data['currentPage']);
                            break;
                    }
                }
            }
            $order->setField('USER_DESCRIPTION',$data['currentPage']);
            /**
             * Установка отгрузки
             */
            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem(
                \Bitrix\Sale\Delivery\Services\Manager::getObjectById(1)
            );
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());

            /**
             * Установка оплаты
             */
            $paymentCollection = $order->getPaymentCollection();
            $payment = $paymentCollection->createItem(
                \Bitrix\Sale\PaySystem\Manager::getObjectById(3)
            );
            $payment->setField('SUM', $order->getPrice());
            $payment->setField('CURRENCY', $order->getCurrency());

            /**
             * Сохранение заказа
             */
            $result = $order->save();

            if (!$result->isSuccess()) {
                throw new \Bitrix\Main\SystemException(implode('<br/> ', $result->getErrors()));
            }
            $response->setMessage('Заявка успешно отправлена');

            \COption::SetOptionString("main","captcha_registration","Y");
            LocalRedirect('/personal/order/payment/?autoPay=Y&ORDER_ID='.$order->getId());

        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }


    //    \COption::SetOptionString("main","captcha_registration","Y");

    //     LocalRedirect('/personal/order/payment/?autoPay=Y&ORDER_ID='.$order->getId());
        $response->send();

    }

    /**
     * @param int $productId
     */
    public function getOffer(int $productId): void
    {
        $response = new Response();

        try {
            if (!$this->request->isAjaxRequest()) {
                throw new \Bitrix\Main\SystemException('Некорректный запрос');
            }
            $data = $this->request->getPostList()->toArray();

            if (!$formId = $data['WEB_FORM_ID']) {
                throw new \Bitrix\Main\SystemException('Не указан идентификатор формы');
            }

            /**
             * Проверка полей формы
             */
            FormsManager::checkForm($formId, $data);

            /**
             * Добавление результата формы
             */
            $resultId = FormsManager::resultAdd($formId, $data);

            if (!$resultId) {
                throw new \Bitrix\Main\SystemException('Ошибка добавления результата формы');
            }

            /**
             * Получаем данные о продукте
             */
            $product = IblockTools::getElement($productId);

            /**
             * Получаем список ответов
             */
            $resultAnswers = FormsManager::getResultAnswer($formId, $resultId);

            /**
             * Устанавливаем значение поля результата
             */
            \CFormResult::SetField($resultId, 'product', [
                $resultAnswers['product']['ANSWER_ID'] => $product['NAME']
            ]);

            $email = $resultAnswers['email']['USER_TEXT'];
            $cUser = \Bitrix\Main\UserTable::getList([
                'select' => ['ID'],
                'filter' => [
                'LOGIC' => 'OR',
                    ['=EMAIL' => $email],
                    ['=LOGIN' => $email]
                ]
            ])->fetch();

            if ($cUser) {
                $userId = $cUser['ID'];
            }

            global $USER;
            if (!$USER->IsAuthorized() && !$cUser) {
                $firstName = $resultAnswers['first_name']['USER_TEXT'];
                $lastName = $resultAnswers['last_name']['USER_TEXT'];
                $secondName = $resultAnswers['second_name']['USER_TEXT'];

                $email = $resultAnswers['email']['USER_TEXT'];
                $name = $firstName . ($lastName ? (' ' . $secondName) : '');
                $password = randString(7);

                $USER->Register($email, $name, null, $password, $password, $email);
                \Bitrix\Main\Diag\Debug::writeToFile([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'user' => $USER->GetID()
                ], __METHOD__.':'.__LINE__);
                if ($userId = $USER->GetID()) {
                    $user_fields_add = ['PERSONAL_PHONE'=>$resultAnswers['phone']['USER_TEXT']];
                    $USER->Update($USER->GetID(), $user_fields_add);
                }
            }

            /**
             * Получаем цену товара
             */
            $price = \Bitrix\Catalog\Model\Price::getList([
                'filter' => ['PRODUCT_ID' => $productId ],
                'limit' => 1
            ])->fetch();

            /**
             * Формирование корзины
             */
            $basket = \Bitrix\Sale\Basket::create(\Bitrix\Main\Application::getInstance()->getContext()->getSite());
            $item = $basket->createItem('catalog', $productId);
            $item->setFields([
                'QUANTITY' => 1,
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                'PRODUCT_PROVIDER_CLASS' => '\Bitrix\Catalog\Product\CatalogProvider',
                'PRICE' => round($price['PRICE']),
                'NAME'  => $product['NAME'],
                'DETAIL_PAGE_URL' => $product['DETAIL_PAGE_URL']
            ]);

            /**
             * Формирование заказа
             */
            global $USER;
            $order = \Bitrix\Sale\Order::create(
                \Bitrix\Main\Application::getInstance()->getContext()->getSite(),
                $userId ? $userId:\Bitrix\Sale\Fuser::getId(),
                \Bitrix\Currency\CurrencyManager::getBaseCurrency()
            );
            $order->setPersonTypeId(1);
            $order->setBasket($basket);

            $order->setField('USER_DESCRIPTION', $resultAnswers['comment']['USER_TEXT']);

            /**
             * Установка отгрузки
             */
            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem(
                \Bitrix\Sale\Delivery\Services\Manager::getObjectById(1)
            );

            /**
             * Установка оплаты
             */
            $paymentCollection = $order->getPaymentCollection();
            $payment = $paymentCollection->createItem(
                \Bitrix\Sale\PaySystem\Manager::getObjectById(3)
            );
            $payment->setField('SUM', $order->getPrice());
            $payment->setField('CURRENCY', $order->getCurrency());

            /**
             * Сохранение заказа
             */
            $result = $order->save();

            if (!$result->isSuccess()) {
                throw new \Bitrix\Main\SystemException(implode('<br/> ', $result->getErrors()));
            }

            /**
             * Создание контакта
             */
            $email = $resultAnswers['email']['USER_TEXT'];
            $phone = $resultAnswers['phone']['USER_TEXT'];
            $contacts = null;
            if ($email) {
                $contacts = CrmManager::getContactsByEmail($email);
            }

            if ($phone && !is_array($contacts)) {
                $contacts = CrmManager::getContactsByPhone($phone);
            }

            if (!is_array($contacts)) {
                $lastName = $resultAnswers['last_name']['USER_TEXT'];
                $firstName = $resultAnswers['first_name']['USER_TEXT'];
                $secondName = $resultAnswers['second_name']['USER_TEXT'];

                $contacts = CrmManager::createContact([
                    'NAME' => $firstName,
                    'LAST_NAME' => $lastName,
                    'SECOND_NAME' => $secondName,
                    'EMAIL' => $email,
                    'PHONE' => $phone,
                ]);
            }

            /**
             * Создание сделки
             */
            $fields = [];
            foreach ($order->getBasket()->getBasketItems() as $item) {
                $fields = [
                    'STAGE_ID' => 'C9:NEW',
                    'TITLE' => $product['NAME'], // Название
                    'OPPORTUNITY' => $item->getPrice(), // Сумма
                    'CURRENCY_ID' => $order->getCurrency(), // Валюта
                    'SOURCE_ID' => 'WEB', // Источник
                    'CATEGORY_ID' => 9,
                    'UF_CRM_1613565609' => 1246, // Способ оплаты
                    'UF_CRM_1548068937' => (new DateTime())->toString(),// Дата оплаты
                    'UF_CRM_1580379762' => $item->getPrice(), // Сумма оплаты
                    'UF_CRM_1580283395' => 881, // Тип сделки (обучение),
                    'UF_CRM_1628167728264' => $order->getId()
                ];
            }


            if (is_array($contacts)) {
                $contact = current($contacts);
                $fields['CONTACT_ID'] = $contact['ID'];
                $fields['UF_CRM_1545916718'] = $contact['ID'];
            }

            if (is_numeric($contacts)) {
                $fields['CONTACT_ID'] = $contacts;
                $fields['UF_CRM_1545916718'] = $contacts;
            }

            $properties = IblockTools::getProperties(
                $product['IBLOCK_ID'],
                $product['ID']
            );

            foreach ($properties as $property) {
                if ($property['CODE'] == 'MANAGER' && $property['VALUE']) {
                    $manager = \Bitrix\Iblock\ElementTable::getList([
                        'filter' => ['=ID' => $property['VALUE']],
                        'limit' => 1
                    ])->fetch();

                    if ($manager) {
                        $propertyEmail = \CIBlockElement::GetProperty($manager['IBLOCK_ID'], $manager['ID'], ['sort' => 'asc'], ['CODE'=>'POST_MAIL'])->Fetch();

                        $fields['UF_CRM_1617289913042'] = $propertyEmail['VALUE'];
                    }
                }

                if ($property['CODE'] == 'DATE' && $property['VALUE']) {
                    $fields['UF_CRM_1579608242'] = $property['VALUE'];
                }


                if ($property['CODE'] == 'DATES' && is_array($property['VALUE'])) {
                    $fields['UF_CRM_1579608261'] = end($property['VALUE']);
                }


                if ($property['CODE'] == 'CITY' && $property['VALUE']) {
                    $fields['UF_CRM_5CA301F3AF832'] = $property['VALUE'];
                }
            }

            $dealId = CrmManager::createDeal($fields);

            if ($dealId) {
                foreach ($order->getBasket()->getBasketItems() as $item) {
                    $data = [
                        'PRODUCT_ID' => $product['EXTERNAL_ID'],
                        'PRICE'      => $item->getPrice(),
                        'QUANTITY'   => $item->getQuantity()
                    ];
                    CrmManager::setProductDeal($dealId, $data);
                }
            }
            /**
             * Заполнение свойств заказа
             */
            $propertyCollection = $order->getPropertyCollection();
            foreach ($propertyCollection->getGroups() as $group)
            {
                foreach ($propertyCollection->getGroupProperties($group['ID']) as $property)
                {
                    $prop = $property->getProperty();

                    switch ($prop ['CODE']) {
                        case 'FIO':
                            $fio = '';
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= $resultAnswers['last_name']['USER_TEXT'];
                            }
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= ' '.$resultAnswers['first_name']['USER_TEXT'];
                            }
                            if ($resultAnswers['second_name']['USER_TEXT']) {
                                $fio .= ' '.$resultAnswers['second_name']['USER_TEXT'];
                            }
                            $property->setValue($fio);
                            break;

                        case 'PHONE':
                            $property->setValue($resultAnswers['phone']['USER_TEXT']);
                            break;

                        case 'EMAIL':
                            $property->setValue($resultAnswers['email']['USER_TEXT']);
                            break;

                        case 'COMPANY':
                            $property->setValue($resultAnswers['company']['USER_TEXT']);
                            break;

                        case 'HOW_KNOW':
                            $property->setValue($resultAnswers['know']['USER_TEXT']);
                            break;

                        case 'REQUISITES':
                            $property->setValue($resultAnswers['requisites']['USER_TEXT']);
                            break;

                        case 'SUBSCRIBE':
                            if (!empty($resultAnswers['subscribe'])) {
                                $property->setValue('Y');
                            }
                            break;

                        case 'FORM_STUDY':
                            $property->setValue($product['PROPERTIES']['FORM_TRAINING_NEW']['VALUE']);
                            break;

                        case 'PLACE_STUDY':
                            $property->setValue($product['PROPERTIES']['CITY']['VALUE']);
                            break;

                        case 'MANAGER':
                            if ($product['PROPERTIES']['MANAGER']['VALUE']) {
                                $manager = \Bitrix\Iblock\ElementTable::getList([
                                    'filter' => [
                                        '=ID' => $product['PROPERTIES']['MANAGER']['VALUE']
                                    ],
                                    'limit' => 1
                                ])->fetch();
                                $property->setValue($manager['NAME']);
                            }
                            break;

                        case 'CONTACT':
                            if (is_array($contacts)) {
                                $contact = current($contacts);
                                $property->setValue($contact['ID']);
                            } elseif (is_numeric($contacts)) {
                                $property->setValue($contacts);
                            }
                            break;

                        case 'DEAL':
                            if ($dealId) {
                                $property->setValue($dealId);
                            }
                            break;
                    }
                }
            }
            /**
             * Сохранение заказа
             */
            $result = $order->save();

            if (!$result->isSuccess()) {
                throw new \Bitrix\Main\SystemException(implode('<br/> ', $result->getErrors()));
            }
            $response->setMessage('Заявка успешно отправлена');
        } catch (\Exception $exception) {
            \Bitrix\Main\Application::getInstance()
                ->getExceptionHandler()
                ->writeToLog($exception);

            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }
        $response->send();
    }


    /**
     * @param int $serviceId
     */
    public function sendRequest(int $serviceId): void
    {
        $response = new Response();

        try {
            if (!$this->request->isAjaxRequest()) {
                throw new \Bitrix\Main\SystemException('Некорректный запрос');
            }
            $data = $this->request->getPostList()->toArray();

            if (!$formId = $data['WEB_FORM_ID']) {
                throw new \Bitrix\Main\SystemException('Не указан идентификатор формы');
            }

            /**
             * Проверка полей формы
             */
            FormsManager::checkForm($formId, $data);

            /**
             * Добавление результата формы
             */
            $resultId = FormsManager::resultAdd($formId, $data);

            if (!$resultId) {
                throw new \Bitrix\Main\SystemException('Ошибка добавления результата формы');
            }

            /**
             * Получаем данные о продукте
             */
            $service = IblockTools::getElement($serviceId);

            /**
             * Получаем список ответов
             */
            $resultAnswers = FormsManager::getResultAnswer($formId, $resultId);

            /**
             * Устанавливаем значение поля результата
             */
            \CFormResult::SetField($resultId, 'service', [
                $resultAnswers['service']['ANSWER_ID'] => $service['NAME']
            ]);

            $response->setMessage('Заявка успешно отправлена');
        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }
        $response->send();
    }

    /**
     *
     */
    public function handleFeedback(): void
    {
        $response = new Response();

        try {
            if (!$this->request->isAjaxRequest()) {
                throw new \Bitrix\Main\SystemException('Некорректный запрос');
            }
            $data = $this->request->getPostList()->toArray();

            if (!$formId = $data['WEB_FORM_ID']) {
                throw new \Bitrix\Main\SystemException('Не указан идентификатор формы');
            }

            /**
             * Проверка полей формы
             */
            FormsManager::checkForm($formId, $data);

            /**
             * Добавление результата формы
             */
            $resultId = FormsManager::resultAdd($formId, $data);

            if (!$resultId) {
                throw new \Bitrix\Main\SystemException('Ошибка добавления результата формы');
            }

            $response->setMessage('Заявка успешно отправлена');
        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }
        $response->send();
    }
}
