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
<div class="news-block">
    <h2><i class="demo-icon icon-newspaper"></i> <a href="/news/"><?=$arParams['TITLE_BLOCK']?></a></h2>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
        <? // 130 x 130 ?>
        <div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <? if(!empty($arItem['PREVIEW_PICTURE'])){
                $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 130, "height" => 130));  ?>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="news-image"><img src="<?=$PR['SRC']?>" alt=""></a>
            <? } ?>
            <div class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?>&nbsp;&nbsp;</div>
            <h3><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>
            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="more">Подробнее</a>
        </div>
	<?endforeach;?>
</div>
