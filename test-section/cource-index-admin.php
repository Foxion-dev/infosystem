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
	<div id="wrapper">
		<link rel="stylesheet" href="assets/css/main.min.css">
		<header>
			<!-- <img src="./assets/images/header(1).jpg" alt="">

		</header> -->
		<div class="links flex-block">
			<a href="index-user.php" class="hover-link">Расписание пользователь</a>
			<a href="index.php" class="hover-link">Расписание администратор</a>
			<a href="cource-index-admin.php" class="hover-link">карточка курса админ</a>
			<a href="cource-index.php" class="hover-link">карточка курса пользователь</a>
		</div>
		<main>
			<section class="timetable">
				<div class="container">

					<div class="timetable__title-block flex-block">
						<h1 class="timetable__title">Курс: Astra Linux. Специальный курс</h1>
					</div>

					<div class="timetable__course-info course-info flex-block">
						<div class="course-info__column course-info__column--left info-list">

							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Даты проведения:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text txt-info"> 03.05 - 12.10</span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Форма проведения:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text txt-info">очная</span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Продолжительность курса:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text txt-info">5 дней 40 ак.часов</span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Преподаватель:</div>
								<div class="info-list__item-info">
									<span class="info-list__item-link default-link txt-info">Иванов Иван Сергеевич</span> 
									<span class="info-list__item-text txt-info">Сергеев Сергей Иванович</span> 
								</div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Место проведения:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text txt-info">ул. Пушкина, д. 15. </span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Аудитория:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text txt-info">373</span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Рабочие места:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text ellipse-bg ellipse-bg--green">20</span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Рабочие места с ПК:</div>
								<div class="info-list__item-info"> <span class="info-list__item-text ellipse-bg ellipse-bg--red">20</span> </div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Требование к рабочему месту:</div>
								<div class="info-list__item-info"> 
									<span class="info-list__item-text"> — Компьютер </span>
									<span class="info-list__item-text"> — ПО: Microsoft Word </span>
								</div>
							</div>
							<div class="info-list__item flex-block">
								<div class="info-list__item-title bold">Куратор курса:</div>
								<div class="info-list__item-info"> 
									<span class="info-list__item-text"> Петрова Евгения Евгеньевна </span>
									<span class="info-list__item-text"> +7 (495) 120-04-02 </span>
									<span class="info-list__item-text"> info@infosystems.ru </span>
								</div>
							</div>

						</div>
						<div class="course-info__column user-list">
							<div class="user-list__title-block flex-block">
								<h3 class="user-list__title bold">Количество слушателей: </h3>
								<span class="user-list__title-count bold">44 </span>
							</div>
							<div class="user-list__title-block flex-block">
								<h3 class="user-list__title bold">Дистанционных слушателей: </h3>
								<span class="user-list__title-count bold">14 </span>
							</div>
							<div class="user-list__list">
								<a href="##" style='display:block;'class="user-list__item hover-link">Иванов Иван Сергеевич</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
								<a href="##" style='display:block;'class="user-list__item hover-link user-list__item--online">Иванов Иван Сергеевич</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Иванов Иван Сергеевич</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
								<a href="##" style='display:block;'class="user-list__item hover-link user-list__item--online">Иванов Иван Сергеевич</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Иванов Иван Сергеевич</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
								<a href="##" style='display:block;'class="user-list__item hover-link">Иванов Иван Сергеевич</a>
								<a href="##" style='display:block;'class="user-list__item hover-link user-list__item--online">Сергеев Сергей Иванович</a>
								<div class="user-list__hide-list">
									<a href="##" style='display:block;'class="user-list__item hover-link user-list__item--online">Иванов Иван Сергеевич</a>
									<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
									<a href="##" style='display:block;'class="user-list__item hover-link user-list__item--online">Иванов Иван Сергеевич</a>
									<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
									<a href="##" style='display:block;'class="user-list__item hover-link">Иванов Иван Сергеевич</a>
									<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
									<a href="##" style='display:block;'class="user-list__item hover-link">Иванов Иван Сергеевич</a>
									<a href="##" style='display:block;'class="user-list__item hover-link">Сергеев Сергей Иванович</a>
								</div>
								<div class="user-list__more default-link js-more-users">Все слушатели</div>
							</div>
						</div>
					</div>

					<div class="timetable__content calendar-table">
						<div class="calendar-table__head flex-block">

							<div class="calendar-table__links-box  flex-block">
								<a href="javascript: void(0)" data-view='M' class="calendar-table__link flex-block js-tab-view-link active ">Месяц</a>
								<a href="javascript: void(0)" data-view='W' class="calendar-table__link js-tab-view-link  flex-block">Неделя</a>
								<a href="javascript: void(0)" data-view='D' class="calendar-table__link js-tab-view-link flex-block">День</a>
								<!-- <a href="javascript: void(0)" data-view='no' class="calendar-table__link js-tab-view-link flex-block">нет</a> -->
							</div>

							<div class="calendar-table__current selection  flex-block">
								<div class="selection__wrap  flex-block js-current-selection active"  data-view='M'>

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
								<div class="selection__wrap flex-block js-current-selection "  data-view='W'>
									
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

						<div class="calendar-table__content  flex-block js-tab-view-content active"  data-view='M'>
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
												<div class="events-list__time-block flex-block">
													<span class="events-list__item-time">09:00 - 10:00</span>
													<span class="icon-circle icon-circle--green"></span>
												</div>
												<span class="events-list__item-preview js-open-detail">X634PK-12</span>

												<div class="events-list__item-detail event-info event-info--admin">
													<div class="event-info__head flex-block">
														<div class="event-info__code  flex-block">
															<span class="event-info__code-text">X634PK-12</span>
															<span class="icon-circle icon-circle--green"></span>
														</div>
														<span class="event-info__close js-close-detail">+</span>
													</div>
													
													<div class="event-info__description">
														<span class="txt-info bold">Курс: </span>
														<a href="cource-index.html" class="txt-info hover-link">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</a>
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
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Аудитория:</span>
															<span class="txt-info">373</span>
														</li>
														<li class="event-info__dop-info-item flex-block">
															<span class="txt-info">Количество сделок:</span>
															<span class="txt-info">34</span>
														</li>
													</ul>
												</div>

											</div>
											<div class="events-list__item flex-block">
												<!-- <span class="events-list__item-time">09:00 - 10:00</span> -->
												<div class="events-list__time-block flex-block">
													<span class="events-list__item-time">09:00 - 10:00</span>
													<span class="icon-circle icon-circle--blue"></span>
												</div>
												<span class="events-list__item-preview js-open-detail">X634PK-12</span>
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
														<a href="cource-index.html" class="txt-info hover-link">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</a>
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

								<div class="calendar-table__description-box flex-block">
									<div class="calendar-table__description-item  flex-block">
										<span class="calendar-table__description-icon icon-circle icon-circle--green"></span>
										<span class="calendar-table__description-text bold">Статус курса «Набор»</span>
									</div>
									<div class="calendar-table__description-item  flex-block">
										<span class="calendar-table__description-icon icon-circle icon-circle--blue"></span>
										<span class="calendar-table__description-text bold">Статус курса «Утверждён»</span>
									</div>
								</div>
						</div>


						<div class="calendar-table__content flex-block js-tab-view-content"  data-view='W'>
							<table class="weeks-table__table weeks-table weeks-table--admin">
								<tbody>
									<tr class="weeks-table__head">
										<!-- <td></td> -->
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">пн</span><span class="weeks-table__number">03</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">вт</span><span class="weeks-table__number">04</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">ср</span><span class="weeks-table__number">05</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">чт</span><span class="weeks-table__number">06</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">пт</span><span class="weeks-table__number">07</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">сб</span><span class="weeks-table__number">08</span></div></th>
										<th><div class="weeks-table__title-wrap"><span class="weeks-table__day">вс</span><span class="weeks-table__number">09</span></div></th>
	
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">08:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">09:00</span></th> -->
										<td>
											<span class="weeks-table__item txt-info  js-hover-detail-text">
												<div class="events-list__item flex-block ">
													<!-- <span class="events-list__item-time">15:00 - 16:00</span> -->
													<!-- <span class="events-list__item-preview js-hide-preview">Обеспечение безопасности...</span>
													<span class="events-list__detail-text js-open-detail">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
													<span class="events-list__item-preview js-open-detail flex-block">
														<span>X634PK-12</span>
														<span class="events-list__-icon icon-circle icon-circle--green"></span>

													</span>
													<!-- <span class="events-list__detail-text ">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
													<div class="events-list__item-detail event-info event-info--admin">
														<div class="event-info__head flex-block">
															<div class="event-info__code  flex-block">
																<span class="event-info__code-text">X634PK-12</span>
																<span class="icon-circle icon-circle--green"></span>
															</div>
															<span class="event-info__close js-close-detail">+</span>
														</div>
														<div class="event-info__description">
															<span class="txt-info bold">Курс: </span>
															<a href="cource-index.html" class="txt-info hover-link">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</a>
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
										<td>
											<span class="weeks-table__item txt-info  js-hover-detail-text">
												<div class="events-list__item flex-block ">
													<!-- <span class="events-list__item-time">15:00 - 16:00</span> -->
													<!-- <span class="events-list__item-preview js-hide-preview">Обеспечение безопасности...</span>
													<span class="events-list__detail-text js-open-detail">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
													<span class="events-list__item-preview js-open-detail flex-block">
														<span>X634PK-12</span>
														<span class="events-list__-icon icon-circle icon-circle--green"></span>

													</span>
													<!-- <span class="events-list__detail-text ">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
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
										<td>
											<span class="weeks-table__item txt-info  js-hover-detail-text">
												<div class="events-list__item flex-block ">
													<!-- <span class="events-list__item-time">15:00 - 16:00</span> -->
													<!-- <span class="events-list__item-preview js-hide-preview">Обеспечение безопасности...</span>
													<span class="events-list__detail-text js-open-detail">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
													<span class="events-list__item-preview js-open-detail flex-block">
														<span>X634PK-12</span>
														<span class="events-list__-icon icon-circle icon-circle--green"></span>

													</span>
													<!-- <span class="events-list__detail-text ">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
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
										<td>
											<span class="weeks-table__item txt-info  js-hover-detail-text">
												<div class="events-list__item flex-block ">
													<!-- <span class="events-list__item-time">15:00 - 16:00</span> -->
													<!-- <span class="events-list__item-preview js-hide-preview">Обеспечение безопасности...</span>
													<span class="events-list__detail-text js-open-detail">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
													<span class="events-list__item-preview js-open-detail flex-block">
														<span>X634PK-12</span>
														<span class="events-list__-icon icon-circle icon-circle--green"></span>

													</span>
													<!-- <span class="events-list__detail-text ">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
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
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">10:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<!-- <td><span class="weeks-table__item txt-info"></span></td> -->
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">11:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">12:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">13:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">14:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">15:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td>
											<span class="weeks-table__item txt-info  js-hover-detail-text">
												<div class="events-list__item flex-block ">
													<!-- <span class="events-list__item-time">15:00 - 16:00</span> -->
													<!-- <span class="events-list__item-preview js-hide-preview">Обеспечение безопасности...</span>
													<span class="events-list__detail-text js-open-detail">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
													<span class="events-list__item-preview js-open-detail flex-block">
														<span>X634PK-12</span>
														<span class="events-list__-icon icon-circle icon-circle--blue"></span>

													</span>
													<!-- <span class="events-list__detail-text ">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</span> -->
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
										<!-- <th><span class="weeks-table__title bold">16:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>

									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">17:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>

									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">18:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">19:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">20:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">21:00</span></th> -->
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
										<td><span class="weeks-table__item txt-info"></span></td>
									</tr>
									<tr class="weeks-table__row">
										<!-- <th><span class="weeks-table__title bold">22:00</span></th> -->
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
							<div class="calendar-table__description-box flex-block">
								<div class="calendar-table__description-item  flex-block">
									<span class="calendar-table__description-icon icon-circle icon-circle--green"></span>
									<span class="calendar-table__description-text bold">Статус курса «Набор»</span>
								</div>
								<div class="calendar-table__description-item  flex-block">
									<span class="calendar-table__description-icon icon-circle icon-circle--blue"></span>
									<span class="calendar-table__description-text bold">Статус курса «Утверждён»</span>
								</div>
							</div>
						</div>

						<div class="calendar-table__content flex-block js-tab-view-content "  data-view='D'>
							<table class="day-table day-table--admin">
							
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
										<th><span class="day-table__title">Аудитория 2</span></th>
										<td><span class="day-table__item"></span></td>
										<td colspan="2">
											<span class="day-table__item">
												<div class="day-table__item-top">
													<span class="day-table__item-text flex-block">
														<span class="bold">X634PK-12</span>
														<span class="day-table__description-icon icon-circle icon-circle--blue"></span>
														
													</span>
													<a href="cource-index.html" class="day-table__item-text hover-link">Обеспечение безопасности персональных данных при их обработке в информационных системах персональных данных (Программа согласована ФСТЭК России)</a>
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
										<th><span class="day-table__title">Аудитория 12</span></th>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td >
											<span class="day-table__item">
												<!-- <div class="day-table__item-top">
													<span class="day-table__item-text">ул. Пушкина, д. 15.</span>
													<span class="day-table__item-text">Аудитория: 373</span>
												</div>
												<div class="day-table__item-bottom">
													<span class="day-table__item-text bold">12:00 - 18:00</span>
												</div> -->
											</span>
										</td>
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
										<th><span class="day-table__title">Аудитория 24</span></th>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td><span class="day-table__item"></span></td>
										<td colspan="6">
											<span class="day-table__item">
												<div class="day-table__item-top">
													<span class="day-table__item-text flex-block">
														<span class="bold">X634PK-12</span>
														<span class="day-table__description-icon icon-circle icon-circle--green"></span>
														
													</span>
													<a href="##" style='display:block;'class="day-table__item-text hover-link">Astra Linux. Специальный курс</a>
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
							<div class="calendar-table__description-box flex-block">
								<div class="calendar-table__description-item  flex-block">
									<span class="calendar-table__description-icon icon-circle icon-circle--green"></span>
									<span class="calendar-table__description-text bold">Статус курса «Набор»</span>
								</div>
								<div class="calendar-table__description-item  flex-block">
									<span class="calendar-table__description-icon icon-circle icon-circle--blue"></span>
									<span class="calendar-table__description-text bold">Статус курса «Утверждён»</span>
								</div>
							</div>
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

<!-- </body>

</html> -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
