<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;
/*
if($_SERVER["REQUEST_METHOD"] == "POST" && trim($_REQUEST["go"]) == "GN" && isset($_REQUEST['KEY']) && intval($_REQUEST['ID'])>0){
    // чистим буффер выводим данные
    $KEY_ = intval($_REQUEST['KEY']);
    $APPLICATION->RestartBuffer();
    //
    ob_start();
    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/inc/photos.php");
    $html = ob_get_contents();
    ob_end_clean();
    $arJson['jq']['html']['#offerGallery'] = $html;
    $arJson['jq']['html']['.galleryformatter-text-bilding'] = "".$arResult['GALLERY'][$KEY_]['TEXT']."";
    //
    print json_encode($arJson);
    die();
} */