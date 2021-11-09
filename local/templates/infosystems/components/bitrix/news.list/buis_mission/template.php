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
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?if(!empty($arItem["PROPERTIES"]["PROP_3"]["VALUE"])){?>
<?$picid = $arItem["PROPERTIES"]["PROP_3"]["VALUE"];?>
	<div class="col-12 col-sm-6 col-lg-4 bx-itemconf" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if(!empty($arItem["PROPERTIES"]["PROP_2"]["VALUE"])){?>
		<a href="<?=$arItem["PROPERTIES"]["PROP_2"]["VALUE"]?>">
		<?}?>
			<div class="wrap_block" style="background-image: url(<?=CFile::GetPath($picid);?>);background-repeat: no-repeat;">
			</div>
		<?if(!empty($arItem["PROPERTIES"]["PROP_2"]["VALUE"])){?>
		</a>
		<?}?>
	</div>
<?}else{?>
	<div class="col-12 col-sm-6 col-lg-4 bx-itemconf" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if(!empty($arItem["PROPERTIES"]["PROP_2"]["VALUE"])){?>
		<a href="<?=$arItem["PROPERTIES"]["PROP_2"]["VALUE"]?>">
		<?}?>
			<div class="wrap_block" <?if(!empty($arItem["PROPERTIES"]["PROP_1"]["VALUE"])){?>style="background-color:<?=$arItem["PROPERTIES"]["PROP_1"]["VALUE"]?>;"<?}?>>
				<div class="bx-logo text-center">
					<img class="preview_picture" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"/>
				</div>
				<div class="bx-name text-center">
					<?=$arItem["NAME"]?>
				</div>
				<div class="bx-date text-center">
				<div class="mini-border"></div>
					<?=$arItem["PREVIEW_TEXT"];?>
				</div>
				<?if(!empty($arItem["DETAIL_TEXT"])){?>
				<div class="bx-link" <?if(!empty($arItem["PROPERTIES"]["PROP_0"]["VALUE"])){?>style="background-color:<?=$arItem["PROPERTIES"]["PROP_0"]["VALUE"]?>;"<?}?>>
						<?=$arItem["DETAIL_TEXT"];?>
				</div>
				<?}?>
			</div>
		<?if(!empty($arItem["PROPERTIES"]["PROP_2"]["VALUE"])){?>
		</a>
		<?}?>
	</div>
<?}?>
<?endforeach;?>
</div>



