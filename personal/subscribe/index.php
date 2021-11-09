<? define("SHOW_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рассылки");
global $USER;
if($USER->IsAuthorized()): ?>
    <section class="info-block" style="margin-top: -25px; margin-bottom: 0px; z-index: 9; ">
        <div class="info-block-menu" style="margin-bottom: 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                        <ul style="margin-left:0px;">
                            <li><a href="/personal/">Избранные курсы</a></li>
                            <li><a href="/personal/calendar/">Мои курсы</a></li>
                            <li><a href="/personal/subscribe/" class="active">Подписка</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="position: relative;">
                        <a href="/personal/order/" class="personal-user-orders" style="right: -25px;">
                            Заказы
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>

<? print '<section class="main"><div class="container">'; ?>
<?$APPLICATION->IncludeComponent("bitrix:subscribe.index", ".default", Array(
        "SHOW_COUNT"	=>	"N",
        "SHOW_HIDDEN"	=>	"N",
        "PAGE"	=>	"#SITE_DIR#personal/subscribe/subscr_edit.php",
        "CACHE_TIME"	=>	"3600",
        "SET_TITLE"	=>	"Y"
    )
);?>
<? print '</div></section>'; ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>