<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use Bitrix\Catalog\PriceTable;
use InfoSystems\Api\Response;
use InfoSystems\Tools\IblockTools;

class PriceController extends CatalogController
{
    public function add(int $xmlId)
    {
        $response = new Response();

        $data = Json::decode(file_get_contents("php://input"));

        $product = IblockTools::getElementByXml($xmlId);

        if (!$product) {
            throw new SystemException("Товар с внешним кодом {$xmlId} не найден");
        }
        $data['PRODUCT_ID'] = $product['ID'];

        $result = \Bitrix\Catalog\Model\Price::add($data);

        if (!$result->isSuccess()) {
            throw new SystemException(implode('.', $result->getErrorMessages()));
        }

        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return string
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public function edit(int $xmlId)
    {
        $response = new Response();

        $data = Json::decode(file_get_contents("php://input"));

        $product = IblockTools::getElementByXml($xmlId);

        if (!$product) {
            throw new SystemException("Товар с внешним кодом {$xmlId} не найден");
        }

        $data['PRODUCT_ID'] = $product['ID'];

        $price = $this->getPrice($product['ID']);

        if (!$price) {
            $result = \Bitrix\Catalog\Model\Price::add($data);
        } else {
            $result = \Bitrix\Catalog\Model\Price::update($price['ID'], $data);
        }

        if (!$result->isSuccess()) {
            throw new SystemException(implode('.', $result->getErrorMessages()));
        }

        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return string
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public function delete(int $xmlId)
    {
        $response = new Response();

        $product = IblockTools::getElementByXml($xmlId);

        if (!$product) {
            throw new SystemException(sprintf('Товар c XML_ID %s не найден', $xmlId));
        }

        $price = $this->getPrice($product['ID']);

        if (!$price) {
            throw new SystemException(sprintf('Цена для товара с ID %s не найдена', $product['ID']));
        }

        $result = \Bitrix\Catalog\Model\Price::delete($price['ID']);

        if (!$result->isSuccess()) {
            throw new SystemException($result->getErrorMessages());
        }
        return $response->get();
    }

    /**
     * @param int $productId
     * @return mixed
     */
    private function getPrice(int $productId)
    {
        return \Bitrix\Catalog\Model\Price::getList([
            'filter' => ['PRODUCT_ID' => $productId ],
            'limit' => 1
        ])->fetch();
    }
}
