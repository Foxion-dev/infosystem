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
                <form action="<?=POST_FORM_ACTION_URI?>" role="form" method="post" class="SubmitFormAjax">
                    <?=bitrix_sessid_post()?>
                    <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                    <div class="form-group">
                        <label class="cbLabel" for="sf_RUB_ID_<?=$itemValue["ID"]?>">
                            <input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /><span></span> <?=$itemValue["NAME"]?>
                        </label>
                    </div>
                    <?endforeach;?>
                    <div class="form-group">
                        <input type="text" placeholder="Ваш e-mail" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" class="form-control input-lg req" title="<?=GetMessage("subscr_form_email_title")?>" />
                    </div>
                    <?//if ($arParams['USER_CONSENT'] == 'Y'):?>
                        <div class="form-group"><label class="cbLabel"><input id="sendCopy" type="checkbox" name="sendCopy" value="1" class="req"><span></span> Согласен(на) на обработку персональных данных</label></div>
                    <?//endif;?>
                    <input type="hidden" name="PostAction" value="Add">
                    <input type="hidden" name="go" value="subscribe">
                    <input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" style="display: none">
                </form>
            </div><!--/modal-body-->
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Закрыть</button>-->
                <button type="button" class="button button--common button--primary submit_class">Подписаться</button>
            </div><!--/modal-footer-->
        </div>
</div></div>