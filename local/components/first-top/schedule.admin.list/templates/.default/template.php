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
                                    <?=date('d.m', strtotime($arResult['WEEK_DAYS'][0]))?> -
                                    <?=date('d.m', strtotime($arResult['WEEK_DAYS'][6]))?>
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
                                    <?=FormatDate('d F, Y', strtotime($arResult['currentDate']))?>
                                </span>
                                <span class="selection__arrow arrow-right js-arrow" data-url="<?=$arResult['NEXT_DAY_URL']?>">
                                    <svg>
                                        <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                            </div>
                            <div class="selection__wrap flex-block js-current-selection" data-view='no'>
                                <span class="selection__arrow arrow-left js-arrow" data-url="<?=$arResult['PREV_DAY_URL']?>">
                                    <svg>
                                            <use xlink:href="/personal/schedule/assets/images/sprite.svg#arrow"> </use>
                                    </svg>
                                </span>
                                <span class="selection__text extra-bold">
                                    <?=FormatDate('f Y', strtotime($arResult['currentDate']))?>
                                </span>
                                <span class="selection__arrow arrow-right js-arrow" data-url="<?=$arResult['NEXT_WEEK_URL']?>">
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
                                                    <div class="events-list__time-block flex-block">
                                                        <span class="events-list__item-time">
                                                            <?=date('H:i', strtotime($event['active_from']))?> -
                                                            <?=date('H:i', strtotime($event['active_to']))?>
                                                        </span>
                                                        <span class="icon-circle icon-circle--<?=$event['color']?>"></span>
                                                    </div>
                                                    <span class="events-list__item-preview js-open-detail">
                                                        <a href="<?=$event['url']?>" class="txt-info hover-link">
                                                            <?=$event['code']?>
                                                        </a>
                                                    </span>

                                                    <div class="events-list__item-detail event-info event-info--admin">

                                                        <div class="event-info__head flex-block">
                                                            <div class="event-info__code  flex-block">
                                                                <span class="event-info__code-text"><?=$event['code']?></span>
                                                                <span class="icon-circle icon-circle--<?=$event['color']?>"></span>
                                                            </div>
                                                            <span class="event-info__close js-close-detail">+</span>
                                                        </div>
                                                        <div class="event-info__description">
                                                            <span class="txt-info bold">Курс: </span>
                                                            <a href="<?=$event['url']?>" class="txt-info hover-link">
                                                                <?=$event['title']?>
                                                            </a>
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
                                                                <span class="txt-info"><?=implode($event['teachers'], 'NAME')?></span>
                                                            </li>
                                                            <li class="event-info__dop-info-item flex-block">
                                                                <span class="txt-info">Место проведения:</span>
                                                                <span class="txt-info"><?=$event['address']?></span>
                                                            </li>
                                                            <li class="event-info__dop-info-item flex-block">
                                                                <span class="txt-info">Аудитория:</span>
                                                                <span class="txt-info"><?=$event['room']?></span>
                                                            </li>
                                                            <li class="event-info__dop-info-item flex-block">
                                                                <span class="txt-info">Количество сделок:</span>
                                                                <span class="txt-info"><?=$event['deal']?></span>
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

                        <div class="calendar-table__description-box flex-block">
                            <?php foreach ($arResult['STATUSES'] as $arStatus):?>
                                <div class="calendar-table__description-item  flex-block">
                                    <span class="calendar-table__description-icon icon-circle icon-circle--<?=$arStatus['UF_COLOR']?>"></span>
                                    <span class="calendar-table__description-text bold">Статус курса «<?=$arStatus['UF_NAME']?>»</span>
                                </div>
                            <?php endforeach?>
                        </div>
                    </div>
                    <div class="calendar-table__content flex-block js-tab-view-content<?=$_REQUEST['view']=='week'?' active':''?>" data-view='W'>
                        <table class="weeks-table__table weeks-table weeks-table--admin">
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
                                        <span class="weeks-table__title">
                                            <?=$arItem['classroom']?>
                                        </span>
                                    </th>
                                    <?php foreach ($arItem['days'] as $day):?>
                                            <?php if ($day):?>
                                                <td>
                                                    <?php foreach ($day as $event):?>
                                                        <span class="weeks-table__item txt-info  js-hover-detail-text">
                                                            <div class="events-list__item flex-block ">
                                                                <span class="events-list__item-preview js-open-detail flex-block">
                                                                    <span><a href="<?=$event['url']?>"><?=$event['code']?></a></span>
                                                                    <span class="events-list__-icon icon-circle icon-circle--<?=$event['color']?>"></span>
                                                                </span>
                                                                <div class="events-list__item-detail event-info event-info--admin">
                                                                    <div class="event-info__head flex-block">
                                                                        <div class="event-info__code  flex-block">
                                                                            <span class="event-info__code-text"><?=$event['code']?></span>
                                                                            <span class="icon-circle icon-circle--<?=$event['color']?>"></span>
                                                                        </div>
                                                                        <span class="event-info__close js-close-detail">+</span>
                                                                    </div>
                                                                    <div class="event-info__description">
                                                                        <span class="txt-info bold">Курс: </span>
                                                                        <a href="<?=$event['url']?>" class="txt-info hover-link">
                                                                             <?=$event['title']?>
                                                                        </a>
                                                                    </div>
                                                                    <span class="event-info__date bold">
                                                                        <?=date('H:i', strtotime($event['date_from']))?> -
                                                                        <?=date('H:i', strtotime($event['date_to']))?>
                                                                    </span>
                                                                    <ul class="event-info__dop-info-list">
                                                                        <li class="event-info__dop-info-item flex-block">
                                                                            <span class="txt-info">Форма проведения:</span>
                                                                            <span class="txt-info"><?=$event['form']?></span>
                                                                        </li>
                                                                        <li class="event-info__dop-info-item flex-block">
                                                                            <span class="txt-info">Преподаватель:</span>
                                                                            <span class="txt-info">
                                                                                <?=implode(', ', $event['teacher'])?>
                                                                            </span>
                                                                        </li>
                                                                        <li class="event-info__dop-info-item flex-block">
                                                                            <span class="txt-info">Место проведения:</span>
                                                                            <span class="txt-info"><?=$event['address']?></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </span>
                                                    <?php endforeach?>
                                                </td>
                                            <?php else:?>
                                                <td><span class="weeks-table__item txt-info"></span></td>
                                            <?php endif?>
                                    <?php endforeach?>
                                </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                        <div class="calendar-table__description-box flex-block">
                            <?php foreach ($arResult['STATUSES'] as $arStatus):?>
                                <div class="calendar-table__description-item  flex-block">
                                    <span class="calendar-table__description-icon icon-circle icon-circle--<?=$arStatus['UF_COLOR']?>"></span>
                                    <span class="calendar-table__description-text bold">Статус курса «<?=$arStatus['UF_NAME']?>»</span>
                                </div>
                            <?php endforeach?>
                        </div>
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
                                    <?php foreach (Calendar::getTimes() as $arTime):?>
                                        <th colspan="<?=count($arTime)?>">
                                            <span class="day-table__title-head bold">
                                                <?=current($arTime)['start']?> - <?=end($arTime)['stop']?>
                                            </span>
                                        </th>
                                    <?php endforeach?>
                                </tr>
                                <?php foreach ($arResult['DAY'] as $arItem):?>
                                    <tr  class="day-table__row">
                                        <th>
                                            <span class="day-table__title">Аудитория <?=$arItem['classroom']?></span>
                                        </th>
                                        <?php foreach ($arItem['events'] as $event):?>
                                            <?php if ($event):?>
                                                <td colspan="<?=$event['duration']?>">
                                                    <span class="txt-info js-hover-detail-text">
                                                        <span class="events-list__item day-table__item flex-block">
                                                            <div class="day-table__item-top">
                                                                <span class="day-table__item-text flex-block">
                                                                    <span class="bold">
                                                                        <a href="<?=$event['url']?>"><?=$arItem['code']?></a>
                                                                    </span>
                                                                    <span class="day-table__description-icon icon-circle icon-circle--<?=$arItem['color']?>"></span>
                                                                </span>
                                                                <a href="<?=$arItem['url']?>" class="day-table__item-text hover-link js-open-detail flex-block">
                                                                     <?=$arItem['title']?>
                                                                </a>
                                                            </div>
                                                            <div class="day-table__item-bottom">
                                                                <span class="day-table__item-text bold">
                                                                    <?=date('H:i', strtotime($event['date_from']))?> -
                                                                    <?=date('H:i', strtotime($event['date_to']))?>
                                                                </span>
                                                            </div>
                                                            <div class="events-list__item-detail event-info event-info--admin">
                                                                    <div class="event-info__head flex-block">
                                                                        <div class="event-info__code  flex-block">
                                                                            <span class="event-info__code-text"><?=$arItem['code']?></span>
                                                                            <span class="icon-circle icon-circle--<?=$arItem['color']?>"></span>
                                                                        </div>
                                                                        <span class="event-info__close js-close-detail">+</span>
                                                                    </div>
                                                                    <div class="event-info__description">
                                                                        <span class="txt-info bold">Курс: </span>
                                                                        <a href="<?=$arItem['url']?>" class="txt-info hover-link">
                                                                             <?=$arItem['title']?>
                                                                        </a>
                                                                    </div>
                                                                    <span class="event-info__date bold">
                                                                        <?=date('H:i', strtotime($event['date_from']))?> -
                                                                        <?=date('H:i', strtotime($event['date_to']))?>
                                                                    </span>
                                                                    <ul class="event-info__dop-info-list">
                                                                        <li class="event-info__dop-info-item flex-block">
                                                                            <span class="txt-info">Форма проведения:</span>
                                                                            <span class="txt-info"><?=$arItem['form']?></span>
                                                                        </li>
                                                                        <li class="event-info__dop-info-item flex-block">
                                                                            <span class="txt-info">Преподаватель:</span>
                                                                            <span class="txt-info">
                                                                                <?=implode(', ', $arItem['teacher'])?>
                                                                            </span>
                                                                        </li>
                                                                        <li class="event-info__dop-info-item flex-block">
                                                                            <span class="txt-info">Место проведения:</span>
                                                                            <span class="txt-info"><?=$arItem['address']?></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                        </span>
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
                            <div class="calendar-table__description-box flex-block">
                                <?php foreach ($arResult['STATUSES'] as $arStatus):?>
                                    <div class="calendar-table__description-item  flex-block">
                                        <span class="calendar-table__description-icon icon-circle icon-circle--<?=$arStatus['UF_COLOR']?>"></span>
                                        <span class="calendar-table__description-text bold">Статус курса «<?=$arStatus['UF_NAME']?>»</span>
                                    </div>
                                <?php endforeach?>
                            </div>
                        </div>
                    <?php else:?>
                        <div class="day-table calendar-table__content flex-block js-tab-view-content <?=$_REQUEST['view']=='day'?' active':''?>" data-view='no'>
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
    <style>
        body.timetable-page .event-info.open {
            z-index: 4;
        }
        body.timetable-page .timetable {
            overflow-x: inherit;
        }

        body.timetable-page .hover-link {
            text-decoration: underline;
            color: #81c212;
        }

        body.timetable-page .day-table td span.event-info__code-text {
            width: auto;
        }
        body.timetable-page .day-table__item .event-info {
            left: -410px;
        }
        body.timetable-page .day-table td span.event-info__close {
            width: 36px;
        }
    </style>

