<?php
use Bitrix\Main\Loader;
use Bitrix\Iblock\PropertyTable;
use InfoSystems\App\Component\BaseComponentAbstract;
use InfoSystems\Tools\IblockTools;

class ScheduleDetailComponent extends BaseComponentAbstract
{
    /**
     * ScheduleDetailComponent constructor.
     * @param CBitrixComponent|null $parentComponent
     */
    public function __construct(?CBitrixComponent $parentComponent = null)
    {
        global $APPLICATION, $USER;

        if (!$USER->IsAuthorized()) {
            $APPLICATION->AuthForm('', false, false, 'N', false);

            return false;
        }

        $this->includeModules();

        parent::__construct($parentComponent); 
    }

    public function includeModules()
    {
        return Loader::includeModule('iblock');
    }

    /**
     * @param array $params
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        $params['ELEMENT_ID'] = isset($params['ELEMENT_ID']) ? trim($params['ELEMENT_ID']) : '';

        $params = parent::onPrepareComponentParams($params);

        return $params;
    }

    protected function componentBody(): void
    {
        $params =& $this->arParams;
        $result =& $this->arResult;

        if ($params['ELEMENT_ID']) {
            $result['ELEMENT'] = $this->getElement($params['ELEMENT_ID']);

            if ($result['ELEMENT']) {
                $this->obtainProps();
                $this->obtainMetaTags();
                $this->obtainNavChain();
            } else {
                $this->define404();
            }
        }
    }

    /**
     * @return void
     */
    protected function obtainInhProps(): void
    {
        $result =& $this->arResult;
        if (!isset($result['IPROPERTY_VALUES']) && $result['ELEMENT']) {
            $inhPropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
                $result['ELEMENT']['IBLOCK_ID'],
                $result['ELEMENT']['ID']
            );
            $result['IPROPERTY_VALUES'] = $inhPropValues->getValues();
        }
    }

    /**
     * @return void
     */
    protected function obtainMetaTags(): void
    {
        $result =& $this->arResult;
        $params =& $this->arParams;

        if ($params['SET_TITLE'] === 'Y') {
            $result['META_TAGS']['TITLE'] = $this->getPageTitle();
        }

        if ($params['SET_BROWSER_TITLE'] === 'Y') {
            $result['META_TAGS']['BROWSER_TITLE'] = $this->getBrowserTitle();
        }

        if ($params['SET_META_KEYWORDS'] === 'Y') {
            $result['META_TAGS']['KEYWORDS'] = $this->getMetaKeywords();
        }

        if ($params['SET_META_DESCRIPTION'] === 'Y') {
            $result['META_TAGS']['DESCRIPTION'] = $this->getMetaDescription();
        }
    }

    /**
     * @return string
     */
    protected function getPageTitle(): string
    {
        $result =& $this->arResult;
        $this->obtainInhProps();
        $inhPropVal = $result['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] ?? '';

        return $inhPropVal !== '' ? $inhPropVal : $result['ELEMENT']['NAME'];
    }

    /**
     * @return string
     */
    protected function getBrowserTitle(): string
    {
        $result =& $this->arResult;
        $this->obtainInhProps();
        $inhPropVal = $result['IPROPERTY_VALUES']['ELEMENT_META_TITLE'] ?? '';

        return $inhPropVal !== '' ? $inhPropVal : $result['ELEMENT']['NAME'];
    }

    /**
     * @return string
     */
    protected function getMetaKeywords(): string
    {
        $result =& $this->arResult;
        $this->obtainInhProps();
        $inhPropVal = $result['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS'] ?? '';
        $propVal = $result['ELEMENT']['PROPERTIES']['META_KEYWORDS']['VALUE'] ?? '';

        return $inhPropVal !== '' ? $inhPropVal : $propVal;
    }

    /**
     * @return string
     */
    protected function getMetaDescription(): string
    {
        $result =& $this->arResult;
        $this->obtainInhProps();
        $inhPropVal = $result['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION'] ?? '';
        $propVal = $result['ELEMENT']['PROPERTIES']['META_DESCRIPTION']['VALUE'] ?? '';

        return $inhPropVal !== '' ? $inhPropVal : $propVal;
    }

    /**
     * @return void
     */
    protected function obtainNavChain(): void
    {
        $result =& $this->arResult;
        $params =& $this->arParams;

        $result['NAV_CHAIN'] = [];
        if ($result['SECTION']) {
            $this->obtainInhProps();
            $inhPropVal = $result['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] ?? '';
            $result['NAV_CHAIN'][] = [
                'TITLE' => $inhPropVal !== '' ? $inhPropVal : $result['SECTION']['NAME'],
                'LINK' => $result['SECTION']['SECTION_PAGE_URL'],
            ];
        }

        if ($params['ADD_ELEMENT_CHAIN'] === 'Y') {
            $this->obtainInhProps();
            $inhPropVal = $result['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] ?? '';
            $result['NAV_CHAIN'][] = [
                'TITLE' => $inhPropVal !== '' ? $inhPropVal : $result['ELEMENT']['NAME'],
                'LINK' => $result['ELEMENT']['DETAIL_PAGE_URL'],
            ];
        }
    }

    /**
     * @return void
     */
    protected function obtainProps(): void
    {
        $result =& $this->arResult;
        foreach ($result['ELEMENT']['PROPERTIES'] as &$property) {
            if ($property['VALUE']) {
                switch ($property['PROPERTY_TYPE']) {
                    case PropertyTable::TYPE_ELEMENT:
                        $property['VALUE'] = $this->getElement($property['VALUE']);
                        break;
                }
                switch ($property['USER_TYPE']) {
                    case 'UserID':
                        $entity = \Bitrix\Main\UserTable::getList([
                            'filter' => ['=ID' => $property['VALUE']],
                            'select' => ['*','UF_*']
                        ]);
                        if ($property['MULTIPLE'] == 'Y') {
                            $property['VALUE'] = $entity->fetchAll();
                        } else {
                            $property['VALUE'] = $entity->fetch();
                        }

                        break;
                }
            }
        }
    }

    /**
     * @param int $elementId
     * @return array
     */
    protected function getElement($elementId): array
    {
        $result = [];

        if (!$elementId) {
            return $result;
        }

        $items = \CIBlockElement::GetList(
            ['ID' => 'ASC',],
            ['=ID' => $elementId],
            false,
            false,
            [
                'ID', 'IBLOCK_ID',
                'NAME',
                'DETAIL_PAGE_URL',
                'DETAIL_PICTURE',
                'PREVIEW_PICTURE',
                'PROPERTY_*',
            ]
        );
        if ($item = $items->GetNextElement(true, false)) {
            $fields = $item->GetFields();
            $fields['PROPERTIES'] = $item->GetProperties();
            if ($fields['DETAIL_PICTURE']) {
                $fields['DETAIL_PICTURE'] = \CFile::GetFileArray($fields['DETAIL_PICTURE']);
            }
            if ($fields['PREVIEW_PICTURE']) {
                $fields['PREVIEW_PICTURE'] = \CFile::GetFileArray($fields['PREVIEW_PICTURE']);
            }
            if (is_array($elementId)) {
                $result[] = $fields;
            } else {
                $result = $fields;
            }
        }

        return $result;
    }
}
