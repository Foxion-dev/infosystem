<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
$this->setFrameMode(true); ?>
<div class="alert alert-success" id="alert-contact-success" style="display: none;"></div>
<div class="alert alert-danger" id="alert-contact-error" style="display: none;"></div>
<form action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax">
    <div class="row input-form">
        <div class="col-12"><h3>Обратная связь</h3></div>
        <div class="col-12">
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><label>Ваше имя и фамилия *</label></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><input name="NAME" type="text" class="form-control input-lg req" placeholder="Ваше имя"></div>
            </div>
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><label>Телефон *</label></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><input name="TELEFON" type="text" class="form-control input-lg req phone" placeholder=""></div>
            </div>
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><label>Адрес электронной почты *</label></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><input name="EMAIL_USER" type="text" class="form-control input-lg req" placeholder=""></div>
            </div>
        </div>
        <div class="col-12">
            <? if(!empty($arResult['THEMES_USER'])): ?>
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><label>Какое направление Вас интересует?</label></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <select name="THEMES_USER" type="text" class="niceSelect form-control input-lg">
                    <? foreach ($arResult['THEMES_USER'] as $t=>$v): ?>
                    <option value="<?=$t?>"><?=$v?></option>
                    <? endforeach; ?>
                </select>
                </div>
            </div>
            <? endif; ?>
            <div class="form-group"><label>Текст письма *</label><textarea name="COMMENT" cols="2" type="text" class="form-control input-lg req" placeholder=""></textarea></div>
            <?if($arParams["USE_CAPTCHA"] == "Y"):?>
            <div class="form-group row">
                <div class="col-12"><label>Код на картинке: *</label></div>
                <div class="col-12 col-sm-12 col-md-6">
                    <input type="hidden" class="capCode" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                    <input type="text" class="form-control input-lg req" name="captcha_word" size="30" maxlength="50" value="">
                </div>
                <div class="col-12 col-sm-12 col-md-6 CAPTCHA">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
                </div>
            </div>
            <?endif;?>
			<input type="text" name="ASC_TEST" placeholder="" class="asctestin" />
            <div class="form-group">
                <label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" class="req" value="1"><span></span> Согласен(на) на обработку персональных данных</label>
            </div>
            <div style="text-align: right;">
                <?=bitrix_sessid_post()?>
                <input name="go" type="hidden" value="orderContact">
                <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
                <a class="g-recaptcha" data-size="invisible" data-sitekey="6Lc4hKcUAAAAAEf2QkZHUIBplrAL-CL_M80zV0NA"></a>
                <button type="submit" value="Y" class="button button--common button--primary">ОТПРАВИТЬ</button>
            </div>
        </div>
    </div>
</form>