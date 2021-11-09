<?php

namespace InfoSystems\Iblock;

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use InfoSystems\Iblock\Exception\IblockHelperException;
use InfoSystems\Iblock\Traits\IblockElementTrait;
use InfoSystems\Iblock\Traits\IblockFieldTrait;
use InfoSystems\Iblock\Traits\IblockPropertyTrait;
use InfoSystems\Iblock\Traits\IblockSectionTrait;
use InfoSystems\Iblock\Traits\IblockTrait;
use InfoSystems\Iblock\Traits\IblockTypeTrait;

class IblockHelper
{
    use IblockSectionTrait;
    use IblockElementTrait;
    use IblockPropertyTrait;
    use IblockFieldTrait;
    use IblockTrait;
    use IblockTypeTrait;

    public const TR_REPLACE = '_';

    public const TR_PARAMS = [
        'max_len' => 255,
        'change_case' => 'L',
        'replace_space' => self::TR_REPLACE,
        'replace_other' => self::TR_REPLACE,
        'delete_repeat_replace' => true,
        'safe_chars' => '',
    ];

    /**
     * @param string $str
     *
     * @return string
     */
    public function translit(string $str): string
    {
        return \CUtil::translit($str, 'ru', self::TR_PARAMS);
    }

    /**
     * IblockHelper constructor.
     */
    public function isEnabled()
    {
        return $this->checkModules(['iblock']);
    }

    /**
     * @param array $names
     *
     * @return bool
     */
    protected function checkModules($names = [])
    {
        $names = is_array($names) ? $names : [$names];
        foreach ($names as $name) {
            try {
                if (!Loader::includeModule($name)) {
                    return false;
                }
            } catch (LoaderException $e) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $method
     * @param $fields
     * @param array $reqKeys
     * @throws IblockHelperException
     */
    protected function checkRequiredKeys($method, $fields, $reqKeys = [])
    {
        foreach ($reqKeys as $name) {
            if (empty($fields[$name])) {
                $this->throwException($method, sprintf("Обязательное поле %s не заполнено", $name));
            }
        }
    }

    /**
     * @param CDBResult $dbres
     * @param bool      $indexKey
     * @param bool      $valueKey
     *
     * @return array
     */
    protected function fetchAll(\CDBResult $dbres, $indexKey = false, $valueKey = false)
    {
        $res = [];

        while ($item = $dbres->Fetch()) {
            if ($valueKey) {
                $value = $item[$valueKey];
            } else {
                $value = $item;
            }

            if ($indexKey) {
                $indexVal = $item[$indexKey];
                $res[$indexVal] = $value;
            } else {
                $res[] = $value;
            }
        }

        return $res;
    }

    protected function filterByKey($items, $key, $value)
    {
        return array_values(
            array_filter(
                $items,
                function ($item) use ($key, $value) {
                    return ($item[$key] == $value);
                }
            )
        );
    }

    /**
     * @param $method
     * @param $msg
     * @param mixed ...$vars
     * @throws IblockHelperException
     */
    protected function throwException($method, $msg, ...$vars)
    {
        $args = func_get_args();
        $method = array_shift($args);

        $msg = $this->getMethod($method) . ': ' . strip_tags($msg);

        throw new IblockHelperException($msg);
    }

    /**
     * @param $method
     * @return mixed
     */
    private function getMethod($method)
    {
        $path = explode('\\', $method);
        $short = array_pop($path);
        return $short;
    }

    /**
     * @param string $str
     * @param bool $binary
     * @return string
     */
    public function generateHash(string $str, bool $binary = false): string
    {
        return md5($str, $binary);
    }
}
