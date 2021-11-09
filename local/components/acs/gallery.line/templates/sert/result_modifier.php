<?$album=[];
$book=[];
foreach($arResult['ITEMS'] as $arItem){
	if($arItem['IBLOCK_SECTION_ID']==59) $book[]=$arItem;		
	if($arItem['IBLOCK_SECTION_ID']==58) $album[]=$arItem;
}
$arResult['ITEMS']=['ALBUM'=>$album,'BOOK'=>$book];