<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="winter-bg"></div>
<div class="header-top">
    <div class="container topbox">
        <div class="row">
            <div class="col">
                <div class="header-inner">
                    
                        <? include($_SERVER["DOCUMENT_ROOT"]."/include/site.php"); ?>
                    <div class="social-icons">
                        <?// include($_SERVER["DOCUMENT_ROOT"]."/include/socnet_footer.php"); ?>
                    </div>
                    <div class="contacts-item">
                        <? include($_SERVER["DOCUMENT_ROOT"]."/include/telephone.php"); ?>
                    </div>
                    <? if(!$USER->IsAuthorized()){ ?>
                        <button type="button" class="button button--common button--primary icon-key login-button" data-toggle="modal" data-target="#authorization"> Войти / Регистрация</button>
                    <? }else{ ?>
                        <? include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/inc/mycab.php"); ?>
                    <? } ?>
                    <? /* переписанный компонент, можно тут пользовать sale.basket.basket.line */ ?>
                    <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", ".default",
                        ["CURPAGE"=>$curPage,"PATH_TO_BASKET"=>SITE_DIR."personal/cart/","PATH_TO_PERSONAL" => SITE_DIR."personal/"],
                        $component, ['HIDE_ICONS' => 'Y']);?>
                    <div class="burger-menu">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="header-menu">
                                    <h5 class="heading">Академия</h5>
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap-footer",
                                        Array(
                                            "ROOT_MENU_TYPE" => "academy",
                                            "MAX_LEVEL"	=>	"1",
                                            "USE_EXT"	=>	"N",
                                            "MENU_CACHE_TYPE" => "A",
                                            "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => Array(),
                                        ),false,['HIDE_ICONS'=>'Y']);?>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="header-menu">
                                    <h5 class="heading">Курсы</h5>
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap-footer",
                                        Array(
                                            "ROOT_MENU_TYPE" => "courses",
                                            "MAX_LEVEL"	=>	"1",
                                            "USE_EXT"	=>	"N",
                                            "MENU_CACHE_TYPE" => "A",
                                            "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => Array(),
                                        ),false,['HIDE_ICONS'=>'Y']);?>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="header-menu">
                                    <h5 class="heading">Услуги</h5>
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap-footer",
                                        Array(
                                            "ROOT_MENU_TYPE" => "services",
                                            "MAX_LEVEL"	=>	"1",
                                            "USE_EXT"	=>	"N",
                                            "MENU_CACHE_TYPE" => "A",
                                            "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => Array(),
                                        ),false,['HIDE_ICONS'=>'Y']);?>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="header-menu">
                                    <h5 class="heading">Библиотека</h5>
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap-footer",
                                        Array(
                                            "ROOT_MENU_TYPE" => "library",
                                            "MAX_LEVEL"	=>	"1",
                                            "USE_EXT"	=>	"N",
                                            "MENU_CACHE_TYPE" => "A",
                                            "MENU_CACHE_TIME" => "3600", // 1 hour - Cache time in seconds.
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => Array(),
                                        ),false,['HIDE_ICONS'=>'Y']);?>
                                        <ul class="menu-list">
                                        <?/*<li><a href="/courses/"><h5 class="heading">Курсы</h5></a></li>*/?>
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
</div><!--//header-top-->