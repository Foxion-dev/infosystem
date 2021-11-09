<? define("HIDE_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
 // класс для заднего фона
 // класс для section
$APPLICATION->SetTitle("Бизнес-образование");
$APPLICATION->AddChainItem('Бизнес образование,тренинг');
?><div class="header <span id=" title="Код PHP: &lt;?/*header-background-img header-background-img-card*/?&gt;">
	 <?/*header-background-img header-background-img-card*/?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt; <? include($_SERVER["DOCUMENT_ROOT"]."/include/header-top.php"); ?> <section class="screen-menu">
	<div class="menu-top">
		<div class="container">
			<div class="row">
				<div class="col">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"bootstrap_horizontal_multilevel",
	Array(
		"CHILD_MENU_TYPE" => "left",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => Array(),
		"MENU_CACHE_TIME" => $arParams["CACHE_TIME"],
		"MENU_CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"MENU_CACHE_USE_GROUPS" => $arParams["CACHE_GROUPS"],
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "Y"
	),
$component,
Array(
	'HIDE_ICONS' => 'Y'
)
);?>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-10" id="navigation">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "-",
		"START_FROM" => "0"
	),
false,
Array(
	'HIDE_ICONS' => 'Y'
)
);?>
			</div>
			<div class="col-2 shareYandex">
				 <?$APPLICATION->AddBufferContent('shareYandex')?>
			</div>
		</div>
		<div class="page-header">
			<h1 class="bx-title dbg_title" id="pagetitle"><?=$APPLICATION->ShowTitle(false);?></h1>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"sect_inc",
	Array(
		"AREA_FILE_RECURSIVE" => "N",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "top",
		"COMPONENT_TEMPLATE" => "sect_inc",
		"EDIT_MODE" => "php",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_RECURSIVE" => "N",
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "top",
		"EDIT_MODE" => "php",
		"EDIT_TEMPLATE" => "sect_inc.php"
	)
);?>
	</div>
 </section>
</div>
 <?$APPLICATION->AddBufferContent('particlesBG')?> <section class="<span id=" title="Код PHP: &lt;?$APPLICATION-&gt;AddBufferContent('mainClass')?&gt;"><?$APPLICATION->AddBufferContent('mainClass')?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>" role="main"&gt;
<div class="container">
	<hr>
	<div class="row business_table">
		<div class="col-md-6 col-lg-3">
			<div class="pic_content">
 <img src="/upload/карта.png">
			</div>
 <label for="">Семинары, тренинги и бизнес-игры в Москве и других городах РФ</label>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="pic_content">
 <img src="/upload/человеки.png">
			</div>
 <label for="">Обучение проводится тренерами международного уровня</label>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="pic_content">
 <img src="/upload/график.png">
			</div>
 <label for="">Образовательные программы направлены на решение конкретной бизнес-задачи</label>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="pic_content">
 <img src="/upload/бизнес человеки.png">
			</div>
 <label for="">Развитие профессиональных компетенций, навыков, личностных качеств персонала</label>
		</div>
	</div>
	<hr>
	<h2>ПРОГРАММЫ ПОВЫШЕНИЯ КВАЛИФИКАЦИИ</h2>
	<ul class="simple_list">
		<li>Стратегический менеджмент</li>
		<li>Лидерство</li>
		<li>Управление задачами и эффективностью</li>
		<li>Управление персоналом</li>
		<li>Принципы и практика проектного управления</li>
		<li>Управление изменениями</li>
		<li>Долгосрочное планирование деятельности с использованием форсайт-технологий</li>
		<li>Эффективная презентация</li>
		<li>Эмоциональный интеллект в управлении изменениями</li>
		<li>Уверенное публичное выступление</li>
		<li>Эффективные переговоры при построении взаимовыгодного сотрудничества</li>
		<li>Системное мышление</li>
		<li>Проведение эффективных совещаний</li>
		<li>Инновационные техники работы с клиентами</li>
		<li>Управление потенциалом команды и командное лидерство</li>
		<li>Кроссфункциональное взаимодействие</li>
		<li>Корпоративная культура и ценности</li>
		<li>Коучинг как стиль управления</li>
		<li>Командообразование</li>
		<li>Бизнес-игры</li>
	</ul>
	<h2>МАСТЕР-КЛАССЫ</h2>
	<p>
		 Мы предлагаем посетить мастер - классы, посвященные самореализации развитию личностного роста. Среди них: «Ораторское искусство»; «Эмоциональный интеллект для лидеров»; «Управление временем» и др.
	</p>
	<h2>СОБСТВЕННЫЙ МАСТЕР-КЛАСС</h2>
	<p>
		 В АИС Вы можете попробовать себя в качестве бизнес-тренера. Если у Вас есть профессиональные компетенции, которые могут быть полезны другим, а также желание попробовать себя в качестве преподавателя – приходите! Тема не имеет значения – главное, чтобы было интересно и полезно. Опытные консультанты помогут Вам составить план тренинга, коммерциализовать Ваш опыт, соберут лояльную аудиторию, организуют рекламу.
	</p>
	<div class="simple_page_button_holder">
		 <script id="bx24_form_button" data-skip-moving="true">
        (function(w,d,u,b){w['Bitrix24FormObject']=b;w[b] = w[b] || function(){arguments[0].ref=u;
                (w[b].forms=w[b].forms||[]).push(arguments[0])};
                if(w[b]['forms']) return;
                var s=d.createElement('script');s.async=1;s.src=u+'?'+(1*new Date());
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://b24ais.ru/bitrix/js/crm/form_loader.js','b24form');

        b24form({"id":"17","lang":"ru","sec":"r0usns","type":"button","click":""});
</script><button class="b24-web-form-popup-btn-19">Оставить заявку</button>
	</div>
</div>
 </section> <br><?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>