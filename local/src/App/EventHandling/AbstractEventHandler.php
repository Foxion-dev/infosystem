<?php

namespace InfoSystems\App\EventHandling;

use Bitrix\Main\EventManager;

abstract class AbstractEventHandler implements EventHandlerInterface
{
    /** @var EventManager */
    protected static $eventManager;

    /**
     * Инициализация всех обработчиков сервиса
     *
     * @param EventManager $eventManager
     */
    public static function initHandlers(EventManager $eventManager): void
    {
        static::$eventManager = $eventManager;
    }

    /**
     * @param string $eventName
     * @param callable $callback
     * @param string $module
     * @return bool
     */
    protected static function checkUnique(string $eventName, callable $callback, string $module = ''): bool
    {
        $handlers = static::$eventManager->findEventHandlers($module, $eventName);
        foreach ($handlers as $handler) {
            if (isset($handler['CALLBACK']) && $handler['CALLBACK'] === $callback) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $eventName
     * @param callable $callback
     * @param string $module
     * @param bool $check
     */
    public static function initHandler(string $eventName, callable $callback, string $module = '', bool $check = true): void
    {
        if ($check && static::checkUnique($eventName, $callback, $module)) {
            return;
        }

        static::$eventManager->addEventHandler(
            $module,
            $eventName,
            $callback
        );
    }
}
