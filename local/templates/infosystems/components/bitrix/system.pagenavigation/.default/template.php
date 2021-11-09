<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>

<?
//$arResult["NavQueryString"] = preg_replace("/[\&|\?]?SECTION_ID=[0-9]+/","",$arResult["NavQueryString"]);
//$arResult["NavQueryString"] = preg_replace("/[\&|\?]?SECT_ID=[0-9]+/","",$arResult["NavQueryString"]);
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="pagerBox">
<?
//$arResult["sUrlPath"] = preg_replace("/\/$/", "", $arResult["sUrlPath"]);
//$arResult["sUrlPath"] = preg_replace("/\/page\/[0-9]+/", "", $arResult["sUrlPath"]);

if ($arResult["NavPageNomer"] > $arResult["nStartPage"]){
    if ($arResult["NavPageNomer"]-1 == $arResult["nStartPage"]) {
        $arResult["NavPagePrevUrl"] = $arResult["sUrlPath"]."/";
    }
    else {
        $arResult["NavPagePrevUrl"] = $arResult["sUrlPath"]."/page/".($arResult["NavPageNomer"]-1);
    }
?>
	<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="foregoing" target="_self"></a>
<?
}
else {
?>
	<div class="foregoing noAct"></div>
<?
}
?>
    <div class="numBox">
<?
$bFirst = true;

if($arResult["NavPageNomer"] > 1) {
    if($arResult["nStartPage"] > 1) {
        $bFirst = false;
        if($arResult["bSavePage"]) {
?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" target="_self">1</a>
<?
        } else {
?>
        <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" target="_self">1</a>
<?
        }
        if ($arResult["nStartPage"] > 2){
?>
        <a href="#" class="hide">...</a>
<?
        }
    }
}

do {
    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]){
?>
        <a class="current" title=""><?=$arResult["nStartPage"]?></a>
<?
    }elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false){
?>
        <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" target="_self"><?=$arResult["nStartPage"]?></a>
<?
    }else{
?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" target="_self"><?=$arResult["nStartPage"]?></a>
<?
    }
    $arResult["nStartPage"]++;
    $bFirst = false;
} while($arResult["nStartPage"] <= $arResult["nEndPage"]);

if($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
    if ($arResult["nEndPage"] < $arResult["NavPageCount"]){
        if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)){
?>
        <a href="#" class="hide">...</a>
<?
        }
?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" target="_self"><?=$arResult["NavPageCount"]?></a>
<?
    }
}
?>
    </div>
<?
if ($arResult["NavPageNomer"] < $arResult["nEndPage"]){
    $arResult["NavPageNextUrl"] = $arResult["sUrlPath"]."/page/".($arResult["NavPageNomer"]+1);
?>
    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="following" target="_self"></a>
<?
}
else {
?>
    <div class="following noAct"></div>
<?
}
?>
</div>