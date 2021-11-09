<?php

namespace InfoSystems\App\Ajax;

use Bitrix\Main\Loader;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

/**
 * Class CoursesHandler
 * @package InfoSystems\App\Ajax
 */
class CoursesHandler extends AbstractRequestHandler
{
    /**
     * CoursesHandler constructor.
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        parent::__construct($request);
    }

    public function includeModules(): bool
    {
        return Loader::includeModule('sale') &&
        Loader::includeModule('catalog');
    }

    /**
     * Смена даты курса в корзине
     */
    public function setDate(): void
    {
        $response = new Response();

        try {

            $productId = (int)$this->request->getPost('id');
            $date = htmlspecialchars($this->request->getPost('date'));

            if($productId > 0 && $date){

                $propertyCourseDate = null;
                $basket = Basket::loadItemsForFUser(Fuser::getId(), 's1');

                $basketItem = $basket->getItemById($productId);

                $basketItemProperty = $basketItem->getPropertyCollection();

                foreach($basketItemProperty as $item){
                    if($item->getField('CODE') == 'COURSE_DATE'){
                        $propertyCourseDate = $item;
                        break;
                    }

                }
                if($propertyCourseDate){
                    $propertyCourseDate->setField('VALUE', $date);
                } else {
                    $basketItemProperty->setProperty(array(
                        array(
                            'NAME'  => 'Дата курса',
                            'CODE'  => 'COURSE_DATE',
                            'VALUE' => $date,
                            'SORT'  => 100
                        )
                    ));
                }
                $basket->save();
            }
        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }

        $response->send();
    }
}
