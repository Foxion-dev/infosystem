<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусы");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:sale.personal.account",
    "bootstrap_v4",
    Array(
        "SET_TITLE" => "N"
    )
);?>

<?$APPLICATION->IncludeComponent("bitrix:sale.account.pay",
    "bootstrap_v4",
    Array(
        "ELIMINATED_PAY_SYSTEMS" => array("2"),
        "PATH_TO_BASKET" => "/personal/cart",
        "PATH_TO_PAYMENT" => "/personal/order/payment",
        "PERSON_TYPE" => "1",
        "REFRESHED_COMPONENT_MODE" => "Y",
        "SELL_CURRENCY" => "RUB",
        "SELL_SHOW_FIXED_VALUES" => "Y",
        "SELL_TOTAL" => array("100","200","500","1000","5000",""),
        "SELL_USER_INPUT" => "Y",
        "SELL_VALUES_FROM_VAR" => "N",
        "SET_TITLE" => "Y"
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>