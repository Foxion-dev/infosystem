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
<div class="row"><div class="col-12">
        <? //p($arResult,'p');  ?>
        <? if($arResult['DETAIL_TEXT']): ?>
            <div class="about-vacancies-text"><? print $arResult['DETAIL_TEXT']; ?></div>
        <? elseif ($arResult['PREVIEW_TEXT']): ?>
            <div class="about-vacancies-text"><? print $arResult['PREVIEW_TEXT']; ?></div>
        <? endif; ?>
        <? //p($arResult['DISPLAY_PROPERTIES']['DEMAND'],'p'); ?>
        <? if(!empty($arResult['DISPLAY_PROPERTIES']['DEMAND'])): ?>
        <div class="row">
            <? foreach ($arResult['DISPLAY_PROPERTIES']['DEMAND']['~VALUE'] as $p=>$PROPERTY): ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="margin-bottom: 20px;">
                    <div class="about-vacancies-div">
                    <?=($arResult['DISPLAY_PROPERTIES']['DEMAND']['DESCRIPTION'][$p]?'<h2 class="about-vacancies-h2"><span>'.($p+1).'</span> '.$arResult['DISPLAY_PROPERTIES']['DEMAND']['DESCRIPTION'][$p].'</h2>':'')?>
                    <?=$PROPERTY['TEXT']?>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <? endif; ?>
</div></div>