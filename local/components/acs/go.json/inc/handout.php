<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
global $USER, $APPLICATION;
$arResult['CAPTCHA'] = $APPLICATION->CaptchaGetCode();
// ?>

<form action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax">
    <div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div>
    <div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>
    <div class="row input-form">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <? /**/ ?>
            <div class="form-group row">
                <div class="col-12"><label class="sr-only">Код с картинки: *</label></div>
                <div class="col-6">
                    <input type="text" name="captcha" class="form-control req" placeholder="">
                    <input type="hidden" class="capCode" name="captcha_sid" value="<?=$arResult['CAPTCHA']?>" />
                </div>
                <div class="col-6 CAPTCHA">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" width="180" height="40" alt="CAPTCHA" />
                </div>
            </div>

            <div class="form-group"><label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" class="req" value="1"><span></span> <small>Согласен(на) на обработку персональных данных</small></label></div>

            <input name="go" type="hidden" value="fileValueHandout">
            <input name="goMetod" type="hidden" value="fileValueHandoutDownload">
            <input name="rel" type="hidden" value="<?=intval($get['rel'])?>">
            <input name="title" type="hidden" value="<?=trim($get['title'])?>">
            <input type="submit" value="Ok" style="display: none">
        </div>
    </div>
</form>
