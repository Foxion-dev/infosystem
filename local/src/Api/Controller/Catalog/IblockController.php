<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Response;
use InfoSystems\Tools\IblockTools;
use Sprint\Migration\Exceptions\HelperException;
use Sprint\Migration\HelperManager;
use InfoSystems\File\Helpers\FileHelper;

class IblockController extends CatalogController
{
    public function edit($xmlId)
    {
        $response = new Response();
        try {

            $params = Json::decode(file_get_contents("php://input"));

            $iblock = IblockTools::getIblockByXml($xmlId);

            if ($iblock === false) {
                throw new SystemException('Инфоблок не найден');
            }

            $this->helper->Iblock()->updateIblockIfExists($iblock['CODE'], $this->prepareData($params));

        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }
        return $response->get();
    }

    private function prepareData(array $data)
    {
        if ($data['IBLOCK_TYPE_ID'] === 'CRM_PRODUCT_CATALOG') {
            $data['IBLOCK_TYPE_ID'] = 'catalog';
        }

        unset($data['XML_ID']);

        return $data;
    }
}
