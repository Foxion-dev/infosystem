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
if(count($arResult["ITEMS"])): ?>
<? //
$arrJson = [];
foreach ($arResult["ITEMS"] as $ITEM){
    if(!empty($ITEM['PREVIEW_PICTURE'])){
        $PR = PRM::PR($ITEM['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 500, "height" => 800));
        $ITEM['SRC'] = $PR['SRC'];
    }else{
        $ITEM['SRC'] = PRM::SRC(500);
    }
    $arrJson[$ITEM['ID']] = [
        'ID'=>$ITEM['ID'],
        'NAME'=>$ITEM['NAME'],
        'PREVIEW_PICTURE' => $ITEM['SRC'],
        'PREVIEW_TEXT'=>$ITEM['PREVIEW_TEXT'],
        'DETAIL_TEXT'=>$ITEM['DETAIL_TEXT'],
    ];
}
$items = array_chunk($arResult["ITEMS"], 4, false); ?>
<div class="photogallery-slider owl-carousel">
    <? foreach ($items as $item): ?>
    <div class="slide row">
        <?foreach($item as $arItem):?>
            <? $arrJson[$arItem['ID']] = ['NAME'=>$arItem['NAME'], 'PREVIEW_PICTURE'=>$arItem['PREVIEW_PICTURE']['SRC'],'PREVIEW_TEXT'=>$arItem['PREVIEW_TEXT']]; ?>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="academy-customers-doc">
                    <? if(!empty($arItem['PREVIEW_PICTURE'])){
                        $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 500, "height" => 800));  ?>
                        <a href="<?=$PR['SRC']?>"><img src="<?=$PR['SRC']?>" alt="<?=$arItem["NAME"]?>" rel="<?=$arItem['ID']?>"></a>
                    <? } ?>
                    <p><?=$arItem["NAME"]?></p>
                </div>
            </div>
        <? endforeach; ?>
    </div>
	<? endforeach;?>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('body').on('click','.academy-customers-doc img', function (event) {
                event.preventDefault();
                var $JS = <?=json_encode($arrJson)?>;
                var $ID = $(this).attr('rel');
				var pict = $JS[$ID]['PREVIEW_PICTURE'] && !$JS[$ID]['PREVIEW_TEXT'] ? '12':'6';
				var txt = !$JS[$ID]['PREVIEW_PICTURE'] && $JS[$ID]['PREVIEW_TEXT'] ? '12':'6';
				var classNum = pict == '12' || txt == '12' ? 1:2;
                var $HTML = '<div class="row"><div class="col-'+pict+'"><img class="academy-customers-images" src="'+$JS[$ID]['PREVIEW_PICTURE']+'"></div><div class="col-'+txt+' academy-customers-font">'+$JS[$ID]['PREVIEW_TEXT']+'</div></div>';
                showMessageRev($HTML, $JS[$ID]['NAME'], false, classNum);
                return false;
            });
        });
    </script>
<? endif;