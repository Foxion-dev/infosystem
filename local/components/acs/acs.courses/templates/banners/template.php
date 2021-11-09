<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//
$this->setFrameMode(true);
// p($arResult["ITEMS"],'p');
if(count($arResult["ITEMS"])): ?>
<section class="courses">
    <?/*<div class="particles-courses-left" id="particles-courses-left"></div>*/?>
    <div class="container">
        <div class="row"><div class="col"><div class="courses-slider owl-carousel">
        <? foreach ($arResult["ITEMS"] as $k=>$arItem):  ?>
            <div class="slide slide-<?=$k+1?>">
                <div class="row">
                    <div class="col-12 col-md-6 order-2 order-md-1">
                        <div class="slide-content">
                            <h3 class="slide-heading">Популярные курсы</h3>
                            <h5 class="title"><?=$arItem['NAME']?></h5>
                            <div class="slide-meta">
                                <? if($arItem['PROPERTY_DATE_VALUE']): ?>
                                    <p class="date icon-calendar"><?=FormatDate("d F",strtotime($arItem['PROPERTY_DATE_VALUE']))?>, <?=$arItem['PROPERTY_CITY_VALUE']?></p>
                                <? endif; ?>
                                <? if($arItem['PROPERTY_CITY_VALUE']): ?><p class="place icon-geomark"><?=number_format($arItem['PRICE'], 0, '', ' ')?></p><? endif; ?>
                            </div>
                            
                            <? if($arItem['PRICE']): ?>
                                <h3 class="price"></h3>
                            <? endif; ?>
                            <? if($arItem['PREVIEW_TEXT']): ?>
                                <p class="description"><?=my_crop($arItem['PREVIEW_TEXT'],300)?></p>
                            <? elseif ($arItem['DETAIL_TEXT']): ?>
                                <p class="description"><?=my_crop($arItem['DETAIL_TEXT'],300)?></p>
                            <? endif; ?>
                            <? if($arItem['DETAIL_PAGE_URL']): ?>
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button button--common button--primary">Подробнее</a>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 order-1 order-md-2">
                        <? //560 X 500 ?>
                        <? if(!empty($arItem['PREVIEW_PICTURE'])){
                            $PR = PRM::PR($arItem['PREVIEW_PICTURE'], $arSize = array("width" => 560, "height" => 500), BX_RESIZE_IMAGE_EXACT);  ?>
                            <img src="<?=$PR['SRC']?>" title="<?=$arItem['NAME']?>" alt="<?=$arItem['NAME']?>" class="slide-img">
                        <? }else{ ?>
                            <img src="<?=PRM::SRC(800)?>" title="<?=$arItem['NAME']?>" alt="<?=$arItem['NAME']?>" class="slide-img">
                        <? } ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
        </div></div></div>
    </div>
    <?/*<div class="particles-courses-right" id="particles-courses-right"></div>*/?>
</section><!--//end courses-->
<? endif;