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
<div class="row experts-news-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="experts-news-item">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <? // 120 X 120
            $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 120, "height" => 120));  ?>
            <img src="<?=$PR['SRC']?>" title="<?=$arItem["PREVIEW_PICTURE"]['TITLE']?>" alt="<?=$arItem["PREVIEW_PICTURE"]['ALT']?>">
        <?else:?>
            <img src="<?=PRM::SRC(120)?>" title="<?=$arItem["NAME"]?>">
        <? endif; ?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
            <div class="experts-items-person"><?echo $arItem["NAME"]?></div>
		<?endif;?>
            <? //p($arItem["DISPLAY_PROPERTIES"]['POSITIONS'],'p'); ?>
        <? if(!empty($arItem["DISPLAY_PROPERTIES"]['POSITIONS'])): ?>
            <div class="experts-items-person-position"><?=$arItem["DISPLAY_PROPERTIES"]['POSITIONS']['VALUE']?></div>
        <? endif; ?>
        </a><!--//experts-news-item-->
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
