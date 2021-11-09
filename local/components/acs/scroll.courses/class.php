<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

use Bitrix\Iblock;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock') && !\Bitrix\Main\Loader::includeModule('catalog') && !\Bitrix\Main\Loader::includeModule('sale'))
return;

Loc::loadMessages(__FILE__);

class CourseslistTable extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
			"FIELD_CODE"  => isset($arParams["FIELD_CODE"])?$arParams["FIELD_CODE"]:"",
            "CACHE_TYPE" => isset($arParams["CACHE_TYPE"])?$arParams["CACHE_TYPE"]:"A",
            "CACHE_TIME" => isset($arParams["CACHE_TIME"])?$arParams["CACHE_TIME"]:3600, // one hour
            "CACHE_GROUPS" => isset($arParams["CACHE_GROUPS"])?$arParams["CACHE_GROUPS"]:"N",
            "COUNT" => isset($arParams["COUNT"]) && intval($arParams["COUNT"])>1?intval($arParams["COUNT"]):4,
            "IBLOCK_TYPE" => isset($arParams["IBLOCK_TYPE"])?trim($arParams["IBLOCK_TYPE"]):'catalog',
            "IBLOCK_ID" => isset($arParams["IBLOCK_ID"])?trim($arParams["IBLOCK_ID"]):2,
            "FILTER_NAME" => count($arParams["FILTER_NAME"])?$arParams["FILTER_NAME"]:[],
            "UF_CALENDAR" => count($arParams["UF_CALENDAR"])?$arParams["UF_CALENDAR"]:false,
        ];//var_dump($result['FILTER_NAME']);
        return $result;
    }

    public function executeComponent()
    {
        global $USER;
        if ($this->StartResultCache(false,[($this->arParams["CACHE_GROUPS"] === "N"?false:$USER->GetGroups()),$this->arParams],'acs.courses'))
        {
            $arFilter = [];
            $arFilter = count($this->arParams["FILTER_NAME"])?array_merge($this->arParams["FILTER_NAME"],$arFilter):$arFilter;
            //

            $rsItems = CIBlockElement::GetList(["PROPERTY_DATE"=>"asc,nulls"], $arFilter, false, $arNavStartParams, $arSelect);
            $rsItems->SetUrlTemplates($this->arParams["DETAIL_URL"]);
			$oObject = $rsItems->GetNextElement();
			$arFields = $oObject->GetProperties();
			$arFiled = array();
			foreach($arFields as $keiF => $filed){
				$arFiled[$keiF]['NAME'] = $filed['NAME'];
				$arFiled[$keiF]['CODE'] = $filed['CODE'];
			}
			array_insert(
				$arFiled,
				"DURATION_DAY",
				["NAME" => [
					"NAME"   => "Наименование курса",
					"CODE" => "NAME",
				],]
			);

			$this->arResult["FILED"] = $arFiled;
	
			$rs_section = CIBlockSection::GetList(Array("LEFT_MARGIN" => "ASC"), array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y'), true, Array("NAME","ID","DEPTH_LEVEL","IBLOCK_SECTION_ID"));
			$sectionLinc = array();
			$sections = array();
			$sectionLinc[0] = &$sections;
			while($arSection = $rs_section->GetNext()) {
				$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
				$sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
			}
			$this->arResult["SECTIONS"] = $sections['CHILD'];

			$items = array();
			$arSelectElemProp = array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME",);
			$rs_element = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"),  array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y'), false, false, $arSelectElemProp);
			while($obElement = $rs_element->GetNextElement()){
				$arItem = $obElement->GetFields();
				$arItem["PROPERTIES"] = $obElement->GetProperties();
				$items[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
			}


			$this->arResult["ITEMS"] = $items;
            $this->arResult["DATE"] = date("d.m.Y");
            //
            $this->SetResultCacheKeys([
				"FILED",
				"SECTIONS",
                "ITEMS",
                "DATE",
            ]);
            $this->includeComponentTemplate();
        }
        return $this->arResult["DATE"];
    }
}