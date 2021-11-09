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
// p($arResult["ITEMS_SECTION"],'p');
//
if(count($arResult["ITEMS_SECTION"])): ?>
<? foreach ($arResult["ITEMS_SECTION"] as $s=>$SECT):
    if($s!=25) continue; ?>
<div class="particles-bg-5" id="particles-bg-5"></div>
<section role="main" class="have-margin-top academy-team <?=(!in_array($s,[25,27])?"academy-team-line":"")?>">
    <div class="container">
        <div class="row">
            <? if($s!=27): ?>
                <div class="col-12">
                    <h2><?=$SECT['IBLOCK_SECTION_NAME']?></h2>
                </div>
            <? endif; ?>
            <div class="col-12">
                <div class="row">
                    <? foreach ($SECT["ITEMS"] as $k=>$arItem): ?>
                        <? if(!empty($arItem['PREVIEW_PICTURE'])){
                            //
                            $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], ["width" => 160, "height" => 160], BX_RESIZE_IMAGE_PROPORTIONAL);
                            $class = "col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4";
                            ?>
                            <div class="<?=$class?>" style="margin: 0px auto;">
                                <div class="academy-team-items <?//=($s==27?"academy-team-items-manager":"")?>">
                                    <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="img-responsive">
                                    <div class="academy-team-name"><?=$arItem['NAME']?></div>
                                    <div class="academy-team-position"><?=$arItem['PROPERTY_POSITION_VALUE']?></div>
                                    <?if(!empty($arItem['PROPERTY_PHONES_VALUE'])){?>
                                        <div class="academy-team-phones">Телефон: <a href="tel:<?=$arItem['PROPERTY_PHONES_VALUE']?>"><?=$arItem['PROPERTY_PHONES_VALUE']?></a></div>
                                    <?}?>
                                    <?if(!empty($arItem['PROPERTY_POST_MAIL_VALUE'])){?>
                                    <div class="academy-team-phones">Эл. почта: <a href="mailto:<?=$arItem['PROPERTY_POST_MAIL_VALUE']?>"><?=$arItem['PROPERTY_POST_MAIL_VALUE']?></a></div>
                                    <?}?>
                                </div>
                            </div>
                        <? } ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<? endforeach; ?>
<section class="academy-team academy-team-line">
    <div class="container">
    <div class="row">
    <div class="col-12">
        <h2>НАША КОМАНДА</h2>
    </div>
    <div class="col-12">
    <div class="row">
<? foreach ($arResult["ITEMS_SECTION"] as $s=>$SECT): if($s==25) continue; ?>

        <? foreach ($SECT["ITEMS"] as $k=>$arItem): ?>
            <? if(!empty($arItem['PREVIEW_PICTURE'])){
                /*$arSize = ($s==25?["width" => 200, "height" => 200]:["width" => 120, "height" => 120]);
                $arSize = ($s==26?["width" => 160, "height" => 160]:$arSize);
                $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize, BX_RESIZE_IMAGE_PROPORTIONAL);
                $class = ($s==25?"col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4":"col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6");
                $class = ($s==26?"col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3":$class);*/
                //
                $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], ["width" => 160, "height" => 160], BX_RESIZE_IMAGE_PROPORTIONAL);
                $class = "col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3";
                ?>
                <div class="<?=$class?>">
                    <div class="academy-team-items <?//=($s==27?"academy-team-items-manager":"")?>">
                        <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="img-responsive">
                        <div class="academy-team-name"><?=$arItem['NAME']?></div>
                        <div class="academy-team-position"><?=$arItem['PROPERTY_POSITION_VALUE']?></div>
                        <?if(!empty($arItem['PROPERTY_PHONES_VALUE'])){?>
                        <div class="academy-team-phones">Телефон: <a href="tel:<?=str_replace([' ','(',')','-'],'',$arItem['PROPERTY_PHONES_VALUE'])?>"><?=$arItem['PROPERTY_PHONES_VALUE']?></a></div><?}?>
                        <?if(!empty($arItem['PROPERTY_POST_MAIL_VALUE'])){?>
                        <div class="academy-team-phones">Эл. почта: <a href="mailto:<?=$arItem['PROPERTY_POST_MAIL_VALUE']?>"><?=$arItem['PROPERTY_POST_MAIL_VALUE']?></a></div>
                        <?}?>
                    </div>
                </div>
            <? } ?>
        <? endforeach; ?>

<? endforeach; ?>
    </div>
    </div>
    </div>
    </div>
</section>
<? endif; ?>
