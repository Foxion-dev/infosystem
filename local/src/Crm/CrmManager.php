<?php

namespace InfoSystems\Crm;

class CrmManager
{
    /**
     * Поиск контактов по E-mail
     *
     * @param string $email
     *
     * @return array|null
     */
    public static function getContactsByEmail(string $email): ?array
    {
        $result = \CRest::call('crm.duplicate.findbycomm', [
            'type' => 'EMAIL',
            'values' => [$email]
        ]);

        if(is_array($result['result']['CONTACT']))
        {
            return self::getContacts($result['result']['CONTACT']);
        }

        return null;
    }

    /**
     * Поиск контактов по телевфону
     *
     * @param string $phone
     *
     * @return array|null
     */
    public static function getContactsByPhone(string $phone): ?array
    {
        $result = \CRest::call('crm.duplicate.findbycomm', [
            'type' => 'PHONE',
            'values' => [$phone]
        ]);

        if(is_array($result['result']['CONTACT']))
        {
            return self::getContacts($result['result']['CONTACT']);
        }

        return null;
    }

    /**
     * @param array $contactId
     * @return array|null
     */
    public static function getContacts(array $contactId): ?array
    {
        $result = \CRest::call('crm.contact.list', [
            'filter' => [
                'ID' => $contactId
            ],
            'select' => [
                'ID', 'NAME', 'LAST_NAME', 'PHONE', 'EMAIL'
            ]
        ]);

        if (!empty($result)) {
            return $result['result'];
        }

        return null;
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public static function createLead(array $fields)
    {
        $deal = \CRest::call('crm.lead.add', ['fields' => $fields]);

        return $deal['result'];
    }

    public static function createDeal(array $fields)
    {
        $deal = \CRest::call('crm.deal.add', ['fields' => $fields]);

        return $deal['result'];
    }

    /**
     * @param int $dealId
     * @param array $data
     * @return array
     */
    public static function setProductDeal(int $dealId, array $data): array
    {
        return \CRest::call('crm.deal.productrows.set', [
            'id' => $dealId,
            'rows' => [$data]
        ]);
    }

    /**
     * Создание контакта
     *
     * @param array $data
     * @return bool|null
     */
    public static function createContact(array $data): ?bool
    {

        $result = \CRest::call('crm.contact.add', ['fields' => $data]);

        if ($result['result']) {
            return $result['result'];
        }

        return null;
    }
}
