<?php
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use InfoSystems\App\Ajax\Response;
use InfoSystems\App\Ajax\RequestHandler;
use InfoSystems\App\Ajax\FormHandler;
use InfoSystems\Api\Enum\Errors;

define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = Context::getCurrent()->getRequest();
$httpMethod = $request->getRequestMethod();
$uri = $request->getRequestUri();

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addGroup('/ajax', function (FastRoute\RouteCollector $r) {
        $r->post('/feedback/', [RequestHandler::class, 'handleFeedback']);

        $r->addGroup('/service', function (\FastRoute\RouteCollector $r) {
            $r->post('/order/{id:[\w]+}/', [FormHandler::class, 'sendRequest']);
        });

        $r->addGroup('/courses', function (\FastRoute\RouteCollector $r) {
            $r->post('/order/{id:[\w]+}/', [FormHandler::class, 'sendOrder']);
            $r->post('/offer/{id:[\w]+}/', [FormHandler::class, 'getOffer']);
        });
        $r->addGroup('/pay', function (\FastRoute\RouteCollector $r) {
            $r->post('/order/{id:[\w]+}/', [FormHandler::class, 'sendPayOrder']);

        });
        $r->addGroup('/basket', function (\FastRoute\RouteCollector $r) {
            $r->post('/setDate/', [RequestHandler::class, 'setDate']);
        });
    });
});

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response(Errors::METHOD_NOT_FOUND, 'Method not allowed');
        $response->send();
        break;

    case FastRoute\Dispatcher::NOT_FOUND:
        $response = new Response(Errors::NOT_FOUND, 'Not found');
        $response->send();
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = $handler;
        $object = new $class($request);

        call_user_func_array([$object, $method], $vars);
        break;
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
