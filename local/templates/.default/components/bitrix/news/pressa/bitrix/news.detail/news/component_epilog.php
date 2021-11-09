<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//
global $USER, $APPLICATION;
$APPLICATION->SetPageProperty("shareYandex", "Y");
/**/
/*p($_SESSION["IBLOCK_RATING"],'p');
p($arResult['ID'],'p');*/
$arJson = [];
if(count($_SESSION["IBLOCK_RATING"])>0 && array_key_exists($arResult['ID'],$_SESSION["IBLOCK_RATING"])){
    $arJson['jq']['addClass']['.favorPressa[data-item="'.$arResult['ID'].'"]'] = 'active';
    $arJson['jq']['attributeName']['.favorPressa[data-item="'.$arResult['ID'].'"]']['title'] = 'Добавлено в избранное';
}

// .shareYandex // добавляет элемент звездочка рядом с расшариванием и т.д.
/* if(intval($arResult['ID'])>0){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var $zv = '<nobr><a href="#" data-item="<?=$arResult['ID']?>" data-title="<?=$arResult['NAME']?>" class="favorPressa" title="Добавить в Избранноe"><i class="fa fa-star" aria-hidden="true"></i></a></nobr>';
            $(".shareYandex").prepend($zv);
            //
            var res = <?=json_encode($arJson)?>;
            if(res.jq){ JQ(res.jq); }

            //
            $('body').on('click','.favorPressa', function (event) {
                event.preventDefault();
                var $val = $(this).attr("data-item"), $title = $(this).attr("data-title");
                var $doAction = ($(this).hasClass('active')?'delete':'add');
                showWait();
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "<?=POST_FORM_ACTION_URI?>",
                    data: {go:"addFavorPressa", title:$title, ID:$val, doAction:$doAction},
                    success: function(res){
                        closeWait();
                        if(res.jq){ JQ(res.jq); }
                        if(res.alert){ showMessage(res.alert, res.title, res.cansel); }
                        if(res.error){ showMessage(res.error, res.title, res.cansel); }
                    }
                });
                return false;
            });
        });
    </script>
<? } */