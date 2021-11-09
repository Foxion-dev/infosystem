<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

$this->addExternalJs('/local/templates/infosystems/js/jvalidate.js');
// echo '<pre>', print_r($_SERVER), '</pre>';
?>

<form action="<?=$arParams['FORM_ACTION']?>" class="js-validate forms js-form form-pay" role="form" method="post">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name='WEB_FORM_ID' value="<?=$arParams['WEB_FORM_ID']?>"/>
    <input type="hidden" name='useCaptcha' value="<?=$arParams['isUseCaptcha']?>"/>
    <input type="hidden" name='currentPage' value="<?= $_SERVER['SERVER_NAME'] . $APPLICATION->GetCurPage()?>"/>
    <a href="##" class="logo-main">
        <div class="logo-ais icon-ais"></div>
        <p>академия информационных систем</p>
    </a>
    <h3 class="form-title"><? $APPLICATION->ShowTitle(false)?> </h3>

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

        <?php if ($arParams['LINK_AGREEMENT'] && $USER->IsAdmin()):?>
            <div class="row row-checkbox">
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:main.userconsent.request",
                    "offerta",
                    array(
                        "ID" => $arParams['LINK_AGREEMENT'],
                        "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                        "AUTO_SAVE" => "Y",
                        "IS_LOADED" => "N",
                        "ORIGIN_ID" => "agreement",
                        "ORIGINATOR_ID" => "",
                        "REPLACE" => array(
                            "button_caption" => $arResult['arForm']['BUTTON']
                        ),
                        "INPUT_NAME" => "agreement"
                    )
                );?>
            </div>
        <?php else:?>
            <p class='privacy-text'>
                Оформляя заказ, вы соглашаетесь с <a href="<?=!empty($arParams['LINK_AGREEMENT']) && $USER->IsAdmin() ? $arParams['LINK_AGREEMENT'] : '/about/privacy/'?>" target="_black">обработкой персональных данных</a>
            </p>
        <?php endif?>

            <div class="row row-checkbox">
                <?php

                $APPLICATION->IncludeComponent(
                    "bitrix:main.userconsent.request",
                    $USER->IsAdmin()?"offerta":"",
                    array(
                        "ID" => $arParams['LINK_OFFER']??2,
                        "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                        "AUTO_SAVE" => "Y",
                        "IS_LOADED" => "N",
                        "ORIGIN_ID" => "offer",
                        "ORIGINATOR_ID" => "",
                        "REPLACE" => array(
                            "button_caption" => $arResult['arForm']['BUTTON']
                        ),
                        "INPUT_NAME" => "offer"
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
