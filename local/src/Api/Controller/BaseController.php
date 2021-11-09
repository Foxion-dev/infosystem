<?php

namespace InfoSystems\Api\Controller;

use Bitrix\Main\HttpRequest;
use InfoSystems\Api\Helper\ApiHelper;
use InfoSystems\Api\Tables\ApiSessionTable;

class BaseController
{
    /**
     * @var HelperManager
     */
    protected $helper;

    /**
     * @var bool|mixed
     */
    protected $token;

    /**
     * @var \CUser
     */
    protected $user;

    /**
     * @var bool|mixed
     */
    protected $session;

    /**
     * @var HttpRequest
     */
    protected $request;

    public function __construct(HttpRequest $request)
    {
        global $USER;

        $this->user = $USER;
        $this->request = $request;

        $this->token = ApiHelper::getHeaderHash();

        if ($this->token) {
            $this->session = ApiSessionTable::getSession($this->token);
        }
    }
}

