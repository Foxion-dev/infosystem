<? define("SHOW_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Календарь событий");
// компонент для КАЛЕНДАРЯ bitrix:news.calendar
global $USER;
if($USER->IsAuthorized()): ?>
<section class="info-block" style="margin-top: -25px; margin-bottom: 0px; z-index: 9; ">
    <div class="info-block-menu" style="margin-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                    <ul style="margin-left:0px;">
                        <li><a href="/personal/">Избранные курсы</a></li>
                        <li><a href="/personal/calendar/" class="active">Мои курсы</a></li>
                        <li><a href="/personal/subscribe/">Подписка</a></li>
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

<? //print '<section class="main"><div class="container">'; ?>
<?$APPLICATION->IncludeComponent("acs:news.calendar","",Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "2",
        "MONTH_VAR_NAME" => "month",
        "YEAR_VAR_NAME" => "year",
        "WEEK_START" => "1",
        //"DATE_FIELD" => "PROPERTY_DATE",
        "TYPE" => "EVENTS",
        "SHOW_YEAR" => "Y",
        "SHOW_TIME" => "Y",
        "TITLE_LEN" => "70",
        "SET_TITLE" => "Y",
        "SHOW_CURRENT_DATE" => "Y",
        "SHOW_MONTH_LIST" => "Y",
        "NEWS_COUNT" => "0",
        "DETAIL_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    )
);?>
<? //print '</div></section>'; ?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>