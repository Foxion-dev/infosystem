<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */
global $USER, $APPLICATION;
?>
<header class="header <?/*header-background-img header-background-img-card*/?>">
    <? include($_SERVER["DOCUMENT_ROOT"]."/include/header-top.php"); ?>
    <section class="screen-menu <?$APPLICATION->AddBufferContent('screenMenuClass')?>">
        <div class="menu-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap_horizontal_multilevel",
                            Array(
                                "ROOT_MENU_TYPE" => "top",
                                "MAX_LEVEL"	=>	"2",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT"	=>	"Y",
                                "MENU_CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "MENU_CACHE_TIME" => $arParams["CACHE_TIME"], // 1 hour - Cache time in seconds.
                                "MENU_CACHE_USE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "MENU_CACHE_GET_VARS" => Array(),
                            ),$component, array('HIDE_ICONS' => 'Y'));?>
                    </div>
                </div>
            </div>
        </div><!--//end menu-top-->
        <? $APPLICATION->IncludeComponent("bitrix:search.form","hidden",["PAGE" => "/search/"],$component,['HIDE_ICONS' => 'N']);?>
        <div class="container">
            <div class="col">
                <div class="row">
                    <div class="col-11" id="navigation">
                        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => "-"
                        ),$component,Array('HIDE_ICONS' => 'Y'));?>
                    </div>
                    <div class="col-1 shareYandex"><?$APPLICATION->AddBufferContent('shareYandex')?></div>
                </div>
                <div class="page-header">
                    <a href="../" class="back-btn"></a>
                    <h1 class="bx-title dbg_title courses-filter" id="pagetitle">
                    <?=$APPLICATION->ShowTitle(false);?></h1>
                <?/*    <a href="javascript:void(0);" class="popular-coursers-filter-click">Фильтр</a>*/?>
                <?$res=CIBlockSection::GetList([],['CODE'=>$arResult['VARIABLES']['SECTION_CODE']],false,['ID','DESCRIPTION']);
                $section=0;
                $desciption='';
                if($r=$res->Fetch()){ $section=$r['ID'];$desciption=$r['DESCRIPTION'];}?>
                    <p class="page-description">
                        <?=$desciption?>
                    </p>
                </div>
            </div>
             <?
            
             
             $APPLICATION->IncludeComponent("acs:acs.select","in_section", ['CACHE_TYPE' => 'N',
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => 'N',
                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                "SECTION_ID" => $section,
            ], $component, array('HIDE_ICONS' => 'Y')); ?>
        </div>
    </section><!--//end screen-menu-->
</header>