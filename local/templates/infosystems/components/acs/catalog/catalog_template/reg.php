<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
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

$APPLICATION->AddChainItem('Оставить заявку');

$this->setFrameMode(true);

$element = \Bitrix\Iblock\ElementTable::getList([
    'filter' => ['=CODE' => $arResult['VARIABLES']['ELEMENT_CODE']],
    'limit'  => 1
])->fetch();

?>
<header class="header header-background-img-none">
    <? include($_SERVER["DOCUMENT_ROOT"]."/include/header-top.php"); ?>
    <section class="screen-menu custom-course-head">
        <div class="menu-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php
                        $APPLICATION->IncludeComponent("bitrix:menu","bootstrap_horizontal_multilevel",
                            Array(
                                "ROOT_MENU_TYPE" => "top",
                                "MAX_LEVEL"	=>	"2",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT"	=>	"Y",
                                "MENU_CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "MENU_CACHE_TIME" => $arParams["CACHE_TIME"], // 1 hour - Cache time in seconds.
                                "MENU_CACHE_USE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "MENU_CACHE_GET_VARS" => Array(),
                            ),
                            $component, ['HIDE_ICONS' => 'Y']);?>
                    </div>
                </div>
            </div>
        </div>
        <? $APPLICATION->IncludeComponent("bitrix:search.form","hidden",["PAGE" => "/search/"],$component,['HIDE_ICONS' => 'Y']);?>
        <div class="container">
            <div class="row">
                <div class="col-10" id="navigation">
                    <?php
                    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "-"
                    ), false, ['HIDE_ICONS' => 'Y']); ?>
                </div>
            </div>
            <div class="page-header">
                <h1 class="bx-title dbg_title custom-title-top" id="pagetitle"><?= $APPLICATION->ShowTitle(false); ?></h1></div>
        </div>
       </section>
</header>
<section class="main" role="main">
    <div class="container">
        <div class="form-container">
        <?php
        $APPLICATION->IncludeComponent(
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
                'WEB_FORM_ID' => '3',
                "USER_CONSENT" => "Y",
                "USER_CONSENT_ID" => "1",
                "USER_CONSENT_IS_CHECKED" => "Y",
                "USER_CONSENT_IS_LOADED" => "N",
                'FORM_ACTION' => "/ajax/courses/order/{$element['ID']}/"
            ]
        ); ?>
        </div>
    </div>
</section>
<style>
    .main .forms {
        margin-top: 50px;
    }
</style>
