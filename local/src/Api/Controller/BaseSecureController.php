<?php


namespace InfoSystems\Api\Controller;


use Bitrix\Main\HttpRequest;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Helper\ApiHelper;
use InfoSystems\Api\Enum\Errors;

class BaseSecureController extends BaseController
{
    protected $needAuth = true;

    public function __construct(HttpRequest $request)
    {
        if ($this->needAuth && !ApiHelper::authorizationUser()) {
            throw new SystemException('Доступ запрещен', Errors::ACCESS_DENIED);
        }
        parent::__construct($request);
    }
}
