<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
?>
<pre style="display: none;">
<?print_r($arResult);?>
</pre>
<?
foreach($arResult["ITEMS"] as $key => &$arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	
	$arRes['VENDOR']=CIBlockFormatProperties::GetDisplayValue($arElement,$arElement['PROPERTIES']['VENDOR'],'catalog_out');
	$arElement["DISPLAY_PROPERTIES"] = $arRes;
	$arElement['FIRST_SECTION']=[
		'ID'=>$arElement['IBLOCK_SECTION_ID']
	];
}
unset($arElement);
if(count($sections)>0){
	$sections=array_unique($sections);
	$sections=CIBlockSection::GetList([],['ID'=>$sections],false,['ID','IBLOCK_SECTION_ID','NAME']);
	$tmpSections=[];
	$again_search_ids=[];
	while($s=$sections->Fetch()){
		$tmpSections[$s['ID']]=['NAME'=>$s['NAME']];
		if(!empty($s['IBLOCK_SECTION_ID'])){
			$again_search_ids[]=$s['IBLOCK_SECTION_ID'];
			$tmpSections[$s['ID']]['IBLOCK_SECTION_ID']=[
				'ID'=>$s['IBLOCK_SECTION_ID']
			];
		}
	}
	$again_search_ids=array_unique($again_search_ids);
	unset($sections);
	unset($s);
	if(count($again_search_ids)>0){
		$sections=CIBlockSection::GetList([],['ID'=>$sections],false,['ID','NAME']);
		while($s=$sections->Fetch()){
			foreach($tmpSections as &$sec){
				if($sec['IBLOCK_SECTION_ID']['ID']==$sec['ID']){
					$sec['IBLOCK_SECTION_ID']['NAME']=$sec['NAME'];
				}
			}
		}
		unset($sec);
	}
	foreach($arResult['ITEMS'] as &$arItem){
		if(!empty($tmpSections[$arItem['FIRST_SECTION']['ID']])){
			$arItem['FIRST_SECTION']=$tmpSections[$arItem['FIRST_SECTION']['ID']];
		}
	}
	unset($arItem);
	unset($tmpSections);
	unset($sections);
	unset($s);
	unset($again_search_ids);
}
foreach($arResult['ITEMS'] as &$arItem){
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
if(!empty($arItem['PROPERTIES']['DATES']['VALUE'])){
    foreach ($arItem['PROPERTIES']['DATES']['VALUE'] as $i=>&$DISPLAY_PROPERTY){
        $ah = $i+1;
        $DISPLAY_PROPERTY = date("d m Y",strtotime($DISPLAY_PROPERTY));//."".(($ah % 2) == 0?" (".$arResult['DISPLAY_PROPERTIES']['DATES']['DESCRIPTION'][$i].")":"");
		$DISPLAY_PROPERTY = explode(' ',$DISPLAY_PROPERTY);
		$DISPLAY_PROPERTY[1]=$months[$DISPLAY_PROPERTY[1]];
		$DISPLAY_PROPERTY=implode(' ',$DISPLAY_PROPERTY);
    }
	global $USER;
	
	
		$newDates=[];
		foreach($arItem['PROPERTIES']['DATES']['VALUE'] as $i=>$dis_date){
			$ah = $i+1;
			$newDisDate = explode(' ',$dis_date);
			if(($ah%2)==0) continue;
			$newxtNewDisDate = explode(' ',$arItem['PROPERTIES']['DATES']['VALUE'][$ah]);
			if(count($newxtNewDisDate)>1){
				if($newDisDate[0]==$newxtNewDisDate[0]&&($newDisDate[1]==$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' '.$newDisDate[1];//.' '.$newxtNewDisDate[2].' г.';
				}elseif($newDisDate[0]!=$newxtNewDisDate[0]&&($newDisDate[1]==$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' - '.$newxtNewDisDate[0].' '.$newDisDate[1];//.' '.$newxtNewDisDate[2].' г.';
				}elseif(($newDisDate[1]!=$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' '.$newDisDate[1].' - '.$newxtNewDisDate[0].' '.$newxtNewDisDate[1];//.' '.$newDisDate[2].' г.';
				}elseif(($newDisDate[1]!=$newxtNewDisDate[1])&&$newDisDate[2]!=$newxtNewDisDate[2]){
					$newDates[]=$newDisDate[0].' '.$newDisDate[1].' г. '.$newDisDate[2].' - '.$newxtNewDisDate[0].' '.$newxtNewDisDate[1].' '.$newxtNewDisDate[2].' г.';
				}
			}else{
				$newDates[]=$newDisDate[0].' '.$newDisDate[1];//.' '.$newDisDate[2].' г.';
			}
		}
    $arItem['PROPERTIES']['DATES']['VALUE'] = $newDates;//array_chunk($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'], 2, TRUE);
	}
}
unset($arItem);
?>