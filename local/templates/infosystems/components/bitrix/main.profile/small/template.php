<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="bx-auth-profile catalogOllCat">
	<a class="back-personal" href="/personal/">&larr; Вернуться в личный кабинет</a>
    <div class="alert alert-success" id="alert-main-profile-success" style="display: none;">
        <? if ($arResult['DATA_SAVED'] == 'Y') {
            ShowNote(GetMessage('PROFILE_DATA_SAVED'));
        } ?></div>
    <div class="alert alert-danger" id="alert-main-profile-error" style="display: none;"><?ShowError($arResult["strProfileError"]);?></div>

<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" class="SubmitFormAjax">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="go" value="MainProfile" />

<div class="profile-link profile-user-div-link">
    <h3><?=GetMessage("REG_SHOW_HIDE")?></h3>
</div>
<div class="profile-block-shown" id="user_div_reg">
    <div class="row table-responsive">
	<?
	if($arResult["ID"]>0)
	{
	?>
		<?if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)	{
		?>
        <div class="col-6 col-md-6 col-lg-4"><small><?=GetMessage('LAST_UPDATE')?></small></div>
        <div class="col-6 col-md-6 col-lg-8"><small><?=$arResult["arUser"]["TIMESTAMP_X"]?></small></div>
		<? } ?>
		<?if (strlen($arResult["arUser"]["LAST_LOGIN"])>0){	?>
        <div class="col-6 col-md-6 col-lg-4"><small><?=GetMessage('LAST_LOGIN')?></small></div>
        <div class="col-6 col-md-6 col-lg-8"><small><?=$arResult["arUser"]["LAST_LOGIN"]?></small></div>
		<? } ?>
        <div class="col-12"></div>
	<? } ?>
      <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('LAST_NAME')?> *</div>
      <div class="col-12 col-md-12 col-lg-8"><input class="form-control req" type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div>
      <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('NAME')?> *</div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control req" type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('SECOND_NAME')?> *</div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control req" type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div>

        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('EMAIL')?><span class="starrequired">*</span></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control req" type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></div>

        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('LOGIN')?><span class="starrequired">*</span></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control req" type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></div>

<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('NEW_PASSWORD_REQ')?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" /></div>
<?if($arResult["SECURE_AUTH"]):?>
        <div class="col-12 col-md-12 col-lg-8">
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
        </div>
<?endif?>
    <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></div>
    <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></div>
<?endif?>
    </div><!--//table-responsive-->
</div>

<div class="profile-link profile-user-div-link">
    <h3><?=GetMessage("USER_PERSONAL_INFO")?></h3>
</div>
<div id="user_div_personal" class="profile-block-shown">
    <div class="row table-responsive">
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('USER_PHONE')?> *</div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control phone req" type="text" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" /></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('USER_COMPANY')?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control" type="text" name="WORK_COMPANY" maxlength="255" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('USER_ZIP')?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="text" name="PERSONAL_ZIP" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" /></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('USER_CITY')?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="text" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('USER_STATE')?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="text" name="PERSONAL_STATE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" /></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage("USER_STREET")?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="text" name="PERSONAL_STREET" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STREET"]?>"></div>
        <div class="col-12 col-md-12 col-lg-4"><?=GetMessage('USER_POSITION')?></div>
        <div class="col-12 col-md-12 col-lg-8"><input class="form-control " type="text" name="WORK_POSITION" maxlength="255" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" /></div>

    </div><!--//table-responsive-->
</div>

<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
<div class="profile-link profile-user-div-link">
    <h3>Реквизиты компании</h3>
</div>
<div id="user_div_personal" class="profile-block-shown">
    <div class="row table-responsive">
        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
            <div class="col-12 col-md-12 col-lg-4"><?=$arUserField["EDIT_FORM_LABEL"]?></div>
            <div class="col-12 col-md-12 col-lg-8">
                <?$APPLICATION->IncludeComponent("bitrix:system.field.edit",$arUserField["USER_TYPE"]["USER_TYPE_ID"],
                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"N"));?>
            </div>
        <? endforeach; ?>
    </div><!--//table-responsive-->
</div>
<? endif; ?>

	<?// ******************** /User properties ***************************************************?>
	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
    <input type="hidden" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
	<p><input type="submit" class="button button--common button--secondary" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<!--<input type="reset" class="button button--common button--secondary" value="<?=GetMessage('MAIN_RESET');?>">--></p>
</form>
<? /*
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
} */
?>
</div>