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

if (empty($arResult["ITEMS"])) {
    return true;
}
?>

<div id="SitAtHome" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog-vah">
        <div class=" modal-dialog-vac">
            <div class="modal-dialog" role="document">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?=$arItem['PROPERTIES']['PROP_0']['VALUE']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?=$arItem['PROPERTIES']['PROP_1']['~VALUE']['TEXT']?>
                        </div>
                        <?if($arItem['PROPERTIES']['PROP_2']['VALUE'] != ""){ ?>
                            <div class="modal-footer">
                                <a href="<?=$arItem['PROPERTIES']['PROP_2']['VALUE']?>">Подробнее</a>
                            </div>
                        <? } ?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>
