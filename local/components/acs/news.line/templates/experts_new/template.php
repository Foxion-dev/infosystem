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
?>
<section class="experts <?=($arParams['DIV_CLASS']?$arParams['DIV_CLASS']:"")?>">
<div class="container">
    <div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="heading-wrapper">
			    <h5><?=$arParams['TITLE_PAGE']?></h5>
				<div class="button_holder">
					<a href="/academy/experts/" class="button button--common button--primary">Все преподаватели</a>
				</div>
			</div>
		    <div class="experts-multyslider owl-carousel">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<div class="slide">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="experts-items">
							<? if(!empty($arItem['PREVIEW_PICTURE'])){
								$PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 120, "height" => 120));  ?>
								<img src="<?=$PR['SRC']?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>">
							<? }else{ ?>
								<img src="<?=PRM::SRC(120)?>" title="<?=$arItem["NAME"]?>">
							<? } ?>
	                        <div class="experts-items-person"><?=$arItem["NAME"]?></div>
							<div class="experts-items-person-position"><?=$arItem['PROPERTY_POSITIONS_VALUE']?></div>
						</a>
					</div>
				<?endforeach;?>
			</div>
		</div>
    
    </div><!--//row-->
    <div class="row">
        <div class="col-12">
            <?/*<div class="button_holder">
                if($arParams['TITLE_PAGE_URL']):?>
            <a href="<?=$arParams['TITLE_PAGE_URL']?>" class="button button--common button--primary">Все преподаватели</a>
        <?endif;
            </div>*/?>
        </div>
    </div>
</div><!--//container-->
</section>
<? endif; ?>