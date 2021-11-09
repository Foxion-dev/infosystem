<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock') && !\Bitrix\Main\Loader::includeModule('highloadblock'))
return;

Loc::loadMessages(__FILE__);

class selectClassAdd extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
            "CACHE_TYPE" => isset($arParams["CACHE_TYPE"])?$arParams["CACHE_TYPE"]:"A",
            "CACHE_TIME" => isset($arParams["CACHE_TIME"])?$arParams["CACHE_TIME"]:3600, // one hour
            "CACHE_GROUPS" => isset($arParams["CACHE_GROUPS"])?$arParams["CACHE_GROUPS"]:"N",
            "IBLOCK_TYPE" => isset($arParams["IBLOCK_TYPE"])?$arParams["IBLOCK_TYPE"]:"catalog",
            "IBLOCK_ID" => isset($arParams["IBLOCK_ID"])?$arParams["IBLOCK_ID"]:2,
            'SECTION_ID'=>isset($arParams['SECTION_ID'])?$arParams['SECTION_ID']:0
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
    public function my_crop($text, $length, $clearTags = true){
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
    //
    public function textOut($name, $text = Null){
        $SECT_HTML = '<h5>'.$name.'</h5>';
        if($text):
            $text = strip_tags($text);
            $out = mb_substr($text, 0, 250);
            $pos = mb_strrpos($out, ' ');
            if ($pos)
                $out = mb_substr($out, 0, $pos);
        $SECT_HTML .= '<p id="infoBlockMyCrop">'.$out.'</p>';
        $SECT_HTML .= '<p id="infoBlockHide" style="display: none">'.substr($text,$pos).'</p>';
        $SECT_HTML .= '<a class="hide-more" href="#"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Подробнее</span></a>';
        endif;
        return $SECT_HTML;
    }
    //
    public function AcsSelectListChild($get){
        $arJson = array();
        $error = array();
        if(strlen($get['SECTION_ID'])==0){
            $error['SECTION_ID'] = "SECTION_ID";
        }
        if(intval($get['SECTION_ID'])>0){
            $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y', 'ID'=>$get['SECTION_ID'],'ELEMENT_SUBSECTIONS'=>'Y');
            $list = CIBlockSection::GetList(['SORT'=>'ASC'], $arFilter, true, ['ID','NAME','CODE','SORT','SECTION_PAGE_URL','PICTURE','DESCRIPTION','IBLOCK_SECTION_ID']);
            //$get['']
            if($ar = $list->GetNext()){
                //
                $get['SECTION_ARR'] = $ar;
            }
        }
        if (is_array($get) && count($error) == 0) {
            //
            $SECT = $get['SECTION_ARR'];
            $SECT_HTML = $this->textOut($SECT['NAME'],$SECT['DESCRIPTION']);
            //$SECT_HTML = '<h5>'.$SECT['NAME'].'</h5><p id="infoBlockMyCrop">'.$this->my_crop($SECT['DESCRIPTION'],250).'</p><p id="infoBlockHide" style="display: none">'.strip_tags($SECT['DESCRIPTION']).'</p>';
            //$SECT_HTML .= $SECT['DESCRIPTION']?'<a class="hide-more" href="#"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Подробнее</span></a>':'';
            $SECT_HTML .= '<button type="button" class="button button--common button--primary" data-replace="'.$SECT['SECTION_PAGE_URL'].'">Загрузить полное расписание данного направления</button>';
            $arJson['jq']['html']['div.info-block-body-right'] = $SECT_HTML;
            $arJson['jq']['show']["div.coursers-line-name-body"] = 300;
            $SP = intval($SECT['PICTURE'])>0?CFile::GetPath($SECT['PICTURE']):'/images/nofoto/nofoto.png';
            
            $arJson['jq']['replaceWith']["div.info-block-body img"] = '<img src="'.$SP.'">';
            if($SECT['NAME']=='') $arJson['jq']['replaceWith']["div.info-block-body img"] = '<img src="'.$SP.'" style="display:none">';
        }
        return $arJson;
    }
    // формируем селект
    public function AcsSelectList($get){
        //
        $arJson = array();
        $error = array();
        $get['ITEMS'] = [];
        if(strlen($get['SECTION_ID'])==0){
            $error['SECTION_ID'] = "SECTION_ID";
        }
        //
        if(intval($get['SECTION_ID'])>0){
            $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y', 'ID'=>$get['SECTION_ID'],'ELEMENT_SUBSECTIONS'=>'Y');
            $list = CIBlockSection::GetList(['SORT'=>'ASC'], $arFilter, true, ['ID','NAME','CODE','SORT','SECTION_PAGE_URL','PICTURE','DESCRIPTION','IBLOCK_SECTION_ID','UF_FULL_SCHEDULE']);
            if($ar = $list->GetNext()){
                //
                $get['SECTION_ARR'] = $ar;
            }
        }

        if (is_array($get) && count($error) == 0) {
            // алгоритм
            $html = '';
            $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y', 'SECTION_ID'=>$get['SECTION_ID']);
            $list = CIBlockSection::GetList(['SORT'=>'ASC'], $arFilter, false, ['ID','NAME','CODE','SORT','SECTION_PAGE_URL','PICTURE','DESCRIPTION','IBLOCK_SECTION_ID','UF_FULL_SCHEDULE']);
            $html.="<option value='all'>Все</option>";
            $get['ITEMS'][]=['ID'=>'all'];
            while($ar = $list->GetNext()){
                //
                $get['ITEMS'][] = $ar;
                $html .= '<option value="'.$ar['ID'].'">'.$ar['NAME'].'</option>';
            }
            //
            $success = true;
            if($success){
                //
                if(strlen($html)>0){
                    $arJson['jq']['show']['div.coursers-line-name-body'] = 300;
                    $SECT = !empty($get['ITEMS'][0])?$get['ITEMS'][0]:$get['SECTION_ARR'];
                    $SECT_HTML = $this->textOut($SECT['NAME'],$SECT['DESCRIPTION']);
                    //$SECT_HTML = '<h5>'.$SECT['NAME'].'</h5><p id="infoBlockMyCrop">'.$this->my_crop($SECT['DESCRIPTION'],250).'</p><p id="infoBlockHide" style="display: none">'.strip_tags($SECT['DESCRIPTION']).'</p>';
                    //$SECT_HTML .= $SECT['DESCRIPTION']?'<a class="hide-more" href="#"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Подробнее</span></a>':'';
                    //$SECT_HTML .= '<button type="button" class="button button--common button--primary" data-replace="'.$SECT['SECTION_PAGE_URL'].'">Загрузить полное расписание данного направления</button>';
                    $arJson['jq']['html']['div.info-block-body-right'] = $SECT_HTML;
                    $SP = intval($SECT['PICTURE'])>0?CFile::GetPath($SECT['PICTURE']):'/images/nofoto/nofoto.png';
                    $arJson['jq']['replaceWith']["div.info-block-body img"] = '<img src="'.$SP.'">';
                    if($SECT['NAME']==''){$arJson['jq']['replaceWith']["div.info-block-body img"] = '<img src="'.$SP.'" style="display:none;">';}
                }else{
                    //
                    $SECT = !empty($get['ITEMS'][0])?$get['ITEMS'][0]:$get['SECTION_ARR'];
                    $SECT_HTML = $this->textOut($SECT['NAME'],$SECT['DESCRIPTION']);
                    //$SECT_HTML = '<h5>'.$SECT['NAME'].'</h5><p id="infoBlockMyCrop">'.$this->my_crop($SECT['DESCRIPTION'],250).'</p><p id="infoBlockHide" style="display: none">'.strip_tags($SECT['DESCRIPTION']).'</p>';
                    //$SECT_HTML .= $SECT['DESCRIPTION']?'<a class="hide-more" href="#"> <span>Подробнее</span></a>':'';
                    $SECT_HTML .= '<button type="button" class="button button--common button--primary" data-replace="'.$SECT['SECTION_PAGE_URL'].'">Загрузить полное расписание данного направления</button>';
                    $arJson['jq']['html']['div.info-block-body-right'] = $SECT_HTML;
                    $arJson['jq']['hide']["div.coursers-line-name-body"] = 300;
                    $SP = intval($SECT['PICTURE'])>0?CFile::GetPath($SECT['PICTURE']):'/images/nofoto/nofoto.png';
                    $arJson['jq']['replaceWith']["div.info-block-body img"] = '<img src="'.$SP.'">';
                    if($SECT['NAME']==''){$arJson['jq']['replaceWith']["div.info-block-body img"] = '<img src="'.$SP.'" style="display:none;">';}
                }
                $arJson['jq']['html']['select#coursers-line-name'] = $html;
                $arJson['jq']['remove']['div.coursers-line-name'] = 'Y';
            }

        }
        return $arJson;
    }
    //
    public function executeComponent()
    {
        
        global $USER, $APPLICATION;
        $go = trim($_REQUEST["go"]);
        if($_SERVER["REQUEST_METHOD"] == "POST" && in_array($go,["AcsSelectList","AcsSelectListChild"]) && CModule::IncludeModule("iblock")) {
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
        //if ($this->StartResultCache(false,[($this->arParams["CACHE_GROUPS"] === "N"?false:$USER->GetGroups()),$this->arParams, date("d.m.Y")],'acs.select'))
        //{
            
            //
            $this->arResult["DATE"] = date("d.m.Y");
            //
            $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y','ELEMENT_SUBSECTIONS'=>'Y','SECTION_ID'=>false);
            
            $list = CIBlockSection::GetList(['SORT'=>'ASC'], $arFilter, true, ['ID','NAME','CODE','SORT','SECTION_PAGE_URL','PICTURE','DESCRIPTION', 'IBLOCK_SECTION_ID','UF_FULL_SCHEDULE']);
            //$this->arResult["ITEMS"][]
            while($ar = $list->GetNext()){
                $ar['UF_FULL_SCHEDULE']=CFile::GetPath($ar['UF_FULL_SCHEDULE']);
                $this->arResult["ITEMS"][] = $ar;
            }
            if($this->arResult["ITEMS"][0]['ID'] && count($this->arResult["ITEMS"])){
                $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y', 'SECTION_ID'=>$this->arResult["ITEMS"][0]['ID']);
                $list = CIBlockSection::GetList(['SORT'=>'ASC'], $arFilter, true, ['ID','NAME','CODE','SORT','SECTION_PAGE_URL','PICTURE','DESCRIPTION','IBLOCK_SECTION_ID','UF_FULL_SCHEDULE']);
                //$this->arResult["CHILD"][]=['ID'=>'all'];
                while($ar = $list->GetNext()){
                    $ar['UF_FULL_SCHEDULE']=CFile::GetPath($ar['UF_FULL_SCHEDULE']);
                    $this->arResult["CHILD"][] = $ar;
                }
            }
            //
            
            if($this->arParams['SECTION_ID']>0){
                $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y','ELEMENT_SUBSECTIONS'=>'Y',"CNT_ACTIVE"=>true);
                $arFilter['SECTION_ID']=$this->arParams['SECTION_ID'];
                $list = CIBlockSection::GetList(['SORT'=>'ASC'], $arFilter, true, ['ID','ELEMENT_CNT','NAME','CODE','SORT','SECTION_PAGE_URL','PICTURE','DESCRIPTION','IBLOCK_SECTION_ID','UF_FULL_SCHEDULE']);
                $this->arResult["CHILD"]=[];
                while($ar = $list->GetNext()){
                    $ar['UF_FULL_SCHEDULE']=CFile::GetPath($ar['UF_FULL_SCHEDULE']);
                    $this->arResult["CHILD"][] = $ar;
                }
            }else{
                $this->arResult["CHILD"]=[];
            }
           // $this->SetResultCacheKeys([
            //    "DATE",
            //    "ITEMS",
           //     "CHILD",
          //  ]);
          //var_dump($this->arResult);
            $this->includeComponentTemplate();
        //}
        return $this->arResult["DATE"];
    }
}