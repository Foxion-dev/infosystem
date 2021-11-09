<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//
global $APPLICATION;
if($arResult["FORM_TYPE"] == "login") { /**/ }else{
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['go']=="auth_ajax"){
        //
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        $arJson['redirect_URL'] = ($arResult["AUTH_URL"] ? $arResult["AUTH_URL"]:"/personal/");
        print json_encode($arJson);
        die();
    }
}
//
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'] && $_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['go']=="auth_ajax") {
    // ShowMessage($arResult['ERROR_MESSAGE']);
    $arResult['ERROR_MESSAGE_TEXT'] = GetMessage("ERROR_MESSAGE_TEXT"); //(is_array($arResult['ERROR_MESSAGE'])?implode(" ",$arResult['ERROR_MESSAGE']):$arResult['ERROR_MESSAGE']);
    global $APPLICATION;
    $APPLICATION->RestartBuffer();
    $arJson['jq']['html'] = array("#alert-auth-danger-error" => $arResult['ERROR_MESSAGE_TEXT'], ".alert-auth-danger-error" => $arResult['ERROR_MESSAGE_TEXT']);
    $arJson['jq']['show'] = array("#alert-auth-danger-error" => 300, ".alert-auth-danger-error" => 300);
    print json_encode($arJson);
    die();
}