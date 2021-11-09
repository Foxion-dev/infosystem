<?  define("SHOW_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("About company");
$APPLICATION->SetPageProperty("shareYandex", "Y");
?><div class="particles-bg-4" id="particles-bg-4">
</div>
 <section class="academy-container-about" id="particles-body-top" style="margin-top: 40px;z-index: 1;position: relative;">
<div class="container">
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"corses_dir", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "44",
		"IBLOCK_TYPE" => "catalog_en",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PROP_0",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "corses_dir"
	),
	false
);?>
<div class="row">
	<div class="col-12">
		<div style="font-style: normal;font-weight: normal;font-size: 28px;line-height: 38px;">
 			<br>
			 Конференции<br>
			 <br>
		</div>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"buis_mission", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "45",
		"IBLOCK_TYPE" => "catalog_en",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "103",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PROP_0",
			1 => "PROP_2",
			2 => "PROP_1",
			3 => "PROP_3",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "buis_mission"
	),
	false
);?>
	<div class="row">
		<div class="col-12">
		 <?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "page",
					"AREA_FILE_SUFFIX" => "block1",
					"EDIT_TEMPLATE" => ""
				)
			);?>
		</div>
	</div>
<div class="row">
	<div class="col-12">
		<div style="font-style: normal;font-weight: normal;font-size: 28px;line-height: 38px;">
 			<br>
			 Бизнес миссии<br>
			 <br>
		</div>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"buis_mission", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "45",
		"IBLOCK_TYPE" => "catalog_en",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "104",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PROP_0",
			1 => "PROP_2",
			2 => "PROP_1",
			3 => "PROP_3",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "buis_mission"
	),
	false
);?>
</section>
	 <?/*<div class="container">
	<div class="row">
		<div class="col-12">
				<div style="font-style: normal;font-weight: normal;font-size: 28px;line-height: 38px;">
 <br>
				 Обучение заказчиков<br>
 <br>
			</div>
		<?$APPLICATION->IncludeComponent(
	"acs:news.line", 
	"slider_with_detail", 
	array(
		"IBLOCK_TYPE" => "catalog_en",
		"IBLOCKS" => array(
			0 => "46",
		),
		"NEWS_COUNT" => 4*3,
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "PREVIEW_PICTURE",
			3 => "ACTIVE_DATE_FORMAT",
			4 => "",
		),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"ACTIVE_DATE_FORMAT" => "d F Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "slider_with_detail",
		"DETAIL_URL" => ""
	),
	false
);?>
</div>
</div>
</div>
*/?>
<section style="background: #E4E4E4;">
<div class="container">
	<div class="row">
		<div class="col-12">
			<div style="font-style: normal;font-weight: normal;font-size: 28px;line-height: 38px;">
 <br>
				 Обучение онлайн<br>
 <br>
			</div>
		</div>
	</div>
</div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"catalog_template",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"BIG_DATA_RCM_TYPE" => "personal",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "catalog_template",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(0=>"BUY",),
		"DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(0=>"BUY",),
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => array(0=>"POPUP",1=>"MAGNIFIER",),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(),
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_PROPERTY_CODE" => array(0=>"",1=>"",),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_POPULAR" => "Y",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_SHOW_VIEWED" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "29",
		"IBLOCK_TYPE" => "catalog_en",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "N",
		"LABEL_PROP" => array(),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"LIST_PRODUCT_ROW_VARIANTS" => array("={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false"),
		"LIST_PROPERTY_CODE" => array(0=>"",1=>"",),
		"LIST_PROPERTY_CODE_MOBILE" => array(),
		"LIST_SHOW_SLIDER" => "Y",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_COMMENTS_TAB" => "Комментарии",
		"MESS_DESCRIPTION_TAB" => "Описание",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_PRICE_RANGES_TITLE" => "Цены",
		"MESS_PROPERTIES_TAB" => "Характеристики",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "N",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"TOP_PRODUCT_ROW_VARIANTS" => array("={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false","={{'VARIANT':'2'}","BIG_DATA':false"),
		"TOP_PROPERTY_CODE" => array(0=>"",1=>"",),
		"TOP_PROPERTY_CODE_MOBILE" => "",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_BIG_DATA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "N",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_STORE" => "N",
		"VARIABLE_ALIASES" => array("ELEMENT_ID"=>"ELEMENT_ID","SECTION_ID"=>"SECTION_ID",)
	)
);?> </section>
 <?/*
<?$APPLICATION->IncludeComponent(
	"acs:news.line",
	"partners",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "partners",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"PREVIEW_PICTURE",3=>"",),
		"IBLOCKS" => array(0=>"36",),
		"IBLOCK_TYPE" => "references_en",
		"NEWS_COUNT" => 3*8,
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"TITLE_PAGE" => "Партнеры",
		"TITLE_PAGE_URL" => "/academy/partners/"
	)
);?> */?><?$APPLICATION->IncludeComponent(
	"acs:news.line",
	"partners",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "partners",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"PREVIEW_PICTURE",3=>"",),
		"IBLOCKS" => array(0=>"34",),
		"IBLOCK_TYPE" => "references_en",
		"NEWS_COUNT" => 3*8,
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"TITLE_PAGE" => "Клиенты",
		"TITLE_PAGE_URL" => "/academy/partners/"
	)
);?> 
 <?$APPLICATION->IncludeComponent(
	"acs:news.line",
	"experts_new",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "experts_new",
		"DETAIL_URL" => "",
		"DIV_CLASS" => "experts-multyslider-wrapper",
		"FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"PREVIEW_PICTURE",3=>"PROPERTY_POSITIONS",4=>"",),
		"IBLOCKS" => array(0=>"33",),
		"IBLOCK_TYPE" => "references_en",
		"NEWS_COUNT" => "8",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"TITLE_PAGE" => "Преподаватели АИС"
	),
