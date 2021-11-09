<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['TOTAL_PRICE'] = 0;
//
foreach ($arResult['ITEMS'] as $key => $item){
    //
    $arResult['TOTAL_PRICE'] = $arResult['TOTAL_PRICE'] + $item['PRICE'] * $item['QUANTITY'];
    $arResult['TOTAL_DISCOUNT'] = $arResult['TOTAL_DISCOUNT'] + $item['DISCOUNT_PRICE'] * $item['QUANTITY'];
}
//p($arResult['TOTAL_PRICE'],'p');
$arResult['TOTAL_PRICE_FORMATED'] = number_format($arResult['TOTAL_PRICE'], 0, '', ' ');