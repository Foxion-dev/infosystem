<?php

namespace InfoSystems\App\Init;

/**
 * Class UserTypeInitializer
 * Регистрация пользовательских типов свойств
 *
 * @package InfoSystems\App\Init
 */
final class UserTypeInitializer
{
    public function __invoke()
    {
        //Привязка к пользовательскому соглашению
        (new \InfoSystems\UserType\Iblock\AgreementLinkType())->init();
        //Даты проведения курса
        (new \InfoSystems\UserType\Iblock\DateCoursesType())->init();
    }
}
