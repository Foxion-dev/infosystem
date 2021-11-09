<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arValues = array('5' => 5, '10' => 10, '15' => 15, '20' => 20);
$arValuesCODE = array(
    'REQUEST_MATERIAL' => 'REQUEST_MATERIAL',
    'REQUEST_CALL' => 'REQUEST_CALL',
    'REQUEST_CALCULATION' => 'REQUEST_CALCULATION',
    'ALL' => 'ALL',
);
$arParameters = array(
	"PARAMETERS" => array(),
	"USER_PARAMETERS" => array(
		"COUNT" => array(
			"NAME" => GetMessage("REQUEST_COUNT"),
			"TYPE" => "LIST",
			"VALUES" => $arValues,
			"MULTIPLE" => "N",
			"DEFAULT" => 10
		),
		"UF_CODE" => array(
			"NAME" => GetMessage("REQUEST_UF_CODE"),
			"TYPE" => "LIST",
            "VALUES" => $arValuesCODE,
            "MULTIPLE" => "N",
			"DEFAULT" => "ALL"
		)
	)
);