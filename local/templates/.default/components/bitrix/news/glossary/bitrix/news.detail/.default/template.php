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
    <?if(!empty($arResult['BANNERS'])){ ?>
        <div class="news_banner owl-carousel">
            <?foreach ($arResult['BANNERS'] as $key => $banner){ ?>
                <a href="<?=$banner['PROPERTY_LINK_VALUE'];?>" id="banner-item">
                    <img src="<?=CFile::GetPath($banner['DETAIL_PICTURE']);?>" />
                </a>
            <? } ?>
        </div>
    <? } ?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
    <div class="DISPLAY_PROPERTIES_<?=$pid?>">
        <? if($pid=='DOC'): ?>
            <?=$arProperty["NAME"]?>:
            <? $FILE_VALUE = (is_array($arProperty["DISPLAY_VALUE"])?$arProperty['FILE_VALUE']:[$arProperty['FILE_VALUE']]);
            $F  = [];
            foreach ($FILE_VALUE as $FV):
                $F[] = '<a href="'.$FV['SRC'].'">'.($FV['DESCRIPTION']?$FV['DESCRIPTION']:'Скачать').'</a>'; //
            endforeach;
            echo '<span>'.implode(' / ',$F).'</span>';
            ?>
        <? elseif($pid=='NUMBER'): ?>
            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <span><?=implode(" / ", $arProperty["DISPLAY_VALUE"]);?></span>
            <?else:?>
                <span><?=$arProperty["DISPLAY_VALUE"];?></span>
            <?endif?>
        <? elseif($pid=='SOURCE'): ?>
            <?=$arProperty["NAME"]?>:&nbsp;
            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <span><?=implode(" / ", $arProperty["DISPLAY_VALUE"]);?></span>
            <?else:?>
                <span><?=($arProperty['DESCRIPTION']?'<a target="_blank" href="'.$arProperty['DESCRIPTION'].'">'.$arProperty["DISPLAY_VALUE"].'</a>':$arProperty["DISPLAY_VALUE"]);?></span>
            <?endif?>
        <? else: ?>
            <?=$arProperty["NAME"]?>:&nbsp;
            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <span><?=implode(" / ", $arProperty["DISPLAY_VALUE"]);?></span>
            <?else:?>
                <span><?=$arProperty["DISPLAY_VALUE"];?></span>
            <?endif?>
        <? endif; ?>
    </div>
	<?endforeach; ?>
</div>