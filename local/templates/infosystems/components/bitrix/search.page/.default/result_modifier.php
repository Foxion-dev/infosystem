<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($arProperty); echo "</pre>";
//echo "<pre>"; print_r($arResult['SEARCH']); echo "</pre>";
?>

<? /*if(count($arResult['SEARCH'])>0 && CModule::IncludeModule("acs") && CModule::IncludeModule("iblock")){

    foreach($arResult['SEARCH'] as &$sa){
        if(!in_array($sa['PARAM2'],array(IBLOCK_SHOP,IBLOCK_TC))) continue;
        $sa['URL'] = $sa['~URL'] = "/".$GLOBALS["SPACE"]['CITY_SPACE_DEFAULT_URL'].$sa['~URL'];
        //p($GLOBALS["SPACE"]['CITY_SPACE_DEFAULT_URL'],'p');
        //p($sa,'p');
    }

    $seArr = array();
    foreach($arResult['SEARCH'] as $sea){
        if($sea['PARAM2']!=8) continue;
        $seArr[] = $sea['ITEM_ID'];
        //
    }
    if(count($seArr)>0) {
        //
        $getUrlArr = AcsElem::getUrl($seArr);

        foreach($arResult['SEARCH'] as &$s){
            if($s['PARAM2']!=8) continue;
            $s['URL'] = $s['~URL'] = $getUrlArr[$s['ITEM_ID']];
        }
    }
 }*/ ?>