<?php

namespace InfoSystems\Iblock\Traits;

use CIBlock;
use InfoSystems\Iblock\Exception\IblockHelperException;

trait IblockTrait
{
    /**
     * Получает инфоблок, бросает исключение если его не существует
     *
     * @param $code string|array - код или фильтр
     * @param string $typeId
     *
     * @throws IblockHelperException
     * @return array|void
     */
    public function getIblockIfExists($code, $typeId = '')
    {
        $item = $this->getIblock($code, $typeId);
        if ($item && isset($item['ID'])) {
            return $item;
        }
        $this->throwException(__METHOD__, 'Инфоблок не найден');
    }

    /**
     * Получает id инфоблока, бросает исключение если его не существует
     *
     * @param $code string|array - код или фильтр
     * @param string $typeId
     *
     * @throws IblockHelperException
     * @return int|void
     */
    public function getIblockIdIfExists($code, $typeId = '')
    {
        $item = $this->getIblock($code, $typeId);
        if ($item && isset($item['ID'])) {
            return $item['ID'];
        }
        $this->throwException(__METHOD__, 'Инфоблок не найден');
    }

    /**
     * Получает инфоблок
     *
     * @param $code int|string|array - id, код или фильтр
     * @param string $typeId
     *
     * @return array|false
     */
    public function getIblock($code, $typeId = '')
    {
        if (is_array($code)) {
            $filter = $code;
        } elseif (is_numeric($code)) {
            $filter = ['ID' => $code];
        } else {
            $filter = ['=CODE' => $code];
        }

        if (!empty($typeId)) {
            $filter['=TYPE'] = $typeId;
        }

        $filter['CHECK_PERMISSIONS'] = 'N';

        $item = CIBlock::GetList(['SORT' => 'ASC'], $filter)->Fetch();
        return $this->prepareIblock($item);
    }

    /**
     * Получает список сайтов для инфоблока
     *
     * @param $iblockId
     *
     * @return array
     */
    public function getIblockSites($iblockId)
    {
        $dbres = CIBlock::GetSite($iblockId);
        return $this->fetchAll($dbres, false, 'LID');
    }

    /**
     * Получает id инфоблока
     *
     * @param $code string|array - код или фильтр
     * @param string $typeId
     *
     * @return int
     */
    public function getIblockId($code, $typeId = '')
    {
        $iblock = $this->getIblock($code, $typeId);
        return ($iblock && isset($iblock['ID'])) ? $iblock['ID'] : 0;
    }

    /**
     * Получает список инфоблоков
     *
     * @param array $filter
     *
     * @return array
     */
    public function getIblocks($filter = [])
    {
        $filter['CHECK_PERMISSIONS'] = 'N';

        $dbres = CIBlock::GetList(['SORT' => 'ASC'], $filter);
        $list = [];
        while ($item = $dbres->Fetch()) {
            $list[] = $this->prepareIblock($item);
        }
        return $list;
    }

