<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
if(!empty($arResult['ITEMS'])): ?>
<script type="text/javascript">
    $(document).ready(function(){
        //
        ymaps.ready(initialize);
        function initialize() {
            var myMap = new ymaps.Map('<?="mapCamp"?>', {
                center:[55.754744,37.756529], // Москва
                zoom: 14,
                controls: ['typeSelector', 'fullscreenControl']
            });
            myMap.controls.add('zoomControl', {size: "small", position: {right: '10px', top: '100px'}});
            // -- http://api.yandex.ru/maps/doc/jsapi/beta/ref/reference/option.presetStorage.xml
            var myClusterer = new ymaps.Clusterer({preset:'<?=$arParams['CLUSTERER']?>'});
            var myGeoObjects = [];
            // -- Creating markers  55.765625, 37.710359
            var obj =  <?=json_encode($arResult['ITEMS'])?>;
            $.each(obj,function(i) {
                /**/
                var latlng = this.COORDINATES.split(',');
                myGeoObjects[i] = new ymaps.Placemark(
                    [latlng[0], latlng[1]],
                    {balloonContentHeader:this.title, balloonContent: this.description},
                    {preset: "<?=$arParams['PRESET']?>",iconColor: '<?=$arParams['ICON_COLOR']?>'});
            }); //-- end Creating markers

            //
            myClusterer.add(myGeoObjects);
            myMap.geoObjects.add(myClusterer);
            //myMap.setBounds(myClusterer.getBounds(),{checkZoomRange:true}); //https://tech.yandex.ru/maps/doc/jsapi/2.0/ref/reference/Map-docpage/#setBounds-param-options
        }
    });
</script>
<div id="<?=$arResult['DIV']?>" class="map-wrap" style="height: <?=$arResult['HEIGHT']."px"?>; width: 100%; margin: 0px auto; margin-top: -25px; margin-bottom: 20px; "></div>
<? endif; ?>