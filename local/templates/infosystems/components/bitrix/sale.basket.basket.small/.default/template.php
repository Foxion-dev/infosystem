<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<?if(count($arResult["ITEMS"]) > 0):?>
<a href="/personal/cart/" class="cart-body">
    <button type="button" class="button button--round button--primary cart-button icon-cart">
    <?/*if(!$arResult["DISABLE_USE_BASKET"]): ?>
        <?if($arResult['TOTAL_PRICE_FORMATED']): ?>
        <span><?=$arResult['TOTAL_PRICE_FORMATED']?> <small>₽</small></span>
        <?endif;?>
    <?endif;*/?>
    </button>
</a>
<?endif;?>