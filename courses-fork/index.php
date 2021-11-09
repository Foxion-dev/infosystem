<? define("HIDE_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "Повышение квалификации и обучение по обеспечению безопасности и охране, оценке укрепленности, антитеррористической защите, составлению паспорта безопасности.");
$APPLICATION->SetPageProperty("title", "Обучение по комплексной инженерно-технической защите и охране объектов");
$APPLICATION->SetTitle("Комплексная инженерно-техническая защита и охрана объектов");
//$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetPageProperty("screen_menu", "screen-menu-courses-catalog"); // класс для заднего фона
$APPLICATION->SetPageProperty("section_class", "nearest-courses"); // класс для section
/* шаблон для этой странице сформирован в самом компоненте видимо так оно ПРАВЕЛЬНЕЙ для этого дизайна и т.д. */
//$GLOBALS["COURSES"] = array(">=PROPERTY_DATE" => date("Y-m-d H:i:s",time())); // фильтр отфильровывает по актуальной дате и т.д.
?>

<?/*    (*・ω・)ﾉ
    	Подключены только header и footer, всё остальное верстка
		Блоки взяты с отрендеренной страницы. Изменения или новые блоки будут выделены комментариями
		Вся страница завернута в .courses-new, чтобы не поехали стили на действущей странице курсов
		¯\_(ツ)_/¯
*/ ?>


<div class="courses-new">

<?/* Начало шапки */ ?>

<header class="header">
	<div class="header-top">
		<div class="container topbox">
			<div class="row">
				<div class="col">
					<div class="header-inner">
						<a href="/" class="logo-main">
							<div class="logo-ais icon-ais"></div>
							<p>академия информационных систем</p>
						</a>
						<div class="social-icons">
						</div>
						<div class="contacts-item">
							<a href="tel:+74951200402" class="phone">+7 (495) 120-04-02</a>
							<a href="mailto:Info@infosystem.ru" rel="nofollow" class="email">Info@infosystem.ru</a>
						</div>
						<button class="burger-button" type="button">
							<span class="burger-inner"></span>
						</button>
						<div class="burger-menu">
							<div class="row">
								<div class="col-12 col-md-3">
									<div class="header-menu">
										<h5 class="heading">Академия</h5>

										<ul class="menu-list">
											<li><a href="/academy/">Об Академии</a></li>
											<li><a href="/academy/licenses/">Лицензии и сертификаты</a></li>
											<li><a href="/academy/news/">Новости</a></li>
											<li><a href="/academy/experts/">Преподаватели</a></li>
											<li><a href="/academy/partners/">Партнеры</a></li>
											<li><a href="/academy/customers/">Клиенты</a></li>
											<li><a href="/academy/team/">Команда</a></li>
											<li><a href="/academy/reviews/">Отзывы</a></li>
											<li><a href="/academy/pressa/">Пресса о нас</a></li>
											<li><a href="/academy/information/">Сведения об образовательной
													организации</a></li>
											<li><a href="/about/contacts/">Контакты</a></li>
											<li><a href="/about/vacancies/">Вакансии</a></li>
										</ul>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="header-menu">
										<h5 class="heading">Курсы</h5>
										<ul class="menu-list">
											<li class="active"><a href="/courses/bezopasnost/">Информационная
													безопасность</a></li>
											<li><a href="/courses/tekhnologii/">Информационные технологии</a></li>
											<li><a href="/courses/razvedka/">Конкурентная разведка в Интернете</a></li>
											<li><a href="/courses/ekonomicheskaya/">Экономическая безопасность</a></li>
											<li><a href="/courses/mezhdunarod/">Международные стандарты и
													сертификации</a></li>
											<li><a href="/courses/kompleksnaya/">Комплексная инженерно-техническая
													защита и охрана объектов</a></li>
											<li><a href="/business/">Бизнес образование,тренинг</a></li>
										</ul>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="header-menu">
										<h5 class="heading">Услуги</h5>
										<ul class="menu-list">
											<li class="active"><a href="/courses/bezopasnost/">Информационная
													безопасность</a></li>
											<li><a href="/courses/tekhnologii/">Информационные технологии</a></li>
											<li><a href="/courses/razvedka/">Конкурентная разведка в Интернете</a></li>
											<li><a href="/courses/ekonomicheskaya/">Экономическая безопасность</a></li>
											<li><a href="https://vipforum.ru/">Конференция </a></li>
											<li><a href="/courses/interaktivnoe/">Интерактивное и дистанционное
													обучение</a></li>
											<li><a href="/courses/mezhdunarod/">Международные стандарты и
													сертификации</a></li>
											<li><a href="/services/sertification/">Центр тестирования</a></li>
											<li><a href="/services/additional/">Дополнительные услуги</a></li>
											<li><a href="/services/independent_qualification/">Независимая оценка
													квалификации</a></li>
										</ul>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="header-menu">
										<h5 class="heading">Библиотека</h5>

										<ul class="menu-list">
											<li><a href="/library/standards/">Профессиональные и образовательные
													стандарты</a></li>
											<li><a href="/library/reference/">Справочная литература по защите
													информации</a></li>
											<li><a href="/library/glossary/">Словари АИС</a></li>
											<li><a href="/upload/Буклет АИС 2019.pdf">Буклет АИС</a></li>
											<li><a href="/library/photo/">Фотогалерея АИС</a></li>
											<li><a href="/library/video/">Видео АИС</a></li>
											<li><a href="/search/">Поиск по сайту</a></li>
											<li><a href="/about/contacts/#feedback">Обратная связь</a></li>
										</ul>
										<ul class="menu-list">
											<li><a href="/about/contacts/">
													<h5 class="heading">Контакты</h5>
												</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--//header-inner-->
				</div>
				<!--//col-->
			</div>
			<!--//row-->
		</div>
		<!--//container-->
	</div>
	<!--//header-top-->
	<section class="screen-menu screen-menu-courses-catalog">
		<div class="menu-top">
			<div class="container">
				<div class="row">
					<div class="col">
						<ul class="menu-top-list">
							<li class="menu-item"><a href="/academy/" class="root-item">Академия</a>
								<ul class="submenu">
									<li class="submenu-item"><a href="/academy/">Об Академии</a></li>
									<li class="submenu-item"><a href="/academy/licenses/">Лицензии и сертификаты</a>
									</li>
									<li class="submenu-item"><a href="/academy/news/">Новости</a></li>
									<li class="submenu-item"><a href="/academy/experts/">Преподаватели</a></li>
									<li class="submenu-item"><a href="/academy/partners/">Партнеры</a></li>
									<li class="submenu-item"><a href="/academy/cooperation/">Сотрудничество</a></li>
									<li class="submenu-item"><a href="/academy/customers/">Клиенты</a></li>
									<li class="submenu-item"><a href="/academy/team/">Команда</a></li>
									<li class="submenu-item"><a href="/academy/reviews/">Отзывы</a></li>
									<li class="submenu-item"><a href="/academy/pressa/">Пресса о нас</a></li>
									<li class="submenu-item"><a href="/academy/information/">Сведения об образовательной
											организации</a></li>
									<li class="submenu-item"><a href="/about/vacancies/">Вакансии</a></li>
								</ul>
							</li>
							<li class="menu-item"><a href="/courses/" class="root-item-selected">Курсы</a>
								<ul class="submenu">
									<li class="submenu-item item-selected"><a
											href="/courses/bezopasnost/">Информационная безопасность</a></li>
									<li class="submenu-item"><a href="/courses/tekhnologii/">Информационные
											технологии</a></li>
									<li class="submenu-item"><a href="/courses/razvedka/">Конкурентная разведка в
											Интернете</a></li>
									<li class="submenu-item"><a href="/courses/ekonomicheskaya/">Экономическая
											безопасность</a></li>
									<li class="submenu-item"><a href="/courses/mezhdunarod/">Международные стандарты и
											сертификации</a></li>
									<li class="submenu-item"><a href="/courses/kompleksnaya/">Комплексная
											инженерно-техническая защита и охрана объектов</a></li>
									<li class="submenu-item"><a href="/courses/business/">Бизнес образование,тренинг</a>
									</li>
								</ul>
							</li>
							<li class="menu-item"><a href="/services/" class="root-item">Услуги</a>
								<ul class="submenu">
									<li class="submenu-item"><a href="https://vipforum.ru">Конференции</a></li>
									<li class="submenu-item"><a href="/services/sertification/">Центр тестирования</a>
									</li>
									<li class="submenu-item"><a href="/services/additional/">Дополнительные услуги</a>
									</li>
									<li class="submenu-item"><a href="/services/independent_qualification/">Независимая
											оценка квалификации</a></li>
									<li class="submenu-item"><a href="/services/license/">Получение лицензии ФСБ России
											и ФСТЭК России</a></li>
								</ul>
							</li>
							<li class="menu-item"><a href="/library/" class="root-item">Библиотека</a>
								<ul class="submenu">
									<li class="submenu-item"><a href="/library/standards/">Профессиональные и
											образовательные стандарты</a></li>
									<li class="submenu-item"><a href="/library/reference/">Справочная литература по
											защите информации</a></li>
									<li class="submenu-item"><a href="/library/glossary/">Словари АИС</a></li>
									<li class="submenu-item"><a href="/upload/Буклет АИС 2019.pdf">Буклет АИС</a></li>
									<li class="submenu-item"><a href="/library/photo/">Фотогалерея АИС</a></li>
									<li class="submenu-item"><a href="/library/video/">Видео АИС</a></li>
									<li class="submenu-item"><a href="/search/">Поиск по сайту</a></li>
									<li class="submenu-item"><a href="/about/contacts/#feedback">Обратная связь</a></li>
								</ul>
							</li>
							<li class="menu-item "><a href="/about/contacts/" class="root-item">Контакты</a></li>
							<li class="menu-item-search"><a href="#" class="search-root-item-click">Поиск</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--//end menu-top-->
		<div class="search-panel search-panel-hidden">
			<div class="container">
				<form action="/search/" class="row search-form">
					<div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
						<input type="text" placeholder="Поиск" name="q" class="search-input">
					</div>
					<div class="col-10 col-sm-10 col-md-4 col-lg-3 col-xl-4">
						<!--<span class="search-category-label">Я ищу:</span>-->
						<select name="where" id="search-category" class="search-category" style="display: none;">
							<option value="">Все категории</option>
							<option value="iblock_news">Новости</option>
							<option value="iblock_catalog">Курсы</option>
							<option value="iblock_academy">Академия</option>
							<option value="iblock_library">Библиотека</option>
						</select>
						<div class="nice-select search-category" tabindex="0"><span class="current">Все категории</span>
							<ul class="list">
								<li data-value="" class="option selected">Все категории</li>
								<li data-value="iblock_news" class="option">Новости</li>
								<li data-value="iblock_catalog" class="option">Курсы</li>
								<li data-value="iblock_academy" class="option">Академия</li>
								<li data-value="iblock_library" class="option">Библиотека</li>
							</ul>
						</div>
					</div>
					<div class="col-2 col-sm-2 col-md-1 col-lg-2 col-xl-1 search-button"><button type="submit"
							class="button button--round button--secondary icon-search">Поиск</button></div>
				</form>
			</div>
		</div>
		<!--//end search-panel -->
		<div class="container">
			<div class="col">
				<div class="row">
					<div class="col-11" id="navigation">
						<div class="bx-breadcrumb" itemprop="http://schema.org/breadcrumb" itemscope=""
							itemtype="http://schema.org/BreadcrumbList">
							<div class="bx-breadcrumb-item" id="bx_breadcrumb_0" itemprop="itemListElement" itemscope=""
								itemtype="http://schema.org/ListItem">

								<a href="/" title="АИС" itemprop="url">
									<span itemprop="name">АИС</span>
								</a>
								<meta itemprop="position" content="1">
							</div>
							<div class="bx-breadcrumb-item" id="bx_breadcrumb_1" itemprop="itemListElement" itemscope=""
								itemtype="http://schema.org/ListItem">
								<i>•</i>
								<a href="/courses/" title="Курсы" itemprop="url">
									<span itemprop="name">Курсы</span>
								</a>
								<meta itemprop="position" content="2">
							</div>
							<div class="bx-breadcrumb-item" itemprop="itemListElement" itemscope=""
								itemtype="http://schema.org/ListItem">
								<i>•</i>
								<span itemprop="name">Информационная безопасность</span>
								<meta itemprop="position" content="3">
							</div>
							<div style="clear:both"></div>
						</div>						
					</div>
					<div class="col-1 shareYandex"></div>
				</div>

				<div class="page-header">
					<h1 class="bx-title dbg_title courses-filter" id="pagetitle">
						Все курсы и направления</h1>
				</div>				
			</div>

			<?/* Начало НОВАЯ форма в шапке */?>
			
			<section class="search-panel-2">
				<div class="container">
				<ul class="courses-sections">
					<li class="courses-sections__items">
						<a href="javascript:void(0);"><span class="name">Информационная безопасность</span><sup class="quantity-courses">2</sup></a>
					</li>
					<li class="courses-sections__items">
						<a href="javascript:void(0);"><span class="name">Экономическая безопасность</span><sup class="quantity-courses">2</sup></a>
					</li>
					<li class="courses-sections__items">
						<a href="javascript:void(0);"><span class="name">Информационные технологии</span><sup class="quantity-courses">2</sup></a>
					</li>
					<li class="courses-sections__items">
						<a href="javascript:void(0);"><span class="name">Международные стандарты и серфтификации</span><sup class="quantity-courses">2</sup></a>
					</li>
					<li class="courses-sections__items">
						<a href="javascript:void(0);"><span class="name">Конкурентная разведка в интернете</span><sup class="quantity-courses">2</sup></a>
					</li>					
					<li class="courses-sections__items">
						<a href="javascript:void(0);"><span class="name">Комплексная инженерно-техническая защита и охрана объектов</span><sup class="quantity-courses">2</sup></a>
					</li>
				</ul>
				</div>
			</section>
			<?/* Конец */?>


		</div>


		<div id="smartfilter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmartFilter"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="mySmartFilterLabel">Фильтр курсов:</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true"><span>×</span></button>
					</div>
					<!--//modal-header-->
					<div class="modal-body">
						<div class="bx-filter bx-green">
							<div class="container bx-filter-section container-fluid">
								<form name="_form" action="/courses/bezopasnost/" method="get"
									class="row coursers-line-form smartfilter">
									<div class="col-12 col-sm-12 col-md-10 col-lg-11 col-xl-11">
										<div class="row">
											<div
												class=" col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 bx-filter-parameters-box bx-active">
												<span class="bx-filter-container-modef"></span>
												<div class="bx-filter-parameters-box-title"
													onclick="smartFilter.hideFilterProps(this)"><span>Цена курса <i
															data-role="prop_angle" class="fa fa-angle-down"></i></span>
												</div>
												<div class="bx-filter-block" data-role="bx_filter_block">
													<div class="bx-filter-parameters-box-container">
														<div class="bx-filter-parameters-box-container-block bx-left">
															<div class="bx-filter-input-container">
																<input placeholder="От" class="min-price" type="text"
																	name="COURSES_P1_MIN" id="COURSES_P1_MIN" value=""
																	size="5" onkeyup="smartFilter.keyup(this)">
															</div>
														</div>
														<div class="bx-filter-parameters-box-container-block bx-right">
															<div class="bx-filter-input-container">
																<input placeholder="До" class="max-price" type="text"
																	name="COURSES_P1_MAX" id="COURSES_P1_MAX" value=""
																	size="5" onkeyup="smartFilter.keyup(this)">
															</div>
														</div>
														<div class="bx-ui-slider-track-container">
															<div class="bx-ui-slider-track"
																id="drag_track_c4ca4238a0b923820dcc509a6f75849b">
																<div class="bx-ui-slider-part p1"><span>0</span></div>
																<div class="bx-ui-slider-part p2"><span>62 500</span>
																</div>
																<div class="bx-ui-slider-part p3"><span>125 000</span>
																</div>
																<div class="bx-ui-slider-part p4"><span>187 500</span>
																</div>
																<div class="bx-ui-slider-part p5"><span>250 000</span>
																</div>

																<div class="bx-ui-slider-pricebar-vd"
																	style="left: 0;right: 0;"
																	id="colorUnavailableActive_c4ca4238a0b923820dcc509a6f75849b">
																</div>
																<div class="bx-ui-slider-pricebar-vn"
																	style="left: 0%; right: 0%;"
																	id="colorAvailableInactive_c4ca4238a0b923820dcc509a6f75849b">
																</div>
																<div class="bx-ui-slider-pricebar-v"
																	style="left: 0%; right: 0%;"
																	id="colorAvailableActive_c4ca4238a0b923820dcc509a6f75849b">
																</div>
																<div class="bx-ui-slider-range"
																	id="drag_tracker_c4ca4238a0b923820dcc509a6f75849b"
																	style="left: 0%; right: 0%;">
																	<a class="bx-ui-slider-handle left" style="left:0;"
																		href="javascript:void(0)"
																		id="left_slider_c4ca4238a0b923820dcc509a6f75849b"></a>
																	<a class="bx-ui-slider-handle right"
																		style="right:0;" href="javascript:void(0)"
																		id="right_slider_c4ca4238a0b923820dcc509a6f75849b"></a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div
												class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 bx-filter-parameters-box bx-active">
												<span class="bx-filter-container-modef"></span>
												<div class="bx-filter-parameters-box-title"
													onclick="smartFilter.hideFilterProps(this)">
													<span class="bx-filter-parameters-box-hint">Дата начало проведения
														<i data-role="prop_angle" class="fa fa-angle-up"></i>
													</span>
												</div>

												<div class="bx-filter-block" data-role="bx_filter_block">
													<div class=" bx-filter-parameters-box-container">
														<div>
															<div
																class="bx-filter-parameters-box-container-block bx-left">
																<div
																	class="bx-filter-input-container bx-filter-calendar-container">
																	<div class="input-group"> <input
																			class="form-control" type="text"
																			id="COURSES_47_MIN" name="COURSES_47_MIN"
																			value="" placeholder="25.04.2019"
																			onkeyup="smartFilter.keyup(this)"
																			onchange="smartFilter.keyup(this)">
																		<span style="cursor: pointer; cursor: hand;"
																			class="input-group-addon"
																			onclick="BX.calendar({node:this, field:'COURSES_47_MIN', form: '_form', bTime: false, currentTime: '1556118756', bHideTime: true});"
																			onmouseover="BX.addClass(this, 'calendar-icon-hover');"
																			onmouseout="BX.removeClass(this, 'calendar-icon-hover');"><i
																				class="fa fa-calendar"
																				aria-hidden="true"></i></span>
																	</div>
																</div>
															</div>
															<div
																class="bx-filter-parameters-box-container-block bx-right">
																<div
																	class="bx-filter-input-container bx-filter-calendar-container">
																	<div class="input-group"> <input
																			class="form-control" type="text"
																			id="COURSES_47_MAX" name="COURSES_47_MAX"
																			value="" placeholder="19.12.2019"
																			onkeyup="smartFilter.keyup(this)"
																			onchange="smartFilter.keyup(this)">
																		<span style="cursor: pointer; cursor: hand;"
																			class="input-group-addon"
																			onclick="BX.calendar({node:this, field:'COURSES_47_MAX', form: '_form', bTime: false, currentTime: '1556118756', bHideTime: true});"
																			onmouseover="BX.addClass(this, 'calendar-icon-hover');"
																			onmouseout="BX.removeClass(this, 'calendar-icon-hover');"><i
																				class="fa fa-calendar"
																				aria-hidden="true"></i></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div style="clear: both"></div>
												</div>
											</div>
											<div
												class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 bx-filter-parameters-box bx-active">
												<span class="bx-filter-container-modef"></span>
												<div class="bx-filter-parameters-box-title"
													onclick="smartFilter.hideFilterProps(this)">
													<span class="bx-filter-parameters-box-hint">Город <i
															data-role="prop_angle" class="fa fa-angle-up"></i>
													</span>
												</div>

												<div class="bx-filter-block" data-role="bx_filter_block">
													<div class=" bx-filter-parameters-box-container">
														<div>
															<div class="bx-filter-select-container">
																<div class="bx-filter-select-block"
																	onclick="smartFilter.showDropDownPopup(this, '48')">
																	<div class="bx-filter-select-text"
																		data-role="currentOption">
																		Все </div>
																	<div class="bx-filter-select-arrow"></div>
																	<input style="display: none" type="radio"
																		name="COURSES_48" id="all_COURSES_48_765164156"
																		value="">
																	<input style="display: none" type="radio"
																		name="COURSES_48" id="COURSES_48_765164156"
																		value="765164156">
																	<div class="bx-filter-select-popup"
																		data-role="dropdownContent"
																		style="display: none;">
																		<ul>
																			<li>
																				<label for="all_COURSES_48_765164156"
																					class="bx-filter-param-label"
																					data-role="label_all_COURSES_48_765164156"
																					onclick="smartFilter.selectDropDownItem(this, 'all_COURSES_48_765164156')">
																					Все </label>
																			</li>
																			<li>
																				<label for="COURSES_48_765164156"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_48_765164156"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_48_765164156')">Москва</label>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div style="clear: both"></div>
												</div>
											</div>
											<div
												class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 bx-filter-parameters-box bx-active">
												<span class="bx-filter-container-modef"></span>
												<div class="bx-filter-parameters-box-title"
													onclick="smartFilter.hideFilterProps(this)">
													<span class="bx-filter-parameters-box-hint">Форма обучения <i
															data-role="prop_angle" class="fa fa-angle-up"></i>
													</span>
												</div>

												<div class="bx-filter-block" data-role="bx_filter_block">
													<div class=" bx-filter-parameters-box-container">
														<div>
															<div class="bx-filter-select-container">
																<div class="bx-filter-select-block"
																	onclick="smartFilter.showDropDownPopup(this, '58')">
																	<div class="bx-filter-select-text"
																		data-role="currentOption">
																		Все </div>
																	<div class="bx-filter-select-arrow"></div>
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="all_COURSES_58_1199350562"
																		value="">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_1199350562"
																		value="1199350562">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_3314360705"
																		value="3314360705">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_1215599190"
																		value="1215599190">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_2764517934"
																		value="2764517934">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_2413998542"
																		value="2413998542">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_4067284114"
																		value="4067284114">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_1873585613"
																		value="1873585613">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_1476097159"
																		value="1476097159">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_3530880960"
																		value="3530880960">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_1926920450"
																		value="1926920450">
																	<input style="display: none" type="radio"
																		name="COURSES_58" id="COURSES_58_752763568"
																		value="752763568">
																	<div class="bx-filter-select-popup"
																		data-role="dropdownContent"
																		style="display: none;">
																		<ul>
																			<li>
																				<label for="all_COURSES_58_1199350562"
																					class="bx-filter-param-label"
																					data-role="label_all_COURSES_58_1199350562"
																					onclick="smartFilter.selectDropDownItem(this, 'all_COURSES_58_1199350562')">
																					Все </label>
																			</li>
																			<li>
																				<label for="COURSES_58_1199350562"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_1199350562"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_1199350562')">очная</label>
																			</li>
																			<li>
																				<label for="COURSES_58_3314360705"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_3314360705"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_3314360705')">Очная</label>
																			</li>
																			<li>
																				<label for="COURSES_58_1215599190"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_1215599190"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_1215599190')">Очная/Дистанционная</label>
																			</li>
																			<li>
																				<label for="COURSES_58_2764517934"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_2764517934"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_2764517934')">очная/заочная</label>
																			</li>
																			<li>
																				<label for="COURSES_58_2413998542"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_2413998542"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_2413998542')">очно</label>
																			</li>
																			<li>
																				<label for="COURSES_58_4067284114"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_4067284114"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_4067284114')">Очно-заочная</label>
																			</li>
																			<li>
																				<label for="COURSES_58_1873585613"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_1873585613"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_1873585613')">очно/дистанционно</label>
																			</li>
																			<li>
																				<label for="COURSES_58_1476097159"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_1476097159"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_1476097159')">Очно/Дистанционно</label>
																			</li>
																			<li>
																				<label for="COURSES_58_3530880960"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_3530880960"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_3530880960')">очно/заочная</label>
																			</li>
																			<li>
																				<label for="COURSES_58_1926920450"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_1926920450"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_1926920450')">очно/заочная
																				</label>
																			</li>
																			<li>
																				<label for="COURSES_58_752763568"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_58_752763568"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_58_752763568')">очно/заочно</label>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div style="clear: both"></div>
												</div>
											</div>
											<div
												class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 bx-filter-parameters-box bx-active">
												<span class="bx-filter-container-modef"></span>
												<div class="bx-filter-parameters-box-title"
													onclick="smartFilter.hideFilterProps(this)">
													<span class="bx-filter-parameters-box-hint">Преподаватели <i
															data-role="prop_angle" class="fa fa-angle-up"></i>
													</span>
												</div>

												<div class="bx-filter-block" data-role="bx_filter_block">
													<div class=" bx-filter-parameters-box-container">
														<div>
															<div class="bx-filter-select-container">
																<div class="bx-filter-select-block"
																	onclick="smartFilter.showDropDownPopup(this, '54')">
																	<div class="bx-filter-select-text"
																		data-role="currentOption">
																		Все </div>
																	<div class="bx-filter-select-arrow"></div>
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="all_COURSES_54_3778651676"
																		value="">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_3778651676"
																		value="3778651676">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1577100463"
																		value="1577100463">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1790921346"
																		value="1790921346">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_274208589"
																		value="274208589">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_456259259"
																		value="456259259">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1340971399"
																		value="1340971399">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_255313712"
																		value="255313712">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1904655245"
																		value="1904655245">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_688362553"
																		value="688362553">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_778719264"
																		value="778719264">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_4127187316"
																		value="4127187316">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_2317947717"
																		value="2317947717">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1589695052"
																		value="1589695052">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_92763392"
																		value="92763392">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1192990190"
																		value="1192990190">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_2690895370"
																		value="2690895370">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1500340406"
																		value="1500340406">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_3076719002"
																		value="3076719002">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_223786919"
																		value="223786919">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_3111714635"
																		value="3111714635">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_1815529005"
																		value="1815529005">
																	<input style="display: none" type="radio"
																		name="COURSES_54" id="COURSES_54_3653203630"
																		value="3653203630">
																	<div class="bx-filter-select-popup"
																		data-role="dropdownContent"
																		style="display: none;">
																		<ul>
																			<li>
																				<label for="all_COURSES_54_3778651676"
																					class="bx-filter-param-label"
																					data-role="label_all_COURSES_54_3778651676"
																					onclick="smartFilter.selectDropDownItem(this, 'all_COURSES_54_3778651676')">
																					Все </label>
																			</li>
																			<li>
																				<label for="COURSES_54_3778651676"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_3778651676"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_3778651676')">Зюзин
																					Михаил Анатольевич</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1577100463"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1577100463"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1577100463')">Масалович
																					Андрей Игоревич</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1790921346"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1790921346"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1790921346')">Боронин
																					Сергей Сергеевич</label>
																			</li>
																			<li>
																				<label for="COURSES_54_274208589"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_274208589"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_274208589')">Абрамянц
																					Карен Олегович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_456259259"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_456259259"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_456259259')">Царев
																					Евгений Олегович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1340971399"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1340971399"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1340971399')">Андрей
																					Дроздов</label>
																			</li>
																			<li>
																				<label for="COURSES_54_255313712"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_255313712"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_255313712')">Ещенко
																					Наталья Геннадьевна</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1904655245"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1904655245"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1904655245')">Креопалов
																					Владимир Владиславович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_688362553"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_688362553"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_688362553')">Мацкевич
																					Дмитрий Олегович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_778719264"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_778719264"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_778719264')">Панкратьев
																					Вячеслав Вячеславович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_4127187316"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_4127187316"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_4127187316')">Астанин
																					Виктор Викторович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_2317947717"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_2317947717"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_2317947717')">Волдохин
																					Сергей Александрович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1589695052"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1589695052"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1589695052')">Казак
																					Олег Юрьевич</label>
																			</li>
																			<li>
																				<label for="COURSES_54_92763392"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_92763392"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_92763392')">Комаров
																					Вадим Николаевич</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1192990190"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1192990190"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1192990190')">Крупенков
																					Виктор Владимирович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_2690895370"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_2690895370"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_2690895370')">Мананников
																					Дмитрий Алексеевич</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1500340406"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1500340406"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1500340406')">Нежданов
																					Игорь</label>
																			</li>
																			<li>
																				<label for="COURSES_54_3076719002"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_3076719002"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_3076719002')">Ольхович
																					Татьяна Андреевна</label>
																			</li>
																			<li>
																				<label for="COURSES_54_223786919"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_223786919"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_223786919')">Представители
																					РОСГВАРДИИ</label>
																			</li>
																			<li>
																				<label for="COURSES_54_3111714635"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_3111714635"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_3111714635')">Тарасенко
																					Александр Александрович</label>
																			</li>
																			<li>
																				<label for="COURSES_54_1815529005"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_1815529005"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_1815529005')">Храмцовская
																					Наталья Александровна</label>
																			</li>
																			<li>
																				<label for="COURSES_54_3653203630"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_54_3653203630"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_54_3653203630')">Числов
																					Сергей Валерьевич</label>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div style="clear: both"></div>
												</div>
											</div>
											<div
												class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 bx-filter-parameters-box bx-active">
												<span class="bx-filter-container-modef"></span>
												<div class="bx-filter-parameters-box-title"
													onclick="smartFilter.hideFilterProps(this)">
													<span class="bx-filter-parameters-box-hint">Получаемый документ <i
															data-role="prop_angle" class="fa fa-angle-up"></i>
													</span>
												</div>

												<div class="bx-filter-block" data-role="bx_filter_block">
													<div class=" bx-filter-parameters-box-container">
														<div>
															<div class="bx-filter-select-container">
																<div class="bx-filter-select-block"
																	onclick="smartFilter.showDropDownPopup(this, '55')">
																	<div class="bx-filter-select-text"
																		data-role="currentOption">
																		Все </div>
																	<div class="bx-filter-select-arrow"></div>
																	<input style="display: none" type="radio"
																		name="COURSES_55" id="all_COURSES_55_841265288"
																		value="">
																	<input style="display: none" type="radio"
																		name="COURSES_55" id="COURSES_55_841265288"
																		value="841265288">
																	<input style="display: none" type="radio"
																		name="COURSES_55" id="COURSES_55_4114585495"
																		value="4114585495">
																	<input style="display: none" type="radio"
																		name="COURSES_55" id="COURSES_55_1801126452"
																		value="1801126452">
																	<input style="display: none" type="radio"
																		name="COURSES_55" id="COURSES_55_647781449"
																		value="647781449">
																	<div class="bx-filter-select-popup"
																		data-role="dropdownContent"
																		style="display: none;">
																		<ul>
																			<li>
																				<label for="all_COURSES_55_841265288"
																					class="bx-filter-param-label"
																					data-role="label_all_COURSES_55_841265288"
																					onclick="smartFilter.selectDropDownItem(this, 'all_COURSES_55_841265288')">
																					Все </label>
																			</li>
																			<li>
																				<label for="COURSES_55_841265288"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_55_841265288"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_55_841265288')">Диплом
																					о профессиональной
																					переподготовке</label>
																			</li>
																			<li>
																				<label for="COURSES_55_4114585495"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_55_4114585495"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_55_4114585495')">Удостоверение
																					о повышении квалификации</label>
																			</li>
																			<li>
																				<label for="COURSES_55_1801126452"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_55_1801126452"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_55_1801126452')">Свидетельство
																					о прохождении обучения</label>
																			</li>
																			<li>
																				<label for="COURSES_55_647781449"
																					class="bx-filter-param-label"
																					data-role="label_COURSES_55_647781449"
																					onclick="smartFilter.selectDropDownItem(this, 'COURSES_55_647781449')">Сертификат
																					вендора</label>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div style="clear: both"></div>
												</div>
											</div>
										</div>
									</div>
									<!--//row//col-9-->
									<div class="col-12 col-sm-12 col-md-2 col-lg-1 col-xl-1">
										<div class="bx-filter-button-box">
											<div class="bx-filter-block">
												<div class="bx-filter-parameters-box-container">
													<button type="button" id="set_filter" name="set_filter"
														class="button button--round button--secondary icon-search"></button>
													<button type="button" id="del_filter" name="del_filter"
														class="btn btn-link del_filter">Сбросить</button>
													<div class="bx-filter-popup-result " id="modef"
														style="display:none">
														Выбрано: <span id="modef_num">0</span> <span
															class="arrow"></span>
														<br>
														<a href="/courses/filter/clear/apply/" target="">Показать</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--//modal-body-->
				</div>
				<!--//modal-content-->
			</div>
		</div>
		<!--//smartfilter-->
		<script type="text/javascript">
			var smartFilter = new JCSmartFilter('/courses/bezopasnost/', 'HORIZONTAL', {
				'SEF_SET_FILTER_URL': '/courses/filter/clear/apply/',
				'SEF_DEL_FILTER_URL': '/courses/filter/clear/apply/'
			});
		</script>
	</section>
	<!--//end screen-menu-->
</header>

<?/* Конец шапки */?>

<?/* Начало блока с курсами */?>

<section class="nearest-courses" role="main">
	<!-- <div class="particles-bg-2" id="particles-bg-2"><canvas class="particles-js-canvas-el"
			style="width: 100%; height: 100%;" width="406" height="934"></canvas></div> -->

	<div class="container">
		<div class="row">
			<div class="col-12">
				<form class="form courses-filter coursers-line-form">
					<div class="row">

						<div class="col-12 col-sm-6 col-md-4">
							<label>Форма обучения</label>
							<select name="coursers-line" class="coursers-line" id="coursers-line" style="display: none;">
									<option value="all">Не важно</option>
								<option value="13">Информационная безопасность</option>
								<option value="17">Информационные технологии</option>
								<option value="15">Конкурентная разведка в Интернете</option>
								<option value="14">Экономическая безопасность</option>
								<option value="16">Международные стандарты и сертификации</option>
								<option value="18">Комплексная инженерно-техническая защита и охрана объектов</option>
							</select>
						</div>
						<div class="col-12 col-sm-6 col-md-4">
							<label>Вендор</label>
							<select name="coursers-line" class="coursers-line" id="coursers-line" style="display: none;">
									<option value="all">Все</option>
								<option value="13">Информационная безопасность</option>
								<option value="17">Информационные технологии</option>
								<option value="15">Конкурентная разведка в Интернете</option>
								<option value="14">Экономическая безопасность</option>
								<option value="16">Международные стандарты и сертификации</option>
								<option value="18">Комплексная инженерно-техническая защита и охрана объектов</option>
							</select>
						</div>
						<div class="col-12">
							<label>Начало курса:</label>
							<?/*непонятно, как должен раборать этот элемент и как его правильно сверстать*/?>
							<ul	class="start-month-filter">
								<li class="start-month-filter__item active"><button>2019</button></li>
								<li class="start-month-filter__item"><button type="button">Апрель</button></li>
								<li class="start-month-filter__item"><button type="button">Май</button></li>
								<li class="start-month-filter__item"><button type="button">Июнь</button></li>
								<li class="start-month-filter__item"><button type="button">Июль</button></li>
								<li class="start-month-filter__item"><button type="button">Август</button></li>
								<li class="start-month-filter__item"><button type="button">Сентябрь</button></li>
								<li class="start-month-filter__item"><button type="button">Октябрь</button></li>
								<li class="start-month-filter__item"><button type="button">Ноябрь</button></li>
								<li class="start-month-filter__item"><button type="button">Декабрь</button></li>
								<li class="start-month-filter__item"><button type="button">2020</button></li>
								<li class="start-month-filter__item"><button type="button">Январь</button></li>
								<li class="start-month-filter__item"><button type="button">Февраль</button></li>
							</ul>
						</div>
						<div class="col-12">
							<div class="courses-sort">
								<div class="sort-by">
									<span>Сортировать:</span>
									<button type="button" class="sort-by--high">по цене<i class="price-sort"></i></button>
									<button type="button">по дате начала</button>
								</div>

								<div class="input-wrapper">
									<input type="checkbox" id="new-courses">
									<label for="new-courses">Новые</label>
								</div>
								<div class="input-wrapper">
									<input type="checkbox" id="free-courses">
									<label for="free-courses">Бесплатные</label>
								</div>
							</div>
						</div>
					</div>				
				</form>


				<div class="catalog-section-courses">

					<div class="nearest-courses-items" id="bx_3966226736_1076">
						<div class="row">
							<div class="col-12 col-lg-7">
								<ul class="nearest-courses-items-title">
									<li>Код - ES050	</li>
									<li>Информационные технологии / DevOps </li>
									<li>Вендор: АИС</li>
								</ul>
								<a href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"
									class="nearest-courses-items-body">Охрана конфиденциальной информации, составляющей
									коммерческую тайну</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-2">
								<div class="nearest-courses-items-details">
									<div class="form-study">Очно / Дистанционно</div>
									<div class="date">22 – 24 Апреля</div>
									<div class="date">3 – 7 Июня</div>
									<div class="date">19 – 23 Августа </div>
								</div>
								
							</div>
							<div class="col-8 col-sm-4 col-lg-2 align-self-center">
								<div class="nearest-courses-items-prise">
									<span>14 000 <span class="currency">₽</span></span>
								</div>
							</div>
							<div class="col-4 col-sm-2 col-lg-1 d-flex align-self-center">
								<div class="nearest-courses-items-click">
									<div><a class="item-content-click-more"
										href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"></a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="nearest-courses-items" id="bx_3966226736_1076">
						<div class="row">
							<div class="col-12 col-lg-7">
								<ul class="nearest-courses-items-title">
									<li>Код курса: ES068</li>
									<li>Информационная безопасность / согласовано с фед.органами</li>
									<li>Вендор: АИС</li>
								</ul>
								<a href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"
									class="nearest-courses-items-body">Аттестация объектов н форматизации по требованиям безопасности информации</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-2">
								<div class="nearest-courses-items-details">
									<div class="form-study">Дистанционно</div>
									<a href="javascript:void(0);">Сроки уточняйте у менеджера</a>
								</div>
							</div>
							<div class="col-8 col-sm-4 col-lg-2 align-self-center">
								<div class="nearest-courses-items-prise">
									<a href="javascript:void(0);" class="button free">Бесплатно</a>
								</div>
							</div>
							<div class="col-4 col-sm-2 col-lg-1 d-flex align-self-center">
								<div class="nearest-courses-items-click">
									<div><a class="item-content-click-more"
										href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"></a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="nearest-courses-items" id="bx_3966226736_1076">
						<div class="row">
							<div class="col-12 col-lg-7">
								<ul class="nearest-courses-items-title">
									<li>Код - ES050	</li>
									<li>Информационные технологии / DevOps </li>
									<li>Вендор: АИС</li>
								</ul>
								<a href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"
									class="nearest-courses-items-body">Охрана конфиденциальной информации, составляющей
									коммерческую тайну</a>
							</div>
							<div class="col-12 col-lg-2">
								<div class="nearest-courses-items-details">
									<div class="form-study">Очно / Дистанционно</div>
									<div class="date">22 – 24 Апреля</div>
									<div class="date">3 – 7 Июня</div>
									<div class="date">19 – 23 Августа </div>
								</div>
								
							</div>
							<div class="col-12 col-lg-2 align-self-center">
								<div class="nearest-courses-items-prise">
									<span>14 000 <span class="currency">₽</span></span>
								</div>
							</div>
							<div class="col-12 col-lg-1 d-flex align-self-center">
								<div class="nearest-courses-items-click">
									<div><a class="item-content-click-more"
										href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"></a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="nearest-courses-items" id="bx_3966226736_1076">
						<div class="row">
							<div class="col-12 col-lg-7">
								<ul class="nearest-courses-items-title">
									<li>Код курса: ES068</li>
									<li>Информационная безопасность / согласовано с фед.органами</li>
									<li>Вендор: АИС</li>
								</ul>
								<a href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"
									class="nearest-courses-items-body">Аттестация объектов н форматизации по требованиям безопасности информации</a>
							</div>
							<div class="col-12 col-lg-2">
								<div class="nearest-courses-items-details">
									<div class="form-study">Дистанционно</div>
									<a href="javascript:void(0);">Сроки уточняйте у менеджера</a>
								</div>
							</div>
							<div class="col-12 col-lg-2 align-self-center">
								<div class="nearest-courses-items-prise">
									<a href="javascript:void(0);" class="button free">Бесплатно</a>
								</div>
							</div>
							<div class="col-12 col-lg-1 d-flex align-self-center">
								<div class="nearest-courses-items-click">
									<div><a class="item-content-click-more"
										href="/courses/ekonomicheskaya/okhrana_konfidentsialnoy_informatsii_sostavlyayushchey_kommercheskuyu_taynu/"></a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="bx-pagination ">
						<div class="bx-pagination-container row">
							<ul>
								<li class="bx-pag-prev"><span>Назад</span></li>
								<li class="bx-active"><span>1</span></li>
								<li class=""><a href="/courses/?ajax_coursesClosest=Y&amp;PAGEN_1=2"><span>2</span></a></li>
								<li class=""><a href="/courses/?ajax_coursesClosest=Y&amp;PAGEN_1=3"><span>3</span></a></li>
								<li class=""><a href="/courses/?ajax_coursesClosest=Y&amp;PAGEN_1=4"><span>4</span></a></li>
								<li class=""><a href="/courses/?ajax_coursesClosest=Y&amp;PAGEN_1=10"><span>10</span></a></li>
								<li class="bx-pag-next"><a href="/courses/?ajax_coursesClosest=Y&amp;PAGEN_1=2"><span>Вперед</span></a>
								</li>
							</ul>
							<div style="clear:both"></div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
<?/* Конец блока с курсами */?>

<?/* Слайдер с преподавательями новый*/?>
<section class="experts experts-multyslider-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="heading-wrapper">
					<h5>Преподаватели АИС</h5>
					<div class="button_holder">
					<a href="/academy/experts/" class="button button--common button--primary">Все преподаватели</a>
				</div>
			</div>


				<div class="experts-multyslider owl-carousel">
					<div class="slide">
						<a href="/academy/experts/zyuzin-mikhail-anatolevich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/1be/120_120_2/zuzin.jpg"
								title="Зюзин Михаил Анатольевич" alt="Зюзин Михаил Анатольевич">
							<div class="experts-items-person">Зюзин Михаил Анатольевич</div>
							<div class="experts-items-person-position">Ведущий эксперт</div>
						</a>
					</div>

					<div class="slide">
						<a href="/academy/experts/kovalev-andrey-nikolaevich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/5df/120_120_2/GLU_1262-_Copy_.jpg"
								title="Ковалев Андрей Николаевич" alt="Ковалев Андрей Николаевич">
							<div class="experts-items-person">Ковалев Андрей Николаевич</div>
							<div class="experts-items-person-position">Эксперт-консультант в области защиты информации и
								государственной тайны</div>
						</a>
					</div>
					<div class="slide">
						<a href="/academy/experts/masalovich-andrey-igorevich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/80f/120_120_2/masalovich.jpg"
								title="Масалович Андрей Игоревич" alt="Масалович Андрей Игоревич">
							<div class="experts-items-person">Масалович Андрей Игоревич</div>
							<div class="experts-items-person-position">Ведущий эксперт по конкурентной разведке</div>
						</a>
					</div>
					<div class="slide">
						<a href="/academy/experts/boronin-sergey-sergeevich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/3d1/120_120_2/boronin.jpg"
								title="Боронин Сергей Сергеевич" alt="Боронин Сергей Сергеевич">
							<div class="experts-items-person">Боронин Сергей Сергеевич</div>
							<div class="experts-items-person-position">Преподаватель-эксперт</div>
						</a>
					</div>
					<div class="slide">
						<a href="/academy/experts/abramyants-karen-olegovich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/327/120_120_2/karen_Abromyanc_173x260.jpg"
								title="Абрамянц Карен Олегович" alt="Абрамянц Карен Олегович">
							<div class="experts-items-person">Абрамянц Карен Олегович</div>
							<div class="experts-items-person-position">Тренер по направлению Информационная безопасность
							</div>
						</a>
					</div>
					<div class="slide">
						<a href="/academy/experts/tsarev-evgeniy-olegovich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/5fd/120_120_2/tsarev.jpg"
								title="Царев Евгений Олегович" alt="Царев Евгений Олегович">
							<div class="experts-items-person">Царев Евгений Олегович</div>
							<div class="experts-items-person-position">Эксперт в области персональных данных, национальной платежной системы, а также банковской безопасности</div>
						</a>
					</div>
					<div class="slide">
						<a href="/academy/experts/andrey-drozdov/" class="experts-items">
							<img src="/upload/resize_cache/iblock/d81/120_120_2/Drozdov_2_1.JPG" title="Андрей Дроздов"
								alt="Андрей Дроздов">
							<div class="experts-items-person">Андрей Дроздов</div>
							<div class="experts-items-person-position"></div>
						</a>
					</div>
					<div class="slide">
						<a href="/academy/experts/leviev-dmitriy-olegovich/" class="experts-items">
							<img src="/upload/resize_cache/iblock/427/120_120_2/leviev.png"
								title="Левиев Дмитрий Олегович" alt="Левиев Дмитрий Олегович">
							<div class="experts-items-person">Левиев Дмитрий Олегович</div>
							<div class="experts-items-person-position">Эксперт по информационной безопасности</div>
						</a>
					</div>
				</div>
			</div>
			<!--//col-12-->

		</div>
		<!--//row-->
		<div class="row">
			<div class="col-12">
				
			</div>
		</div>
	</div>
	<!--//container-->
</section>

<?/* ==== */?>





<?/* Дальше уже существубщие блоки */?>
<section class="photoLine">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="heading-wrapper">
                        <h5 class="heading">фотогалерея</h5>
                    </div>
                </div>
            </div>
            <div class="photoLine-items owl-carousel owl-loaded owl-drag">
                                    <!--// end row -->
                                    <!--// end row -->
                                    <!--// end row -->
                            <div class="owl-stage-outer"><div class="owl-stage" style="transition: all 0s ease 0s; width: 7980px; transform: translate3d(-2280px, 0px, 0px);"><div class="owl-item cloned" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/ruskripto-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/943/300_300_1/cy9a4129.jpg" alt="РусКрипто" class="album-pic">
                                        <div class="title"><p>2016 /  РусКрипто</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/infobereg-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/3e6/300_300_1/info2016_96_copy_.JPG" alt="ИнфоБЕРЕГ" class="album-pic">
                                        <div class="title"><p>2016 /  ИнфоБЕРЕГ</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/iv-mezhdunarodnaya-nauchno-prakticheskaya-konferentsiya-upravlenie-informatsionnoy-bezopasnostyu-v-s/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/a5c/300_300_1/iv_2016_98_copy_.jpg" alt="IV Международная научно - практическая конференция «Управление информационной безопасностью в современном обществе»" class="album-pic">
                                        <div class="title"><p>2016 /  IV Международная научно - практическая конференция «Управление информационной безопасностью в современном обществе»</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/iv-vserossiyskaya-konferentsiya-bezopasnost-kriticheski-vazhnykh-obektov-tek/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/1ae/300_300_1/did_2433_copy_.jpg" alt="IV Всероссийская конференция «Безопасность критически важных объектов ТЭК»" class="album-pic">
                                        <div class="title"><p>2016 /  IV Всероссийская конференция «Безопасность критически важных объектов ТЭК»</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div><div class="owl-item cloned" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/antifraud-russia-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/732/300_300_1/antifraud_russia_2016_326_copy_.jpg" alt="ANTIFRAUD RUSSIA" class="album-pic">
                                        <div class="title"><p>2016 /  ANTIFRAUD RUSSIA</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2015/infobereg-2015/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/3ba/300_300_1/info2015_30_copy_.jpg" alt="ИнфоБЕРЕГ" class="album-pic">
                                        <div class="title"><p>2015 /  ИнфоБЕРЕГ</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2015/iii-mezhdunarodnoy-nauchno-prakticheskoy-konferentsii-upravlenie-informatsionnoy-bezopasnostyu-v-sov/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/31e/300_300_1/dsc3468_copy.jpg" alt="III Международной научно - практической конференции «Управление информационной безопасностью в современном обществе»" class="album-pic">
                                        <div class="title"><p>2015 /  III Международной научно - практической конференции «Управление информационной безопасностью в современном обществе»</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2015/iii-vserossiyskaya-konferentsiya-bezopasnost-kriticheski-vazhnykh-obektov-tek/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/e39/300_300_1/img_5833_copy.jpg" alt="III Всероссийская конференция «Безопасность критически важных объектов ТЭК»" class="album-pic">
                                        <div class="title"><p>2015 /  III Всероссийская конференция «Безопасность критически важных объектов ТЭК»</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div><div class="owl-item active center" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/it-festival-importozameshchenie-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/ec9/300_300_1/it_2017_95_.jpg" alt="ИТ-фестиваль «Импортозамещение" class="album-pic">
                                        <div class="title"><p>2017 /  ИТ-фестиваль «Импортозамещение</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/informatsionnaya-bezopasnost-i-pki-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/1a9/300_300_1/pki2017_98_.jpg" alt="Информационная безопасность и PKI" class="album-pic">
                                        <div class="title"><p>2017 /  Информационная безопасность и PKI</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/ruskripto-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/a01/300_300_1/img_9634_copy_.jpg" alt="РусКрипто" class="album-pic">
                                        <div class="title"><p>2017 /  РусКрипто</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/antifraud-russia-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/552/300_300_1/photo_1_of_78_copy_.jpg" alt="ANTIFRAUD RUSSIA" class="album-pic">
                                        <div class="title"><p>2017 /  ANTIFRAUD RUSSIA</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div><div class="owl-item" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/ruskripto-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/943/300_300_1/cy9a4129.jpg" alt="РусКрипто" class="album-pic">
                                        <div class="title"><p>2016 /  РусКрипто</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/infobereg-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/3e6/300_300_1/info2016_96_copy_.JPG" alt="ИнфоБЕРЕГ" class="album-pic">
                                        <div class="title"><p>2016 /  ИнфоБЕРЕГ</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/iv-mezhdunarodnaya-nauchno-prakticheskaya-konferentsiya-upravlenie-informatsionnoy-bezopasnostyu-v-s/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/a5c/300_300_1/iv_2016_98_copy_.jpg" alt="IV Международная научно - практическая конференция «Управление информационной безопасностью в современном обществе»" class="album-pic">
                                        <div class="title"><p>2016 /  IV Международная научно - практическая конференция «Управление информационной безопасностью в современном обществе»</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/iv-vserossiyskaya-konferentsiya-bezopasnost-kriticheski-vazhnykh-obektov-tek/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/1ae/300_300_1/did_2433_copy_.jpg" alt="IV Всероссийская конференция «Безопасность критически важных объектов ТЭК»" class="album-pic">
                                        <div class="title"><p>2016 /  IV Всероссийская конференция «Безопасность критически важных объектов ТЭК»</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div><div class="owl-item" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/antifraud-russia-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/732/300_300_1/antifraud_russia_2016_326_copy_.jpg" alt="ANTIFRAUD RUSSIA" class="album-pic">
                                        <div class="title"><p>2016 /  ANTIFRAUD RUSSIA</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2015/infobereg-2015/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/3ba/300_300_1/info2015_30_copy_.jpg" alt="ИнфоБЕРЕГ" class="album-pic">
                                        <div class="title"><p>2015 /  ИнфоБЕРЕГ</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2015/iii-mezhdunarodnoy-nauchno-prakticheskoy-konferentsii-upravlenie-informatsionnoy-bezopasnostyu-v-sov/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/31e/300_300_1/dsc3468_copy.jpg" alt="III Международной научно - практической конференции «Управление информационной безопасностью в современном обществе»" class="album-pic">
                                        <div class="title"><p>2015 /  III Международной научно - практической конференции «Управление информационной безопасностью в современном обществе»</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2015/iii-vserossiyskaya-konferentsiya-bezopasnost-kriticheski-vazhnykh-obektov-tek/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/e39/300_300_1/img_5833_copy.jpg" alt="III Всероссийская конференция «Безопасность критически важных объектов ТЭК»" class="album-pic">
                                        <div class="title"><p>2015 /  III Всероссийская конференция «Безопасность критически важных объектов ТЭК»</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div><div class="owl-item cloned" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/it-festival-importozameshchenie-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/ec9/300_300_1/it_2017_95_.jpg" alt="ИТ-фестиваль «Импортозамещение" class="album-pic">
                                        <div class="title"><p>2017 /  ИТ-фестиваль «Импортозамещение</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/informatsionnaya-bezopasnost-i-pki-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/1a9/300_300_1/pki2017_98_.jpg" alt="Информационная безопасность и PKI" class="album-pic">
                                        <div class="title"><p>2017 /  Информационная безопасность и PKI</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/ruskripto-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/a01/300_300_1/img_9634_copy_.jpg" alt="РусКрипто" class="album-pic">
                                        <div class="title"><p>2017 /  РусКрипто</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2017/antifraud-russia-2017/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/552/300_300_1/photo_1_of_78_copy_.jpg" alt="ANTIFRAUD RUSSIA" class="album-pic">
                                        <div class="title"><p>2017 /  ANTIFRAUD RUSSIA</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div><div class="owl-item cloned" style="width: 1140px;"><div class="slide row">
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/ruskripto-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/943/300_300_1/cy9a4129.jpg" alt="РусКрипто" class="album-pic">
                                        <div class="title"><p>2016 /  РусКрипто</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/infobereg-2016/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/3e6/300_300_1/info2016_96_copy_.JPG" alt="ИнфоБЕРЕГ" class="album-pic">
                                        <div class="title"><p>2016 /  ИнфоБЕРЕГ</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/iv-mezhdunarodnaya-nauchno-prakticheskaya-konferentsiya-upravlenie-informatsionnoy-bezopasnostyu-v-s/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/a5c/300_300_1/iv_2016_98_copy_.jpg" alt="IV Международная научно - практическая конференция «Управление информационной безопасностью в современном обществе»" class="album-pic">
                                        <div class="title"><p>2016 /  IV Международная научно - практическая конференция «Управление информационной безопасностью в современном обществе»</p></div>
                                    </a>
                                </div>
                            </div>
                                                                                <div class="col-6 col-md-6 col-lg-3">
                                                                <div class="photo-block">
                                    <a href="/library/photo/2016/iv-vserossiyskaya-konferentsiya-bezopasnost-kriticheski-vazhnykh-obektov-tek/" class="album album--small" rel="photo_arr">
                                        <img src="/upload/resize_cache/iblock/1ae/300_300_1/did_2433_copy_.jpg" alt="IV Всероссийская конференция «Безопасность критически важных объектов ТЭК»" class="album-pic">
                                        <div class="title"><p>2016 /  IV Всероссийская конференция «Безопасность критически важных объектов ТЭК»</p></div>
                                    </a>
                                </div>
                            </div>
                                            </div></div></div></div><div class="owl-nav" style="width: 1240px;"><button type="button" role="presentation" class="owl-prev"><div class="button button--round button--secondary icon-caret-left"></div></button><button type="button" role="presentation" class="owl-next"><div class="button button--round button--secondary icon-caret-right"></div></button></div><div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div></div><!--// end photoLine-items -->
            <div class="row">
                <div class="col">
                    <div class="button_holder">
                        <a href="/library/photo/" class="button button--common button--primary">Все фото</a>
                    </div>
                </div>
            </div>
        </div>
	</section>
	
	<section class="partners">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<h5>Партнеры и клиенты</h5>
					<div class="partners-slider owl-carousel owl-loaded owl-drag">

						<div class="owl-stage-outer">
							<div class="owl-stage"
								style="transition: all 0s ease 0s; width: 10944px; transform: translate3d(-2280px, 0px, 0px);">
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/389/24.png" title="АО «Концерн «Созвездие»"
											alt="АО «Концерн «Созвездие»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/046/37.png" title="«Газпромбанк»" alt="«Газпромбанк»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/0c4/25.png" title="«Технодинамика»" alt="«Технодинамика»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/08f/260_160_1/1447922630_logotip_1.png"
											title="«РОССЕЛЬХОЗБАНК»" alt="«РОССЕЛЬХОЗБАНК»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/ec8/26.png" title="АО «Сириус»" alt="АО «Сириус»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/5b2/260_160_1/Alfa_bank.jpg"
											title="«АЛЬФА-БАНК»" alt="«АЛЬФА-БАНК»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/379/27.png" title="«Ангарская нефтехимическая компания»"
											alt="«Ангарская нефтехимическая компания»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/19a/260_160_1/21939685.png"
											title="«МОСКОВСКИЙ КРЕДИТНЫЙ БАНК»" alt="«МОСКОВСКИЙ КРЕДИТНЫЙ БАНК»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/f7a/260_160_1/Promsvyazbank.jpg"
											title="«Промсвязьбанк»" alt="«Промсвязьбанк»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/49d/260_160_1/28.jpg" title="«БАНК ОТКРЫТИЕ»"
											alt="«БАНК ОТКРЫТИЕ»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned active" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/0ca/260_160_1/unicredit.png"
											title="«ЮниКредит Банк»" alt="«ЮниКредит Банк»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned active" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/2e9/260_160_1/logo_rayf.jpg"
											title="«Райффайзенбанк»" alt="«Райффайзенбанк»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item active center" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/284/ban1.png" title="Министерство Обороны РФ"
											alt="Министерство Обороны РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item active" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/d03/ban2.png" title="Министерство внутренних дел РФ"
											alt="Министерство внутренних дел РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item active" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/f6c/ban3.png" title="Министерство транспорта РФ"
											alt="Министерство транспорта РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/306/ban4.png" title="Министерство юстиции РФ"
											alt="Министерство юстиции РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/bba/ban5.png" title="Министерство здравоохранения РФ"
											alt="Министерство здравоохранения РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/d7d/6.png" title="Федеральная служба судебных приставов"
											alt="Федеральная служба судебных приставов" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/1ed/7.png" title="Федеральная служба исполнения наказаний"
											alt="Федеральная служба исполнения наказаний" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/622/21.png" title="ОАО «Северсталь»"
											alt="ОАО «Северсталь»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/318/22.png" title="ПАО «Интер РАО»" alt="ПАО «Интер РАО»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/7fc/34.png" title="«Сбербанк России»"
											alt="«Сбербанк России»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/127/23.png" title="«Связьтранснефть»"
											alt="«Связьтранснефть»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/0a2/260_160_1/VTB24.jpg" title="«ВТБ 24»"
											alt="«ВТБ 24»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/389/24.png" title="АО «Концерн «Созвездие»"
											alt="АО «Концерн «Созвездие»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/046/37.png" title="«Газпромбанк»" alt="«Газпромбанк»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/0c4/25.png" title="«Технодинамика»" alt="«Технодинамика»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/08f/260_160_1/1447922630_logotip_1.png"
											title="«РОССЕЛЬХОЗБАНК»" alt="«РОССЕЛЬХОЗБАНК»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/ec8/26.png" title="АО «Сириус»" alt="АО «Сириус»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/5b2/260_160_1/Alfa_bank.jpg"
											title="«АЛЬФА-БАНК»" alt="«АЛЬФА-БАНК»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/379/27.png" title="«Ангарская нефтехимическая компания»"
											alt="«Ангарская нефтехимическая компания»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/19a/260_160_1/21939685.png"
											title="«МОСКОВСКИЙ КРЕДИТНЫЙ БАНК»" alt="«МОСКОВСКИЙ КРЕДИТНЫЙ БАНК»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/f7a/260_160_1/Promsvyazbank.jpg"
											title="«Промсвязьбанк»" alt="«Промсвязьбанк»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/49d/260_160_1/28.jpg" title="«БАНК ОТКРЫТИЕ»"
											alt="«БАНК ОТКРЫТИЕ»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/0ca/260_160_1/unicredit.png"
											title="«ЮниКредит Банк»" alt="«ЮниКредит Банк»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/2e9/260_160_1/logo_rayf.jpg"
											title="«Райффайзенбанк»" alt="«Райффайзенбанк»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/284/ban1.png" title="Министерство Обороны РФ"
											alt="Министерство Обороны РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/d03/ban2.png" title="Министерство внутренних дел РФ"
											alt="Министерство внутренних дел РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/f6c/ban3.png" title="Министерство транспорта РФ"
											alt="Министерство транспорта РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/306/ban4.png" title="Министерство юстиции РФ"
											alt="Министерство юстиции РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/bba/ban5.png" title="Министерство здравоохранения РФ"
											alt="Министерство здравоохранения РФ" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/d7d/6.png" title="Федеральная служба судебных приставов"
											alt="Федеральная служба судебных приставов" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/1ed/7.png" title="Федеральная служба исполнения наказаний"
											alt="Федеральная служба исполнения наказаний" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/622/21.png" title="ОАО «Северсталь»"
											alt="ОАО «Северсталь»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/318/22.png" title="ПАО «Интер РАО»" alt="ПАО «Интер РАО»"
											class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/7fc/34.png" title="«Сбербанк России»"
											alt="«Сбербанк России»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/iblock/127/23.png" title="«Связьтранснефть»"
											alt="«Связьтранснефть»" class="img-fluid">

									</div>
								</div>
								<div class="owl-item cloned" style="width: 228px;">
									<div class="slide">

										<img src="/upload/resize_cache/iblock/0a2/260_160_1/VTB24.jpg" title="«ВТБ 24»"
											alt="«ВТБ 24»" class="img-fluid">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>