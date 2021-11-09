<?php

namespace InfoSystems\Iblock\Traits;

use CIBlockElement;
use CIBlockProperty;
use CIBlockPropertyEnum;
use InfoSystems\Iblock\Exception\IblockHelperException;

trait IblockPropertyTrait
{
    /**
     * Сохраняет свойство инфоблока
     *
     * @param $iblockId
     * @param $fields , обязательные параметры - код свойства
     *
     * @throws IblockHelperException
     * @return bool|mixed
     */
    public function saveProperty($iblockId, $fields)
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['CODE']);

        $exists = $this->getProperty($iblockId, $fields['CODE']);

        if (empty($exists)) {
            return $this->addProperty($iblockId, $fields);
        }
        return false;
    }

    /**
     * Получает свойство инфоблока
     *
     * @param $iblockId
     * @param $code int|array - код или фильтр
     *
     * @return array|bool
     */
    public function getProperty($iblockId, $code)
    {
        /** @compatibility filter or code */
        $filter = is_array($code)
            ? $code
            : [
                'CODE' => $code,
            ];

        $filter['IBLOCK_ID'] = $iblockId;
        $filter['CHECK_PERMISSIONS'] = 'N';
        /* do not use =CODE in filter */
        $property = CIBlockProperty::GetList(['SORT' => 'ASC'], $filter)->Fetch();
        return $this->prepareProperty($property);
    }

    /**
     * Получает значения списков для свойств инфоблоков
     *
     * @param array $filter
     *
     * @return array
     */
    public function getPropertyEnums($filter = [])
    {
        $result = [];
        $dbres = CIBlockPropertyEnum::GetList(
            [
                'SORT'  => 'ASC',
                'VALUE' => 'ASC',
            ], $filter
        );
        while ($item = $dbres->Fetch()) {
            $result[] = $item;
        }
        return $result;
    }

    /**
     * Получает значения списков для свойства инфоблока
     *
     * @param $iblockId
     * @param $propertyId
     *
     * @return array
     */
    public function getPropertyEnumValues($iblockId, $propertyId)
    {
        return $this->getPropertyEnums(
            [
                'IBLOCK_ID'   => $iblockId,
                'PROPERTY_ID' => $propertyId,
            ]
        );
    }

    /**
     * Получает свойство инфоблока
     *
     * @param $iblockId
     * @param $code int|array - код или фильтр
     *
     * @return int
     */
    public function getPropertyId($iblockId, $code)
    {
        $item = $this->getProperty($iblockId, $code);
        return ($item && isset($item['ID'])) ? $item['ID'] : 0;
    }

    /**
     * Получает свойства инфоблока
     *
     * @param $iblockId
     * @param array $filter
     *
     * @return array
     */
    public function getProperties($iblockId, $filter = [])
    {
        $filter['IBLOCK_ID'] = $iblockId;
        $filter['CHECK_PERMISSIONS'] = 'N';

        $filterIds = false;
        if (isset($filter['ID']) && is_array($filter['ID'])) {
            $filterIds = $filter['ID'];
            unset($filter['ID']);
        }

        $dbres = CIBlockProperty::GetList(['SORT' => 'ASC'], $filter);

        $result = [];

        while ($property = $dbres->Fetch()) {
            if ($filterIds) {
                if (in_array($property['ID'], $filterIds)) {
                    $result[] = $this->prepareProperty($property);
                }
            } else {
                $result[] = $this->prepareProperty($property);
            }
        }
        return $result;
    }

    /**
     * Добавляет свойство инфоблока если его не существует
     *
     * @param $iblockId
     * @param $fields , обязательные параметры - код свойства
     *
     * @throws IblockHelperException
     * @return bool
     */
    public function addPropertyIfNotExists($iblockId, $fields)
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['CODE']);

        $property = $this->getProperty($iblockId, $fields['CODE']);

        if ($property) {
            return $property['ID'];
        }

        return $this->addProperty($iblockId, $fields);
    }

    /**
     * Добавляет свойство инфоблока
     *
     * @param $iblockId
     * @param $fields
     *
     * @throws IblockHelperException
     * @return int|void
     */
    public function addProperty($iblockId, $fields)
    {
        $default = [
            'NAME'           => '',
            'ACTIVE'         => 'Y',
            'SORT'           => '500',
            'CODE'           => '',
            'PROPERTY_TYPE'  => 'S',
            'USER_TYPE'      => '',
            'ROW_COUNT'      => '1',
            'COL_COUNT'      => '30',
            'LIST_TYPE'      => 'L',
            'MULTIPLE'       => 'N',
            'IS_REQUIRED'    => 'N',
            'FILTRABLE'      => 'Y',
            'LINK_IBLOCK_ID' => 0,
            'SMART_FILTER'   => 'Y'
        ];

        if (!empty($fields['VALUES'])) {
            $default['PROPERTY_TYPE'] = 'L';
        }

        if (!empty($fields['LINK_IBLOCK_ID'])) {
            $default['PROPERTY_TYPE'] = 'E';
        }

        $fields = array_replace_recursive($default, $fields);

        if (false !== strpos($fields['PROPERTY_TYPE'], ':')) {
            list($ptype, $utype) = explode(':', $fields['PROPERTY_TYPE']);
            $fields['PROPERTY_TYPE'] = $ptype;
            $fields['USER_TYPE'] = $utype;
        }

        if (false !== strpos($fields['LINK_IBLOCK_ID'], ':')) {
            $fields['LINK_IBLOCK_ID'] = $this->getIblockIdByUid($fields['LINK_IBLOCK_ID']);
        }

        $fields['IBLOCK_ID'] = $iblockId;
        \Bitrix\Main\Diag\Debug::writeToFile($fields, __METHOD__.':'.__LINE__);
        $ib = new CIBlockProperty;
        $propertyId = $ib->Add($fields);

        if ($propertyId) {
            return $propertyId;
        }

        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * Удаляет свойство инфоблока если оно существует
     *
     * @param $iblockId
     * @param $code
     *
     * @throws IblockHelperException
     * @return bool|void
     */
    public function deletePropertyIfExists($iblockId, $code)
    {
        $property = $this->getProperty($iblockId, $code);
        if (!$property) {
            return false;
        }

        return $this->deletePropertyById($property['ID']);
    }

    /**
     * Удаляет свойство инфоблока
     *
     * @param $propertyId
     *
     * @throws IblockHelperException
     * @return bool|void
     */
    public function deletePropertyById($propertyId)
    {
        $ib = new CIBlockProperty;
        if ($ib->Delete($propertyId)) {
            return true;
        }

        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * Обновляет свойство инфоблока если оно существует
     *
     * @param $iblockId
     * @param $code
     * @param $fields
     *
     * @throws IblockHelperException
     * @return bool|int|void
     */
    public function updatePropertyIfExists($iblockId, $code, $fields)
    {
        $property = $this->getProperty($iblockId, $code);
        if (!$property) {
            return false;
        }
        return $this->updatePropertyById($property['ID'], $fields);
    }

    /**
     * Обновляет свойство инфоблока
     *
     * @param $propertyId
     * @param $fields
     *
     * @throws IblockHelperException
     * @return int|void
     */
    public function updatePropertyById($propertyId, $fields)
    {
        if (!empty($fields['VALUES']) && !isset($fields['PROPERTY_TYPE'])) {
            $fields['PROPERTY_TYPE'] = 'L';
        }

        if (!empty($fields['LINK_IBLOCK_ID']) && !isset($fields['PROPERTY_TYPE'])) {
            $fields['PROPERTY_TYPE'] = 'E';
        }

        if (false !== strpos($fields['PROPERTY_TYPE'], ':')) {
            list($ptype, $utype) = explode(':', $fields['PROPERTY_TYPE']);
            $fields['PROPERTY_TYPE'] = $ptype;
            $fields['USER_TYPE'] = $utype;
        }

        if (false !== strpos($fields['LINK_IBLOCK_ID'], ':')) {
            $fields['LINK_IBLOCK_ID'] = $this->getIblockIdByUid($fields['LINK_IBLOCK_ID']);
        }

        if (isset($fields['VALUES']) && is_array($fields['VALUES'])) {
            $existsEnums = $this->getPropertyEnums(
                [
                    'PROPERTY_ID' => $propertyId,
                ]
            );

            $newValues = [];
            foreach ($fields['VALUES'] as $index => $item) {
                foreach ($existsEnums as $existsEnum) {
                    if ($existsEnum['XML_ID'] == $item['XML_ID']) {
                        $item['ID'] = $existsEnum['ID'];
                        break;
                    }
                }

                if (!empty($item['ID'])) {
                    $newValues[$item['ID']] = $item;
                } else {
                    $newValues['n' . $index] = $item;
                }
            }

            $fields['VALUES'] = $newValues;
        }

        $ib = new CIBlockProperty();
        if ($ib->Update($propertyId, $fields)) {
            return $propertyId;
        }

        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * @param $iblockId
     * @param $code
     *
     * @throws IblockHelperException
     * @return bool
     * @deprecated
     */
    public function deleteProperty($iblockId, $code)
    {
        return $this->deletePropertyIfExists($iblockId, $code);
    }

    /**
     * @param $iblockId
     * @param $code
     * @param $fields
     *
     * @throws IblockHelperException
     * @return bool|mixed
     * @deprecated
     */
    public function updateProperty($iblockId, $code, $fields)
    {
        return $this->updatePropertyIfExists($iblockId, $code, $fields);
    }

    /**
     * @param $iblockId
     * @param $code
     * @return mixed
     */
    public function getPropertyType($iblockId, $code)
    {
        $prop = $this->getProperty($iblockId, $code);
        return $prop['PROPERTY_TYPE'];
    }

    /**
     * @param $iblockId
     * @param $code
     * @return mixed
     */
    public function getPropertyLinkIblockId($iblockId, $code)
    {
        $prop = $this->getProperty($iblockId, $code);
        return $prop['LINK_IBLOCK_ID'];
    }

    /**
     * @param $iblockId
     * @param $code
     * @return bool
     */
    public function isPropertyMultiple($iblockId, $code)
    {
        $prop = $this->getProperty($iblockId, $code);
        return ($prop['MULTIPLE'] == 'Y');
    }

    /**
     * @param $iblockId
     * @param $code
     * @param $xmlId
     * @return string
     */
    public function getPropertyEnumIdByXmlId($iblockId, $code, $xmlId)
    {
        $prop = $this->getProperty($iblockId, $code);
        if (empty($prop['VALUES']) || !is_array($prop['VALUES'])) {
            return '';
        }

        foreach ($prop['VALUES'] as $val) {
            if ($val['XML_ID'] == $xmlId) {
                return $val['ID'];
            }
        }
        return '';
    }

    /**
     * @param $property
     * @return mixed
     */
    protected function prepareProperty($property)
    {
        if ($property && $property['PROPERTY_TYPE'] == 'L' && $property['IBLOCK_ID'] && $property['ID']) {
            $property['VALUES'] = $this->getPropertyEnums(
                [
                    'IBLOCK_ID'   => $property['IBLOCK_ID'],
                    'PROPERTY_ID' => $property['ID'],
                ]
            );
        }
        return $property;
    }

    /**
     * @param $propertyId
     * @param $fields
     * @return mixed
     */
    public function addPropertyEnum($propertyId, $fields)
    {
        $default = [
            'VALUE'  => '',
            'DEF'    => 'N',
            'SORT'   => '500',
            'XML_ID' => ''
        ];

        $fields = array_replace_recursive($default, $fields);


        $fields['PROPERTY_ID'] = $propertyId;

        $ibpenum = new CIBlockPropertyEnum;
        $propertyEnumId = $ibpenum->Add($fields);

        if ($propertyEnumId) {
            return $propertyEnumId;
        }

        $this->throwException(__METHOD__, 'Ошибка добавления значения свойства');
    }
}