    /**
     * Добавляет инфоблок если его не существует
     *
     * @param array $fields , обязательные параметры - код, тип инфоблока, id сайта
     *
     * @throws IblockHelperException
     * @return int|void
     */
    public function addIblockIfNotExists($fields = [])
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['CODE', 'IBLOCK_TYPE_ID', 'LID']);

        $typeId = false;
        if (!empty($fields['IBLOCK_TYPE_ID'])) {
            $typeId = $fields['IBLOCK_TYPE_ID'];
        }

        $iblock = $this->getIblock($fields['CODE'], $typeId);
        if ($iblock) {
            return $iblock['ID'];
        }

        return $this->addIblock($fields);
    }

    /**
     * Добавляет инфоблок
     *
     * @param $fields , обязательные параметры - код, тип инфоблока, id сайта
     *
     * @throws IblockHelperException
     * @return int|void
     */
    public function addIblock($fields)
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['CODE', 'IBLOCK_TYPE_ID', 'LID']);

        $default = [
            'ACTIVE'           => 'Y',
            'NAME'             => '',
            'CODE'             => '',
            'LIST_PAGE_URL'    => '',
            'DETAIL_PAGE_URL'  => '',
            'SECTION_PAGE_URL' => '',
            'SORT'             => 500,
            'GROUP_ID'         => ['2' => 'R'],
            'VERSION'          => 2,
            'BIZPROC'          => 'N',
            'WORKFLOW'         => 'N',
            'INDEX_ELEMENT'    => 'N',
            'INDEX_SECTION'    => 'N',
        ];

        $fields = array_replace_recursive($default, $fields);

        $ib = new CIBlock;
        $iblockId = $ib->Add($fields);

        if ($iblockId) {
            return $iblockId;
        }
        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * Обновляет инфоблок
     *
     * @param $iblockId
     * @param array $fields
     *
     * @throws IblockHelperException
     * @return int|void
     */
    public function updateIblock($iblockId, $fields = [])
    {
        $ib = new CIBlock;
        if ($ib->Update($iblockId, $fields)) {
            return $iblockId;
        }

        $this->throwException(__METHOD__, $ib->LAST_ERROR);
    }

    /**
     * Обновляет инфоблок если он существует
     *
     * @param       $code
     * @param array $fields
     *
     * @throws IblockHelperException
     * @return bool|int|void
     */
    public function updateIblockIfExists($code, $fields = [])
    {
        $iblock = $this->getIblock($code);
        if (!$iblock) {
            return false;
        }
        return $this->updateIblock($iblock['ID'], $fields);
    }

    /**
     * Удаляет инфоблок если он существует
     *
     * @param        $code
     * @param string $typeId
     *
     * @throws IblockHelperException
     * @return bool|void
     */
    public function deleteIblockIfExists($code, $typeId = '')
    {
        $iblock = $this->getIblock($code, $typeId);
        if (!$iblock) {
            return false;
        }
        return $this->deleteIblock($iblock['ID']);
    }

    /**
     * Удаляет инфоблок
     *
     * @param $iblockId
     *
     * @throws IblockHelperException
     * @return bool|void
     */
    public function deleteIblock($iblockId)
    {
        if (CIBlock::Delete($iblockId)) {
            return true;
        }

        $this->throwException(
            __METHOD__, sprintf('Ошибка удаления инфоблока "%s"', $iblockId)
        );
    }

    /**
     * Сохраняет инфоблок
     *
     * @param array $fields , обязательные параметры - код, тип инфоблока, id сайта
     *
     * @throws IblockHelperException
     * @return bool|mixed
     */
    public function saveIblock($fields = [])
    {
        $this->checkRequiredKeys(__METHOD__, $fields, ['CODE', 'IBLOCK_TYPE_ID', 'LID']);

        $item = $this->getIblock($fields['CODE'], $fields['IBLOCK_TYPE_ID']);

        if (empty($item)) {
            return $this->addIblock($fields);
        }

        return false;
    }

    /**
     * Получает права доступа к инфоблоку для групп
     * возвращает массив вида [$groupCode => $letter]
     *
     * @param $iblockId
     *
     * @return array
     */
    public function getGroupPermissions($iblockId)
    {
        return CIBlock::GetGroupPermissions($iblockId);
    }

    /**
     * Устанавливает права доступа к инфоблоку для групп
     * предыдущие права сбрасываются
     * принимает массив вида [$groupCode => $letter]
     *
     * @param $iblockId
     * @param array $permissions
     */
    public function setGroupPermissions($iblockId, $permissions = [])
    {
        CIBlock::SetPermission($iblockId, $permissions);
    }

    /**
     * @param $iblock int|array
     *
     * @throws IblockHelperException
     * @return string|void
     */
    public function getIblockUid($iblock)
    {
        if (!is_array($iblock)) {
            //на вход уже пришел uid
            if (false !== strpos($iblock, ':')) {
                return $iblock;
            }

            //на вход пришел id или код инфоблока
            $iblock = $this->getIblock($iblock);
        }

        if (!empty($iblock['IBLOCK_TYPE_ID']) && !empty($iblock['CODE'])) {
            return $iblock['IBLOCK_TYPE_ID'] . ':' . $iblock['CODE'];
        }

        $this->throwException(__METHOD__, Locale::getMessage('ERR_IB_NOT_FOUND'));
    }

    /**
     * @param $iblockUid
     *
     * @return int
     */
    public function getIblockIdByUid($iblockUid)
    {
        $iblockId = 0;

        if (empty($iblockUid)) {
            return $iblockId;
        }

        list($type, $code) = explode(':', $iblockUid);
        if (!empty($type) && !empty($code)) {
            $iblockId = $this->getIblockId($code, $type);
        }

        return $iblockId;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    protected function prepareIblock($item)
    {
        if (empty($item['ID'])) {
            return $item;
        }
        $item['LID'] = $this->getIblockSites($item['ID']);

        $messages = CIBlock::GetMessages($item['ID']);
        $item = array_merge($item, $messages);
        return $item;
    }
}
