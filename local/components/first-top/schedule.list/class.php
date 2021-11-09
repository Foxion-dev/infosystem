<?php
//use Bitrix\Main\Type\DateTime;
use InfoSystems\App\Component\BaseComponentAbstract;
use InfoSystems\Enum\ScheduleCoursesIblock;
use InfoSystems\Entity\ScheduleStatusesTable;
use InfoSystems\Schedule\Calendar;
use DateTime;

class ScheduleListComponent extends BaseComponentAbstract
{
    /**
     * ScheduleDetailComponent constructor.
     * @param CBitrixComponent|null $parentComponent
     */
    public function __construct(?CBitrixComponent $parentComponent = null)
    {
        global $APPLICATION, $USER;

        if (!$USER->IsAuthorized()) {
            $APPLICATION->AuthForm('', false, false, 'N', false);

            return false;
        }

        parent::__construct($parentComponent);
    }

    /**
     * @param array $params
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        $params = parent::onPrepareComponentParams($params);

        return $params;
    }

    /**
    * @return string
    */
    protected function getComponentDir(): string
    {
        return __DIR__;
    }

    protected function componentBody(): void
    {
        global $APPLICATION, $DB;

        $result =& $this->arResult;
        $params =& $this->arParams;

        $params["MONTH_URL"]=trim($params["MONTH_URL"]);
        if ($params["MONTH_URL"] == '') {
            $params["MONTH_URL"] = $APPLICATION->GetCurPageParam("year=#YEAR#&month=#MONTH#&view=month", ['month', 'year', 'view']);
        }

        $params['WEEK_URL'] = trim($params['WEEK_URL']);
        if ($params['WEEK_URL'] == '') {
            $params['WEEK_URL'] = $APPLICATION->GetCurPageParam('year=#YEAR#&month=#MONTH#&day=#DAY#&view=week', ['year', 'month', 'day', 'view']);
        }

        $params['DAY_URL'] = trim($params['DAY_URL']);
        if ($params['DAY_URL'] == '') {
            $params['DAY_URL'] = $APPLICATION->GetCurPageParam('year=#YEAR#&month=#MONTH#&day=#DAY#&view=day', ['year', 'month', 'day', 'view']);
        }


        $today = time();

        $currentDay = intval($_REQUEST['day']);
        if ($currentDay < 1) {
            $currentDay = intval(date('d', $today));
        }

        $currentMonth = intval($_REQUEST['month']);
        if ($currentMonth < 1 || $currentMonth > 12) {
            $currentMonth = intval(date('n', $today));
        }

        $currentYear = intval($_REQUEST['year']);
        if ($currentYear < 1) {
            $currentYear = intval(date('Y', $today));
        }

        $result['currentDate'] = date('d.m.Y', mktime(0,0,0,$currentMonth, $currentDay, $currentYear));

        $todayYear  = intval(date('Y', $today));
        $todayMonth = intval(date('n', $today));
        $todayDay   = intval(date('j', $today));

        /** Предыдущий день */
        $result['PREV_DAY_URL'] = htmlspecialcharsbx(str_replace(
            ['#YEAR#','#MONTH#','#DAY#'],
            [
                date('Y', mktime(0,0,0,$currentMonth, $currentDay-1, $currentYear)),
                date('m', mktime(0,0,0,$currentMonth, $currentDay-1, $currentYear)),
                date('d', mktime(0,0,0,$currentMonth, $currentDay-1, $currentYear)),
            ],
            $params["DAY_URL"]
        ));

        /** Следующий день */
        $result['NEXT_DAY_URL'] = htmlspecialcharsbx(str_replace(
            ['#YEAR#','#MONTH#','#DAY#'],
            [
                date('Y', mktime(0,0,0,$currentMonth, $currentDay+1, $currentYear)),
                date('m', mktime(0,0,0,$currentMonth, $currentDay+1, $currentYear)),
                date('d', mktime(0,0,0,$currentMonth, $currentDay+1, $currentYear)),
            ],
            $params['DAY_URL']
        ));

        /** Предыдущая неделя */
        $result['PREV_WEEK_URL'] = htmlspecialcharsbx(str_replace(
            ['#YEAR#','#MONTH#','#DAY#'],
            [
                date("Y", mktime(0,0,0,$currentMonth, $currentDay-7, $currentYear)),
                date("m", mktime(0,0,0,$currentMonth, $currentDay-7, $currentYear)),
                date('d', mktime(0,0,0,$currentMonth, $currentDay-7, $currentYear)),
            ],
            $params['WEEK_URL']
        ));

        /** Следующая неделя */
        $result['NEXT_WEEK_URL'] = htmlspecialcharsbx(str_replace(
            ['#YEAR#','#MONTH#','#DAY#'],
            [
                date('Y', mktime(0,0,0,$currentMonth, $currentDay+7, $currentYear)),
                date('m', mktime(0,0,0,$currentMonth, $currentDay+7, $currentYear)),
                date('d', mktime(0,0,0,$currentMonth, $currentDay+7, $currentYear)),
            ],
            $params['WEEK_URL']
        ));

        /** Предыдущий месяц */
        $result['PREV_MONTH_URL'] = htmlspecialcharsbx(str_replace(
            ['#YEAR#','#MONTH#'],
            [
                date('Y', mktime(0,0,0,$currentMonth-1, 1, $currentYear)),
                date('m', mktime(0,0,0,$currentMonth-1, 1, $currentYear))
            ],
            $params['MONTH_URL']
        ));

        /** Следующий месяц */
        $result['NEXT_MONTH_URL'] = htmlspecialcharsbx(str_replace(
            ['#YEAR#','#MONTH#'],
            [
                date('Y', mktime(0,0,0,$currentMonth+1, 1, $currentYear)),
                date('m', mktime(0,0,0,$currentMonth+1, 1, $currentYear))
            ],
            $params['MONTH_URL']
        ));

        $date = mktime(0, 0, 0, $currentMonth, 1, $currentYear);

        /** @var $monthStart - Порядковый номер дня недели */
        $monthStart =  date("w", $date) - 1;

        if ($monthStart < 0) {
            $monthStart += 7;
        }

        CModule::IncludeModule("iblock");

        global $USER;

        $dbItems = CIBlockElement::GetList(array(), array(['PROPERTY_LISTENERS' => $USER->GetID()]), false, false, array('ID', 'IBLOCK_ID', 'PROPERTY_LISTENERS'));
        $courses = [];
        while($arItem = $dbItems->GetNext())
        {
            $courses[] = $arItem['ID'];
        }


        $arFilter = Array(
            "ACTIVE" => "Y",
            ">=DATE_ACTIVE_FROM" => date('d.m.Y H:i:s', mktime(0,0,0,$currentMonth-1,1,$currentYear)),
            "<=DATE_ACTIVE_FROM"  => date('d.m.Y H:i:s', mktime(23,59,59,$currentMonth+1,1,$currentYear)),
            "IBLOCK_ID" => 56,
            'PROPERTY_COURSE' => $courses
        );

        $arSelectedFields = Array("ACTIVE", "ACTIVE_FROM", "ACTIVE_TO", "ID", "IBLOCK_ID", "SITE_ID", "DETAIL_PAGE_URL", "NAME", "LANG_DIR", "SORT", "IBLOCK_TYPE", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", 'PROPERTY_COURSE');

        $dbItems = CIBlockElement::GetList(array("ACTIVE_FROM"=>"ASC", "ID"=>"ASC"), $arFilter, false, false, $arSelectedFields);

        $arDays = [];

        while($arItem = $dbItems->GetNext())
        {
            if ($arItem['PROPERTY_COURSE_VALUE']) {
                $arItem['COURSE'] = \InfoSystems\Tools\IblockTools::getElement($arItem['PROPERTY_COURSE_VALUE']);

                $arDays[ConvertDateTime($arItem["ACTIVE_FROM"], CLang::GetDateFormat("SHORT"))][] = $arItem;
            }
        }
        if (!$courses) {
            //$arDays = [];
        }

        $result["MONTH"] = [];
        $bBreak = false;
        for ($i = 0; $i < 6; $i++)
        {
            $arWeek = array();
            $row = $i * 7;
            for ($j = 0; $j < 7; $j++)
            {
                $arDay = array();

                $date = mktime(0, 0, 0, $currentMonth, (1 + $row + $j) - $monthStart, $currentYear);
                $y = intval(date("Y", $date));
                $m = intval(date("n", $date));
                $d = intval(date("j", $date));
                $itm = date("w", $date);

                if ($i > 0 && $j == 0 && $currentMonth != $m)
                {
                    $bBreak = true;
                    break;
                }

                if ($d == $todayDay && $m == $todayMonth && $y == $todayYear && !$bBreak) {
                    $defaultType = 'today';
                }
                elseif ($currentMonth != $m)
                {
                    $defaultType = 'other';
                }
                elseif ($itm == 0 || $itm == 6) {
                    $defaultType = 'weekend';
                }
                else {
                    $defaultType = 'default';
                }

                $arDay['day'] = $d;
                $arDay['date'] = date("d.m.Y", $date);
                $arDay['type'] = $defaultType;
                $arDay['events'] = [];

                $tmpDate = date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,$m,$d,$y));

                foreach($arDays[$tmpDate] as $dayNews)
                {
                    $arDay['events'][] = array(
                        'id' => $dayNews['ID'],
                        'active_from' => $dayNews['ACTIVE_FROM'],
                        'active_to' => $dayNews['ACTIVE_TO'],
                        'duration' =>(new DateTime($dayNews['ACTIVE_TO']))->diff(new DateTime($dayNews['ACTIVE_FROM']))->format('%h'),
                        'url' => $dayNews['COURSE']['DETAIL_PAGE_URL'],
                        'title' => $dayNews['NAME'],
                        'form' => $dayNews['COURSE']['PROPERTIES']['COURSE_FORM']['VALUE'],
                        'teachers' => $dayNews['COURSE']['PROPERTIES']['TEACHERS']['VALUE'],
                        'course' => $dayNews['COURSE']['PROPERTIES']['COURSE']['VALUE']
                    );
                }

                $arWeek[]=$arDay;
            }
            if ($bBreak) {
                break;
            }

            $result["MONTH"][]=$arWeek;
        }


