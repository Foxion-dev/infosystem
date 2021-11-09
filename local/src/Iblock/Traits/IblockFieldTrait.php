<?php

namespace InfoSystems\Iblock\Traits;

use CIBlock;

trait IblockFieldTrait
{
    /**
     * Получает список полей инфоблока
     *
     * @param $iblockId
     *
     * @return array|bool
     */
    public function getIblockFields($iblockId)
    {
        return CIBlock::GetFields($iblockId);
    }

    /**
     * Сохраняет поля инфоблока
     *
     * @param       $iblockId
     * @param array $fields
     *
     * @return bool
     */
    public function saveIblockFields($iblockId, $fields = [])
    {
        $exists = CIBlock::GetFields($iblockId);

        if (empty($exists)) {
            return $this->updateIblockFields($iblockId, $fields);
        }

        return false;
    }

    /**
     * Обновляет поля инфоблока
     *
     * @param $iblockId
     * @param $fields
     *
     * @return bool
     */
    public function updateIblockFields($iblockId, $fields)
    {
        if ($iblockId && !empty($fields)) {
            CIBlock::SetFields($iblockId, $fields);
            return true;
        }
        return false;
    }

    /**
     * @param $iblockId
     * @param $fields
     *
     * @deprecated
     */
    public function mergeIblockFields($iblockId, $fields)
    {
        $this->saveIblockFields($iblockId, $fields);
    }
}
