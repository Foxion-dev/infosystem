<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
$APPLICATION->SetPageProperty("particlesBG", "Y");   
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"",
	Array(
		"ACTION_VARIABLE" => "basketAction",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_24" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AUTO_CALCULATION" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"COLUMNS_LIST" => array(0=>"NAME",1=>"DISCOUNT",2=>"PRICE",3=>"QUANTITY",4=>"SUM",5=>"PROPS",6=>"DELETE",7=>"DELAY",),
		"COLUMNS_LIST_EXT" => array("DISCOUNT","DELETE","DELAY","SUM","PROPERTY_ARTNUMBER"),
		"COLUMNS_LIST_MOBILE" => array("DISCOUNT","DELETE","DELAY","SUM"),
		"COMPATIBLE_MODE" => "Y",
		"CORRECT_RATIO" => "Y",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"DEFERRED_REFRESH" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_MODE" => "extended",
		"HIDE_COUPON" => "Y",
		"LABEL_PROP" => array(),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "",
		"OFFERS_PROPS" => array(0=>"COLOR_REF",1=>"SIZES_CLOTHES",),
		"PATH_TO_ORDER" => "/personal/make/",
		"PRICE_DISPLAY_MODE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FILTER" => "N",
		"SHOW_RESTORE" => "N",
		"TEMPLATE_THEME" => "site",
		"TOTAL_BLOCK_DISPLAY" => array("bottom"),
		"USE_DYNAMIC_SCROLL" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_GIFTS" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_PRICE_ANIMATION" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>