<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Response;
use InfoSystems\Tools\IblockTools;

class ProductController extends CatalogController
{
    /**
     * @param int $xmlId
     * @return mixed
     */
    public function add(int $xmlId)
    {
        $response = new Response();

        $product = IblockTools::getElementByXml($xmlId);

        if (!$product) {
            throw new SystemException(sprintf('Товар c XML_ID %s не найден', $xmlId));
        }

        $data = Json::decode(file_get_contents("php://input"));

        $data['ID'] = $product['ID'];

        $result = \Bitrix\Catalog\Model\Product::add($data);

        if (!$result->isSuccess()) {
            throw new SystemException($result->getErrorMessages());
        }

        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return mixed
     */
    public function edit(int $xmlId)
    {
        $response = new Response();

        $product = IblockTools::getElementByXml($xmlId);

        if (!$product) {
            throw new SystemException(sprintf('Товар c XML_ID %s не найден', $xmlId));
        }

        $data = Json::decode(file_get_contents("php://input"));

        $data = $this->prepareData($data);

        $result = \Bitrix\Catalog\Model\Product::update($product['ID'], $data);

        if (!$result->isSuccess()) {
            throw new SystemException($result->getErrorMessages());
        }

        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return mixed
     */
    public function delete(int $xmlId)
    {
        $response = new Response();

        $product = IblockTools::getElementByXml($xmlId);

        if (!$product) {
            throw new SystemException(sprintf('Товар c XML_ID %s не найден', $xmlId));
        }

        $result = \Bitrix\Catalog\Model\Product::delete($product['ID']);

        if (!$result->isSuccess()) {
            throw new SystemException($result->getErrorMessages());
        }

        return $response->get();
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepareData(array $data)
    {
        unset($data['ID']);

        return $data;
    }

}
