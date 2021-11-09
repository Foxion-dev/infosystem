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

?>


        <section class="timetable">
            <div class="container">
                <?php if ($arParams['SHOW_TITLE']):?>
                    <div class="timetable__title-block flex-block">
                        <h1 class="timetable__title">Расписание</h1>
                        <div class="timetable__warn flex-block">
                            <img src="/personal/schedule/assets/images/icons/warn-icon.png" alt="">
                            <span class="txt-info">Внимание! Курсы в расписании появляются после полного набора группы!</span>
                        </div>
                    </div>
                <?php endif?>

                <div class="timetable__content calendar-table">

                    <div class="calendar-table__head flex-block">

                        <div class="calendar-table__links-box  flex-block">
                            <a href="<?=$APPLICATION->GetCurPageParam('view=month', ['view'])?>" data-view='M' class="calendar-table__link flex-block<?=!$_REQUEST['view'] || $_REQUEST['view']=='month'?' active':''?>">Месяц</a>
                            <a href="<?=$APPLICATION->GetCurPageParam('view=week', ['view'])?>" data-view='W' class="calendar-table__link flex-block<?=$_REQUEST['view']=='week'?' active':''?>">Неделя</a>
                            <a href="<?=$APPLICATION->GetCurPageParam('view=day', ['view'])?>" data-view='D' class="calendar-table__link flex-block<?=$_REQUEST['view']=='day'?' active':''?>">День</a>
                        </div>

                        <div class="calendar-table__current selection  flex-block">
                            <div class="selection__wrap flex-block js-current-selection<?=!$_REQUEST['view'] || $_REQUEST['view']=='month'?' active':''?>" data-view='M'>
                                <span class="selection__arrow arrow-left js-arrow" data-url="<?=$arResult['PREV_MONTH_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__text extra-bold">
                                    <?=FormatDate('f, Y', strtotime($arResult['currentDate']))?>
                                </span>
                                <span class="selection__arrow arrow-right js-arrow" data-url="<?=$arResult['NEXT_MONTH_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"></use>
                                    </svg>
                                </span>
                            </div>
                            <div class="selection__wrap flex-block js-current-selection<?=$_REQUEST['view']=='week'?' active':''?>" data-view='W'>
                                <span class="selection__arrow arrow-left js-arrow" data-url="<?=$arResult['PREV_WEEK_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__text extra-bold">
                                    <?=date('d.m', strtotime(current($arResult['WEEK_DAYS'])))?> -
                                    <?=date('d.m', strtotime(end($arResult['WEEK_DAYS'])))?>
                                </span>
                                <span class="selection__arrow arrow-right js-arrow" data-url="<?=$arResult['NEXT_WEEK_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__subtext bold">
                                    <?=FormatDate('f Y', strtotime($arResult['currentDate']))?>
                                </span>
                            </div>
                            <div class="selection__wrap flex-block js-current-selection<?=$_REQUEST['view']=='day'?' active':''?>" data-view='D'>
                                <span class="selection__arrow arrow-left js-arrow" data-url="<?=$arResult['PREV_DAY_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__text extra-bold">
                                    <?=FormatDate('f Y', strtotime($arResult['currentDate']))?>
                                </span>
                                <span class="selection__arrow arrow-right js-arrow" data-url="<?=$arResult['NEXT_DAY_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                            </div>
                            <div class="selection__wrap flex-block js-current-selection" data-view='no'>
                                <span class="selection__arrow arrow-left">
                                    <svg>
                                            <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__text extra-bold">
                                    <?=FormatDate('f Y', strtotime($arResult['currentDate']))?>
                                </span>
                                <span class="selection__arrow arrow-right">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="calendar-table__content  flex-block js-tab-view-content<?=!$_REQUEST['view'] || $_REQUEST['view']=='month'?' active':''?>" data-view='M'>
                        <div class="calendar-table__row calendar-table__row--titles">
                            <?php foreach (Calendar::RUS_DAYS as $day):?>
                                <div class="calendar-table__item calendar-table__item--title flex-block">
                                    <?=$day['short']?>
                                </div>
                            <?php endforeach?>
                        </div>
                        <?php foreach ($arResult['MONTH'] as $arMonths):?>
                            <div class="calendar-table__row">
                                <?php foreach ($arMonths as $arMonth):?>
                                    <div class="calendar-table__item<?=$arMonth['type'] == 'other'? ' calendar-table__item--next-mounth':''?>">
                                        <h6 class="calendar-table__item-title"><?=$arMonth['day']?></h6>

                                        <div class="calendar-table__item-content events-list">
                                            <?php foreach ($arMonth['events'] as $keyEvent => $event):?>
                                                <?php if ($keyEvent >= 2):?>
                                                    <div class="events-list__hide-block js-hide-block">
                                                <?php endif?>

                                                <div class="events-list__item flex-block">
                                                    <span class="events-list__item-time">
                                                        <?=date('H:i', strtotime($event['active_from']))?> -
                                                        <?=date('H:i', strtotime($event['active_to']))?>
                                                    </span>
                                                    <a href="<?=$event['url']?>" class="events-list__item-preview js-open-detail">
                                                        <?=TruncateText($event['title'], 25);?>
                                                    </a>

                                                    <div class="events-list__item-detail event-info">
                                                        <span class="event-info__close js-close-detail">+</span>
                                                        <div class="event-info__description">
                                                            <span class="txt-info bold">Курс: </span>
                                                            <span class="txt-info"><?=$event['title']?></span>
                                                        </div>
                                                        <span class="event-info__date bold">
                                                            <?=FormatDate('l, d.m', strtotime($event['active_from']))?> -
                                                            <?=date('H:i', strtotime($event['active_from']))?> -
                                                            <?=date('H:i', strtotime($event['active_to']))?>
                                                        </span>
                                                        <ul class="event-info__dop-info-list">
                                                            <?php if ($event['form']):?>
                                                                <li class="event-info__dop-info-item flex-block">
                                                                    <span class="txt-info">Форма обучения:</span>
                                                                    <span class="txt-info"><?=$event['from']?></span>
                                                                </li>
                                                            <?php endif?>
                                                            <li class="event-info__dop-info-item flex-block">
                                                                <span class="txt-info">Преподаватель:</span>
                                                                <span class="txt-info"><?=$event['teacher']?></span>
                                                            </li>
                                                            <li class="event-info__dop-info-item flex-block">
                                                                <span class="txt-info">Место проведения:</span>
                                                                <span class="txt-info"><?=$event['address']?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php if ($keyEvent >= 2):?>
                                                    </div>
                                                <?php endif?>
                                            <?php endforeach?>

                                            <?php if (count($arMonth['events']) > 2):?>
                                                <div class="events-list__link-more js-open-more">
                                                    <img src="/personal/schedule/assets/images/icons/more.png" alt="">
                                                </div>
                                            <?php endif?>
                                        </div>
                                    </div>
                                <?php endforeach?>
                            </div>
                        <?php endforeach?>
                    </div>
                    <div class="calendar-table__content flex-block js-tab-view-content<?=$_REQUEST['view']=='week'?' active':''?>" data-view='W'>
                        <table class="weeks-table__table weeks-table">
                            <tbody>
                            <tr class="weeks-table__head">
                                <td></td>
                                <?php foreach ($arResult['WEEK_DAYS'] as $date):?>
                                    <th>
                                        <div class="weeks-table__title-wrap">
                                            <span class="weeks-table__day">
                                                <?=FormatDate('D', strtotime($date))?>
                                            </span>
                                            <span class="weeks-table__number">
                                                <?=date('d', strtotime($date))?>
                                            </span>
                                        </div>
                                    </th>
                                <?php endforeach?>

                            </tr>
                            <?php foreach ($arResult['WEEK'] as $arItem):?>
                                <tr class="weeks-table__row">
                                    <th>
                                        <span class="weeks-table__title bold">
                                            <?=$arItem['time']?>
                                        </span>
                                    </th>
                                    <?php foreach ($arItem['events'] as $event):?>
                                        <?php if ($event['continue']):?>
                                        <?php elseif ($event['id']):?>
                                            <td rowspan="<?=$event['duration']?>">
                                                <span class="weeks-table__item txt-info  js-hover-detail-text">
                                                    <div class="events-list__item flex-block ">
                                                        <span class="events-list__item-time">
                                                            <?=date('H:i', strtotime($event['active_from']))?> -
                                                                <?=date('H:i', strtotime($event['active_to']))?>
                                                        </span>
                                                        <span class="events-list__item-preview js-hide-preview">
                                                             <?=TruncateText($event['title'], 25);?>
                                                        </span>
                                                        <span class="events-list__detail-text js-open-detail">
                                                            <?=$event['title']?>
                                                        </span>
                                                        <div class="events-list__item-detail event-info">
                                                            <span class="event-info__close js-close-detail">+</span>
                                                            <div class="event-info__description">
                                                                <span class="txt-info bold">Курс: </span>
                                                                <span class="txt-info"><?=$event['title']?></span>
                                                            </div>
                                                            <span class="event-info__date bold">
                                                                 <?=FormatDate('l, d.m', strtotime($event['active_from']))?> -
                                                                <?=date('H:i', strtotime($event['active_from']))?> -
                                                                <?=date('H:i', strtotime($event['active_to']))?>
                                                            </span>
                                                            <ul class="event-info__dop-info-list">
                                                                <li class="event-info__dop-info-item flex-block">
                                                                    <span class="txt-info">Форма проведения:</span>
                                                                    <span class="txt-info"><?=$event['form']?></span>
                                                                </li>
                                                                <li class="event-info__dop-info-item flex-block">
                                                                    <span class="txt-info">Преподаватель:</span>
                                                                    <span class="txt-info"><?=$event['teacher']?></span>
                                                                </li>
                                                                <li class="event-info__dop-info-item flex-block">
                                                                    <span class="txt-info">Место проведения:</span>
                                                                    <span class="txt-info"><?=$event['address']?></span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
											    </span>
                                            </td>
                                        <?php else:?>
                                            <td><span class="weeks-table__item txt-info"></span></td>
                                        <?php endif?>
                                    <?php endforeach?>
                                </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (!empty($arResult['DAY'])):?>
                        <div class="calendar-table__content flex-block js-tab-view-content<?=$_REQUEST['view']=='day'?' active':''?>" data-view='D'>
                            <table class="day-table">
                                <h5 class="day-table__current-day">
                                    <?=FormatDate('l', strtotime($arResult['currentDate']))?>
                                </h5>
                                <div class="day-table__function-block">
                                    <div class="day-table__arrow-left js-arrow-left">
                                        <svg>
                                            <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                        </svg>
                                    </div>
                                    <div class="day-table__arrow-right active js-arrow-right">
                                        <svg>
                                            <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                        </svg>
                                    </div>
                                </div>
                                <tr class="day-table__head">
                                    <td></td>
                                    <?php foreach (Calendar::TIME as $time):?>
                                        <th>
                                            <span class="day-table__title-head bold">
                                                <?=$time['start']?> - <?=$time['stop']?>
                                            </span>
                                        </th>
                                    <?php endforeach?>
                                </tr>
                                <?php foreach ($arResult['DAY'] as $arItem):?>
                                    <tr  class="day-table__row">
                                        <th>
                                            <a href="<?=$arItem['url']?>" class="day-table__title hover-link">
                                                <?=$arItem['title']?>
                                            </a>
                                        </th>
                                        <?php foreach ($arItem['events'] as $event):?>
                                            <?php if ($event):?>
                                                <td colspan="<?=$event['duration']?>">
                                                    <span class="day-table__item">
                                                        <div class="day-table__item-top">
                                                            <span class="day-table__item-text"><?=$event['address']?></span>
                                                            <span class="day-table__item-text">Аудитория: <?=$event['classroom']?></span>
                                                        </div>
                                                        <div class="day-table__item-bottom">
                                                            <span class="day-table__item-text bold">
                                                                <?=date('H:i', strtotime($event['date_from']))?> -
                                                                <?=date('H:i', strtotime($event['date_to']))?>
                                                            </span>
                                                        </div>
                                                    </span>
                                                </td>
                                            <?php else:?>
                                                <td><span class="day-table__item"></span></td>
                                            <?php endif?>
                                        <?php endforeach?>
                                    </tr>
                                <?php endforeach?>
                                </tbody>
                            </table>
                        </div>
                    <?php else:?>
                        <div class="calendar-table__content flex-block js-tab-view-content <?=$_REQUEST['view']=='day'?' active':''?>" data-view='no'>
                            <div class="calendar-table__no-events no-events flex-block">
                                <h5 class="no-events__current-day">
                                    <?=FormatDate('l', strtotime($arResult['currentDate']))?>
                                </h5>
                                <div class="no-events__icon">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#calendar-icon"></use>
                                    </svg>
                                </div>
                                <div class="no-events__title bold">На текущую дату нет занятий</div>
                            </div>
                        </div>
                    <?php endif?>
                </div>
            </div>
        </section>



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

            document.addEventListener('click', function (e) {

                let arrow =  e.target.closest('.js-arrow');
                if (arrow) {

                    let url = e.target.parentNode.getAttribute('data-url');

                    if (url) {
                        showLoading();

                        bxFetch(url)
                            .then(function (response) {
                                if (response.ok && response.status === 200) {
                                    return response.text();
                                }
                            })
                            .then((content) => {

                                document.querySelector('.js-calendar').innerHTML = content;

                                var DOMContentLoadedEvent = document.createEvent("Event");
                                DOMContentLoadedEvent.initEvent("DOMContentLoaded", true, true);
                                window.document.dispatchEvent(DOMContentLoadedEvent);

                                hideLoading();
                            })
                            .catch((err) => setError(err));
                    }

                }
            });


        });
    </script>

