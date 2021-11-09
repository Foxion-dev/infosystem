<?
$IBLOCK_ID = 48;
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "PROPERTY_LINK");
$arFilter = Array("IBLOCK_ID" => IntVal($IBLOCK_ID), "ACTIVE" => "Y");
$bannersRes = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize" => 500), $arSelect);
while ($ob = $bannersRes->GetNextElement()) {
    $arResult['BANNERS'][] = $ob->GetFields();
}
?>