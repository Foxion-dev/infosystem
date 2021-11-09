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
if(count($arResult["ITEMS"])): ?>
<section class="banner-slider-body">
    <div class="banner-slider owl-carousel">
    <? foreach ($arResult["ITEMS"] as $k=>$arItem){ ?>
        <div class="slide slide-<?=($k+1)?>" <?if(!empty($arItem['DISPLAY_PROPERTIES']['BANNER']['FILE_VALUE'])):?><?=$arItem['DISPLAY_PROPERTIES']['MOBILE_BANNER']['FILE_VALUE'] ? ' data-mobilebg = "url('.$arItem['DISPLAY_PROPERTIES']['MOBILE_BANNER']['FILE_VALUE']['SRC'].')" ':' '?>style="background-image: url('<?=$arItem['DISPLAY_PROPERTIES']['BANNER']['FILE_VALUE']['SRC']?>');background-position: center center; background-repeat: no-repeat; -webkit-background-size: cover; background-size: cover;" <?endif;?>>
            <div class="container">
                <div class="row">
                    <? //p($arItem['DISPLAY_PROPERTIES']['FORM_Y']['VALUE'],'p'); ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="banner-slider-text">
                            <? //177 X 300 ?>
                            <? if(!empty($arItem['PREVIEW_PICTURE'])){
                                $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 300, "height" => 177), BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                                <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="banner-slider-img-right">
                            <? } ?>
                            <div class="banner-slider-text-right"><?=$arItem['NAME']?></div>
                            <div class="banner-slider-text-body"><?=$arItem['PREVIEW_TEXT']?></div>
                            <? if(strlen($arItem['DISPLAY_PROPERTIES']['URL']['VALUE'])): ?>
                                <a href="<?=$arItem['DISPLAY_PROPERTIES']['URL']['VALUE']?>" class="button button--common button--primary">Подробнее</a>
                                <? endif; ?>
                        </div>
                    </div>
                    <? if($arItem['DISPLAY_PROPERTIES']['FORM_Y']['VALUE']=="Y"): ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<?if($arItem['DISPLAY_PROPERTIES']['FORM_CODE']['VALUE']):?>
							<div class="poup-btn-b24-form">
								<h5 class="heading">Заявка на участие</h5>
								<?=$arItem['DISPLAY_PROPERTIES']['FORM_CODE']['~VALUE']?>
							</div>
						<?else:?>
							<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="form form-request SubmitFormAjax">
								<h5 class="heading">Заявка на участие</h5>
								<div class="form_content">
									<input type="text" name="SEMINAR_NAME" placeholder="Имя" class="req" required>
									<input type="email" name="SEMINAR_EMAIL" placeholder="E-mail" class="req" required>
									<input type="email" name="ADD_EMAIL" placeholder="E-mail" class="asctestin">
									<input type="tel" name="SEMINAR_PHONES" placeholder="Телефон" class="phone req" required>
									<input type="hidden" name="SEMINAR_CODE" value="<?=$arItem['DISPLAY_PROPERTIES']['COURSE_ID']['VALUE']?>">
									<div class="button-wrapper">
										<a class="g-recaptcha" data-size="invisible" data-sitekey="6Lc4hKcUAAAAAEf2QkZHUIBplrAL-CL_M80zV0NA"></a>
										<button type="submit" name="submit" class="button button--common button--primary">Отправить</button>
									</div>
								</div>
								<div class="form-group"><label class="cbLabel"><input type="checkbox" name="sendCopy" required class="req" value="1"><span></span>
								<small>Нажимая на кнопку «Отправить» я соглашаюсь с <a target="_blank" href="/about/user_agreement/">Пользовательским соглашением</a> и <a target="_blank" href="/about/privacy/">Политикой конфиденциальности</a></small></label></div>
								<input type="hidden" name="go" value="SEMINAR_ADD">
								<input type="hidden" name="SEMINAR_ELEMENT" value="<?=$arItem['NAME']?>">
								<input type="hidden" name="SEMINAR_URL" value="<?=$arItem['DISPLAY_PROPERTIES']['URL']['VALUE']?>">
								
							</form>
						<?endif?>
                    </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    <? } ?>
    </div>
</section>
<!--//banner-slider-->
<? endif; ?>