<?
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
$needSidebar = (defined("HIDE_SIDEBAR") && HIDE_SIDEBAR == true || preg_match("~^" . SITE_DIR . "(courses|catalog)/~", $curPage) ? true : false); /* глобальная переменная которая формирует шаблон для шапки и т.д. */
/* MOBILES */
include $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/mobile_detect/NLSResponsive.php';
/* CSS Script can then be removed
$styles = ["styles","add","bootstrap"];
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/less.php/Less.php";
$options = array('compress'=>true);
foreach($styles as $filename){
    $parser = new Less_Parser($options);
    $parser->parseFile($_SERVER["DOCUMENT_ROOT"] . '/local/templates/infosystems/css/'.$filename.'.less', '/local/templates/infosystems/css/');
    $css = $parser->getCss();
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/local/templates/infosystems/css/'.$filename.'.css', $css);
} */
/* this component catches $_REQUEST["go"] Cleans the buffer and returns the required json for work Ajax */
$APPLICATION->IncludeComponent("acs:go.json", "", array(), false, ["HIDE_ICONS" => "Y"]); 
if($APPLICATION->GetCurDir() == '/test-section/'){
    $newHeader = 'new-custom';
}
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
<? if (!$needSidebar): ?>
    <header class="header <?= ((!$needSidebar) ? (in_array($curPage, [SITE_DIR . "index.php",]) ? "" : "header-background-img-none") : "") ?> <?= ($newHeader) ?: '' ?>">
        <? /*<!-- <div class="IE">
        <div class="close" onclick="$('body>header>.IE').remove();"></div>
        <div class="title">
            Ваш браузер устарел и не поддерживается.
        </div>
        <div class="content">
            Для корректной работы сайта рекомендуем установить <a href="https://www.google.ru/intl/ru/chrome/" target="_blank">Google Chrome</a>
        </div>
    </div> -->*/ ?>
        <?= ((!$needSidebar) ? (($curPage != SITE_DIR . "index.php") ? '<div class="header-top">' : '') : '') ?>
        <div class="winter-bg"></div>
        <div class="container topbox">
            <div class="row">
                <div class="col">
                    <div class="header-inner">

                        <? include($_SERVER["DOCUMENT_ROOT"] . "/include/site.php"); ?>
                        <div class="social-icons">
                            <? // include($_SERVER["DOCUMENT_ROOT"]."/include/socnet_footer.php"); ?>
                        </div>
                        <div class="contacts-item">
                            <? include($_SERVER["DOCUMENT_ROOT"] . "/include/telephone.php"); ?>
                        </div>
                        <? if (!$USER->IsAuthorized()) { ?>
                            <button type="button" class="button button--common button--primary icon-key login-button"
                                    data-toggle="modal" data-target="#authorization"> Войти / Регистрация
                            </button>
                        <? } else { ?>
                            <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/inc/mycab.php"); ?>
                        <? } ?>
                        <? /* переписанный компонент, можно тут пользовать sale.basket.basket.line */ ?>
                        <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", ".default",
                            ["CURPAGE" => $curPage, "PATH_TO_BASKET" => SITE_DIR . "personal/cart/", "PATH_TO_PERSONAL" => SITE_DIR . "personal/"],
                            false, ['HIDE_ICONS' => 'Y']); ?>
                        <div class="burger-menu">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="header-menu">
                                        <h5 class="heading">Академия</h5>
                                        <? $APPLICATION->IncludeComponent("bitrix:menu", "bootstrap-footer",
                                            array(
                                                "ROOT_MENU_TYPE" => "academy",
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "MENU_CACHE_TYPE" => "A",
                                                "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                                "MENU_CACHE_USE_GROUPS" => "Y",
                                                "MENU_CACHE_GET_VARS" => array(),
                                            ), false, ['HIDE_ICONS' => 'Y']); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="header-menu">
                                        <h5 class="heading">Курсы</h5>
                                        <? $APPLICATION->IncludeComponent("bitrix:menu", "bootstrap-footer",
                                            array(
                                                "ROOT_MENU_TYPE" => "courses",
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "MENU_CACHE_TYPE" => "A",
                                                "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                                "MENU_CACHE_USE_GROUPS" => "Y",
                                                "MENU_CACHE_GET_VARS" => array(),
                                            ), false, ['HIDE_ICONS' => 'Y']); ?>

                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="header-menu">
                                        <h5 class="heading">Услуги</h5>
                                        <? $APPLICATION->IncludeComponent("bitrix:menu", "bootstrap-footer",
                                            array(
                                                "ROOT_MENU_TYPE" => "services",
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "MENU_CACHE_TYPE" => "A",
                                                "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                                "MENU_CACHE_USE_GROUPS" => "Y",
                                                "MENU_CACHE_GET_VARS" => array(),
                                            ), false, ['HIDE_ICONS' => 'Y']); ?>


                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="header-menu">
                                        <h5 class="heading">Библиотека</h5>
                                        <? $APPLICATION->IncludeComponent("bitrix:menu", "bootstrap-footer",
                                            array(
                                                "ROOT_MENU_TYPE" => "library",
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "MENU_CACHE_TYPE" => "A",
                                                "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                                "MENU_CACHE_USE_GROUPS" => "Y",
                                                "MENU_CACHE_GET_VARS" => array(),
                                            ), false, ['HIDE_ICONS' => 'Y']); ?>
                                        <ul class="menu-list">
                                            <? /*<li><a href="/courses/"><h5 class="heading">Курсы</h5></a></li>*/ ?>
                                            <li><a href="/about/contacts/"><h5 class="heading">Контакты</h5></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="burger-button" type="button">
                            <span class="burger-inner"></span>
                        </button>
                    </div><!--//header-inner-->
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//container-->
        <?= ((!$needSidebar) ? (($curPage != SITE_DIR . "index.php") ? '</div>' : '') : '') ?>
        <? /* Exclude template output for some partitions */ ?>
        <? if (!$needSidebar): ?>
            <section class="screen-menu <? $APPLICATION->AddBufferContent('screenMenuClass') ?>">
                <div class="auth-user-block">
                    <? /* if(!$USER->IsAuthorized()){ ?>
                <span data-toggle="modal" data-target="#authorization"><i class="fa fa-user" aria-hidden="true"></i> Войти / Регистрация</span>
              <? }else{ ?><a href="/personal/"><i class="fa fa-user" aria-hidden="true"></i> ЛИЧНЫЙ КАБИНЕТ</a> / <a href="?logout=yes">Выход</a><? } */ ?>
                </div>
                <div class="menu-top">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <? $APPLICATION->IncludeComponent("bitrix:menu", "bootstrap_horizontal_multilevel",
                                    array(
                                        "ROOT_MENU_TYPE" => "top",
                                        "MAX_LEVEL" => "2",
                                        "CHILD_MENU_TYPE" => "left",
                                        "USE_EXT" => "Y",
                                        "MENU_CACHE_TYPE" => "A",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array(),
                                    ), false, ['HIDE_ICONS' => 'Y']); ?>
                            </div>
                        </div>
                    </div>
                </div><!--//end menu-top-->
                <? if($APPLICATION->GetCurDir() == '/test-section/'): ?>
                <? //$APPLICATION->IncludeComponent("bitrix:search.form", "hidden-new", ["PAGE" => "/search/",], false, ['HIDE_ICONS' => 'Y']); ?>

                <?else:?>
                <? $APPLICATION->IncludeComponent("bitrix:search.form", "hidden", ["PAGE" => "/search/",], false, ['HIDE_ICONS' => 'Y']); ?>
                <? $APPLICATION->ShowViewContent("search-page-form") ?>
                <? endif; ?>
                <? if ($curPage != SITE_DIR . "index.php"): ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-10" id="navigation">
                                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                                    "START_FROM" => "0",
                                    "PATH" => "",
                                    "SITE_ID" => "-"
                                ), false, ['HIDE_ICONS' => 'Y']); ?>
                            </div>
                            <div class="col-2 shareYandex"><? $APPLICATION->AddBufferContent('shareYandex') ?></div>
                        </div>
                        <div class="page-header">
                            <? if (strpos($curPage, "academy/information") && $curPage != "/academy/information/index.php") { ?>
                                <a href="/academy/information/" class="back-btn"></a>
                            <? } ?>
                            <h1 class="bx-title dbg_title custom-title-top"
                                id="pagetitle"><?= $APPLICATION->ShowTitle(false); ?></h1></div>
                    </div>
                <? endif; ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "sect_inc",
                    array(
                        "AREA_FILE_SHOW" => "sect",
                        "AREA_FILE_SUFFIX" => "top",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "php",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => "sect_inc"
                    ),
                    false
                ); ?>
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", ["AREA_FILE_SHOW" => "page", "AREA_FILE_SUFFIX" => "top", "AREA_FILE_RECURSIVE" => "N", "EDIT_MODE" => "php", "EDIT_TEMPLATE" => "sect_inc.php"]); ?>
            </section><!--//end screen-menu-->
        <? endif; ?>
    </header><!--// end header -->
    <? /* included areas */ ?>
    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", ["AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "header", "AREA_FILE_RECURSIVE" => "N", "EDIT_MODE" => "php", "EDIT_TEMPLATE" => "sect_inc.php"]); ?>
    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", ["AREA_FILE_SHOW" => "page", "AREA_FILE_SUFFIX" => "header", "AREA_FILE_RECURSIVE" => "N", "EDIT_MODE" => "php", "EDIT_TEMPLATE" => "sect_inc.php"]); ?>
<? endif; /* end !$needSidebar */ ?>
<? $needSidebar = (defined("SHOW_SIDEBAR") && SHOW_SIDEBAR == true ? true : $needSidebar);
if (!$needSidebar): ?>
    <? /* exception for the main page */ ?>
    <? if ($curPage != SITE_DIR . "index.php"): ?>
        <? $APPLICATION->AddBufferContent('particlesBG') ?>
        <?if($APPLICATION->GetCurDir() == '/test-section/' || $APPLICATION->GetCurDir() == '/schedule/'):?>
        <?php else:?>
        <section class="<? $APPLICATION->AddBufferContent('mainClass') ?>" role="main"><div class="container">
        <?endif;?>
    <? endif; /* end !index.php */ ?>
<? endif; /* end !$needSidebar */ ?>
