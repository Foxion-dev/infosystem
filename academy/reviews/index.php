<? define("SHOW_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы клиентов");
?>
<div class="particles-bg-5" id="particles-bg-5"></div>
<section class="academy-customers have-margin-top" role="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Официальные письма</h2>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent("acs:news.line","letters",Array(
                "IBLOCK_TYPE" => "reviews",
                "IBLOCKS" => Array("16"),
                "NEWS_COUNT" => false,
                "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE","PREVIEW_TEXT"),
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                //
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
                "CACHE_GROUPS" => "Y",
                //
            )
        );?>
    </div>
</section>

<? $APPLICATION->IncludeComponent('acs:acs.reviews','.default',
    ['CACHE_TYPE' => "A",
        'CACHE_TIME' => "3600",
        'CACHE_GROUPS' => "N",
        'PAGE_TITLE' => "Отзывы в соц сетях и на сайте",
        //'facebook' => "Y",
        ]
); ?>

<? $APPLICATION->IncludeComponent("acs:gallery.line","video_reviews",[
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
    "CACHE_GROUPS" => "N",
    //
    "TITLE_PAGE"=>"Видео отзывы",
]
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>