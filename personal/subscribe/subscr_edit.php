<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование параметров подписки");
$APPLICATION->SetPageProperty("body_class", "neo-sidebar sidebar-right");
$APPLICATION->SetPageProperty("main_class", "sidebar-left");
?>
    <h1>Редактирование параметров подписки</h1>
    <?$APPLICATION->IncludeComponent("bitrix:subscribe.edit", "clear",
        Array(
            "SHOW_HIDDEN" => "N",
            "ALLOW_ANONYMOUS" => "Y",
            "SHOW_AUTH_LINKS" => "Y",
            "CACHE_TIME" => "3600",
            "SET_TITLE" => "Y"
        )
    );?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>