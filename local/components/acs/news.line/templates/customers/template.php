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
<section class="academy-customers-list">
    <div class="container">
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $k=>$arItem): ?>
                <? if(!empty($arItem['PREVIEW_PICTURE'])){
                    $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 170, "height" => 75], BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                    <div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="academy-customers-items">
                            <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" class="img-responsive">
                        </div>
                    </div>
                <? } ?>
            <? endforeach; ?>
        </div>
    </div>
</section>
<? endif; ?>