<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? /**/ ?>
<? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "ajax", Array(
        "REGISTER_URL"	=>	"/auth/",
        "PROFILE_URL"	=>	"/personal/profile/",
        "SHOW_ERRORS" => "Y",
    )
); ?>

<?$APPLICATION->IncludeComponent("bitrix:main.register","ajax", Array(
        "USER_PROPERTY_NAME" => "",
        "SEF_MODE" => "Y",
        "SHOW_FIELDS" => Array(),
        "REQUIRED_FIELDS" => Array(),
        "AUTH" => "Y",
        "USE_BACKURL" => "Y",
        "SUCCESS_PAGE" => "",
        "SET_TITLE" => "N",
        "USER_PROPERTY" => Array(),
        "SEF_FOLDER" => "/",
        "VARIABLE_ALIASES" => Array()
    )
);?>