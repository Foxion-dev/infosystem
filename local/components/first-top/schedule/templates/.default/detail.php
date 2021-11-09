<?php
use Bitrix\Main\Context;

global $USER;
$request = Context::getCurrent()->getRequest();
$result = \Bitrix\Main\UserGroupTable::getList(array(
    'filter' => [
        'USER_ID' => $USER->GetID(),
        'GROUP.ID' => [1, 8, 9, 10]
    ]
))->fetchAll();
?>
</div>
<?
$APPLICATION->IncludeComponent(
    'first-top:schedule.detail',
    $result ?
        'first-top:schedule.admin.detail':
        'first-top:schedule.detail',
    [
        'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
    ],
    null,
    [
        'HIDE_ICONS' => 'Y',
    ]
);
?>
<div class="js-calendar">
    <?php
    if ($request->isAjaxRequest()) {
        $APPLICATION->RestartBuffer();
    }
    $APPLICATION->IncludeComponent(
        $USER->IsAdmin() ?
            'first-top:schedule.admin.list':
            'first-top:schedule.list',
        '.default',
        [
            'SHOW_TITLE' => false
        ],
        null,
        [
            'HIDE_ICONS' => 'Y',
        ]
    );
    if ($request->isAjaxRequest()) {
        die();
    }?>
</div>
<div>
