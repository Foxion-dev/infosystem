<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock'))
return;

Loc::loadMessages(__FILE__);

class acsFilesVideoClass extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
            "CACHE_TYPE" => isset($arParams["CACHE_TYPE"])?$arParams["CACHE_TYPE"]:"A",
            "CACHE_TIME" => isset($arParams["CACHE_TIME"])?$arParams["CACHE_TIME"]:3600, // one hour
            "CACHE_GROUPS" => isset($arParams["CACHE_GROUPS"])?$arParams["CACHE_GROUPS"]:"N",
        ];
        return $result;
    }

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

    public function UserAddVideo($get){
        $arJson = [];
        if (strlen($get["NAME"]) == 0) {
            $error['NAME'] = "Обязательное поле: Название для галерей";
        }
        //
        if(count($_FILES['file']) && $_FILES['file']['error'] == 0) { // its ok
        }else{
            $error['file'] = "Пожалуйста добавьте картинку для анонса";
        }
        //AddMessage2Log("\n".var_export($get, true). " \n \r\n ", "get");
        //AddMessage2Log("\n".var_export($_FILES, true). " \n \r\n ", "FILES");
        //
        if (is_array($get) && count($error) == 0) {
            // файлы и т.д.
            $PROP["PHOTOS"] = [];
            if(count($_FILES['file']) && $_FILES['file']['error'] == 0) {
                //
                $PREVIEW_PICTURE = Array(
                    "name" => $_FILES["file"]["name"],
                    "size" => $_FILES["file"]["size"],
                    "tmp_name" => $_FILES["file"]["tmp_name"],
                    "type" => $_FILES["file"]["type"],
                    "old_file" => "",
                    "del" => "y",
                    "MODULE_ID" => "iblock");
            }
            //
            $el = new CIBlockElement;
            $PROP['USER_ID'] = $get['USER_ID'];
            $PROP['COURSE'] = $get['ID'];
            $PROP['YOUTUBE'] = $get['YOUTUBE'];
            $arLoadProductArray = Array(
                'MODIFIED_BY' => $get['USER_ID'], // элемент изменен текущим пользователем
                'IBLOCK_SECTION_ID' => false, // элемент лежит в корне раздела
                'IBLOCK_ID' => 7,
                'PROPERTY_VALUES' => $PROP,
                'NAME' => $get['NAME'],
                "CODE" => Cutil::translit($get['USER_ID'].'-'.$get['NAME'],"ru",["replace_space"=>"-","replace_other"=>"-"]),
                'ACTIVE' => 'N', // активен
                'PREVIEW_TEXT' => '',
                'DETAIL_TEXT' => '',
                'PREVIEW_PICTURE' => $PREVIEW_PICTURE,
            );
            $html = "";
            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $html .= '<small>ID: '.$PRODUCT_ID.'</small> ';
            }else{
                $html .= 'Ошибка: '.$el->LAST_ERROR.' ';
            }

            //
            $html .= ' Спасибо, ваше видео успешно отправлена и будет активированна в рабочее время пн-пт с 09 до 18.';
            $arJson['jq']['html'] = array("#alert-send-danger-success" => $html);
            $arJson['jq']['show'] = array("#alert-send-danger-success" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-error" => 300);
            $arJson['jq']['reset'] = array("form#user-reviews-add" => "reset");   // очистить форму убераем заполненные поля и т.д.
            $arJson['jq']['hide']["form#user-reviews-add"] = 300; // просто схлопываем форму и т.д.
            $arJson['jq']['hide'][".modal-content .modal-footer"] = 300; // просто схлопываем форму и т.д.

        }else{
            //
            $arJson['jq']['html'] = array("#alert-send-danger-error" => '<small>'.implode("<br>",$error).'</small>');
            $arJson['jq']['show'] = array("#alert-send-danger-error" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-success" => 300);
        }
        return $arJson;
    }

    public function executeComponent()
    {
        global $USER, $APPLICATION;
        $USER_ID = $USER->GetID();
        $this->arResult["DATE"] = date("d/m/Y H:i");
        $this->arResult["USER_ID"] = $USER_ID;
        $this->arResult["PARAMS_HASH"] = md5(serialize($this->arParams).$this->GetTemplateName());
        //
        $go = "UserAddVideo";
        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['go'] == $go && (!isset($_POST["PARAMS_HASH"]) || $this->arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"])) {
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
        //
        $this->includeComponentTemplate();
    }
}