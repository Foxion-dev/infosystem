<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>
<div class="search-panel">
    <div class="container">
        <form action="<?=$arResult["FORM_ACTION"]?>" class="row search-form">
            <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
                <input type="text" placeholder="Поиск" name="q" class="search-input">
            </div>
            <div class="col-10 col-sm-10 col-md-4 col-lg-4 col-xl-4">
                <!--<span class="search-category-label">Я ищу:</span>-->
                <select name="where" id="search-category" class="search-category">
                    <option value="">Все категории</option>
                    <option value="iblock_news">Новости</option>
                    <option value="iblock_catalog">Курсы</option>
                    <option value="iblock_academy">Академия</option>
                    <option value="iblock_library">Библиотека</option>
                </select>
            </div>
            <div class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1"><button type="submit" class="button button--round button--secondary icon-search"></button></div>
        </form>
    </div>
</div><!--//end search-panel -->