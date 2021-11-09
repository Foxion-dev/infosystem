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
<div class="row experts-detail">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="experts-detail-item">
            <?if(!empty($arResult['PREVIEW_PICTURE'])):?>
                <? // 160 X 160
                $PR = PRM::PR($arResult['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 160, "height" => 160));  ?>
                <img src="<?=$PR['SRC']?>" title="<?=$arResult["PREVIEW_PICTURE"]['TITLE']?>" alt="<?=$arResult["PREVIEW_PICTURE"]['ALT']?>">
            <?else:?>
                <img src="<?=PRM::SRC(160)?>" title="<?=$arResult["NAME"]?>">
            <? endif; ?>
            <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                <div class="experts-items-person"><?=$arResult["NAME"]?></div>
            <?endif;?>
            <? if(!empty($arResult["DISPLAY_PROPERTIES"]['POSITIONS'])): ?>
                <div class="experts-items-person-position"><?=$arResult["DISPLAY_PROPERTIES"]['POSITIONS']['VALUE']?></div>
            <? endif; ?>
            <div class="experts-items-person-button">
            <? if(!empty($arResult['DISPLAY_PROPERTIES']['YOUTUBE'])): ?>
                <a href="<?=$arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE']?>" class="button button--common button--primary fancybox-media">Интервью</a>
            <? endif; ?>
            <?/*<a href="javascript:void(0);" class="button button--common button--primary experts-post-mail" data-name="<?=$arResult["NAME"]?>" <?=(!empty($arResult['DISPLAY_PROPERTIES']['POST_MAIL'])?'rel="'.$arResult['DISPLAY_PROPERTIES']['POST_MAIL']['VALUE'].'"':'')?>>Связаться</a>*/?>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 col-lg-9">
        <? if($arResult["PREVIEW_TEXT"]): ?>
            <div class="experts-detail-text">
                <div class="experts-detail-text-body" style="">
                <?echo $arResult["PREVIEW_TEXT"];?>
                </div>
                <?/*<button onclick="/*$(this).hide(300); $('div.experts-detail-text-body').attr('style','');toggleHeight(this)">Развернуть</button>*/?>
            </div>
            <script>
                function toggleHeight(this_){
                    if($(this_).text()=='Развернуть'){
                        $(this_).text('Скрыть');
                        $('div.experts-detail-text-body').attr('style','');
                    }else{
                        $(this_).text('Развернуть')
                        $('div.experts-detail-text-body').attr('style','overflow: hidden; height: 170px;');
                    }
                }
            </script>
        <? endif; ?>
    </div>
</div>