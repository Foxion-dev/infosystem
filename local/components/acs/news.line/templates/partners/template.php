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
<section class="partners"><div class="container"><div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h5><?=$arParams['TITLE_PAGE']?></h5>
        <div class="partners-slider owl-carousel">
            <?$items = array_chunk($arResult["ITEMS"], 5, false);?>
            <?foreach($items as $k=>$itm){?>
                <? if(count($itm)==0) continue; ?>
                    <?$itmArr=$itm;?>
                    <?foreach($itmArr as $itmNext){?>
                            <?if(!empty($itmNext['PREVIEW_PICTURE'])){$PR = PRM::PR($itmNext['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 260, "height" => 160], BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                            <div class="slide">
                                
                                        <img src="<?=$PR['SRC']?>" title="<?=$itmNext['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$itmNext['PREVIEW_PICTURE']["ALT"]?>" class="img-fluid">
                                
                            </div>
                            <? } ?>
                    <? } ?>
            <?}?>
        </div>
    </div>
</div></div></section>
<? endif; ?>
