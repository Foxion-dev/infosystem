<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

?>

<section class="timetable">
    <div class="container">

        <div class="timetable__title-block flex-block">
            <h1 class="timetable__title">Курс: <?=$arResult['ELEMENT']['NAME']?></h1>
        </div>

        <div class="timetable__course-info course-info flex-block">
            <div class="course-info__column course-info__column--left info-list">
                <?php if ($arResult['ELEMENT']['PROPERTIES']['DATE']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Даты проведения:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text txt-info">
                                <?=date('d.m', strtotime(current($arResult['ELEMENT']['PROPERTIES']['DATE']['VALUE'])))?> -
                                <?=date('d.m', strtotime(end($arResult['ELEMENT']['PROPERTIES']['DATE']['VALUE'])))?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['COURSE_FORM']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Форма проведения:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text txt-info">
                                <?=$arResult['ELEMENT']['PROPERTIES']['COURSE_FORM']['VALUE']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['COURSE_VOLUME']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Продолжительность курса:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text txt-info">
                                <?=$arResult['ELEMENT']['PROPERTIES']['COURSE_VOLUME']['VALUE']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['TEACHERS']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Преподаватель:</div>
                        <div class="info-list__item-info">
                            <?php foreach ($arResult['ELEMENT']['PROPERTIES']['TEACHERS']['VALUE'] as $teacher):?>
                                <a href="<?=$teacher['DETAIL_PAGE_URL']?>" class="info-list__item-link default-link txt-info">
                                    <?=$teacher['NAME']?>
                                </a>
                            <?php endforeach?>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['LOCATION']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Место проведения:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text txt-info">
                                <?=$arResult['ELEMENT']['PROPERTIES']['LOCATION']['VALUE']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['NAME']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Аудитория:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text txt-info">
                                <?=$arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['NAME']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['PROPERTIES']['SEAT']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Рабочие места:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text ellipse-bg ellipse-bg--green">
                                <?=$arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['PROPERTIES']['SEAT']['VALUE']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['PROPERTIES']['SEAT_PC']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Рабочие места с ПК:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text ellipse-bg ellipse-bg--red">
                                <?=$arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['PROPERTIES']['SEAT_PC']['VALUE']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['PROPERTIES']['REQUIREMENTS']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Требование к рабочему месту:</div>
                        <div class="info-list__item-info">
                            <?php foreach ($arResult['ELEMENT']['PROPERTIES']['CLASSROOM']['VALUE']['PROPERTIES']['REQUIREMENTS']['VALUE'] as $requirement):?>
                                <span class="info-list__item-text"> — <?=$requirement?></span>
                            <?php endforeach?>
                        </div>
                    </div>
                <?php endif?>
                <?php if ($arResult['ELEMENT']['PROPERTIES']['RESPONSIBLE']['VALUE']):?>
                    <div class="info-list__item flex-block">
                        <div class="info-list__item-title bold">Куратор курса:</div>
                        <div class="info-list__item-info">
                            <span class="info-list__item-text">
                                <?=$arResult['ELEMENT']['PROPERTIES']['RESPONSIBLE']['VALUE']['LAST_NAME']?>
                                <?=$arResult['ELEMENT']['PROPERTIES']['RESPONSIBLE']['VALUE']['NAME']?>
                            </span>
                            <span class="info-list__item-text">
                                <?=$arResult['ELEMENT']['PROPERTIES']['RESPONSIBLE']['VALUE']['PROPERTIES']['PHONES']['VALUE']?>
                            </span>
                            <span class="info-list__item-text">
                                <?=$arResult['ELEMENT']['PROPERTIES']['RESPONSIBLE']['VALUE']['PROPERTIES']['POST_MAIL']['VALUE']?>
                            </span>
                        </div>
                    </div>
                <?php endif?>
            </div>
            <?php if ($arResult['ELEMENT']['PROPERTIES']['LISTENERS']['VALUE']):?>
                <div class="course-info__column user-list">
                    <div class="user-list__title-block flex-block">
                        <h3 class="user-list__title bold">Количество слушателей: </h3>
                        <span class="user-list__title-count bold">
                            <?=count($arResult['ELEMENT']['PROPERTIES']['LISTENERS']['VALUE'])?>
                        </span>
                    </div>
                    <div class="user-list__title-block flex-block">
                        <h3 class="user-list__title bold">Дистанционных слушателей: </h3>
                        <span class="user-list__title-count bold">
                            <?=count(array_filter($arResult['ELEMENT']['PROPERTIES']['LISTENERS']['VALUE'], function ($listener) {
                                return $listener['UF_ONLINE'];
                            }))?>
                        </span>
                    </div>
                    <div class="user-list__list">
                        <?php foreach ($arResult['ELEMENT']['PROPERTIES']['LISTENERS']['VALUE'] as $keyListener => $arListener):?>
                            <?php if ($keyListener >= 14):?>
                                <div class="user-list__hide-list">
                            <?php endif?>
                            <a href="##" style='display:block;'class="user-list__item hover-link<?=$arListener['UF_ONLINE']?' user-list__item--online':''?>">
                                <?=$arListener['LAST_NAME']?>
                                <?=$arListener['NAME']?>
                                <?=$arListener['SECOND_NAME']?>
                            </a>
                            <?php if ($keyListener >= 14):?>
                                </div>
                                <div class="user-list__more default-link js-more-users">Все слушатели</div>
                            <?php endif?>
                        <?php endforeach?>
                    </div>
                </div>
            <?php endif?>
        </div>
    </div>
</section>


