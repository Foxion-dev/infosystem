<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<section class="reviews reviews-nofon">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="heading-wrapper">
                    <h5 id="REVIEWS">
                            <?=$arParams['PAGE_TITLE']?$arParams['PAGE_TITLE']:"Отзывы"?>
                    </h5>
                    <?/*if($USER->IsAuthorized()){*/?>
                        <a href="#" data-name="<?=$arParams['ELEMENT_ID']?>" data-group="<?=$arParams['GROUP_ID']?>" class="rew-custom-btn button button--common user-reviews-class-add">Оставить отзыв</a>
                    <?/*}*/?>
                </div>
                <? if(count($arResult['ITEMS'])>0):?>

                <div class="reviews-items<?=$arParams['IS_INCOURSES'] == 'Y' ? ' isincourses':''?>" id="review-content">
                    <? if(count($arResult['ITEMS'])>0):?>
                    <? foreach ($arResult['ITEMS'] as $reviews): ?>
                        <div class="slide">
                            <div class="reviews-items-body"><?=$reviews['UF_REVIEWS']?></div>
                            <?/*<div class="reviews-items-person">
                                <? if(!empty($reviews['UF_IMG'])): ?>
                                    <img src="<?=$reviews['UF_IMG']['SRC']?>">
                                <? endif; ?>
                            </div>*/?>
                        </div>
                    <? endforeach; ?>
                    <? endif; ?>
                </div>
				<?$count = 1?>
                <div data-countel="<?=count($arResult['ITEMS'])?>" class="reviews-items" id="review-name">
                    <? if(count($arResult['ITEMS'])>0):?>
                    <? foreach ($arResult['ITEMS'] as $reviews): ?>
                    <div class="slide inner" data-num="<?=$count?>">
                        <div class="reviews-items-person">
                            <div class="reviews-items-person-date"><?=FormatDate("d F Y",strtotime($reviews['UF_DATE']))?></div>
                            <div class="reviews-items-person-name"><?=$reviews['UF_NAME']?></div>
							<?if($reviews['UF_COMPANY_USER']):?>
								<div class="reviews-items-person-company"><?=$reviews['UF_COMPANY_USER']?></div>
							<?endif?>
                        </div>
                    </div>
					<?$count++?>
                    <? endforeach; ?>
                    <? endif; ?>
                </div>
                <?endif;?>
                <?/*if($arParams['facebook']){?>
                    <a href="#" class="reviews-facebook">Из facebook <i class="icon icon-facebook"></i></a>
                <?}*/?>
            </div>
        </div>
    </div>
</section>
<?//}?>
