<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? /* форму поиска заменить на bitrix:search.title */ ?>
<? // $APPLICATION->IncludeComponent("bitrix:search.form",".default",["PAGE" => "/search/",]);?>

<? /* реадктирование меню иконок происходит в файле .icon.menu.php */ ?>
<?$APPLICATION->IncludeComponent("bitrix:menu","icon",
    Array(
        "ROOT_MENU_TYPE" => "icon",
        "MAX_LEVEL"	=>	"1",
        //"CHILD_MENU_TYPE" => "left",
        "USE_EXT"	=>	"N",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => Array(),
    ),false,['HIDE_ICONS'=>'Y']);?>