<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//
global $APPLICATION;
$APPLICATION->SetPageProperty("shareYandex", "Y");
//

if(intval($arResult['ID'])>0){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            if($("div#news-active-from-body").length){
                $(".page-header").prepend($('div#news-active-from-body .col-12').html());
            }
        });
    </script>
<? }