$component
);?> <?/* <?$APPLICATION->IncludeComponent(
	"acs:gallery.line",
	"video",
	Array(
		"ACTIVE_DATE_FORMAT" => "d F Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "video",
		"DETAIL_URL" => "#SITE_DIR#/academy/video/#ELEMENT_CODE#/",
		"FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"PREVIEW_PICTURE",3=>"",),
		"IBLOCKS" => array(0=>"39",),
		"IBLOCK_TYPE" => "academy_en",
		"INDEX_PAGE_TITLE" => "смотреть видео <br> Академия Информационных Систем",
		"INDEX_PAGE_URL" => "https://www.youtube.com/watch?v=0dHKdESieFg",
		"NEWS_COUNT" => "4",
		"PROPERTY_CODE" => array(0=>"YOUTUBE",),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"TITLE_PAGE" => "Видеогалерея",
		"TITLE_PAGE_URL" => "/academy/video/"
	)
);?>*/?> <?$APPLICATION->IncludeComponent(
	"acs:gallery.line", 
	"gallery_element", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "gallery_element",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "PREVIEW_TEXT",
			3 => "",
		),
		"IBLOCKS" => array(
			0 => "43",
		),
		"IBLOCK_TYPE" => "library_en",
		"NEWS_COUNT" => 3*4,
		"PROPERTY_CODE" => array(
			0 => "PHOTOS",
		),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"TITLE_PAGE" => "фотогалерея",
		"TITLE_PAGE_URL" => "/library/photo/"
	),
	$component
);?> <section class="academy-container-about-fon" style="z-index: 3; position: relative;">
<div class="container">
	<div class="row">
		<div class="col-12">
			<h2>Контакты</h2>
			<p>
 <strong>Телефоны: </strong> +7 (495) 120-04-02
			</p>
			<p>
 <strong>Адрес: </strong> 111123 г. Москва, ул. Плеханова 4а, БЦ "ЮНИКОН", 7этаж
			</p>
 <br>
 <br>
		</div>
	</div>
</div>
 </section>
<div style="z-index: 1;position: relative;height:500px; margin-top: -25px; margin-bottom: 20px; width:100%; display:inline-block; overflow:hidden;">
	 <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A4cc7df00e036dd59eebb87b54438fb6198298bc923dba70321da1a2b54877838&amp;source=constructor" width="100%" height="500" frameborder="0"></iframe>
</div>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
			<h3>На метро</h3>
			<p>
				 Станция метро «Шоссе Энтузиастов»<br>
				 Из стеклянных дверей направо (в сторону ул. Электродной)<br>
				 5 минут пешком вдоль пруда<br>
				 На ресепшн получить пропуск в УЦ "Академия Информационных Систем"<br>
				 Подняться на 7 этаж<br>
				 Из лифта выход в сторону офиса №3 "Академия Информационных Систем"
			</p>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
			<h3>На автомобиле</h3>
			<p>
				 Из центра по шоссе Энтузиастов<br>
				 Съезд направо на ул. Электродную<br>
				 Налево на ул. Плеханова<br>
				 Проехать до БЦ "Юникон" 200м
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
			<p class="p-gray">
 <strong>Обратите внимание,</strong> что для получения пропуска вам нужно иметь при себе документ, удостоверяющий личность (паспорт или водительское удостоверение).
			</p>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
			<p class="p-gray">
 <strong>Обратите внимание,</strong> что на территории бизнес-центра нет организованной парковки. Есть возможность оставить машину на прилегающих улицах
			</p>
		</div>
	</div>
</div>
 <section style="background: #F8F7F5;min-height:170px;align-items:center;" class="d-flex">
<div class="container">
	<div class="row">
		<div class="col-12 col-lg-6 d-flex" style="align-items:center;">
			<div style="margin-right:10px;">
 <input style="width:30px;height:30px;" type="checkbox">
			</div>
			<div>
				 Согласен(на) на обработку персональных данных
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div>
 <a href="/about/privacy/" style="font-style: normal;font-weight: normal;font-size: 16px;line-height: 24px;display: flex;align-items: center;text-decoration-line: underline;color: #8CD50B;">Политика конфиденциальности и пользовательского соглашения</a>
			</div>
		</div>
	</div>
</div>
 </section> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>