<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksAdd=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/courses/",
	"SECTION_PAGE_URL" => "#SECTION_CODE#/",
	"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "2",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);
$aMenuLinksAdd[]=[
	'Бизнес образование,тренинг',
	'./business/',[],[],''
];
$aMenuLinksAdd[]=[
	'Перечень курсов АИС',
	'/about/price/',[],[],''
];
$aMenuLinks = array_merge($aMenuLinksAdd, $aMenuLinks);