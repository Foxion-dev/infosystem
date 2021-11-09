<? define("SHOW_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клиенты");
?>
<?$APPLICATION->IncludeComponent("acs:news.line","partners_list",Array(
        "IBLOCK_TYPE" => "references",
        "IBLOCKS" => Array("5"),
        "NEWS_COUNT" => false,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE","IBLOCK_SECTION_ID"),
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        //"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
        //"ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        // "TITLE_PAGE"=>"Наши партнеры и заказчики",
        // "TITLE_PAGE_URL"=>"/academy/partners/",
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>