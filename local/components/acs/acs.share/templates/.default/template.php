<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$url="";
global $APPLICATION;
$CURRENT_PAGE = (CMain::IsHTTPS()) ? "https://" : "http://";
$CURRENT_PAGE .= $_SERVER["HTTP_HOST"];
$CURRENT_PAGE.=$arParams['data-url'];
?>
<div class="the-cards-date-share">
    <div
        <?=$arParams['data-url']?'data-url="'.$CURRENT_PAGE.'"':''?>
        <?=$arParams['data-title']?'data-title="'.$arParams['data-title'].'"':''?>
        <?=$arParams['data-description']?'data-description="'.$arParams['data-description'].'"':''?>
        <?=$arParams['data-image']?'data-image="'.$arParams['data-image'].'"':''?>
        class="ya-share2" data-limit="0"
        data-services="vkontakte,facebook,odnoklassniki,whatsapp,telegram">
    </div>
</div>