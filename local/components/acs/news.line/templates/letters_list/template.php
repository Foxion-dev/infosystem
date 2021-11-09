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

//$items = array_chunk($arResult["ITEMS"], 4, false); ?>
    <? foreach ($arResult["ITEMS"] as $item):?>
    <?$arrJson[$item['ID']]=['NAME'=>$item['NAME'],'PREVIEW_PICTURE'=>$item['PREVIEW_PICTURE']['SRC'],'PREVIEW_TEXT'=>$item['PREVIEW_TEXT']];?>
    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <a
           href="<? if(!empty($arItem['PREVIEW_PICTURE'])){
                        $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 500, "height" => 800)); echo $PR['SRC']; }?>"
           class="academy-container-about-linc academy-customers-doc" rel="<?=$item['ID']?>">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span><?=$item['NAME']?></span>
        </a>
    </div>
	<? endforeach;?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('body').on('click','.academy-customers-doc', function (event) {
                event.preventDefault();
                var $JS = <?=json_encode($arrJson)?>;
                var $ID = $(this).attr('rel');
                var $HTML = '<div class="row"><div class="col-6"><img class="academy-customers-images" src="'+$JS[$ID]['PREVIEW_PICTURE']+'"></div><div class="col-6 academy-customers-font">'+$JS[$ID]['PREVIEW_TEXT']+'</div></div>';
                showMessage($HTML, $JS[$ID]['NAME'], false, 2);
                return false;
            });
        });
    </script>
<? endif;