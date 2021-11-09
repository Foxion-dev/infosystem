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
$this->setFrameMode(true);
if(count($arResult["ITEMS"])): ?>
<section class="courses">
<div class="particles-courses-left" id="particles-courses-left"></div>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="courses-slider owl-carousel">
            <? foreach ($arResult["ITEMS"] as $k=>$arItem){  ?>
            <div class="slide slide-<?=$k+1?>">
                <div class="row">
                    <div class="col-12 col-md-6 order-2 order-md-1">
                        <? //p($arItem,'p'); ?>
                        <div class="slide-content">
                            <? if($arItem['IBLOCK_SECTION_NAME']){ ?>
                                <h3 class="slide-heading"><?=$arItem['IBLOCK_SECTION_NAME']?></h3>
                            <? } ?>
                            <div class="slide-meta">
                                <? if($arItem['PROPERTY_DATE_VALUE']): ?>
                                    <p class="date icon-calendar"><?=FormatDate("d F Y",strtotime($arItem['PROPERTY_DATE_VALUE']))?></p>
                                <? endif; ?>
                                <? if($arItem['PROPERTY_CITY_VALUE']): ?><p class="place icon-geomark"><?=$arItem['PROPERTY_CITY_VALUE']?></p><? endif; ?>
                            </div>
                            <h5 class="title"><?=$arItem['NAME']?></h5>
                            <? if($arItem['PROPERTY_PRICE_VALUE']): ?>
                            <h3 class="price"><?=number_format($arItem['PROPERTY_PRICE_VALUE'], 0, '', ' ')." ₽"?></h3>
                            <? endif; ?>
                            <p class="description"><?=my_crop($arItem['PREVIEW_TEXT'],200)?></p>
                            <? if($arItem['PROPERTY_URL_VALUE']): ?>
                            <a href="<?=$arItem['PROPERTY_URL_VALUE']?>" class="button button--common button--primary">Подробнее</a>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 order-1 order-md-2">
                        <? //560 X 500 ?>
                        <? if(!empty($arItem['PREVIEW_PICTURE'])){
                            $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 560, "height" => 500), BX_RESIZE_IMAGE_EXACT);  ?>
                            <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="slide-img">
                        <? } ?>
                    </div>
                </div>
            </div>
            <? } ?>
            </div>
        </div>
    </div>
</div>
<div class="particles-courses-right" id="particles-courses-right"></div>
</section><!--//end courses-->
<? endif; ?>