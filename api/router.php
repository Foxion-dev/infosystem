<?php
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\SystemException;
use FastRoute\RouteCollector;
use InfoSystems\Api\Response;
use InfoSystems\Api\Enum\Errors;
use InfoSystems\Api\Controller\Catalog;
use InfoSystems\Api\Controller\LoginController;
use InfoSystems\Api\Controller\Sale\OrderController;
use InfoSystems\Api\Controller\Main\UserController;

define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = Context::getCurrent()->getRequest();

$httpMethod = mb_strtoupper($request->getRequestMethod());
$uri = $request->getRequestUri();

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

try {
    $dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
        $r->addGroup('/api/v1', function (RouteCollector $r) {
            $r->addGroup('/user', function (RouteCollector $r) {
                $r->post('/authorization/', [LoginController::class, 'authorize']);
            });

            $r->addGroup('/catalog', function (RouteCollector $r) {
                $r->addGroup('/iblocks', function (RouteCollector $r) {
                    $r->put('/{xmlId:[\d]+}/', [Catalog\IblockController::class, 'edit']);
                });
                $r->addGroup('/sections', function (RouteCollector $r) {
                    $r->post('/{xmlId:[\d]+}/', [Catalog\SectionController::class, 'add']);
                    $r->put('/{xmlId:[\d]+}/', [Catalog\SectionController::class, 'edit']);
                    $r->delete('/{xmlId:[\d]+}/', [Catalog\SectionController::class, 'delete']);
                });
                $r->addGroup('/elements', function (RouteCollector $r) {
                    $r->post('/', [Catalog\ElementController::class, 'add']);
                    $r->put('/{xmlId:[\d]+}/', [Catalog\ElementController::class, 'edit']);
                    $r->delete('/{xmlId:[\d]+}/', [Catalog\ElementController::class, 'delete']);
                });
                $r->addGroup('/properties', function (RouteCollector $r) {
                    $r->post('/', [Catalog\PropertyController::class, 'add']);
                    $r->put('/', [Catalog\PropertyController::class, 'edit']);
                    $r->delete('/{code:.+}/', [Catalog\PropertyController::class, 'delete']);
                });
                $r->addGroup('/products', function (RouteCollector $r) {
                    $r->post('/{xmlId:[\d]+}/', [Catalog\ProductController::class, 'add']);
                    $r->put('/{xmlId:[\d]+}/', [Catalog\ProductController::class, 'edit']);
                });
                $r->addGroup('/prices', function (RouteCollector $r) {
                    $r->post('/{xmlId:[\d]+}/', [Catalog\PriceController::class, 'add']);
                    $r->put('/{xmlId:[\d]+}/', [Catalog\PriceController::class, 'edit']);
                    $r->delete('/{xmlId:[\d]+}/', [Catalog\PropertyController::class, 'delete']);
                });
            });

            $r->addGroup('/order', function (RouteCollector $r) {
                $r->addGroup('/materials', function (RouteCollector $r) {
                    $r->post('/{xmlId:[\d]+}/', [OrderController::class, 'addMaterials']);
                });
            });

            $r->addGroup('/user', function (RouteCollector $r) {
                $r->post('/', [UserController::class, 'add']);
                $r->put('/{xmlId:[\d]+}/', [UserController::class, 'edit']);
                $r->delete('/{xmlId:[\d]+}/', [UserController::class, 'delete']);
            });
        });
    });

    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $response = new Response(Errors::METHOD_NOT_FOUND, Response::STATUS_ERROR);
            $response->addError('Method not allowed');
            echo $response->get();
            break;

        case FastRoute\Dispatcher::NOT_FOUND:
            $response = new Response(Errors::NOT_FOUND, Response::STATUS_ERROR);
            $response->addError('Not found');
            echo $response->get();
            break;

        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            list($class, $method) = $handler;
            $object = new $class($request);

            $response = call_user_func_array([$object, $method], $vars);

            if ($response) {
                echo $response;
            }

            break;
    }

} catch (\Exception $exception) {
    $response = new Response($exception->getCode(), Response::STATUS_ERROR);
    $response->addError($exception->getMessage());
    echo $response->get();
} catch (\Error $error) {
    $response = new Response(Errors::SYSTEM_ERROR, Response::STATUS_ERROR);
    $response->addError($error->getMessage());
    echo $response->get();
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
