<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

/** 404 страница */
if (method_exists($this->getComponent(), 'define404')) {
    $this->getComponent()->define404();
}
