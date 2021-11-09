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

?>
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
                        ),$component, array('HIDE_ICONS' => 'N'));?>
                </div>
            </div>
        </div>
    </div><!--//end menu-top-->
    <? /* форма SMART фильтра и т.д. catalog.smart.filter */ ?>
    <div class="search-panel">
        <div class="container">
            <form action="" method="post" class="row coursers-line-form" name="coursers-line-form" id="coursers-line-form">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <label>Направления курсов</label>
                    <select name="coursers-line" class="coursers-line" id="coursers-line">
                        <option value="1">Конкурентная разведка в Интернете</option>
                        <option value="2">Категория</option>
                        <option value="3">Категория</option>
                    </select>
                </div>
                <div class="col-9 col-sm-9 col-md-4 col-lg-4 col-xl-4">
                    <label>Подразделы направления</label>
                    <select name="coursers-line-name" id="coursers-line-name">
                        <option value="1">Авторизованные курсы</option>
                        <option value="2">Категория</option>
                        <option value="3">Категория</option>
                    </select>
                </div>
                <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2"><button type="submit" name="search-button" class="button button--round button--secondary icon-search"></button></div>
            </form>
        </div>
    </div><!--// search-panel -->
</section><!--//end screen-menu-->
<?