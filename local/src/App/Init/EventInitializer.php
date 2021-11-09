<?php

namespace InfoSystems\App\Init;

use Bitrix\Main\EventManager;
use ReflectionException;
use RuntimeException;
use Generator;

/**
 * Class EventInitializer
 * Регистрация обработчиков событий проекта
 *
 * @package InfoSystems\App\EventHandling
 */
final class EventInitializer
{
    private const SERVICE_HANDLER_CLASSES = [
        \InfoSystems\Sale\EventController\EventHandler::class,
        \InfoSystems\Schedule\EventController\EventHandler::class
    ];

    /**
     * @param EventManager|null $eventManager
     * @throws RuntimeException
     * @throws ReflectionException
     */
    public function __invoke(EventManager $eventManager = null)
    {
        if ($eventManager === null) {
            $eventManager = EventManager::getInstance();
        }

        foreach ($this->getServiceHandlerClassList() as $class) {
            $class::initHandlers($eventManager);
        }
    }

    /**
     * @throws ReflectionException
     * @throws RuntimeException
     * @return Generator
     */
    private function getServiceHandlerClassList(): Generator
    {
        foreach (self::SERVICE_HANDLER_CLASSES as $serviceHandlerClass) {
            $interfaces = (new \ReflectionClass($serviceHandlerClass))->getInterfaceNames();

            if (!\in_array(\InfoSystems\App\EventHandling\EventHandlerInterface::class, $interfaces, true)) {
                throw new RuntimeException(
                    'Handler class must be an instance of ' . EventHandlerInterface::class
                );
            }

            yield $serviceHandlerClass;
        }
    }
}
