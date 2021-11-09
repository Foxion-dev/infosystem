<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
//
$arParamsItem = $arResult['GALLERY'][$KEY_];
$ad['id'] = $arParamsItem['id']; ?>

<div class="galleryformatter galleryview galleryformatter-greenarrows gallery-processed">
<div class="gallery-slides">
    <div class="gallery-frame">
        <ul>
            <? foreach($arParamsItem['IMAGES'] as $kp=>$image){ ?>
                <li class="gallery-slide" id="slide-<?=$kp?>-field_photos-<?=$ad['id']?>">
                    <? if(!empty($image['full'])){ ?>
                        <a href="<?=$image['full']['src']?>" title="<?=$ad['title_array'][0]?>" class="fancybox" data-fancybox="group" rel="gallery-field_photos-<?=$ad['id']?>">
                            <span class="view-full btn btn-primary" title="Увеличить изображение"><span class="glyphicon glyphicon-search"></span></span>
                        </a>
                    <? } ?>
                    <img src="<?=$image['image']['src']?>" width="<?=$image['image']['width']?>" height="<?=$image['image']['height']?>" class="img-responsive" title="<?=$ad['title_array'][0]?>">
                </li>
            <? } ?>
        </ul>
    </div>
    <div class="gallery-navigations">
        <ul>
            <? foreach($arResult['GALLERY'] as $act_=>$imgAct){ ?>
                <li rel='<?=serialize(['ID'=>$imgAct['id'],"KEY"=>$act_,"go"=>"GN"])?>' id="slide-<?=$act_?>-navigations-<?=$imgAct['id']?>" <?=($act_==$KEY_?'class="active"':'')?>><span></span></li>
            <? } ?>
        </ul>
    </div>
</div><!--gallery-frame-->

<? // ?>
<? if(count($arParamsItem['IMAGES'])>1){ ?>
    <div class="gallery-thumbs">
        <? if(count($arParamsItem['IMAGES'])>1){ ?>
            <? if($arParamsItem['IMAGES_DEFAULT'] != "Y"){ ?>
                <a class="prev-slide slide-button" title="Предыдущее изображение">&lt;</a>
                <a class="next-slide slide-button" title="Следующее изображение">&gt;</a>
            <? } ?>
        <? } ?>
        <div class="wrapper" style="overflow: hidden;">
            <ul style="width: 99999px;">
                <? foreach($arParamsItem['IMAGES'] as $kpthu=>$thumbs){ ?>
                    <li class="slide-<?=$kpthu?>">
                        <a href="#slide-<?=$kpthu?>-field_photos-<?=$ad['id']?>" rel="#slide-<?=$kpthu?>-navigations-<?=$ad['id']?>">
                            <img src="<?=$thumbs['thumb']['src']?>" width="<?=$thumbs['thumb']['width']?>" height="<?=$thumbs['thumb']['height']?>" class="img-responsive" title="<?=$ad['title_array'][0]?>">
                            <span class="stroke"></span>
                        </a>
                    </li>
                <? } ?>
            </ul>
        </div>
    </div><!--.gallery-thumbs-->
<? } ?>
</div><!--.galleryformatter-->
