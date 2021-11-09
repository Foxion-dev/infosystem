<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)){?>
<ul class="menu-top-list">
<?$previousLevel=0;
foreach($arResult as $arItem){?>
	<?if($previousLevel&&$arItem["DEPTH_LEVEL"]<$previousLevel){?><?=str_repeat("</ul></li>",($previousLevel-$arItem["DEPTH_LEVEL"]));?><?}?>
	<?if($arItem["IS_PARENT"]){?>
		<?if($arItem["DEPTH_LEVEL"]==1){?>
			<li class="menu-item"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="submenu">
		<?}else{?>
			<li <?if ($arItem["SELECTED"]):?> class="submenu-item item-selected"<?endif?> ><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul class="submenu">
		<?}?>
	<?}else{?>
		<?if($arItem["PERMISSION"]>"D"){?>
			<?if($arItem["DEPTH_LEVEL"]==1){?>
				<li class="menu-item <?if($arItem["SELECTED"]):?>is-active<?endif;?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?}else{?>
				<li<?if ($arItem["SELECTED"]):?> class="submenu-item item-selected"<?else:?> class="submenu-item"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?}?>
		<?}else{?>
			<?if($arItem["DEPTH_LEVEL"]==1){?>
				<li class="menu-item"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?}else{?>
				<li class="submenu-item"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?}?>
		<?}?>
	<?}?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?}?>
<?if($previousLevel>1){//close last item tags?>
	<?=str_repeat("</ul></li>",($previousLevel-1));?>
<?}?>
<?if($arParams['SEARCH_ROOT']!="N"){?>
	<? if($APPLICATION->GetCurDir() == '/test-section/'): ?>
		<?$APPLICATION->IncludeComponent("bitrix:search.title", "new-search", Array(
	"CATEGORY_0" => array(	// Ограничение области поиска
			0 => "no",
		),
		"CATEGORY_0_TITLE" => "",	// Название категории
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
		"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
		"NUM_CATEGORIES" => "1",	// Количество категорий поиска
		"ORDER" => "date",	// Сортировка результатов
		"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
		"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
		"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
		"TOP_COUNT" => "5",	// Количество результатов в каждой категории
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
	),
	false
);?>
	<?else:?>
    <li class="menu-item-search"><a href="#" class="search-root-item-click">Поиск</a></li>
	<?endif;?>
<?}?>
</ul>
<?}?>