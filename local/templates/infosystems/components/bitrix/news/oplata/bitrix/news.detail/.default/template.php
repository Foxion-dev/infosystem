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
$this->setFrameMode(true);
?><?
// echo '<pre>', print_r($arResult), '</pre>';

$typePay = $arResult['PROPERTIES']['VALUE_XML_ID']['VALUE'];;
$product = $arResult['PROPERTIES']['PRODUCT']['VALUE'];

$APPLICATION->IncludeComponent(
		'bitrix:form.result.new',
		'pay',
		[
				'CACHE_TIME' => '3600',
				'CACHE_TYPE' => 'A',
				'CHAIN_ITEM_LINK' => '',
				'CHAIN_ITEM_TEXT' => '',
				'EDIT_URL' => '',
				'IGNORE_CUSTOM_TEMPLATE' => 'N',
				'LIST_URL' => '',
				'SEF_MODE' => 'N',
				'SUCCESS_URL' => '',
				'USE_EXTENDED_ERRORS' => 'Y',
				'VARIABLE_ALIASES' => [],
				'WEB_FORM_ID' => '5',
				"USER_CONSENT" => "Y",
				"USER_CONSENT_ID" => 2,
				"USER_CONSENT_IS_CHECKED" => "Y",
				"USER_CONSENT_IS_LOADED" => "N",
				'FORM_ACTION' => "/ajax/pay/order/{$product}/",
				'LINK_OFFER' => $arResult['PROPERTIES']['LINK_OFFER']['VALUE'],
				'LINK_AGREEMENT' => $arResult['PROPERTIES']['LINK_AGREEMENT']['VALUE'],
		]
); ?>
