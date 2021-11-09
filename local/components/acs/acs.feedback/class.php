<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
//
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

Loc::loadMessages(__FILE__);

class AcsFeedbackClass extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = [
            "OK_MESSAGE" => isset($arParams["OK_MESSAGE"])?$arParams["OK_MESSAGE"]:GetMessage("MF_OK_MESSAGE"),
            "EMAIL_TO" => isset($arParams["EMAIL_TO"])?$arParams["EMAIL_TO"]:COption::GetOptionString("main", "email_from"),
            "EVENT_NAME" => isset($arParams["EVENT_NAME"])?$arParams["EVENT_NAME"]:"FEEDBACK_FORM", // letter template for feedback
            "USE_CAPTCHA" => isset($arParams["USE_CAPTCHA"])?$arParams["USE_CAPTCHA"]:"Y",
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

    public function GTU(){
        return [
            'question'=>'Оставить вопрос специалисту',
            'advertising'=>'Вопрос сотрудничества/рекламы',
            'help'=>'Не нашел в каталоге?',
        ];
    }

    public function executeComponent()
    {
        global $USER, $APPLICATION;
        $this->arResult["DATE"] = date("d/m/Y H:i");
        $this->arResult["THEMES_USER"] = $this->GTU();
        $this->arResult["PARAMS_HASH"] = md5(serialize($this->arParams).$this->GetTemplateName());
        if($this->arParams["USE_CAPTCHA"] == "Y") {
            $this->arResult["capCode"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
        }
        //
        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['go'] == 'orderContact' && check_bitrix_sessid() && (!isset($_POST["PARAMS_HASH"]) || $this->arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"])){
            $arJson = [];
            $get = $this->getHtmlSpecialChars($_POST);
            if (strlen($get["NAME"]) == 0) {
                $error['NAME'] = "Обязательное поле: Имя";
            }
            if (strlen($get["TELEFON"]) == 0) {
                $error['TELEFON'] = "Обязательное поле: Телефон";
            }
            if (strlen($get["sendCopy"]) == 0) {
                $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
            }
            if (strlen($get["EMAIL_USER"]) == 0) {
                $error['EMAIL_USER'] = "Обязательное поле: Ваш емайл";
            }
            if (strlen($get["COMMENT"]) == 0) {
                $error['COMMENT'] = "Обязательное поле: Комментарий";
            }
            // если есть мыло то проверим его
            if (strlen($get["EMAIL_USER"]) > 0) {
                /* алгоритм проверки правельного майла */
                if (!filter_var($get["EMAIL_USER"], FILTER_VALIDATE_EMAIL) === false) { /* its ok */
                } else {
                    $error['EMAIL_USER'] = "Пожалуйста введите корректный email: " . $get["EMAIL_USER"] . " ? ";
                }
            }
            if($this->arParams["USE_CAPTCHA"] == "Y")
            {
                $captcha_code = $get["captcha_sid"];
                $captcha_word = $get["captcha_word"];
                $cpt = new CCaptcha();
                $captchaPass = COption::GetOptionString("main", "captcha_password", "");
                if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
                {
                    if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
                        $error["ERROR_MESSAGE"] = GetMessage("MF_CAPTCHA_WRONG");
                }
                else
                    $error["ERROR_MESSAGE"] = GetMessage("MF_CAPTHCA_EMPTY");

            }
            if (is_array($get) && count($error) == 0) {
                $TU = $this->arResult["THEMES_USER"];
                $arEventFields = array(
					'ASC_TEST' => htmlspecialchars(trim($get["ASC_TEST"])),
                    'NAME' => htmlspecialchars(trim($get["NAME"])),
                    'TELEFON' => htmlspecialchars(trim($get["TELEFON"])),
                    'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                    'EMAIL_USER' => htmlspecialchars(trim($get["EMAIL_USER"])),
                    'MESSAGE' => "Заполнена форма. Дата " . date('d.m.Y H:i',time()) . " с темой обращения: ".$TU[$get['THEMES_USER']],
                    'COMMENT' => htmlspecialchars(trim($get["COMMENT"])),
                    'CODE' => "Заполнена форма с темой обращения: ".$TU[$get['THEMES_USER']],
                );
                CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields);
                // добавление в хидден блок и т.д.
                if (CModule::IncludeModule('acs')) {
                    $dataFields = array(
                        "UF_NAME" => $arEventFields['NAME'],
                        "UF_TELEFON" => $arEventFields['TELEFON'],
                        "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                        "UF_SENDCOPY" => true,
                        "UF_MESSAGE" => $arEventFields['MESSAGE']." | ".$arEventFields['COMMENT'],
                        "UF_CODE" => "FREE_CONSULTATION",
                        "UF_REQUEST_DATE" => date('d.m.Y H:i',time()),
                    );
					if($arEventFields['ASC_TEST'] == ''){
					    $ob_ = HiWrapper::id(3)->add($dataFields);	
					}
                }
                
                //
                ob_start();
                print '<div>Спасибо, ваше сообщение отправлено<br> и будет расмотрено в рабочее время пн-пт с 09 до 18.</div>';
                $html = ob_get_contents();
                ob_end_clean();
                //
                $arJson['jq']['html'] = array("#alert-contact-success" => $html);
                $arJson['jq']['show'] = array("#alert-contact-success" => 300);
                $arJson['jq']['hide'] = array("#alert-contact-error" => 300);
                //$arJson['jq']['hide']["form.SubmitFormAjax .input-form"] = 300; // просто схлопываем форму и т.д.
                $arJson['jq']['reset']["form.SubmitFormAjax"] = "Y"; // читсим форму
                if($this->arParams["USE_CAPTCHA"] == "Y") {
                    $capCode = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
                    $arJson['jq']['val']['form.SubmitFormAjax input.capCode'] = $capCode;
                    $arJson['jq']['html']['form.SubmitFormAjax .CAPTCHA'] = '<img src="/bitrix/tools/captcha.php?captcha_sid='.$capCode.'" width="180" height="40" alt="CAPTCHA">';
                }

            } else {
                //
                $arJson['jq']['html'] = array("#alert-contact-error" => '<small>'.implode("<br>",$error).'</small>');
                $arJson['jq']['show'] = array("#alert-contact-error" => 300);
                $arJson['jq']['hide'] = array("#alert-contact-success" => 300);
                if($this->arParams["USE_CAPTCHA"] == "Y") {
                    $capCode = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
                    $arJson['jq']['val']['form.SubmitFormAjax input.capCode'] = $capCode;
                    $arJson['jq']['html']['form.SubmitFormAjax .CAPTCHA'] = '<img src="/bitrix/tools/captcha.php?captcha_sid='.$capCode.'" width="180" height="40" alt="CAPTCHA">';
                }
            }
            $queryUrl = 'https://b24ais.ru/rest/443/brsg7aw5u717mogn/crm.lead.add.json';
            $name=trim($get["NAME_USER"]);
            $name=explode(' ',$arEventFields['NAME']);
            $queryData = http_build_query(array(
                'fields' => array(
                    'TITLE' => 'Сайт infosystems.ru обратная связь',
                    'SOURCE_ID'=>'WEB',
                    'LAST_NAME'=>$name[0],
                    'NAME'=>$name[1],
                    'SECOND_NAME'=>$name[2],
                    'PHONE'=>[['VALUE'=>$arEventFields['TELEFON'],'VALUE_TYPE'=>'WORK']],
                    'EMAIL'=>[['VALUE'=>$arEventFields['EMAIL_USER'],'VALUE_TYPE'=>'WORK']],
                    //'POST'=>$get['WORK_USER'],
                    'COMMENTS'=>$arEventFields['MESSAGE']." | ".$arEventFields['COMMENT'],
                    'OPENED'=>'Y',
                    //'UF_CRM_1552491324'=>$get['USER_TIME_FROM']." / ".$get['USER_TIME_BEFORE'],
                    //'UF_CRM_1552491299'=>$get['NUM_USER'],
                    //'UF_CRM_1552491350'=>$get['USER_CS'],
                    //'UF_CRM_1552491337'=>$get['CITY_USER']
                ),
                'params' => array("REGISTER_SONET_EVENT" => "Y")
            )); 
                // обращаемся к Битрикс24 при помощи функции curl_exec
			if($arEventFields['ASC_TEST'] == ''){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $queryUrl,
                CURLOPT_POSTFIELDS => $queryData,
            ));
			};
            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result, 1);
            //
            $APPLICATION->RestartBuffer();
            print json_encode($arJson);
            die();
        }
        //
        $this->includeComponentTemplate();
    }
}