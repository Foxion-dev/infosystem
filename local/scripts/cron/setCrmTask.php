<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/crest/crest.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

ini_set('error_reporting', E_ERROR );
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);


$today = date("d.m.Y"); // сегодня
$in2Days = date("d.m.Y", time() + (86400 * 2)); // через 2 дня

use Bitrix\Sale;

CModule::IncludeModule('iblock');
CModule::IncludeModule('sale');

$scheduleCoursesIblock = 53;

$arSelect = Array("ID", "IBLOCK_ID","NAME", "DATE_ACTIVE_FROM","DATE_ACTIVE_TO","XML_ID");
$arFilter = Array("IBLOCK_ID"=> $scheduleCoursesIblock , "ACTIVE"=>"Y");

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

while($courses = $res->GetNextElement()) {

	$fields = $courses->GetFields();
	$props = $courses->GetProperties();

	switch(substr($fields['DATE_ACTIVE_TO'], 0, 10)){

			case $in2Days:

				if($props['CREATE_2DAY_TASK']['VALUE'] != 'Y'){


					// Получим слушателей
					$listeners = [];
					foreach($props['LISTENERS']['VALUE']  as $user){
						$rsUser = CUser::GetByID($user);
						$userDB = $rsUser->Fetch();

						$listeners[] = array(
							'NAME'  => (!empty($userDB['NAME']) || !empty($userDB['LAST_NAME'])) ? $userDB['NAME'] .' '. $userDB['LAST_NAME'] : $userDB['LOGIN'],
							'EMAIL' => $userDB['EMAIL'],
							'PHONE' => (!empty($userDB['PERSONAL_PHONE']) || !empty($userDB['WORK_PHONE'])) ? $userDB['PERSONAL_PHONE'] . ', '. $userDB['WORK_PHONE'] : ''
						);
					}

					// создаём задачу б24 
					$courseDate = substr($fields['DATE_ACTIVE_FROM'], 0, 10).'/'. substr($fields['DATE_ACTIVE_TO'], 0, 10);
					$artnumber = $props['ARTNUMBER']['VALUE'];

					$titleString = 'Подготовка документов по окончанию курса / '.$artnumber.' / '.$courseDate;
					$descriptionString = "Cписок слушателей: \n ";

					// Собираем строку описания задачи
					foreach($listeners as $listener){
						$descriptionString .= 'Имя(логин): ' .$listener['NAME']. ', Email: ' .$listener['EMAIL'];
						$descriptionString .= (!empty($listener['PHONE'])) ? ', Телефон: ' .$listener['PHONE']. "\n" : "\n"; 
					}
					$descriptionString .= 'Продолжительность курса: '. $props['COURSE_VOLUME']['VALUE'];

					// Создадим задачу 
					$taskFields= array(
						'TITLE'          => $titleString,
						'CREATED_BY'     => 443,
						'DESCRIPTION'    => $descriptionString,
						'PRIORITY'       => 2, // высокий приоритет
						'RESPONSIBLE_ID' => 119, // ответственный
						'DEADLINE'       => $in2Days // через 2 дня
					);

					$createTask = CRest::call('tasks.task.add', ['fields' => $taskFields]);

					// Поставим чекбокс, для избежания дублей и установим статус
					CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], [
						'CREATE_2DAY_TASK' => 187,
						'STATUS'           => 'cancel'
					]);
				}

			break;
			case $today:
				if($props['CREATE_LASTDAY_TASK']['VALUE'] != 'Y'){

					$dealResultList = [];
					$orderListIds = [];
					$dealListIds = [];

					$dealList = $props['DEAL_LIST']['VALUE'];

					$dealListCRM = CRest::call('crm.deal.list', [
						'order'  => ["STAGE_ID" => "ASC" ] ,
						'filter' => ["ID" => $dealList],
						'select' => ["ID", "TITLE", "STAGE_ID","UF_CRM_1628167728264"]
					]);
					$dealResultList = $dealListCRM['result'];
					foreach($dealResultList as $key => $dealCRM){
							$getProduct =  CRest::call('crm.deal.productrows.get',['id'=>$dealCRM['ID']]);

							if($getProduct['result']){

								if($getProduct['result'][0]['PRODUCT_NAME'] == $fields['NAME']){ // TODO проверяем по имени, что не очень хорошо

									// изменим стату сделок
									$setStatusDeal =  CRest::call('crm.deal.update',['id'=>$dealCRM['ID'], 'fields' => ["STAGE_ID" => "C9:7"]]);

									// изменим статус заказа
									// получаем объект существующего заказа
									$order = Sale\Order::load($dealCRM['UF_CRM_1628167728264']);
									
									if($order->getField('STATUS_ID') == 'P'){
										// задаем значение для поля STATUS_ID - FN (статус: ожидание закрывающих документов)
										$order->setField('STATUS_ID', 'FN');
										// сохраняем изменения
										$order->save();

									}

									$dealResultList[$key]['PRODUCTS'] = $getProduct['result'];

								}else{
									unset($dealResultList[$key]);
								}
							}
					}

					// Поставим чекбокс, для избежания дублей
					CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], [
						'CREATE_LASTDAY_TASK' => 188
					]);
				}
			break;

			default: break;
	}
}