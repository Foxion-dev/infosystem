<?php

use Bitrix\Main;
use	Bitrix\Main\Loader;
use	Bitrix\Sale\Order;


if (file_exists($_SERVER['DOCUMENT_ROOT'].'/local/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/local/vendor/autoload.php';

    (new \InfoSystems\App\Init\AppInitializer())();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/crest/crest.php');

Main\EventManager::getInstance()->addEventHandler("sale", "OnSalePayOrder", function($Id,$Val){
	file_put_contents(__DIR__."/log.txt",json_encode(array($Id,$Val)));
	if($Id > 0 && $Val == "Y"){
		
		$Fields = array();
		Loader::includeModule("sale");
		$Order =  Bitrix\Sale\Order::load($Id);
		$OrderProps = array();
		$PCollection = $Order->getPropertyCollection();
		foreach($PCollection as $Prop) {
			$OrderProps[$Prop->getField("CODE")] = $Prop->getValue();
		}
		
		$Basket = $Order->getBasket();
		$BItems = $Basket->getBasketItems();
		
		$Course = "<ol>";
		foreach($BItems as $BItem) {
			$BIPropertys = $BItem->getPropertyCollection();
			$CourseDate = "";
			foreach($BIPropertys as $Item){
				if($Item->getField("CODE") == "COURSE_DATE"){
					$CourseDate = $Item->getField("VALUE");
					break;
				}
			}
			$Course .= "<li>".$BItem->getField("NAME")." - ".($CourseDate == "" ? "Не выбран" : $CourseDate)."</li>";
		}
		$Course .= "</ol>";
		
		$Fields = array(
			"ID" => $Id,
			"FIO" => $OrderProps["FIO"],
			"COMPANY" => $OrderProps["COMPANY"],
			"MAIL" => $OrderProps["EMAIL"],
			"PHONE" => $OrderProps["PHONE"],
			"COURSE" => $Course,
		);
		//file_put_contents(__DIR__."/log.txt",json_encode($Fields));
		CEvent::Send("INFO_PAY_ORDER","s1",$Fields);
	}
});

Main\EventManager::getInstance()->addEventHandler("sale", "OnSaleOrderSaved", function(Bitrix\Main\Event $Event){
	$Order = $Event->getParameter("ENTITY");
	
	$IsNew = $Event->getParameter("IS_NEW");
		
	if($IsNew) {
		$PCollection = $Order->getPropertyCollection();
		foreach($PCollection as $Prop) {
			$OrderProps[$Prop->getField("CODE")] = $Prop->getValue();
		}
		
		$Commet = $Order->getField("USER_DESCRIPTION");
		
		$Basket = $Order->getBasket();
		$BItems = $Basket->getBasketItems();
		
		foreach($BItems as $BItem) {
			$BIPropertys = $BItem->getPropertyCollection();
			foreach($BIPropertys as $Item){
				if($Item->getField("CODE") == "COURSE_DATE"){
					$Commet .= $BItem->getField("NAME")." - ".$Item->getField("VALUE")."\r\n";
					break;
				}
			}
		}
		
		$Order->setField("USER_DESCRIPTION", $Commet);
		
		$NUser = new CUser;
		$NUser->Update($Order->getUserId(), array(
			"WORK_COMPANY" => $OrderProps["COMPANY"],
			"WORK_POSITION" => $OrderProps["POSITION"]
		));
		$Order->save();
	}
});

/*
Main\EventManager::getInstance()->addEventHandler("sale", "OnSaleOrderSaved", function(Bitrix\Main\Event $event){
    $order = $event->getParameter('ENTITY');
    $isNew = $event->getParameter('IS_NEW');

    if ($isNew) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/crest/crest.php');
        $propertyCollection = $order->getPropertyCollection();

        $email = $propertyCollection->getUserEmail()->getValue();
        $phone = $propertyCollection->getPhone()->getValue();
        $name  = $propertyCollection->getPayerName()->getValue();
        $userId = $order->getUserId();

        $user = \Bitrix\Main\UserTable::getList([
            'filter' => [
                '=ID' => $userId
            ],
            'limit' => 1
        ])->fetch();

        $fields = [
            'STATUS_ID' => 'NEW',
            'TITLE' => 'Оформлен заказ на сайте INFOSYSTEMS.RU',
            'NAME' => $user ? $user['NAME'] : $name,
            'LAST_NAME' => $user['LAST_NAME'],
            'EMAIL' => [[
                "VALUE_TYPE" => "WORK",
                "VALUE" => $email,
                'TYPE_ID' => "EMAIL"
            ]],
            'PHONE' => [[
                "VALUE_TYPE" => "WORK",
                "VALUE" => $phone,
                'TYPE_ID' => "PHONE"
            ]],
            'OPPORTUNITY' => $order->getPrice(),
            'CURRENCY_ID' => $order->getCurrency(),
            'COMMENTS' => $order->getField('USER_DESCRIPTION'),
            'UF_CRM_ORDER_ID' => $order->getId(),
        ];
        $products = [];
        foreach ($order->getBasket()->getBasketItems() as $item) {
            $product = \Bitrix\Iblock\ElementTable::getList([
                'filter' => [
                    '=ID' => $item->getProductId()
                ],
                'select' => ['XML_ID'],
                'limit' => 1
            ])->fetch();

            if ($product['XML_ID']) {
                $products[] = [
                    'PRODUCT_ID' => $product['XML_ID'],
                    'PRICE_EXCLUSIVE' => $item->getPrice(),
                    'QUANTITY' => $item->getQuantity()
                ];
            }
        }

        $lead = \CRest::call('crm.lead.add', ['fields' => $fields]);

        if ($lead['result']) {
            \CRest::call('crm.lead.productrows.set', ['id' => $lead['result'], 'rows' => $products]);
        }

    }
});
*/
Main\EventManager::getInstance()->addEventHandler('main', 'OnBeforeEventAdd', array('EventMain', 'OnBeforeEventAddHandler'));
Main\EventManager::getInstance()->addEventHandler('main', 'OnAfterUserAdd', array('EventMain', 'OnAfterUserAddHandler'));

class EventMain {

	private static $UserLogin = "";
	private static $UserPass = "";

	public static function OnAfterUserAddHandler($Fields) {
		self::$UserLogin = $Fields['LOGIN'];
		self::$UserPass = $Fields['CONFIRM_PASSWORD'];
	}

	public static function OnBeforeEventAddHandler(&$Event, &$Lid, &$Fields) {
		if($Event == "SALE_NEW_ORDER"){
			if (self::$UserPass == "") {
				$Fields['LOG_PASS'] = '';
			} else {
				$Fields['LOG_PASS'] = "\r\n".'Ваш логин: '.self::$UserLogin;
				$Fields['LOG_PASS'] .= "\r\n".'Ваш пароль: '.self::$UserPass."\r\n";
			}
		}
	}
}

/* Отладочная функция для вывода информации в необходимом виде */
function p($text, $p = Null, $all = Null) {
    global $USER;
    if ($USER->IsAdmin() || $all == "all") {
        echo "<pre>";
        if($p == "p") {
            print_r($text);
        } elseif($p == "export") {
            var_export($text);
        } else {
            var_dump($text);
        }
        echo "</pre>";
    }
}

/*
* функция для обрезки текста
*/
function my_crop($text, $length, $clearTags = true)
{
    $text = trim($text);
    if ($clearTags === true)
        $text = strip_tags($text);
    if ($length <= 0 || strlen($text) <= $length)
        return $text;
    $out = mb_substr($text, 0, $length);
    $pos = mb_strrpos($out, ' ');
    if ($pos)
        $out = mb_substr($out, 0, $pos);
    return $out.'…';
}


/* функция для поиска в массиве строки вхождения  strpos */
function strpos_arr($haystack, $needle) {
    if(!is_array($needle)){$needle = array($needle);}
    foreach($needle as $what) {
        $pos = strpos($haystack, $what);
        if($pos !== false){return true;}
    }
    return false;
}

/*
* Транслитерация файлов
$name = "Текст*89";
$arParams = array("replace_space"=>"-","replace_other"=>"-");
$trans = Cutil::translit($name,"ru",$arParams);
*/
function translit($text){
    $trans = array(
        "а" => "a",        "б" => "b",        "в" => "v",        "г" => "g",
        "д" => "d",        "е" => "e",        "ё" => "e",        "ж" => "zh",
        "з" => "z",        "и" => "i",        "й" => "y",        "к" => "k",
        "л" => "l",        "м" => "m",        "н" => "n",        "о" => "o",
        "п" => "p",        "р" => "r",        "с" => "s",        "т" => "t",
        "у" => "u",        "ф" => "f",        "х" => "kh",        "ц" => "ts",
        "ч" => "ch",        "ш" => "sh",        "щ" => "shch",        "ы" => "y",
        "э" => "e",        "ю" => "yu",        "я" => "ya",        "А" => "A",
        "Б" => "B",        "В" => "V",        "Г" => "G",        "Д" => "D",
        "Е" => "E",        "Ё" => "E",        "Ж" => "Zh",        "З" => "Z",
        "И" => "I",        "Й" => "Y",        "К" => "K",        "Л" => "L",
        "М" => "M",        "Н" => "N",        "О" => "O",        "П" => "P",
        "Р" => "R",        "С" => "S",        "Т" => "T",        "У" => "U",
        "Ф" => "F",        "Х" => "Kh",        "Ц" => "Ts",        "Ч" => "Ch",
        "Ш" => "Sh",        "Щ" => "Shch",        "Ы" => "Y",        "Э" => "E",
        "Ю" => "Yu",        "Я" => "Ya",        "ь" => "",        "Ь" => "",
        "ъ" => "",        "Ъ" => "",        "—" => "-",
    );
    if(preg_match("/[а-яА-Яa-zA-Z\.]/", $text)) {
        return strtr($text, $trans);
    }
    else {
        return $text;
    }
}


/* класс вспомогательный для переменных и т.д. */
class PRM {
    // PRM::PR($PREVIEW_PICTURE, $arSize = array("width" => 50, "height" => 50)); класс для привью картинки, налету
    public static function PR($PREVIEW_PICTURE, $arSize, $filter=Null){
        if(CModule::IncludeModule("iblock") && CModule::IncludeModule("main")){
            $arPR = array();
            $arPR = array_merge(array('ID' => $PREVIEW_PICTURE), array_change_key_case(CFile::ResizeImageGet(
                $PREVIEW_PICTURE,
                $arSize,
                ($filter ? $filter : BX_RESIZE_IMAGE_EXACT),
                true
            ),CASE_UPPER));
            return $arPR;
        }
    }
    // возвращает протокол на каком сидит сайт
    public static function isHttps(){
        $isHttps = !empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']);
        return ($isHttps?"https://":"http://");
    }
    // возвращает картинку заглушку  PRM::SRC()
    public static function SRC($s=Null){
        $src = '/images/nofoto/nofoto.png'; // 300 x 300
        $src = ($s==120?'/images/nofoto/nofoto120.png':$src);
        $src = ($s==160?'/images/nofoto/nofoto160.png':$src);
        $src = ($s==220?'/images/nofoto/nofoto220.png':$src);
        $src = ($s==400?'/images/nofoto/nofoto400.png':$src);
        $src = ($s==500?'/images/nofoto/nofoto500.png':$src);
        $src = ($s==800?'/images/nofoto/nofoto800.png':$src);
        return $src;
    }
}
/* отложенная функция возвращает необходимые классы */
/* sidebar-left sidebar-right two-sidebars */
function screenMenuClass(){
    global $APPLICATION;
    if(!$APPLICATION->GetPageProperty('screen_menu','')){
        return "";
    }else{
        return $APPLICATION->GetPageProperty("screen_menu");
    }
}
function mainClass(){
    global $APPLICATION;
    if(!$APPLICATION->GetPageProperty('section_class','')){
        return "main";
    }else{
        return $APPLICATION->GetPageProperty("section_class");
    }
}
function shareYandex(){
    global $APPLICATION;
    return (!$APPLICATION->GetPageProperty('shareYandex','')?"":'<div class="the-cards-date-share"><div class="ya-share2" data-limit="0" data-services="vkontakte,facebook,odnoklassniki,whatsapp,telegram"></div></div>');
}
function particlesBG(){
    global $APPLICATION;
    return (!$APPLICATION->GetPageProperty('particlesBG','')?"":'<div class="particles-bg-5" id="particles-bg-5"></div>');
}

AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error()
{
    if (defined("ERROR_404") && ERROR_404=="Y")
    {
        global $APPLICATION;
        $GetCurPage_ = $APPLICATION->GetCurPage();
        $LocalRedirect_ = "/404/";
        if($GetCurPage_ != $LocalRedirect_) LocalRedirect($LocalRedirect_);
    }
}


//
AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');
AddEventHandler('form', 'onAfterResultUpdate', 'my_onAfterResultAddUpdate');
function my_onAfterResultAddUpdate($WEB_FORM_ID, $RESULT_ID){
    // действие обработчика распространяется только на форму с ID=3
    if ($WEB_FORM_ID == 3){
        /*// запишем в дополнительное поле 'USER_IP' IP-адрес пользователя
        CFormResult::SetField($RESULT_ID, 'USER_IP', $_SERVER["REMOTE_ADDR"]);
        //
        $rsResultForm = CFormResult::GetByID($RESULT_ID)->Fetch();
        // запись в лог $_SERVER["DOCUMENT_ROOT"]."/log.txt"
        AddMessage2Log("\n".var_export($rsResultForm, true). " \n \r\n ", "_rsResultForm");*/
    }
}
// формат для вывода валюты на сайте для RUB
AddEventHandler("currency", "CurrencyFormat", "myFormat");
function myFormat($fSum, $strCurrency){
    if($strCurrency=='RUB') {
        return number_format($fSum, 0, '', ' ')." ₽";
    }
}
/*
You can place here your functions and event handlers

AddEventHandler("module", "EventName", "FunctionName");
function FunctionName(params)
{
	//code
}
*/
function updateCourseDates(){
    CModule::IncludeModule('iblock');
    //.' 23:59:59'
    $res=CIBlockElement::GetList(['PROPERTY_DATE'=>'ASC'],['<=PROPERTY_DATES'=>date('Y-m-d H:i:s'),'IBLOCK_ID'=>2],false,false,['ID','PROPERTY_DATE','PROPERTY_DATES']);
    $ids=[];
    while($r=$res->Fetch()) $ids[]=$r['ID'];
    $ids=array_unique($ids);
    global $DB;
    foreach($ids as $id){
        $f=CIBlockElement::GetProperty(2,$id,[],['CODE'=>'DATES',]);
        $dates=[];
        while($p=$f->Fetch()) $dates[]=$p['VALUE'];
        $date_c=date('d.m.Y').' 23:59:59';
        $new_dates=[];
        foreach($dates as $key=>$date){
        	if($key%2==0){
        		if($DB->CompareDates($date,$date_c)>0){
        			$new_dates[]=$date;
        			$new_dates[]=$dates[$key+1];
        		}
        	}
        }
        if(empty($new_dates)){
            CIBlockElement::SetPropertyValuesEx($id,2,['DATE'=>false]);
            CIBlockElement::SetPropertyValuesEx($id,2,['DATES'=>false]);
        }else{
            CIBlockElement::SetPropertyValuesEx($id,2,['DATE'=>$new_dates[0]]);
            CIBlockElement::SetPropertyValuesEx($id,2,['DATES'=>$new_dates]);
        }
    }
    return 'updateCourseDates();';
}

/*Для вставки в массив*/
function array_insert(&$array, $position, $insert)
{
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos   = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
}

function logger($message){
    $log_dirname = $_SERVER['DOCUMENT_ROOT'].'/logs';
    if (!file_exists($log_dirname)) {
        mkdir($log_dirname, 0777, true);
    }
    $log_file_data = $log_dirname . '/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, date("H:i:s") . ' - ' . $message . "\n", FILE_APPEND);
}
// событие изменения статуса заказа битрикс

// \Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleStatusOrderChange', 'OnSaleStatusOrderChange');

//   function OnSaleStatusOrderChange($event)
//   {
//     $parameters = $event->getParameters();

//     // logger($message = "EVENT");
//     // logger($message = print_r($event, true));
//     $order = $parameters['ENTITY'];
//     $personType = $order->getPersonTypeId();
//     logger($message = "лицо");
//     logger($message = print_r($personType, true));
//     if ($parameters['VALUE'] === 'P' && $personType == 1){ // если статус "оплачен" и физ лицо

//       /** @var \Bitrix\Sale\Order $order */
      
//       $propertyCollection = $order->getPropertyCollection();
//       $arProps = $propertyCollection->getArray();

//       $basket = $order->getBasket();
//       $basketItems = $basket->getBasketItems(); 
//       $data = [];

//       $data['currency'] = $order->getCurrency();
//       $data['comment'] = $order->getField('USER_DESCRIPTION');
//       $data['price'] = $order->getPrice();
//       $data['orderId'] = $order->getId();

//       foreach ($basketItems as $key => $basketItem) {
//             $data['basket'][$key] = array(
//                 'xmlId' => $basketItem->getField('XML_ID'),
//                 'name' => $basketItem->getField('NAME'),
//                 'date' => $basketItem->getField('COURSE_DATE'),
//                 'productId' => $basketItem->getProductId(),
//                 'price' => $basketItem->getPrice(),
//                 'quantity' => $basketItem->getQuantity(),
//                 'finalPrice' => $basketItem->getFinalPrice()
//             );
//         }
//     //   logger($message = "props");
//     //   logger($message = print_r($arProps['properties'], true));
    


//         foreach($arProps['properties'] as $prop){
//             switch($prop['ID']){
//                 case 1: // фио
//                     $data['name'] = $prop['VALUE'][0];
//                 break;
//                 // case 22:
//                 //     $data['countListeners'] = $prop['VALUE'][0];
//                 // break;
//                 // case 23:
//                 //     $data['formOfStudy'] = $prop['VALUE'][0];
//                 // break;
//                 // case 24:
//                 //     $data['placeOfStudy'] = $prop['VALUE'][0];
//                 // break;
//                 case 26:
//                     $data['requisites'] = $prop['VALUE'][0];
//                 break;
//                 case 20:
//                     $data['company'] = $prop['VALUE'][0];
//                 break;
//                 case 21:
//                     $data['positionInCompany'] = $prop['VALUE'][0];
//                 break;
//                 case 2:
//                     $data['email'] = $prop['VALUE'][0];
//                 break;
//                 case 3:
//                     $data['phone'] = $prop['VALUE'][0];
//                 case 27:
//                     $data['agreement'] = ($prop['VALUE'][0] == 'Y') ? 'Да' : 'Нет';
//                 break;
//                 default: break;
//             }
//         }
//         // logger($message = "data");
//         // logger($message = print_r($data, true));


//         $contactID = '';


//         // Определим/создадим контакт 

//         $findUser = CRest::call('crm.duplicate.findbycomm', [
//             'type' => 'EMAIL',
//             'values' => [$data['email']]
//         ]);

//         //  logger($message = "findContact");
//         //  logger($message = print_r($findUser, true));

//         if($findUser['result']['CONTACT'][0]){ // если есть такой контакт
//             $contactID = $findUser['result']['CONTACT'][0];
//         }else{

//             $addContact = CRest::call(
//                 'crm.contact.add',
//                 [
//                     'fields' =>[
//                         'NAME' => $data['name'],
//                         'EMAIL' => [[
//                             "VALUE_TYPE" => "WORK",
//                             "VALUE" => $data['email'],
//                             'TYPE_ID' => "EMAIL"
//                         ]],
//                         'PHONE' => [[
//                             "VALUE_TYPE" => "WORK",
//                             "VALUE" => $data['phone'],
//                             'TYPE_ID' => "PHONE"
//                         ]],
//                         "UF_CRM_1611671435" => 'Город',
//                         "UF_CRM_1611664039" => $data['agreement'],
//                     ]
//                 ]);
//             $contactID = $addContact['result'];

//                 // logger($message = "addContactb24");
//                 // logger($message = print_r($addContact, true));
//         }
//         $fields = [
//             'STATUS_ID' => '10',
//             'TITLE' => 'Оплачен заказ на сайте INFOSYSTEMS.RU',
//             // 'NAME' => $data['name'],
//             'CONTACT_IDS' => [$contactID],
//             // 'EMAIL' => [[
//             //     "VALUE_TYPE" => "WORK",
//             //     "VALUE" => $data['email'],
//             //     'TYPE_ID' => "EMAIL"
//             // ]],
//             // 'PHONE' => [[
//             //     "VALUE_TYPE" => "WORK",
//             //     "VALUE" => $data['phone'],
//             //     'TYPE_ID' => "PHONE"
//             // ]],
//             "OPENED" => "Y",
//             'OPPORTUNITY' => $data['price'],
//             'CURRENCY_ID' => $data['currency'],
//             // 'COMMENTS' => $data['comment'],
//             'UF_CRM_ORDER_ID' => $data['orderId'],
//             'UF_CRM_1580283395' => 881, // физ лицо
//             'UF_CRM_1545219874' => $contactID,
//             'UF_CRM_1428234039' => 'moskow',
//             'CLIENT' => $contactID
//         ];

//         $products = [];

//         foreach($data['basket'] as $basketItem){
//             $products[] = array(
//                 'PRODUCT_NAME' => $basketItem['name'],
//                 'PRODUCT_ID' => $basketItem['xmlId'],
//                 'PRICE_EXCLUSIVE' => $basketItem['price'],
//                 'QUANTITY' => $basketItem['quantity']
//             );
//         }

//         $deal = CRest::call('crm.deal.add', ['fields' => $fields]);

//         logger($message = "adddealb24");
//         logger($message = print_r($deal, true));
//         logger($message = "adddealb24fields");
//         logger($message = print_r($fields, true));

//         if ($deal['result']) {
//             $productsB24 = CRest::call('crm.deal.productrows.set', ['id' => $deal['result'], 'rows' => $products]);
//             logger($message = "addLeadb24Products");
//             logger($message = print_r($productsB24, true));
//         }

//     }

//     return new \Bitrix\Main\EventResult(
//       \Bitrix\Main\EventResult::SUCCESS
//     );
//   }

