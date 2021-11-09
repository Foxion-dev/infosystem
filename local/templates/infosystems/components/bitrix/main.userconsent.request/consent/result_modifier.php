<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arParams */
/** @var array $arResult */


$agreement = new \Bitrix\Main\UserConsent\Agreement($arParams['ID']);

if ($agreement->isExist() && $agreement->isActive())
{
    $arResult['DATA'] = $agreement->getData();
    $arResult['TEXT'] = $agreement->getText();
}
