<?
define("NEED_AUTH",true);

$arAuthResult["MESSAGE"] = "Доступ к файлу закрыт";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER, $APPLICATION;
// AddMessage2Log("\n".var_export($_REQUEST, true). " \n \r\n ", "REQUEST");
if(!$USER->IsAuthorized())
	$APPLICATION->AuthForm($arAuthResult["MESSAGE"]);
else
	LocalRedirect($_REQUEST["DIR"]);