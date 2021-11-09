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
if(count($arResult["ITEMS_SECTION"])): foreach ($arResult["ITEMS_SECTION"] as $s=>$SECT): ?>
<? if($s==21): ?><div class="particles-bg-5" id="particles-bg-5"></div><? endif; ?>
<section class="academy-partners have-margin-top" <? if($s==21){ echo 'role="main"'; }  ?> id="academy-partners-<?=$SECT['IBLOCK_SECTION_ID']?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?=$SECT['IBLOCK_SECTION_NAME']?></h2>
            </div>
            <div class="col-12">
                <div class="row">
                    <? foreach ($SECT["ITEMS"] as $k=>$arItem): ?>
                        <? if(!empty($arItem['PREVIEW_PICTURE'])){
                            $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 135, "height" => 85], BX_RESIZE_IMAGE_PROPORTIONAL);  ?>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 <?=(($k+1)>6?'academy-partners-body':'')?>">
                                <div class="academy-partners-items">
                                    <img src="<?=$PR['SRC']?>" title="<?=$arItem['PREVIEW_PICTURE']["TITLE"]?>" alt="<?=$arItem['PREVIEW_PICTURE']["ALT"]?>" class="img-responsive">
                                    <p><?=$arItem['NAME']?></p>
                                </div>
                            </div>
                        <? } ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="academy-partners-line-body">
<div class="academy-partners-line">
    <button class="button button--common button--primary" onclick="$(this).hide(300); $('section#academy-partners-<?=$SECT["IBLOCK_SECTION_ID"]?> .academy-partners-body').show(300);">
        Посмотреть все <i class="fa fa-arrow-down" aria-hidden="true"></i>
    </button>
</div>
</div>
<? endforeach; endif; ?>