        $week = date('W', strtotime($currentYear.'-'.$currentMonth.'-'.$currentDay)) - date('W', strtotime($currentYear.'-'.$currentMonth.'-01')) + 1;


        $result['WEEK'] = $result['MONTH'][$week-1];
        $result['WEEK_DAYS'] = array_column($result['WEEK'], 'date');
        if ($result['WEEK']) {
            $this->prepareDataForWeek();
        }


        $arFilter = Array(
            "ACTIVE" => "Y",
            ">=DATE_ACTIVE_FROM" => date('d.m.Y H:i:s', mktime(0,0,0,$currentMonth,$currentDay,$currentYear)),
            "<=DATE_ACTIVE_FROM" => date('d.m.Y H:i:s', mktime(23,59,59,$currentMonth,$currentDay,$currentYear)),
        );
        $arSelectedFields = Array("ACTIVE", "ACTIVE_FROM", "ACTIVE_TO", "ID", "IBLOCK_ID", "SITE_ID", "DETAIL_PAGE_URL", "NAME", "LANG_DIR", "SORT", "IBLOCK_TYPE", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", 'PROPERTY_COURSE');

        $dbItems = CIBlockElement::GetList(array("ACTIVE_FROM"=>"ASC", "ID"=>"ASC"), $arFilter, false, false, $arSelectedFields);
        while($arItem = $dbItems->GetNext())
        {
            if ($arItem['PROPERTY_COURSE_VALUE']) {
                $arItem['COURSE'] = \InfoSystems\Tools\IblockTools::getElement($arItem['PROPERTY_COURSE_VALUE']);

                $result['DAY'][$arItem['PROPERTY_COURSE_VALUE']]['title'] = $arItem['COURSE']['NAME'];
                $result['DAY'][$arItem['PROPERTY_COURSE_VALUE']]['url'] = $arItem['COURSE']['DETAIL_PAGE_URL'];

                $timeFrom = date('H:i', strtotime($arItem['ACTIVE_FROM']));

                $result['DAY'][$arItem['PROPERTY_COURSE_VALUE']]['events'][$timeFrom] = [
                    'date_from' => $arItem['ACTIVE_FROM'],
                    'date_to'   => $arItem['ACTIVE_TO'],
                    'date' => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,$currentMonth,$currentDay,$currentYear))
                ];
            }
        }

        if ($result['DAY']) {
            $this->prepareDataForDay();
        }
    }

    public function prepareDataForWeek()
    {
        $result =& $this->arResult;

        $weekResult = [];
        foreach (Calendar::TIME as $key=>$time) {
            $weekResult[$key] = ['time' => $time['start']];
            foreach ($result['WEEK'] as $keyItem=>$arItem) {
                $weekResult[$key]['events'][$keyItem] = [];
                foreach ($arItem['events'] as $event) {
                    if ($time['start'] == date('H:i', strtotime($event['active_from']))) {
                        $weekResult[$key]['events'][$keyItem]= $event;
                    }
                }
            }
        }
        foreach ($weekResult as $keyItem => &$arItem) {
            foreach ($arItem['events'] as $keyEvent => &$event) {
                if (!empty($event) && $event['duration'] > 1) {
                    for ($i = 1; $i < $event['duration']; $i++) {
                        $weekResult[$keyItem+$i]['events'][$keyEvent]['continue'] = true;
                    }
                }
            }
        }
        $result['WEEK'] = $weekResult;
    }

    public function prepareDataForDay()
    {
        $result =& $this->arResult;

        foreach ($result['DAY'] as &$arItem) {
            $events = [];

            foreach (Calendar::TIME as $key => $time) {
                $event = $arItem['events'][$time['start']];
                if (!isset($event)) {
                    $events[$key] = [];
                } else {
                    $events[$key] = $event;
                }
            }

            $arItem['events'] = $events;
        }

        foreach ($result['DAY'] as &$arItem) {
            foreach ($arItem['events'] as $key => &$event) {

                if (empty($event)) {
                    continue;
                }

                $dateFrom = new DateTime($arItem['date_from']);
                $dateTo = new DateTime($arItem['date_to']);

                $duration = $dateTo->diff($dateFrom)->format('%h');
                $event['duration'] = $duration;

                for ($i = $key; $i < $duration; $i++) {
                    $arItem['events'][$i+1]['continue'] = true;
                }
            }
        }
    }
}
