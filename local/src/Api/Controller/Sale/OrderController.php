<?php


namespace InfoSystems\Api\Controller\Sale;

use Bitrix\Main\Web\Json;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\SystemException;
use InfoSystems\Api\Response;
use InfoSystems\Api\Controller\BaseController;
use InfoSystems\Enum\ScheduleListenersIblock;

class OrderController extends SaleController
{
    /**
     * Метод добавляет материалы для обучения
     * @param int $orderId
     * @return string
     */
    public function addMaterials(int $orderId)
    {
        $response = new Response();

        try {
            $data = Json::decode(file_get_contents("php://input"));

            if ($data['FILES']) {
                foreach ($data['FILES'] as &$file) {
                    $file = \CFile::MakeFileArray($file['src']);
                    $file = [
                        'VALUE' => $file,
                        'DESCRIPTION' => $file['name']
                    ];
                }

                $listener = \Bitrix\Sale\PropertyValueCollection::getList([
                    'select' => ['*'],
                    'filter' => [
                        '=CODE' => 'LISTENER',
                        '=ORDER_ID' => $orderId,
                    ]
                ])->fetch();

                if ($listener['VALUE']) {
                    \CIBlockElement::SetPropertyValuesEx($listener['VALUE'], ScheduleListenersIblock::getId(), [
                        'MATERIALS' => $data['FILES']
                    ]);
                }

            }
        } catch (\Exception $exception) {
            $response->addError($exception->getMessage());
        }

        return $response->get();
    }
}
