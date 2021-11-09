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
//
if(count($arResult["ITEMS_SECTION"])): foreach ($arResult["ITEMS_SECTION"] as $s=>$SECT): ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?=$SECT['IBLOCK_SECTION_NAME']?></h2>
            </div>
            <div class="col-12">
                <div class="row">
                    <? foreach ($SECT["ITEMS"] as $k=>$arItem): ?>
                        <? //if(!empty($arItem['PREVIEW_PICTURE'])){
                            //$PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 120, "height" => 120], BX_RESIZE_IMAGE_PROPORTIONAL); ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="academy-information-items">
                                    <?=($arItem['PROPERTY_TEACHER_CODE']?'<a href="/academy/experts/'.$arItem['PROPERTY_TEACHER_CODE'].'/">':'')?>
                                    <? if(!empty($arItem['PREVIEW_PICTURE'])){ ?>
                                        <? $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 120, "height" => 120], BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                                        <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="img-responsive">
                                    <? }else{ ?>
                                        <img src="<?=PRM::SRC(120)?>" title="<?=$arItem["NAME"]?>" class="img-responsive">
                                    <? } ?>
                                    <?=($arItem['PROPERTY_TEACHER_CODE']?'</a>':'')?>
                                    <? if($arItem['PROPERTY_TEACHER_CODE']){ ?>
                                        <div class="academy-team-name"><a href="/academy/experts/<?=$arItem['PROPERTY_TEACHER_CODE']?>/"><?=$arItem['NAME']?></a></div>
                                    <? }else{ ?>
                                        <div class="academy-team-name"><?=$arItem['NAME']?></div>
                                    <? } ?>
                                    <div class="academy-team-position"><?=$arItem['PROPERTY_POSITION_VALUE']?></div>
                                    <? if($s==28): ?>
                                        <div class="academy-team-phones">
                                            Контакты: <br><?=$arItem['PROPERTY_PHONES_VALUE']?>
                                            <? if($arItem['PROPERTY_POST_MAIL_VALUE']){ ?><br><a href="mailto:info@infosystem.ru"><?=$arItem['PROPERTY_POST_MAIL_VALUE']?></a><? } ?>
                                        </div>
                                    <? endif; ?>
                                    <? //p($s,'p'); ?>
                                    <?/*<div class="academy-team-phones">Телефон: <?=$arItem['PROPERTY_PHONES_VALUE']?></div>
                                    <div class="academy-team-phones">Эл. почта: <?=$arItem['PROPERTY_POST_MAIL_VALUE']?></div>*/?>
                                </div>
                            </div>
                        <? //} ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<? endforeach; endif; ?>
