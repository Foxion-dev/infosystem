<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent("acs:news.line","experts",Array(
        "IBLOCK_TYPE" => "references",
        "IBLOCKS" => Array("4"),
        "NEWS_COUNT" => "8",
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE","PROPERTY_POSITIONS"),
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        //"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
        //"ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        "TITLE_PAGE"=>"Преподаватели АИС",
        "TITLE_PAGE_URL"=>"/academy/experts/",
    )
);?>

<? /* the videogallery */ ?>
<?$APPLICATION->IncludeComponent("acs:gallery.line","video",Array(
        "IBLOCK_TYPE" => "academy",
        "IBLOCKS" => Array("7"),
        "NEWS_COUNT" => 4,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE"),
        "PROPERTY_CODE" => Array("YOUTUBE"),
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "DETAIL_URL" => "#SITE_DIR#/academy/video/#ELEMENT_CODE#/",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        "TITLE_PAGE"=>"Видеогалерея",
        "TITLE_PAGE_URL"=>"/academy/video/",
        "INDEX_PAGE_TITLE"=>'смотреть видео <br> Академия Информационных Систем', // the title
        "INDEX_PAGE_URL"=>"https://www.youtube.com/watch?v=EiyulrvGYS0", // the url
    )
);?>

<?$APPLICATION->IncludeComponent("acs:gallery.line","gallery_element",Array(
        "IBLOCK_TYPE" => "library",
        "IBLOCKS" => Array("6"),
        "NEWS_COUNT" => 4*3,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_TEXT"),
        "PROPERTY_CODE" => Array("PHOTOS"),
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        //"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
        "ACTIVE_DATE_FORMAT" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        "TITLE_PAGE"=>"фотогалерея",
        "TITLE_PAGE_URL"=>"/library/photo/",
    )
);?>

<?$APPLICATION->IncludeComponent("acs:news.line","partners",Array(
        "IBLOCK_TYPE" => "references",
        "IBLOCKS" => Array("5"),
        "NEWS_COUNT" => 3*8,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE"),
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        //"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
        //"ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        "TITLE_PAGE"=>"Наши партнеры и заказчики",
        "TITLE_PAGE_URL"=>"/academy/partners/",
    )
);?>
<section id="particles-body-top" class="news news-new">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="heading-wrapper">
                    <h5 class="heading">новости</h5>
                </div>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent("acs:news.line","news_index_list",Array(
                "IBLOCK_TYPE" => "news",
                "IBLOCKS" => Array("1"),
                "NEWS_COUNT" => 4*3,
                "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE","ACTIVE_DATE_FORMAT"),
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                //"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
                "ACTIVE_DATE_FORMAT" => "d F Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
                "CACHE_GROUPS" => "Y"
            )
        );?>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="heading-wrapper all-news-button">
                <a href="/academy/news/" class="button button--common button--primary">Все новости</a>
                </div>
                <? /* измененный компонент работает на Ajax основная подписка происходит в component_epilog.php */ ?>
                <? /*$APPLICATION->IncludeComponent("bitrix:subscribe.form",".default",Array(
                        "USE_PERSONALIZATION" => "Y",
                        "PAGE" => "#SITE_DIR#", //"#SITE_DIR#personal/subscribe/subscr_edit.php",
                        "SHOW_HIDDEN" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600"
                    )
                );*/?>
                <?/* $APPLICATION->IncludeComponent("acs:sender.subscribe", "", array(
                    "SET_TITLE" => "N",
                    "CONFIRMATION"=>"N",
                    "USER_CONSENT" => "Y",
                    "USER_CONSENT_ID" => "1",
                    "USER_CONSENT_IS_CHECKED" => "Y",
                ));*/?>
            </div><!--//col-12-->
        </div>
    </div>
</section><!--// end news -->