<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// header("HTTP/1.1 301 Moved Permanently"); 
// header("Location: /"); 
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);
// $APPLICATION->RestartBuffer();

$APPLICATION->SetTitle("Страница не найдена");?>
<section class="page404">
    <div class="container">
    <h3 >Здесь, похоже, ничего нет</h3>

        <div class="page404__top"><img src="ais404.gif" alt="404"></div>
        <div class="page404__bottom"> 
            <p>
                Перейди на <a href="/">главную страницу</a> или почитай о нас в соцсетях:
            </p>
            </div>
            <div class="footer-menu-section">
                <div class="social-icons">
                    <? include($_SERVER["DOCUMENT_ROOT"]."/include/socnet_footer_new.php"); ?>
                </div>
            </div>

    </div>
</section>
<style>
    .page404 {
        text-align: center;

    }
    .page404 h3 {
        font-size: 30px;
        margin-bottom: 30px;
    }
    .page404 p {
        font-size: 24px;
        line-height: 1.2;
    }
    .page404__top{
        max-width: 900px;
        margin: 0 auto; 
        width: 100%;
    }
    .page404__top img {
        max-width: 100%;
        width: 100%;
        height: auto;
    }
    .page404 .footer-menu-section{
        padding-top: 0;
    }
    .page404 .social-icons {
        justify-content: center;
    }
    .page404 .social-icons .icon-tg, .page404 .social-icons .icon-inst{
        width: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .page404 .social-icons img{
        display: block;
        max-width: 100%;
        height: auto;
    }
    @media screen and (max-width: 768px){
        .page404 h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .page404 p {
            font-size: 20px;
        }
    }
    @media screen and (max-width: 480px){
        .page404 h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .page404 p {
            font-size: 18px;
        }
    }

</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>