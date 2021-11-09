<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// считаем бонусы и т.д.
global $USER;

if(!empty($arResult["BASKET_ITEMS"]) && CModule::IncludeModule('iblock') && CModule::IncludeModule("sale")) {
    $AID = [];
    foreach ($arResult["BASKET_ITEMS"] as $ITEM){
        $AID[] = $ITEM['PRODUCT_ID'];
    }
    //
    $BONUS = 0;
    $arSelect = ["ID","NAME","CODE",'IBLOCK_ID','PROPERTY_BONUS'];
    $arFilter = ['ID'=>$AID];
    $res = CIBlockElement::GetList(['ID'=>'ACS'], $arFilter, false,false, $arSelect);
    while($item = $res->GetNext()){
        $BONUS = $BONUS + intval($item['PROPERTY_BONUS_VALUE']);
    }
    $arResult['BONUS'] = $BONUS;
}

if($USER->IsAuthorized()){
	$CUser = CUser::GetByID($USER->GetID())->Fetch();
	
	foreach($arResult["ORDER_PROP"]["USER_PROPS_Y"] as $key => $value){
		
		$NVal = "";
		$Flag = false;
		
		if($value["CODE"] == "FIO"){
			$Flag = true;
			$NVal = $CUser["LAST_NAME"]." ". $CUser["NAME"]." ". $CUser["SECOND_NAME"];
		} elseif($value["CODE"] == "COMPANY"){
			$Flag = true;
			$NVal = $CUser["WORK_COMPANY"];
		} elseif($value["CODE"] == "POSITION"){
			$Flag = true;
			$NVal = $CUser["WORK_POSITION"];
		} elseif($value["CODE"] == "EMAIL"){
			$Flag = true;
			$NVal = $CUser["EMAIL"];
		} elseif($value["CODE"] == "PHONE"){
			$Flag = true;
			$NVal = $CUser["PERSONAL_PHONE"];
		}
		
		if($Flag){
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][$key]["VALUE"] = $NVal;
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][$key]["VALUE_FORMATED"] = $NVal;
		}
		
	}
	
}
?>