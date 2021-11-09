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
<div class="have-margin-top">
    <ul class="catalog-section-list">
        <?php foreach ($arResult['ITEMS'] as $arItem):?>
            <?php if ($arItem['PROPERTIES']['LINK']['VALUE']):?>
                <li>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="_blank" rel="nofollow">
                        <?=$arItem['NAME']?>
                    </a>
                </li>
            <?php else:?>
                <li>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                </li>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
</div>

<style>
    .catalog-section-list li {
        margin-bottom: 20px;
        position: relative;
        padding-left: 30px;
        font-size: 14px;
        font-family: 'OpenSans-Bold', Arial, Tahoma, Sans-Serif;
    }
    .catalog-section-list li i {
        position: absolute;
        left: 0px;
        top: 1px;
    }
</style>
