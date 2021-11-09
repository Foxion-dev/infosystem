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
    <div class="js-calendar">
        <?php
        if ($request->isAjaxRequest()) {
            $APPLICATION->RestartBuffer();
        }
        $APPLICATION->IncludeComponent(
            $result ?
                'first-top:schedule.admin.list':
                'first-top:schedule.list',
            '.default',
            [
                'SHOW_TITLE' => true
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

