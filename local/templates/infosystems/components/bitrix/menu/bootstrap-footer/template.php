<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?if (!empty($arResult)):?>
    <ul class="menu-list">
        <? /* class='divider' */
        foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <?if($arItem['PARAMS']['NOINDEX'] == 'Y'):?>
                <li <?echo $arItem["SELECTED"]?' class="active"':''?>><a href="<?=$arItem["LINK"]?>" rel="nofollow"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li <?echo $arItem["SELECTED"]?' class="active"':''?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif;?>
        <?endforeach?>
    </ul>
<?endif?>
