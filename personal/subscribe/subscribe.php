<?
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Подписка на рассылку");
$APPLICATION->SetPageProperty("body_class", "neo-sidebar sidebar-right");
$APPLICATION->SetPageProperty("main_class", "sidebar-left");
?>    
<?$APPLICATION->IncludeComponent(
	"acs:subscribe.form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"ASD_MAIL_ID" => $_REQUEST["listid"],
		"ACTION_PAGE" => "#SITE_DIR#personal/subscribe/subscribe.php",
    'AJAX'=>true,
	),
	false
);?>
