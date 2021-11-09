<section class="search-panel-2">
    <div class="container"><?//var_dump($arResult);?>
		<?if(!empty($arResult['CHILD'])){?>
        <form action="" method="post" class="row coursers-line-form" name="coursers-line-form" id="coursers-line-form">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 coursers-line-name-body">
                
                <?/*<label>Подразделы направления</label>
                <!--<select name="coursers-line-name" class="coursers-line-name" id="coursers-line-name" style="display: none;">
                    <option value="">Все</option>
                    <?foreach($arResult['CHILD'] as $ITEM){?>
                    <option value="<?=$ITEM['ID']?>"><?=$ITEM['NAME']?></option>
                    <?}?>
                </select>-->*/?>
                <ul class="courses-sections">
                    <?foreach($arResult['CHILD'] as $ITEM):?>
                        <li class="courses-sections__items">
                            <a href="<?=$ITEM['SECTION_PAGE_URL']?>">
                                <span class="name"><?=$ITEM['NAME']?></span>
                                <sup class="quantity-courses"><?=$ITEM['ELEMENT_CNT']?></sup>
                            </a>
                        </li>
                    <?endforeach;?>
                </ul>
            </div>
        </form>
		<?}?>
    </div>
</section>