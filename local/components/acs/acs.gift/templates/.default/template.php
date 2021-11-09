<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//
$this->setFrameMode(true);
//
// p($arParams,'p');
// p($arResult['ITEMS'],'p');
if(count($arResult['ITEMS'])): ?>
    <div class="row">
    <? foreach ($arResult['ITEMS'] as $ITEM): ?>
        <div class="col-12 col-sm-12 col-md-5th col-lg-5th col-xs-5th">
            <div class="gift-item">
                <div class="gift-item-img click-more" rel="<?=$ITEM['ID']?>">
                <? if($ITEM['PREVIEW_PICTURE']){ ?>
                    <? $PR = PRM::PR($ITEM['PREVIEW_PICTURE'], $arSize = ["width" => 800, "height" => 600]); ?>
                    <img src="<?=$PR['SRC']?>" alt="<?=$ITEM['NAME']?>" title="<?=$ITEM['NAME']?>">
                <? }else{ ?>
                    <img src="<?=PRM::SRC(500)?>" alt="<?=$ITEM['NAME']?>" title="<?=$ITEM['NAME']?>">
                <? } ?>
                </div>
                <div class="gift-item-teaser">
                    <div class="gift-item-teaser-title"><?=$ITEM['NAME']?></div>
                    <div class="gift-item-teaser-price">Цена: <?=number_format($ITEM['PRICE'], 0, '', ' ')?> баллов</div>
                    <div class="gift-item-more-body">
                        <a href="#" class="gift-item-more click-more" rel="<?=$ITEM['ID']?>">Подробней</a>
                        <button type="button" class="button button--common button--primary gift-basket" rel="<?=$ITEM['ID']?>" data-title="<?=$ITEM['NAME']?>" data-price="<?=intval($ITEM['PRICE'])?>">Получить</button>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    </div>
<? endif;