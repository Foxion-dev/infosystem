<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock') && !\Bitrix\Main\Loader::includeModule('acs') && !\Bitrix\Main\Loader::includeModule('highloadblock'))
return;

Loc::loadMessages(__FILE__);

class UserReviewsClassAdd extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
			"IS_INCOURSES" => isset($arParams["IS_INCOURSES"])?$arParams["IS_INCOURSES"]:"N",
            "CACHE_TYPE" => isset($arParams["CACHE_TYPE"])?$arParams["CACHE_TYPE"]:"A",
            "CACHE_TIME" => isset($arParams["CACHE_TIME"])?$arParams["CACHE_TIME"]:3600, // one hour
            "CACHE_GROUPS" => isset($arParams["CACHE_GROUPS"])?$arParams["CACHE_GROUPS"]:"N",
            "PAGE_TITLE" => isset($arParams["PAGE_TITLE"])?$arParams["PAGE_TITLE"]:false,
            "facebook" => isset($arParams["facebook"])?$arParams["facebook"]:false,
            "COUNT" => isset($arParams["COUNT"]) && intval($arParams["COUNT"])>1?intval($arParams["COUNT"]):10, // parsim 10 days
            'ELEMENT_ID'=>isset($arParams['ELEMENT_ID']) &&intval($arParams["ELEMENT_ID"])>0?intval($arParams['ELEMENT_ID']):0,
            'GROUP_ID'=>isset($arParams['GROUP_ID'])&&intval($arParams['GROUP_ID'])>0?intval($arParams['GROUP_ID']):0
        ];
        return $result;
    }

    public function executeComponent()
    {
        global $USER;
        //if ($this->StartResultCache(false,[($this->arParams["CACHE_GROUPS"] === "N"?false:$USER->GetGroups()),$this->arParams, date("d.m.Y")],'acs.reviews'))
        //{
            if (CModule::IncludeModule('acs')) {
                $fil = ['UF_ACTIV'=>1];
                if(!empty($this->arParams['ELEMENT_ID'])&&$this->arParams['ELEMENT_ID']>0) $fil['UF_COURSE_LINK']=$this->arParams['ELEMENT_ID'];
                if(!empty($this->arParams['GROUP_ID'])&&$this->arParams['GROUP_ID']>0) $fil['UF_COURSE_GROUP_LINK']=$this->arParams['GROUP_ID'];
                $ob = HiWrapper::id(4)->getList([
                    'select' => ['*'],
                    'order' => ['UF_DATE' => 'DESC'],
                    'limit' => '100', //ограничиваем выборку 100 элементами
                    'filter' => $fil
                ]);
                while ($el = $ob->fetch()) {
                    $el['UF_DATE'] = $el['UF_DATE']->format("d.m.Y H:i");  //2018-09-17 13:39:23.000000
                    if ($el['UF_IMG']) {
                        $el['UF_IMG'] = PRM::PR($el['UF_IMG'], $arSize = ["width" => 60, "height" => 60]); // класс для привью картинки, налету init.php
                    }
                    $this->arResult["ITEMS"][] = $el;
                }
            }
            $this->arResult["DATE"] = date("d.m.Y");
            //
          //  $this->SetResultCacheKeys([
          //      "ITEMS",
          //      "DATE",
          //  ]);
            $this->includeComponentTemplate();
        //}
        return $this->arResult["DATE"];
    }
}