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
//var_dump($arResult);
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
        <? $APPLICATION->IncludeComponent("bitrix:search.form","hidden",["PAGE" => "/search/"],$component,['HIDE_ICONS' => 'Y']);?>
        <? $APPLICATION->IncludeComponent("acs:acs.select","", ['CACHE_TYPE' => $arParams['CACHE_TYPE'],
            'CACHE_TIME' => $arParams['CACHE_TIME'],
            'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
            'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            //
        ], $component, array('HIDE_ICONS' => 'Y')); ?>
    </section><!--//end screen-menu-->
    
</header>
<?if(isset($_GET['ajax_courses'])&&$_GET['ajax_courses']=='Y'){
    $APPLICATION->RestartBuffer();
    $section=0;
    if(!empty($_POST['coursers-line-name'])){
        $section=$_POST['coursers-line-name'];    
    }elseif(!empty($_POST['coursers-line'])){
        $section=$_POST['coursers-line'];
    }
    $APPLICATION->IncludeComponent('acs:acs.courses','courses_section_2',[
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'DETAIL_URL' => SITE_DIR."courses/#SECTION_CODE#/#ELEMENT_CODE#/",
        'COUNT' => 4,
        "FILTER_NAME"=>[
            "!PROPERTY_SPECIALOFFER"=>false,
            'IBLOCK_SECTION_ID'=>$section
            //'SECTION_ID'
            //">=PROPERTY_DATE" => date("Y-m-d H:i:s",time())
        ],
    ],
    $component,
    ['HIDE_ICONS' => 'Y']
);
    die();
}