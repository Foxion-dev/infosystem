<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div id="wrapMap" style="height:500px; margin-top: -25px; margin-bottom: 20px; width:100%; display:inline-block; overflow:hidden;">
    <?/*<iframe width="100%" height="550" style="position:relative; top:-50px; border:none;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/d/embed?mid=1FkXJ952v5qd_JQGNfEmst9QtcU-O6LkU&ll=55.75568059241992%2C37.75423305000004&z=15"></iframe>*/?>
    <iframe style="pointer-events: none;" src="https://yandex.ru/map-widget/v1/?um=constructor%3A4cc7df00e036dd59eebb87b54438fb6198298bc923dba70321da1a2b54877838&source=constructor&scroll=false" width="100%" height="500" frameborder="0"></iframe>
</div>
    <script>
        var mapTitle = document.createElement('div'); mapTitle.className = 'mapTitle';
        mapTitle.textContent = 'Для активации карты нажмите по ней';
        wrapMap.appendChild(mapTitle);
        wrapMap.onclick = function() {
            this.children[0].removeAttribute('style');
            mapTitle.parentElement.removeChild(mapTitle);
        }
        wrapMap.onmousemove = function(event) {
            mapTitle.style.display = 'block';
            if(event.offsetY > 10) mapTitle.style.top = event.offsetY + 20 + 'px';
            if(event.offsetX > 10) mapTitle.style.left = event.offsetX + 20 + 'px';
        }
        wrapMap.onmouseleave = function() {
            mapTitle.style.display = 'none';
        }
    </script>
    <style>
        #wrapMap {
            position: relative;
            cursor: help;
            overflow: hidden;
            border-width: 1px;
            border-style: solid;
            border-color: rgb(204, 204, 204);
            border-image: initial;
        }
        .mapTitle {
            position: absolute;
            z-index: 1000;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 0px 5px;
            display: none;
            padding: 5px 20px;
            border-radius: 5px;
            background: rgb(255, 255, 255);
            border-width: 1px;
            border-style: solid;
            border-color: rgb(204, 204, 204);
            border-image: initial;
        }
    </style>
<?/*<div id="map" style="height: 500px; width: 100%; margin: -25px auto 20px;"></div>
<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var uluru = {lat: 55.754744, lng: 37.756529};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
        //
        // Координаты для линии
        var polylineCoords = [
            new google.maps.LatLng(55.75795, 37.75163),
            new google.maps.LatLng(55.7574, 37.75101),
            new google.maps.LatLng(55.7535, 37.75337),
            new google.maps.LatLng(55.75439, 37.75745),
            new google.maps.LatLng(55.75488, 37.757),
            new google.maps.LatLng(55.754744, 37.756529)
        ];

        // Настройки для линии
        var polyline = new google.maps.Polyline({
            path: polylineCoords, // Координаты
            strokeColor: "#8cd50b", // Цвет
            strokeOpacity: 1.0, // Прозрачность
            strokeWeight: 5 // Ширина
        });

        // Добавляем на карту
        polyline.setMap(map);
    }
</script>
<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdeyK7m1aWxx1HEoMUckmVKY6_RmHZud0&callback=initMap">
</script> */?>

<?/*$APPLICATION->IncludeComponent("acs:map", ".default",
    [
        "ITEMS" => [
            [ 'COORDINATES'=>'55.754744,37.756529',
                'title'=>'КОНТАКТЫ',
                'description'=>'Телефоны:	+7 (495) 120-04-02 <br> Адрес:	111123 г. Москва, ул. Плеханова 4а, БЦ "ЮНИКОН", 7этаж'
            ],
        ],
        "CACHE_TYPE"=>"A",
        "CACHE_TIME"=>3600,
        "DIV"=>"mapCamp",
        "PRESET"=>"islands#dotIcon", // style for icon in maps
        "ICON_COLOR"=>"#64be23", // color icon
        "HEIGHT"=>500, //px
        "CLUSTERER"=>'islands#invertedDarkGreenClusterIcons', //
    ],
    false
);*/?>