<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetPageProperty("section_class", "about-contacts");
$APPLICATION->SetPageProperty("particlesBG", "Y"); 
?>
<div class="form-container">
<?php $APPLICATION->IncludeComponent(
    'bitrix:form.result.new',
    'feedback',
    [
        'CACHE_TIME' => '3600',
        'CACHE_TYPE' => 'A',
        'CHAIN_ITEM_LINK' => '',
        'CHAIN_ITEM_TEXT' => '',
        'EDIT_URL' => '',
        'IGNORE_CUSTOM_TEMPLATE' => 'N',
        'LIST_URL' => '',
        'SEF_MODE' => 'N',
        'SUCCESS_URL' => '',
        'USE_EXTENDED_ERRORS' => 'Y',
        'VARIABLE_ALIASES' => [],
        "USER_CONSENT" => "Y",
        "USER_CONSENT_ID" => "1",
        "USER_CONSENT_IS_CHECKED" => "Y",
        'WEB_FORM_ID' => 2,
        'FORM_ACTION' => "/ajax/feedback/"
    ]
); ?>
<style>
    .about-contacts .forms {
        margin-top: 50px;
    }
</style>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>
