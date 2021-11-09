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
    <section class="news video-reviews">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="heading-wrapper">
                        <h5 class="heading" id="VIDEO"><?=html_entity_decode($arParams['TITLE_PAGE'])?></h5>
                        <?/*<!--<a href="<?//=$arParams['TITLE_PAGE_URL']?>" class="button button--common button--primary">Видеоотчеты</a>-->*/?>
                    </div>
                </div>
            </div>
            <div <?=$arParams['IN_COURSES'] ? ' data-count="'.count($arResult["ITEMS"]).'" ':''?>class="video-reviews-carousel owl-carousel<?=$arParams['IN_COURSES'] ? ' incourses':''?>">
                <? foreach ($arResult["ITEMS"] as $arItem):?>
                
                    
                    <div class="video-reviews-carousel-item">
                    <div href="<?=$arItem['PROPERTIES']['YOUTUBE']['VALUE']?>" class="news-item fancybox-media">
                        <div class="play-button play-button--sm"></div>
                        <? if(!empty($arItem['PREVIEW_PICTURE'])){
                            $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 800, "height" => 600));  ?>
                            <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" class="item-pic">
                        <? }else{ ?>
                            <img src="<?=PRM::SRC(500)?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" class="item-pic">
                        <? } ?>
                        <div class="item-content">
                            <p class="date icon-calendar"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
                            <p class="title"><?=$arItem["NAME"]?></p>
                        </div>
                    </div>
                    </div>
                    
                    
                <? endforeach; ?>
            </div>
        </div>
    </section><!--// end news -->
<? endif; ?>