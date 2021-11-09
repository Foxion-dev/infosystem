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
<div class="catalog-section-courses">
    <?foreach($arResult["ITEMS"] as $arElement):?>
        <? //
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="nearest-courses-items" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
            <div class="row">
                <div class="col-12"><div class="nearest-courses-items-title"><div class="date icon-calendar"><?=FormatDate("d F Y",strtotime($arElement['DISPLAY_PROPERTIES']['DATE']['VALUE']))?></div>   |   <?=$arElement['DISPLAY_PROPERTIES']['CITY']['VALUE']?>   |   ID-<?=$arElement['ID']?></div></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8"><div class="nearest-courses-items-body"><?=$arElement['NAME']?></div></div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2 nearest-courses-items-line">
                    <?foreach($arElement["ITEM_PRICES"] as $code=>$arPrice):?>
                        <div class="nearest-courses-items-prise"><small>Цена:</small> <span><?=number_format($arPrice['BASE_PRICE'], 0, '', ' ')?> ₽</span></div>
                    <?endforeach;?>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2 nearest-courses-items-line">
                    <div class="nearest-courses-items-click">
                        <form action="<?=POST_FORM_ACTION_URI?>" method="post" class="SubmitFormAjax">
                            <? if(!empty($arElement['PREVIEW_PICTURE'])): ?>
                                <input type="hidden" name="PREVIEW_PICTURE" value="<?=$arElement['PREVIEW_PICTURE']['SRC']?>">
                            <? endif; ?>
                            <input type="hidden" name="NAME" value="<?=$arElement['NAME']?>">
                            <input type="hidden" name="<?=$arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1">
                            <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]?>" value="BUY">
                            <input type="hidden" name="<?=$arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
                            <input type="hidden" name="go" value="ADD2BASKETBYPRODUCTID">
                            <button type="submit" name="<?=$arParams["ACTION_VARIABLE"]."ADD2BASKETBYPRODUCTID"?>" class="button button--common button--primary">Записаться</button>
                        </form>
                        <a class="item-content-click-more" href="<?=$arElement['DETAIL_PAGE_URL']?>">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
</div>
