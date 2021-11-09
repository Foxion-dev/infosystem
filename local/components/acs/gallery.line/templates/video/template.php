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
<section class="videogallery">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="heading-wrapper">
                    <h5 class="heading"><?=html_entity_decode($arParams['TITLE_PAGE'])?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="main-video">
        <h3 class="title"><?=html_entity_decode($arParams['INDEX_PAGE_TITLE'])?></h3>
        <div href="<?=$arParams['INDEX_PAGE_URL']?>" class="play-button fancybox-media"></div>
    </div>
    <div class="video-items">
        <div class="container">
            <div class="row">
                <? foreach ($arResult["ITEMS"] as $arItem){ ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <? //p($arItem['PROPERTIES']['YOUTUBE']['VALUE'],'p'); ?>
                        <div href="<?=$arItem['PROPERTIES']['YOUTUBE']['VALUE']?>" class="video-item fancybox-media">
                            <? if(!empty($arItem['PREVIEW_PICTURE'])){
                                $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 262, "height" => 130));  ?>
                                <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" class="item-pic">
                            <? }else{ ?>
                                <img src="<?=PRM::SRC(500)?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" class="item-pic">
                            <? } ?>
                            <div class="play-button play-button--sm"></div>
                            <div class="item-content">
                                <p class="date icon-calendar"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
                                <p class="title"><?=$arItem["NAME"]?></p>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="button_holder">
                    <a href="<?=$arParams['TITLE_PAGE_URL']?>" class="button button--common button--primary">Все видео</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? // ?>
</section>
<? endif; ?>