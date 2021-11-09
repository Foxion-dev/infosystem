<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Перечень курсов АИС");
$APPLICATION->SetPageProperty("section_class", "about-price");
$APPLICATION->SetPageProperty("particlesBG", "Y"); 
?><div class="price-page">
	<div class="top-block">
 <a download="" href="/upload/perechen-kursov-ais.pdf">Перечень курсов АИС 2021<i class="fa fa-download"></i></a>
	</div>
	<div class="top-block">
 <a download="" href="/upload/perechen-kursov-ais-2022.pdf">Перечень курсов АИС 2022<i class="fa fa-download"></i></a>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"acs:scroll.courses",
	"",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array("CODE","DURATION_DAY","DURATION_HOURS","PRICE","DATE","DOCUMENTS"),
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "28",
		"IBLOCK_TYPE" => "courses",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_TEMPLATE" => ".default",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>