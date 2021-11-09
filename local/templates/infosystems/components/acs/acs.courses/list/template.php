<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//
$this->setFrameMode(true);
//
// p($arResult['ITEMS'][0]['PROPERTIES']['METOD_TEACHING'],'p');
if(count($arResult['ITEMS'])): ?>
<div class="lineWidth" style="margin-left: calc(-50vw + 50%);"></div>
<h5 style="margin-top: 0px;">Курсы</h5>
<div class="catalog-section-courses">
    <? foreach ($arResult['ITEMS'] as $arElement): ?>
    <div class="nearest-courses-items">
        <div class="row">
            <div class="col-12">
                <div class="nearest-courses-items-title">
                    <div class="date icon-calendar">
                    <?=FormatDate("d F Y",strtotime($arElement['PROPERTY_DATE_VALUE']))?></div>   |
                    <?=$arElement['PROPERTY_CITY_VALUE']?>   |
                    Код - <?=$arElement['PROPERTIES']['ARTNUMBER']['VALUE']?></div></div>
            <div class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 nearest-courses-icon">
                <? if(count($arElement['PROPERTIES']['METOD_TEACHING']['VALUE_XML_ID'])): foreach ($arElement['PROPERTIES']['METOD_TEACHING']['VALUE_XML_ID'] as $vk=>$VX): ?>
                    <span class="<?=$VX?>" title="<?=$arElement['PROPERTIES']['METOD_TEACHING']['VALUE'][$kv]?>"></span>
                <? endforeach; endif; ?>
            </div>
            <div class="col-10 col-sm-10 col-md-10 col-lg-7 col-xl-7">
                <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="nearest-courses-items-body"><?=$arElement['NAME']?></a>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2 nearest-courses-items-line">
                <div class="nearest-courses-items-prise">
                	<small>Цена:</small>
                	<span>
                		<?=number_format($arElement['PRICE'], 0, '', ' ')?>
                		<?if(in_array(1147,$arElement['PROPERTIES']["EXPERTS"]["VALUE"])):?>
                		у.е
                		<?else:?>
                		руб.
                		<?endif;?>
                	</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2 nearest-courses-items-line">
                <div class="nearest-courses-items-click">
                    <? if($arElement['PREVIEW_PICTURE']): ?>
                        <? $PR = PRM::PR($arElement['PREVIEW_PICTURE'], $arSize = ["width" => 270, "height" => 180]); ?>
                    <? endif; ?>
                    <?/*<form action="<?=POST_FORM_ACTION_URI?>" method="post" class="SubmitFormAjax">
                        <? if(!empty($PR)): ?>
                            <input type="hidden" name="PREVIEW_PICTURE" value="<?=$PR['SRC']?>">
                        <? endif; ?>
                        <input type="hidden" name="NAME" value="<?=$arElement['NAME']?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="action" value="BUY">
                        <input type="hidden" name="id" value="<?echo $arElement["ID"]?>">
                        <input type="hidden" name="go" value="ADD2BASKETBYPRODUCTID">
                        <button type="submit" name="actionADD2BASKETBYPRODUCTID" class="button button--common button--primary">Записаться</button>
                    </form>*/?>
                    <div class="item-content-click">
                        <a class="item-content-click-more " href="<?=$arElement['DETAIL_PAGE_URL']?>">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>
<? endif;?>