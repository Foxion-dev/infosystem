<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// p($arResult["ITEMS"],'p');
if(count($arResult["ITEMS"]) && CModule::IncludeModule('iblock')){
    // IBLOCK_SECTION_ID
    $aecArr = [];
    $secVal = [];
    foreach ($arResult["ITEMS"] as $sec){
        $aecArr[] = $sec['IBLOCK_SECTION_ID'];
    }
    $aecArr = array_unique($aecArr);
    //
    $arFilter = Array('ID'=>$aecArr, "IBLOCK_ID"=>$arParams['IBLOCKS']);
    $db_list = CIBlockSection::GetList(['id'=>'asc'], $arFilter, false, ['ID','NAME','CODE','SORT']);
    while($as_ = $db_list->GetNext()){
        $secVal[$as_['ID']] = $as_['NAME'];
    }
    //
    foreach ($arResult["ITEMS"] as &$item){
        $item['IBLOCK_SECTION_NAME'] = ($item['IBLOCK_SECTION_ID']?$secVal[$item['IBLOCK_SECTION_ID']]:false);
    }
}
$arResult["ITEMS_SECTION"] = [];
foreach ($arResult["ITEMS"] as $ITEM){
    $arResult["ITEMS_SECTION"][$ITEM['IBLOCK_SECTION_ID']]["IBLOCK_SECTION_ID"] = $ITEM['IBLOCK_SECTION_ID'];
    $arResult["ITEMS_SECTION"][$ITEM['IBLOCK_SECTION_ID']]["IBLOCK_SECTION_NAME"] = $ITEM['IBLOCK_SECTION_NAME'];
    $arResult["ITEMS_SECTION"][$ITEM['IBLOCK_SECTION_ID']]["ITEMS"][] = $ITEM;
}
unset($arResult["ITEMS"]);
//p($arResult["ITEMS_SECTION"],'p');