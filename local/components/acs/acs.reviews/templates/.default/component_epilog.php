<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// алгоритм добавления отзыва и т.д.
global $USER, $APPLICATION;
if($_SERVER["REQUEST_METHOD"] == "POST" && trim($_REQUEST["go"]) == "UserReviewsClassAdd" && check_bitrix_sessid() && CModule::IncludeModule("acs") && CModule::IncludeModule("iblock")){
    //
    $arJson = array();
    $error = array();
    $get = $_REQUEST; // сюда нужно включить алгоритм очистки и т.д.
    if(count($get['NAME_USER'])==0){
        $error['NAME_USER'] = "Обязательное поле: Ваше имя";
    }
    if (strlen($get["sendCopy"]) == 0) {
        $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
    }
    if (strlen($get["EMAIL_USER"]) == 0) {
        //$error['EMAIL_USER'] = "Обязательное поле: Ваш емайл";
    }
    // если есть мыло то проверим его
    if (strlen($get["EMAIL_USER"]) > 0) {
        /* алгоритм проверки правельного майла */
        if (!filter_var($get["EMAIL_USER"], FILTER_VALIDATE_EMAIL) === false) { /* its ok */
        } else {
            $error['EMAIL_USER'] = "Пожалуйста введите корректный email: " . $get["EMAIL_USER"] . " ? ";
        }
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
        // добавление в хидден блок и т.д.
        if (CModule::IncludeModule('acs')) {
            $dataFields = array(
                "UF_DATE" => date('d.m.Y H:i',time()),
                "UF_USER" => ($USER->IsAuthorized()?$USER->GetID():0),
                "UF_NAME" => htmlspecialchars(trim($get['NAME_USER'])),
                "UF_REVIEWS" => htmlspecialchars(trim($get['COMMENT_USER'])),
				"UF_COMPANY_USER" => htmlspecialchars(trim($get['COMPANY_USER'])),
                //"UF_IMG" => ($get['arFileArr'][0]?CFile::MakeFileArray($get['arFileArr'][0]):""),
                "UF_ACTIV" => 0,
                'UF_COURSE_LINK'=>'',
                'UF_COURSE_GROUP_LINK'=>''
            );
            if(!empty($get['ELEMENT_NAME'])){$dataFields['UF_COURSE_LINK']=$get['ELEMENT_NAME'];}
            if(!empty($get['GROUP_NAME'])){$dataFields['UF_COURSE_GROUP_LINK']=$get['GROUP_NAME'];}
            if(!empty($get['COURSE_ID'])){$dataFields['UF_COURSE_LINK']=$get['COURSE_ID'];}
            $ob_=HiWrapper::id(4)->add($dataFields);
        }
        // алгоритм отправки сообщения и т.д.
        $arEventFields = array(
            'NAME' => htmlspecialchars(trim($get['NAME_USER'])),
            'TELEFON' => htmlspecialchars(trim($get['TELEFON_USER'])),
            'COMPANY_USER' => htmlspecialchars(trim($get['COMPANY_USER'])),
            'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
            'EMAIL_USER' => htmlspecialchars(trim($get['EMAIL_USER'])),
            'MESSAGE' => "Добавлен отзыв. Дата " . date('d.m.Y H:i',time()) . " Отправитель: ".htmlspecialchars(trim($get['NAME_USER'])),
            'COMMENT' => htmlspecialchars(trim($get['COMMENT_USER'])),
            'CODE' => "Добавлен отзыв: ".htmlspecialchars(trim($get['NAME_USER']))." / ".htmlspecialchars(trim($get['TELEFON_USER'])),
        );
        CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields, "Y", "", $get['arFileArr']);
        // добавление в хидден блок и т.д.
        /*if (CModule::IncludeModule('acs')) {
            $dataFields = array(
                "UF_NAME" => $arEventFields['NAME'],
                "UF_TELEFON" => $arEventFields['TELEFON'],
                "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                "UF_COMPANY_USER" => $arEventFields['COMPANY_USER'],
                "UF_SENDCOPY" => true,
                "UF_MESSAGE" => $arEventFields['MESSAGE'],
                "UF_CODE" => "REVIEWS_ADD",
                "UF_REQUEST_DATE" => date('d.m.Y H:i', time()),
            );
            $ob_ = HiWrapper::id(3)->add($dataFields);
        }*/
        //AddMessage2Log("\n" . var_export($get, true) . " \n \r\n ", "_get_");
        //AddMessage2Log("\n" . var_export($ob_, true) . " \n \r\n ", "_ob_");
        // если все ок
        $success = true;
        //AddMessage2Log($success);
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
        /* if(count($error)){
            $arJson['jq']['html'] = array("#alert-send-danger-error" => '<small>'.implode("<br>",$error).'</small>');
            $arJson['jq']['show'] = array("#alert-send-danger-error" => 300);
            $arJson['jq']['hide'] = array("#alert-send-danger-success" => 300);
        } */

    }else{
        //
        $arJson['jq']['html'] = array("#alert-send-danger-error" => '<small>'.implode("<br>",$error).'</small>');
        $arJson['jq']['show'] = array("#alert-send-danger-error" => 300);
        $arJson['jq']['hide'] = array("#alert-send-danger-success" => 300);
    }
    //
    $APPLICATION->RestartBuffer();
    print json_encode($arJson);
    die();
}
 
