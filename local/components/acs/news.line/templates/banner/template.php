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
?>
<? if(count($arResult["ITEMS"])){?>
<div class="theme-warming-carousel">
    <div id="carousel-example-generic" class="carousel slide" data-interval="3000" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?foreach($arResult["ITEMS"] as $i=>$ai):?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" <?=($i==0?'class="active"':'')?>></li>
            <?endforeach;?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?foreach($arResult["ITEMS"] as $k=>$arItem):?>
                <div class="item text-center <?=($k==0?'active':'')?>">
                    <? if(!empty($arItem['PREVIEW_PICTURE'])){ ?>
                        <? if(strlen($arItem['PROPERTY_URL_VALUE'])>0){ ?>
                            <a href="<?=$arItem['PROPERTY_URL_VALUE']?>"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="img-responsive" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['ALT']?>"></a>
                        <? }else{ ?>
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="img-responsive" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                        <? } ?>
                    <? } ?>
                    <div class="carousel-caption">
                        <?echo $arItem["NAME"]?>
                    </div>
                </div>
            <?endforeach;?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon-glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon-glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
<? } ?>
