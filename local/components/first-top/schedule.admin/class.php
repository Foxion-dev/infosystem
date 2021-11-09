<?php

use InfoSystems\App\Component\BaseComplexComponentAbstract;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class ScheduleComplexComponent extends BaseComplexComponentAbstract
{
    /**
     * @return string
     */
    protected function getComponentDir(): string
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    protected function getNotFoundComponentPageName(): string
    {
        return '404';
    }

    /**
     * @return array
     */
    protected function getComponentVariables(): array
    {
        return [];
    }

    /**
     * Массив SEF_URL_TEMPLATES по умолчанию
     *
     * @return array
     */
    protected function getDefaultSefUrlTemplates(): array
    {
        return [
            'index' => 'index.php',
            'detail' => 'detail.php',
        ];
    }
}
