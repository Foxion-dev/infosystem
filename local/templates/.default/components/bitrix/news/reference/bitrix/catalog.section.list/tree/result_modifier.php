<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*p($arParams['IBLOCK_TYPE'],'p');
p($arParams['IBLOCK_ID'],'p');*/
//p($arResult,'p');
if(count($arResult['SECTIONS']) && CModule::IncludeModule("iblock")){
    $SID = [];
    foreach ($arResult['SECTIONS'] as $SECTION){
        $SID[] = $SECTION['ID'];
    }
    //p($SID,'p');
    $arSelect = ['ID','IBLOCK_ID','NAME','UF_DOC'];
    $db = CIBlockSection::GetList(['ID'=>'ASC'], ['IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ID'=>$SID], false, $arSelect);
    while($arr = $db->GetNext()){
        if(!$arr['UF_DOC']) continue;
        //p($arr,'p');
        $arResult['UF_DOC'][$arr['ID']] = CFile::GetPath($arr['UF_DOC']);
    }
    //p($arResult['UF_DOC'],'p');
}
