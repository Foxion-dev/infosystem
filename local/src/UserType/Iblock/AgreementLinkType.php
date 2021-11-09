<?php

namespace InfoSystems\UserType\Iblock;

use WebArch\BitrixIblockPropertyType\Abstraction\IblockPropertyTypeBase;
use Bitrix\Main\UserConsent\Agreement;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class AgreementLinkType
 *
 * Тип свойства "Привязка к пользовательскому соглашению" для ИБ
 *
 */
class AgreementLinkType extends IblockPropertyTypeBase
{
    /**
     * @var array
     */
    protected static $agreements = [];

    /**
     * @inheritdoc
     */
    public function getPropertyType()
    {
        return self::PROPERTY_TYPE_STRING;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'Привязка к пользовательскому соглашению';
    }

    /**
     * @inheritdoc
     */
    public function getCallbacksMapping()
    {
        return [
            'GetPropertyFieldHtml' => [$this, 'getPropertyFieldHtml'],
            'ConvertToDB'          => [$this, 'convertToDB'],
            'ConvertFromDB'        => [$this, 'convertFromDB'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPropertyFieldHtml(array $property, array $value, array $control)
    {
        $return = '&nbsp;';

        $return = static::getAgreementListHTML($control['VALUE'], $value['VALUE']);

        return $return;
    }

    /**
     * @inheritdoc
     */
    public function convertToDB(array $property, array $value)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function convertFromDB(array $property, array $value)
    {
        return $value;
    }
   
    /**
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    protected static function getAgreementList(): array
    {
        if (empty(static::$agreements)) {
            static::$agreements = Agreement::getActiveList();
        }

        return static::$agreements;
    }

    /**
     * @param $name
     * @param null $current
     * @return string
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    protected static function getAgreementListHTML($name, $current = null): string
    {
        $agreements = static::getAgreementList();

        $return = '<select name="' . $name . '">';
        $return .= '<option>Не установлено</option>';
        foreach ($agreements as $id => $agreement) {
            $selected = $id == $current ? 'selected="selected"' : '';
            $return .= '<option value="' . $id . '" ' . $selected . '>';
            $return .= '[' . $id . '] ' . $agreement;
            $return .= '</option>';
        }
        $return .= '</select>';

        return $return;
    }
}
