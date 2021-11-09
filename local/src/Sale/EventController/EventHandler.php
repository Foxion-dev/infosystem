<?php

namespace InfoSystems\Sale\EventController;

use CIblockElement;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\SystemException;
use Bitrix\Sale\Order;
use Bitrix\Main\Type\DateTime;
use InfoSystems\Crm\CrmHelper;
use InfoSystems\Entity\CrmDealsTable;
use InfoSystems\Enum\ScheduleCoursesIblock;
use InfoSystems\Enum\ScheduleListenersIblock;
use InfoSystems\Iblock\IblockHelper;
use InfoSystems\Tools\IblockTools;

class EventHandler extends \InfoSystems\App\EventHandling\AbstractEventHandler
{
    /**
     * @param EventManager $eventManager
     * @return void
     */
    public static function initHandlers(EventManager $eventManager): void
    {
        parent::initHandlers($eventManager);

        $module = 'sale';
        static::initHandler(
            'OnSaleOrderSaved',
            [
                static::class,
                'orderSave',
            ],
            $module
        );
    }

    public static function orderSave(\Bitrix\Main\Event $event)
    {
        $static = new static();
        
        $order = $event->getParameter('ENTITY');
        $paySystem = $order->getField('PAY_SYSTEM_ID');
        $payStatus = $order->getField('STATUS_ID');

        $personType = $order->getPersonTypeId();

        if ($paySystem == \InfoSystems\Enum\Payments::CHECK) {
            if ($payStatus == 'N' && $event->getParameter('IS_NEW')) {

                if ($personType == 2){  // Если юр.лицо

                    if (!$static->isSetDeal($order->getId())) {

                        $pactData = $static->createCrmDeal($order);

                        $static->createTaskForPact($pactData);
                    }

                    $static->createSchedule($order);

                } else {
                    $static->createCrmDeal($order);
                    $static->createSchedule($order);
                }
            }
        } else {
            if ($payStatus == 'P') {

                if ($personType == 1){ // Если оплатил и физ.лицо

                    if (!$static->isSetDeal($order->getId())) {
                        $dealsList = $static->createCrmDeal($order, true);
                        $static->addListener($order, $dealsList['deals']);
                    }

                    if ($order->getUserId()) {
                        $static->createSchedule($order);
                    }
                }
            }
        }


    }

