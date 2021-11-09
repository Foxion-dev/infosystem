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
<? if(!empty($arResult['DISPLAY_PROPERTIES']['PICS_NEWS'])): ?>
<section class="academy-information academy-information-background news-detail-pisc">
    <div class="container">
        <div class="row">
            <? //p($arResult['DISPLAY_PROPERTIES']['PICS_NEWS'],'p'); ?>
            <? if(count($arResult['DISPLAY_PROPERTIES']['PICS_NEWS']['VALUE'])>1): foreach ($arResult['DISPLAY_PROPERTIES']['PICS_NEWS']['FILE_VALUE'] as $p=>$PICS_NEW): ?>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 news-detail-img" <?=($p>3?'style="display: none;"':'')?>>
                <a href="<?=$PICS_NEW['SRC']?>" class="fancybox" data-fancybox="group">
                    <? $PR = PRM::PR($PICS_NEW['ID'], ["width" => 500, "height" => 800]);  ?>
                    <img src="<?=$PR['SRC']?>" class="img-responsive">
                </a>
            </div>
            <? endforeach; else:
                $PICS_NEW = $arResult['DISPLAY_PROPERTIES']['PICS_NEWS']['FILE_VALUE']; ?>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 news-detail-img">
                <a href="<?=$PICS_NEW['SRC']?>" class="fancybox" data-fancybox="group">
                    <? $PR = PRM::PR($PICS_NEW['ID'], ["width" => 260, "height" => 165]);  ?>
                    <img src="<?=$PR['SRC']?>" class="img-responsive">
                </a>
            </div>
            <?
            endif; ?>
        </div>
    </div>
    <? if(count($arResult['DISPLAY_PROPERTIES']['PICS_NEWS']['VALUE'])>4): ?>
    <button onclick="$(this).hide(300); $('div.news-detail-img').show(300);">Развернуть</button>
    <? endif; ?>
</section>
<? endif; ?>
<section class="main news-detail"><div class="container"><div class="row"><div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="news-detail-active-from"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
            </div>
        </div>
        <div class="news-detail-text">
            <? if(!empty($arResult['DETAIL_PICTURE'])): ?>
            <a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox">
                <img class="news-detail-text-img" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['TITLE']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
            </a>
            <? endif; ?>
            <? if($arResult['DETAIL_TEXT']): ?>
                <? print $arResult['DETAIL_TEXT']; ?>
            <? elseif ($arResult['PREVIEW_TEXT']): ?>
                <? print $arResult['PREVIEW_TEXT']; ?>
            <? endif; ?>
        </div>
        <? //p($arResult['DISPLAY_PROPERTIES']['SOURCE'],'p'); ?>
        <? if(!empty($arResult['DISPLAY_PROPERTIES']['SOURCE'])): ?>
        <div class="news-source-text">
            <span><?=$arResult['DISPLAY_PROPERTIES']['SOURCE']['NAME'].": "?></span>
            <?if($arResult['DISPLAY_PROPERTIES']['SOURCE']['DESCRIPTION']):?>
                <a rel="nofollow" href="<?=$arResult['DISPLAY_PROPERTIES']['SOURCE']['DESCRIPTION']?>" target="_blank"><?=$arResult['DISPLAY_PROPERTIES']['SOURCE']['VALUE']?></a>
            <? else: ?>
                <?=$arResult['DISPLAY_PROPERTIES']['SOURCE']['VALUE']?>
            <? endif; ?>
        </div>
        <? endif; ?>
        <? if(!empty($arResult['DISPLAY_PROPERTIES']['DOC'])): ?>
            <div class="news-source-text">
            <strong><?=$arResult['DISPLAY_PROPERTIES']['DOC']['NAME']." "?></strong>
            <? $VALUE_F = [];
            foreach($arResult['DISPLAY_PROPERTIES']['DOC']['VALUE'] as $f=>$DISPLAY_PROPERTY){
                $DESCRIPTION_F = $arResult['DISPLAY_PROPERTIES']['DOC']['DESCRIPTION'][$f]?$arResult['DISPLAY_PROPERTIES']['DOC']['DESCRIPTION'][$f]:"Скачать файл";
                $VALUE_F[] = '<a href="'.CFile::GetPath($DISPLAY_PROPERTY).'">'.$DESCRIPTION_F.'</a>';
            }
            echo implode(" / ",$VALUE_F); ?>
            </div>
        <? endif; ?>
</div></div></div></section>
<? if(!empty($arResult['DISPLAY_PROPERTIES']['YOUTUBE'])): ?>
<section class="videogallery">
    <div class="main-video">
        <h3 class="title"><?=$arResult['DISPLAY_PROPERTIES']['YOUTUBE']['DESCRIPTION']?></h3>
        <a href="<?=$arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE']?>" class="play-button fancybox-media"></a>
    </div>
</section>
<? endif; ?>
<?/*<div class="row experts-detail">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="experts-detail-item">
            <?if(!empty($arResult['PREVIEW_PICTURE'])):?>
                <? // 160 X 160
                $PR = PRM::PR($arResult['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 160, "height" => 160));  ?>
                <img src="<?=$PR['SRC']?>" title="<?=$arResult["PREVIEW_PICTURE"]['TITLE']?>" alt="<?=$arResult["PREVIEW_PICTURE"]['ALT']?>">
            <?endif?>
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
            <a href="#" class="button button--common button--primary email">Связаться</a>
            </div>
        </div>
    </div>
</div> */?>