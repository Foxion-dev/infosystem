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
<?if(count($arResult["ITEMS"])>0):?>
	<div class="catalog-section-list">
		<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li>
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <?=(!empty($arItem["DISPLAY_PROPERTIES"]['NUMBER'])?$arItem["DISPLAY_PROPERTIES"]['NUMBER']['DISPLAY_VALUE']:"")?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                <? //p($arItem["DISPLAY_PROPERTIES"],'p'); ?>
            </li>
		<?endforeach;?>
		</ul>
	</div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
<?endif?>
