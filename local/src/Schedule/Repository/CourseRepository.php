<?php
namespace InfoSystems\Schedule\Repository;

use InfoSystems\Enum\ScheduleCoursesIblock;

class CourseRepository
{
    public function getIblockId(): int
    {
        return ScheduleCoursesIblock::getId();
    }

    /**
     * @return array
     */
    private function getActiveFilter(): array
    {
        return [
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y',
        ];
    }
}
