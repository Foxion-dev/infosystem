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
CModule::IncludeModule('iblock');
Bitrix\Iblock\PropertyIndex\Manager::DeleteIndex(2);
Bitrix\Iblock\PropertyIndex\Manager::markAsInvalid(2);

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

$isFilter = ($arParams['USE_FILTER'] == 'Y');
include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_menu.php"); // включаем вершние меню для сайта && смарт фильтр
//$APPLICATION->IncludeComponent("bitrix:main.include","", ["AREA_FILE_SHOW"=>"file","PATH" => SITE_DIR."include/section_menu_cours.php", "AREA_FILE_RECURSIVE" => "N", "EDIT_MODE" => "php",], false, array('HIDE_ICONS' => 'Y'));  // авторизированные курсы текстовая область
include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_category.php");