<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__DIR__ . '/user_consent.php');
$config = \Bitrix\Main\Web\Json::encode($arResult['CONFIG']);
$linkClassName = 'main-user-consent-request-announce';
if ($arResult['URL'])
{
	$url = htmlspecialcharsbx(\CUtil::JSEscape($arResult['URL']));
	$label = htmlspecialcharsbx('Прочитал и согласен с '.$arResult['LABEL']);

	$label = explode('%', $label);
	$label = implode('', array_merge(
		array_slice($label, 0, 1),
		['<a href="' . $url  . '" target="_blank">'],
		array_slice($label, 1, 1),
		['</a>'],
		array_slice($label, 2)
	));
}
else
{
	$label = htmlspecialcharsbx($arResult['INPUT_LABEL']);
	$linkClassName .= '-link';
}
?>
<label data-bx-user-consent="<?=$arResult['CONFIG']['id']?>" id="consent_<?=$arResult['CONFIG']['id']?>" class="label main-user-consent-request">
	<input type="checkbox" value="Y" <?=($arParams['IS_CHECKED'] ? 'checked' : '')?> name="<?=htmlspecialcharsbx($arParams['INPUT_NAME'])?>">
	<span class="<?=$linkClassName?>"><?=$label?></span>
</label>

<div data-main-user-consent-popup="<?=$arResult['CONFIG']['id']?>" class="main-user-consent-request-popup" style="display: none">
    <div class="main-user-consent-request-popup-cont">
        <div data-bx-head="" class="main-user-consent-request-popup-header">
            <p><strong><?=$arResult['DATA']['NAME']?></strong></p>
        </div>
        <div class="main-user-consent-request-popup-body">
            <div data-bx-content="" class="main-user-consent-request-popup-content">
                <div class="main-user-consent-request-popup-textarea-block">
                    <div data-bx-textarea="" class="main-user-consent-request-popup-text">
                        <?=$arResult['TEXT']?>
                    </div>
                </div>
                <div class="main-user-consent-request-popup-buttons">
                    <span data-bx-btn-accept="" class="main-user-consent-request-popup-button main-user-consent-request-popup-button-acc"><?=Loc::getMessage('MAIN_USER_CONSENT_REQUEST_BTN_ACCEPT')?></span>
                    <span data-bx-btn-reject="" class="main-user-consent-request-popup-button main-user-consent-request-popup-button-rej"><?=Loc::getMessage('MAIN_USER_CONSENT_REQUEST_BTN_REJECT')?></span>
                </div>
            </div>
        </div>
    </div>
</div>
