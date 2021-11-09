<?php

namespace InfoSystems\App\Ajax;

use Bitrix\Main\HttpRequest;
use Bitrix\Main\Loader;

/**
 * Class AbstractRequestHandler
 * @package RusWoman\App\Ajax
 */
abstract class AbstractRequestHandler
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * AbstractRequestHandler constructor.
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;

        $this->includeModules();
    }

    /**
     * @return bool
     */
    public function includeModules(): bool
    {
        return Loader::includeModule('form');
    }
}
