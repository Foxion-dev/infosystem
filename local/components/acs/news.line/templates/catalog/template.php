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
// p($arResult['ITEMS'],'p');
?>
<div class="row">
    <? if(count($arResult['ITEMS'])){ ?>
        <? foreach ($arResult['ITEMS'] as $i=>$arItem){ ?>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="whiteBody">
                    <? //p($arItem['DISPLAY_PROPERTIES'],'p'); ?>
                    <div class="whiteBodyAction">
                        <?=($arItem['PROPERTY_NEW_VALUE']=="Y"?'<div class="whiteBodyNew">Новинка</div>':'');?>
                        <?=($arItem['PROPERTY_HIT_VALUE']=="Y"?'<div class="whiteBodyHit">Хит</div>':'');?>
                    </div>
                    <? if(!empty($arItem['PREVIEW_PICTURE'])): ?>
                        <? $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 400, "height" => 250)); ?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$PR["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" class="img-responsive"></a>
                    <? endif; ?>
                    <div class="whiteBodyTiser">
                        <div class="whiteBodyTiserText"><?=$arItem["NAME"]?></div>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">подробней</a>
                    </div>
                    <ul class="whiteBodyReviewLine"><li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">Отзывы (<?=intval($arItem['PROPERTY_BLOG_COMMENTS_CNT_VALUE'])?>)</a></li><li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">Оставить отзыв</a></li></ul>
                </div>
            </div>
            <? $ah = $i+1; if(($ah % 2) == 0){
                echo '<div class="hidden-lg clearfix"></div>';
            } ?>
            <? $ae = $i+1; if(($ae % 3) == 0){
                echo '<div class="visible-lg clearfix"></div>';
            } ?>
            <? $ban = $i+1; if($ban==6){ echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'; $APPLICATION->IncludeFile("/include/banner.php",Array(),Array("MODE"=>"php")); echo '</div>'; } ?>
        <? } ?>
    <? } ?>
</div>
