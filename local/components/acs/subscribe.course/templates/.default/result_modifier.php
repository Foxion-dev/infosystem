<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// p($arParams,'p');
// p($arResult,'p');
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
// добавляем стоимость прошедщего курса и т.д.
if(count($arResult["IBLOCKS"])){
    //
    $PRODUCT_ID_ARR = [];
    foreach($arResult["IBLOCKS"] as $arIBlock) :
        if(count($arIBlock["ITEMS"])):
            foreach ($arIBlock["ITEMS"] as $ITEM):
                $PRODUCT_ID_ARR[] = $ITEM['ID'];
            endforeach;
        endif;
    endforeach;
    if(count($PRODUCT_ID_ARR)) {
        $PR = getPriseArr($PRODUCT_ID_ARR);
        $arResult["PRISE"] = $PR;
        //p($arResult["PRISE"], 'p');
    }
}