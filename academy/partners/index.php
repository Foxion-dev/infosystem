<? define("SHOW_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнеры");
?><div class="particles-bg-5" id="particles-bg-5">
</div>
 
<?$APPLICATION->IncludeComponent(
	"acs:news.line",
	"customers",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE","IBLOCK_SECTION_ID"),
		"IBLOCKS" => Array("13"),
		"IBLOCK_TYPE" => "references",
		"NEWS_COUNT" => false,
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>