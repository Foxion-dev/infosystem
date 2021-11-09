<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="subscribe-index">

<h4><?echo GetMessage("SUBSCR_NEW_TITLE")?></h4>
<p class="alert alert-success" style="margin-bottom: 10px;"><?echo GetMessage("SUBSCR_NEW_NOTE")?></p>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="subscrForm">

        <div class="form-group"><strong><?echo GetMessage("SUBSCR_NAME")?></strong></div>
        <?/*echo GetMessage("SUBSCR_DESC")?>
        <?if($arResult["SHOW_COUNT"]):?>
            <?echo GetMessage("SUBSCR_CNT")?>
        <?endif;*/?>

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
        <div class="form-group">
            <label for="sf_RUB_ID_<?=$itemID?>" class="cbLabel">
                <input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemID?>" value="<?=$itemValue["ID"]?>" checked /><span></span>
                <?=$itemValue["NAME"]?>
            </label>
			<?/*=$itemValue["DESCRIPTION"]?>
			<?if($arResult["SHOW_COUNT"]):?>
				<?=$itemValue["SUBSCRIBER_COUNT"]?>
			<?endif*/?>
        </div>
		<?endforeach;?>
	<div class="row">
        <div class="col-12"><div class="form-group"><label><?echo GetMessage("SUBSCR_ADDR")?></label></div></div>
        <div class="col-6"><input type="text" class="form-control" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></div>
        <div class="col-6"><input type="submit" class="button button--common button--primary" value="<?echo GetMessage("SUBSCR_BUTTON")?>" /></div>
    </div>
</form>
<br />

<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="subscrForm">
<?echo bitrix_sessid_post();?>
<div class="form-group"><strong><?echo GetMessage("SUBSCR_EDIT_TITLE")?></strong></div>
<div class="form-group">
    <label>e-mail</label>
    <input type="text" class="form-control" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" />
    <?if($arResult["SHOW_PASS"]=="Y"):?>
        <label><?echo GetMessage("SUBSCR_EDIT_PASS")?><label class="starrequired">*</label>
        <input type="password" class="form-control" name="AUTH_PASS" size="20" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" />
    <?else:?>
        <p><span class="green"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></span><span class="starrequired">*</span></p>
    <?endif;?>
    <small><?echo GetMessage("SUBSCR_EDIT_NOTE")?></small>
</div>
<div class="form-group">
    <input type="submit" class="button button--common button--primary" value="<?echo GetMessage("SUBSCR_EDIT_BUTTON")?>" />
    <input type="hidden" name="action" value="authorize" />
</div>
</form>
<br />

<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="subscrForm">
<?echo bitrix_sessid_post();?>
<div class="form-group"><strong><?echo GetMessage("SUBSCR_PASS_TITLE")?></strong></div>
<div class="form-group">
    <label>e-mail</label>
    <input type="text" class="form-control" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" />
    <p><small><?echo GetMessage("SUBSCR_PASS_NOTE")?></small></p>
</div>
<div class="form-group">
    <input type="submit" class="button button--common button--primary" value="<?echo GetMessage("SUBSCR_PASS_BUTTON")?>" />
    <input type="hidden" name="action" value="sendpassword" />
</div>
</form>
<br />

<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="subscrForm">
<?echo bitrix_sessid_post();?>
<div class="form-group"><strong><?echo GetMessage("SUBSCR_UNSUBSCRIBE_TITLE")?></strong></div>
<div class="form-group">
    <label>e-mail</label>
    <input type="text" class="form-control" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" />
    <?if($arResult["SHOW_PASS"]=="Y"):?>
        <label><?echo GetMessage("SUBSCR_EDIT_PASS")?><span class="starrequired">*</span></label>
        <input type="password" class="form-control" name="AUTH_PASS" size="20" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" />
    <?else:?>
        <p><span class="green"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></span><span class="starrequired">*</span></p>
    <?endif;?>
    <p><small><?echo GetMessage("SUBSCR_UNSUBSCRIBE_NOTE")?></small></p>
</div>
<div class="form-group">
    <input type="submit" class="button button--common button--primary" value="<?echo GetMessage("SUBSCR_EDIT_BUTTON")?>" />
    <input type="hidden" name="action" value="authorize" />
</div>

</form>

    <p><small><span class="starrequired">*&nbsp;</span><?echo GetMessage("SUBSCR_NOTE")?></small></p>

</div>