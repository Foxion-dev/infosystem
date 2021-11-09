<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отписка от рассылки");
$APPLICATION->SetPageProperty("body_class", "neo-sidebar sidebar-right");
$APPLICATION->SetPageProperty("main_class", "sidebar-left");
?>
    <h1>Отписка от рассылки</h1>
    <?$APPLICATION->IncludeComponent(
	"acs:subscribe.unsubscribe", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"ASD_MAIL_ID" => $_REQUEST["mid"],
		"ASD_MAIL_MD5" => $_REQUEST["mhash"]
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>