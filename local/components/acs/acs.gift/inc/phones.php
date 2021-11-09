<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
// ?>

<form action="<?=POST_FORM_ACTION_URI?>" method="post" role="form" class="SubmitFormAjax">
    <div class="alert alert-success" id="alert-send-danger-success" style="display: none;"></div>
    <div class="alert alert-danger" id="alert-send-danger-error" style="display: none;"></div>
    <div class="row input-form">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="gift-item-modal"><span><?=$get['TITLE']?></span> <span>Цена: <?=$get['PRICE']?> баллов</span></div>
            <div class="alert alert-success">После заказа с вашего счета будит снято <?=$get['PRICE']?> баллов</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label>Имя *</label>
                <input name="NAME" type="text" class="form-control input-lg req" placeholder="Ваше имя" value="<?=$get['NAME_USER']?>">
            </div>
            <div class="form-group">
                <label>Телефон *</label>
                <input name="TELEFON" type="text" class="form-control input-lg phone req" placeholder="">
            </div>
            <div class="form-group">
                <label>Ваш e-mail *</label>
                <input name="EMAIL_USER" type="text" class="form-control input-lg req" placeholder="" value="<?=$get['EMAIL_USER']?>">
            </div>
            <div class="form-group"><label>Ваш комментарий к заказу</label><textarea name="COMMENT" cols="2" type="text" class="form-control input-lg" placeholder=""></textarea></div>
            <div class="form-group"><label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" class="req" value="1"><span></span> Согласен(на) на обработку персональных данных</label></div>
            <input name="go" type="hidden" value="getGiftBasketAdd">
            <input name="ID" type="hidden" value="<?=intval($get['ID'])?>">
            <input name="TITLE" type="hidden" value="<?=htmlspecialchars(trim($get['TITLE']))?>">
            <input name="PRICE" type="hidden" value="<?=intval($get['PRICE'])?>">
            <input name="BUDGET" type="hidden" value="<?=intval($get['CURRENT_BUDGET'])?>">
            <input name="USER_ID" type="hidden" value="<?=intval($get['USER_ID'])?>">
            <input type="submit" value="Ok" style="display: none">
        </div>
    </div>
</form>
