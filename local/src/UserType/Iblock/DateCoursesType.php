<?php

namespace InfoSystems\UserType\Iblock;

use WebArch\BitrixIblockPropertyType\Abstraction\IblockPropertyTypeBase;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class DateCoursesType
 *
 * Тип свойства "Даты проведения курсов" для ИБ
 *
 */
class DateCoursesType extends IblockPropertyTypeBase
{

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
        return 'Даты проведения курса';
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

        $html = '&nbsp;';
        $itemId = 'row_' . substr(md5($control['VALUE']), 0, 10); //ID для js
        $fieldName =  htmlspecialcharsbx($control['VALUE']);

        $html = '<div class="property_row" id="'. $itemId .'">';


        $dateFrom = ($value['VALUE']['DATETIME_FROM']) ? $value['VALUE']['DATETIME_FROM'] : '';
        $dateTo = ($value['VALUE']['DATETIME_TO']) ? $value['VALUE']['DATETIME_TO'] : '';

		$html .= '<div class="adm-input-wrap adm-input-wrap-calendar">';
        $html .='&nbsp; с&nbsp;<input type="text" name="'. $fieldName .'[DATETIME_FROM]" value="'. $dateFrom . '" >';
		$html .= '<span class="adm-calendar-icon" title="Нажмите для выбора даты" onclick="BX.calendar({node: this, field: this.previousElementSibling, bTime: true, bHideTime: false});"></span></div><div class="adm-input-wrap adm-input-wrap-calendar">';
        $html .='&nbsp;по&nbsp;<input type="text" name="'. $fieldName .'[DATETIME_TO]" value="'. $dateTo .'" >';
		$html .= '<span class="adm-calendar-icon" title="Нажмите для выбора даты" onclick="BX.calendar({node: this, field: this.previousElementSibling, bTime: true, bHideTime: false});"></span></div>';


        if($dateFrom!='' && $dateTo!='')
        {
            $html .= '&nbsp;&nbsp;<input type="button" style="height: auto;" value="x" title="Удалить" onclick="document.getElementById(\''. $itemId .'\').parentNode.parentNode.remove()" />';
        }

        $html .= '</div><br/>';

        return $html;
    }

    /**
     * @inheritdoc
     */
    public function convertToDB(array $property, array $value)
    {

		if ($value['VALUE']['DATETIME_FROM'] != '' && $value['VALUE']['DATETIME_TO']!='')
        {
            try {
                $value['VALUE'] = base64_encode(serialize($value['VALUE']));
            } catch(Bitrix\Main\ObjectException $exception) {
                echo $exception->getMessage();
            }
        } else {
            $value['VALUE'] = '';
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function convertFromDB(array $property, array $value)
    {

		if ($value['VALUE'] != '')
        {
            try {
                $value['VALUE'] = unserialize(base64_decode($value['VALUE']));
            } catch(Bitrix\Main\ObjectException $exception) {
                echo $exception->getMessage();
            }
        }

        return $value;
    }
}
?>