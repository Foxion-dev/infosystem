<?php

namespace InfoSystems\Schedule;

use Bitrix\Main\Type\DateTime;

class Calendar
{
    /** @var array */
    const RUS_MONTHS = [
        '01' => ['commonForm' => 'январь'],
        '02' => ['commonForm' => 'февраль'],
        '03' => ['commonForm' => 'март'],
        '04' => ['commonForm' => 'апрель'],
        '05' => ['commonForm' => 'май',],
        '06' => ['commonForm' => 'июнь'],
        '07' => ['commonForm' => 'июль'],
        '08' => ['commonForm' => 'август'],
        '09' => ['commonForm' => 'сентябрь'],
        '10' => ['commonForm' => 'октябрь'],
        '11' => ['commonForm' => 'ноябрь'],
        '12' => ['commonForm' => 'декабрь']
    ];

    /** @var array */
    const RUS_DAYS = [
        1 => [
            'short' => 'пн',
            'long'  => 'понедельник'
        ],
        2 => [
            'short' => 'вт',
            'long'  => 'вторник'
        ],
        3 => [
            'short' => 'ср',
            'long'  => 'среда'
        ],
        4 => [
            'short' => 'чт',
            'long'  => 'четверг'
        ],
        5 => [
            'short' => 'пт',
            'long'  => 'пятница'
        ],
        6 => [
            'short' => 'сб',
            'long'  => 'суббота'
        ],
        0 => [
            'short' => 'вс',
            'long'  => 'воскресенье'
        ]
    ];

    const TIME = [
        ['start' => '8:00', 'stop' => '8:15'],
        ['start' => '8:15', 'stop' => '8:30'],
        ['start' => '8:30', 'stop' => '8:45'],
        ['start' => '8:45', 'stop' => '9:00'],

        ['start' => '9:00', 'stop' => '9:15'],
        ['start' => '9:15', 'stop' => '9:30'],
        ['start' => '9:30', 'stop' => '9:45'],
        ['start' => '9:45', 'stop' => '10:00'],

        ['start' => '10:00', 'stop' => '10:15'],
        ['start' => '10:15', 'stop' => '10:30'],
        ['start' => '10:30', 'stop' => '10:45'],
        ['start' => '10:45', 'stop' => '11:00'],

        ['start' => '11:00', 'stop' => '11:15'],
        ['start' => '11:15', 'stop' => '11:30'],
        ['start' => '11:30', 'stop' => '11:45'],
        ['start' => '11:45', 'stop' => '12:00'],

        ['start' => '12:00', 'stop' => '12:15'],
        ['start' => '12:15', 'stop' => '12:30'],
        ['start' => '12:30', 'stop' => '12:45'],
        ['start' => '12:45', 'stop' => '13:00'],

        ['start' => '13:00', 'stop' => '13:15'],
        ['start' => '13:15', 'stop' => '13:30'],
        ['start' => '13:30', 'stop' => '13:45'],
        ['start' => '13:45', 'stop' => '14:00'],

        ['start' => '14:00', 'stop' => '14:15'],
        ['start' => '14:15', 'stop' => '14:30'],
        ['start' => '14:30', 'stop' => '14:45'],
        ['start' => '14:45', 'stop' => '15:00'],

        ['start' => '15:00', 'stop' => '15:15'],
        ['start' => '15:15', 'stop' => '15:30'],
        ['start' => '15:30', 'stop' => '15:45'],
        ['start' => '15:45', 'stop' => '16:00'],

        ['start' => '16:00', 'stop' => '16:15'],
        ['start' => '16:15', 'stop' => '16:30'],
        ['start' => '16:30', 'stop' => '16:45'],
        ['start' => '16:45', 'stop' => '17:00'],

        ['start' => '17:00', 'stop' => '17:15'],
        ['start' => '17:15', 'stop' => '17:30'],
        ['start' => '17:30', 'stop' => '17:45'],
        ['start' => '17:45', 'stop' => '18:00'],

        ['start' => '18:00', 'stop' => '10:15'],
        ['start' => '10:15', 'stop' => '10:30'],
        ['start' => '10:30', 'stop' => '10:45'],
        ['start' => '10:45', 'stop' => '19:00'],

        ['start' => '19:00', 'stop' => '19:15'],
        ['start' => '19:15', 'stop' => '19:30'],
        ['start' => '19:30', 'stop' => '19:45'],
        ['start' => '19:45', 'stop' => '20:00'],

        ['start' => '20:00', 'stop' => '20:15'],
        ['start' => '20:15', 'stop' => '20:30'],
        ['start' => '20:30', 'stop' => '20:45'],
        ['start' => '20:45', 'stop' => '21:00'],

        ['start' => '21:00', 'stop' => '21:15'],
        ['start' => '21:15', 'stop' => '21:30'],
        ['start' => '21:30', 'stop' => '21:45'],
        ['start' => '21:45', 'stop' => '22:00'],
    ];

    public $date;

    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    public static function getTimes()
    {
        return array_chunk(self::TIME, 4);
    }

    /**
     * Возвращает количество дней в месяце для заданного года и календаря
     *
     * @link https://www.php.net/manual/ru/function.cal-days-in-month.php
     * @param int $year
     * @param int $month
     * @return int
     */
    public static function getDaysInMonth(int $year, int $month): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    /**
     * Возвращает день недели
     *
     * @link https://www.php.net/manual/ru/function.jddayofweek.php
     *
     * @param int $julian_day
     * @return int|string
     */
    public static function getDayOfWeek (int $julian_day): ?int
    {
        return jddayofweek($julian_day, CAL_DOW_DAYNO);
    }

    /**
     * @param string $monthNum
     * @return string
     */
    public static function getRussianMonth(string $monthNum = '01') : string
    {
        return self::RUS_MONTHS[$monthNum]['commonForm'];
    }

    /**
     * @param int $dayNum
     * @param bool $long
     * @return string
     */
    public static function getRussianDay(int $dayNum = 1, bool $long = true) : string
    {
        return $long
            ? self::RUS_DAYS[$dayNum]['long']
            : self::RUS_DAYS[$dayNum]['short'];
    }

    /**
     * @return array
     */
    public static function getTimeIntervals()
    {
        return self::TIME_INTERVAL;
    }

    public static function getDayOfMonth()
    {

    }

    public static function isDateIntersect($dateFrom, $dateTo)
    {

    }
}
