<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// подключение шаблона
include(dirname(__FILE__) . "/mail/header.php");  ?>

<? // популярные курсы
// include(dirname(__FILE__) . "/mail/popular_courses.php"); ?>

<? //
foreach($arResult["IBLOCKS"] as $arIBlock):
	if(count($arIBlock["ITEMS"])):
?>
    <!-- Start of heading -->
    <table width="100%" bgcolor="#eff3f3" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
        <tbody>
        <tr>
            <td>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                    <tr>
                        <td width="100%">
                            <table bgcolor="#2d2d2d" width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                <tbody>
                                <tr>
                                    <td align="center" style="font-family: Helvetica, arial, sans-serif; text-transform: uppercase; font-size: 20px; color: #ffffff; padding: 15px 0;" st-content="heading" bgcolor="#2d2d2d" align="center">
                                        Прошедшие курсы
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- End of heading -->
    <? //p($arIBlock["ITEMS"],'p'); ?>
    <? $COURSE = array_chunk($arIBlock["ITEMS"],2); ?>
    <? foreach ($COURSE as $PC): ?>
        <!-- 2columns -->
        <table width="100%" bgcolor="#eff3f3" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
            <tbody>
            <tr>
                <td>
                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                        <tbody>
                        <tr>
                            <td width="100%">
                                <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <? foreach ($PC as $i=>$item){ $cls = ($i==0?'left':'right'); ?>
                                                <table width="290" align="<?=$cls?>" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                    <!-- Spacing -->
                                                    <tr>
                                                        <td width="100%" height="10"></td>
                                                    </tr>
                                                    <!-- Spacing -->
                                                    <tr>
                                                        <td>
                                                            <!-- start of text content table -->
                                                            <table width="270" align="<?=($i==0?'right':'left')?>" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                <tbody>
                                                                <!-- image -->
                                                                <tr>
                                                                    <td width="270" align="center" class="devicewidth">
                                                                        <? if(!empty($item['PREVIEW_PICTURE'])){
                                                                            $PR = PRM::PR($item['PREVIEW_PICTURE']['ID'], $arSize = ["width" => 800, "height" => 600]); ?>
                                                                            <a href="<?=$item['DETAIL_PAGE_URL']?>">
                                                                                <img src="<?=PRM::isHttps().$_SERVER['SERVER_NAME'].$PR['SRC']?>" alt="" border="0" width="270" height="150" style="display:block; border:none; outline:none; text-decoration:none;" class="colimg2">
                                                                            </a>
                                                                        <? }else{ ?>
                                                                            <a href="<?=$item['DETAIL_PAGE_URL']?>">
                                                                                <img src="<?=PRM::isHttps().$_SERVER['SERVER_NAME'].PRM::SRC(500)?>" alt="" border="0" width="270" height="150" style="display:block; border:none; outline:none; text-decoration:none;" class="colimg2">
                                                                            </a>
                                                                        <? } ?>
                                                                    </td>
                                                                </tr>
                                                                <!-- title -->
                                                                <tr>
                                                                    <td width="270" bgcolor="#2d2d2d" height="50">
                                                                        <table width="170" align="left" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #2d2d2d;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; text-transform: uppercase; color: #ffffff; padding-left: 10px;" align="left" height="50">
                                                                                    <?=FormatDate("d F Y",strtotime($item['PROPERTY_DATE_VALUE']))?>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table width="100" align="right" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #000000;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #ffffff;" bgcolor="#000000" align="center" height="50" >
                                                                                    <?=($arResult["PRISE"][$item['ID']]?$arResult["PRISE"][$item['ID']]:'')?>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="270" height="75" bgcolor="#eff3f3">
                                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; padding: 10px 10px;">
                                                                                    <a href="<?=$item['DETAIL_PAGE_URL']?>" style="color: #262626; line-height: normal; display: block; overflow: hidden; height: 50px;"><?=$item['NAME']?></a>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <!-- end of title -->
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="10"></td>
                                                    </tr>
                                                    <!-- end of text content table -->
                                                    </tbody>
                                                </table>
                                            <? } ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- end of 2 columns -->
    <? endforeach; ?>
    <!-- Start of seperator -->
    <table width="100%" bgcolor="#eff3f3" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
        <tbody>
        <tr>
            <td>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                    <tr>
                        <td align="center" height="30" style="font-size:1px; line-height:1px;">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- End of seperator --><?
	endif;
?>
<?endforeach?>

<? // подключение шаблона
include(dirname(__FILE__) . "/mail/footer.php");  ?>