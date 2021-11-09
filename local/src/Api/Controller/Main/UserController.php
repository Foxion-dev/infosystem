<?php

namespace InfoSystems\Api\Controller\Main;

use Bitrix\Main\Web\Json;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Response;
use InfoSystems\Api\Controller\BaseSecureController;

class UserController extends BaseSecureController
{
    /**
     * @return string
     */
    public function add()
    {
        $response = new Response();
        try {
            $data = Json::decode(file_get_contents("php://input"));

            \Bitrix\Main\Diag\Debug::WriteToFile([
                'data' => $data
            ], __METHOD__.'::'.__LINE__);

        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }

        return $response->get();
    }

    public function edit($xmlId)
    {
        $response = new Response();
        try {
            $data = Json::decode(file_get_contents("php://input"));



        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }

        return $response->get();
    }

    /**
     * @param int $xmlId
     * @return string
     */
    public function delete(int $xmlId)
    {

    }
}
