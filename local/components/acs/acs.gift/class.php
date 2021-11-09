<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock') && !\Bitrix\Main\Loader::includeModule('catalog') && !\Bitrix\Main\Loader::includeModule('sale'))
return;

Loc::loadMessages(__FILE__);

class RecommendedCoursesClassList extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
            "CACHE_TYPE" => isset($arParams["CACHE_TYPE"])?$arParams["CACHE_TYPE"]:"A",
            "CACHE_TIME" => isset($arParams["CACHE_TIME"])?$arParams["CACHE_TIME"]:3600, // one hour
            "CACHE_GROUPS" => isset($arParams["CACHE_GROUPS"])?$arParams["CACHE_GROUPS"]:"N",
            "COUNT" => isset($arParams["COUNT"]) && intval($arParams["COUNT"])>1?intval($arParams["COUNT"]):4,
            "IBLOCK_TYPE" => isset($arParams["IBLOCK_TYPE"])?trim($arParams["IBLOCK_TYPE"]):'catalog',
            "IBLOCK_ID" => isset($arParams["IBLOCK_ID"])?trim($arParams["IBLOCK_ID"]):24,
            "DETAIL_URL" => isset($arParams["DETAIL_URL"])?trim($arParams["DETAIL_URL"]):SITE_DIR."gift/#ELEMENT_ID#/",
            //
            "FILTER_NAME" => count($arParams["FILTER_NAME"])?$arParams["FILTER_NAME"]:[],
            //"UF_CALENDAR" => count($arParams["UF_CALENDAR"])?$arParams["UF_CALENDAR"]:false,
        ];
        return $result;
    }
    // чистим код и т.д.
    public function getHtmlSpecialChars($get){
        if($get){
            $get = (is_array($get)?$get:[$get]);
            foreach ($get as &$g) {
                if (is_array($g)) {
                    foreach ($g as &$ga) {
                        $ga = htmlspecialchars(trim($ga));
                    }
                } else {
                    $g = htmlspecialchars(trim($g));
                }
            }
            return $get;
        }else{
            return false;
        }
    }
    // выводим первоначальную форму для заказа и т.д.
    public function getGiftBasket($get){
        //
        global $USER, $APPLICATION;
        $CURRENT_BUDGET = 0;
        $USER_ID = 0;
        $arJson = array();
        $error = array();
        //
        if($USER->IsAuthorized() && \Bitrix\Main\Loader::includeModule('iblock') && \Bitrix\Main\Loader::includeModule("sale")){
            $get['USER_ID'] = $USER_ID = $USER->GetID();
            $get['EMAIL_USER'] = $USER->GetEmail();
            $get['NAME_USER'] = $USER->GetFirstName();
            if ($arr = CSaleUserAccount::GetByUserID($USER_ID, "RUB")) {
                $get['CURRENT_BUDGET'] = $CURRENT_BUDGET = intval($arr["CURRENT_BUDGET"]);
            }
            if($CURRENT_BUDGET < $get['PRICE']){
                $error['IsAuthorized'] = "К сожалению у Вас не хватает бонусов, попробуйте пополнить личный счет";
            }
        }else{
            $error['IsAuthorized'] = "Авторизуйтесь или зарегистрируйтесь";
        }
        //
        if (is_array($get) && count($error) == 0) {
            ob_start();
            include(dirname(__FILE__) . "/inc/phones.php");
            $html = ob_get_contents();
            ob_end_clean();
            $arJson['html'] = $html;
            $arJson['title'] = "Заказ подарка за бонусы";
            $arJson['cansel'] = "Закрыть";
            $arJson['submit'] = "Отправить заказ";
            $arJson['mClass'] = 1;
        }else{
            $arJson['error'] = '<small>'.implode("<br>",$error).'</small>';
            $arJson['title'] = "Сообщение";
        }
        return $arJson;
    }
    // выводим сообщение об заказе
    public function getGiftBasketAdd($get){
        //
        global $USER, $APPLICATION;
        $USER_ID = 0;
        $get['CURRENT_BUDGET'] = 0;
        $arJson = array();
        $error = array();
        //
        if($USER->IsAuthorized() && \Bitrix\Main\Loader::includeModule('iblock') && \Bitrix\Main\Loader::includeModule("sale")){
            $get['USER_ID'] = $USER_ID = $USER->GetID();
            if ($arr = CSaleUserAccount::GetByUserID($USER_ID, "RUB")) {
                $get['BUDGET_ARR'] = $arr;
                $get['CURRENT_BUDGET'] = intval($arr["CURRENT_BUDGET"]);
            }
            if($get['CURRENT_BUDGET'] < $get['PRICE']){
                $error['IsAuthorized'] = "К сожалению у Вас не хватает бонусов, попробуйте пополнить личный счет";
            }
        }else{
            $error['IsAuthorized'] = "Авторизуйтесь или зарегистрируйтесь";
        }
        //
        if(count($get['NAME'])==0){
            $error['NAME'] = "Обязательное поле: Ваше имя";
        }
        if (strlen($get["sendCopy"]) == 0) {
            $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
        }
        if (strlen($get["EMAIL_USER"]) == 0) {
            $error['EMAIL_USER'] = "Обязательное поле: Ваш емайл";
        }
        // если есть мыло то проверим его
        if (strlen($get["EMAIL_USER"]) > 0) {
            // алгоритм проверки правельного майла
            if (!filter_var($get["EMAIL_USER"], FILTER_VALIDATE_EMAIL) === false) {
            } else {
                $error['EMAIL_USER'] = "Пожалуйста введите корректный email: " . $get["EMAIL_USER"] . " ? ";
            }
        }
        if (is_array($get) && count($error) == 0) {
            //
            $get["DATE"] = date('d.m.Y H:i',time());
            // снятие баллов
            if(!empty($get['BUDGET_ARR'])){
                $BID = $get['BUDGET_ARR']['ID'];
                $get['BUDGET_ARR']["CURRENT_BUDGET"] = $get['BUDGET_ARR']["CURRENT_BUDGET"] - intval($get['PRICE']);
                unset($get['BUDGET_ARR']['ID']);
                CSaleUserAccount::Update($BID,$get['BUDGET_ARR']);
                // JS API
                $arJson['jq']['replaceWith']['.gift-current-budget'] = '<div class="gift-current-budget">мои бонусы: <span>'.$get['BUDGET_ARR']["CURRENT_BUDGET"].'</span></div>';
            }
            // отправка сообщения об заказе подарка за бонусы
            $arEventFields = array(
                'NAME' => htmlspecialchars(trim($get["NAME"])),
                'TELEFON' => htmlspecialchars(trim($get["TELEFON"])),
                'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                'EMAIL_USER' => htmlspecialchars(trim($get["EMAIL_USER"])),
                'MESSAGE' => "Заказ подарка за баллы. Дата " . $get["DATE"] . " ID: ".$get['ID']." подарок: ".$get['TITLE']." ".$get['PRICE']." баллов. USER_ID: ".$get['USER_ID']." ".$get['NAME'],
                'COMMENT' => htmlspecialchars(trim($get["COMMENT"])),
                'CODE' => "Заказ подарка за баллы. ID: ".$get['ID']." ".$get['TITLE']." ".$get['PRICE']." баллов",
            );
            CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields);
            // добавление в хидден блок и т.д.
            if (CModule::IncludeModule('acs')) {
                $dataFields = [
                    "UF_NAME" => $arEventFields['NAME'],
                    "UF_TELEFON" => $arEventFields['TELEFON'],
                    "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                    "UF_SENDCOPY" => true,
                    "UF_MESSAGE" => $arEventFields['MESSAGE']."".($arEventFields['COMMENT']?" | ".$arEventFields['COMMENT']:""),
                    "UF_CODE" => "GIFT_ORDER_FOR_POINTS",
                    "UF_REQUEST_DATE" => $get["DATE"],
                ];
                HiWrapper::id(3)->add($dataFields);
                // запись снятие боннусов и т.д. UF_CODE  credit && debet
                $df = [
                    "UF_USER" => $get['USER_ID'],
                    "UF_ORDER" => "",
                    "UF_BONUS" => intval($get['PRICE']),
                    "UF_DATE" => $get["DATE"],
                    "UF_CODE" => 'DEBET', // запись об снятие
                ];
                HiWrapper::id(7)->add($df);
            }
            //
            $arJson['jq']['html'] = array("#alert-send-danger-success" => 'Спасибо, ваш заказ подарка за баллы принят и будит готов для вас в рабочее время пн-пт с 09 до 18.');
            $arJson['jq']['show'] = array("#alert-send-danger-success" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-error" => 300);
            $arJson['jq']['reset'] = array("form.SubmitFormAjax" => "reset");   // очистить форму убераем заполненные поля и т.д.
            $arJson['jq']['hide'][".input-form"] = 300; // просто схлопываем форму и т.д.
            $arJson['jq']['hide'][".modal-footer"] = 300; // просто схлопываем форму и т.д.
        } else {
            //
            $arJson['jq']['html'] = array("#alert-send-danger-error" => '<small>'.implode("<br>",$error).'</small>');
            $arJson['jq']['show'] = array("#alert-send-danger-error" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-success" => 300);
        }
        return $arJson;
    }


    public function getPriseArr($PRODUCT_ID_ARR, $CATALOG_GROUP_ID = Null){
        $res = [];
        $CATALOG_GROUP_ID = $CATALOG_GROUP_ID?$CATALOG_GROUP_ID:1;
        $PRODUCT_ID_ARR = is_array($PRODUCT_ID_ARR)?$PRODUCT_ID_ARR:[$PRODUCT_ID_ARR];
        if(count($PRODUCT_ID_ARR)){
            $db_res = CPrice::GetList(
                ['PRODUCT_ID'=>'ACS'],
                [
                    "PRODUCT_ID" => $PRODUCT_ID_ARR,
                    "CATALOG_GROUP_ID" => $CATALOG_GROUP_ID,
                ], false, false, ["ID","PRODUCT_ID","PRICE"]
            );
            while ($ar_res = $db_res->Fetch()){
                //
                // $res[$ar_res['PRODUCT_ID']] = number_format($ar_res['PRICE'], 0, '', ' ');
                $res[$ar_res['PRODUCT_ID']] = $ar_res['PRICE'];
            }
        }
        return $res;
    }

    public function executeComponent()
    {
        global $USER, $APPLICATION;
        $go = trim($_REQUEST["go"]);
        if($_SERVER["REQUEST_METHOD"] == "POST" && in_array($go,['getGiftBasket','getGiftBasketAdd'])) {
            // проверяем есть ли такой метод, если он есть то выполняем его
            if($me = method_exists($this,$go)) {
                // выполняем метод, предварительно чистим параметры
                if($arJson = $this->$go($this->getHtmlSpecialChars($_REQUEST))) {
                    $APPLICATION->RestartBuffer();
                    print json_encode($arJson);
                    die();
                }
            }
        }
        if ($this->StartResultCache(false,[($this->arParams["CACHE_GROUPS"] === "N"?false:$USER->GetGroups()),$this->arParams],'acs.gift'))
        {
            $PRODUCT_ID_ARR = [];
            $arNavStartParams = ["nTopCount" => $this->arParams["COUNT"]];
            $arSelect = ["ID","IBLOCK_ID","NAME","CODE","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","DETAIL_PAGE_URL"];
            $arFilter = ["ACTIVE"=>"Y","IBLOCK_ID"=>$this->arParams["IBLOCK_ID"]];
            $arFilter = count($this->arParams["FILTER_NAME"])?array_merge($this->arParams["FILTER_NAME"],$arFilter):$arFilter;
            //
            $rsItems = CIBlockElement::GetList(["PROPERTY_DATE"=>"ASC"], $arFilter, false, $arNavStartParams, $arSelect);
            $rsItems->SetUrlTemplates($this->arParams["DETAIL_URL"]);
            while($ob = $rsItems->GetNextElement()){
                $arItem = $ob->GetFields();
                $arItem['PROPERTIES'] = $ob->GetProperties();
                $PRODUCT_ID_ARR[] = $arItem['ID'];
                $this->arResult["ITEMS"][] = $arItem;
            }
            if(count($PRODUCT_ID_ARR)) {
                $PARR = $this->getPriseArr($PRODUCT_ID_ARR);
                foreach ($this->arResult["ITEMS"] as &$ITEM) {
                    $ITEM['PRICE'] = $PARR[$ITEM['ID']] ? $PARR[$ITEM['ID']] : false;
                }
            }

            //
            $this->SetResultCacheKeys([
                "ITEMS",
            ]);
            $this->includeComponentTemplate();
        }
        return $this->arResult["ITEMS"];
    }
}