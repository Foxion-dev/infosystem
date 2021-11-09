<?
	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
	
	use Bitrix\Main\Loader,Bitrix\Sale\Basket,\Bitrix\Sale\Fuser;

	Loader::includeModule("sale");
	Loader::includeModule("catalog");
	
	$Id = intval(isset($_POST["id"]) ? $_POST["id"] : 0);
	$Date = htmlspecialchars(isset($_POST["date"]) ? $_POST["date"] : "");
	
	
	if($Id > 0 && $Date != ""){
		
		$BIOCCourseDate = null;
		$Basket = Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), "s1");

		$BasketItem = $Basket->getItemById($Id);
		
		$BasketItemProperty = $BasketItem->getPropertyCollection();
		
		foreach($BasketItemProperty as $Item){
			if($Item->getField("CODE") == "COURSE_DATE"){
				$BIOCCourseDate = $Item;
				break;
			}
			
		}
		if($BIOCCourseDate){
			$BIOCCourseDate->setField("VALUE",$Date);
		} else {		
			$BasketItemProperty->setProperty(array(
				array(
					"NAME" => "Дата курса",
					"CODE" => "COURSE_DATE",
					"VALUE" => $Date,
					"SORT" => 100
				)
			));
		}
		$Basket->save();
	}
	
?>