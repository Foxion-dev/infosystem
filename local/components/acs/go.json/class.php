<?
use Bitrix\Main;
use Bitrix\Sale;
use Bitrix\Main\Localization\Loc;
//
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!\Bitrix\Main\Loader::includeModule('iblock') && !\Bitrix\Main\Loader::includeModule('acs') && !\Bitrix\Main\Loader::includeModule('highloadblock') && !\Bitrix\Main\Loader::includeModule('catalog') && !\Bitrix\Main\Loader::includeModule('sale'))
return;

Loc::loadMessages(__FILE__);

class JsonGo extends \CBitrixComponent
{
    protected $currentFuser = null;
    //
    protected function getFuserId(){
        if ($this->currentFuser === null){
            $this->loadCurrentFuser();
        }
        return $this->currentFuser;
    }
    protected function loadCurrentFuser(){
        $this->currentFuser = Sale\Fuser::getId(true);
    }
    public function getCar(){
        $res = [];
        $res["TOTAL_PRICE"] = \Bitrix\Sale\BasketComponentHelper::getFUserBasketPrice($this->getFuserId(), $this->getSiteId());
        $res["NUM_PRODUCTS"] = \Bitrix\Sale\BasketComponentHelper::getFUserBasketQuantity($this->getFuserId(), $this->getSiteId());
        return $res;
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
    // тут проверка на покупку курса
    public function getUserCurs($USER_ID,$REL){
        $res = false;
        return $res;
    }
    //
    public function getSeminarByID($EOFS_ID){
        global $DB, $USER, $APPLICATION;
        $dt = false;
        if($EOFS_ID) {
            $arFilter = Array(
                "IBLOCK_ID" => 6,
                "ID" => $EOFS_ID,
            );
            $res = CIBlockElement::GetList(Array("PROPERTY_DAT" => "ASC", "SORT" => "ASC"), $arFilter, false, [], ['ID', 'NAME', 'PROPERTY_DAT']);
            if ($af = $res->GetNext()) {
                //
                $dt = FormatDateFromDB($af['PROPERTY_DAT_VALUE'], 'DD MMMM в HH:MI');
            }
        }
        return $dt;
    }
    // вызов формы для звонка
    public function OrderPhonesForm(){
        $arJson = [];
        ob_start();
        include(dirname(__FILE__) . "/inc/phones.php");
        $html = ob_get_contents();
        ob_end_clean();
        $arJson['html'] = $html;
        $arJson['title'] = "Заказать звонок";
        $arJson['cansel'] = "Закрыть";
        $arJson['submit'] = "Заказать";
        $arJson['mClass'] = 1;
        return $arJson;
    }
    // коммерческое предложение и т.д.
    public function CommercialOffer($get){
        $arJson = array();
        $error = array();
        //
        if (strlen($get["NAME_USER"]) == 0) {
            $error['NAME_USER'] = "Обязательное поле: Имя";
        }
        if (strlen($get["TELEFON_USER"]) == 0) {
            $error['TELEFON_USER'] = "Обязательное поле: Телефон";
        }
        if (strlen($get["sendCopy"]) == 0) {
            $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
        }
        if (strlen($get["EMAIL_USER"]) == 0) {
            $error['EMAIL_USER'] = "Обязательное поле: Ваш емайл";
        }
        // если есть мыло то проверим его
        if (strlen($get["EMAIL_USER"]) > 0) {
            /* алгоритм проверки правельного майла */
            if (!filter_var($get["EMAIL_USER"], FILTER_VALIDATE_EMAIL) === false) { /* its ok */
            } else {
                $error['EMAIL_USER'] = "Пожалуйста введите корректный email: " . $get["EMAIL_USER"] . " ? ";
            }
        }
        //
        if (is_array($get) && count($error) == 0) {
            // формируем сообщение
            $CS = ['officer'=>'КП официальное','notofficer'=>'КП не официальное'];
            $get['USER_CS'] = $CS[$get['USER_CS']];
            $get['DISPATCH'] = (isset($get['DISPATCH']) && trim($get['DISPATCH'])=='Y'?"Я соглашаюсь получать новостные рассылки АИС":"Я не хочу получать новостные рассылки АИС");
            $get['MESSAGE'] = [
                "Ф.И.О: ". $get['NAME_USER'],
                "Должность: ". $get['WORK_USER'],
                "Количество человек: ".$get['NUM_USER'],
                $get['CITY_USER'],
                $get['USER_TIME_FROM']." / ".$get['USER_TIME_BEFORE'],
                $get['USER_CS'],
                $get['COMMENT'],
                $get['DISPATCH'],
            ];

            /* отправляем на почту и т.д. */
            $arEventFields = array(
                'NAME' => htmlspecialchars(trim($get["NAME_USER"])),
                'TELEFON' => htmlspecialchars(trim($get["TELEFON_USER"])),
                'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                'EMAIL_USER' => htmlspecialchars(trim($get["EMAIL_USER"])),
                'MESSAGE' => "Заполнена форма: ".htmlspecialchars(trim($get['CODE']))." Курс: ID-".$get['ID']." ".$get['ELEMENT_NAME']." ".implode(" / ",$get['MESSAGE']),
                'CODE' => htmlspecialchars(trim($get['CODE'])),
            );
            CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields);
            // добавление в хидден блок и т.д.
            if (CModule::IncludeModule('acs')) {
                $dataFields = array(
                    "UF_NAME" => $arEventFields['NAME'],
                    "UF_TELEFON" => $arEventFields['TELEFON'],
                    "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                    "UF_SENDCOPY" => true,
                    "UF_MESSAGE" => $arEventFields['MESSAGE'],
                    "UF_CODE" => "COMMERCIAL_OFFER",
                    "UF_REQUEST_DATE" => date('d.m.Y H:i',time()),
                );
                $ob_ = HiWrapper::id(3)->add($dataFields);
                $course_code='';
                
                CModule::IncludeModule('iblock');    
                $res=CIBlockElement::GetList([],['IBLOCK_ID'=>2,'ID'=>$get['ID']],false,false,['ID','PROPERTY_ARTNUMBER']);
                $r=$res->Fetch();
                if(!empty($r['PROPERTY_ARTNUMBER_VALUE'])) $course_code=$r['PROPERTY_ARTNUMBER_VALUE'];
                
                //$course_code="";
                $queryUrl = 'https://b24ais.ru/rest/443/brsg7aw5u717mogn/crm.lead.add.json';
                    // формируем параметры для создания лида в переменной $queryData
                    $name=trim($get["NAME_USER"]);
                    $name=explode(' ',$name);
                    $queryData = http_build_query(array(
                    'fields' => array(
                        'TITLE' => 'Сайт infosystems.ru выслать КП для '.$course_code,
                        'SOURCE_ID'=>'WEB',
                        'LAST_NAME'=>$name[0],
                        'NAME'=>$name[1],
                        'SECOND_NAME'=>$name[2],
                        'PHONE'=>[['VALUE'=>$dataFields['UF_TELEFON'],'VALUE_TYPE'=>'WORK']],
                        'EMAIL'=>[['VALUE'=>$dataFields['UF_EMAIL_USER'],'VALUE_TYPE'=>'WORK']],
                        'POST'=>$get['WORK_USER'],
                        'COMMENTS'=>$get['COMMENT'],
                        'OPENED'=>'Y',
                        'UF_CRM_1552491324'=>$get['USER_TIME_FROM']." / ".$get['USER_TIME_BEFORE'],
                        'UF_CRM_1552491299'=>$get['NUM_USER'],
                        'UF_CRM_1552491350'=>$get['USER_CS'],
                        'UF_CRM_1552491337'=>$get['CITY_USER']
                    ),
                    'params' => array("REGISTER_SONET_EVENT" => "Y")
                )); 
                // обращаемся к Битрикс24 при помощи функции curl_exec
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_SSL_VERIFYPEER => 0,
                  CURLOPT_POST => 1,
                  CURLOPT_HEADER => 0,
                  CURLOPT_RETURNTRANSFER => 1,
                  CURLOPT_URL => $queryUrl,
                  CURLOPT_POSTFIELDS => $queryData,
                ));
                $result = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($result, 1);
                //if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
            }
            //
            ob_start();
            print '<div>Спасибо, ваше сообщение отправлено<br> и будет расмотрено в рабочее время пн-пт с 09 до 18.</div>';
            $html = ob_get_contents();
            ob_end_clean();
            //
            $arJson['jq']['html'] = array("#alert-send-danger-success" => $html);
            $arJson['jq']['show'] = array("#alert-send-danger-success" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-error" => 300);
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
    // СВЯЗАТЬСЯ С ПРЕПОДАВАТЕЛЕМ
    public function expertsPostMail($get){
        $arJson = [];
        $error = [];
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
        if (is_array($get) && count($error) == 0) {
            // алгоритм отправки сообщения и т.д.
            $arEventFields = array(
                'NAME' => htmlspecialchars(trim($get['NAME_USER'])),
                'TELEFON' => htmlspecialchars(trim($get['TELEFON_USER'])),
                'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                'EMAIL_USER' => htmlspecialchars(trim($get['EMAIL_USER'])),
                'MESSAGE' => "Связь с преподавателем. Эксперт: ". $get['EXPERT'] ." Дата " . date('d.m.Y H:i',time()) . " Отправитель: ".htmlspecialchars(trim($get['NAME_USER'])),
                'COMMENT' => htmlspecialchars(trim($get['COMMENT_USER'])),
                'CODE' => "Связь с преподавателем: ".htmlspecialchars(trim($get['NAME_USER']))." / ".htmlspecialchars(trim($get['TELEFON_USER'])),
            );
            if($get['BCC']){ // скрытая копия
                $arEventFields['BCC'] = $get['BCC'];
            }
            CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields);
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
            //
            $success = true;
            if($success){
                //
                ob_start();
                print '<div>Спасибо, ваше сообщение отправлено и будет расмотрено в рабочее время пн-пт с 09 до 18.</div>';
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
    // метод для формы сообщения и т.д.
    public function orderMaterial($get){
        $arJson = array();
        $error = array();
        //
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
        //
        if (is_array($get) && count($error) == 0) {
            $TU = ["question"=>"Оставить вопрос специалисту","advertising"=>"Вопрос сотрудничества/рекламы","help"=>"Не нашел в каталоге?"];
            $arEventFields = array(
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
                $ob_ = HiWrapper::id(3)->add($dataFields);
            }
            //
            ob_start();
            print '<div>Спасибо, ваше сообщение отправлено<br> и будет расмотрено в рабочее время пн-пт с 09 до 18.</div>';
            $html = ob_get_contents();
            ob_end_clean();
            //
            $arJson['jq']['html'] = array("#alert-send-danger-success" => $html);
            $arJson['jq']['show'] = array("#alert-send-danger-success" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-error" => 300);
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
    // запись на семинар и т.д.
    public function SEMINAR_ADD($get){
        $arJson = [];
        $error = [];
        if (strlen($get["sendCopy"]) == 0) {
            $error['sendCopy'] = "Обязательное поле: Согласен(на) на обработку персональных данных";
        }
        if (strlen($get["SEMINAR_NAME"]) == 0) {
            $error['SEMINAR_NAME'] = "Обязательное поле: Имя";
        }
        if (strlen($get["SEMINAR_PHONES"]) == 0) {
            $error['SEMINAR_PHONES'] = "Обязательное поле: Телефон";
        }
        if (strlen($get["SEMINAR_EMAIL"]) == 0) {
            $error['SEMINAR_EMAIL'] = "Обязательное поле: Ваш емайл";
        }
        // если есть мыло то проверим его
        if (strlen($get["SEMINAR_EMAIL"]) > 0) {
            /* алгоритм проверки правельного майла */
            if (!filter_var($get["SEMINAR_EMAIL"], FILTER_VALIDATE_EMAIL) === false) { /* its ok */
            } else {
                $error['SEMINAR_EMAIL'] = "Пожалуйста введите корректный email: " . $get["SEMINAR_EMAIL"] . " ? ";
            }
        }
        //
        // AddMessage2Log("\n".var_export($get, true). " \n \r\n ", "get");
        if (is_array($get) && count($error) == 0) {
            //
            // $get['DT'] = $this->getSeminarByID($get['EOFS_ID']);
            $dt = date('d.m.Y H:i',time());
            $arEventFields = array(
                'NAME' => htmlspecialchars(trim($get["SEMINAR_NAME"])),
                'TELEFON' => htmlspecialchars(trim($get["SEMINAR_PHONES"])),
                'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                'EMAIL_USER' => htmlspecialchars(trim($get["SEMINAR_EMAIL"])),
                'MESSAGE' => "Заполнена форма завки на семинар, дата заполнения " .$dt. " Название семинара: ".$get['SEMINAR_ELEMENT']." Ссылка на семинар: ".$get['SEMINAR_URL'],
                'CODE' => "ЗАПИСЬ НА СЕМИНАР ".$dt." Название семинара: ".$get['SEMINAR_ELEMENT']." Ссылка на семинар: ".$get['SEMINAR_URL'],
            );
            CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields);

            // добавление в хидден блок и т.д.
            if(CModule::IncludeModule('acs')){
                $dataFields=array(
                    "UF_NAME"=>$arEventFields['NAME'],
                    "UF_TELEFON"=>$arEventFields['TELEFON'],
                    "UF_EMAIL_USER"=>$arEventFields['EMAIL_USER'],
                    "UF_SENDCOPY"=>true,
                    "UF_MESSAGE"=>$arEventFields['MESSAGE'],
                    "UF_CODE"=>$get['CODE'],
                    "UF_REQUEST_DATE"=>$dt
                );
				if($get['ADD_EMAIL'] == ''){
					$ob_ = HiWrapper::id(3)->add($dataFields);
				}
                CModule::IncludeModule('iblock');
                $course_code='';
                if(!empty($get['SEMINAR_CODE'])){
                    CModule::IncludeModule('iblock');
                    $res=CIBlockElement::GetList([],['IBLOCK_ID'=>2,'ID'=>$get['SEMINAR_CODE']],false,false,['ID','PROPERTY_ARTNUMBER']);
                    $r=$res->Fetch();
                    if(!empty($r['PROPERTY_ARTNUMBER_VALUE'])) $course_code=$r['PROPERTY_ARTNUMBER_VALUE'];
                }
                
                $queryUrl='https://b24ais.ru/rest/443/brsg7aw5u717mogn/crm.lead.add.json';
                // формируем параметры для создания лида в переменной $queryData
                $name=trim($dataFields['UF_NAME']);
                $name=explode(' ',$name);
                $queryData = http_build_query(array(
                    'fields' => array(
                        'TITLE' => 'Запись на семинар по курсу '.$course_code,
                        'SOURCE_ID'=>'WEB',
                        'LAST_NAME'=>$name[0],
                        'NAME'=>$name[1],
                        'SECOND_NAME'=>$name[2],
                        'PHONE'=>[['VALUE'=>$dataFields['UF_TELEFON'],'VALUE_TYPE'=>'WORK']],
                        'EMAIL'=>[['VALUE'=>$dataFields['UF_EMAIL_USER'],'VALUE_TYPE'=>'WORK']],
                        'COMMENTS'=>$get['COMMENT'],
                        'OPENED'=>'Y',
                    ),
                    'params' => array("REGISTER_SONET_EVENT" => "Y")
                )); 
                // обращаемся к Битрикс24 при помощи функции curl_exec
                $curl=curl_init();
                curl_setopt_array($curl,array(
                    CURLOPT_SSL_VERIFYPEER=>0,
                    CURLOPT_POST=>1,
                    CURLOPT_HEADER=>0,
                    CURLOPT_RETURNTRANSFER=>1,
                    CURLOPT_URL=>$queryUrl,
                    CURLOPT_POSTFIELDS=>$queryData,
                ));
                $result=curl_exec($curl);
                curl_close($curl);
                $result=json_decode($result, 1);
            }
            
            //
            ob_start();
            print '<div class="alert alert-success">Спасибо, ваша заявка отправлена <br>и будет рассмотрена в рабочее время пн-пт с 09 до 18.</div>';
            $html = ob_get_contents();
            ob_end_clean();
            //
            $arJson['alert'] = $html;
            $arJson['title'] = "Запись заявки";
            $arJson['jq']['reset'] = array("form.form-request" => "reset");   // очистить форму убераем заполненные поля и т.д.

        }else{
            //
            $arJson['error'] = '<small>'.implode("<br>",$error).'</small>';
            $arJson['title'] = "Ошибка";
        }
        return $arJson;
    }
    // добавление элемента в корзину
    public function ADD2BASKETBYPRODUCTID($get){
        $arJson = [];
        $error = [];
        if(intval($get['id'])>0 && CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")){
            $quantity = ($get['quantity']?intval($get['quantity']):1);
            if($res = Add2BasketByProductID(intval($get['id']),$quantity,[],false)){
                // сообщение
                ob_start();
                ?><div class="ADD2BASKETBYPRODUCTID">
                <? if($get['PREVIEW_PICTURE']): ?><img src="<?=$get['PREVIEW_PICTURE']?>"><? endif; ?>
                <strong><?=$get['NAME']?></strong>
                <p>Курс добавлен в корзину</p>
                <a class="button button--common button--primary" href="/personal/cart/">перейти к оплате курса</a>
                </div><?
                $html = ob_get_contents();
                ob_end_clean();
                $arJson['alert'] = $html;
                $arJson['title'] = "Ваша Корзина";
                // AddMessage2Log("\n" . var_export($this->getCar(), true) . " \n \r\n ", "getCar");
                // меняем в ajax корзину пишем в неее количество денег стоимость и т.д.
                $gc = $this->getCar();
                $arJson['jq']['html'] = array("a.cart-body button.cart-button" => '<span>'.number_format($gc['TOTAL_PRICE'], 0, '', ' ').' <small>₽</small></span>');
            }else{
                // ошибка добавления
                $arJson['error'] = intval($get['id']);
                $arJson['title'] = "Ошибка";
            }
        }else{
            $arJson['error'] = "Ошибка произошла повторите еще раз";
            $arJson['title'] = "Ошибка";
        }
        return $arJson;
    }
    // скачивание файлов и т.д.
    public function fileValueHandout($get){
        global $USER, $APPLICATION;
        $arJson = [];
        $get['USER_ID'] = $USER->GetID();
        $get['IP'] = $_SERVER['HTTP_CLIENT_IP'];
        // AddMessage2Log("\n".var_export($get, true). " \n \r\n ", "get");
        //
        if($USER->IsAuthorized() && intval($get['rel'])>0) {
            if($get['goMetod']=="fileValueHandoutDownload"){
                // если есть метод формируем скачивание и т.д.
                $arJson = array();
                $error = array();
                if (strlen($get["sendCopy"]) == 0) {
                    $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
                }
                if(strlen($get["captcha"])==0){$error['captcha']="Обязательное поле: КОД (надпись на картинке)";}
                // алгоритм проверки капчи
                if (!$APPLICATION->CaptchaCheckCode($get['captcha'], $get['captcha_sid'])) {
                    $error['code'] = "Код с картинки: ".$get["captcha"]." ? ";
                }
                if(is_array($get) && count($error)==0){
                    //
                    //$get["GetPath"] = CFile::GetPath(intval($get['rel']));
                    //AddMessage2Log("\n".var_export($get, true). " \n \r\n ", "get");
                    // алгоритм отправки сообщения и т.д.
                    $arEventFields = array(
                        'NAME' => $get['USER_ID']." / ".$USER->GetLogin()." / ".$USER->GetFullName(),
                        'TELEFON' => htmlspecialchars(trim($get["IP"])),
                        'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
                        'EMAIL_USER' => $USER->GetEmail(),
                        'MESSAGE' => "Скачивание файла. Дата " . date('d.m.Y H:i',time()) . " ID-FILES ".$get['rel']." Название: ".htmlspecialchars(trim($get['title'])),
                        'COMMENT' => "",
                        'CODE' => "Скачивание файла: ".$get['rel'],
                    );
                    CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields);
                    // добавление в хидден блок и т.д.
                    if (CModule::IncludeModule('acs')) {
                        $dataFields = array(
                            "UF_NAME" => $arEventFields['NAME'],
                            "UF_TELEFON" => $arEventFields['TELEFON'],
                            "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                            "UF_SENDCOPY" => true,
                            "UF_MESSAGE" => $arEventFields['MESSAGE'],
                            "UF_CODE" => "DOWLOAD_FILE",
                            "UF_REQUEST_DATE" => date('d.m.Y H:i', time()),
                        );
                        $ob_ = HiWrapper::id(3)->add($dataFields);
                    }
                    //
                    ob_start();
                    print '<div class="alert alert-success">Спасибо за обращение, скачивание файла сейчас начнется</div>';
                    $html = ob_get_contents();
                    ob_end_clean();
                    //
                    $arJson['title'] = "Скачивание файла";
                    $arJson['html'] = $html;
                    $arJson['redirect_URL'] = "/local/download/".intval($get['rel']); // безопасное скрытое скачивание документов по ID файла

                }else{
                    //
                    $arJson['jq']['html'] = array("#alert-send-danger-error" => '<small>'.implode("<br>",$error).'</small>');
                    $arJson['jq']['show'] = array("#alert-send-danger-error" => 300);
                    $arJson['jq']['hide'] = array("#alert-send-danger-success" => 300);
                    // формируем новую капчу и т.д.
                    $capCode = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
                    $arJson['jq']['val']['form.SubmitFormAjax input.capCode'] = $capCode;
                    $arJson['jq']['html']['form.SubmitFormAjax .CAPTCHA'] = '<img src="/bitrix/tools/captcha.php?captcha_sid='.$capCode.'" width="180" height="40" alt="CAPTCHA">';
                }
            }
            if($get['goMetod']=="fileValueHandoutForm"){
                // тут проверка на покупку курса intval($get['rel']) $get['USER_ID']
                // формируем и выводим форму для скачивания
                ob_start();
                include(dirname(__FILE__) . "/inc/handout.php");
                //p($get, 'p');
                $html = ob_get_contents();
                ob_end_clean();
                $arJson['html'] = $html;
                $arJson['title'] = "Скачать документ";
                $arJson['cansel'] = "Скачать";
                $arJson['submit'] = "Скачать";
                $arJson['mClass'] = 1;
            }
        }else{
            // ошибка добавления
            $arJson['error'] = '<div style="text-align: center; text-transform: uppercase;">Чтобы скачать документ авторизуйтесь или зарегистрируйтесь</div>';
            $arJson['title'] = "Сообщение";
        }
        return $arJson;
    }
    // добавление в избранное в HL блок
    public function addFavoritUser($get){
        global $USER, $APPLICATION;
        $arJson = [];
        $error = [];
        $result = false;
        $get['ID_FAVORIT'] = false;
        if(!$USER->IsAuthorized()){
            $arJson['error'] = '<span class="errorTextModal">Для добавление курса в избранное, зарегистрируйтесь или авторизуйтесь</span>';
            $arJson['title'] = "Сообщение";
            return $arJson;
        }
        $get['USER_ID'] = $USER->GetID();
        if(intval($get['ID'])>0 && CModule::IncludeModule('iblock') && CModule::IncludeModule('acs')){
            // ищем запись об избранном для этого пользователя и ID курса, если есть курс то его удаляем, если нет то добавляем
            $ob = HiWrapper::id(5);
            $rsData = $ob->getList([
                "select" => ["*"],
                "order" => ["ID" => "DESC"],
                "filter" => ["UF_USER"=>$get['USER_ID'],'UF_FAVORIT'=>intval($get['ID'])]
            ]);
            if($arData = $rsData->Fetch()){
                $arData['UF_DATE'] = $arData['UF_DATE']->format('d.m.Y H:i');
                $get['ID_FAVORIT'] = $arData;
            }
            // AddMessage2Log("\n".var_export($get, true). " \n \r\n ", "_get");
            //  если есть курс то его удаляем, если нет то добавляем
            if($get['ID_FAVORIT'] && intval($get['ID_FAVORIT']['ID'])>0){
                $ob->delete(intval($get['ID_FAVORIT']['ID']));
                // JS api
                $arJson['jq']['removeClass'] = ['.favor[data-item="'.$get['ID'].'"]' => 'active'];
                $arJson['jq']['attributeName']['.favor[data-item="'.$get['ID'].'"]'] = ['title' => 'Добавить курс в Избранноe'];
            }else{
                $dataFields = [
                    "UF_USER" => $get['USER_ID'],
                    "UF_FAVORIT" => intval($get['ID']),
                    "UF_DATE" => date('d.m.Y H:i', time()),
                ];
                $ob_ = $ob->add($dataFields);
                // JS api
                $arJson['jq']['addClass'] = ['.favor[data-item="'.$get['ID'].'"]' => 'active'];
                $arJson['jq']['attributeName']['.favor[data-item="'.$get['ID'].'"]'] = ['title' => 'Курс добавлен в избранноe'];
            }
        }else{
            // ошибка добавления
            $arJson['error'] = 'ID ?';
            $arJson['title'] = "Ошибка добавления";
        }
        return $arJson;
    }
    // добавление в избранное в HL блок
    public function addCalendarUser($get){
        global $USER, $APPLICATION;
        $arJson = [];
        $error = [];
        $get['ID_EVENT'] = false;
        if(!$USER->IsAuthorized()){
            $arJson['error'] = '<span class="errorTextModal">Для добавление в курса мой календарь, зарегистрируйтесь или авторизуйтесь</span>';
            $arJson['title'] = "Сообщение";
            return $arJson;
        }
        $get['USER_ID'] = $USER->GetID();
        if(intval($get['ID'])>0 && CModule::IncludeModule('iblock') && CModule::IncludeModule('acs')){
            // ищем запись об избранном для этого пользователя и ID события, если есть событие то его удаляем, если нет то добавляем
            $ob = HiWrapper::id(6);
            $rsData = $ob->getList([
                "select" => ["*"],
                "order" => ["ID" => "DESC"],
                "filter" => ["UF_USER"=>$get['USER_ID'],'UF_EVENT'=>intval($get['ID'])]
            ]);
            if($arData = $rsData->Fetch()){
                $arData['UF_DATE'] = $arData['UF_DATE']->format('d.m.Y H:i');
                $get['ID_EVENT'] = $arData;
            }
            //  если есть событие то его удаляем, если нет то добавляем
            if($get['ID_EVENT'] && intval($get['ID_EVENT']['ID'])>0){
                $ob->delete(intval($get['ID_EVENT']['ID']));
                // JS api
                $arJson['jq']['removeClass'] = ['.myCalendar[data-item="'.$get['ID'].'"]' => 'active'];
                $arJson['jq']['attributeName']['.myCalendar[data-item="'.$get['ID'].'"]'] = ['title' => 'Добавить курс в личный календарь'];
            }else{
                $dataFields = [
                    "UF_USER" => $get['USER_ID'],
                    "UF_EVENT" => intval($get['ID']),
                    "UF_DATE" => date('d.m.Y H:i', time()),
                ];
                $ob_ = $ob->add($dataFields);
                // JS api
                $arJson['jq']['addClass'] = ['.myCalendar[data-item="'.$get['ID'].'"]' => 'active'];
                $arJson['jq']['attributeName']['.myCalendar[data-item="'.$get['ID'].'"]'] = ['title' => 'Курс добавлен в календарь'];
            }
            //
        }else{
            // ошибка добавления
            $arJson['error'] = 'ID ?';
            $arJson['title'] = "Ошибка добавления";
        }
        return $arJson;
    }
    // добавляет в избранное пресса и новости, все в сессий
    public function addFavorPressa($get){
        global $USER, $APPLICATION;
        $arJson = [];
        $error = [];
        if(!is_array($_SESSION["IBLOCK_RATING"]))
            $_SESSION["IBLOCK_RATING"] = [];
        //
        if(intval($get['ID'])>0){
            //AddMessage2Log("\n".var_export($_SESSION["IBLOCK_RATING"], true). " \n \r\n ", "IBLOCK_RATING");
            if(!array_key_exists($get['ID'], $_SESSION["IBLOCK_RATING"])){
                $_SESSION["IBLOCK_RATING"][$get['ID']] = true;
                // Датчик. Добавляем
                $arJson['jq']['addClass'] = ['.favorPressa[data-item="'.$get['ID'].'"]' => 'active'];
                $arJson['jq']['attributeName']['.favorPressa[data-item="'.$get['ID'].'"]'] = ['title' => 'Добавлено в избранное'];
            }else{
                // Находим элемент, который нужно удалить из избранного
                unset($_SESSION["IBLOCK_RATING"][$get['ID']]);
                // Датчик. Удаляем
                $arJson['jq']['removeClass'] = ['.favorPressa[data-item="'.$get['ID'].'"]' => 'active'];
                $arJson['jq']['attributeName']['.favorPressa[data-item="'.$get['ID'].'"]'] = ['title' => 'Добавить в Избранноe'];
            }
            //AddMessage2Log("\n".var_export($_SESSION["IBLOCK_RATING"], true). " \n \r\n ", "IBLOCK_RATING");
            //AddMessage2Log("\n".var_export($result, true). " \n \r\n ", "result");
            //AddMessage2Log("\n".var_export($arJson, true). " \n \r\n ", "arJson");
            //
        }else{
            // ошибка добавления
            $arJson['error'] = 'ID ?';
            $arJson['title'] = "Ошибка добавления";
        }
        return $arJson;
    }
    // REST API
    public function executeComponent()
    {
        global $USER, $APPLICATION;
        if($_SERVER["REQUEST_METHOD"] == "POST" && strlen(trim($_REQUEST["go"])) > 1) {
            $go = trim($_REQUEST["go"]);
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
        //$this->includeComponentTemplate();
    }
}