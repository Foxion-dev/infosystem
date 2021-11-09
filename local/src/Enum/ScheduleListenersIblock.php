<?php

namespace InfoSystems\Enum;

class ScheduleListenersIblock extends AbstractIblock
{
    /** @var string */
    protected static $type = IblockType::SCHEDULE;

    /** @var string */
    protected static $code = IblockCode::LISTENERS;
}
