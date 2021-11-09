<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!IsModuleInstalled("iblock") || !CModule::IncludeModule("iblock"))
	return;

//This is communication channel with subscription agent
//In
global $SUBSCRIBE_TEMPLATE_RUBRIC;
//p($SUBSCRIBE_TEMPLATE_RUBRIC,'p');

//Handle of parameters
$arParams["SITE_ID"] = trim($arParams["SITE_ID"]);
if(strlen($arParams["SITE_ID"]) <= 0)
	$arParams["SITE_ID"] = $SUBSCRIBE_TEMPLATE_RUBRIC["SITE_ID"];

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"]) <= 0)
	$arParams["IBLOCK_TYPE"] = "news";

$arParams["ID"] = intval($arParams["ID"]);
if($arParams["ID"] <= 0)
	$arParams["ID"] = "";

//We have to save current user and create new one
//because of possible agent execution
global $USER;
$SAVED_USER = $USER;
$USER = new CUser;

//Let's be pessimists
$SUBSCRIBE_TEMPLATE_RESULT = 0;

$rsIBlock = CIBlock::GetList(
	array($arParams["SORT_BY"] => $arParams["SORT_ORDER"]),
	array(
		'ID' => $arParams["ID"],
		'TYPE' => $arParams["IBLOCK_TYPE"],
		'SITE_ID' => $arParams["SITE_ID"],
		'ACTIVE' => 'Y'
	));

//p(date("Y-m-d H:i:s",strtotime($SUBSCRIBE_TEMPLATE_RUBRIC["START_TIME"])),'p');
//p(date("Y-m-d H:i:s",strtotime($SUBSCRIBE_TEMPLATE_RUBRIC["END_TIME"])),'p');

$arOrder = ['PROPERTY_DATE'=>'ASC','SORT'=>'ASC'];
$arFilter = [
	'ACTIVE' => "Y",
	'>PROPERTY_DATE' => date("Y-m-d H:i:s",strtotime($SUBSCRIBE_TEMPLATE_RUBRIC["START_TIME"])),
	'<=PROPERTY_DATE' => date("Y-m-d H:i:s",strtotime($SUBSCRIBE_TEMPLATE_RUBRIC["END_TIME"])),
];
$arSelect = [
	'ID',
	'IBLOCK_ID',
    "CODE",
	'DETAIL_PAGE_URL',
	'PREVIEW_PICTURE',
	'DATE_ACTIVE_FROM',
	'NAME',
	'PREVIEW_TEXT',
	'PREVIEW_TEXT_TYPE',
	"PROPERTY_DATE","PROPERTY_CITY","PROPERTY_MANAGER.NAME",
];

$rsSite = CSite::GetByID($arParams["SITE_ID"]);
$arSite = $rsSite->Fetch();
$arResult["SERVER_NAME"] = $arSite["SERVER_NAME"];

$arResult["IBLOCKS"] = array();
while($arIBlock = $rsIBlock->Fetch())
{
	$arResult["IBLOCKS"][$arIBlock["ID"]] = $arIBlock;
	$arFilter['IBLOCK_ID'] = $arIBlock["ID"];
	$rsNews = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
	$arResult["IBLOCKS"][$arIBlock["ID"]]["ITEMS"] = array();
	while($obNews = $rsNews->GetNextElement())
	{
		$arNews = $obNews->GetFields();

		$arNews["PREVIEW_PICTURE"] = CFile::GetFileArray($arNews["PREVIEW_PICTURE"]);
		if(strpos($arNews["DETAIL_PAGE_URL"], "http") !== 0)
			$arNews["DETAIL_PAGE_URL"] = "http://".$arSite["SERVER_NAME"].$arNews["DETAIL_PAGE_URL"];

		$arResult["IBLOCKS"][$arIBlock["ID"]]["ITEMS"][] = $arNews;
		$SUBSCRIBE_TEMPLATE_RESULT++;
	}
}

if($SUBSCRIBE_TEMPLATE_RESULT)
	$this->IncludeComponentTemplate();

//Restore user
$USER = $SAVED_USER;

return $SUBSCRIBE_TEMPLATE_RESULT;