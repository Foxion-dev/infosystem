<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bx_section">
    <h4><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></h4>
    <div class="bx_block w100"><textarea name="ORDER_DESCRIPTION" rows="1" id="ORDER_DESCRIPTION" class="form-control input-lg"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea></div>
    <div style="clear: both;"></div>
    <div class="row captcha-body">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group row">
          <div class="col-12"><label>Код на картинке: <span class="bx_req">*</span></label></div>
          <div class="col-12 col-sm-12 col-md-6">
            <input type="text" name="captcha" class="form-control capCode req" placeholder="">
            <input type="hidden" class="capCode" name="captcha_sid" value="<?=$arResult['CAPTCHA']?>" />
          </div>
          <div class="col-12 col-sm-12 col-md-6 CAPTCHA">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" width="180" height="40" alt="CAPTCHA" />
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
      <span class="textHelp">* Отмеченные поля являются обязательными для заполнения. После заполнения формы,
            данные отправляются на соответствующий контактный адрес администратора ввиде
            электронного письма. Заказ возможен как для Физических лиц, так и для Юридических лиц.
            Возможны разные способы оплаты: счет, онлайн оплата и другие *</span>
      </div>
    </div>
</div>
<div style="clear: both;"></div>
