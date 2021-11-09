<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
// AddMessage2Log("\n".var_export($arResult, true). " \n \r\n ", "__arResult");
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?><div class="bx-hdr-profile">
    <? /**/ ?>
	<div class="bx-basket-block"><?
		if (!$arResult["DISABLE_USE_BASKET"])
		{ ?>
            <a href="<?=$arParams['PATH_TO_BASKET']?>" class="cart-body" title="<?=GetMessage('TSB1_CART')?>">
                <button type="button" class="button button--round button--primary cart-button icon-cart">
                <? if (!$compositeStub): if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'): ?>
                    <?if($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'):?>
                        <span><?=str_replace(["руб."], "<small>₽</small>", $arResult['TOTAL_PRICE'])?></span>
                    <?endif ?>
                <?endif; endif;?>
                </button>
            </a>
        <? } ?>
	</div>
</div>