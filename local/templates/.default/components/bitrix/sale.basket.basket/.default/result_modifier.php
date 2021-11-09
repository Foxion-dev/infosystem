<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;
//
$defaultParams = array(
	'TEMPLATE_THEME' => 'blue'
);
$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME'])
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ('site' == $arParams['TEMPLATE_THEME'])
	{
		$templateId = (string)Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', SITE_ID);
		$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? 'eshop_adapt' : $templateId;
		$arParams['TEMPLATE_THEME'] = (string)Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
	}
	if ('' != $arParams['TEMPLATE_THEME'])
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}
if ('' == $arParams['TEMPLATE_THEME']){
	$arParams['TEMPLATE_THEME'] = 'blue';
}

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


foreach($arResult["BASKET_ITEM_RENDER_DATA"] as $key =>$value){
	$Query = CIBlockElement::GetList(array(), array("ID" => $value["PRODUCT_ID"]), false, false);
	if($Answer = $Query->GetNextElement()){ 
		$Props = $Answer->GetProperties();
		
		$arResult["BASKET_ITEM_RENDER_DATA"][$key]["PROPERTY_ARTNUMBER_VALUE"] = $Props["ARTNUMBER"]["VALUE"];
		
		
		if(!empty($Props['DATES']['VALUE'])){
		    foreach ($Props['DATES']['VALUE'] as $i=>&$DISPLAY_PROPERTY){
		        $ah = $i+1;
		        $DISPLAY_PROPERTY = date("d m Y",strtotime($DISPLAY_PROPERTY));
				$DISPLAY_PROPERTY = explode(' ',$DISPLAY_PROPERTY);
				$DISPLAY_PROPERTY[1]=$months[$DISPLAY_PROPERTY[1]];
				$DISPLAY_PROPERTY=implode(' ',$DISPLAY_PROPERTY);
		    }
			$newDates=[];
			foreach($Props['DATES']['VALUE'] as $i=>$dis_date){
				$ah = $i+1;
				$newDisDate = explode(' ',$dis_date);
				if(($ah%2)==0) continue;
				$newxtNewDisDate = explode(' ',$Props['DATES']['VALUE'][$ah]);
				if(count($newxtNewDisDate)>1){
					if($newDisDate[0]==$newxtNewDisDate[0]&&($newDisDate[1]==$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
						$newDates[]=$newDisDate[0].' '.$newDisDate[1].' '.$newxtNewDisDate[2].' г.';
					}elseif($newDisDate[0]!=$newxtNewDisDate[0]&&($newDisDate[1]==$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
						$newDates[]=$newDisDate[0].' - '.$newxtNewDisDate[0].' '.$newDisDate[1].' '.$newxtNewDisDate[2].' г.';
					}elseif(($newDisDate[1]!=$newxtNewDisDate[1])&&$newDisDate[2]==$newxtNewDisDate[2]){
						$newDates[]=$newDisDate[0].' '.$newDisDate[1].' - '.$newxtNewDisDate[0].' '.$newxtNewDisDate[1].' '.$newDisDate[2].' г.';
					}elseif(($newDisDate[1]!=$newxtNewDisDate[1])&&$newDisDate[2]!=$newxtNewDisDate[2]){
						 $newDates[]=$newDisDate[0].' '.$newDisDate[1].' '.$newDisDate[2].' г. - '.$newxtNewDisDate[0].' '.$newxtNewDisDate[1].' '.$newxtNewDisDate[2].' г.';
					}
				}else{
					$newDates[]=$newDisDate[0].' '.$newDisDate[1].' '.$newDisDate[2].' г.';
				}
			}
		    $Props['DATES']['VALUE'] = $newDates;
		}
		
		foreach($Props["DATES"]["VALUE"] as $Item){
			
			$arResult["COURSE_DATES_LIST"][$value["PRODUCT_ID"]][] = array(
				"NAME" => $Item,
				"VALUE" => $Item,
				"ACT" => isset($value["PROPS_ALL"]["COURSE_DATE"]) && $value["PROPS_ALL"]["COURSE_DATE"]["VALUE"] ==$Item
			);
			
			$arResult["BASKET_ITEM_RENDER_DATA"][$key]["COURSE_DATES_LIST"][] = array(
				"NAME" => $Item,
				"VALUE" => $Item,
				"ACT" => isset($value["PROPS_ALL"]["COURSE_DATE"]) && $value["PROPS_ALL"]["COURSE_DATE"]["VALUE"] ==$Item
			);
		}
	}
}
?>