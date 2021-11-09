<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
/* Exclude template output for some partitions */ ?>
<? if(!$needSidebar): ?>
    <?if ($curPage != SITE_DIR."index.php"):?>
    </div></section><!--//main-->
    <?endif?>
<?endif?>
<? /* included areas */ ?>
<?if(ERROR_404 != 'Y'):?>
<?$APPLICATION->AddHeadScript('https://www.google.com/recaptcha/api.js?render=6Lc4hKcUAAAAAEf2QkZHUIBplrAL-CL_M80zV0NA'.time());?>
<?$APPLICATION->IncludeComponent("bitrix:main.include","",["AREA_FILE_SHOW"=>"sect","AREA_FILE_SUFFIX"=>"footer","AREA_FILE_RECURSIVE"=>"N","EDIT_MODE"=>"php","EDIT_TEMPLATE"=>"sect_inc.php"]);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "",["AREA_FILE_SHOW"=>"page","AREA_FILE_SUFFIX"=>"footer","AREA_FILE_RECURSIVE"=>"N","EDIT_MODE"=>"php","EDIT_TEMPLATE"=>"sect_inc.php"]);?>
<?endif;?>
<footer>
    <div class="footer-menu-section">
        <div class="particles-bg" id="particles-bg"></div>
        <div class="container">
			<?if(SITE_DIR != '/en/'){?>
            <div class="row">
                <div class="col-4 col-md-3">
                    <div class="footer-menu">
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
                <div class="col-4 col-md-3">
                    <div class="footer-menu">
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
                <div class="col-4 col-md-3">
                    <div class="footer-menu">
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
                        <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap-footer",
                            Array(
                                "ROOT_MENU_TYPE" => "bottom",
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
                    
                    <? include($_SERVER["DOCUMENT_ROOT"]."/include/site.php"); ?>
                    <? include($_SERVER["DOCUMENT_ROOT"]."/include/contacts_wrapper.php"); ?>
                    
                    <form action="/search/">
                        <input type="hidden" name="where" value="">
                        <button type="success"></button>
                        <input type="text" name="q" placeholder="Поиск по сайту">
                    </form>
                </div>
            </div>
			<?}else{?>
				 <div class="col-12 mob-d-flex" style="align-items: end;">
                    <? include($_SERVER["DOCUMENT_ROOT"]."/include/site_en.php"); ?>
                    <? include($_SERVER["DOCUMENT_ROOT"]."/include/contacts_wrapper_en.php"); ?>
                </div>
			<style>@media(min-width:992px){.mob-d-flex{display:flex;}}</style>
			<?}?>
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4">
                    
                </div>
                <div class="col-12 col-sm-8 col-md-4">
                    
                </div><!--//-->
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="contacts-wrapper">
                        
                        <?/* if(!$USER->IsAuthorized()){ ?>
                            <button type="button" class="button button--common button--secondary icon-key" data-toggle="modal" data-target="#authorization"> Войти / Регистрация</button>
                        <? }else{ ?>
                            <a href="/personal/" class="button button--common button--secondary"><span class="glyphicon glyphicon-search"></span> персональный раздел</a>
                        <? }*/ ?>
                    </div>
                </div><!--//-->
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="copyright-inner">
                        <div class="copyright-content">
                            <? include($_SERVER["DOCUMENT_ROOT"]."/include/copy.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?if(empty($_COOKIE['COOKIE_BLOCK'])){?>
    <div class="cookie_block">
     <div class="cookiesAgreement-module-root-2INjMM">
      <span class="cookiesAgreement-module-close-26BEzs"></span>
      <div class="cookiesAgreement-module-heading-3ZY2jY">Мы используем файлы cookie</div>
      <div class="cookiesAgreement-module-text-2IUAt6">
       Чтобы улучшить работу сайта и предоставить вам больше возможностей для обучения.
       Продолжая использовать сайт, вы соглашаетесь с <a target="_blank" href="/about/user_agreement/" target="_blank">условиями использования</a> файлов cookie.</div>
      <button class="Button-module-button-27Ont_ Button-module-size-s-1mL992 Button-module-color-blue-17N3OV Button-module-opacity-3DmbtQ Button-module-fluid-3NOtLW" type="submit">Согласен</button>
     </div>

    </div>
    <?}?>
</footer><!--//end footer-->

 
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "popup",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "47",
        "IBLOCK_TYPE" => "news",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "1",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0=>"PROP_0",1=>"PROP_2",2=>"PROP_1",3=>"",),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
<div class="page-content-spinner-block">
    <span class="ui-spinner"></span>
</div>
<div class="top"></div>
<div class="popup js-popup">
    <div class="popup-close js-popup-close">
        <span class="icon-close"></span>
    </div>
    <div class="popup-content">
        <h3 class="popup-title js-popup-title"></h3>
        <p class="popup-content js-popup-message"></p>
    </div>
</div>
<div class="overlay js-overlay"></div>
<? /* registration and authorization forms */ ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137711047-1"></script>
<script>
 window.dataLayer=window.dataLayer||[];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());
 gtag('config', 'UA-137711047-1');
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52653163, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52653163" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://b24ais.ru/upload/crm/site_button/loader_5_ocvecp.js');
</script>

<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://b24ais.ru/upload/crm/site_button/loader_4_bc2hg9.js');
</script>

<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://b24ais.ru/upload/crm/site_button/loader_3_egwed0.js');
</script>
<script>
$(function(){
    $(".top").bind('click', function(e){
        e.preventDefault();
        $('body,html').animate({scrollTop: 0}, 400);    
    });
});
</script>
<? include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/inc/form.php"); ?>
</body>
</html>
