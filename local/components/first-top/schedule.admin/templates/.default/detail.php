<?php
$APPLICATION->IncludeComponent(
    'first-top:schedule.detail',
    'listener',
    [
        'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
    ],
    null,
    [
        'HIDE_ICONS' => 'Y',
    ]
);
?>
