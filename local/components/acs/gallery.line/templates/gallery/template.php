<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**/
global  $APPLICATION;
$this->setFrameMode(true);
/**/
?>

<script type="text/javascript">
    $(document).ready( function() {
        Bitr.galleryformatter.prepare(".galleryformatter");
        $(".fancybox").fancybox({maxWidth: 800, maxHeight: 600, padding:3});
        /**/
        $('body').on('click', '.gallery-navigations li span', function(event){
            event.preventDefault();
            var $rls = unserialize($(this).parent().attr('rel'));
            /**/
            if (!$(this).parent().hasClass("active")) {
                var $arrGa = <?=json_encode($arResult["GALLERY"])?>;
                $('#offerGallery').html($arrGa[$rls['KEY']]['HTML']);
                $('.galleryformatter-text-bilding').html($arrGa[$rls['KEY']]['TEXT']);
                Bitr.galleryformatter.prepare(".galleryformatter");
                /*console.log($arrGa[$rls['KEY']]);*/
            }
            return false;
        });
    });
</script>

<? //p($arResult["GALLERY"],'p'); ?>
<div class="jumbotron-fon-our-works" id="works">
    <div class="container theme-our-works">
    <div class="page-header"><h1>Наши работы</h1></div>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <? /* updated text */ ?>
        <div class="galleryformatter-text-bilding">
            <h3><?=$arResult["ITEMS"][0]['NAME']?></h3>
            <p class="text-justify"><?=$arResult["ITEMS"][0]['PREVIEW_TEXT']?></p>
        </div>
        <? /* end updated text */ ?>
        <p class="theme-our-works-button">
            <button type="button" class="btn btn-lg btn-warning order-phones">Заказать звонок</button>
        </p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div id="offerGallery">
            <? // включаем шаблон для галереии
            $KEY_ = 0;
            include(dirname(__FILE__)."/inc/photos.php");  ?>
        </div>
    </div>
    </div>
    </div>
</div>
