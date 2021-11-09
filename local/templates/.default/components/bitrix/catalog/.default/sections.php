<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_menu.php"); // включаем вершние меню для сайта && смарт фильтр
include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_index.php");
/**/