<?php

namespace InfoSystems\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use InfoSystems\Data\HighloadblockTableAbstract;

class CrmDealsTable extends HighloadblockTableAbstract
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'is_crm_deals';
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
}
