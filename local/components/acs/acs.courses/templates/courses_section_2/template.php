<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//
$this->setFrameMode(true);?>
<section class="popular-coursers popular-coursers-2" <?if($arParams['first_hide']=='Y') echo "style='display:none;'";?>>
        <?if(count($arResult['ITEMS'])):?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper"><h5>популярные курсы</h5> <?/*?> <a href="javascript:void(0);" class="popular-coursers-filter-click">Фильтр</a>*/?></div>
                    <div class="row">
                        <? foreach ($arResult['ITEMS'] as $ITEM): ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="news-item">
                                <div class="item-content-header">
                                    <div class="date icon-calendar"><?=FormatDate("d F Y",strtotime($ITEM['PROPERTY_DATE_VALUE']))?></div>
                                    <div class="id-item">Код - <?=$ITEM['PROPERTIES']['ARTNUMBER']['VALUE']?></div>
                                    <div class="title"><?=$ITEM['PROPERTY_CITY_VALUE']?></div>
                                </div>
                                <? if($ITEM['PREVIEW_PICTURE']){ ?>
                                    <? $PR = PRM::PR($ITEM['PREVIEW_PICTURE'], $arSize = ["width" => 800, "height" => 600]); ?>
                                    <a href="<?=$ITEM['DETAIL_PAGE_URL']?>"><img src="<?=$PR['SRC']?>" alt="<?=$ITEM['NAME']?>" title="<?=$ITEM['NAME']?>" class="item-pic"></a>
                                <? }else{ ?>
                                    <a href="<?=$ITEM['DETAIL_PAGE_URL']?>"><img src="<?=PRM::SRC(500)?>" alt="<?=$ITEM['NAME']?>" title="<?=$ITEM['NAME']?>" class="item-pic"></a>
                                <? } ?>
                                <div class="item-content" style="padding: 6px 15px;">
                                    <div class="row">
                                        <div class="col-3 col-md-3 col-lg-3">
                                        <? if(count($ITEM['PROPERTIES']['METOD_TEACHING']['VALUE_XML_ID'])): foreach ($ITEM['PROPERTIES']['METOD_TEACHING']['VALUE_XML_ID'] as $kv=>$VXI): ?>
                                            <span class="<?=$VXI?>" title="<?=$ITEM['PROPERTIES']['METOD_TEACHING']['VALUE'][$kv]?>"></span>
                                        <? endforeach; endif; ?>
                                        </div>
                                        <div class="col-9 col-md-9 col-lg-9">
                                        <a href="<?=$ITEM['DETAIL_PAGE_URL']?>" class="title">
                                            <?=my_crop($ITEM['NAME'],50)?>
                                        </a></div>
                                    </div>
                                    <div class="item-content-prise"><small>Цена:</small> <span><?=number_format($ITEM['PRICE'], 0, '', ' ')?> <b>₽</b></span></div>
                                    <div class="item-content-click">
                                        <?/*<form action="<?=POST_FORM_ACTION_URI?>" method="post" class="SubmitFormAjax">
                                            <? if(!empty($PR)): ?>
                                                <input type="hidden" name="PREVIEW_PICTURE" value="<?=$PR['SRC']?>">
                                            <? endif; ?>
                                            <input type="hidden" name="NAME" value="<?=$ITEM['NAME']?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="action" value="BUY">
                                            <input type="hidden" name="id" value="<?echo $ITEM["ID"]?>">
                                            <input type="hidden" name="go" value="ADD2BASKETBYPRODUCTID">
                                            <button type="submit" name="actionADD2BASKETBYPRODUCTID" class="button button--common button--primary">Записаться</button>
                                        </form>*/
                                        //var_dump($ITEM['PROPERTIES']);
                                        ?>
                                        <?=$ITEM['PROPERTIES']['BUTTON_CODE']['~VALUE']['TEXT']?>
                                    </div>
                                    <div class="item-content-prise-click"></div>
                                </div><!--//item-content-->
                            </div>
                        </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <? endif;?>
</section>