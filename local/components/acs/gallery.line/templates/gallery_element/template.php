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
//p(count($arResult["ITEMS"]),'p');
//p($arResult["ITEMS"],'p');
?>
    <section class="photoLine">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="heading-wrapper">
                        <h5 class="heading"><?=$arParams['TITLE_PAGE']?></h5>
                        <a href="<?=$arParams['TITLE_PAGE_URL']?>" class="button button--common button--primary">Все фото</a>
                    </div>
                </div>
            </div>
            <div class="photoLine-items owl-carousel">
                <? foreach ($arResult["ITEMS"] as $k=>$arItem):
                $photoArr = [];
                foreach($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $p=>$val){
                    $photoArr[$p] = ['VALUE'=>$val,'DESCRIPTION'=>$arItem['PROPERTIES']['PHOTOS']['DESCRIPTION'][$p]];
                } ?>
                <div class="slide row">
                    <? for ($ps=0; $ps<=3; $ps++){ ?>
                    <div class="col-6 col-md-6 col-lg-3">
                        <div class="photo-block">
                            <? $PSS_ = PRM::PR($photoArr[$ps]['VALUE'], $arSize = ["width" => 800, "height" => 800], BX_RESIZE_IMAGE_PROPORTIONAL); ?>
                            <a href="<?=$PSS_['SRC']?>" class="album album--small fancybox" data-fancybox="group" rel="photo_arr">
                                <? $PSS = PRM::PR($photoArr[$ps]['VALUE'], $arSize = ["width" => 260, "height" => 180], BX_RESIZE_IMAGE_EXACT); ?>
                                <img src="<?=$PSS['SRC']?>" alt="<?=$photoArr[$ps]['DESCRIPTION']?>" class="album-pic">
                                <?if($photoArr[$ps]['DESCRIPTION']):?><p class="title"><?=$photoArr[$ps]['DESCRIPTION']?></p><? endif; ?>
                            </a>
                        </div>
                    </div>
                    <? } ?>
                </div><!--// end row -->
                <? endforeach; ?>
            </div><!--// end photoLine-items -->
        </div>
    </section><!--// end photoLine -->
<? endif; ?>