    public function createSchedule(\Bitrix\Sale\Order $order)
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        if ($order instanceof \Bitrix\Sale\Order) {

            $iblockHelper = new IblockHelper();

            foreach ($order->getBasket()->getBasketItems() as $basketItem) {

                /** Получаем данные о продукте */
                $product = [];

                $obElement = \CIBlockElement::GetList(
                    ['ID' => 'ASC'],
                    [
                        '=ID' => $basketItem->getProductId()
                    ],
                    false,
                    false,
                    ['*', 'PROPERTY_*']
                );
                while ($element = $obElement->GetNextElement()) {
                    $product = $element->GetFields();
                    $product['PROPERTIES'] = $element->GetProperties();
                }

                if ($product) {

                    /** Находим курс расписания */
                    $course = [];

                    $obElement = \CIBlockElement::GetList(
                        [
                            'ID' => 'ASC'
                        ],
                        [
                            '=IBLOCK_ID' => ScheduleCoursesIblock::getId(),
                            '=DATE_ACTIVE_FROM' => $product['ACTIVE_FROM'],
                            '=DATE_ACTIVE_TO'   => $product['ACTIVE_TO']
                        ],
                        false,
                        false,
                        ['*', 'PROPERTY_*']
                    );

                    while ($element = $obElement->GetNextElement()) {
                        $course = $element->GetFields();
                        $course['PROPERTIES'] = $element->GetProperties();
                    }

                    if ($course) {

                        if ($course['PROPERTIES']['STATUS']['VALUE'] == 'recruit' && count($course['PROPERTIES']['LISTENERS']['VALUE']) >= 3) {

                            /** Меняем статус на Утвержден */
                            \CIBlockElement::SetPropertyValuesEx($course['ID'], $course['IBLOCK_ID'], [
                                'STATUS' => 'approve'
                            ]);

                            /** Формируем расписание */
                            foreach ($product['PROPERTIES']['DATES']['VALUE'] as $date) {

                                $date = \Bitrix\Main\Type\DateTime::createFromText($date);

                                if ($date instanceof \Bitrix\Main\Type\DateTime) {

                                    $scheduleId = $iblockHelper->addElement(
                                        \InfoSystems\Enum\ScheduleIblock::getId(),
                                        [
                                            'NAME' => $product['NAME'],
                                            'DATE_ACTIVE_FROM' => $date,
                                            'DATE_ACTIVE_TO' => $date->add('+1 hour')
                                        ],
                                        ['COURSE' => $course['ID']]
                                    );

                                    if (!$scheduleId) {
                                        \Bitrix\Main\Diag\Debug::writeToFile('Ошибка добавления расписания', __METHOD__.':'.__LINE__);
                                    }
                                }
                            }
                        }
                    } else {

                        $iblockHelper->addElement(
                            ScheduleCoursesIblock::getId(),
                            [
                                'NAME' => $product['NAME']
                            ],
                            [
                                'STATUS'        => 'recruit',
                                'COURSE_FORM'   => $product['PROPERTIES']['FORM_TRAINING_NEW']['VALUE'],
                                'DATE'          => $product['PROPERTIES']['DATES']['VALUE'],
                                'COURSE_VOLUME' => $product['PROPERTIES']['DURATION_SPISOK']['VALUE'],
                                'COURSE'        => $product['ID'],
                                'ACTIVE_FROM'   => $product['ACTIVE_FROM'],
                                'ACTIVE_TO'     => $product['ACTIVE_TO'],
                                'RESPONSIBLE'   => $product['PROPERTIES']['MANAGER_2']['VALUE'],
                                'TEACHERS'      => [
                                    $product['PROPERTIES']['EXPERTS']['VALUE']
                                ],
                                'LISTENERS' => [
                                    $order->getUserId()
                                ]
                            ]
                        );
                    }
                }
            }
        }
    }

    /**
     * @param Order $order
     * @return array
     */
    public function createCrmDeal(\Bitrix\Sale\Order $order, $payed = false)
    {
        $result = [];
        $deals_array = [];
        $products_array = [];
        $personType = $order->getPersonTypeId();

        $contacts = $this->createCrmContact($order);

        if($personType == 1){
            $dealType = 881; // физ лицо
        }elseif($personType == 2){
            $dealType = 879; // юр лицо
            $company = $this->createCrmCompany($order);

        }

        foreach ($order->getBasket()->getBasketItems() as $key => $item) {

            $product = \Bitrix\Iblock\ElementTable::getList([
                'filter' => ['=ID' => $item->getProductId()],
                'limit' => 1
            ])->fetch();
            // logger(print_r($product,true));

            if ($product) {
                $products_array[$key] = $product;
                $fields = [
                    'STAGE_ID' => $payed ? 'C9:10' : 'C9:NEW',
                    'TITLE' => $product['NAME'], // Название
                    'OPPORTUNITY' => $item->getPrice(), // Сумма
                    'CURRENCY_ID' => $order->getCurrency(), // Валюта
                    'SOURCE_ID' => 'WEB', // Источник
                    'CATEGORY_ID' => 9,
                    'UF_CRM_1613565609' => 1246, // Способ оплаты
                    'UF_CRM_1548068937' => (new DateTime())->toString(),// Дата оплаты
                    'UF_CRM_1580379762' => $item->getPrice(), // Сумма оплаты
                    'UF_CRM_1580283395' => $dealType, // Тип сделки (обучение),
                    'UF_CRM_1628167728264' => $order->getId()
                ];

                if (is_array($contacts)) {
                    $contact = array_shift($contacts);
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
                $products_array[$key]['props'] = $properties;
                foreach ($properties as $property) {
                    if ($property['CODE'] == 'MANAGER_2' && $property['VALUE']) {
                        $manager = \Bitrix\Main\UserTable::getList([
                            'filter' => ['=ID' => $property['VALUE']],
                            'limit' => 1
                        ])->fetch();

                        if ($manager['XML_ID']) {
                            $fields['ASSIGNED_BY_ID'] = $manager['XML_ID'];
                        }
                    }

                    /** Дата начала обучения */
                    if ($property['CODE'] == 'DATE' && $property['VALUE']) {
                        $fields['UF_CRM_1579608242'] = $property['VALUE'] ;
                    }

                    /** Дата окончания обучения */
                    if ($property['CODE'] == 'DATES' && is_array($property['VALUE'])) {
                        $fields['UF_CRM_1579608261'] = end($property['VALUE']);
                    }

                    /** Место обучения */
                    if ($property['CODE'] == 'CITY' && $property['VALUE']) {
                        $fields['UF_CRM_5CA301F3AF832'] = $property['VALUE'];
                    }


                }

                /** Количество слушателей для физ лица */
                if ($payed) {
                    $fields['UF_CRM_5CAC8426EF573'] = '1';
                }

                // для заказов со страниц оплаты напрямую 
                if(empty($fields['UF_CRM_1579608242'])){
                    $fields['UF_CRM_1579608242'] = date('d.m.Y');
                }
                if(empty($fields['UF_CRM_1579608261'])){
                    $fields['UF_CRM_1579608261'] = date('d.m.Y');
                }
                if(empty($fields['ASSIGNED_BY_ID'])){
                    $fields['ASSIGNED_BY_ID'] = 99;
                }
                if(empty($fields['COMMENTS'])){
                    $fields['COMMENTS'] = $order->getField('USER_DESCRIPTION');
                }

                /**
                 * Формируем сделку
                 */
                $deal = \CRest::call('crm.deal.add', ['fields' => $fields]);

                if ($deal['result']) {

                    $result = CrmDealsTable::add([
                        'UF_ORDER_ID' => (int)$order->getId(),
                        'UF_CRM_DEAL' => (int)$deal['result']
                    ]);

                    if (!$result->isSuccess()) {
                        \Bitrix\Main\Diag\Debug::writeToFile(['Ошибка записи в таблицу is_crm_deal'], __METHOD__.'::'.__LINE__);
                    }

                    /**
                     * Привязываем товары к сделке
                     */
                    $result = \CRest::call('crm.deal.productrows.set', [
                        'id' => $deal['result'],
                        'rows' => [[
                            'PRODUCT_ID' => $product['XML_ID'],
                            'PRICE' => $item->getPrice(),
                            'QUANTITY' => $item->getQuantity()
                        ]]
                    ]);

                    $result[] = $deal['result'];
                    $deals_array[$key] = $deal['result'];
                }
            }
        }
        if(!empty($company)){
            $result['company'] = $company;
        }
        $result['contact'] = $contact;
        $result['products'] = $products_array;
        $result['deals'] = $deals_array;
        return $result;
    }

    /**
     * Создание контакта
     *
     * @param Order $order
     *
     * @return bool|mixed
     */
    public function createCrmContact(\Bitrix\Sale\Order $order)
    {
        $propertyCollection = $order->getPropertyCollection();

        $email = $propertyCollection->getUserEmail()->getValue();
        $phone = $propertyCollection->getPhone()->getValue();
        $payerName  = $propertyCollection->getPayerName()->getValue();

        if ($email) {
            $contacts = $this->getContactsByEmail($email);
            if (is_array($contacts)) {
                return $contacts;
            }
        }

        if ($phone) {
            $contacts = $this->getContactsByPhone($phone);
            if (is_array($contacts)) {
                return $contacts;
            }
        }
        $payerName = explode(' ', $payerName);
        $data = [
            'NAME' => $payerName[1],
            'LAST_NAME' => $payerName[0],
            'SECOND_NAME' => $payerName[2],
            // 'EMAIL' => $email,
            // 'PHONE' => $phone,
            'EMAIL' => [['VALUE' => $email, 'VALUE_TYPE' => 'WORK']],
            'PHONE' => [['VALUE' => $phone, 'VALUE_TYPE' => 'WORK']],
            'UF_CRM_1611664039' => 1136,
            'UF_CRM_1611671435' => 'Город не указан',
        ];

        $result = \CRest::call('crm.contact.add', ['fields' => $data]);
        

        if ($result['result']) {
            return $result['result'];
        }

        return null;
    }

    /**
     * Создание компании
     *
     * @param Order $order
     *
     * @return bool|mixed
     */
    public function createCrmCompany(\Bitrix\Sale\Order $order)
    {
        $propertyCollection = $order->getPropertyCollection();
        $propsArray = $propertyCollection->getArray();

        $contact = [];
        $company = [];

        $data = array(
            'UF_CRM_1545737672' => 113, // форма собственности
            'COMPANY_TYPE' => 'CUSTOMER'
        );
        $requsitesString = '';
        foreach($propsArray['properties'] as $prop){
            switch($prop['CODE']){
                case 'COMPANY':
                    $data['TITLE'] = $prop['VALUE'][0];
                    break;
                case 'COMPANY_ADR':
                    $data['UF_CRM_1538571281105'] = $prop['VALUE'][0];
                    break;
                case 'INN':
                    if($prop['VALUE'][0]){
                        $data['REQUISITES'] = $prop['VALUE'][0];
                        $requsitesString .= ' ИНН: ' . $prop['VALUE'][0];
                    }
                    break;
                case 'KPP':
                    if($prop['VALUE'][0]){
                        $requsitesString .= ' КПП: ' . $prop['VALUE'][0];
                    }
                    break;

                case 'CONTACT_PERSON':
                    $contact['NAME'] = $prop['VALUE'][0];
                    break;
                case 'EMAIL':
                    $data['EMAIL'] = array(
                        array(
                            "VALUE" => $prop['VALUE'][0],
                            "VALUE_TYPE" => 'WORK'
                        )
                    );

                    $contact['EMAIL'] = $prop['VALUE'][0];

                    break;
                case 'PHONE':
                    $data['PHONE'] = array(
                        array(
                            "VALUE" => $prop['VALUE'][0],
                            "VALUE_TYPE" => 'WORK'
                        )
                    );

                    $contact['PHONE'] = $prop['VALUE'][0];
                    break;
                default: break;
            }
        }

        $data['COMMENTS'] = $requsitesString;

        $contactsIds = [];
        if ($contact['EMAIL']) {
            $contactsEmail = $this->getContactsByEmail($contact['EMAIL']);
            if (is_array($contactsEmail)) {
                foreach($contactsEmail as $contact1){
                    $contactsIds[] = $contact1['ID'];
                }
            }
        }

        if ($contact['PHONE']) {
            $contactsPhone = $this->getContactsByPhone($contact['PHONE']);
            if (is_array($contactsPhone)) {
                foreach($contactsPhone as $contact2){
                    $contactsIds[] = $contact2['ID'];
                }
            }
        }
        $data['CONTACT'] = $contactsIds;

        $result = \CRest::call('crm.company.add', ['fields' => $data]);

        if ($result['result']) {
            $company = $data;
            $company['ID'] = $result['result'];
            return $company;
        }

        return null;
    }

    /**
     * Поиск контактов по E-mail
     *
     * @param string $email
     *
     * @return array|null
     */
    public function getContactsByEmail(string $email): ?array
    {
        $result = \CRest::call('crm.duplicate.findbycomm', [
            'type' => 'EMAIL',
            'values' => [$email]
        ]);

        if(is_array($result['result']['CONTACT']))
        {
            return $this->getContacts($result['result']['CONTACT']);
        }

        return null;
    }

    /**
     * Поиск контактов по телефону
     *
     * @param string $phone
     *
     * @return array|null
     */
    public function getContactsByPhone(string $phone): ?array
    {
        $result = \CRest::call('crm.duplicate.findbycomm', [
            'type' => 'PHONE',
            'values' => [$phone]
        ]);

        if(is_array($result['result']['CONTACT']))
        {
            return $this->getContacts($result['result']['CONTACT']);
        }

        return null;
    }

    /**
     * @param array $contactId
     * @return array|null
     */
    public function getContacts(array $contactId): ?array
    {
        $result = \CRest::call('crm.contact.list', [
            'filter' => [
                'ID' => $contactId
            ],
            'select' => [
                'ID', 'NAME', 'LAST_NAME', 'PHONE', 'EMAIL'
            ]
        ]);

        if (!empty($result)) {
            return $result['result'];
        }

        return null;
    }

    /**
     * @param Order $order
     * @return array
     */
    public function addListener(\Bitrix\Sale\Order $order, $dealIds = false)
    {
        $result = [];
        $userID = $order->getUserId();
        foreach ($order->getBasket()->getBasketItems() as $item) {

            $courseId = $item->getProductId();
            $listenerList = [];

            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO");
            $arFilter = Array("IBLOCK_ID"=> ScheduleCoursesIblock::getId() , "PROPERTY_COURSE.ID"=>$courseId , "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while($scheduleCourse = $res->GetNextElement())
            {
                $fields = $scheduleCourse->GetFields();
                $props = $scheduleCourse->GetProperties();

                $listenerList = $props['LISTENERS']['VALUE'];

                if(is_array($listenerList)){
                    array_push($listenerList, $userID);
                    $listenerList = array_values(array_unique($listenerList));
                }else{
                    $listenerList[] = $userID;
                }

                if($dealIds){

                    $dealList = $props['DEAL_LIST']['VALUE'];

                    foreach($dealIds as $deal){
                        array_push($dealList, $deal);
                    }
                    $dealList = array_values(array_unique($dealList));

                    \CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], [
                        'LISTENERS' => $listenerList,
                        'DEAL_LIST' => $dealList
                    ]);

                }else{

                    \CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], [
                        'LISTENERS' => $listenerList
                    ]);
                }

                $result[] = $fields;
            }
        }

        return $result;
    }
    public function createTaskForPact($data){

        $linkDeal    = 'https://b24ais.ru/crm/deal/details/'.$data['deals'][0].'/';
        $linkContact = 'https://b24ais.ru/crm/contact/details/'.$data['contact']['ID'].'/';
        $linkCompany = 'https://b24ais.ru/crm/company/details/'.$data['company']['ID'].'/';
        $productData = [];

        foreach($data['products'][0]['props'] as $prop){
            switch($prop['CODE']){
                case "ARTNUMBER":
                    $productData['ARTNUMBER'] = $prop['VALUE'];
                    break;
                case "DATE":
                    $productData['START'] = $prop['VALUE'];
                    break;
                case "DATES":
                    $productData['FINISH'] = end($prop['VALUE']);
                    break;
                default: break;
            }
        }

        $titleString = "Подготовка договора на обучение, " . $productData['ARTNUMBER'] . ' / '. $productData['START'] .' - '. $productData['FINISH'];
        $descriptionString = "Ссылка на сделку: " . $linkDeal . "\n" ;
        if($data['contact']['ID']){
            $descriptionString .= "Ссылка на контакт: " . $linkContact . "\n" ;
        }
        if($data['company']['ID']){
            $descriptionString .= "Ссылка на компанию: " . $linkCompany . "\n" ;
        }

        // Создадим задачу
        $taskFields= array(
            'TITLE'          => $titleString,
            'CREATED_BY'     => 443,
            'DESCRIPTION'    => $descriptionString,
            'PRIORITY'       => 2, // высокий приоритет
            'RESPONSIBLE_ID' => 235, // ответственный 235
        );

        $createTask = \CRest::call('tasks.task.add', ['fields' => $taskFields]);
    }

    /**
     * @param int $orderId
     * @return bool
     */
    public function isSetDeal(int $orderId)
    {
        $result = CrmDealsTable::getList([
            'filter' => [
                '=UF_ORDER_ID' => $orderId
            ]
        ])->fetch();

        return !empty($result);
    }
}
