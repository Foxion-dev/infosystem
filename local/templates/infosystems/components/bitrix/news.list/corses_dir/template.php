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
		<div class="col-12">
			<div class="ff-title">
				 Курсы по направлениям<br>
			</div>
		</div>
<?$i = 0;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?if($i == 0 || $i == 2 || $i == 4 || $i == 6){?>
<div class="col-12 col-md-12 col-lg-6 countpic<?=$i?>" style="padding-bottom: 30px;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div>
				<img class="preview_picturee" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
				style="width: calc(100% + 15px);"/>
			</div>
</div>
<div class="col-12 col-md-12 col-lg-6 countinfo<?=$i?>">
	<div class="bx-name-direct">
 		<?=$arItem["NAME"]?>
	</div>
	<div>
		<br><br><br><?echo $arItem["PREVIEW_TEXT"];?>
	</div>
	<?if(!empty($arItem["PROPERTIES"]["PROP_0"]["VALUE"])){?>
	<div>
		<br><br><div class="btn-z" style="position: absolute;bottom: 30px;-webkit-border-radius: 5px;border-radius: 5px;background: #8CD50B;width:190px;height:50px;display:flex;align-items:center;justify-content:center;">
	 		<a href="<?=$arItem["PROPERTIES"]["PROP_0"]["VALUE"]?>" style="font-style: normal;font-weight: 600;text-decoration:none;color: #272727;font-size: 13px;text-transform: uppercase;border-radius: 5px;cursor: pointer;">Заявка</a>
		</div>
	</div>
	<?}?>
</div>
<?}else{?>
<div class="col-12 col-md-12 col-lg-6 countinfo<?=$i?>">
	<div class="bx-name-direct">
 		<?=$arItem["NAME"]?>
	</div>
	<div>
		<br><br><br><?echo $arItem["PREVIEW_TEXT"];?>
	</div>
	<?if(!empty($arItem["PROPERTIES"]["PROP_0"])){?>
	<div>
	 	<br><br><div class="btn-z" style="position: absolute;bottom: 30px;-webkit-border-radius: 5px;border-radius: 5px;background: #8CD50B;width:190px;height:50px;display:flex;align-items:center;justify-content:center;">
	 		<a href="<?=$arItem["PROPERTIES"]["PROP_0"]["VALUE"]?>" style="font-style: normal;font-weight: 600;text-decoration:none;color: #272727;font-size: 13px;text-transform: uppercase;border-radius: 5px;cursor: pointer;">Заявка</a>
		</div>
	</div>
	<?}?>
</div>
<div class="col-12 col-md-12 col-lg-6 countpic<?=$i?>" style="padding-bottom: 30px;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div>
				<img class="preview_picturee" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
				style="width: calc(100% + 15px);"/>
			</div>
</div>
<?}?>
<?$i++;?>
<?endforeach;?>
</div>



