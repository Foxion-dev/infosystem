<? define("SHOW_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Лицензии и сертификаты");?>
<?$APPLICATION->IncludeComponent("acs:gallery.line","license",Array(
        "IBLOCK_TYPE" => "library",
        "IBLOCKS" => Array("25"),
        "NEWS_COUNT" => false,
        "FIELD_CODE" => Array("ID","PREVIEW_PICTURE","PREVIEW_TEXT"),
        "PROPERTY_CODE" => Array("PDF"),
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        //"DETAIL_URL" => "#SITE_DIR#/academy/video/#ELEMENT_CODE#/",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
								/* "TITLE_PAGE"=>"Видеогалерея",
        "TITLE_PAGE_URL"=>"/academy/video/",
        "INDEX_PAGE_TITLE"=>'смотреть видео <br> "академия информационных систем"', // the title
        "INDEX_PAGE_URL"=>"https://www.youtube.com/watch?v=0dHKdESieFg", // the url */
    )
);?>
<section class="academy-container-about-fon" style="padding-top: 40px; padding-bottom: 40px;">
<div class="container">
	<div class="row">
		<div class="col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2">
 <img src="/images/vue.png" class="img-responsive">
		</div>
		<div class="col-8 col-sm-8 col-md-8 col-lg-10 col-xl-10">
			<h2>Центр тестирования</h2>
			<p>
				 Академия Информационных Систем является авторизованным центром тестирования ведущих сертифицирующих организаций <noindex><a target="_blank" href="https://home.pearsonvue.com/">Pearson VUE.</a></noindex>
				В нашем центре Вы всегда можете сдать тесты на получение международных сертификатов ИТ-специалистов
			</p>
		</div>
	</div>
</div>
 </section> <section class="academy-customers">
<div class="container">
	<div class="row">
		<div class="col-12">
			<h2>Сертификаты</h2>
			<p>
				 Академия Информационных Систем обладает рядом сертификатов, свидетельств и лицензий, подтверждающих определённый статус нашей образовательной организации&nbsp;и предоставляющие нам расширенные права для проведения обучения как в области Информационных Технологий, Информационной Безопасности и Бизнес-образования.
			</p>
		</div>
	</div>
</div>
</section>
<?$APPLICATION->IncludeComponent("acs:gallery.line","sert",Array(
        "IBLOCK_TYPE" => "library",
        "IBLOCKS" => Array("26"),
        "NEWS_COUNT" => false,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE"),
        //"PROPERTY_CODE" => Array("YOUTUBE"),
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        //"DETAIL_URL" => "#SITE_DIR#/academy/video/#ELEMENT_CODE#/",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => "Y",
        //
        /*"TITLE_PAGE"=>"Видеогалерея",
        "TITLE_PAGE_URL"=>"/academy/video/",
        "INDEX_PAGE_TITLE"=>'смотреть видео <br> "академия информационных систем"', // the title
        "INDEX_PAGE_URL"=>"https://www.youtube.com/watch?v=0dHKdESieFg", // the url*/
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>