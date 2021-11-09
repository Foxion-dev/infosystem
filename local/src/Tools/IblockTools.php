<?php

namespace InfoSystems\Tools;

use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\SystemException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentTypeException;

class IblockTools
{
    /**
     * @param string $type
     * @param string $code
     * @return mixed
     */
    public static function getIblockId(string $type, string $code)
    {
        $iblock = IblockTable::getList([
            'filter' => [
                'IBLOCK_TYPE_ID' => $type,
                'CODE' => $code
            ],
            'cache' => [
                'ttl' => 3600
            ],
            'limit' => 1
        ])->fetch();

        return $iblock['ID'];
    }

    /**
     * @param int $iblockId
     * @return mixed
     */
    public static function getIblock(int $iblockId)
    {
        return IblockTable::getList([
            'filter' => [
                '=ID' => $iblockId
            ],
            'select' => [
                'ID', 'CODE'
            ],
            'limit' => 1
        ])->fetch();
    }

    public static function getIblockByXml(int $xmlId)
    {
        return IblockTable::getList([
            'filter' => [
                '=XML_ID' => $xmlId
            ],
            'select' => [
                'ID', 'CODE'
            ],
            'limit' => 1
        ])->fetch();
    }

    /**
     * @param int $xmlId
     * @return bool|int
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function getElementByXml(int $xmlId)
    {
        return ElementTable::getList([
            'filter' => [
                '=XML_ID' => $xmlId
            ],
            'select' => [
                'ID'
            ],
            'limit' => 1
        ])->fetch();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function getElementById(int $id)
    {
        return ElementTable::getList([
            'filter' => [
                '=ID' => $id
            ],
            'select' => [
                'ID'
            ],
            'limit' => 1
        ])->fetch();
    }

    /**
     * @param array $xmlId
     * @return array
     */
    public static function getElementIds(array $xmlId)
    {
        $result = [];

        $elements = ElementTable::getList([
            'filter' => [
                '=XML_ID' => $xmlId
            ],
            'select' => [
                'ID'
            ]
        ])->fetchAll();

        foreach ($elements as $element) {
            $result[] = $element['ID'];
        }

        return $result;
    }

    /**
     * @param int $xmlId
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function getSectionByXml(int $xmlId)
    {
        return SectionTable::getList([
            'filter' => [
                '=XML_ID' => $xmlId
            ],
            'select' => [
                'ID'
            ],
            'limit' => 1
        ])->fetch();
    }

    /**
     * @param array $xmlId
     * @return mixed
     */
    public static function getSectionByArrXml(array $xmlId)
    {
        return SectionTable::getList([
            'filter' => [
                '=XML_ID' => $xmlId
            ],
            'select' => [
                'ID'
            ],
            'limit' => 1
        ])->fetchAll();
    }

    /**
     * @param int $elementId
     * @return array
     */
    public static function getElement(int $elementId): array
    {
        $result = [];

        $resElement = \CIBlockElement::GetList(
            ['ID' => 'ASC'],
            ['ID' => $elementId],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'PROPERTY_*']
        );
        while ($element = $resElement->GetNextElement()) {
            $result = $element->GetFields();
            $result['PROPERTIES'] = $element->GetProperties();

            $result['DETAIL_PAGE_URL'] = \CAllIBlock::ReplaceDetailUrl(
                $result['DETAIL_PAGE_URL'], $result, false, 'E'
            );
        }

        return $result;
    }

    public static function getElements(array $elementId): array
    {
        $result = [];

        $resElement = \CIBlockElement::GetList(
            ['ID' => 'ASC'],
            ['ID' => $elementId],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'PROPERTY_*']
        );
        while ($element = $resElement->GetNextElement()) {
            $fields = $element->GetFields();
            $fields['PROPERTIES'] = $element->GetProperties();

            $fields['DETAIL_PAGE_URL'] = \CAllIBlock::ReplaceDetailUrl(
                $fields['DETAIL_PAGE_URL'], $result, false, 'E'
            );

            $result[] = $fields;
        }

        return $result;
    }

    /**
     * @param $iblockId
     * @param $elementId
     * @return mixed
     */
    public function getProperties($iblockId, $elementId)
    {
        $properties = \Bitrix\Iblock\PropertyTable::getList([
            'filter' => [
                '=IBLOCK_ID' => $iblockId
            ]
        ])->fetchAll();

        foreach ($properties as &$property) {
            $elementProperties = \Bitrix\Iblock\ElementPropertyTable::getList([
                'filter' => [
                    'IBLOCK_ELEMENT_ID' => $elementId,
                    'IBLOCK_PROPERTY_ID' => $property['ID']
                ]
            ]);

            if ($property['MULTIPLE'] == 'Y') {
                $elementProperties = $elementProperties->fetchAll();
                $property['VALUE'] = array_column($elementProperties, 'VALUE');
            } else {
                $elementProperty = $elementProperties->fetch();
                $property['VALUE'] = $elementProperty['VALUE'];
            }

            switch ($property['USER_TYPE']) {
                case 'HTML':
                    $property['VALUE'] = unserialize($property['VALUE']);
                    break;
            }
        }

        return $properties;
    }
}
