<form action="./" class="form courses-filter coursers-line-form<?=$_GET ? ' form_to_scroll' : ''?>">
	<?if(!empty($_GET['SORT'])){?>
		<input type="hidden" name="SORT" value="<?=$_GET['SORT']?>">
	<?}?>
	<?if(!empty($_GET['DATE'])){?>
		<?foreach($_GET['DATE'] as $key=>$val){?>
			<input type="hidden" name="DATE[]" value="<?=(!empty($_GET['DATE'][$key])?$_GET['DATE'][$key]:'')?>">
		<?}?>
	<?}?>
	<div class="row">
		<div class="col-12 col-sm-6 col-md-4">
			<label>Форма обучения</label>
			<select onchange="submitform(this)" name="FORM_TRAINING" class="coursers-line" id="coursers-line" style="display: none;">
				<option value="all">Не важно</option>									
				<?foreach($arResult['FORM_TRAINING'] as $form_training){?>
					<option value="<?=$form_training['VALUE']?>" <?=($form_training['SELECTED']?'selected':'')?>><?=$form_training['NAME']?></option>	
				<?}?>
			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-4">
			<label>Вендор</label>
			<select onchange="submitform(this)" name="VENDOR" class="coursers-line" id="coursers-line" style="display: none;">
				<option value="all">Все</option>
				<?foreach($arResult['VENDORS'] as $vendor){?>
					<option value="<?=$vendor['ID']?>" <?=($vendor['SELECTED']?'selected':'')?>><?=$vendor['NAME']?></option>
				<?}?>
			</select>
		</div>
		<div class="col-12">
			<label>Начало курса:</label>
			<?if(!empty($arResult['DATES'])){?>
			<ul	class="start-month-filter owl-carousel">
				<?foreach($arResult['DATES'] as $year=>$dates){?>
					<li class="start-month-filter__item <?=($dates['SELECTED']?'active':'')?>">
						<button name="DATE[]" value="<?=$year?>"><?=$year?></button>
					</li>
					<?foreach($dates['MONTHS'] as $month=>$month_name){?>
					<li class="start-month-filter__item <?=($month_name['SELECTED']?'active':'')?>">
						<button name="DATE[]" value="<?=$month.'.'.$year?>"><?=$month_name['NAME']?></button>
					</li>	
					<?}?>
				<?}?>
			</ul>
			<?}?>
		</div>
		<div class="col-12">
			<div class="courses-sort">
				<div class="sort-by">
					<span>Сортировать:</span>
					<?
					$sorting=explode(',',$_GET['SORT']);
					?>
					<button
						
						name="SORT"
						value="<?
						$price_active=false;
						if(!empty($_GET['SORT'])){
							
							if($sorting[0]=='PRICE')
								if($sorting[1]=='ASC'){
									$price_active=true;
									echo 'PRICE,DESC';
								}else{
									$price_active=true;
									echo 'PRICE,ASC';
								}
						}else{
							echo 'PRICE,ASC';
						}
						?>"
						class="<?
						if(!empty($_GET['SORT'])){
							if($sorting[0]=='PRICE')
								if($sorting[1]=='ASC'){
									echo 'sort-by--low';
								}else{
									echo 'sort-by--high';
								}
						}?> <?=($price_active?'active':'')?>">по цене<?=($price_active?'<i class="price-sort"></i>':'')?>
					</button>
					<button
						name="SORT"
						value="<?
						if(!empty($_GET['SORT'])){
							if($sorting[0]=='DATES')
							if($sorting[1]=='ASC'){
								echo 'DATES,DESC';
							}else{
								echo 'DATES,ASC';
							}
						}else{
							echo 'DATES,ASC';
						}
						?>"
						class="
						<?if(!empty($_GET['SORT'])){
							$dates_active=false;
							if($sorting[0]=='DATES')
							if($sorting[1]=='ASC'){
								$dates_active=true;
								echo 'sort-by--low';
							}else{
								$dates_active=true;
								echo 'sort-by--high';
							}
						}?> <?=($dates_active?'active':'')?>"
					>по дате начала<?=($dates_active?'<i class="price-sort"></i>':'')?></button>
				</div>
				<div class="input-wrapper">
					<input
						   type="checkbox"
						   onchange="$('.courses-filter.coursers-line-form').submit()"
						   name="NEW"
						   id="new-courses"
						   value="Y"
						   <?if(!empty($_GET['NEW'])&&$_GET['NEW']=='Y') echo 'checked';?>
						   >
					<label for="new-courses">Новые</label>
				</div>
				<div class="input-wrapper">
					<input type="checkbox"
						   onchange="$('.courses-filter.coursers-line-form').submit()"
						   name="FREE"
						   id="free-courses"
						   value="Y"
						   <?if(!empty($_GET['FREE'])&&$_GET['FREE']=='Y') echo 'checked';?>
						   >
					<label for="free-courses">Бесплатные</label>
				</div>
				<div class="input-wrapper">
					<input type="checkbox"
						   onchange="$('.courses-filter.coursers-line-form').submit()"
						   name="OPEN"
						   id="open-courses"
						   value="Y"
						   <?if(!empty($_GET['OPEN'])&&$_GET['OPEN']=='Y') echo 'checked';?>
						   >
					<label for="open-courses">Открытая дата</label>
				</div>
			</div>
		</div>
	</div>				
</form>