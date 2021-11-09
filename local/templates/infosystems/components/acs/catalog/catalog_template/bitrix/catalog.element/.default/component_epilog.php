<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// класс HiWrapper обвертка для HL блоков --> https://github.com/cjp2600/hiwrapper
global $USER, $APPLICATION;
$arJson = [];
if($USER->IsAuthorized() && $arResult['ID'] && CModule::IncludeModule('iblock') && CModule::IncludeModule('acs')){
    $USER_ID = $USER->GetID();
    // идет проверка на избранность если есть в избранном то формируем JS api (класс HiWrapper обвертка для HL блоков)
    if($arData = HiWrapper::id(5)->getList([
        "select" => ["*"],
        "order" => ["ID" => "DESC"],
        "filter" => ["UF_USER"=>$USER_ID,'UF_FAVORIT'=>intval($arResult['ID'])]
    ])->Fetch()){
        $arData['UF_DATE'] = $arData['UF_DATE']->format('d.m.Y H:i');
        // JS api
        $arJson['jq']['addClass']['.favor[data-item="'.$arResult['ID'].'"]'] = 'active';
        $arJson['jq']['attributeName']['.favor[data-item="'.$arResult['ID'].'"]']['title'] = 'Курс добавлен в избранноe';
    }
    // идет проверка на событие в личном календаре если есть в соьытиях то формируем JS api
    if($arDataEvent = HiWrapper::id(6)->getList([
        "select" => ["*"],
        "order" => ["ID" => "DESC"],
        "filter" => ["UF_USER"=>$USER_ID,'UF_EVENT'=>intval($arResult['ID'])]
    ])->Fetch()){
        $arDataEvent['UF_DATE'] = $arDataEvent['UF_DATE']->format('d.m.Y H:i');
        // JS api
        $arJson['jq']['addClass']['.myCalendar[data-item="'.$arResult['ID'].'"]'] = 'active';
        $arJson['jq']['attributeName']['.myCalendar[data-item="'.$arResult['ID'].'"]']['title'] = 'Курс добавлен в календарь';
    }
    //p($arJson,'p');
}
// p($arResult['MANAGER'],'p');
if(count($arJson)){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var res = <?=json_encode($arJson)?>;
            if(res.jq){ JQ(res.jq); }
        });
    </script>
<? }
if(!empty($arResult['MANAGER'])): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('body').on('click','.the-cards-manager img', function (event) {
                event.preventDefault();
                var $img = '<img src="'+$(this).attr('src')+'">';
                var $manager = $(this).parent('.the-cards-manager');
                var $title = 'Менеджер проектов'; /*$manager.find('small').text();*/
                var $position = '<span><?=$arResult['MANAGER']['PROPERTY_POSITION_VALUE']?></span>';
                var $name = $manager.find('span').text();
                var $phones = '<strong>Телефон: <?=$arResult['MANAGER']['PROPERTY_PHONES_VALUE']?></strong>';
                var $mail = '<strong>Эл. почта: <?=$arResult['MANAGER']['PROPERTY_POST_MAIL_VALUE']?></strong>';
                var $textBody = '<div class="cards-manager-modal">'+$img+'<h4>'+$name+'</h4>'+$position+$phones+$mail+'</div>';
                showMessage($textBody,$title,false);
                return false;
            });
        });
    </script>
<? endif;
?>
<script>
$(document).ready(function(){
setTimeout(function(){
	var elemCapt = {};
	$('.g-recaptcha-custom').each(function(){
		$(this).click();

		var idThis = $(this).attr('id'),
			keyThis = $(this).data('sitekey');

		if(keyThis === 'undefined'){
				keyThis = '6Lejf6cUAAAAALsMTJOQmrm2dh64sLu5PVf9ZnAp';
		};
		console.log(keyThis);
		if(keyThis === 'undefined'){
				keyThis = '6Lejf6cUAAAAALsMTJOQmrm2dh64sLu5PVf9ZnAp';
		}
		console.log(idThis);
		var	resultThis = grecaptcha.render(idThis, {
				'sitekey' : keyThis,
				'callback' : function(token) {callbackCapt(token, idThis)}
			});
		elemCapt[idThis] = resultThis;
	})

	$('.opacity-btn').click(function(){

			var idCapt = $(this).attr('id'),
				resultNew = grecaptcha.execute(elemCapt.idCapts);
				keyCapt = $(this).data('sitekey'),
				resultCupt = grecaptcha.getResponse(elemCapt.idCapt);
			if (!resultCupt) {
				$(this).closest('.have-captcha-block').find('.text-danger').addClass('error');
				$(this).closest('.have-captcha-block').find('.text-danger').text('* Вы не прошли проверку "Я не робот"');
			} else {
				$(this).siblings('button[class ^= "b24-web-form-popup-btn-"]').click();
			}
	})
}, 1000);
})
</script>