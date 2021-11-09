<?php
use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();
?>

</div>
    <div class="js-calendar">
        <?php
        if ($request->isAjaxRequest()) {
            $APPLICATION->RestartBuffer();
        }
        $APPLICATION->IncludeComponent(
            'first-top:schedule.list',
            '.default',
            [

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

