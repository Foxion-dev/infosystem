<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

$this->addExternalJs('/local/templates/infosystems/js/jvalidate.js');
?>

<form action="<?=$arParams['FORM_ACTION']?>" class="js-validate forms js-form" role="form" method="post">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name='WEB_FORM_ID' value="<?=$arParams['WEB_FORM_ID']?>"/>
    <input type="hidden" name='useCaptcha' value="<?=$arParams['isUseCaptcha']?>"/>

    <h3 class="form-title"><?= $arResult["FORM_TITLE"]?></h3>

    <?php if ($arResult['FORM_DESCRIPTION']):?>
        <p class="form-subtitle"><?=$arResult['FORM_DESCRIPTION']?></p>
    <?php endif ?>

    <p class="form-error js-error"></p>

    <div class="flex-row">
        <?php foreach ($arResult['QUESTIONS'] as $fieldSid => $arQuestion): ?>
            <?php if ($arQuestion['FIELD_TYPE'] == 'hidden'):?>
                <?=$arQuestion['HTML_CODE']?>
            <?php elseif ($arQuestion['FIELD_TYPE'] == 'checkbox'):?>
                <div class="row row-checkbox">
                    <label class="label">
                        <?=$arQuestion['HTML_CODE']?>
                    </label>
                </div>
            <?php elseif ($arQuestion['FIELD_TYPE'] == 'dropdown'):?>
                <div class="row">
                    <div class="select">
                        <label class="label"><?=$arQuestion['CAPTION']?></label>
                        <?=$arQuestion['HTML_CODE']?>
                    </div>
                </div>
            <?php else:?>
                <div class="row">
                    <label class="label"><?=$arQuestion['CAPTION']?></label>
                    <?=$arQuestion['HTML_CODE']?>
                </div>
            <?php endif?>
        <?php endforeach?>
        <div class="row row-checkbox">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:main.userconsent.request",
                "",
                array(
                    "ID" => $arParams["USER_CONSENT_ID"],
                    "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                    "AUTO_SAVE" => "Y",
                    "IS_LOADED" => "N",
                    "ORIGIN_ID" => "sender/sub",
                    "ORIGINATOR_ID" => "",
                    "REPLACE" => array(
                        "button_caption" => $arResult['arForm']['BUTTON']
                    ),
                )
            );?>
        </div>
    </div>
    <div class="flex-row">
        <button name="web_form_submit" class="btn" type="submit">
            <?=$arResult['arForm']['BUTTON']?>
        </button>
    </div>
</form>
