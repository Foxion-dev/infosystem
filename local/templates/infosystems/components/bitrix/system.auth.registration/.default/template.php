<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<div class="bx-auth" style="max-width: 600px; padding-top: 15px;">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" class="form-horizontal" role="form">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />

    <div class="form-group">
        <label class="control-label"><span class="starrequired">*</span> <?=GetMessage("AUTH_LOGIN")?></label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input placeholder="Ваш логин" class="bx-auth-input form-control input-lg" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
            <small><i><?=GetMessage("AUTH_LOGIN_TEXT")?></i></small>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label"><span class="starrequired">*</span> <?=GetMessage("AUTH_PASSWORD_REQ")?></label>
        <div class="col-sm-10">
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input placeholder="Ваш пароль" type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input form-control input-lg" />
                <?if($arResult["SECURE_AUTH"]):?>
                    <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                            <div class="bx-auth-secure-icon"></div>
                        </span>
                    <noscript>
                        <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                        </span>
                    </noscript>
                    <script type="text/javascript">
                        document.getElementById('bx_auth_secure').style.display = 'inline-block';
                    </script>
                <?endif?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label"><span class="starrequired">*</span> <?=GetMessage("AUTH_CONFIRM_ADD")?></label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input placeholder="<?=GetMessage("AUTH_CONFIRM_TEXT")?>" type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input form-control input-lg" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label"><span class="starrequired">*</span> <?=GetMessage("AUTH_EMAIL")?></label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input placeholder="<?=GetMessage("AUTH_EMAIL_TEXT")?>" type="email" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input form-control input-lg" />
            </div>
        </div>
    </div>

    <?// ********************* User properties ***************************************************?>
    <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
        <h2><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></h2>
        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
            <? /**/ ?>
            <div class="form-group">
            <label class="control-label"><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?><?=$arUserField["EDIT_FORM_LABEL"]?>:</label>
                <div class="col-sm-10">
            <?$APPLICATION->IncludeComponent(
                        "bitrix:system.field.edit",
                        $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                        array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
            </div>
            </div>
            <? /**/ ?>
        <?endforeach;?>
    <?endif;?>

    <? /* CAPTCHA */
    if ($arResult["USE_CAPTCHA"] == "Y")
    {
        ?>
        <!--<h2><?=GetMessage("CAPTCHA_REGF_TITLE")?></h2>-->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">
                <span class="starrequired">*</span> <?=GetMessage("CAPTCHA_REGF_PROMT")?>:
            </label>
            <div class="col-sm-10">
                <input type="text" name="captcha_word" maxlength="50" value="" class="form-control input-lg" />
            </div>
        </div>

    <?
    }
    /* CAPTCHA */ ?>

    <? /* Submit */ ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="button button--common button--primary" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <!--p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p-->
            <p><span class="starrequired">*</span> <?=GetMessage("AUTH_REQ")?></p>
            <p><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>
        </div>
    </div>

</form>
</noindex>

    <script type="text/javascript">
    document.bform.USER_NAME.focus();
    </script>

    <? // echo "<pre>"; print_r($arResult); echo "</pre>"; ?>

<?endif?>
</div>