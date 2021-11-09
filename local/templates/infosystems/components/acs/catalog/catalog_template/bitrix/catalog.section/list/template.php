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
$this->setFrameMode(true);?>
<div class="catalog-section-courses">
    <?foreach($arResult["ITEMS"] as $c=>$arElement):?>
        <?
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="nearest-courses-items" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <ul class="nearest-courses-items-title">
                        <li>
                            Код - <?=$arElement['PROPERTIES']['ARTNUMBER']['VALUE']?>
                        </li>
                        <?php if ($arElement['FIRST_SECTION']['NAME']):?>
                            <li>
                                <?=(!empty($arElement['FIRST_SECTION']['IBLOCK_SECTION_ID']['NAME'])
                                    ?$arElement['FIRST_SECTION']['IBLOCK_SECTION_ID']['NAME'].' / '
                                    :'')?>
                                <?=$arElement['FIRST_SECTION']['NAME']?>
                            </li>
                        <?php endif?>
                        <?php if ($arElement['PROPERTIES']['VENDOR']['VALUE']):?>
                            <li>
                                Вендор:
                                <?php foreach ($arElement['PROPERTIES']['VENDOR']['VALUE'] as $keyVendor => $vendorId):?>
                                     <?=$arElement['DISPLAY_PROPERTIES']['VENDOR']['LINK_ELEMENT_VALUE'][$vendorId]['NAME']?>
                                <?php endforeach?>
                            </li>
                        <?php endif?>
                    </ul>
                    <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="nearest-courses-items-body"><?=$arElement['NAME']?></a>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="nearest-courses-items-details">
						<div class="form-study"><?=$arElement['PROPERTIES']['FORM_TRAINING']['VALUE']?></div>
                        <?if(!empty($arElement['DISPLAY_PROPERTIES']['DATES']['VALUE'])){
                            foreach($arElement['PROPERTIES']['DATES']['VALUE'] as $val){?>
                                <div class="date"><?=$val?></div>
                            <?}
                        }else{?>
                            <a href="javascript:;">Уточняйте у менеджера</a>
                        <?}?>
					</div>
                </div>
                <div class="col-8 col-sm-4 col-lg-2 align-self-center">
                    <?foreach($arElement["ITEM_PRICES"] as $code=>$arPrice):?>
                        <div class="nearest-courses-items-prise">
                            <?/*<small>Цена:</small>*/?>
                            <?if($arPrice['BASE_PRICE']>0){?>
                            <span>
                                <?=CurrencyFormat($arPrice['BASE_PRICE'], $arPrice['CURRENCY'])?>
                            </span>
                            <?}else{?>
                                <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="button free">Бесплатно</a>
                                <?if(!empty($arElement['PROPERTIES']['WEBINAR_RECORDING']['VALUE'])):?>
                                <br /><br />
                                <a href="<?=$arElement['PROPERTIES']['WEBINAR_RECORDING']['VALUE']?>" target="_blank" class="button free">Запись</a>
                                <?endif;?>
                                
                            <?}?>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="col-4 col-sm-2 col-lg-1 d-flex align-self-center">
                    <div class="nearest-courses-items-click">
                        <div><a class="item-content-click-more" href="<?=$arElement['DETAIL_PAGE_URL']?>"></a></div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
</div>