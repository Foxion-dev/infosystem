<?php

namespace InfoSystems\Forms;

class FormsManager
{
    /**
     * @param int $formId
     * @param array $data
     * @return mixed
     */
    public static function resultAdd(int $formId, array $data)
    {
        $resultId = \CFormResult::Add($formId, $data);

        if ($resultId) {
            \CFormResult::SetEvent($resultId);
            \CFormResult::Mail($resultId);
        } else {
            global $strError;
            throw new \Bitrix\Main\SystemException($strError);
        }

        return $resultId;
    }

    /**
     * Проверка полей
     *
     * @param int $formId
     * @param array $data
     */
    public static function checkForm(int $formId, array $data)
    {
        $errors = \CForm::Check($formId, $data, false, 'Y', 'Y');

        if ($errors) {
            throw new \Bitrix\Main\SystemException(implode('<br/> ', $errors));
        }
    }

    /**
     * Список ответов
     *
     * @param int $formId
     * @param int $resultId
     * @return array
     */
    public static function getResultAnswer(int $formId, int $resultId): array
    {
        $arrAnswers = [];
        $arrColumns = [];
        $arrAnswersSID = [];

        \CForm::GetResultAnswerArray(
            $formId,
            $arrColumns,
            $arrAnswers,
            $arrAnswersSID,
            ['RESULT_ID' => $resultId]
        );

        $arrAnswersSID = current($arrAnswersSID);
        foreach ($arrAnswersSID as &$arrAnswer) {
            $arrAnswer = current($arrAnswer);
        }

        return $arrAnswersSID;
    }
}
