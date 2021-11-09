<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// echo "<pre>"; print_r($arParams); echo "</pre>";
// echo "<pre>"; print_r($arResult["ITEMS"]); echo "</pre>";

if(count($arResult["ITEMS"]) && CModule::IncludeModule('iblock')){
    // IBLOCK_SECTION_ID
    $aecArr = [];
    $secVal = [];
    foreach ($arResult["ITEMS"] as $sec){
        $aecArr[] = $sec['IBLOCK_SECTION_ID'];
    }
    $aecArr = array_unique($aecArr);
    //p($aecArr,'p');

    $arFilter = Array('ID'=>$aecArr, "IBLOCK_ID"=>$arParams['IBLOCKS']);
    $db_list = CIBlockSection::GetList(['id'=>'asc'], $arFilter, false, ['ID','NAME','CODE']);
    while($as_ = $db_list->GetNext()){
        $secVal[$as_['ID']] = $as_['NAME'];
    }

    //p($secVal,'p');
    foreach ($arResult["ITEMS"] as &$item){
        $item['IBLOCK_SECTION_NAME'] = ($item['IBLOCK_SECTION_ID']?$secVal[$item['IBLOCK_SECTION_ID']]:false);
    }
}

