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
<div class="particles-bg-4" id="particles-bg-4"></div>
<section class="main" id="particles-body-top" style="position: relative; z-index: 3;"><div class="container">
<div class="row news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<? //p($arItem,'p');
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="col-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="news-list-item">
        <div class="row">
                <div class="col-10"><a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><? if($arItem["DISPLAY_ACTIVE_FROM"]): ?><?=$arItem["DISPLAY_ACTIVE_FROM"]?> /<? endif; ?> <?=$arItem["NAME"]?></a></div>
                <div class="col-2">
                    <?$APPLICATION->IncludeComponent("acs:acs.share","",
                        [
                            "data-title"=>$arItem["NAME"],
                            "data-url"=>$arItem["DETAIL_PAGE_URL"],
                            "data-description"=>my_crop($arItem["PREVIEW_TEXT"],200),
                        ],
                        $component, array('HIDE_ICONS' => 'N'));  ?>
                </div>
                <? if(!empty($arItem['PREVIEW_PICTURE'])){
                    $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 800, "height" => 500));  ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
                    <a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" class="img-responsive">
                    </a>
                </div>
                <? } ?>
                <div class="<?=(!empty($arItem['PREVIEW_PICTURE'])?'col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10':'col-12')?>">
                    <div class="preview-text"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>
        </div>
        </div>
	</div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
</div></section>
