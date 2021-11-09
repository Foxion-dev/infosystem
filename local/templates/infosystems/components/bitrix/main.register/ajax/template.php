<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<? $this->setFrameMode(true); ?>
<div id="registration" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalAuthorization" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel"><?=GetMessage("AUTH_REGISTER")?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>×</span></button>
        </div><!--/modal-header-->

        <div class="modal-body">

        <div class="alert alert-success" id="alert-regi-danger-success" style="display: none;"></div>
        <div class="alert alert-danger" id="alert-regi-danger-error" style="display: none;"></div>

        <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" role="form" class="SubmitFormAjax">
            <input type="hidden" name="go" value="registr_ajax" />
            <? if($arResult["BACKURL"] <> ''){ ?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?  } ?>
            <? foreach ($arResult["SHOW_FIELDS"] as $FIELD){
                if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true){
                    // танцы с полями и т.д.
                }else{ ?>
                <div class="form-group">
                    <label class="control-label"><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></label>
                    <div class="input-group">
                    <? switch ($FIELD)
                    {
                        case "PASSWORD":
                            ?><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input placeholder="Ваш пароль" size="30" class="form-control input-lg bx-auth-input req" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off"/>
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
                            <?
                            break;
                        case "CONFIRM_PASSWORD":
                            ?><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input placeholder="Подтверждение пароля" size="30" class="form-control input-lg req" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
                            break;

                        case "PERSONAL_GENDER":
                            ?><select class="form-control input-lg" name="REGISTER[<?=$FIELD?>]">
                            <option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
                            <option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
                            <option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
                            </select><?
                            break;

                        case "PERSONAL_COUNTRY":
                        case "WORK_COUNTRY":
                            ?><select class="form-control input-lg" name="REGISTER[<?=$FIELD?>]"><?
                            foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
                            {
                                ?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
                            <?
                            }
                            ?></select><?
                            break;

                        case "PERSONAL_PHOTO":
                        case "WORK_LOGO":
                            ?><input size="30" type="file" class="form-control" name="REGISTER_FILES_<?=$FIELD?>" /><?
                            break;

                        case "PERSONAL_NOTES":
                        case "WORK_NOTES":
                            ?><textarea cols="30" rows="5" class="form-control" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
                            break;
                        case "LOGIN":
                            ?><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input placeholder="Ваш логин" size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-control input-lg req" /><?
                            break;
                        case "EMAIL":
                            ?><span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input placeholder="Ваш E-Mail" size="30" type="email" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-control input-lg req" /><?
                            break;
                        default:
                            if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
                            ?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-control input-lg" /><?
                            if ($FIELD == "PERSONAL_BIRTHDAY")
                                $APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar',
                                    '',
                                    array(
                                        'SHOW_INPUT' => 'N',
                                        'FORM_NAME' => 'regform',
                                        'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                        'SHOW_TIME' => 'N'
                                    ),
                                    null,
                                    array("HIDE_ICONS"=>"Y")
                                );
                            ?><?
                    }?>
                    </div>
                </div>
                <? }
            } ?>

            <? if ($arResult["USE_CAPTCHA"] == "Y"){ ?>
            <div class="form-group">
                <label class="control-label"><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></label>
                <div class="input-group">
                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                    <input type="text" name="captcha_word" maxlength="50" value="" class="form-control input-lg req" />
                </div>
            </div>
            <? } ?>

            <div class="form-group" align="center">
                <input type="hidden" name="register_submit_button" value="Y" />
                <input class="button button--common button--primary" type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />
            </div>

            <div class="form-group" align="center"><small><span class="starrequired">*</span> <?=GetMessage("AUTH_REQ")?></small></div>

        </form>

</div>
</div></div></div>