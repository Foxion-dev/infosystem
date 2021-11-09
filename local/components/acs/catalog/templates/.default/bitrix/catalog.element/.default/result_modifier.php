<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
//
$user_id = $arResult['DISPLAY_PROPERTIES']['USER_ID']['DISPLAY_VALUE'];
if ($user_id){
	$rsUSER = CUser::GetById($user_id);
	$f=$rsUSER->Fetch();
	$arResult['DISPLAY_PROPERTIES']['USER_ID']['DISPLAY_VALUE'] = CUser::FormatName(CSite::GetNameFormat(false), array("NAME" => $f['NAME'], "LAST_NAME" => $f['LAST_NAME'], "SECOND_NAME" => $f['SECOND_NAME'], "LOGIN" => $f['LOGIN']));
}
// the ['MANAGER']
if(!empty($arResult['DISPLAY_PROPERTIES']['MANAGER']['VALUE']) && CModule::IncludeModule('iblock')){
    //p($arResult['DISPLAY_PROPERTIES']['MANAGER']['VALUE'],'p');
    //p($arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_ELEMENT_VALUE'][$arResult['DISPLAY_PROPERTIES']['MANAGER']['VALUE']],'p');
    $arFilterManager = [
        "IBLOCK_ID"=>$arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_IBLOCK_ID'],
        "ID"=>$arResult['DISPLAY_PROPERTIES']['MANAGER']['VALUE'],
    ];
    $arSelectManager = ["ID","NAME","IBLOCK_ID","PREVIEW_PICTURE","PROPERTY_POSITION","PROPERTY_PHONES","PROPERTY_POST_MAIL","DETAIL_PAGE_URL"];
    if($arrManager = CIBlockElement::GetList(["SORT"=>"ASC"],$arFilterManager,false,false,$arSelectManager)->GetNext()){
        //
        $arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_ELEMENT_VALUE'][$arrManager['ID']]['PROPERTY_POSITION_VALUE'] = $arrManager['PROPERTY_POSITION_VALUE'];
        $arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_ELEMENT_VALUE'][$arrManager['ID']]['PROPERTY_PHONES_VALUE'] = $arrManager['PROPERTY_PHONES_VALUE'];
        $arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_ELEMENT_VALUE'][$arrManager['ID']]['PROPERTY_POST_MAIL_VALUE'] = $arrManager['PROPERTY_POST_MAIL_VALUE'];
        // переносим данные про менеджера в component_epilog.php
        $cp = $this->__component;
        if (is_object($cp)){
            $cp->arResult['MANAGER'] = $arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_ELEMENT_VALUE'][$arrManager['ID']];
            $cp->SetResultCacheKeys(array('MANAGER'));
            $arResult['MANAGER'] = $cp->arResult['MANAGER'];
        }
    }
}

// the experts
if(!empty($arResult['DISPLAY_PROPERTIES']['EXPERTS']['VALUE']) && CModule::IncludeModule('iblock')){
	//
	$pp = [];
    $arFilter = [
        "IBLOCK_ID"=>$arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_IBLOCK_ID'],
        "ID"=>$arResult['DISPLAY_PROPERTIES']['EXPERTS']['VALUE'],
    ];
    $arSelectFields = ["ID","NAME","IBLOCK_ID","PREVIEW_PICTURE","PROPERTY_POSITIONS","DETAIL_PAGE_URL",'PREVIEW_TEXT'];
    $res = CIBlockElement::GetList(["SORT"=>"ASC"],$arFilter,false,false,$arSelectFields);
    while($arr = $res->GetNext()){
        $pp[$arr['ID']] = $arr;
    }
    if(count($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'])){
        foreach ($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'] as &$LEA) {
            if ($LEA['PREVIEW_PICTURE']) {
                $LEA['PREVIEW_PICTURE'] = PRM::PR($LEA['PREVIEW_PICTURE'], $arSize = array("width" => 160, "height" => 160));
            }
			$LEA['PREVIEW_TEXT']=explode('<hr />',$pp[$LEA['ID']]['PREVIEW_TEXT'])[0];
            $LEA['PROPERTY_POSITIONS_VALUE'] = ($pp[$LEA['ID']]['PROPERTY_POSITIONS_VALUE'] ? $pp[$LEA['ID']]['PROPERTY_POSITIONS_VALUE'] : "");
        }
    }
}
// формируем формат адженты
$months=[
	'01'=>'Января',
	'02'=>'Февраля',
	'03'=>'Марта',
	'04'=>'Апреля',
	'05'=>'Мая',
	'06'=>'Июня',
	'07'=>'Июля',
	'08'=>'Августа',
	'09'=>'Сентября',
	'10'=>'Октября',
	'11'=>'Ноября',
	'12'=>'Декабря',
];
if(!empty($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'])){
    foreach ($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'] as $i=>&$DISPLAY_PROPERTY){
        $ah = $i+1;
        $DISPLAY_PROPERTY = date("d m Y",strtotime($DISPLAY_PROPERTY));//."".(($ah % 2) == 0?" (".$arResult['DISPLAY_PROPERTIES']['DATES']['DESCRIPTION'][$i].")":"");
		$DISPLAY_PROPERTY = explode(' ',$DISPLAY_PROPERTY);
		$DISPLAY_PROPERTY[1]=$months[$DISPLAY_PROPERTY[1]];
		$DISPLAY_PROPERTY=implode(' ',$DISPLAY_PROPERTY);
    }
	global $USER;
	
	
		$newDates=[];
		foreach($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'] as $i=>$dis_date){
			$ah = $i+1;
			$newDisDate = explode(' ',$dis_date);
			if(($ah%2)==0) continue;
			$newxtNewDisDate = explode(' ',$arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'][$ah]);
			if(count($newxtNewDisDate)>1){
				if($newDisDate[0]==$newxtNewDisDate[0]&&($newDisDate[1]==$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' '.$newDisDate[1].' '.$newxtNewDisDate[2].' г.';
				}elseif($newDisDate[0]!=$newxtNewDisDate[0]&&($newDisDate[1]==$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' - '.$newxtNewDisDate[0].' '.$newDisDate[1].' '.$newxtNewDisDate[2].' г.';
				}elseif(($newDisDate[1]!=$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' '.$newDisDate[1].' - '.$newxtNewDisDate[0].' '.$newxtNewDisDate[1].' '.$newDisDate[2].' г.';
				}elseif(($newDisDate[1]!=$newxtNewDisDate[1])&&$newDisDate[2]!=$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' '.$newDisDate[1].' г. '.$newDisDate[2].' - '.$newxtNewDisDate[0].' '.$newxtNewDisDate[1].' '.$newxtNewDisDate[2].' г.';
				}
			}else{
				$newDates[]=$newDisDate[0].' '.$newDisDate[1].' '.$newDisDate[2].' г.';
			}
		}
	
	
    $arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'] = $newDates;//array_chunk($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'], 2, TRUE);
}