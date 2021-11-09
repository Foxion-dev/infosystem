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
<div class="news-detail">
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
    <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
        <?echo $arResult["DETAIL_TEXT"];?>
    <?else:?>
        <?echo $arResult["PREVIEW_TEXT"];?>
    <?endif?>
    <? //p($arResult['DISPLAY_PROPERTIES']['PHOTOS'],'p'); ?>
    <? if(!empty($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'])): ?>
        <? $FILE_VALUE = [];
        $FILE_VALUE = (count($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'])>1?$arResult['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE']:[$arResult['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE']]);
        ?>
        <div class="row">
            <? foreach ($FILE_VALUE as $item){ ?>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="photo-block">
                        <a href="<?=$item['SRC']?>" class="album album--small fancybox" data-fancybox="group" rel="photo_arr">
                            <img src="<?=$item['SRC']?>" alt="<?=$item['DESCRIPTION']?>" class="album-pic">
                            <?if($item['DESCRIPTION']):?><p class="title"><?=$item['DESCRIPTION']?></p><? endif; ?>
                        </a>
                    </div>
                </div>
            <? } ?>
        </div><!--// end row -->
    <? endif; ?>
	<div style="clear:both"></div>
</div>