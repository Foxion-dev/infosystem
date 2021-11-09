<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

/* $this->addExternalCss("/bitrix/css/main/font-awesome.css"); */
CJSCore::Init(array("ajax"));

//Let's determine what value to display: rating or average ?
if($arParams["DISPLAY_AS_RATING"] == "vote_avg")
{
	if($arResult["PROPERTIES"]["vote_count"]["VALUE"])
		$DISPLAY_VALUE = round($arResult["PROPERTIES"]["vote_sum"]["VALUE"]/$arResult["PROPERTIES"]["vote_count"]["VALUE"], 2);
	else
		$DISPLAY_VALUE = 0;
}
else
{
	$DISPLAY_VALUE = $arResult["PROPERTIES"]["rating"]["VALUE"];
}
$voteContainerId = 'vote_'.$arResult["ID"];
?>
<? //p($arResult["PROPERTIES"],'p'); ?>
<div class="bx-rating text-primary <?=((!$arResult["VOTED"] && $arParams["READ_ONLY"]!=="Y")?'':'active')?>" id="<?echo $voteContainerId?>">
    <div data-title="" data-item="<?=$arParams["ELEMENT_ID"]?>" class="favorPressaAdd"><i class="fa fa-star" aria-hidden="true"></i></div>
    <div class="bx-rating-body">
        <div class="bx-rating-star">
        <?
        $onclick = "JCFlatVote.do_vote(this, '".$voteContainerId."', ".$arResult["AJAX_PARAMS"].")";
        foreach ($arResult["VOTE_NAMES"] as $i => $name)
        {
            //if($i != count($arResult["VOTE_NAMES"])-1)continue; // показываем одну звездочку
            if ($DISPLAY_VALUE && round($DISPLAY_VALUE) > $i)
                $className = "fa fa-star";
            else
                $className = "fa fa-star-o";

            $itemContainerId = $voteContainerId.'_'.$i;
            ?><i
                class="<?echo $className?> <?=((!$arResult["VOTED"] && $arParams["READ_ONLY"]!=="Y")?'cursor-pointer':'')?>"
                id="<?echo $itemContainerId?>"
                title="<?echo $name?>"
                <?if (!$arResult["VOTED"] && $arParams["READ_ONLY"]!=="Y"):?>
                    onmouseover="JCFlatVote.trace_vote(this, true);"
                    onmouseout="JCFlatVote.trace_vote(this, false)"
                    onclick="<?echo htmlspecialcharsbx($onclick);?>"
                <?endif;?>
            ></i><?
        } ?>
        </div>
    <? if ($arParams["SHOW_RATING"] == "Y"):?>
        <div class="bx-rating-text">
        <?if($arResult["PROPERTIES"]["vote_count"]["VALUE"]):?>
            <?=GetMessage("T_IBLOCK_VOTE_RESULTS", array("#VOTES#"=>$arResult["PROPERTIES"]["vote_count"]["VALUE"] , "#RATING#"=>$DISPLAY_VALUE))?>
        <?else:?>
            <?=GetMessage("T_IBLOCK_VOTE_NO_RESULTS")?>
        <?endif?>
        </div>
	<? endif; ?>
    </div><!--//bx-rating-body-->
</div>