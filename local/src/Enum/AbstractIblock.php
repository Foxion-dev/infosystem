<?php

namespace InfoSystems\Enum;

use InfoSystems\Tools\IblockTools;

abstract class AbstractIblock
{
    /** @var string */
    protected static $type = '';

    /** @var string */
    protected static $code = '';

    /**
     * @return int|null
     */
    public static function getId(): ?int
    {
        if(static::getType() && static::getCode()) {
            return IblockTools::getIblockId(
                static::getType(),
                static::getCode()
            );
        }

        return false;
    }

    /**
     * @return string
     */
    public static function getType(): string
    {
        return static::$type;
    }

    /**
     * @return string
     */
    public static function getCode(): string
    {
        return static::$code;
    }
}
