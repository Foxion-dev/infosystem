<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// алгоритм добавления отзыва и т.д.
global $USER, $APPLICATION;
$arrJson = [];
$CURRENT_BUDGET = 0;
$USER_ID = 0;
if($USER->IsAuthorized() && \Bitrix\Main\Loader::includeModule('iblock') && \Bitrix\Main\Loader::includeModule("sale")) {
    $USER_ID = $USER->GetID();
    if ($arr = CSaleUserAccount::GetByUserID($USER_ID, "RUB")) {
        $CURRENT_BUDGET = intval($arr["CURRENT_BUDGET"]);
    }
}
/*if($_SERVER["REQUEST_METHOD"] == "POST" && trim($_REQUEST["go"]) == "UserReviewsClassAdd" && check_bitrix_sessid() && CModule::IncludeModule("acs") && CModule::IncludeModule("iblock")){
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
                "UF_IMG" => ($get['arFileArr'][0]?CFile::MakeFileArray($get['arFileArr'][0]):""),
                "UF_ACTIV" => 0,
            );
            $ob_ = HiWrapper::id(4)->add($dataFields);
        }
        // алгоритм отправки сообщения и т.д.
        $arEventFields = array(
            'NAME' => htmlspecialchars(trim($get['NAME_USER'])),
            'TELEFON' => htmlspecialchars(trim($get['TELEFON_USER'])),
            'SENDCOPY' => htmlspecialchars(trim($get["sendCopy"])),
            'EMAIL_USER' => htmlspecialchars(trim($get['EMAIL_USER'])),
            'MESSAGE' => "Добавлен отзыв. Дата " . date('d.m.Y H:i',time()) . " Отправитель: ".htmlspecialchars(trim($get['NAME_USER'])),
            'COMMENT' => htmlspecialchars(trim($get['COMMENT_USER'])),
            'CODE' => "Добавлен отзыв: ".htmlspecialchars(trim($get['NAME_USER']))." / ".htmlspecialchars(trim($get['TELEFON_USER'])),
        );
        CEvent::SendImmediate("ORDER_INFO", SITE_ID, $arEventFields, "Y", "", $get['arFileArr']);
        // добавление в хидден блок и т.д.
        if (CModule::IncludeModule('acs')) {
            $dataFields = array(
                "UF_NAME" => $arEventFields['NAME'],
                "UF_TELEFON" => $arEventFields['TELEFON'],
                "UF_EMAIL_USER" => $arEventFields['EMAIL_USER'],
                "UF_SENDCOPY" => true,
                "UF_MESSAGE" => $arEventFields['MESSAGE'],
                "UF_CODE" => "REVIEWS_ADD",
                "UF_REQUEST_DATE" => date('d.m.Y H:i', time()),
            );
            $ob_ = HiWrapper::id(3)->add($dataFields);
        }
        //AddMessage2Log("\n" . var_export($get, true) . " \n \r\n ", "_get_");
        //AddMessage2Log("\n" . var_export($ob_, true) . " \n \r\n ", "_ob_");
        // если все ок
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
    //
    $APPLICATION->RestartBuffer();
    print json_encode($arJson);
    die();
}*/
//p($arResult['ITEMS'],'p');
if(!empty($arResult['ITEMS'])):
    foreach ($arResult['ITEMS'] as $ITEM){
        $arrJson[$ITEM['ID']] = [
            'ID'=>$ITEM['ID'],
            'NAME'=>$ITEM['NAME'],
            'PREVIEW_PICTURE' => $ITEM['PREVIEW_PICTURE']?CFile::GetPath($ITEM['PREVIEW_PICTURE']):PRM::SRC(500),
            'PREVIEW_TEXT'=>$ITEM['PREVIEW_TEXT'],
            'DETAIL_TEXT'=>$ITEM['DETAIL_TEXT'],
            'PRICE'=>number_format($ITEM['PRICE'], 0, '', ' '),
        ];
    }
?><script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.click-more', function (event) {
            event.preventDefault();
            var $JS = <?=json_encode($arrJson)?>;
            var $ID = $(this).attr('rel');
            var $PRICE_ = '<div class="academy-customers-font-price">Цена <span>'+$JS[$ID]['PRICE']+'</span> баллов</div><div class="academy-customers-button"><button type="button" class="button button--common button--primary gift-basket" rel="'+$JS[$ID]['ID']+'" data-title="'+$JS[$ID]['NAME']+'" data-price="'+$JS[$ID]['PRICE']+'">Получить</button></div>';
            var $HTML = '<div class="row"><div class="col-12 col-sm-12 col-md-6"><img class="academy-customers-images" src="'+$JS[$ID]['PREVIEW_PICTURE']+'"></div><div class="col-12 col-sm-12 col-md-6 academy-customers-font"><h3>'+$JS[$ID]['PREVIEW_TEXT']+'</h3>'+$JS[$ID]['DETAIL_TEXT']+$PRICE_+'</div></div>';
            showMessage($HTML, $JS[$ID]['NAME'], false, 2);
            return false;
        });
        $('body').on('click','.gift-basket', function (event) {
            event.preventDefault();
            var $ID = $(this).attr('rel');
            var $PRICE = parseInt($(this).attr('data-price'));
            var $TITLE = $(this).attr('data-title');
            var $BUDGET = parseInt(<?=intval($CURRENT_BUDGET)?>);
            <?if($USER->IsAuthorized()){  /* формируем форму заказа подарка за бонусы и т.д. */ ?>
                if($BUDGET > $PRICE){
                    showWait();
                    $.ajax({
                        dataType: "json",
                        type: "POST",
                        url: "<?=POST_FORM_ACTION_URI?>",
                        data: {go:"getGiftBasket",ID:$ID,PRICE:$PRICE,BUDGET:$BUDGET,TITLE:$TITLE,USER_ID:<?=$USER_ID?>},
                        success: function(res){
                            closeWait();
                            if(res.jq){ JQ(res.jq); }
                            if(res.html){ showMessageForm(res.html, res.title, res.cansel, res.submit, 1);  $('input.phone').mask('+7 (999) 999-9999'); }
                            if(res.error){ showMessage(res.error, res.title, res.cansel); }
                        }
                    });
                }else{
                    var $error_ = '<div style="text-align: center; text-transform: uppercase;">К сожалению у Вас не хватает бонусов, попробуйте пополнить личный счет</div>';
                    showMessage($error_, "Сообщение");
                }
            <?}else{?>
            var $error_ = '<div style="text-align: center; text-transform: uppercase;">Чтобы получить подарок за бонусы, авторизуйтесь или зарегистрируйтесь</div>';
            showMessage($error_, "Сообщение");
            <?}?>
            return false;
        });
    });
</script><? endif;