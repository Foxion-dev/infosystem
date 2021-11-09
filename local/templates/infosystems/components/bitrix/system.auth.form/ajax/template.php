<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); ?>
<?if($arResult["FORM_TYPE"] == "login"):?>
<div id="authorization" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalAuthorization" aria-hidden="true">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>×</span></button>
            </div><!--//modal-header-->

            <div class="modal-body">

            <div class="alert alert-success" id="alert-auth-danger-success" style="display: none;"></div>
            <div class="alert alert-danger" id="alert-auth-danger-error" style="display: none;"></div>

            <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" role="role" class="SubmitFormAjax" action="<?=$arResult["AUTH_URL"]?>">
                <? if ($arResult["BACKURL"] <> ''): ?>
                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <? endif ?>
                <? foreach ($arResult["POST"] as $key => $value): ?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                <? endforeach ?>
                <input type="hidden" name="AUTH_FORM" value="Y"/>
                <input type="hidden" name="TYPE" value="AUTH"/>
                <input type="hidden" name="go" value="auth_ajax"/>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?=GetMessage("AUTH_LOGIN")?>:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input placeholder="Ваш логин" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" class="login form-control input-lg req"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2"><?=GetMessage("AUTH_PASSWORD")?>:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input placeholder="Ваш пароль" type="password" name="USER_PASSWORD" maxlength="50" size="17" class="form-control input-lg req"/>
                    </div>
                </div>
                <? if ($arResult["STORE_PASSWORD"] == "Y"){ ?>
                    <div class="form-group">
                <label class="cbLabel" for="USER_REMEMBER_frm" title="<?= GetMessage("AUTH_REMEMBER_ME") ?>">
                    <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y"/><span></span> &nbsp; <? echo GetMessage("AUTH_REMEMBER_SHORT") ?>
                </label></div>
                <? } ?>
                <? if ($arResult["CAPTCHA_CODE"]){ ?>
                <div class="form-group">
                    <label for="exampleInputEmail3"><?=GetMessage("AUTH_CAPTCHA_PROMT")?>:</label>
                    <div class="input-group">
                        <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"  width="180" height="40" alt="CAPTCHA"/>
                        <input type="text" name="captcha_word" maxlength="50" value="" class="form-control req" />
                    </div>
                </div>
                <? } ?>

                <div class="form-group" align="center" style="padding-top: 7px;">
                    <? if ($arResult["NEW_USER_REGISTRATION"] == "Y"){ ?>
                    <noindex><i><a class="flRight" href="javascript:void(0);" rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a></i></noindex>&nbsp;&nbsp;
                    <? } ?>
                    <noindex><i><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a></i></noindex>
                </div>

                <div class="form-group" align="center">
                    <input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" class="button button--common button--primary"/>
                </div>


            </form>

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

            </div><!--/modal-body-->
        </div>
    </div>
</div> <!-- end Small modal -->

<script type="text/javascript">
    /* document.bform.USER_NAME.focus(); */
    $(function() {
        /* показываем регистрацию */
        $('#authorization').on('click', 'a.flRight', function(event){
            event.preventDefault();
            $('#authorization').modal('hide');
            $('#registration').modal();
        });
    });
    /* */
</script>
<?endif?>
