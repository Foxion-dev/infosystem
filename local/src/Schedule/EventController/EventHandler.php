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
        static::initHandler(
            'OnBeforeIBlockElementUpdate',
            [
                static::class,
                'setNewScheduleElement',
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
    /**
     * @param $fields
     */
    public static function setNewScheduleElement($fields): void
    {
        global $USER;

        if(static::isScheduleCoursesIblock($fields)){

            $courseName = $fields["NAME"];
            $courseID = $fields["ID"];
            $scheduleItems = array();
            $scheduleItemsIblockId = 56;

            foreach($fields["PROPERTY_VALUES"][273] as $scheduleItem){

                if($scheduleItem["VALUE"]['DATETIME_FROM'] && $scheduleItem["VALUE"]['DATETIME_TO']){

                    $scheduleItems[] = array(
                        'NAME'   => $courseName,
                        'COURSE' => $courseID,
                        'DATE_FROM' => $scheduleItem["VALUE"]['DATETIME_FROM'],
                        'DATE_TO' => $scheduleItem["VALUE"]['DATETIME_TO']
                    );
                }
            }

            foreach($scheduleItems as $item){

                $countDbItems = \Bitrix\Iblock\ElementTable::getList(array(
                    'select' => array('ID', 'NAME', 'IBLOCK_ID','ACTIVE_FROM', 'ACTIVE_TO'), // выбираемые поля, без свойств. Свойства можно получать на старом ядре \CIBlockElement::getProperty
                    'filter' => array('IBLOCK_ID' => $scheduleItemsIblockId, 'NAME' => $item['NAME'], 'ACTIVE_FROM'=> $item['DATE_FROM'], 'ACTIVE_TO'=> $item['DATE_TO']), // фильтр только по полям элемента, свойства (PROPERTY) использовать нельзя
                    'count_total' => 1
                ))->getCount();
                
                if($countDbItems === 0){
                    $el = new \CIBlockElement;

                    $fields = array(
                        "ACTIVE"            => "Y",
                        "MODIFIED_BY"       => $USER->GetID(),
                        "IBLOCK_ID"         => $scheduleItemsIblockId,
                        "IBLOCK_SECTION_ID" => false,         
                        "NAME"              => $item['NAME'],
                        'ACTIVE_FROM'       => $item['DATE_FROM'],
                        'ACTIVE_TO'         => $item['DATE_TO'],
                        "PROPERTY_VALUES"   => array('COURSE' => array('VALUE' => $item['COURSE']))
                    );

                    if($PRODUCT_ID = $el->Add($fields)){
                        \Bitrix\Main\Diag\Debug::dumpToFile(['time'=>date('H:i:s'), 'fields'=>$PRODUCT_ID ],"","__log.log"); 
                    }else{
                        \Bitrix\Main\Diag\Debug::dumpToFile(['time'=>date('H:i:s'), 'fields'=>$el->LAST_ERROR ],"","__log.log");
                    }
                }

            }
        }
    }
}
