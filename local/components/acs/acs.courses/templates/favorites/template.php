<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//
$this->setFrameMode(true);
//
// p($arParams['UF_CALENDAR'],'p');
// p($arResult['ITEMS'][0]['PROPERTIES']['METOD_TEACHING'],'p');
if(count($arResult['ITEMS'])): ?>
    <section class="nearest-courses"><div class="container"><div class="col-12">
    <h2>Избранные курсы</h2>
<div class="catalog-section-courses">
    <? foreach ($arResult['ITEMS'] as $arElement): ?>
    <div class="nearest-courses-items">
        <div class="row">
            <div class="col-12"><div class="nearest-courses-items-title"><div class="date icon-calendar"><?=FormatDate("d F Y",strtotime($arElement['PROPERTY_DATE_VALUE']))?></div>   |   <?=$arElement['PROPERTY_CITY_VALUE']?>   |   ID-<?=$arElement['ID']?></div></div>
            <?/*<div class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 nearest-courses-icon">
                <? if(count($arElement['PROPERTIES']['METOD_TEACHING']['VALUE_XML_ID'])): foreach ($arElement['PROPERTIES']['METOD_TEACHING']['VALUE_XML_ID'] as $vk=>$VX): ?>
                    <span class="<?=$VX?>" title="<?=$arElement['PROPERTIES']['METOD_TEACHING']['VALUE'][$kv]?>"></span>
                <? endforeach; endif; ?>
            </div>*/?>
            <div class="col-12 col-sm-12 col-md-9 col-lg-10 col-xl-10">
                <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="nearest-courses-items-body"><?=$arElement['NAME']?></a>
            </div>
            <?/*<div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2 nearest-courses-items-line">
                <div class="nearest-courses-items-prise"><small>Цена:</small> <span><?=number_format($arElement['PRICE'], 0, '', ' ')?> ₽</span></div>
            </div>*/?>
            <div class="col-3 col-sm-3 col-md-3 col-lg-2 col-xl-2 nearest-courses-items-line personal-user-oll">
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
                    </form> */?>
                    <a class="item-content-click-more" href="<?=$arElement['DETAIL_PAGE_URL']?>">Подробнее</a>
                </div>
            </div>
            <div class="col-12"><div class="nearest-courses-items-footer">
                    <a href="javascript:void(0);" rel="<?=$arElement['ID']?>" class="user-add-photo"><i class="fa fa-camera" aria-hidden="true"></i> Добавить фото</a>
                    <a href="javascript:void(0);" rel="<?=$arElement['ID']?>" class="user-add-video"><i class="fa fa-youtube-play" aria-hidden="true"></i> Добавить видео</a>
                    <a href="javascript:void(0);" rel="<?=$arElement['ID']?>" class="user-add-notice"><i class="fa fa-calendar" aria-hidden="true"></i> Установить уведомления</a>
                </div></div>
        </div>
    </div>
    <? endforeach; ?>
</div></div></section>
<? endif;