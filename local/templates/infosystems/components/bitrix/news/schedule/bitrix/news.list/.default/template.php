<?php
use Bitrix\Main\Type\DateTime;
use InfoSystems\Schedule\Calendar;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

if ($_REQUEST['date']) {
    $currentDate = new \Bitrix\Main\Type\DateTime($_REQUEST['date']);
} else {
    $currentDate = new \Bitrix\Main\Type\DateTime();
}
$currentDate = new \Bitrix\Main\Type\DateTime();

$monthDays = Calendar::getDaysInMonth(
    $currentDate->format('Y'),
    $currentDate->format('m')
);

$monthDays = range(1, $monthDays);

$calendar = new Calendar($currentDate);
?>
<div id="wrapper">

    <link rel="stylesheet" href="assets/css/main.min.css">
    <main>
        <section class="timetable">
            <div class="container">
                <div class="timetable__title-block flex-block">
                    <h1 class="timetable__title">Расписание</h1>
                    <div class="timetable__warn flex-block">
                        <img src="./assets/images/icons/warn-icon.png" alt="">
                        <span class="txt-info">Внимание! Курсы в расписании появляются после полного набора группы!</span>
                    </div>
                </div>

                <div class="timetable__content calendar-table">

                    <div class="calendar-table__head flex-block">

                        <div class="calendar-table__links-box  flex-block">
                            <a href="javascript: void(0)" data-view='M' class="calendar-table__link flex-block js-tab-view-link active ">Месяц</a>
                            <a href="javascript: void(0)" data-view='W' class="calendar-table__link js-tab-view-link  flex-block">Неделя</a>
                            <a href="javascript: void(0)" data-view='D' class="calendar-table__link js-tab-view-link flex-block">День</a>
                        </div>

                        <div class="calendar-table__current selection  flex-block">
                            <div class="selection__wrap flex-block js-current-selection active" data-view='M'>
                                <span class="selection__arrow arrow-left prev-month" data-date="<?//=$date->add('-1 months')->format('m.Y')?>">
                                    <svg>
                                        <use xlink:href="assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__text extra-bold"><?//=FormatDate('f, Y', MakeTimeStamp($currentDate))?></span>
                                <span class="selection__arrow arrow-right next-month" data-date="<?//=$date->add('+1 months')->format('m.Y')?>">
                                    <svg>
                                        <use xlink:href="assets/images/sprite.svg#arrow"></use>
                                    </svg>
                                </span>
                            </div>
                            <div class="selection__wrap flex-block js-current-selection" data-view='W'>
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
                            <div class="selection__wrap flex-block js-current-selection" data-view='D'>
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
                            <div class="selection__wrap flex-block js-current-selection" data-view='no'>
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

                    <div class="calendar-table__content  flex-block js-tab-view-content active" data-view='M'>
                        <div class="calendar-table__row calendar-table__row--titles">
                            <?php foreach (Calendar::RUS_DAYS as $day):?>
                                <div class="calendar-table__item calendar-table__item--title flex-block">
                                    <?=$day['short']?>
                                </div>
                            <?php endforeach?>
                        </div>
                        <?php foreach (array_chunk($monthDays, 7) as $weekDays):?>
                            <div class="calendar-table__row">
                                <?php foreach ($weekDays as $day):?>
                                    <div class="calendar-table__item">
                                        <h6 class="calendar-table__item-title"><?=$day?></h6>
                                    </div>
                                <?php endforeach?>
                            </div>
                        <?php endforeach?>
                    </div>
                    <div class="calendar-table__content flex-block js-tab-view-content" data-view='W'>
                        <table class="weeks-table__table weeks-table weeks-table--admin">
                            <tbody>
                            <tr class="weeks-table__head">
                                <td></td>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">пн</span>
                                        <span class="weeks-table__number">03</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">вт</span>
                                        <span class="weeks-table__number">04</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">ср</span>
                                        <span class="weeks-table__number">05</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">чт</span>
                                        <span class="weeks-table__number">06</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">пт</span>
                                        <span class="weeks-table__number">07</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">сб</span>
                                        <span class="weeks-table__number">08</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="weeks-table__title-wrap">
                                        <span class="weeks-table__day">вс</span>
                                        <span class="weeks-table__number">09</span>
                                    </div>
                                </th>

                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title">Аудитория 212</span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title">Аудитория 312</span></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title">Аудитория 212</span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <!-- <td><span class="weeks-table__item txt-info"></span></td> -->
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title">Аудитория 212</span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title">Аудитория 212</span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title">Аудитория 212</span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>

                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>

                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                                <td><span class="weeks-table__item txt-info"></span></td>
                            </tr>
                            <tr class="weeks-table__row">
                                <th><span class="weeks-table__title"></span></th>
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
                    <div class="calendar-table__content flex-block js-tab-view-content" data-view='D'>
                        <table class="day-table day-table--admin">

                            <h5 class="day-table__current-day">Понедельник</h5>
                            <div class="day-table__function-block">
                                <div class="day-table__arrow-left js-arrow-left">
                                    <svg>
                                        <use xlink:href="assets/images/sprite.svg#arrow"></use>
                                    </svg>
                                </div>
                                <div class="day-table__arrow-right active js-arrow-right">
                                    <svg>
                                        <use xlink:href="assets/images/sprite.svg#arrow"></use>
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
                            <tr class="day-table__row">
                                <th><span class="day-table__title">Аудитория 2</span></th>
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
                                <th><span class="day-table__title">Аудитория 24</span></th>
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
                                <td><span class="day-table__item"></span></td>
                                <td><span class="day-table__item"></span></td>
                                <td><span class="day-table__item"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="calendar-table__content flex-block js-tab-view-content" data-view='no'>
                        <div class="calendar-table__no-events no-events flex-block">
                            <h5 class="no-events__current-day">Понедельник</h5>
                            <div class="no-events__icon">
                                <svg>
                                    <use xlink:href="assets/images/sprite.svg#calendar-icon"></use>
                                </svg>
                            </div>
                            <div class="no-events__title bold">У вас сегодня нет занятий</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script src="./assets/js/main.min.js"></script>

