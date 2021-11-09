<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$element = \Bitrix\Iblock\ElementTable::getList([
    'filter' => [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        '=CODE' => $arResult['VARIABLES']['ELEMENT_CODE']
    ],
    'limit'  => 1
])->fetch();
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
        'WEB_FORM_ID' => 1,
        'FORM_ACTION' => "/ajax/service/order/{$element['ID']}/"
    ]
); ?>
<style>
    .main .forms {
        margin-top: 50px;
    }
    .popup-content {
        text-align: center;
    }
</style>
<script>
    $('.js-overlay, .js-popup-close').on('click', function (e) {
        e.preventDefault();
        $('.js-popup, .js-overlay').removeClass('is-active');
    });
</script>
</div>
