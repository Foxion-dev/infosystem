<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC = $arRubric;
global $APPLICATION;
?>

<?$SUBSCRIBE_TEMPLATE_RESULT = $APPLICATION->IncludeComponent("bitrix:subscribe.news", ".default",
	Array(
		"SITE_ID" => "s1",
		"IBLOCK_TYPE" => "news",
		"ID" => "1",
		"SORT_BY" => "ACTIVE_FROM",
		"SORT_ORDER" => "DESC",
	),
	null,
	array(
		"HIDE_ICONS" => "Y",
	)
);?>

<? // возвращает парамемтры и т.д.
if($SUBSCRIBE_TEMPLATE_RESULT)
	return array(
		"SUBJECT"=>$SUBSCRIBE_TEMPLATE_RUBRIC["NAME"],
		"BODY_TYPE"=>"html",
		"CHARSET"=>"UTF-8",
		"DIRECT_SEND"=>"Y",
		"FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
	);
else
	return false;
?>