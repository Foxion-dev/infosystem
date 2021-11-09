<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? //p($arResult['ITEMS'],'p'); ?>
<section class="search-panel-2">
    <div class="container">
        <div class="col-12 col-sm-12">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
            "START_FROM" => "0", 
            "PATH" => "", 
            "SITE_ID" => "s1" 
            )
        );?>
        </div>
        <?/*<form action="" method="post" class="row coursers-line-form" name="coursers-line-form" id="coursers-line-form">*/?>
        <div class="col-12 col-sm-12">
            <div class="page-header">
                <h1 class="bx-title dbg_title courses-filter">Направления курсов</h1>
            </div>
                <?/*<select name="coursers-line" class="coursers-line" id="coursers-line" style="display: none;">*/?>
                <?/*<option value="all">Все курсы</option>*/?>
            <ul class="courses-sections">
            <?foreach($arResult['ITEMS'] as $ITEM):?>
            
            
            <li class="courses-sections__items">
                <a href="<?=$ITEM['SECTION_PAGE_URL']?>">
                    <span class="name"><?=$ITEM['NAME']?></span>
                    <sup class="quantity-courses"><?=$ITEM['ELEMENT_CNT']?></sup>
                </a>
                
            </li>
                
            <?endforeach;?>
            </ul>
                <?/*</select>*/?>
        </div>
            <?/*<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 coursers-line-name-body">
                <label>Подразделы направления</label>
                <select name="coursers-line-name" class="coursers-line-name" id="coursers-line-name" style="display: none;">
                    <option value="all">Все</option>
                    <? foreach ($arResult['ITEMS'] as $ITEM): ?>
                        <option value="<?=$ITEM['ID']?>"><?=$ITEM['NAME']?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <?/*<div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2"><button type="submit" name="search-button" class="button button--round button--secondary icon-search"></button></div>*/?>
        <?/*</form>*/?>
    </div>
</section>
<? $SECT = (!empty($arResult['CHILD'][0])?$arResult['CHILD'][0]:$arResult['ITEMS'][0]);
//var_dump($SECT);
$SECT=[];
?>
<section class="info-block">
    <div class="container">
        <div class="row">
            <div class="col-12 info-block-body">
                <? $SP = intval($SECT['PICTURE'])>0?CFile::GetPath($SECT['PICTURE']):'/images/nofoto/nofoto.png'; ?>
                <img src="<?=$SP?>" style="display: none;">
                <div class="info-block-body-right">
                    <h5><?=$SECT['NAME']?></h5>
                    <? if($SECT['DESCRIPTION']): ?>
                    <? $DESCRIPTION_ = strip_tags($SECT['DESCRIPTION']);
                        $out = mb_substr($DESCRIPTION_, 0, 250);
                        $pos = mb_strrpos($out, ' ');
                        if ($pos)
                            $out = mb_substr($out, 0, $pos);
                    ?>
                    <p id="infoBlockMyCrop"><?=$out?></p>
                    <p id="infoBlockHide"><?=substr($DESCRIPTION_,$pos)?></p>
                    <a class="hide-more" href="#"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Подробнее</span></a>
                    <? endif; ?>
                    <?if(!empty($SECT['UF_FULL_SCHEDULE'])){?>
                    <a href="<?=$SECT['UF_FULL_SCHEDULE']?>" target="_blank" class="button button--common button--primary" <?/*data-replace="<?=$SECT['SECTION_PAGE_URL']?>"*/?>>
                        Загрузить полное расписание данного направления
                    </a>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</section>