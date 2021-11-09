<?php

namespace InfoSystems\Api\Controller\Sale;

use Bitrix\Main\HttpRequest;
use Sprint\Migration\HelperManager;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Controller\BaseSecureController;

class SaleController extends BaseSecureController
{
    public function __construct(HttpRequest $request)
    {
        parent::__construct($request);

        $this->includeModules();
    }

    private function includeModules()
    {
        if (!Loader::includeModule('catalog')) {
            throw new SystemException(sprintf('Модуль %s не установлен', 'catalog'));
        }

        if (!Loader::includeModule('sale')) {
            throw new SystemException(sprintf('Модуль %s не установлен', 'sale'));
        }

        if (!Loader::includeModule('iblock')) {
            throw new SystemException(sprintf('Модуль %s не установлен', 'iblock'));
        }
    }

}
