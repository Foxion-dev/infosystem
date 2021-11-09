<?php


namespace InfoSystems\Api\Helper;

use InfoSystems\Api\Tables\ApiSessionTable;

class ApiHelper
{
    /**
     * @return bool|mixed
     */
    public static function getHeaderAllowIp()
    {
        $headers = getallheaders();
        if (is_array($headers)) {
            foreach ($headers as $header => $value) {
                if (strtolower($header) === 'x-forwarded-for') {
                    return $value;
                }
            }
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public static function getHeaderHash()
    {
        $headers = getallheaders();

        if (is_array($headers)) {
            foreach ($headers as $header => $value) {
                if (strtolower($header) === 'x-user-hash') {
                    return $value;
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function authorizationUser()
    {
        global $USER;

        /** Не осталось времени реализовать JWT */
        $allowIp = ApiHelper::getHeaderAllowIp();
        if ($allowIp == '45.15.75.144') {
            return true;
        }

        $hash = ApiHelper::getHeaderHash();
        if (!$hash) {
            return false;
        }

        $session = ApiSessionTable::getSession($hash);
        if (!$session) {
            return false;
        }

        if (!$USER->IsAuthorized()) {
            $USER->Authorize($session['UF_USER']);
        }

        if (!$USER->IsAuthorized()) {
            return false;
        }

        return true;
    }
}
