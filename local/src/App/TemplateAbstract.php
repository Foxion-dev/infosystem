<?php

namespace InfoSystems\App;

use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Context\Culture;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Response;
use Bitrix\Main\Server;
use Bitrix\Main\Web\Uri;

abstract class TemplateAbstract
{
    protected static $instance;
    private $context;
    private $path;

    /**
     * @param Context|null $context
     * @throws \Bitrix\Main\SystemException
     * @return static
     */
    public static function getInstance(?Context $context = null)
    {
        if (!static::$instance) {
            if (null === $context) {
                $context = Application::getInstance()->getContext();
            }
            static::$instance = new static($context);
        }

        return static::$instance;
    }

    /**
     * TemplateAbstract constructor.
     *
     * @param Context $context
     */
    protected function __construct(Context $context)
    {
        $this->context = $context;
        $uri = $this->getUri();
        $this->path = $uri->getPath();
    }

    /**
     * путь начинается с $pathPart, например /catalog/
     *
     * @param string $pathPart
     *
     * @return bool
     */
    public function isPathStartWith(string $pathPart): bool
    {
        return strpos($this->path, $pathPart) === 0;
    }

    /**
     * @return HttpRequest
     */
    public function getRequest() : HttpRequest
    {
        return $this->context->getRequest();
    }

    /**
     * @return Uri
     */
    public function getUri() : Uri
    {
        return new Uri($this->getRequest()->getRequestUri());
    }
}
