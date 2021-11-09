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
if(count($arResult["ITEMS"])):
?>
<div class="TopReviewsBody">
    <h3 class="page-header gray_bg">Скидочные купоны от наших партнеров</h3>
    <div class="row">
        <?foreach($arResult["ITEMS"] as $i=>$arItem):?>
            <div class="col-xs-6 col-sm-12 col-md-12 col-lg-12"><div class="couponVip">
                <? if(!empty($arItem['PREVIEW_PICTURE'])){
                    $PR = PRM::PR($arItem['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 400, "height" => 250));  ?>
                    <a href="#" data-id-cupon="<?=$arItem['ID']?>" class="idCupon"><img src="<?=$PR['SRC']?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" class="img-responsive"></a>
                <? } ?>
                <div class="couponVipTiser" <?=(count($arResult["ITEMS"])==($i+1)?'style="border: none;"':'')?>>
                    <?/*<div class="couponVipTiserName"><?echo $arItem["NAME"]?></div>
                    <div class="couponVipTiserProp"><span>Скидка</span> <?=$arItem['PROPERTY_DISCONT_VALUE']?></div> */?>
                    <?/*<div class="couponVipTiserProp"><span>Промокод</span> <?=$arItem['PROPERTY_PCODE_VALUE']?></div>*/?>
                    <? echo my_crop(strip_tags($arItem["PREVIEW_TEXT"]),100)?>
                </div>
            </div></div>
            <? $ah = $i+1; if(($ah % 2) == 0){
                echo '<div class="visible-xs clearfix"></div>';
            } ?>
        <?endforeach;?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="/coupons/" class="couponVipOll">смотреть все купоны <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>
<?  $listArr = [];
    foreach ($arResult["ITEMS"] as $arr){
        $imgArr = "";
        if(!empty($arr['PREVIEW_PICTURE'])){
            $PR = PRM::PR($arr['PREVIEW_PICTURE']['ID'], $arSize = array("width" => 400, "height" => 250));
            $imgArr = '<img src="'.$PR['SRC'].'" style="float: left; margin-right: 15px; max-width: 200px;" title="'.$arr["TITLE"].'">';
        }
        $listArr[$arr['ID']] = ["NAME"=>$arr['NAME'],"PREVIEW_TEXT"=>"<div class='text-justify'>".$imgArr.strip_tags($arr['PREVIEW_TEXT'])."</div>"];
    } ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '.idCupon', function (event) {
            event.preventDefault();
            var $listCuponArr = <?=json_encode($listArr)?>;
            var $idc = $(this).attr("data-id-cupon");
            if($listCuponArr[$idc]) {
                showMessage($listCuponArr[$idc]['PREVIEW_TEXT'], $listCuponArr[$idc]['NAME'], false, 1);
            }
            return false;
        });
    });
</script>
<? endif; ?>