?><script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.user-reviews-class-add', function (event) {
            event.preventDefault();
            var $go = "UserReviewsClassAdd";
            var $title = $(this).text();
            var messegeText = '<div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div><div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>';
            var textInput  = '<div class="form-group"><label>ФИО:<span class="starrequired">*</span></label><input name="NAME_USER" type="text" class="form-control input-lg req" placeholder="Ваше ФИО"></div>';
            var textInput3  = '<div class="form-group"><label>Компания:</label><input name="COMPANY_USER" type="text" class="form-control input-lg" placeholder="Ваша Компания"></div>';
            //var textInput0  = '<div class="form-group"><label>Ваш e-mail:<span class="starrequired">*</span></label><input name="EMAIL_USER" type="text" class="form-control input-lg e-mail req" placeholder="Ваш e-mail"></div>';
            var textInput0  = '<div class="form-group"><label>Ваш e-mail:</label><input name="EMAIL_USER" type="text" class="form-control input-lg e-mail" placeholder="Ваш e-mail"></div>';
            var checkInput  = '<div class="form-group"><label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" class="req" value="1"><span></span> Нажимая на кнопку «Отправить» я соглашаюсь с <a target="_blank" href="/about/user_agreement/">Пользовательским соглашением</a> и <a target="_blank" href="/about/privacy/">Политикой конфиденциальности</a></label></div>';
            //var textInput1  = '<div class="form-group"><label>Телефон:<span class="starrequired">*</span></label><input name="TELEFON_USER" type="text" class="form-control input-lg phone req" placeholder="Ваш телефон"></div>';
            var textInput1  = '';
            
            var hiddenInput1  = '<input type="hidden" name="CODE" value="'+$(this).text()+'">';
            var hiddenInput2  = '<input type="hidden" name="ELEMENT_NAME" value="'+$(this).attr("data-name")+'">';
            var hiddenInput2  = '<input type="hidden" name="GROUP_NAME" value="'+$(this).attr("data-group")+'">';
            var hiddenInput3  = '<input type="hidden" name="COURSE_ID" value="<?=$arParams['ELEMENT_ID']?>">';
            var textarea0 = '<div class="form-group"><label>Ваш отзыв:<span class="starrequired">*</span></label><textarea name="COMMENT_USER" class="form-control input-lg req" rows="3" placeholder="Ваш комментарий"></textarea></div>';
            //var files0 = '<div class="form-group"><label class="button button--common button--primary" for="my-file-selector" style="display:inline-block; text-align: center; padding: 10px 25px;"><input id="my-file-selector" type="file" name="file" accept="image/x-png,image/gif,image/jpeg" style="display:none" onchange="$(\'#upload-file-info\').html(this.files[0].name)">    Загрузите вашу фотографию </label> <span class="label label-info" id="upload-file-info"></span></div>';
            var files0 = '';
            var textBody = messegeText + '<form id="user-reviews-add" action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax"><?=bitrix_sessid_post()?>' + hiddenInput1 + hiddenInput2 +hiddenInput3+ '<div class="row input-form"><div class="col-12">'  + textInput + textInput0+textInput3 + ' </div><div class="col-12"> ' + textInput1  + textarea0 + files0 + checkInput + '<input name="go" type="hidden" value="'+ $go +'"><input type="submit" style="display: none;" value="Y"></div></div></form>';
            showMessageForm(textBody, $title, "Закрыть", "Отправить", 1);
            $('.modal-backdrop').addClass('modal-backdrop-inverse');
            //$('input.phone').mask('+7 (999) 999-9999');
            return false;
        });
    });
</script><?