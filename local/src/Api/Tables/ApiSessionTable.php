<?php

namespace InfoSystems\Api\Tables;

use Bitrix\Main;
use InfoSystems\Data\HighloadblockTableAbstract;

class ApiSessionTable extends HighloadblockTableAbstract
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'sessions_users_api';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getMap(): array
    {
        static $map = null;

        if ($map === null) {
            $map = static::getMapBase();
        }

        return $map;
    }

    public static function createSession($userId, $remember = false)
    {
        $hash = self::getHash();

        $params = [
            'UF_SESSION' => $hash,
            'UF_USER' => $userId,
            'UF_DATE' => new Main\Type\DateTime(),
            'UF_LAST_DATE' => new Main\Type\DateTime(),
            'UF_REMEMBER' => $remember
        ];
        $result = self::add($params);

        if ($result->isSuccess()) {
            return $params;
        }

        return false;
    }

    public static function getSession($hash)
    {
        $session = self::getList([
            'select'=> ['*'],
            'filter' => ['=UF_SESSION' => $hash]
        ])->fetch();

        if ($session) {
            $date = new \DateTime();
            $date->modify('-1 day');
            if ( ($session['UF_LAST_DATE']->format('Ymd') > $date->format('Ymd')) || $session['UF_REMEMBER'] ) {
                self::update($session['ID'], ['UF_LAST_DATE' => new Main\Type\DateTime()]);
            } else {
                self::delete($session['ID']);
                return false;
            }

            unset($session['ID']);

            return $session;
        }

        return false;
    }

    public static function getHash()
    {
        $entropy = ['!', '@', '#', '$', '%', '&'];
        return 'api' . $entropy[rand(0,5)] . md5(time() . uniqid('apiprefix', true));
    }
}
