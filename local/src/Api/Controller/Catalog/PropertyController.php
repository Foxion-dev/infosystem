<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use Sprint\Migration\Exceptions\HelperException;
use InfoSystems\Api\Response;

class PropertyController extends CatalogController
{
    public function add()
    {
        $response = new Response();
        try {
            $fields = Json::decode(file_get_contents("php://input"));

            $this->helper->Iblock()->addProperty($this->iblockId, $this->prepareData($fields));

        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }
        return $response->get();
    }

    public function edit()
    {
        $response = new Response();
        try {
            $fields = Json::decode(file_get_contents("php://input"));
            
            $property = $this->helper->Iblock()->updatePropertyIfExists(
                $this->iblockId,
                $fields['CODE'],
                $this->prepareData($fields)
            );

            if ($property === false) {
                throw new SystemException(
                    sprintf('Свойство %s не найдено', $fields['CODE'])
                );
            }
        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }
        return $response->get();
    }

    /**
     * @param string $code
     * @return string
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\SystemException
     */
    public function delete(string $code)
    {
        $response = new Response();
        try {
            $property = $this->helper->Iblock()->deletePropertyIfExists($this->iblockId, $code);

            if ($property === false) {
                throw new SystemException(
                    sprintf('Свойство %s не найдено', $code)
                );
            }
        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }
        return $response->get();
    }

    /**
     * @param array $data
     * @return array
     */
    public function prepareData(array $data)
    {
        if ($data['LINK_IBLOCK_ID']) {
            \Bitrix\Main\Diag\Debug::writeToFile($data, __METHOD__.':'.__LINE__);

            $iblock = IblockTable::getList([
                'filter' => ['XML_ID' => $data['LINK_IBLOCK_ID']],
                'limit' => 1
                ])->fetch();

            if (!$iblock) {
                throw new SystemException('Инфоблок для привязки не найден');
            }
            $data['LINK_IBLOCK_ID'] = $iblock['ID'];
        }
        if ($data['IBLOCK_ID']) {
            unset($data['IBLOCK_ID']);
        }

        return $data;
    }
}
