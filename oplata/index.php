<?
// define("NEED_AUTH", true);
// define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$urlthis = $_SERVER[SERVER_NAME] . $_SERVER[REQUEST_URI];
if (strripos($urlthis, 'infosystem.ru') === 0 || strripos($urlthis, 'infosystem.ru')) {
    $newurl = str_replace('infosystem.ru', 'infosystems.ru', $urlthis);
    // header("Location://" . $newurl, TRUE, 301);
}
/** @var MainTemplate $template */
$template = InfoSystems\App\MainTemplate::getInstance();
?>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/* lang files */
IncludeTemplateLangFile(__FILE__);
global $USER, $APPLICATION;
CJSCore::Init(array('ajax', 'window', 'fx'));
$curPage = $APPLICATION->GetCurPage(true);

include $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/mobile_detect/NLSResponsive.php';

?>

<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon/favicon.ico"
					type="image/vnd.microsoft.icon"/>
		<title><? $APPLICATION->ShowTitle() ?></title>
		<? $APPLICATION->ShowHead(); ?>
		<? /* from meta VK && Facebook */ ?>
		<meta property="og:type" content="website"/>
		<meta property="og:title" content="<?= $APPLICATION->ShowTitle("title", true) ?>"/>
		<meta property="og:url"
					content="<?= PRM::isHttps() ?><?= $_SERVER['SERVER_NAME'] ?><?= $APPLICATION->GetCurPageParam("", array("clear_cache", "bitrix_include_areas")) ?>"/>
		<meta property="og:site_name" content="<? $arSite = $APPLICATION->GetSiteByDir();
		echo $arSite["NAME"] ?>"/>
		<? /*  CSS Bootstrap */

		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/bootstrap.css?' . time());  // Forbidden bootstrap, WHY was it foretold!
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css?' . time());
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/add.css?' . time());
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/dynamic.css?' . time());
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/nice-select/nice-select.css?' . time());
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/fancybox-master/dist/jquery.fancybox.min.css?' . time());
		$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css?" . time()); ?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js?<?= time() ?>"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js?<?= time() ?>"></script>
		<![endif]-->
		<? /* JavaScript */
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-3.3.1/jquery-3.3.1.min.js?' . time());

		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bootstrap-4.1.3/js/popper.min.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bootstrap-4.1.3/js/bootstrap.min.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/owl.carousel.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/particles.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/nice-select/jquery.nice-select.min.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/maskedinput/jquery.maskedinput.min.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox-master/dist/jquery.fancybox.min.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.nicescroll.3.7.3/jquery.nicescroll.min.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.cookie.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scripts.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/dynamic.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jvalidate.js?' . time());
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/js.js?' . time());
		?>
		<!--// share yandex -->
		<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js?<?= time() ?>"></script>
		<script src="//yastatic.net/share2/share.js?<?= time() ?>"></script>
		<script>
				(function (w, d, u) {
						var s = d.createElement('script');
						s.async = true;
						s.src = u + '?' + (Date.now() / 60000 | 0);
						var h = d.getElementsByTagName('script')[0];
						h.parentNode.insertBefore(s, h);
				})(window, document, 'https://b24ais.ru/upload/crm/site_button/loader_3_egwed0.js');
		</script>
		<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?169",t.onload=function(){VK.Retargeting.Init("VK-RTRG-914641-b4Jhh"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-914641-b4Jhh" style="position:fixed; left:-999px;" alt=""/></noscript>

		<!-- Facebook Pixel Code -->
		<script>
				!function(f,b,e,v,n,t,s)
				{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
						n.callMethod.apply(n,arguments):n.queue.push(arguments)};
						if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
						n.queue=[];t=b.createElement(e);t.async=!0;
						t.src=v;s=b.getElementsByTagName(e)[0];
						s.parentNode.insertBefore(t,s)}(window, document,'script',
						'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '1436753373334450');
				fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
										src="https://www.facebook.com/tr?id=1436753373334450&ev=PageView&noscript=1"
				/></noscript>
		<!-- End Facebook Pixel Code -->
</head>
<?//var_dump($APPLICATION->GetCurDir())?>
<body role="document" data-detected="<?= (NLSResponsive::$mobile_device ? "mobile_detect_mobile" : (NLSResponsive::$tablet_device ? "mobile_detect_tablet" : "mobile_detect_desktop")) ?>" class='<?= ($APPLICATION->GetCurDir() == '/test-section/') ? ' timetable-page': '' ?> <? $APPLICATION->AddBufferContent([&$template, 'getBodyClass'], false) ?>'>
<? $APPLICATION->ShowPanel(); ?>
<?

$APPLICATION->SetTitle("");?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"oplata", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "PAY_SELECT",
			1 => "PRODUCT",
			2 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "57",
		"IBLOCK_TYPE" => "services",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "oplata",
		"SEF_FOLDER" => "/oplata/",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?><?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

