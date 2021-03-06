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
global $USER, $APPLICATION; ?>
<header class="header <?/*header-background-img header-background-img-card*/?>">
<? include($_SERVER["DOCUMENT_ROOT"]."/include/header-top.php"); ?>
<section class="screen-menu screen-menu-card-element custom-course-head">
    <div class="menu-top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?$APPLICATION->IncludeComponent("bitrix:menu","bootstrap_horizontal_multilevel",
                        Array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL"	=>	"2",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT"	=>	"Y",
                            "MENU_CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "MENU_CACHE_TIME" => $arParams["CACHE_TIME"], // 1 hour - Cache time in seconds.
                            "MENU_CACHE_USE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "MENU_CACHE_GET_VARS" => Array(),
                        ),$component, ['HIDE_ICONS' => 'Y']);?>
                </div>
            </div>
        </div>
    </div><!--//end menu-top-->
    <? $APPLICATION->IncludeComponent("bitrix:search.form","hidden",["PAGE" => "/search/"],$component,['HIDE_ICONS' => 'Y']);?>
    
    <div class="container the-cards<?=$arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] == "Y" ? ' ispromo':''?>">
        <div class="row">
            <div class="col-12 col-md-10">
                <? if(count($arResult['SECTION']['PATH'])){
                    $TAGS = ['??????????'=>'/courses/'];
                    foreach ($arResult['SECTION']['PATH'] as $path){
                        $TAGS[$path['NAME']] = $path['SECTION_PAGE_URL'];
                    } ?>
                    <div class="the-cards-url">
                        <? foreach ($TAGS as $N=>$TG){ ?><a href="<?=$TG?>"><?=$N?></a><? } ?>
                    </div>
                <? } ?>
                <h1>
                <?=$arResult["NAME"]?>
                </h1>
            </div>
            <div class="col-12 col-md-2">
                <div class="the-cards-date" style="margin-bottom:20px;">
                    <?/*<nobr><a href="#" data-item="<?=$arResult["ID"]?>" class="myCalendar" title=""><i class="fa fa-calendar" aria-hidden="true"></i></a></nobr>
                    <nobr><a href="#" data-item="<?=$arResult["ID"]?>" class="favor" title=""><i class="fa fa-star-half-o" aria-hidden="true"></i></a></nobr>*/?>
                    <?$APPLICATION->IncludeComponent("acs:acs.share","",[],$component, array('HIDE_ICONS' => 'Y'));  ?>
                    <div class="the-cards-date__title">????????????????????</div>
                    <? /* ---------------------- */ ?>
                   
                    <!--<button type="submit" name="search-button" class="button button--round button--secondary icon-search"></button>-->
                </div>
            </div>
            <div class="col-12 col-md-12 <?=$arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] == "Y" ? 'col-lg-12':'col-lg-6'?>" style="margin-bottom:10px;">
                <div class="the-cards-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 preview-holder">
                            <div class="the-cards-body-items"><?=$arResult['PREVIEW_TEXT']?></div>
                        </div>
                         <div class="col-12">
                            <div class="row">
                                <div class="col-md-8">
                         <?if(!empty($arResult['DISPLAY_PROPERTIES']['YOUTUBE'])):?>
                            <div class="the-cards-video">
                                <div class="the-cards-body-items">
                                    <a href="<?=$arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE']?>" class="button button--common button--primary fancybox-media" title="?????????? ???????????????? ??????????"><i class="fa fa-youtube-play" aria-hidden="true"></i> <span>?????????? ???????????????? ??????????</span></a>
                                </div>
                            </div>
                        <?endif;?>
                        </div>
						<?if($arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] != "Y"):?>
							<?if(!empty($arResult['DISPLAY_PROPERTIES']['ARTNUMBER'])){?>
								<div class="col-md-4 the-cards-video the-cards-date-number"><small class="the-cards-date-number">??????: <?=$arResult['DISPLAY_PROPERTIES']['ARTNUMBER']['DISPLAY_VALUE']?></small></div>
							<?}else{?>
								<div class="col-md-4 the-cards-video the-cards-date-number"><small class="the-cards-date-number">??????: ID-<?=$arResult["ID"]?></small></div>
							<?}?>
						<?endif?>
                        </div>
                        </div>
                        <?/*<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 the-cards-line-top">
                            <div class="the-cards-body-items">
                                <? //p($arResult['DISPLAY_PROPERTIES']['DURATION'],'p'); ?>
                                
                                
                            </div>
                        </div>*/?>
                    </div>
					<?if($arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] == "Y"):?>
						<div class="form_container free-block">
							<div class="row">
								<? if(!empty($arResult['DISPLAY_PROPERTIES']['FORM_TRAINING_NEW']['VALUE'])): ?>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 the-cards-benefits forms_and_time">
										<div>
											<strong class="<?/*the-cards-line*/?>">?????????? ????????????????:</strong>
											<?=$arResult['DISPLAY_PROPERTIES']['FORM_TRAINING_NEW']['VALUE']?>
										</div>
									</div>
								<? endif; ?>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 the-cards-body-items dates">
									<strong>?????????????????? ????????</strong>
									<? if(!empty($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'])){ ?>
										<? foreach ($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'] as $DA): ?>
											<div><?=$DA?></div>
										<? endforeach; ?>
									<?} elseif ($arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']){ ?>
										<div><?=date("d F Y H:i",strtotime($arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']))?> <?//="(".$arResult['DISPLAY_PROPERTIES']['CITY']['VALUE'].")"?></div>
									<? }else{?>
										<div>?????????????????? ?? ??????????????????</div>
									<?} ?>
								</div>
								<? if(!empty($arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE'])): ?>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 the-cards-benefits forms_and_time">
										<strong>??????????????????????????????????:</strong>
										<?if(is_array($arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE'])){?>
											<?=implode("<br>",$arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE'])?>
										<?}else{?><?=$arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE']?><?}?>
									</div>
								<? endif; ?>
								<? if(!empty($arResult['ITEM_PRICES'])): ?>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 promo-price">
										<?foreach($arResult["ITEM_PRICES"] as $code=>$arPrice):?>
											<div class="the-cards-body-prise">
												<small>??????????????????</small>
												<?if($arPrice['PRICE'] == '0'):?>
													<span class="free-price"><span>??????????????????</span></span>
													<?if(!empty($arResult['PROPERTIES']['WEBINAR_RECORDING']['VALUE'])):?>
					                                <a style="text-align: left;margin: 10px 0px 0px 0px;" href="<?=$arResult['PROPERTIES']['WEBINAR_RECORDING']['VALUE']?>" target="_blank">
					                                	<span class="free-price"><span style="white-space: nowrap;display: block;width: 100%;font-size: 14px;">???????????? ???????????????? ????????????????</span></span>
					                                </a>
					                                <?endif;?>
												<?else:?>
													<span ><?=$arPrice['PRINT_RATIO_BASE_PRICE']?> <?/*<b>???</b>*/?> </span>
												<?endif?>
											</div> 
										<?endforeach;?>
									</div>
								<? endif; ?>
							</div>
						</div>
						<?if(!empty($arResult['DISPLAY_PROPERTIES']['ARTNUMBER'])){?>
							<div class="row bottom-code"><span class="the-cards-date-number">??????: <?=$arResult['DISPLAY_PROPERTIES']['ARTNUMBER']['DISPLAY_VALUE']?></span></div>
						<?}else{?>
							<div class="row bottom-code"><span class="the-cards-date-number">??????: ID-<?=$arResult["ID"]?></span></div>
						<?}?>
					<?endif?>
                       <?/* <div class="the-cards-body-prise form_container">
                            
                        </div>*/?>

                </div>
            </div>
			<?if($arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] != "Y"):?>
            <div class="col-12 col-md-12 col-lg-6" style="margin-bottom: 10px;">
                <div class="the-cards-body">
                    <div class="top_benefits" style="height: auto;">
                        <div class="the-cards-benefits-bt">
                            <? if(!empty($arResult['DISPLAY_PROPERTIES']['BENEFITS'])){ ?>
                            <div class="the-cards-benefits">
                                <h5>???????????????? ?? ????????</h5>
                                <div class="the-cards-benefits-block">
                                <? foreach ($arResult['DISPLAY_PROPERTIES']['BENEFITS']['VALUE_XML_ID'] as $v=>$VALUE_XML_ID){ ?>
                                <div class="benefits-item">
                                    <span class="<?=$VALUE_XML_ID?> benefits-icon" data-toggle="tooltip" data-placement="bottom"></span>
                                    <p class="benefits-title"><?=$arResult['DISPLAY_PROPERTIES']['BENEFITS']['VALUE'][$v]?></p>
                                </div>
                                <? } ?>
                                </div>
                                <?//=implode(" ",$arResult['DISPLAY_PROPERTIES']['BENEFITS']['VALUE_XML_ID'])?>
                                <? //p($arResult['DISPLAY_PROPERTIES']['BENEFITS'],'p'); ?>
                            </div>
                            <? } ?>
                        </div>
                        <div class="the-cards-benefits-bt-rt">
                            <div class="received-document-item the-cards-benefits">
                            <h5>?????????????????? ???? ????????????????</h5>
                            <div class="the-cards-benefits-block">
                            <?foreach($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'] as $RECEIVED):?>
                                <? if($RECEIVED['PREVIEW_PICTURE'])://var_dump($RECEIVED['PREVIEW_PICTURE']); ?>
                                    <?// $RECEIVED['PREVIEW_PICTURE'] = PRM::PR($RECEIVED['PREVIEW_PICTURE'], $arSize = array("width" => 120, "height" => 170));   ?>
                                    <div class="benefits-item">
                                    <div class="document_container benefits-icon"  data-toggle="tooltip" data-placement="bottom">
                                        <img src="<?=CFile::GetPath($RECEIVED['PREVIEW_PICTURE'])?>">
                                    </div>
                                    <p class="benefits-title"><?=$RECEIVED['NAME']?></p>
                                    </div>
                                <? endif; ?>
                                <?/*<div class="received-document-item-text">
                                    <?=$RECEIVED['NAME']?>
                                </div>*/?>
                            <? endforeach; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 form_container ">
                            <? if(!empty($arResult['DISPLAY_PROPERTIES']['FORM_TRAINING_NEW']['VALUE'])): ?>
                            <div class="the-cards-benefits forms_and_time">
                                <div>
                                <strong class="<?/*the-cards-line*/?>">?????????? ????????????????:</strong>
                                <?=$arResult['DISPLAY_PROPERTIES']['FORM_TRAINING_NEW']['VALUE']?></div>
                            </div>
                            <? endif; ?>
                            <div class="the-cards-body-items dates">
                                <strong>?????????????????? ????????</strong>
                                <? if(!empty($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'])){ ?>
                                    <? foreach ($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'] as $DA): ?>
                                        <div><?=$DA?></div>
                                    <? endforeach; ?>
                                <?} elseif ($arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']){ ?>
                                    <div><?=date("d F Y H:i",strtotime($arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']))?> <?//="(".$arResult['DISPLAY_PROPERTIES']['CITY']['VALUE'].")"?></div>
                                <? }else{?>
                                <div>?????????????????? ?? ??????????????????</div>
                                <?} ?>
                            </div>
                            <? if(!empty($arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE'])): ?>
                                <div class="the-cards-benefits forms_and_time">
                                    <strong>??????????????????????????????????:</strong>
                                    <?if(is_array($arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE'])){?>
                                    <?=implode("<br>",$arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE'])?>
                                    <?}else{?><?=$arResult['DISPLAY_PROPERTIES']['DURATION_SPISOK']['VALUE']?><?}?>
                                </div>
                            <? endif; ?>
                                    <?/*<i class="fa fa-tag" aria-hidden="true"></i> */?>
                            <?foreach($arResult["ITEM_PRICES"] as $code=>$arPrice):?>
                               <div class="the-cards-body-prise">
                                <small>??????????????????</small> <span ><?=$arPrice['PRINT_RATIO_BASE_PRICE']?> <?/*<b>???</b>*/?></span>
                               </div> 
                            <?endforeach;?>
                        </div>
                       <?/* <div class="the-cards-body-prise form_container">
                            
                        </div>*/?>
                    </div>
                </div>
            </div>
			<?endif?>
            <div class="col-12">
                <div class="the-cards-manager-wrapper">
                <? if(!empty($arResult['DISPLAY_PROPERTIES']['MANAGER'])): ?>
                <div class="the-cards-manager">
                    <?$MANAGER = $arResult['DISPLAY_PROPERTIES']['MANAGER']['LINK_ELEMENT_VALUE'][$arResult['DISPLAY_PROPERTIES']['MANAGER']['VALUE']];?>
                    <?if($MANAGER['PREVIEW_PICTURE']){
                        $PR=PRM::PR($MANAGER['PREVIEW_PICTURE'],$arSize=array("width"=>120,"height"=>120));?>
                        <img src="<?=$PR['SRC']?>" title="<?=$MANAGER["NAME"]?>">
                    <?}else{?>
                        <img src="<?=PRM::SRC(120)?>" title="<?=$MANAGER["NAME"]?>">
                    <?}?>
                    <span><?=$MANAGER['NAME']?></span>
                    <small class="pos"><?=$MANAGER['PROPERTY_POSITION_VALUE']?></small>
                </div>
                <? endif; ?>
                <div class="the-cards-manager b24form">
                    <small class="contacts"><?=$MANAGER['PROPERTY_PHONES_VALUE']?> <a href="mailto:<?=$MANAGER['PROPERTY_POST_MAIL_VALUE']?>"><?=$MANAGER['PROPERTY_POST_MAIL_VALUE']?></a></small>
<?if($arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] != "Y"):?>
                    <?=$arResult['PROPERTIES']['KP_BUTTON_CODE']['~VALUE']['TEXT']?>
<?endif?>
                </div>
                <div class="<?=$arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] != "Y" ? 'the-cards-manager ':''?>the-cards-body-click-body button-block">
                    
                        <div class="button_form short-button">
							<div class="row">
								<?//($USER->IsAdmin() || isset($_GET["order"])) &&?>
								<?if( $arResult["CAN_BUY"] && $arPrice['PRICE'] > 0 && $arResult["PROPERTIES"]["PROHIBIT_ONLINE_PURCHASE"]["VALUE"] != "Y"):?>  
								<div class="col-lg-6 col-xs-12" style="padding: 0px;">              
									<form class="add-basket-form button-style" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" />
										<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
										<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?=$arResult["ID"]?>">
										<button class="button button--common button--primary" type="submit" name="<?=$arParams["ACTION_VARIABLE"]."BUY"?>">???????????? ????????????</button>
										<?/*<input class="button free" type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?=GetMessage("CATALOG_ADD")?>">*/?>
									</form>
								 </div>
								  <?endif;?>
								<div class="col-lg-6 col-xs-12" style="padding: 0px;">
									<?/*<form action="<?=POST_FORM_ACTION_URI?>" method="post" class="SubmitFormAjax">
			                            <? if(!empty($arResult['PREVIEW_PICTURE'])): ?>
			                                <input type="hidden" name="PREVIEW_PICTURE" value="<?=$arResult['PREVIEW_PICTURE']['SRC']?>">
			                            <? endif; ?>
			                            <input type="hidden" name="NAME" value="<?=$arResult['NAME']?>">
			                            <input type="hidden" name="<?=$arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1">
			                            <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]?>" value="BUY">
			                            <input type="hidden" name="<?=$arParams["PRODUCT_ID_VARIABLE"]?>" value="<?=$arResult["ID"]?>">
			                            <input type="hidden" name="go" value="ADD2BASKETBYPRODUCTID">
			                            <button type="submit" name="<?=$arParams["ACTION_VARIABLE"]."ADD2BASKETBYPRODUCTID"?>" class="button button--common button--primary">???????????????? ????????</button>    
			                        </form>*/?>
			                        <?//var_dump($arResult['DISPLAY_PROPERTIES']['BUTTON_CODE']['~VALUE']);?>
									<?if($arResult['DISPLAY_PROPERTIES']['DISTANCE_LINK']['VALUE'] && $arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] == "Y"):?>
										<div class="table-cell">
											<a style="white-space: nowrap;padding-left: 0px;padding-right: 0px;text-align: center;" target="_blank" href="<?=$arResult['DISPLAY_PROPERTIES']['DISTANCE_LINK']['VALUE']?>" class="distance btn">
												<span><?=GetMessage("DISTANCE_PARTICIPATION")?></span>
											</a >
										</div>
									<?endif?>
									<?if($arResult['DISPLAY_PROPERTIES']['BUTTON_CODE']['~VALUE']['TEXT']):?>
										<div class="table-cell">
											<div class="have-captcha-block opacity-btn-in button-style">
												<a class="opacity-btn g-recaptcha-custom" id="top-captch-form" data-size="invisible" data-sitekey="6Lejf6cUAAAAALsMTJOQmrm2dh64sLu5PVf9ZnAp"></a>
												<?=$arResult['DISPLAY_PROPERTIES']['BUTTON_CODE']['~VALUE']['TEXT']?>	
											</div>
										</div>
									<?endif?>
								</div>
							</div>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div><!--// the-cards -->
</section><!--//end screen-menu-->
</header>

<div class="particles-bg-5" id="particles-bg-5"></div>
<section role="main" class="info-block <?//=(!empty($arResult['DISPLAY_PROPERTIES']['PROG_])?"gradient-style":"")?>">
    <div class="info-block-menu" style="position: relative; margin-bottom: 0px;">
        <div class="container">
            <div class="col-12">

                <ul>
                    <?if(!empty($arResult['DETAIL_TEXT'])){?>
                    <li><a href="#PREVIEW_TEXT">????????????????</a></li><?}?>
                    <? if(!empty($arResult['DISPLAY_PROPERTIES']['LECTURE']['DISPLAY_VALUE'])): ?>
                        <li><a href="#LECTURE">?????????????? ??????????????????</a></li>
                    <? endif; ?>
                    <? if(!empty($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE'])): ?>
                        <li><a href="#PROG_EVENT">??????????????????</a></li>
                    <? endif; ?>
                    <? if(!empty($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'])): ?>
                        <li><a href="#EXPERTS">??????????????????????????</a></li>
                    <? endif; ?>
                    <? if(!empty($arResult['DISPLAY_PROPERTIES']['HANDOUT']['FILE_VALUE'])): ?>
                        <li><a href="#HANDOUT">?????????????? ????????????????</a></li>
                    <? endif; ?>
                    <?/* if(!empty($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'])): ?>
                        <li><a href="#RECEIVED">???????????????????? ????????????????</a></li>
                    <? endif; */?>
                    <?/*<li><a href="#REVIEWS">????????????</a></li>
                    <li><a href="#VIDEO">?????????? / ????????</a></li>*/?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container custom-detail-course">
        <div class="row">
		<?$pictSrc = $arResult['DETAIL_PICTURE']['SRC'] ? $arResult['DETAIL_PICTURE']['SRC'] : ''?>
			<div class="<?=$pictSrc ? 'col-sm-12 col-md-9 col-lg-9':'col-md-12 col-lg-9'?>">
            <div class="catalog-element" style="position: relative; background-color: #fff; padding-top: 30px;">
                <? if($arResult['DETAIL_TEXT']): ?>
                <h5 id="PREVIEW_TEXT">????????????????</h5>
					<?if($arResult['DETAIL_TEXT_TYPE'] == 'html'):?>
						<div><?=$arResult['~DETAIL_TEXT']//=strip_tags($arResult['PREVIEW_TEXT'],"<strong><i><u>")?></div>
					<?else:?>
						<div><?=$arResult['DETAIL_TEXT']//=strip_tags($arResult['PREVIEW_TEXT'],"<strong><i><u>")?></div>
					<?endif?>
                <? endif; ?>
				<?if($pictSrc):?>
				<div class="img-right col-sm-12 col-md-3 col-lg-3 hidden-xs-up">
					<a href="<?=$pictSrc?>" class="fancybox" data-fancybox="group" rel="photo_arr">
                        <img src="<?=$pictSrc?>" alt="<?=$arResult['NAME']?>">
                    </a>
				</div>
				<?endif?>
                <?/* if($arResult['DETAIL_TEXT']): ?>
                    <? if($arResult['PREVIEW_TEXT']){ ?>
                    <a class="hide-more" href="javascript:void(0);" onclick="$(this).hide(300); $('#infoBlockHide').show(300); $('.hide-detail-text').show(300);">??????????????????</a>
                    <div id="infoBlockHide"><? } ?>
                        <p><?=$arResult['DETAIL_TEXT']?></p>
                    <? if($arResult['PREVIEW_TEXT']){ ?></div>
                    <div class="hide-detail-text" onclick="$(this).hide(300); $('#infoBlockHide').hide(300); $('.hide-more').show(300);">????????????</div><? } ?>
                <? endif; */?>
                <? if(!empty($arResult['DISPLAY_PROPERTIES']['LECTURE']['DISPLAY_VALUE'])): ?>
                <h5 id="LECTURE">?????????????? ??????????????????</h5>
                <p><?=$arResult['DISPLAY_PROPERTIES']['LECTURE']['DISPLAY_VALUE']?></p>
                <? endif; ?>
            </div>
            <? if(!empty($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE'])): ?>
            <div class="program-event" style="position: relative; padding-top: 30px;">
                <h5 id="PROG_EVENT">??????????????????</h5>
                <ul class="program-event"><?//var_dump($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE']);?>
                    <?
                    if(is_array($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE'])){
                    foreach($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE'] as $key=>$pe):
                    if(empty($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DESCRIPTION'][$key])){continue;}?>
                    <li class="program-event-item">
                        <div class="program-event-item__title">
						
						<?if($arResult['DISPLAY_PROPERTIES']['TITLE_EVENT']['VALUE'][$key] && $arResult['DISPLAY_PROPERTIES']['TITLE_EVENT']['VALUE'][$key] != '-'):?>
							<h3><?=$arResult['DISPLAY_PROPERTIES']['TITLE_EVENT']['VALUE'][$key]?></h3>
						<?elseif($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DESCRIPTION'][$key] && (!$arResult['DISPLAY_PROPERTIES']['TITLE_EVENT']['VALUE'][$key] || $arResult['DISPLAY_PROPERTIES']['TITLE_EVENT']['VALUE'][$key] == '-')):?>
							<h3><?=$arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DESCRIPTION'][$key]?></h3>
						<?endif?>
                        <p class="total-hours">
                            <?=(!empty($arResult['PROPERTIES']['DURATION_FOR_PROGRAMM']['VALUE'][$key])?$arResult['PROPERTIES']['DURATION_FOR_PROGRAMM']['VALUE'][$key]:'')?>
                        </p>
                        </div>
                    <div class="program-event-text hide"><?=$pe?></div>
                    </li>
                    <?endforeach;}else{?>
                    <li class="program-event-item">
                       <div class="program-event-item__title"><h3><?
                        //var_dump($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DESCRIPTION']);
                        if(!empty($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DESCRIPTION'][0])){
                            echo $arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DESCRIPTION'][0];
                        }?></h3><p class="total-hours">
                        <?=(!empty($arResult['PROPERTIES']['DURATION_FOR_PROGRAMM']['VALUE'])?$arResult['PROPERTIES']['DURATION_FOR_PROGRAMM']['VALUE']:(!empty($arResult['PROPERTIES']['DURATION_FOR_PROGRAMM']['VALUE'][0])?$arResult['PROPERTIES']['DURATION_FOR_PROGRAMM']['VALUE'][0]:''))?></p></div>
                    <div class="program-event-text hide"><?=$arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE']?></div>
                    <?
                    }?></li>
                </ul>
            </div>
            <? endif; ?>
			</div>
			<?if($pictSrc):?>
				<div class="img-right col-sm-12 col-md-3 col-lg-3 hidden-xs-down">
					<a href="<?=$pictSrc?>" class="fancybox" data-fancybox="group" rel="photo_arr">
                        <img src="<?=$pictSrc?>" alt="<?=$arResult['NAME']?>">
                    </a>
				</div>
			<?endif?>
        </div>
    </div>
</section><!--//info-block-->

<? /*if(!empty($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE'])): ?>
<section class="program-event">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="heading-wrapper"><h5 id="PROG_EVENT">?????????????????? ??????????????????????:</h5></div>
                <ul class="program-event">
                    <? foreach ($arResult['DISPLAY_PROPERTIES']['PROG_EVENT']['DISPLAY_VALUE'] as $pe): ?>
                    <li><?=$pe?></li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<? endif;*/ ?>
<?//var_dump($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'][136]);
//foreach($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'] as $el) var_dump($el);?>
<? if(!empty($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'])): ?>
<section class="experts custom-experts experts-nofon" style="margin-top: 20px;">
    <div class="container">
        <div class="row slider_">
            <div class="col-12 col-lg-9">
                <div class="heading-wrapper">
					<h5 id="EXPERTS">??????????????????????????</h5>
					<?/*<a href="#" class="button button--common button--primary">?????? ????????????????</a>*/?>
				</div>
                <? //p($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'],'p'); ?>
                <div class="sliders owl-carousel">
                    <?foreach($arResult['DISPLAY_PROPERTIES']['EXPERTS']['LINK_ELEMENT_VALUE'] as $EXPERT){?>
						<div class="slide">
							<div class="row">
								<div class="col-md-2 center-align">
									<a href="<?=$EXPERT['DETAIL_PAGE_URL']?>" class="experts-items-center">
										<?if(!empty($EXPERT['PREVIEW_PICTURE'])){?>
											<img src="<?=$EXPERT['PREVIEW_PICTURE']['SRC']?>">
										<?}else{?>
											<img src="<?=PRM::SRC(160)?>">
										<?}?>
									</a>
								</div>
								<div class="col-md-10">
									<div class="eperts-pos-desc">
										<div class="experts-items-person"><a href="<?=$EXPERT['DETAIL_PAGE_URL']?>"><?=$EXPERT['NAME']?></a></div>
										<div class="experts-items-person-position">
											<?=$EXPERT['PROPERTY_POSITIONS_VALUE']?>
										</div>
										<div class="experts-items-person-description">
											<?=$EXPERT['PREVIEW_TEXT']?>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}?>                  
                </div>
            </div>
        </div>
    </div>
</section>
<? endif; ?>

<? if(!empty($arResult['DISPLAY_PROPERTIES']['HANDOUT']['FILE_VALUE'])): ?>
<section class="handout">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading-wrapper"><h5 id="HANDOUT">?????????????? ????????????????</h5></div>
            </div>
            <? //p($arResult['DISPLAY_PROPERTIES']['HANDOUT'],'p'); ?>
            <? $FILE_ = (count($arResult['DISPLAY_PROPERTIES']['HANDOUT']['VALUE'])>1?$arResult['DISPLAY_PROPERTIES']['HANDOUT']['FILE_VALUE']:[$arResult['DISPLAY_PROPERTIES']['HANDOUT']['FILE_VALUE']]); ?>
            <? foreach ($FILE_ as $FILE_VALUE): ?>
                <? $FILE_VALUE['DESCRIPTION'] = ($FILE_VALUE['DESCRIPTION']?$FILE_VALUE['DESCRIPTION']:"(?????????????? ????????????????)"); ?>
                <div class="col-6 col-md-6 col-lg-3"><a href="javascript:void(0);" rel="<?=$FILE_VALUE['ID']?>" class="handout-item file-value-handout<?='-add'?>" title="<?=$FILE_VALUE['DESCRIPTION']?>"><?=$FILE_VALUE['DESCRIPTION']?></a></div>
            <? endforeach; ?>
        </div>
    </div>
</section>
<? endif; ?>

<?if(!empty($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'])): ?>
<section class="received-document">
    <div class="container">
        <div class="row<?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['VALUE']['1'] ? ' two-columns':''?>">
			<?if($arResult['DISPLAY_PROPERTIES']['RECEIVED']['VALUE']['1']):?>
				<div class="col-12 col-lg-6 recived-item recived-item-first">
					<div class="heading-wrapper">
						<h5 id="RECEIVED"><?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['NAME']?></h5>
					</div>
					<div class="received-document__pic">
						<img src="<?=CFile::GetPath($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['DETAIL_PICTURE'])?>">
					</div>
					<?if($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['PREVIEW_TEXT']):?>
						<div class="received-document__description">
							<?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['PREVIEW_TEXT']?>
						</div>
					<?endif?>
				</div>
				<div class="col-12 col-lg-6 recived-item recived-item-second">
					<div class="heading-wrapper">
						<h5 id="RECEIVED"><?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][1]]['NAME']?></h5>
					</div>
					<div class="received-document__pic">
						<img src="<?=CFile::GetPath($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][1]]['DETAIL_PICTURE'])?>">
					</div>
					<?if($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][1]]['PREVIEW_TEXT']):?>
						<div class="received-document__description">
							<?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][1]]['PREVIEW_TEXT']?>
						</div>
					<?endif?>
				</div>
			<?else:?>
				<div class="col-12 col-lg-6">
					<div class="heading-wrapper">
						<h5 id="RECEIVED"><?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['NAME']?></h5>
					</div>
					<?if($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['PREVIEW_TEXT']):?>
						<div class="received-document__description">
							<?=$arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['PREVIEW_TEXT']?>
						</div>
					<?endif?>
				</div>
				<div class="col-12 col-lg-6">
					<div class="received-document__pic">
						<img src="<?=CFile::GetPath($arResult['DISPLAY_PROPERTIES']['RECEIVED']['LINK_ELEMENT_VALUE'][$arResult['PROPERTIES']['RECEIVED']['VALUE'][0]]['DETAIL_PICTURE'])?>">
					</div>
				</div>
			<?endif?>            
        </div>
    </div>
</section>
<? endif; ?>
<? /**/  ?>
<div class="reviews-in-course">
<?$APPLICATION->IncludeComponent('acs:acs.reviews','.default',
    ['CACHE_TYPE' => $arParams['CACHE_TYPE'],
    'CACHE_TIME' => $arParams['CACHE_TIME'],
    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
    'ELEMENT_ID'=>$arResult['ID'],
	'IS_INCOURSES'=>'Y',
	'GROUP_ID'=>$arResult['SECTION']['ID'],
    ],
    $component
);?>

</div>

<?
global $elementVideoReview;
$elementVideoReview=[
    'PROPERTY_COURSE_ID'=>$arResult['ID']
];
$APPLICATION->IncludeComponent("acs:gallery.line","video_reviews",[
        "IBLOCK_TYPE" => "reviews",
        "IBLOCKS" => Array("17"),
		"IN_COURSES" => "Y",
        "NEWS_COUNT" => 4,
        "FIELD_CODE" => Array("ID","CODE","PREVIEW_PICTURE"),
        "PROPERTY_CODE" => Array("YOUTUBE"),
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        //"DETAIL_URL" => "#SITE_DIR#/academy/video/#ELEMENT_CODE#/",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "CACHE_TYPE" => $arParams['CACHE_TYPE'],
        "CACHE_TIME" => $arParams['CACHE_TIME'],  // 1 hour - Cache time in seconds.
        "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
        'FILTER_NAME'=>'elementVideoReview',
        //
        "TITLE_PAGE"=>"??????????????????????",
        "TITLE_PAGE_URL"=>"/academy/video/",
        "INDEX_PAGE_TITLE"=>'??????????????????????', // the title
        //"INDEX_PAGE_URL"=>"http://www.youtube.com/watch?v=opj24KnzrWo", // the url
    ], $component
);
?>
<section class="promo_block<?=$arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] == "Y" ? ' ispromo':''?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="promo_block-inner">
                    <div class=" dates">
                        <small>???????? ?????????????????? ????????????:</small>
                        <div>
                    <? if(!empty($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'])){ ?>
                        <? foreach ($arResult['DISPLAY_PROPERTIES']['DATES']['VALUE'] as $DA){?>
                            <div class="closest-date"><?=$DA?></div>
                    <?break;}?>
                    <?} elseif ($arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']){?>
                        <div><?=date("d F Y H:i",strtotime($arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']))?> <?//="(".$arResult['DISPLAY_PROPERTIES']['CITY']['VALUE'].")"?></div>
                    <?}else{?>
                    <div class="closest-date">?????????????????? ?? ??????????????????</div>
                        <?}?>
                        </div>
                    </div>
                    <div class="pirces">
                        <?foreach($arResult["ITEM_PRICES"] as $code=>$arPrice):?>
                                <div class="the-cards-body-prise">
                                    <small>??????????????????</small>
										<?if($arPrice['PRICE'] == '0'):?>
											<span><b>??????????????????</b></span>
										<?else:?>
											<span><b><?=CurrencyFormat($arPrice['BASE_PRICE'],$arPrice['CURRENCY'])?></b></span>
										<?endif?>
                                </div>
                        <?endforeach;?>
                    </div>
<?if($arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] != "Y"):?>
                        <div class="get_commerse b24form">
                            <?=$arResult['PROPERTIES']['KP_BUTTON_CODE']['~VALUE']['TEXT']?>
                        </div>
<?endif?>
                        <div class="middle-button-form button_form short-button">
                        <?/*<form action="<?=POST_FORM_ACTION_URI?>" method="post" class="SubmitFormAjax">
                            <? if(!empty($arResult['PREVIEW_PICTURE'])): ?>
                                <input type="hidden" name="PREVIEW_PICTURE" value="<?=$arResult['PREVIEW_PICTURE']['SRC']?>">
                            <? endif; ?>
                            <input type="hidden" name="NAME" value="<?=$arResult['NAME']?>">
                            <input type="hidden" name="<?=$arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1">
                            <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]?>" value="BUY">
                            <input type="hidden" name="<?=$arParams["PRODUCT_ID_VARIABLE"]?>" value="<?=$arResult["ID"]?>">
                            <input type="hidden" name="go" value="ADD2BASKETBYPRODUCTID">
                            <button type="submit" name="<?=$arParams["ACTION_VARIABLE"]."ADD2BASKETBYPRODUCTID"?>" class="button button--common button--primary">???????????????? ????????</button>    
                        </form>*/?>
                        <?//var_dump($arResult['DISPLAY_PROPERTIES']['BUTTON_CODE']['~VALUE']);?>
                        <?if($arResult['DISPLAY_PROPERTIES']['DISTANCE_LINK']['VALUE'] && $arResult['DISPLAY_PROPERTIES']['IS_PROMO']['VALUE_XML_ID'] == "Y"):?>
							<div class="table-cell">
								<a target="_blank" href="<?=$arResult['DISPLAY_PROPERTIES']['DISTANCE_LINK']['VALUE']?>" class="distance btn">
									<span><?=GetMessage("DISTANCE_PARTICIPATION")?></span>
								</a >
							</div>
						<?endif?>
						<?if($arResult['DISPLAY_PROPERTIES']['BUTTON_CODE']['~VALUE']['TEXT']):?>
							<div class="table-cell">
								<div class="have-captcha-block opacity-btn-in">
									<a class="opacity-btn g-recaptcha-custom" id="middle-captch-form" data-size="invisible" data-sitekey="6Lejf6cUAAAAALsMTJOQmrm2dh64sLu5PVf9ZnAp"></a>
									<?=$arResult['DISPLAY_PROPERTIES']['BUTTON_CODE']['~VALUE']['TEXT']?>	
								</div>
							</div>
						<?endif?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>>
    </div>
</section>