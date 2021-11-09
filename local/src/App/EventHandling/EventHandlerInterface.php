<?php

namespace InfoSystems\App\EventHandling;

use Bitrix\Main\EventManager;

interface EventHandlerInterface
{
    /**
     * Инициализация всех обработчиков сервиса
     *
     * @param \Bitrix\Main\EventManager $eventManager
     */
    public static function initHandlers(EventManager $eventManager);

    public static function initHandler(string $eventName, callable $callback, string $module = '', bool $check = true);
}
