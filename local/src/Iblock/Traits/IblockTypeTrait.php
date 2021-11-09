<?php

namespace InfoSystems\Iblock\Traits;

use CIBlockType;
use CLanguage;
use InfoSystems\Iblock\Exception\IblockHelperException;


trait IblockTypeTrait
{

    /**
     * Получает тип инфоблока, бросает исключение если его не существует
     * @param $typeId
     * @throws IblockHelperException
     * @return array|void
     */
    public function getIblockTypeIfExists($typeId)
    {
        $item = $this->getIblockType($typeId);
        if ($item && isset($item['ID'])) {
            return $item;
        }

        $this->throwException(__METHOD__, 'Тип инфоблока не найден');
    }

    /**
     * Получает id типа инфоблока, бросает исключение если его не существует
     * @param $typeId
     * @throws IblockHelperException
     * @return int|void
     */
    public function getIblockTypeIdIfExists($typeId)
    {
        $item = $this->getIblockType($typeId);
        if ($item && isset($item['ID'])) {
            return $item['ID'];
        }

        $this->throwException(__METHOD__, 'Тип инфоблока не найден');
    }


    /**
     * Получает тип инфоблока
     * @param $typeId
     * @return array
     */
    public function getIblockType($typeId)
    {
        /** @compatibility filter or $typeId */
        $filter = is_array($typeId) ? $typeId : [
            '=ID' => $typeId,
        ];

        $filter['CHECK_PERMISSIONS'] = 'N';
        $item = CIBlockType::GetList(['SORT' => 'ASC'], $filter)->Fetch();

        if ($item) {
            $item['LANG'] = $this->getIblockTypeLangs($item['ID']);
        }

        return $item;
    }

    /**
     * Получает id типа инфоблока
     * @param $typeId
     * @return int|mixed
     */
    public function getIblockTypeId($typeId)
    {
        $iblockType = $this->getIblockType($typeId);
        return ($iblockType && isset($iblockType['ID'])) ? $iblockType['ID'] : 0;
    }

    /**
     * Получает типы инфоблоков
     * @param array $filter
     * @return array
     */
    public function getIblockTypes($filter = [])
    {
        $filter['CHECK_PERMISSIONS'] = 'N';
        $dbres = CIBlockType::GetList(['SORT' => 'ASC'], $filter);

        $list = [];
        while ($item = $dbres->Fetch()) {
            $item['LANG'] = $this->getIblockTypeLangs($item['ID']);
            $list[] = $item;
        }
        return $list;
    }

    /**
     * Добавляет тип инфоблока, если его не существует
     * @param array $fields , обязательные параметры - id типа инфоблока
     * @throws IblockHelperException
     * @return mixed
     */
    public function addIblockTypeIfNotExists($fields = [])
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['ID']);

        $iblockType = $this->getIblockType($fields['ID']);
        if ($iblockType) {
            return $iblockType['ID'];
        }

        return $this->addIblockType($fields);
    }

    /**
     * Добавляет тип инфоблока
     * @param array $fields
     * @throws IblockHelperException
     * @return int|void
     */
    public function addIblockType($fields = [])
    {
        $default = [
            'ID' => '',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'N',
            'SORT' => 100,
            'LANG' => [
                'ru' => [
                    'NAME' => 'Catalog',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements',
                ],
                'en' => [
                    'NAME' => 'Catalog',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements',
                ],
            ],
        ];

        $fields = array_replace_recursive($default, $fields);

        $ib = new CIBlockType;
        if ($ib->Add($fields)) {
            return $fields['ID'];
        }

        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * Обновляет тип инфоблока
     * @param $iblockTypeId
     * @param array $fields
     * @throws IblockHelperException
     * @return int|void
     */
    public function updateIblockType($iblockTypeId, $fields = [])
    {
        $ib = new CIBlockType;
        if ($ib->Update($iblockTypeId, $fields)) {
            return $iblockTypeId;
        }

        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * Удаляет тип инфоблока, если существует
     * @param $typeId
     * @throws IblockHelperException
     * @return bool
     */
    public function deleteIblockTypeIfExists($typeId)
    {
        $iblockType = $this->getIblockType($typeId);
        if (!$iblockType) {
            return false;
        }

        return $this->deleteIblockType($iblockType['ID']);

    }

    /**
     * Удаляет тип инфоблока
     * @param $typeId
     * @throws IblockHelperException
     * @return bool|void
     */
    public function deleteIblockType($typeId)
    {
        if (CIBlockType::Delete($typeId)) {
            return true;
        }

        $this->throwException(__METHOD__, sprintf('Ошибка удаления типа инфоблока "%s"', $typeId));
    }

    /**
     * Получает языковые названия для типа инфоблока
     * @param $typeId
     * @return array
     */
    public function getIblockTypeLangs($typeId)
    {
        $result = [];
        $dbres = CLanguage::GetList($lby = 'sort', $lorder = 'asc');
        while ($item = $dbres->GetNext()) {
            $values = CIBlockType::GetByIDLang($typeId, $item['LID'], false);
            if (!empty($values)) {
                $result[$item['LID']] = [
                    'NAME' => $values['NAME'],
                    'SECTION_NAME' => $values['SECTION_NAME'],
                    'ELEMENT_NAME' => $values['ELEMENT_NAME'],
                ];
            }
        }
        return $result;
    }

    /**
     * Сохраняет тип инфоблока
     *
     * @param array $fields , обязательные параметры - тип инфоблока
     * @throws IblockHelperException
     * @return bool|mixed
     */
    public function saveIblockType($fields = [])
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['ID']);

        $exists= $this->getIblockType($fields['ID']);

        if (empty($exists)) {
            return $this->addIblockType($fields);
        }

        return false;
    }

    /**
     * @param $typeId
     * @throws IblockHelperException
     * @return array
     * @deprecated
     */
    public function findIblockType($typeId)
    {
        return $this->getIblockTypeIfExists($typeId);
    }

    /**
     * @param $typeId
     * @throws IblockHelperException
     * @return mixed
     * @deprecated
     */
    public function findIblockTypeId($typeId)
    {
        return $this->getIblockTypeIdIfExists($typeId);
    }

    protected function prepareExportIblockType($item)
    {
        if (empty($item)) {
            return $item;
        }

        return $item;
    }
}
