<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
// echo "<pre>"; print_r($arResult); echo "</pre>";
// echo "<pre>"; print_r($arParams); echo "</pre>";
//
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>

<div class="bx-auth">
    <? /*if($arResult["AUTH_SERVICES"]):?>	<!--<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>--><? endif; <div class="bx-auth-note"><?=GetMessage("AUTH_PLEASE_AUTH")?></div>*/ ?>

	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="form-horizontal" role="form">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

        <div class="form-group">
            <label class="control-label"><?=GetMessage("AUTH_LOGIN")?></label>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input placeholder="Ваш логин" class="bx-auth-input form-control input-lg" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label"><?=GetMessage("AUTH_PASSWORD")?></label>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input placeholder="Ваш пароль" class="bx-auth-input pass form-control input-lg" type="password" name="USER_PASSWORD" maxlength="50" />
            </div>
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

        <?if($arResult["CAPTCHA_CODE"]):?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?=GetMessage("AUTH_CAPTCHA_PROMT")?></label>
            <div class="col-sm-10">
                <input class="bx-auth-input form-control input-lg" type="text" name="captcha_word" maxlength="50" value="" size="15" />
            </div>
        </div>
        <?endif;?>

        <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label for="USER_REMEMBER" class="cbLabel"><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /><span></span>&nbsp;&nbsp;&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label>
                </div>
            </div>
        </div>
        <?endif?>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="button button--common button--primary" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                <noindex>
                <b><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></b>
                </noindex>
            <?endif?>
            <?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
                <noindex>
                &nbsp;/&nbsp;<b><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></b>
                <?//=GetMessage("AUTH_FIRST_ONE")?>
                </noindex>
            <?endif?>
            </div>
        </div>

	</form>
</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<? /* if($arResult["AUTH_SERVICES"]):?>
    <?  $APPLICATION->IncludeComponent("acs:socserv.auth.form", ".default",
        array(
            "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
            "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
            "AUTH_URL" => $arResult["AUTH_URL"],
            "POST" => $arResult["POST"],
            "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
            "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
            "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
        ),
        $component,
        array("HIDE_ICONS"=>"Y")
    ); ?>
<?endif */ ?>

<? $APPLICATION->IncludeComponent("ulogin:auth", "",
    Array(
        "display" => 'panel',
        'theme' => 'flat',
        "PROVIDERS" => "vkontakte,odnoklassniki,mailru,facebook,twitter",
        "HIDDEN" => "other",
        "TYPE" => "small",
        "SEND_MAIL" => "N",
        "SOCIAL_LINK" => "Y",
        "GROUP_ID" => array(),
        "ULOGINID1" => "",
        "ULOGINID2" => ""
    ), $component
); ?>
