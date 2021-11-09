
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расписание");
?>

<!-- <!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>AIS</title>

</head>

<body  class="timetable-page"> -->
	<link rel="stylesheet" href="assets/css/main.min.css">
	<div id="wrapper">

		<!-- <header>
			<img src="./assets/images/header(1).jpg" alt="">

		</header> -->
		<div class="links flex-block">
			<a href="index-user.php" class="hover-link">Расписание пользователь</a>
			<a href="index.php" class="hover-link">Расписание администратор</a>
			<a href="cource-index-admin.php" class="hover-link">карточка курса админ</a>
			<a href="cource-index.php" class="hover-link">карточка курса пользователь</a>
		</div>
		<main>
			<section class="timetable timetable--mounth timetable--user">
				<div class="container">

					<div class="timetable__title-block flex-block">
						<h1 class="timetable__title">Моё расписание</h1>
						<div class="timetable__warn flex-block">
							<img src="./assets/images/icons/warn-icon.png" alt="">
							<span class="txt-info">Внимание! Курсы в расписании появляются после полного набора группы!</span>
						</div>
					</div>

					<div class="timetable__content calendar-table">
						<div class="calendar-table__head flex-block">

							<div class="calendar-table__links-box  flex-block">
								<a href="javascript: void(0)" data-view='M' class="calendar-table__link flex-block js-tab-view-link ">Месяц</a>
								<a href="javascript: void(0)" data-view='W' class="calendar-table__link js-tab-view-link active flex-block">Неделя</a>
								<a href="javascript: void(0)" data-view='D' class="calendar-table__link js-tab-view-link flex-block">День</a>
								<!-- <a href="javascript: void(0)" data-view='no' class="calendar-table__link js-tab-view-link flex-block">нет</a> -->
							</div>

							<div class="calendar-table__current selection  flex-block">
								<div class="selection__wrap  flex-block js-current-selection"  data-view='M'>

									<span class="selection__arrow arrow-left">
										<svg> 
												<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>
									<span class="selection__text extra-bold">Сентябрь, 2021</span>
									<span class="selection__arrow arrow-right">
										<svg> 
											<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>

								</div>
								<div class="selection__wrap flex-block js-current-selection active"  data-view='W'>
									
									<span class="selection__arrow arrow-left">
										<svg> 
												<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>

									<span class="selection__text extra-bold">03.09 - 09.09</span>

									<span class="selection__arrow arrow-right">
										<svg> 
											<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>
									<span class="selection__subtext bold">Сентябрь 2021</span>
								</div>
								<div class="selection__wrap flex-block js-current-selection"  data-view='D'>
									<span class="selection__arrow arrow-left">
										<svg> 
												<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>

									<span class="selection__text extra-bold">20 Сентября, 2021</span>

									<span class="selection__arrow arrow-right">
										<svg> 
											<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>
								</div>
								<div class="selection__wrap flex-block js-current-selection"  data-view='no'>
									<span class="selection__arrow arrow-left">
										<svg> 
												<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>

									<span class="selection__text extra-bold">21 Сентября, 2021</span>

									<span class="selection__arrow arrow-right">
										<svg> 
											<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
										</svg>
									</span>
								</div>

							</div>

						</div>

						<div class="calendar-table__content  flex-block js-tab-view-content" data-view='M'>
								<div class="calendar-table__row calendar-table__row--titles">
									<div class="calendar-table__item calendar-table__item--title  flex-block">пн</div>
									<div class="calendar-table__item calendar-table__item--title flex-block">вт</div>
									<div class="calendar-table__item calendar-table__item--title flex-block">ср</div>
									<div class="calendar-table__item calendar-table__item--title flex-block">чт</div>
									<div class="calendar-table__item calendar-table__item--title flex-block">пт</div>
									<div class="calendar-table__item calendar-table__item--title flex-block">сб</div>
									<div class="calendar-table__item calendar-table__item--title flex-block">вс</div>
								</div>
								<div class="calendar-table__row">
									<div class="calendar-table__item">
										<h6 class="calendar-table__item-title">01</h6>

										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview js-open-detail">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close js-close-detail">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview js-open-detail">Обеспечение безопасности ...</span>
											</div>

											<div class="events-list__hide-block js-hide-block">
												<div class="events-list__item flex-block">
													<span class="events-list__item-time">09:00 - 10:00</span>
													<span class="events-list__item-preview js-open-detail">Обеспечение безопасности ...</span>
												</div>
												<div class="events-list__item flex-block">
													<span class="events-list__item-time">09:00 - 10:00</span>
													<span class="events-list__item-preview js-open-detail">Обеспечение безопасности ...</span>
												</div>
											</div>

											<div class="events-list__link-more js-open-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>

									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">02</h6>
										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>
									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">03</h6>
									</div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">04</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">05</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">06</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">07</h6></div>
								</div>
								<div class="calendar-table__row">
									<div class="calendar-table__item">
										<h6 class="calendar-table__item-title">08</h6>

										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>

									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">09</h6>
										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>
									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">10</h6>
									</div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">11</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">12</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">13</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">14</h6></div>
								</div>
								<div class="calendar-table__row">
									<div class="calendar-table__item">
										<h6 class="calendar-table__item-title">15</h6>

										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>

									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">16</h6>
										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>
									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">17</h6>
									</div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">18</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">19</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">20</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">21</h6></div>
								</div>
								<div class="calendar-table__row">
									<div class="calendar-table__item">
										<h6 class="calendar-table__item-title">22</h6>

										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>

									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">23</h6>
										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>
									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">24</h6>
									</div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">25</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">26</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">27</h6></div>
									<div class="calendar-table__item flex-block"><h6 class="calendar-table__item-title">28</h6></div>
								</div>
								<div class="calendar-table__row">
									<div class="calendar-table__item">
										<h6 class="calendar-table__item-title">29</h6>

										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>

									</div>
									<div class="calendar-table__item flex-block">
										<h6 class="calendar-table__item-title">30</h6>
										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>
									</div>
									<div class="calendar-table__item calendar-table__item--next-mounth flex-block">
										<h6 class="calendar-table__item-title">01</h6>
									</div>
									<div class="calendar-table__item calendar-table__item--next-mounth flex-block"><h6 class="calendar-table__item-title">02</h6></div>
									<div class="calendar-table__item calendar-table__item--next-mounth flex-block"><h6 class="calendar-table__item-title">03</h6></div>
									<div class="calendar-table__item calendar-table__item--next-mounth flex-block"><h6 class="calendar-table__item-title">04</h6></div>
									<div class="calendar-table__item calendar-table__item--next-mounth flex-block">
										<h6 class="calendar-table__item-title">05</h6>
										<div class="calendar-table__item-content events-list">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Пятница, 14.05  - 09:00 - 10:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">09:00 - 10:00</span>
												<span class="events-list__item-preview">Обеспечение безопасности ...</span>
											</div>
											<div class="events-list__link-more">
												<img src="./assets/images/icons/more.png" alt="">
											</div>
										</div>
									</div>
								</div>
						</div>


						<div class="calendar-table__content flex-block js-tab-view-content"  data-view='W'>
							<table class="weeks-table__table weeks-table">
								<tbody>
									<tr class="weeks-table__head">
										<td></td>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">пн</span><span class="weeks-table__number">03</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">вт</span><span class="weeks-table__number">04</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">ср</span><span class="weeks-table__number">05</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">чт</span><span class="weeks-table__number">06</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">пт</span><span class="weeks-table__number">07</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">сб</span><span class="weeks-table__number">08</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">вс</span><span class="weeks-table__number">09</span></div></th>
	
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">08:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">09:00</span></th>
										<td rowspan="2">
											<span class="weeks-table__item txt-info  js-hover-detail-text">
												<div class="events-list__item flex-block ">
													<span class="events-list__item-time">15:00 - 16:00</span>
													<span class="events-list__item-preview js-hide-preview">Обеспечение безопасности...</span>
													<span class="events-list__detail-text js-open-detail">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													<div class="events-list__item-detail event-info">
														<span class="event-info__close js-close-detail">+</span>
														<div class="event-info__description">
															<span class="txt-info bold">Курс: </span>
															<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
														</div>
														<span class="event-info__date bold">Среда, 05.05  - 15:00 - 16:00</span>
														<ul class="event-info__dop-info-list">
															<li class="event-info__dop-info-item flex-block">
																<span class="txt-info">Форма проведения:</span>
																<span class="txt-info">очная</span>
															</li>
															<li class="event-info__dop-info-item flex-block">
																<span class="txt-info">Преподаватель:</span>
																<span class="txt-info">Иванов Иван Сергеевич</span>
															</li>
															<li class="event-info__dop-info-item flex-block">
																<span class="txt-info">Место проведения:</span>
																<span class="txt-info">ул. Пушкина, д. 15.</span>
															</li>
														</ul>
													</div>
	
												</div>
	
											</span>
										</td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">10:00</span></th>
										<!-- <td><span class="weeks-table__item txt-info"></span></td> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<!-- <td><span class="weeks-table__item txt-info"></span></td> -->
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">11:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">12:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">13:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">14:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">15:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td rowspan="2">
											<span class="weeks-table__item txt-info">
											<div class="events-list__item flex-block">
												<span class="events-list__item-time">15:00 - 16:00</span>
												<span class="events-list__item-preview js-open-detail">Astra Linux. Специальный курс ...</span>

												<div class="events-list__item-detail event-info">
													<span class="event-info__close js-close-detail">+</span>
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<span class="txt-info">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span>
													</div>
													<span class="event-info__date bold">Среда, 05.05  - 15:00 - 16:00</span>
													<ul class="event-info__dop-info-list">
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Форма проведения:</span>
															<span class="txt-info">очная</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Преподаватель:</span>
															<span class="txt-info">Иванов Иван Сергеевич</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Место проведения:</span>
															<span class="txt-info">ул. Пушкина, д. 15.</span>
														</li>
													</ul>
												</div>

											</div>

										</span>
										</td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">16:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<!-- <td><span class="weeks-table__item txt-info"></span></td> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>

									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">17:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>

									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">18:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">19:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">20:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">21:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<th><span class="weeks-table__title bold">22:00</span></th>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="calendar-table__content flex-block js-tab-view-content  active"  data-view='D'>
							<table class="day-table">
							
									<h5 class="day-table__current-day">Понедельник</h5>
									<div class="day-table__function-block">
										<div class="day-table__arrow-left js-arrow-left">
											<svg> 
													<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
											</svg>
										</div>
										<div class="day-table__arrow-right active js-arrow-right">
											<svg> 
													<use xlink:href="assets/images/sprite.svg#arrow"> </use> 
											</svg>
										</div>

									</div>
									<tr class="day-table__head">
										<td></td>
										<th><span class="day-table__title-head bold">8:00 - 9:00</span></th>
										<th><span class="day-table__title-head bold">9:00 - 10:00</span></th>
										<th><span class="day-table__title-head bold">10:00 - 11:00</span></th>
										<th><span class="day-table__title-head bold">11:00 - 12:00</span></th>
										<th><span class="day-table__title-head bold">12:00 - 13:00</span></th>
										<th><span class="day-table__title-head bold">13:00 - 14:00</span></th>
										<th><span class="day-table__title-head bold">14:00 - 15:00</span></th>
										<th><span class="day-table__title-head bold">15:00 - 16:00</span></th>
										<th><span class="day-table__title-head bold">16:00 - 17:00</span></th>
										<th><span class="day-table__title-head bold">17:00 - 18:00</span></th>
										<th><span class="day-table__title-head bold">18:00 - 19:00</span></th>
										<th><span class="day-table__title-head bold">19:00 - 20:00</span></th>
										<th><span class="day-table__title-head bold">20:00 - 21:00</span></th>
										<th><span class="day-table__title-head bold">21:00 - 22:00</span></th>
									</tr>
									<tr  class="day-table__row">
										<th><a href="/test-section/cource-index.php" class="day-table__title hover-link">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</a></th>
										<td><span class="day-table__item"></span></td>
										<td colspan="2">
											<span class="day-table__item">
												<div class="day-table__item-top">
													<span class="day-table__item-text">ул. Пушкина, д. 15.</span>
													<span class="day-table__item-text">Аудитория: 373</span>
												</div>
												<div class="day-table__item-bottom">
													<span class="day-table__item-text bold">09:00 - 11:00</span>
												</div>
											</span>
										</td>
										<!-- <td><span class="day-table__item"></span></td> -->
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
									</tr>
									<tr class="day-table__row">
										<th><a href="/test-section/cource-index.php" class="day-table__title hover-link">Astra Linux. </br>Специальный курс</a></th>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td colspan="6">
											<span class="day-table__item">
												<div class="day-table__item-top">
													<span class="day-table__item-text">ул. Пушкина, д. 15.</span>
													<span class="day-table__item-text">Аудитория: 373</span>
												</div>
												<div class="day-table__item-bottom">
													<span class="day-table__item-text bold">12:00 - 18:00</span>
												</div>
											</span>
										</td>
										<!-- <td><span class="day-table__item"></span></td> -->
										<!-- <td><span class="day-table__item"></span></td> -->
										<!-- <td><span class="day-table__item"></span></td> -->
										<!-- <td><span class="day-table__item"></span></td> -->
										<!-- <td><span class="day-table__item"></span></td> -->
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="calendar-table__content flex-block js-tab-view-content "  data-view='no'>
							<div class="calendar-table__no-events no-events flex-block">
								<h5 class="no-events__current-day">Понедельник</h5>

								<div class="no-events__icon">
									<svg> 
											<use xlink:href="assets/images/sprite.svg#calendar-icon"> </use> 
									</svg>
								</div>
								<div class="no-events__title bold">У вас сегодня нет занятий</div>

							</div>
						</div>
					</div>

				</div>
			</section>
		</main>
		<!-- <footer>
			<img src="./assets/images/footer.jpg" alt="">
		</footer> -->
	</div>
	<script src="./assets/js/main.min.js" ></script>
<!-- 
</body>

</html> -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
