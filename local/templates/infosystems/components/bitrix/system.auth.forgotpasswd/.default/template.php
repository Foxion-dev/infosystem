<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
ShowMessage($arParams["~AUTH_RESULT"]);
?>

<div style="max-width: 600px;">
<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="form-horizontal" role="form">

<? if (strlen($arResult["BACKURL"]) > 0){ ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<? } ?>

	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<p><small><i><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></i></small></p>

    <div class="form-group">
        <label class="col-sm-2 control-label"><?=GetMessage("AUTH_LOGIN")?></label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input class="form-control input-lg" placeholder="Ваш логин" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
            <small><?=GetMessage("AUTH_OR")?></small>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"><?=GetMessage("AUTH_EMAIL")?></label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input class="form-control input-lg" placeholder="Ваш email" type="email" name="USER_EMAIL" maxlength="50" />
            </div>
        </div>
    </div>

    <? /* CAPTCHA */
    if ($arResult["USE_CAPTCHA"])
    {
        ?>
        <h2><?=GetMessage("CAPTCHA_REGF_TITLE")?></h2>
        <div class="form-group">

            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />

        </div>

        <div class="form-group">
            <label class="control-label">
                <span class="starrequired">*</span> <?=GetMessage("CAPTCHA_REGF_PROMT")?>:
            </label>
            <input type="text" name="captcha_word" maxlength="50" value="" class="form-control input-lg" />
        </div>

        <?
    }
    /* CAPTCHA */ ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input class="button button--common button--primary" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
        </div>
    </div>

</form>
</div>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
