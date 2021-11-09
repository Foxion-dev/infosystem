<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
// ?>

<form action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax">
    <div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div>
    <div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>
    <div class="row input-form">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label>Имя</label>
                <input name="NAME" type="text" class="form-control input-lg req" placeholder="Ваше имя">
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input name="TELEFON" type="text" class="form-control input-lg phone req" placeholder="">
            </div>
            <div class="form-group">
                <label>Ваш e-mail</label>
                <input name="EMAIL_USER" type="text" class="form-control input-lg req" placeholder="">
            </div>
            <div class="form-group"><label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" class="req" value="1"><span></span> Согласен(на) на обработку персональных данных</label></div>
            <?/*<input name="EMAIL" type="hidden" value="' + val['EMAIL'] + '">
            <input name="ID" type="hidden" value="' + val['ID'] + '">*/?>
            <input name="go" type="hidden" value="fileValueHandout">
            <input name="goMetod" type="hidden" value="fileValueHandoutDownload">
            <input name="rel" type="hidden" value="<?=intval($get['rel'])?>">
            <input type="submit" value="Ok" style="display: none">
        </div>
    </div>
</form>
