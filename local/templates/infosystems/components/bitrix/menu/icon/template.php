<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?if (!empty($arResult)):?>
    <div class="net-menu">
        <div class="net-menu-logo">
            <div class="logo-bg"></div>
            <div class="logo"></div>
        </div>
        <a href="<?=$arResult[0]['LINK']?>" class="net-menu-item net-menu-item--lg title-position--bottom item-1">
            <div class="menu-icon icon-security"></div>
            <span class="menu-item-title"><?=$arResult[0]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[1]['LINK']?>" class="net-menu-item net-menu-item--md title-position--right item-2">
            <div class="menu-icon icon-bsi"></div>
            <span class="menu-item-title"><?=$arResult[1]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[2]['LINK']?>" class="net-menu-item net-menu-item--lg title-position--right item-3">
            <div class="menu-icon icon-network"></div>
            <span class="menu-item-title"><?=$arResult[2]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[3]['LINK']?>" class="net-menu-item net-menu-item--sm title-position--right item-4">
            <div class="menu-icon icon-diagram"></div>
            <span class="menu-item-title"><?=$arResult[3]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[4]['LINK']?>" class="net-menu-item net-menu-item--md title-position--right item-5">
            <div class="menu-icon icon-guard"></div>
            <span class="menu-item-title"><?=$arResult[4]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[5]['LINK']?>" class="net-menu-item net-menu-item--lg title-position--top item-6">
            <div class="menu-icon icon-coins"></div>
            <span class="menu-item-title"><?=$arResult[5]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[6]['LINK']?>" class="net-menu-item net-menu-item--sm title-position--left item-7">
            <div class="menu-icon icon-report"></div>
            <span class="menu-item-title"><?=$arResult[6]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[7]['LINK']?>" class="net-menu-item net-menu-item--lg title-position--left item-8">
            <div class="menu-icon icon-speech"></div>
            <span class="menu-item-title"><?=$arResult[7]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[8]['LINK']?>" class="net-menu-item net-menu-item--lg title-position--left item-9">
            <div class="menu-icon icon-agent"></div>
            <span class="menu-item-title"><?=$arResult[8]['TEXT']?></span>
        </a>
        <a href="<?=$arResult[9]['LINK']?>" class="net-menu-item net-menu-item--sm title-position--left item-10">
            <div class="menu-icon icon-workspace"></div>
            <span class="menu-item-title"><?=$arResult[9]['TEXT']?></span>
        </a>
    </div><!--//end net-menu -->
    <?/*<ul class="nav navbar-nav">
        <? //
        foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <? if($arItem['LINK']=="/news/"){ echo '<li class="divider"></li>'; } ?>
            <?if($arItem['PARAMS']['NOINDEX'] == 'Y'):?>
                <li <?echo $arItem["SELECTED"]?' class="active"':''?>><a href="<?=$arItem["LINK"]?>" rel="nofollow"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li <?echo $arItem["SELECTED"]?' class="active"':''?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif;?>
        <?endforeach?>
    </ul> */?>
<?endif?>
