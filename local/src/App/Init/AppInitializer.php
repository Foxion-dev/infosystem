<?php

namespace InfoSystems\App\Init;

use InfoSystems\App\Init\EventInitializer;

/**
 * Class AppInitializer
 * Инициализация проекта
 *
 * @package InfoSystems\App\Init
 */
final class AppInitializer
{
    public function __invoke()
    {
        /**
         * Регистрация обработчиков событий проекта
         */
        (new EventInitializer())();

        /**
         * Регистрация пользовательских типов свойств
         */
        (new UserTypeInitializer())();
    }
}
