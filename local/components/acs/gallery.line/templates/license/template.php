<section class="academy-customers have-margin-top">
	<div class="container">
		<div class="row">
			<div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3">
				<a href="<?=$arResult['ITEMS'][0]['PREVIEW_PICTURE']['SRC']?>" class="fancybox">
					<img src="<?=$arResult['ITEMS'][0]['PREVIEW_PICTURE']['SRC']?>" class="img-responsive">
				</a>
			</div>
			<div class="col-8 col-sm-8 col-md-8 col-lg-9 col-xl-9" style="position: relative; padding-bottom: 60px;">
				<h2>Лицензии</h2>
				<p><?=$arResult['ITEMS'][0]['PREVIEW_TEXT']?></p>
				<div class="academy-customers-pdf" style="position: absolute; bottom: 10px; left: 15px;">
					<a target="_blank" href="<?=CFile::GetPath($arResult['ITEMS'][0]['PROPERTIES']['PDF']['VALUE'])?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Скачать PDF</a>
				</div>
			</div>
		</div>
	</div>
</section>