<?
$currentDate = new \Bitrix\Main\Type\DateTime();
$curDate = $currentDate->setDate(2021, 8, 3);
$prevDate = (new \Bitrix\Main\Type\DateTime())->add('-1 months');
$nextDate = (new \Bitrix\Main\Type\DateTime())->add('+1 months');
?>
<pre>
    <?print_r([
        'curDate' => $curDate->toString(),
        'prevDate' => $prevDate->toString(),
        'nextDate' => $nextDate->toString()
    ])?>
</pre>
<script>

    document.addEventListener('DOMContentLoaded', function(){
        const bxFetch = async (url, formData) => {
            const fetchResp = await fetch(url, {
                method: 'post',
                headers: {
                    'bx-ajax': 'Y',
                },
                body: formData
            });
            if (!fetchResp.ok) {
                throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
            }
            return await fetchResp;
        };

        const nextMonth = document.querySelector('.next-month');
        const prevMonth = document.querySelector('.prev-month');

        if (nextMonth !== undefined) {
            nextMonth.addEventListener('click', function(e) {

                let date = nextMonth.getAttribute('data-date');

                if (date) {
                    const formData = new FormData();
                    formData.append('date', date);

                    bxFetch(window.location, formData)
                        .then(function (response) {
                            if (response.ok && response.status === 200) {
                                return response.text();
                            }
                        })
                        .then((content) => {
                            document.querySelector('.js-calendar').innerHTML = content;
                        })
                        .catch((err) => setError(err));
                }
            });
        }

        if (prevMonth !== undefined) {
            prevMonth.addEventListener('click', function(e) {

                let date = prevMonth.getAttribute('data-date');

                if (date) {
                    const formData = new FormData();
                    formData.append('date', date);

                    bxFetch(window.location, {date: date})
                        .then(function (response) {
                            if (response.ok && response.status === 200) {
                                return response.text();
                            }
                        })
                        .then((content) => {
                            document.querySelector('.js-calendar').innerHTML = content;
                        })
                        .catch((err) => setError(err));
                }

            })
        }

    });
</script>
