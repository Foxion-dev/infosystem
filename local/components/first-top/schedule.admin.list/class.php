<?php
//use Bitrix\Main\Type\DateTime;
use InfoSystems\App\Component\BaseComponentAbstract;
use InfoSystems\Enum\ScheduleCoursesIblock;
use InfoSystems\Entity\ScheduleStatusesTable;
use InfoSystems\Schedule\Calendar;
use DateTime;

class ScheduleAdminListComponent extends BaseComponentAbstract
{
    /**
     * ScheduleDetailComponent constructor.
     * @param CBitrixComponent|null $parentComponent
     */
    public function __construct(?CBitrixComponent $parentComponent = null)
    {
        global $APPLICATION, $USER;

        $result = \Bitrix\Main\UserGroupTable::getList(array(
            'filter' => [
                'USER_ID' => $GLOBALS["USER"]->GetID(),
                'GROUP.ID' => [1, 8, 9, 10]
            ]
        ))->fetchAll();

        if (!$result) {
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

        $result['STATUSES'] = $this->getStatuses();

        CModule::IncludeModule("iblock");

        $arFilter = Array(
            "ACTIVE" => "Y",
            ">=DATE_ACTIVE_FROM" => date('d.m.Y H:i:s', mktime(0,0,0,$currentMonth-1,1,$currentYear)),
            "<=DATE_ACTIVE_FROM"  => date('d.m.Y H:i:s', mktime(23,59,59,$currentMonth+1,1,$currentYear)),
            "IBLOCK_ID" => 56
        );

        $arSelectedFields = Array(
            "ACTIVE",
            "ACTIVE_FROM",
            "ACTIVE_TO",
            "ID",
            "IBLOCK_ID",
            "DETAIL_PAGE_URL", "NAME",
            "IBLOCK_TYPE",
            'PROPERTY_COURSE',
        );

        $dbItems = CIBlockElement::GetList(array("ACTIVE_FROM"=>"ASC", "ID"=>"ASC"), $arFilter, false, false, $arSelectedFields);

        $arDays = [];

        while($arItem = $dbItems->GetNext())
        {
            if ($arItem['PROPERTY_COURSE_VALUE']) {
                $arItem['COURSE'] = \InfoSystems\Tools\IblockTools::getElement($arItem['PROPERTY_COURSE_VALUE']);

                if ($arItem['COURSE']['PROPERTIES']['TEACHERS']['VALUE']) {
                    $arItem['TEACHERS'] = \InfoSystems\Tools\IblockTools::getElements($arItem['COURSE']['PROPERTIES']['TEACHERS']['VALUE']);
                }

                if ($arItem['COURSE']['PROPERTIES']['CLASSROOM']['VALUE']) {
                    $arItem['CLASSROOM'] = \InfoSystems\Tools\IblockTools::getElement($arItem['COURSE']['PROPERTIES']['CLASSROOM']['VALUE']);
                }

            }

            $arDays[ConvertDateTime($arItem["ACTIVE_FROM"], CLang::GetDateFormat("SHORT"))][] = $arItem;
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
                        'teachers' => $dayNews['TEACHERS'] ? array_column($dayNews['TEACHERS'], 'NAME'):[],
                        'address' => $dayNews['COURSE']['PROPERTIES']['LOCATION']['VALUE'],
                        'course' => $dayNews['COURSE']['PROPERTIES']['COURSE']['VALUE'],
                        'status' => $dayNews['COURSE']['PROPERTIES']['STATUS']['VALUE'],
                        'color' => $result['STATUSES'][$dayNews['COURSE']['PROPERTIES']['STATUS']['VALUE']]['UF_COLOR'],
                        'code' =>  $dayNews['COURSE']['PROPERTIES']['ARTNUMBER']['VALUE'],
                        'room' => $dayNews['CLASSROOM']['NAME'],
                        'deal' => count($dayNews['COURSE']['PROPERTIES']['DEAL_LIST']['VALUE']),
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

        if ($result['MONTH']) {
            $result['WEEK_DAYS'] = array_column($result['MONTH'][$week-1], 'date');

            $arFilter = Array(
                "ACTIVE" => "Y",
                ">=DATE_ACTIVE_FROM" => date('d.m.Y H:i:s', strtotime(current($result['WEEK_DAYS']))),
                "<=DATE_ACTIVE_FROM" => date('d.m.Y 23:59:59',  strtotime(end($result['WEEK_DAYS']))),
            );

            $arSelectedFields = Array("ACTIVE", "ACTIVE_FROM", "ACTIVE_TO", "ID", "IBLOCK_ID", "SITE_ID", "DETAIL_PAGE_URL", "NAME",  "SORT",  'PROPERTY_COURSE');

            $dbItems = CIBlockElement::GetList(array("ACTIVE_FROM"=>"ASC", "ID"=>"ASC"), $arFilter, false, false, $arSelectedFields);
            while($arItem = $dbItems->GetNext())
            {
                $test[] = $arItem ;
                if ($arItem['PROPERTY_COURSE_VALUE']) {
                    $arItem['COURSE'] = \InfoSystems\Tools\IblockTools::getElement($arItem['PROPERTY_COURSE_VALUE']);

                    if ($arItem['COURSE']['PROPERTIES']['CLASSROOM']['VALUE']) {
                        $arItem['CLASSROOM'] = \Bitrix\Iblock\ElementTable::getList([
                            'select' => ['ID', 'NAME'],
                            'filter' => [
                                '=ID' => $arItem['COURSE']['PROPERTIES']['CLASSROOM']['VALUE']
                            ],
                            'limit' => 1
                        ])->fetch();

                        if ($arItem['COURSE']['PROPERTIES']['TEACHERS']['VALUE']) {
                            $arItem['TEACHERS'] = \Bitrix\Iblock\ElementTable::getList([
                                'select' => ['ID', 'NAME'],
                                'filter' => [
                                    '=ID' => $arItem['COURSE']['PROPERTIES']['TEACHERS']['VALUE']
                                ],
                                'limit' => 1
                            ])->fetchAll();

                            $arItem['TEACHERS'] = array_column($arItem['TEACHERS'], 'NAME');
                        }

                        $resultWeek[$arItem['CLASSROOM']['ID']]['classroom'] = $arItem['CLASSROOM']['NAME'];
                        $resultWeek[$arItem['CLASSROOM']['ID']]['events'][$arItem['COURSE']['ID']][] = [
                            'title' => $arItem['NAME'],
                            'url' => $arItem['COURSE']['DETAIL_PAGE_URL'],
                            'code' => $arItem['COURSE']['PROPERTIES']['ARTNUMBER']['VALUE'],
                            'color' => $result['STATUSES'][$arItem['COURSE']['PROPERTIES']['STATUS']['VALUE']]['UF_COLOR'],
                            'date_from' => $arItem['ACTIVE_FROM'],
                            'date_to' => $arItem['ACTIVE_TO'],
                            'teacher' => $arItem['TEACHERS'],
                            'address' => $arItem['COURSE']['PROPERTIES']['LOCATION']['VALUE'],
                            'form' => $arItem['COURSE']['PROPERTIES']['COURSE_FORM']['VALUE'],
                        ];
                    }
                }
            }

            foreach ($resultWeek as $key => $week) {
                $result['WEEK'][$key]['classroom'] = $week['classroom'];
                foreach ($result['WEEK_DAYS'] as $weekDay) {
                    $result['WEEK'][$key]['days'][$weekDay] = [];
                    foreach ($week['events'] as $events) {
                        foreach ($events as $keyEvent => $event) {
                            if ($weekDay == date('d.m.Y', strtotime($event['date_from']))) {
                                $result['WEEK'][$key]['days'][$weekDay][] = $event;
                            }
                        }
                    }
                }
            }
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

                if ($arItem['COURSE']['PROPERTIES']['CLASSROOM']['VALUE']) {
                    $arItem['CLASSROOM'] = \Bitrix\Iblock\ElementTable::getList([
                        'select' => ['ID', 'NAME'],
                        'filter' => [
                            '=ID' => $arItem['COURSE']['PROPERTIES']['CLASSROOM']['VALUE']
                        ],
                        'limit' => 1
                    ])->fetch();

                    if ($arItem['COURSE']['PROPERTIES']['TEACHERS']['VALUE']) {
                        $arItem['TEACHERS'] = \Bitrix\Iblock\ElementTable::getList([
                            'select' => ['ID', 'NAME'],
                            'filter' => [
                                '=ID' => $arItem['COURSE']['PROPERTIES']['TEACHERS']['VALUE']
                            ],
                            'limit' => 1
                        ])->fetchAll();

                        $arItem['TEACHERS'] = array_column($arItem['TEACHERS'], 'NAME');
                    }

                    $result['DAY'][$arItem['CLASSROOM']['ID']]['classroom'] = $arItem['CLASSROOM']['NAME'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['title'] = $arItem['COURSE']['NAME'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['url'] = $arItem['COURSE']['DETAIL_PAGE_URL'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['code'] = $arItem['COURSE']['PROPERTIES']['ARTNUMBER']['VALUE'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['color'] = $result['STATUSES'][$arItem['COURSE']['PROPERTIES']['STATUS']['VALUE']]['UF_COLOR'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['teacher'] = $arItem['TEACHERS'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['address'] = $arItem['COURSE']['PROPERTIES']['LOCATION']['VALUE'];
                    $result['DAY'][$arItem['CLASSROOM']['ID']]['form'] = $arItem['COURSE']['PROPERTIES']['COURSE_FORM']['VALUE'];

                    $timeFrom = date('H:i', strtotime($arItem['ACTIVE_FROM']));

                    $result['DAY'][$arItem['CLASSROOM']['ID']]['events'][$timeFrom] = [
                        'date_from' => $arItem['ACTIVE_FROM'],
                        'date_to'   => $arItem['ACTIVE_TO'],
                        'duration'  => ((new DateTime($arItem['ACTIVE_TO']))->diff(new DateTime($arItem['ACTIVE_FROM']))->format('%h'))*4,
                    ];
                }
            }
        }
        ?><pre style="display: none"><?print_r($result['DAY'])?></pre> <?
        if ($result['DAY']) {
            $this->prepareDataForDay();
        }
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

        foreach ($result['DAY'] as $keyItem => $arItem) {
            foreach ($arItem['events'] as $keyEvent => $event) {

                if (empty($event)) {
                    continue;
                }

                if ($event['duration']) {
                    for ($i = $keyEvent; $i < $event['duration'] + 7; $i++) {
                        unset($result['DAY'][$keyItem]['events'][$i+1]);
                    }
                }
            }
        }
    }

    /**
     * @return array|null
     */
    protected function getStatuses(): ?array
    {
        $result = [];

        $statuses = ScheduleStatusesTable::getList(['order' => ['UF_SORT' => 'ASC']])->fetchAll();

        foreach ($statuses as $status) {
            $result[$status['UF_XML_ID']] = $status;
        }

        return $result;
    }
}
