<?php

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('BX_CRONTAB', true);
define('BX_NO_ACCELERATOR_RESET', true);

$scheduleIblock = \InfoSystems\Enum\ScheduleCoursesIblock::getId();

/**
 * Если курс окончен меняем статус на Завершен
 */
$obSchedule = CIBlockElement::GetList(
    Array(
        'ID' => 'ASC'
    ),
    Array(
        '=IBLOCK_ID' => \InfoSystems\Enum\ScheduleCoursesIblock::getId(),
        '<DATE_ACTIVE_TO' => new \Bitrix\Main\Type\Date(),
    ),
    false,
    false,
    [
        'ID',
        'IBLOCK_ID'
    ]
);
while ($schedule = $obSchedule->GetNext()) {
    CIBlockElement::SetPropertyValuesEx($schedule['ID'], $schedule['IBLOCK_ID'], ['STATUS' => 'cancel']);
}


/**
 * Если слушателей менее 3 - меняем статус на Отклонен
 */
$date = new \Bitrix\Main\Type\DateTime();
$obSchedule = CIBlockElement::GetList(
    Array(
        'ID' => 'ASC'
    ),
    Array(
        '=IBLOCK_ID' => $scheduleIblock,
        '<=DATE_ACTIVE_FROM' => $date->add('+7 days'),
    ),
    false,
    false,
    [
        'ID',
        'IBLOCK_ID',
        'PROPERTY_LISTENERS'
    ]
);
while ($schedule = $obSchedule->GetNext()) {
    $result[$schedule['ID']][] = $schedule['PROPERTY_LISTENERS_VALUE'];
}
foreach ($result as $elementId => $listeners) {
    $listeners = array_unique($listeners);
    if (count($listeners) < 3) {
        \CIBlockElement::SetPropertyValuesEx($elementId, $scheduleIblock, ['STATUS' => 'reject']);
    }
}
