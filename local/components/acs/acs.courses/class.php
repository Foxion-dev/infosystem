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
            "IBLOCK_ID" => isset($arParams["IBLOCK_ID"])?trim($arParams["IBLOCK_ID"]):2,
            "DETAIL_URL" => isset($arParams["DETAIL_URL"])?trim($arParams["DETAIL_URL"]):SITE_DIR."courses/#SECTION_CODE#/#ELEMENT_CODE#/",
            //
            'first_hide'=>isset($arParams['first_hide'])?trim($arParams['first_hide']):'N',
            "FILTER_NAME" => count($arParams["FILTER_NAME"])?$arParams["FILTER_NAME"]:[],
            "UF_CALENDAR" => count($arParams["UF_CALENDAR"])?$arParams["UF_CALENDAR"]:false,
        ];//var_dump($result['FILTER_NAME']);
        return $result;
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
        global $USER;
        if ($this->StartResultCache(false,[($this->arParams["CACHE_GROUPS"] === "N"?false:$USER->GetGroups()),$this->arParams],'acs.courses'))
        {
            $PRODUCT_ID_ARR = [];
            $arNavStartParams = ["nTopCount" => $this->arParams["COUNT"]];
            $arSelect = ["ID","IBLOCK_ID","NAME","CODE","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","PROPERTY_SPECIALOFFER","PROPERTY_CITY","PROPERTY_DATE","DETAIL_PAGE_URL"];
            $arFilter = [
                /*">=PROPERTY_DATE" => date("Y-m-d H:i:s",time()),*/"ACTIVE"=>"Y","IBLOCK_ID"=>$this->arParams["IBLOCK_ID"]
            ];
            $arFilter = count($this->arParams["FILTER_NAME"])?array_merge($this->arParams["FILTER_NAME"],$arFilter):$arFilter;
            //
            $rsItems = CIBlockElement::GetList(["PROPERTY_DATE"=>"asc,nulls"], $arFilter, false, $arNavStartParams, $arSelect);
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

            $this->arResult["DATE"] = date("d.m.Y");
            //
            $this->SetResultCacheKeys([
                "ITEMS",
                "DATE",
            ]);
            $this->includeComponentTemplate();
        }
        return $this->arResult["DATE"];
    }
}