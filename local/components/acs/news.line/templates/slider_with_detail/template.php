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
<? $item = $arResult["ITEMS"];
    $item = array_chunk($item,4, false);
    ?>
<div  class="news-line-index owl-carousel" style="margin-bottom:30px;">
<? foreach ($item as $k=>$value): ?>
    <div class="slide slide-<?=$k+1?>">
        <div class="row">
            <?foreach($value as $arItem):?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <?  //
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? // 290 x 200 ?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <? if(!empty($arItem['PREVIEW_PICTURE'])){
                        $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 400, "height" => 400], BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                        <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>"  alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="item-pic">
                    <? }else{ ?>
                        <img src="<?=PRM::SRC(500)?>" title="<?=$arItem["NAME"]?>" 123 alt="<?=$arItem["NAME"]?>" class="item-pic">
                    <? } ?>
                    <div class="item-content">
<?if(!empty($arItem['DISPLAY_ACTIVE_FROM'])){?><p class="date icon-calendar"><?=$arItem['DISPLAY_ACTIVE_FROM']?></p><?}?>
                        <p class="title"><?=$arItem["NAME"]?></p>
                    </div>
                </a>
            </div>
            <?endforeach;?>
        </div>
    </div>
<?endforeach;?>
</div>
<? endif; ?>