<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
//
global $USER, $APPLICATION;
$CURRENT_BUDGET = 0;
if($USER->IsAuthorized() && \Bitrix\Main\Loader::includeModule('iblock') && \Bitrix\Main\Loader::includeModule("sale")) {
    $USER_ID = $USER->GetID();
    if ($arr = CSaleUserAccount::GetByUserID($USER_ID, "RUB")) {
        $CURRENT_BUDGET = number_format($arr["CURRENT_BUDGET"], 0, '', ' ');
    }
} ?>

<div class="container gift-current-budget-body">
    <div class="gift-current-budget">
        мои бонусы: <span><?=$CURRENT_BUDGET?></span>
    </div>
</div>