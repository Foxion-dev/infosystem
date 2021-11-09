<? define("SHOW_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Команда");
?>

<?$APPLICATION->IncludeComponent(
	"acs:news.line", 
	"team", 
	array(
		"IBLOCK_TYPE" => "academy",
		"IBLOCKS" => array(
			0 => "14",
		),
		"NEWS_COUNT" => false,
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "PREVIEW_PICTURE",
			3 => "IBLOCK_SECTION_ID",
			4 => "PROPERTY_POSITION",
			5 => "PROPERTY_PHONES",
			6 => "PROPERTY_POST_MAIL",
			7 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "NAME",
		"SORT_ORDER2" => "DESC",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "team",
		"DETAIL_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>