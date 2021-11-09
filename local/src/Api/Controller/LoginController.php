<?php


namespace InfoSystems\Api\Controller;

use Bitrix\Main\UserTable;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Controller\BaseController;
use InfoSystems\Api\Response;
use InfoSystems\Api\Enum\Errors;
use InfoSystems\Api\Tables\ApiSessionTable;

class LoginController extends BaseController
{

    public function authorize()
    {
        $response = new Response();

        try {
            global $USER;

            $login = $this->request->getQuery('login');
            $password = $this->request->getQuery('password');
            $remember =  $this->request->getQuery('remember');

            $filter = [
                'LOGIC' => 'OR',
                ['=EMAIL' => $login],
                ['=LOGIN' => $login],
            ];

            $userData = UserTable::getList([
                'select' => ['ID', 'EMAIL', 'LOGIN'],
                'filter' => $filter
            ])->fetch();

            $check = $USER->Login(
                $userData['LOGIN'],
                $password,
                $remember ? 'Y' : 'N',
                'Y'
            );

            if (true !== $check) {
                throw new SystemException('Неправильный логин или пароль', Errors::AUTH_FAILED);
            }

            $session = ApiSessionTable::getList([
                'select' => ['*'],
                'filter' => [
                    '=UF_USER' => $userData['ID']
                ],
                'limit' => 1
            ])->fetch();

            if ($session) {
                $date = new \DateTime();
                $date->modify('-1 day');

                if ( ($session['UF_LAST_DATE']->format('Ymd') > $date->format('Ymd')) || $session['UF_REMEMBER'] ) {
                    ApiSessionTable::update($session['ID'], ['UF_LAST_DATE' => new DateTime()]);
                } else {
                    ApiSessionTable::delete($session['ID']);
                    $session = ApiSessionTable::createSession($userData['ID'], $remember);
                }
            } else {
                $session = ApiSessionTable::createSession($userData['ID'], $remember);
            }

            $responseData = ['token' => $session['UF_SESSION']];

            $response->setData($responseData);

        } catch (\Exception $exception) {
            //$response->setStatus($response::STATUS_ERROR);
            //$response->setCode($exception->getCode());
            $response->addError($exception->getMessage());
        }

        return $response->get();
    }
}
