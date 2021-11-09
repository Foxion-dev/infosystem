<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
$APPLICATION->SetPageProperty("particlesBG", "Y");
$APPLICATION->SetPageProperty("section_class", "personal-order-make");
/* ВНИМАНИЕ используется старый компонент и шаблон этого компонента sale.order.ajax архив лежит в папке /local/components/acs/sale.order.ajax.zip */
?><?$APPLICATION->IncludeComponent(
	"acs:sale.order.ajax",
	"",
	Array(
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"MESS_BUYER_BLOCK_NAME" => "Информация о покупателе",
		"MESS_REGION_BLOCK_NAME" => "Тип плательщика",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "/personal/make/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PAY_FROM_ACCOUNT" => "N",
		"PRODUCT_COLUMNS" => array(),
		"PROP_1" => array("22","23","24","25","26","27","28","30","31","32","33","34"),
		"PROP_2" => array(),
		"SEND_NEW_USER_NOTIFY" => "N",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"SET_TITLE" => "Y",
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"USE_CUSTOM_MAIN_MESSAGES" => "Y",
		"USE_PREPAYMENT" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>