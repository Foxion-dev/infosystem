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
<div class="<?/*standards-list*/?>catalog-section-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
    <div class="standards-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="row">
            <div class="col-12">
				<?/*<div class="standards-item-title">п/п | <?=$arItem["NAME"]?></div></div>*/?>
            <? if(!empty($arItem["DISPLAY_PROPERTIES"]['DOC']['FILE_VALUE'])):
                $fl = (count($arItem["DISPLAY_PROPERTIES"]['DOC']['VALUE'])>1?$arItem["DISPLAY_PROPERTIES"]['DOC']['FILE_VALUE']:[$arItem["DISPLAY_PROPERTIES"]['DOC']['FILE_VALUE']]);
				?><ul><?
                foreach ($fl as $f=>$FILE_VALUE):
                    if(!$FILE_VALUE['SRC'])continue;
                    ?>
                    <?/*<div class="col-12">*/?>
					<li>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i><a class="<?/*standards-item-text*/?>" href="<?=$FILE_VALUE['SRC']?>" title="Скачать файл"><?=($f+1)." / "?> <?=$FILE_VALUE['DESCRIPTION']?$FILE_VALUE['DESCRIPTION']:'(Скачать файл)'?></a>
					</li>
                    <?/*</div>*/?>
                    <?
                endforeach;?></ul><?
            endif; ?>
        </div>
    </div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
