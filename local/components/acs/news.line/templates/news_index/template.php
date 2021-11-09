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
if(count($arResult["ITEMS"])):
?>
<div class="row">
	<?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
		<?  //
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
        <? // 290 x 200 ?>
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <? if(!empty($arItem['PREVIEW_PICTURE'])){
                $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 800, "height" => 600], BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="item-pic">
            <? }else{ ?>
                <img src="<?=PRM::SRC(500)?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" class="item-pic">
            <? } ?>
            <div class="item-content">
                <p class="date icon-calendar"><?=$arItem['DISPLAY_ACTIVE_FROM']?></p>
                <p class="title"><?=$arItem["NAME"]?></p>
            </div>
        </a>
    </div>
	<?endforeach;?>
</div>
<? endif; ?>