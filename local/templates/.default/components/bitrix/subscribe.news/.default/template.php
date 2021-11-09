<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// подключение шаблона
include(dirname(__FILE__) . "/mail/header.php");  ?>

<? // популярные курсы
include(dirname(__FILE__) . "/mail/popular_courses.php"); ?>

<? //
foreach($arResult["IBLOCKS"] as $arIBlock):
	if(count($arIBlock["ITEMS"]) > 0):
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
                                        Новости
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
    <? //
	foreach($arIBlock["ITEMS"] as $arItem):

		if($arItem["PREVIEW_PICTURE"])
		{
			if(COption::GetOptionString("subscribe", "attach_images")==="Y")
			{
				$sImagePath = $arItem["PREVIEW_PICTURE"]["SRC"];
			}
			elseif(strpos($arItem["PREVIEW_PICTURE"]["SRC"], "http") !== 0)
			{
				$sImagePath = "http://".$arResult["SERVER_NAME"].$arItem["PREVIEW_PICTURE"]["SRC"];
			}
			else
			{
				$sImagePath = $arItem["PREVIEW_PICTURE"]["SRC"];
			}

			$width = 100;
			$height = 100;

			$width_orig = $arItem["PREVIEW_PICTURE"]["WIDTH"];
			$height_orig = $arItem["PREVIEW_PICTURE"]["HEIGHT"];

			if(($width_orig > $width) || ($height_orig > $height))
			{
				if($width_orig > $width)
					$height_new = ($width / $width_orig) * $height_orig;
				else
					$height_new = $height_orig;

				if($height_new > $height)
					$width = ($height / $height_orig) * $width_orig;
				else
					$height = $height_new;
			}
		}
?>
    <!-- article -->
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
                                <!-- Spacing -->
                                <tr>
                                    <td height="20"></td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                    <td>
                                        <table width="560" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <!-- start of text content table -->
                                                    <table width="140" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                                        <tbody>
                                                        <!-- image -->
                                                        <tr>
                                                            <td width="140" height="90" align="center">
                                                                <? if($arItem["PREVIEW_PICTURE"]){ ?>
                                                                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                                                                        <img src="<?echo $sImagePath?>" border="0" width="140" height="90" alt="<?echo $arItem["PREVIEW_PICTURE"]["ALT"]?>"  title="<?echo $arItem["NAME"]?>" style="display:block; border:none; outline:none; text-decoration:none;" label="articleimage">
                                                                    </a>
                                                                <? }else{ ?>
                                                                    <? $sImagePath = PRM::isHttps().$_SERVER['SERVER_NAME'].PRM::SRC(500); ?>
                                                                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                                                                        <img src="<?echo $sImagePath?>" border="0" width="140" height="90" alt="<?echo $arItem["PREVIEW_PICTURE"]["ALT"]?>"  title="<?echo $arItem["NAME"]?>" style="display:block; border:none; outline:none; text-decoration:none;" label="articleimage">
                                                                    </a>
                                                                <? } ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- start of right column -->
                                                    <table width="400" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                                        <tbody>
                                                        <!-- title -->
                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #262626; text-align:left; line-height: 20px;" class="padding-top15">
                                                                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="color: #262626;"><?echo $arItem["NAME"]?></a>
                                                            </td>
                                                        </tr>
                                                        <!-- end of title -->
                                                        <!-- Spacing -->
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <!-- Spacing -->
                                                        <?if(strlen($arItem["DATE_ACTIVE_FROM"])>0):?>
                                                            <tr>
                                                                <td width="100%" height="10" style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #262626; text-transform: uppercase; text-align:left;">
                                                                    <?=FormatDate("d F Y",strtotime($arItem["DATE_ACTIVE_FROM"]))?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="100%" height="10"></td>
                                                            </tr>
                                                        <?endif;?>
                                                        <!-- content -->
                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                                <?echo $arItem["PREVIEW_TEXT"];?>
                                                            </td>
                                                        </tr>
                                                        <!-- end of content -->
                                                        </tbody>
                                                    </table>
                                                    <!-- end of right column -->
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                    <td height="20"></td>
                                </tr>
                                <!-- Spacing -->
                                <!-- bottom-border -->
                                <tr>
                                    <td width="100%" bgcolor="#2d2d2d" height="3" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                </tr>
                                <!-- /bottom-border -->
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
    <!-- end of article -->

    <?
	endforeach;
	?><!-- Start of seperator -->
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