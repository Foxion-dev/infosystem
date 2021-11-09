<?php


namespace InfoSystems\App;


/**
 * Class MainTemplate
 *
 * Класс для основного шаблона
 */
final class MainTemplate extends TemplateAbstract
{
    /**
     * @return bool
     */
    public function isScheduleList(): bool
    {
        return $this->isPathStartWith('/personal/schedule/') && !$this->isScheduleDetail();
    }

    /**
     * @return bool
     */
    public function isScheduleDetail(): bool
    {
        return $this->isPathStartWith('/personal/schedule/');
    }

    /**
     * @return string
     */
    public function getBodyClass(): string
    {
        $class = '';

        if ($this->isScheduleList() || $this->isScheduleDetail()) {
            $class = 'timetable-page';
        }

        return $class;
    }
}

