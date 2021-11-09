<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//
global $USER, $APPLICATION;
//echo "<pre>"; print_r($arResult); echo "</pre>";
if($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['go']=="registr_ajax") {
    //
    $arJson = [];
    if ($USER->IsAuthorized()) {
        $arJson['redirect_URL'] = ($arResult["BACKURL"] ? $arResult["BACKURL"] : "/personal/");
    } else {
        if (count($arResult["ERRORS"])) {
            foreach ($arResult["ERRORS"] as $key => $error) {
                if (intval($key) == 0 && $key !== 0) {
                    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
                }
            }
            $arJson['jq']['html'] = array("#alert-regi-danger-error" => implode("<br />", $arResult["ERRORS"]), ".alert-regi-danger-error" => implode("<br />", $arResult["ERRORS"]));
            $arJson['jq']['show'] = array("#alert-regi-danger-error" => 300, ".alert-regi-danger-error" => 300);
            //
        } elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y") {
            $arJson['jq']['html'] = array("#alert-regi-danger-success" => GetMessage("REGISTER_EMAIL_WILL_BE_SENT"));
            $arJson['jq']['show'] = array("#alert-regi-danger-success" => 300);
        }
    }
    //
    if(count($arJson)) {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        print json_encode($arJson);
        die();
    }
//
}
