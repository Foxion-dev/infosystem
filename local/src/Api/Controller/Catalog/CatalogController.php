<?php

namespace InfoSystems\Api\Controller\Catalog;

use Bitrix\Main\HttpRequest;
use Sprint\Migration\HelperManager;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Controller\BaseSecureController;

class CatalogController extends BaseSecureController
{
    protected $iblockId;

    public function __construct(HttpRequest $request)
    {
        parent::__construct($request);

        $this->iblockId = 2;

        $this->includeModules();

        $this->helper = new HelperManager();
    }

    private function includeModules()
    {
        if (!Loader::includeModule('catalog')) {
            throw new SystemException(sprintf('Модуль %s не установлен', 'catalog'));
        }

        if (!Loader::includeModule('sprint.migration')) {
            throw new SystemException(sprintf('Модуль %s не установлен', 'sprint.migration'));
        }
    }

}
