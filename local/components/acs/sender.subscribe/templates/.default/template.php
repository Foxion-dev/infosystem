<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="subscribe">
    <p class="label">Будь в курсе новостей и забери свои 1000 ₽</p>
    <button type="button"class="button button--common button--primary" data-toggle="modal" data-target="#subscribe">Подписаться</button>
</div>

<div id="subscribe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="SmallModalSubscribe" aria-hidden="true"><div class="modal-dialog modal-md">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="SmallModalSubscribe">РАССЫЛКА</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div><!--//modal-header-->
    <div class="modal-body">
        <div class="alert alert-success" id="alert-subscribe-danger-success" style="display: none;"></div>
        <div class="alert alert-danger" id="alert-subscribe-danger-error" style="display: none;"></div>
        <form id="bx_subscribe_subform" class="bx_subscribe_subform SubmitFormAjax" role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="sender_subscription" value="add">
            <input type="hidden" name="go" value="subscribe">
            <div class="form-group">
                <label>Ваш e-mail *</label>
                <input name="SENDER_SUBSCRIBE_EMAIL" type="email" class="form-control input-lg req" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=htmlspecialcharsbx(GetMessage('subscr_form_email_title'))?>">
            </div>

            <div style="<?=($arParams['HIDE_MAILINGS'] <> 'Y' ? '' : 'display: none;')?>">
                <?if(count($arResult["RUBRICS"])>0):?>
                    <div class="bx-subscribe-desc"><?=GetMessage("subscr_form_title_desc")?></div>
                <?endif;?>
                <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                <div class="bx_subscribe_checkbox_container">
                    <input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" id="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?>>
                    <label for="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>"><?=htmlspecialcharsbx($itemValue["NAME"])?></label>
                </div>
                <?endforeach;?>
            </div>

            <?if ($arParams['USER_CONSENT'] == 'Y'):?>
                <div class="form-group"><label class="cbLabel"><input type="checkbox" name="sendCopy" value="1" class="req"><span></span> Согласен(на) на обработку персональных данных</label></div>
            <?endif;?>
            <input type="submit" value="Ok" style="display: none">
        </form>
    </div><!--/modal-body-->
    <div class="modal-footer">
        <!--<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Закрыть</button>-->
        <button type="button" class="button button--common button--primary submit_class">Подписаться</button>
    </div><!--/modal-footer-->
</div>
</div></div>
