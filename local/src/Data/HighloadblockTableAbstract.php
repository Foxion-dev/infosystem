<?php

namespace InfoSystems\Data;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\Loader;

abstract class HighloadblockTableAbstract extends DataManager
{
    /** @var Base[]  */
    protected static $hlEntities = [];

    /**
     * @return Base
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    protected static function getHlEntity(): Base
    {
        $class = static::class;
        if (!isset(static::$hlEntities[$class])) {
            static::$hlEntities[$class] = static::compileEntity();
        }

        return static::$hlEntities[$class];
    }

    /**
     * @return Base
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    protected static function compileEntity(): Base
    {
        $hlEntityData = HighloadBlockTable::getList(
            [
                'filter' => [
                    '=TABLE_NAME' => static::getTableName()
                ],
                'cache' => [
                    'ttl' => 3600
                ],
            ]
        )->fetch();
        if (!$hlEntityData) {
            throw new HighloadBlockNotFoundException(
                'Table '.static::getTableName().' not found'
            );
        }

        return HighloadBlockTable::compileEntity($hlEntityData);
    }

    /**
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    protected static function getMapBase(): array
    {
        Loader::includeModule('highloadblock');

        $tmp = static::getHlEntity()->getFields();

        $map = [];
        foreach ($tmp as $fieldName => $fieldEntity) {
            $map[$fieldName] = clone $fieldEntity;
            $map[$fieldName]->resetEntity();
        }

        return $map;
    }
}
