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
if(count($arResult["ITEMS"])):
//p($arResult["ITEMS"],'p'); ?>
<section class="photogallery"><div class="container">
        <div class="row">
            <div class="col">
                <div class="heading-wrapper">
                    <h5 class="heading"><?=$arParams['TITLE_PAGE']?></h5>
                    <a href="<?=$arParams['TITLE_PAGE_URL']?>" class="button button--common button--primary">Все фото</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="photogallery-slider owl-carousel">
                    <? foreach ($arResult["ITEMS"] as $k=>$arItem){ ?>
                        <div class="slide slide-<?=$k+1?>">
                            <div class="row">
                                <? // CBitrixComponent::includeComponentClass("acs:gallery.line");
                                $photoArr = [];
                                foreach($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $p=>$val){
                                    $photoArr[$p] = ['VALUE'=>$val,'DESCRIPTION'=>$arItem['PROPERTIES']['PHOTOS']['DESCRIPTION'][$p]];
                                }
                                $photoArr = array_chunk($photoArr, 3, false);
                                for ($ps=0; $ps<2; $ps++){
                                    if(!empty($photoArr[$ps])){ ?>
                                        <div class="col-12 col-md-6"><div class="photo-block">
                                            <? if($ps==0){ ?>
                                                <div class="row">
                                                    <? for ($p=0; $p<2; $p++){ if(!empty($photoArr[$ps][$p])){ ?>
                                                        <div class="col-6">
                                                            <? $PSS_ = PRM::PR($photoArr[$ps][$p]['VALUE'], $arSize = ["width" => 800, "height" => 800], BX_RESIZE_IMAGE_PROPORTIONAL); ?>
                                                            <? $PSS = PRM::PR($photoArr[$ps][$p]['VALUE'], $arSize = ["width" => 260, "height" => 180], BX_RESIZE_IMAGE_EXACT); ?>
                                                            <a href="<?=$PSS_['SRC']?>" class="album album--small fancybox" data-fancybox="group" rel="photo_arr">
                                                                <img src="<?=$PSS['SRC']?>" title="<?=$photoArr[$ps][$p]['DESCRIPTION']?>" alt="<?=$photoArr[$ps][$p]['DESCRIPTION']?>" class="album-pic">
                                                                <p class="title"><?=$photoArr[$ps][$p]['DESCRIPTION']?></p>
                                                            </a>
                                                        </div>
                                                    <? }} ?>
                                                </div>
                                                <? if(!empty($photoArr[$ps][2])){
                                                    $PR_ = PRM::PR($photoArr[$ps][2]['VALUE'], $arSize = ["width" => 800, "height" => 800], BX_RESIZE_IMAGE_PROPORTIONAL);
                                                    $PR = PRM::PR($photoArr[$ps][2]['VALUE'], $arSize = ["width" => 555, "height" => 380], BX_RESIZE_IMAGE_EXACT);  ?>
                                                    <a href="<?=$PR_['SRC']?>" class="album album--large fancybox" data-fancybox="group" rel="photo_arr">
                                                        <img src="<?=$PR['SRC']?>" title="<?=$photoArr[$ps][2]['DESCRIPTION']?>" alt="<?=$photoArr[$ps][2]['DESCRIPTION']?>" class="album-pic">
                                                        <p class="title"><?=$photoArr[$ps][2]['DESCRIPTION']?></p>
                                                    </a>
                                                <? } ?>
                                            <? }else{ ?>
                                                <? if(!empty($photoArr[$ps][2])){
                                                    $PR_ = PRM::PR($photoArr[$ps][2]['VALUE'], $arSize = ["width" => 800, "height" => 800], BX_RESIZE_IMAGE_PROPORTIONAL);
                                                    $PR = PRM::PR($photoArr[$ps][2]['VALUE'], $arSize = ["width" => 555, "height" => 380], BX_RESIZE_IMAGE_EXACT);  ?>
                                                    <a href="<?=$PR_['SRC']?>" class="album album--large fancybox" data-fancybox="group" rel="photo_arr">
                                                        <img src="<?=$PR['SRC']?>" title="<?=$photoArr[$ps][2]['DESCRIPTION']?>" alt="<?=$photoArr[$ps][2]['DESCRIPTION']?>" class="album-pic">
                                                        <p class="title"><?=$photoArr[$ps][2]['DESCRIPTION']?></p>
                                                    </a>
                                                <? } ?>
                                                <div class="row">
                                                    <? for ($p=0; $p<2; $p++){ if(!empty($photoArr[$ps][$p])){ ?>
                                                        <div class="col-6">
                                                            <? $PSS_ = PRM::PR($photoArr[$ps][$p]['VALUE'], $arSize = ["width" => 800, "height" => 800], BX_RESIZE_IMAGE_PROPORTIONAL);
                                                            $PSS = PRM::PR($photoArr[$ps][$p]['VALUE'], $arSize = ["width" => 260, "height" => 180], BX_RESIZE_IMAGE_EXACT); ?>
                                                            <a href="<?=$PSS_['SRC']?>" class="album album--small fancybox" data-fancybox="group" rel="photo_arr">
                                                                <img src="<?=$PSS['SRC']?>" title="<?=$photoArr[$ps][$p]['DESCRIPTION']?>" alt="<?=$photoArr[$ps][$p]['DESCRIPTION']?>" class="album-pic">
                                                                <p class="title"><?=$photoArr[$ps][$p]['DESCRIPTION']?></p>
                                                            </a>
                                                        </div>
                                                    <? }} ?>
                                                </div>
                                            <? } ?>
                                        </div></div>
                                    <? }
                                } ?>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
</div></section>
<? endif; ?>