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
<div class="row experts-list">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?  //p($arItem,'p');
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <? // 120 x 120 ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="field_image">
                <? if(!empty($arItem['PREVIEW_PICTURE'])){
                    $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 120, "height" => 120));  ?>
                    <img src="<?=$PR['SRC']?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" class="img-responsive">
                <? }else{ ?>
                    <img src="<?=PRM::SRC(120)?>" title="<?=$arItem["NAME"]?>">
                <? } ?>
                <div class="experts-items-person"><?=$arItem["NAME"]?></div>
                <div class="experts-items-person-position"><?=$arItem['PROPERTY_POSITIONS_VALUE']?></div>
            </div>
        </div>
    <?endforeach;?>
</div>
<? endif; ?>