<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use Bitrix\Main\Application;
use Sprint\Migration\Exceptions\HelperException;
use InfoSystems\Api\Response;
use InfoSystems\Tools\IblockTools;

class SectionController extends CatalogController
{
    const FIELDS_IMAGE = [
        'PICTURE'
    ];

    /**
     * @param int $xmlId
     * @return string
     */
    public function add(int $xmlId)
    {
        $response = new Response();
        try {
            $data = Json::decode(file_get_contents("php://input"));

            $data = $this->prepareData($data);

            $section = IblockTools::getSectionByXml($xmlId);

            if ($data['IBLOCK_SECTION_ID']) {
                $parentSection = IblockTools::getSectionByXml((int)$data['IBLOCK_SECTION_ID']);
                if ($parentSection) {
                    $data['IBLOCK_SECTION_ID'] = $parentSection['ID'];
                }
            }
            \Bitrix\Main\Diag\Debug::writeToFile($data, __METHOD__ . ':' . __LINE__);
            if (is_array($section)) {
                $this->helper->Iblock()->updateSection($section['ID'], $data);
            } else {
                $this->helper->Iblock()->addSection($this->iblockId, $data);
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

            $data = $this->prepareData($data);

            $section = IblockTools::getSectionByXml($xmlId);

            if (!is_array($section)) {
                throw new SystemException('Раздел не найден');
            }

            if ($data['IBLOCK_SECTION_ID']) {
                $parentSection = IblockTools::getSectionByXml((int)$data['IBLOCK_SECTION_ID']);
                if ($parentSection) {
                    $data['IBLOCK_SECTION_ID'] = $parentSection['ID'];
                }
            }

            $sectionId = $this->helper->Iblock()->updateSection($section['ID'], $data);

            $response->setData(['sectionId' => $sectionId]);
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

            $section = IblockTools::getSectionByXml($xmlId);

            if (!is_array($section)) {
                throw new SystemException('Раздел не найден');
            }

            $this->helper->Iblock()->deleteSection($section['ID']);

            $response->setStatus($response::STATUS_SUCCESS);
        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->addError($exception->getMessage());
        }

        return $response->get();
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepareData(array $data)
    {
        $data['XML_ID'] = $data['ID'];

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
        return $data;
    }
    
}
