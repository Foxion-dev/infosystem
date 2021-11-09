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
<div class="row">
	<?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="col-xs-6 col-sm-12 col-md-12 col-lg-12"><div class="grayVip">
            <? if(!empty($arItem['DETAIL_PICTURE'])){
                $PR = PRM::PR($arItem['DETAIL_PICTURE']['ID'], $arSize = array("width" => 400, "height" => 250));  ?>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$PR['SRC']?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>" class="img-responsive"></a>
            <? } ?>
            <div class="grayVipTiser">
                <?/*<div class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>*/?>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="grayVipTiserHref"><?echo $arItem["NAME"]?></a>
                <?echo my_crop(strip_tags($arItem["PREVIEW_TEXT"]),100)?>
                <div class="row grayVipTiserText">
                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">подробнее</a>
                </div>
            </div>
        </div></div>
	<?endforeach;?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a href="/news/" class="couponVipOll">Смотреть все новости <i class="fa fa-chevron-right"></i></a>
    </div>
</div>
