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
<div class="row news-list">
    <div class="col-lg-12 news-item-body">
        <div class="row">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<? /**/ ?>
    <? if(!empty($arItem['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'])): ?>
        <? // p($arItem['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE'],'p');
    if(!empty($arItem['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE'][0])):
        $FILE_VALUE = $arItem['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE'][0]; ?>
            <? //for ($ps=0; $ps<1; $ps++){ if(!empty($FILE_VALUE[$ps])): ?>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="photo-block">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="album album--small">
                            <img src="<?=$FILE_VALUE['SRC']?>" alt="<?=$FILE_VALUE['DESCRIPTION']?>" class="album-pic">
                            <div class="title"><p><?=$arItem["DISPLAY_ACTIVE_FROM"]." / "?> <?=$arItem["NAME"]?></p></div>
                        </a>
                    </div>
                </div>
            <? //endif; } ?>
    <? endif; endif; ?>
    <? // p($arItem['IBLOCK_SECTION_ID'],'p'); ?>
<?endforeach;?>
        </div><!--// end row -->
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>