<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? /* рекламный блок список баннеров для курсов #2 */ ?>
<?$APPLICATION->IncludeComponent('acs:acs.courses','banners',
    ['CACHE_TYPE' => "A",
        'CACHE_TIME' => "3600", // 1 hour - Cache time in seconds.
        'CACHE_GROUPS' => "Y",
        'IBLOCK_TYPE' => "catalog",
        'IBLOCK_ID' => 2,
        'DETAIL_URL' => SITE_DIR."courses/#SECTION_CODE#/#ELEMENT_CODE#/",
        'COUNT' => 10,
        //
        "FILTER_NAME"=>["!PROPERTY_SPECIALOFFER"=>false/*,">=PROPERTY_DATE" => date("Y-m-d H:i:s",time())*/],
    ],
    false
); ?>


<? /* тут нужен новостной компонент и т.д. */ ?>
<div class="particles-bg-4" id="particles-bg-4"></div>
<?$APPLICATION->IncludeComponent("acs:gallery.line","banners",Array(
        "IBLOCK_TYPE" => "banners",
        "IBLOCKS" => Array("8"),
        "NEWS_COUNT" => 10,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE","PREVIEW_TEXT"),
        "PROPERTY_CODE" => Array("MOBILE_BANNER", "BANNER","FORM_Y","URL",'COURSE_ID', 'FORM_CODE'),
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
    )
);?>



<? /* рекламный блок список баннеров для курсов */ ?>
<?/* $GLOBALS["COURSES"] = array(">=PROPERTY_DATE" => date("Y-m-d H:i:s",time())); */?>
<?/*$APPLICATION->IncludeComponent("acs:gallery.line","courses",Array(
        "IBLOCK_TYPE" => "banners",
        "IBLOCKS" => [10],
        "NEWS_COUNT" => 10,
        "FIELD_CODE" => ["ID","CODE","SECTION_ID","PREVIEW_PICTURE","PREVIEW_TEXT","PROPERTY_DATE","PROPERTY_PRICE","PROPERTY_URL","PROPERTY_COURSE","PROPERTY_CITY"],
        //"PROPERTY_CODE" => ["DATE","URL","PRICE","COURSE"],
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "SORT_BY1" => "PROPERTY_DATE",
        "SORT_ORDER1" => "ASC",
        //"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
        //"ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        "FILTER_NAME" => "COURSES",
    )
);*/?>

