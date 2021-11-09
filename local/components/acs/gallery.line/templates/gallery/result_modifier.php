<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($arResult); echo "</pre>";

// формируем галерею
$previewImg = array("full","image","thumb");
$widthImg  = array(800,765,207);
$heightImg = array(800,421,124);
foreach ($arResult["ITEMS"] as $k=>$ITEM){
    //
    $pArr = [];
    if(count($ITEM['DISPLAY_PROPERTIES']['PHOTO']['VALUE'])){
        foreach ($ITEM['DISPLAY_PROPERTIES']['PHOTO']['VALUE'] as $ip_ => $PID){
            //
            foreach ($previewImg as $i=>$pi) {
                $arFile = CFile::ResizeImageGet(
                    $PID,
                    array("width" => $widthImg[$i] , "height" => $heightImg[$i]),
                    ($pi=="full" ? BX_RESIZE_IMAGE_PROPORTIONAL:BX_RESIZE_IMAGE_EXACT),
                    true
                );
                if($arFile) {
                    $pArr[$ip_][$pi] = $arFile;
                }
            }
        }
    }
    // p($pArr,'p');
    $arResult['GALLERY'][$k] = [
        "id"=>$ITEM['ID'],
        "TEXT"=>"<h3>".$ITEM['NAME']."</h3><p class='text-justify'>".strip_tags($ITEM['PREVIEW_TEXT'])."</p>",
        "IMAGES"=>$pArr,
    ];
}
//
foreach ($arResult['GALLERY'] as $keys_ => &$items){
    ob_start();
    $KEY_ = intval($keys_);
    include(dirname(__FILE__)."/inc/photos.php");
    $html = ob_get_contents();
    ob_end_clean();
    $items['HTML'] = $html;
}