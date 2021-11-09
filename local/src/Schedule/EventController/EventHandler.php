<?php

namespace InfoSystems\Schedule\EventController;

use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\SystemException;
use InfoSystems\Enum\ScheduleCoursesIblock;

class EventHandler extends \InfoSystems\App\EventHandling\AbstractEventHandler
{
    /**
     * @param EventManager $eventManager
     * @return void
     */
    public static function initHandlers(EventManager $eventManager): void
    {
        parent::initHandlers($eventManager);

        $module = 'iblock';
        static::initHandler(
            'OnBeforeIBlockElementUpdate',
            [
                static::class,
                'setCourseCode',
            ],
            $module
        );
    }

    /**
     * @param array $fields
     * @return bool
     */
    protected static function isScheduleCoursesIblock(array $fields): bool
    {
        $result = true;
        try {
            $result = $result && (int)$fields['IBLOCK_ID'] === ScheduleCoursesIblock::getId();
        } catch (\Throwable $throwable) {
        }

        return $result;
    }

    /**
     * @param array $fields
     */
    public static function setCourseCode($fields): void
    {
        if (\is_array($fields) && static::isScheduleCoursesIblock($fields)) {

        }
    }

    /**
     * @param $fields
     */
    public static function checkDate($fields): void
    {

    }
}
