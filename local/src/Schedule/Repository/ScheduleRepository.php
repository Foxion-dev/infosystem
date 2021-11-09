<?php

namespace InfoSystems\Schedule\Repository;

use InfoSystems\Enum\ScheduleIblock;

class ScheduleRepository
{
    public function getIblockId(): int
    {
        return ScheduleIblock::getId();
    }
}
