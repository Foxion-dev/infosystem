<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// ajax
global $USER, $APPLICATION;
if($_SERVER["REQUEST_METHOD"]=="POST" && $_REQUEST["go"]=="MainProfile" && ($_REQUEST["save"] <> '' || $_REQUEST["apply"] <> '') && check_bitrix_sessid()){
    //
    $arJson = array();
    $error = array();
    $get = $_REQUEST; // сюда нужно включить алгоритм очистки и т.д.
    //
   /* AddMessage2Log("\n".var_export($get, true). " \n \r\n ", "_get");
    AddMessage2Log("\n".var_export($arResult['DATA_SAVED'], true). " \n \r\n ", "DATA_SAVED");
    AddMessage2Log("\n".var_export($arResult, true). " \n \r\n ", "arResult");*/

    if($arResult['DATA_SAVED'] == 'Y'){
        $arJson['jq']['html'] = array("#alert-main-profile-success" => GetMessage('PROFILE_DATA_SAVED'));
        $arJson['jq']['show'] = array("#alert-main-profile-success" => 300);
        $arJson['jq']['hide'] = array("#alert-main-profile-error" => 300);
    }

    if(!empty($arResult["strProfileError"])){
        //
        $arJson['jq']['html'] = array("#alert-main-profile-error" => $arResult["strProfileError"]);
        $arJson['jq']['show'] = array("#alert-main-profile-error" => 300);
        $arJson['jq']['hide'] = array("#alert-main-profile-success" => 300);
    }

    //
    if(count($arJson)) {
        $APPLICATION->RestartBuffer();
        print json_encode($arJson);
        die();
    }
}
