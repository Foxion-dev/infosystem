<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetPageProperty("section_class", "about-contacts");
$APPLICATION->SetPageProperty("particlesBG", "Y"); 
?>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><h3>На метро</h3>
        <p>Станция метро «Шоссе Энтузиастов»<br>
        Из стеклянных дверей направо (в сторону ул. Электродной)<br>
        5 минут пешком вдоль пруда<br>
        На ресепшн получить пропуск в УЦ "Академия Информационных Систем"<br>
        Подняться на 7 этаж<br>
            Из лифта выход в сторону офиса №3 "Академия Информационных Систем"</p>

    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"><h3>На автомобиле</h3>
        <p>
        Из центра по шоссе Энтузиастов<br>
        Съезд направо на ул. Электродную<br>
        Налево на ул. Плеханова<br>
            Проехать до БЦ "Юникон" 200м</p>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <p class="p-gray">
            <strong>Обратите внимание,</strong> что для получения пропуска вам нужно иметь при себе
            документ, удостоверяющий личность (паспорт или водительское удостоверение).
        </p>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <p class="p-gray">
            <strong>Обратите внимание,</strong> что на территории бизнес-центра нет организованной
            парковки. Есть возможность оставить машину на прилегающих улицах
        </p>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" id="feedback">
		<div class="p-white">
			
			<div class="center-btn">
				<script id="bx24_form_button" data-skip-moving="true">
				  (function(w,d,u,b){w['Bitrix24FormObject']=b;w[b] = w[b] || function(){arguments[0].ref=u;
						  (w[b].forms=w[b].forms||[]).push(arguments[0])};
						  if(w[b]['forms']) return;
						  var s=d.createElement('script');s.async=1;s.src=u+'?'+(1*new Date());
						  var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
				  })(window,document,'https://b24ais.ru/bitrix/js/crm/form_loader.js','b24form');

				  b24form({"id":"45","lang":"ru","sec":"w0wazr","type":"button","click":""});
				</script><button class="b24-web-form-popup-btn-45">Обратная связь</button>
			</div>
		</div>
	<?if(false):?>
        <?$APPLICATION->IncludeComponent("acs:acs.feedback","",
            [
                "OK_MESSAGE" => "Спасибо за обращение, обращение принято и будит расмотренно в рабочие время",
                "EMAIL_TO" => "kalabunga82@gmail.com,otolaa@ya.ru,otolaa@mail.ru",
                "EVENT_NAME" => "FEEDBACK_FORM", // letter template for feedback
            ],
            false
        );?>
	<?endif?>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <h3>Реквизиты компании</h3>
        <p>
            АНО ДПО ЦПК “АИС ”<br>
            ОГРН    1167700060527<br>
            ОКПО    45048240<br>
            ИНН     7720346012<br>
            КПП     772001001<br>
            Юридический адрес: 111123, Москва, ул. Плеханова, д.4 А<br>
            Фактический адрес:  111123, Москва, ул. Плеханова, д.4 А<br>
            Банковские реквизиты:<br>
            ПАО «ПРОМСВЯЗЬБАНК» г. Москва<br>
            Р/сч      40703810200000001830<br>
            Кор/сч  30101810400000000555<br>
            БИК      044525555<br>
            Директор – Малинин Юрий Витальевич, действующий на основании Устава
        </p>
    </div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>