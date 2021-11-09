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

class resumeClassAdd extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
            "CACHE_TYPE" => isset($arParams["CACHE_TYPE"])?$arParams["CACHE_TYPE"]:"A",
            "CACHE_TIME" => isset($arParams["CACHE_TIME"])?$arParams["CACHE_TIME"]:3600, // one hour
            "CACHE_GROUPS" => isset($arParams["CACHE_GROUPS"])?$arParams["CACHE_GROUPS"]:"N",
            "ELEMENT_ID" => isset($arParams["ELEMENT_ID"])?$arParams["ELEMENT_ID"]:0,
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
    // отправляем резюме пользователя
    public function resumeUserAdd($get){
        //
        $arJson = array();
        $error = array();
        if(count($get['NAME_USER'])==0){
            $error['NAME_USER'] = "Обязательное поле: Ваше имя";
        }
        if (strlen($get["sendCopy"]) == 0) {
            $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
        }
        if (strlen($get["EMAIL_USER"]) == 0) {
            $error['EMAIL_USER'] = "Обязательное поле: Ваш емайл";
        }
        // если есть мыло то проверим его
        if (strlen($get["EMAIL_USER"]) > 0) {
            //
            if (!filter_var($get["EMAIL_USER"], FILTER_VALIDATE_EMAIL) === false) { // its ok
            } else {
                $error['EMAIL_USER'] = "Пожалуйста введите корректный email: " . $get["EMAIL_USER"] . " ? ";
            }
        }
        //
        if(count($_FILES['file']) && $_FILES['file']['error'] == 0) { // its ok
        }else{
            $error['file'] = "Пожалуйста добавьте свой файл резюме:";
        }
        if (is_array($get) && count($error) == 0) {
            // алгоритм
            // файлы и т.д.
            $get['arFileArr'] = [];
            if(count($_FILES['file']) && $_FILES['file']['error'] == 0) {
                //
                $tmpFile = Array(
                    "name" => $_FILES["file"]["name"],
                    "size" => $_FILES["file"]["size"],
                    "tmp_name" => $_FILES["file"]["tmp_name"],
                    "type" => $_FILES["file"]["type"],
                    "old_file" => "",
                    "del" => "y",
                    "MODULE_ID" => "iblock");
                $get['arFileArr'][] = CFile::SaveFile($tmpFile,"/upload/iblock/");
            }
            // алгоритм отправки сообщения и т.д.
            $arEventFields = array(
                'NAME' => htmlspecialchars(trim($get['NAME_USER'])),
                'TELEFON' => htmlspecialchars(trim($get['TELEFON_USER'])),
                'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                'EMAIL_USER' => htmlspecialchars(trim($get['EMAIL_USER'])),
                'MESSAGE' => "Добавлено резюме. Дата " . date('d.m.Y H:i',time()) . " Отправитель: ".htmlspecialchars(trim($get['NAME_USER'])). ". Вакансия: ".htmlspecialchars(trim($get['ELEMENT_NAME'])).". ID: ".htmlspecialchars(trim($get['ELEMENT_ID'])),
                'COMMENT' => htmlspecialchars(trim($get['COMMENT_USER'])),
                'CODE' => "Добавлено резюме: ".htmlspecialchars(trim($get['NAME_USER']))." / ".htmlspecialchars(trim($get['TELEFON_USER'])),
                'EMAIL_TO'=>'Vkochukova@infosystem.ru'
                //'EMAIL_TO'=>'klomanton@gmail.com'
            );
            CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields, "Y", "49", $get['arFileArr']);
            // добавление в хидден блок и т.д.
            if (CModule::IncludeModule('acs')) {
                $dataFields = array(
                    "UF_NAME" => $arEventFields['NAME'],
                    "UF_TELEFON" => $arEventFields['TELEFON'],
                    "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                    "UF_SENDCOPY" => true,
                    "UF_MESSAGE" => $arEventFields['MESSAGE'],
                    "UF_CODE" => "RESUME_ADD",
                    "UF_REQUEST_DATE" => date('d.m.Y H:i', time()),
                );
                $ob_ = HiWrapper::id(3)->add($dataFields);
            }

            $success = true;
            if($success){
                //
                ob_start();
                print '<div>Спасибо, ваше сообщение успешно отправлено и будет расмотрено в рабочее время пн-пт с 09 до 18.</div>';
                $html = ob_get_contents();
                ob_end_clean();
                //
                //$arJson['alert'] = $html;
                //$arJson['title'] = "Сообщение";

                $arJson['jq']['html'] = array("#alert-send-danger-success" => $html);
                $arJson['jq']['show'] = array("#alert-send-danger-success" => 300);
                $arJson['jq']['hide'] = array("#alert-send-danger-error" => 300);
                $arJson['jq']['reset'] = array("form#user-reviews-add" => "reset");   // очистить форму убераем заполненные поля и т.д.
                $arJson['jq']['hide']["form#user-reviews-add"] = 300; // просто схлопываем форму и т.д.
                $arJson['jq']['hide'][".modal-content .modal-footer"] = 300; // просто схлопываем форму и т.д.
            }

        }else{
            //
            $arJson['jq']['html'] = array("#alert-send-danger-error" => '<small>'.implode("<br>",$error).'</small>');
            $arJson['jq']['show'] = array("#alert-send-danger-error" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-success" => 300);
        }
        return $arJson;
    }
    //
    public function executeComponent()
    {
        global $USER, $APPLICATION;
        $go = "resumeUserAdd";
        if($_SERVER["REQUEST_METHOD"] == "POST" && trim($_REQUEST["go"]) == $go && check_bitrix_sessid() && CModule::IncludeModule("acs") && CModule::IncludeModule("iblock")) {
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
        if ($this->StartResultCache(false,[($this->arParams["CACHE_GROUPS"] === "N"?false:$USER->GetGroups()),$this->arParams, date("d.m.Y")],'acs.resume'))
        {
            //
            $this->arResult["DATE"] = date("d.m.Y");
            //
            $this->SetResultCacheKeys([
                "DATE",
            ]);
            $this->includeComponentTemplate();
        }
        return $this->arResult["DATE"];
    }
}