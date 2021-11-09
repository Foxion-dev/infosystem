<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Response;
use InfoSystems\Tools\IblockTools;

class ElementController extends CatalogController
{
    const FIELDS_IMAGE = [
        'PREVIEW_PICTURE',
        'DETAIL_PICTURE'
    ];

    /**
     * @return string
     */
    public function add()
    {
        $response = new Response();
        try {
            $data = Json::decode(file_get_contents("php://input"));

            $data = $this->prepareData($data);

            $elementId = $this->helper->Iblock()->addElement($this->iblockId, $data);

            if ($elementId) {
                $response->setData(['elementId' => $elementId]);
            }

        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }

        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return string
     */
    public function edit(int $xmlId)
    {
        $response = new Response();
        try {
            $data = Json::decode(file_get_contents("php://input"));

            $element = IblockTools::getElementByXml($xmlId);

            if (!is_array($element)) {
                throw new SystemException("Элемент с внешним кодом {$xmlId} не найден");
            }

            $data = $this->prepareData($data, $element['ID']);

            $this->helper->Iblock()->updateElement($element['ID'], $data);

        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }
        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return string
     */
    public function delete(int $xmlId)
    {
        $response = new Response();

        try {
            $element = IblockTools::getElementByXml($xmlId);

            if (!is_array($element)) {
                throw new SystemException("Элемент с внешним кодом {$xmlId} не найден");
            }

            $this->helper->Iblock()->deleteElement($element['ID']);
        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }
        return $response->get();
    }

    /**
     * @param array $data
     * @param null $elementId
     * @return array
     */
    private function prepareData(array $data, $elementId = null)
    {
        if ($data['ID']) {
            $data['XML_ID'] = $data['ID'];
            unset ($data['ID']);
        }

        foreach (self::FIELDS_IMAGE as $field) {
            $fileArray = [];
            if ($data[$field]['src']) {
                $fileArray = \CFile::MakeFileArray($data[$field]['src']);
            }
            if ($data[$field]['del']) {
                $fileArray['del'] = $data[$field]['del'];
            }
            $data[$field] = $fileArray;
        }
        if ($data['IBLOCK_SECTION']) {
            $sections = [];
            foreach ($data['IBLOCK_SECTION'] as $sectionXml) {
                $section = IblockTools::getSectionByXml((int)$sectionXml);
                if (!$section) {
                    throw new SystemException("Раздел с внешним кодом {$sectionXml} не найден");
                }
                $sections[] = $section['ID'];
            }
            $data['IBLOCK_SECTION'] = $sections;
        }
        foreach ($data['PROPERTY_VALUES'] as $propertyCode => &$propertyValue) {
            if ($propertyCode === 'RECOMMEND') {
                $propertyValue = '';
                continue;
            }
            $property = \Bitrix\Iblock\PropertyTable::getList([
                'filter' => [
                    '=IBLOCK_ID' => $this->iblockId,
                    '=CODE' => $propertyCode
                ],
                'limit' => 1
            ])->fetch();

            switch ($property['PROPERTY_TYPE']) {
                case PropertyTable::TYPE_LIST:
                    foreach ($propertyValue as &$value) {
                        $propertyEnum = \Bitrix\Iblock\PropertyEnumerationTable::getList([
                            'filter' => [
                                '=PROPERTY_ID' => $property['ID'],
                                '=VALUE' => $value['VALUE']
                            ],
                            'limit' => 1
                        ])->fetch();
                        if ($propertyEnum) {
                            $value['VALUE'] = $propertyEnum['ID'];
                        }
                    }
                    break;

                case PropertyTable::TYPE_ELEMENT:

                    foreach ($propertyValue as &$linkElement) {

                        if (!$linkElement['VALUE']) {
                            continue;
                        }

                        $element = IblockTools::getElementByXml((int)$linkElement['VALUE']);

                        if (!$element) {
                            throw new SystemException("Элемент с внешним кодом {$linkElement['VALUE']} для привязки к свойству {$property['NAME']} не найден");
                        }
                        $linkElement['VALUE'] = $element['ID'];
                    }
                    break;

                case PropertyTable::TYPE_SECTION:
                    foreach ($propertyValue as &$linkSection) {
                        if (!$linkSection['VALUE']) {
                            continue;
                        }
                        if (!$section = IblockTools::getSectionByXml($linkSection['VALUE'])) {
                            throw new SystemException("Раздел с внешним кодом {$linkSection['VALUE']} для привязки к свойству {$property['NAME']} не найден");
                        }
                        $linkSection['VALUE'] = $section['ID'];
                    }
                    break;

                case PropertyTable::TYPE_FILE:

                    if ($elementId) {
                        $this->deletePropertyFileValue($elementId, $property['ID']);
                    }
                    foreach ($propertyValue as &$value) {
                        if ($value['src']) {
                            $value = \CFile::MakeFileArray($value['src']);
                        }
                    }
                    break;

                case PropertyTable::TYPE_STRING:

                    switch ($property['USER_TYPE']) {

                        case 'UserID':

                            foreach ($propertyValue as &$value) {
                                $user = \Bitrix\Main\UserTable::getList([
                                    'filter' => ['=XML_ID' => $value['VALUE']],
                                    'select' => ['ID']
                                ])->fetch();

                                if (!$user) {
                                    throw new SystemException(
                                        sprintf("Пользователь с внешним кодом %s не найден", $value['VALUE'])
                                    );
                                }

                                $value['VALUE'] = $user['ID'];
                            }

                            break;

                    }

                    break;
            }
        }

        return $data;
    }

    /**
     * @param $elementId
     * @param $propertyId
     */
    private function deletePropertyFileValue($elementId, $propertyId)
    {
        $elementProperties = \Bitrix\Iblock\ElementPropertyTable::getList([
            'filter' => [
                'IBLOCK_ELEMENT_ID' => $elementId,
                'IBLOCK_PROPERTY_ID' => $propertyId
            ]
        ])->fetchAll();

        foreach ($elementProperties as $elementProperty) {

            $result = \Bitrix\Iblock\ElementPropertyTable::delete($elementProperty['ID']);

            if (!$result->isSuccess()) {
                throw new SystemException("Ошибка удаления записи с ID {$elementProperty['ID']} из таблицы b_iblock_element_property");
            }

            \CFile::Delete($elementProperty['VALUE']);
        }
    }
}
