<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// p($arParams,'p');
// p($arResult,'p');
// алгоритм выбирает популярные курсы и т.д.
$arResult['POPULAR_COURSES'] = [];
// получаем стоимость курса и т.д.
function getPriseArr($PRODUCT_ID_ARR, $CATALOG_GROUP_ID = Null){
    $res = [];
    $CATALOG_GROUP_ID = $CATALOG_GROUP_ID?$CATALOG_GROUP_ID:1;
    $PRODUCT_ID_ARR = is_array($PRODUCT_ID_ARR)?$PRODUCT_ID_ARR:[$PRODUCT_ID_ARR];
    if(count($PRODUCT_ID_ARR) && CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")){
        $db_res = CPrice::GetList(
            ['PRODUCT_ID'=>'ACS'],
            [
                "PRODUCT_ID" => $PRODUCT_ID_ARR,
                "CATALOG_GROUP_ID" => $CATALOG_GROUP_ID,
            ], false, false, ["ID","PRODUCT_ID","PRICE"]
        );
        while ($ar_res = $db_res->Fetch()){
            //
            $res[$ar_res['PRODUCT_ID']] = number_format($ar_res['PRICE'], 0, '', ' ').' р.';
            //$res[$ar_res['PRODUCT_ID']] = $ar_res['PRICE'];
        }
    }
    return $res;
}
// понеслась
if(CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")){
    //
    $PRODUCT_ID_ARR = [];
    $COUNT = 4; // выбираем только 4-ре
    $arNavStartParams = ["nTopCount" => $COUNT];
    $arSelect = ["ID","IBLOCK_ID","NAME","CODE","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","PROPERTY_SPECIALOFFER","PROPERTY_CITY","PROPERTY_DATE","DETAIL_PAGE_URL"];
    $arFilter = ["!PROPERTY_SPECIALOFFER"=>false,">=PROPERTY_DATE" => date("Y-m-d H:i:s",time()),"ACTIVE"=>"Y","IBLOCK_ID"=>2];
    //
    $rsItems = CIBlockElement::GetList(["PROPERTY_DATE"=>"ASC"], $arFilter, false, $arNavStartParams, $arSelect);
    while($arItem = $rsItems->GetNext()){
        //
        if($arItem['PREVIEW_PICTURE']){
            $PR = PRM::PR($arItem['PREVIEW_PICTURE'], $arSize = ["width" => 800, "height" => 600]);
            $arItem['PREVIEW_PICTURE'] = PRM::isHttps().$_SERVER['SERVER_NAME'].$PR['SRC'];
        }else{
            $arItem['PREVIEW_PICTURE'] = PRM::isHttps().$_SERVER['SERVER_NAME'].PRM::SRC(500);
        }
        //
        if($arItem['DETAIL_PAGE_URL']){
            $arItem['DETAIL_PAGE_URL'] = PRM::isHttps().$_SERVER['SERVER_NAME'].$arItem['DETAIL_PAGE_URL'];
        }
        //
        $PRODUCT_ID_ARR[] = $arItem['ID'];
        $arResult['POPULAR_COURSES'][] = $arItem;
        //p($arItem,'p');
    }
    if(count($PRODUCT_ID_ARR)) {
        $PARR = getPriseArr($PRODUCT_ID_ARR);
        foreach ($arResult['POPULAR_COURSES'] as &$ITEM) {
            $ITEM['PRICE'] = $PARR[$ITEM['ID']] ? $PARR[$ITEM['ID']] : false;
        }
    }
    //p($arResult['POPULAR_COURSES'],'p');
}