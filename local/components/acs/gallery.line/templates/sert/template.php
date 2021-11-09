<section class="academy-information academy-information-background" style="padding-top: 30px; padding-bottom: 30px; margin-bottom: 0px;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<?foreach($arResult['ITEMS']['BOOK'] as $arItem){?>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
								<div class="academy-information-doc">
									<a href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="fancybox" data-fancybox="group"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"></a>
								</div>
							</div>
						<?}?>
					</div>
					<div class="row">
						<?foreach($arResult['ITEMS']['ALBUM'] as $arItem){?>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
								<div class="academy-information-doc">
									<a href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="fancybox" data-fancybox="group"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"></a>
								</div>
							</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
</section>