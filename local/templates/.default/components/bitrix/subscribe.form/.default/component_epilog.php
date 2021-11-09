<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// алгоритм подписки кривоват :(
global $USER, $APPLICATION;
if($_SERVER["REQUEST_METHOD"] == "POST" && trim($_REQUEST["go"]) == "subscribe" && !empty($_REQUEST["PostAction"]) && check_bitrix_sessid() && CModule::IncludeModule("subscribe")){
    //
    $arJson = array();
    $error = array();
    $get = $_REQUEST; // сюда нужно включить алгоритм очистки и т.д.
    if(count($get['sf_RUB_ID'])==0){
        $error['sf_RUB_ID'] = "Пожалуйста выберите рубрику на которую Вы подписываетесь";
    }
    if (strlen($get["sendCopy"]) == 0) {
        $error['sendCopy'] = "Обязательное поле: Согласен на обработку персональных данных";
    }
    if (strlen($get["sf_EMAIL"]) == 0) {
        $error['sf_EMAIL'] = "Обязательное поле: Ваш емайл";
    }
    // если есть мыло то проверим его
    if (strlen($get["sf_EMAIL"]) > 0) {
        /* алгоритм проверки правельного майла */
        if (!filter_var($get["sf_EMAIL"], FILTER_VALIDATE_EMAIL) === false) { /* its ok */
        } else {
            $error['sf_EMAIL'] = "Пожалуйста введите корректный email: " . $get["sf_EMAIL"] . " ? ";
        }
    }
    if (is_array($get) && count($error) == 0) {
        // алгоритм подписки и т.д.
        $obSubscription = new CSubscription;
        $subscription = $obSubscription->GetByEmail($get["sf_EMAIL"]);
        global $subscr_ID, $subscr_ACTIVE, $subscr_CONFIRMED;
        $subscription->ExtractFields("subscr_");
        //AddMessage2Log("\n" . var_export($get, true) . " \n \r\n ", "_get");
        //AddMessage2Log("\n" . var_export($subscr_ID, true) . " \n \r\n ", "_get");
        //AddMessage2Log("\n" . var_export($subscr_ACTIVE, true) . " \n \r\n ", "_get");
        //AddMessage2Log("\n" . var_export($subscr_CONFIRMED, true) . " \n \r\n ", "_get");
        if($subscr_ID != null){
            if($subscr_CONFIRMED=='Y'){
                $error[] = "Адрес ".$get["sf_EMAIL"]." уже подписан на рассылку";
            }else{
                // Вышлем заново код активации
                if(CSubscription::ConfirmEvent($subscr_ID)){
                    $success = true;
                }else{
                    $error[] ="Не удалось отправить код подтверждения. Попробуйте позднее";
                }
            }
        }else{
            // Создадим подписку
            $arFields = Array(
                "USER_ID" => ($USER->IsAuthorized()?$USER->GetID():false),
                "FORMAT" => "html",
                "EMAIL" => $get["sf_EMAIL"],
                "ACTIVE" => "Y",
                "RUB_ID" => array($get['sf_RUB_ID']),
                'SEND_CONFIRM'=>'Y'
            );
            //can add without authorization
            $ID = $obSubscription->Add($arFields);
            if($ID > 0){
                CSubscription::Authorize($ID);
                $success = true;
            }else{
                $error[] = "Error adding subscription: " . $obSubscription->LAST_ERROR;
            }
        }
        // если все ок
        if($success){
            //
            ob_start();
            print 'Вы стали подписчиком, ваша подписка успешна оформлена на '.$get["sf_EMAIL"].'.<br>';
            print 'Для подтверждения подписки перейдите по следующей ссылке в письме.<br>';
            print 'Внимание! Вы не будете получать сообщения рассылки, пока не подтвердите свою подписку.';
            $html = ob_get_contents();
            ob_end_clean();
            //
            //$arJson['alert'] = $html;
            //$arJson['title'] = "Сообщение";

            $arJson['jq']['html'] = array("#alert-subscribe-danger-success" => $html);
            $arJson['jq']['show'] = array("#alert-subscribe-danger-success" => 300);
            $arJson['jq']['hide'] = array("#alert-subscribe-danger-error" => 300);
            $arJson['jq']['reset'] = array("#subscribe form" => "reset");   // очистить форму убераем заполненные поля и т.д.
            $arJson['jq']['hide']["#subscribe form"] = 300; // просто схлопываем форму и т.д.
            $arJson['jq']['hide']["#subscribe .modal-footer"] = 300; // просто схлопываем форму и т.д.
        }
        if(count($error)){
            $arJson['jq']['html'] = array("#alert-subscribe-danger-error" => '<small>'.implode("<br>",$error).'</small>');
            $arJson['jq']['show'] = array("#alert-subscribe-danger-error" => 300);
            $arJson['jq']['hide'] = array("#alert-subscribe-danger-success" => 300);
        }

    }else{
        ob_start();
        print '<small>';
        print implode("<br>",$error);
        print "</small>";
        $html = ob_get_contents();
        ob_end_clean();
        $arJson['jq']['html'] = array("#alert-subscribe-danger-error" => $html);
        $arJson['jq']['show'] = array("#alert-subscribe-danger-error" => 300);
        $arJson['jq']['hide'] = array("#alert-subscribe-danger-success" => 300);
    }
    //
    $APPLICATION->RestartBuffer();
    print json_encode($arJson);
    die();
}