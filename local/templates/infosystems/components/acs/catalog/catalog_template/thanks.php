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

$APPLICATION->AddChainItem('Заявка успешно отправлена');

$this->setFrameMode(true);
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
        </div>
       </section>
</header>
<section class="main" role="main">
    <div class="container">
        <div class="thank-container">
            <h2>Спасибо за заявку!</h2>
            <p>В ближайшее время с вами свяжется менеджер.</p>
        </div>
    </div>
</section>
