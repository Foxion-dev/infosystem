<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
// $APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetPageProperty("section_class", "personal-private"); // класс для section
 ?>
<?$APPLICATION->IncludeComponent("bitrix:main.profile","small",Array(
        "USER_PROPERTY_NAME" => "",
        "SET_TITLE" => "Y",
        "AJAX_MODE" => "N",
        "USER_PROPERTY" => ["UF_OGRM","UF_OKPO","UF_INN","UF_KPP","UF_URA","UF_FCA","UF_BR","UF_DR"],
        "SEND_INFO" => "Y",
        "CHECK_RIGHTS" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>