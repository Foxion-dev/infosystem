<? define("SHOW_SIDEBAR", true); // глобальный парамер для скрытия включаемых областей и т.д.
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
// $APPLICATION->SetPageProperty("section_class", "nearest-courses"); // класс для section
global $USER;
if(!$USER->IsAuthorized()):
  echo '<section class="main" role="main"><div class="container">'; $APPLICATION->ShowAuthForm(""); echo '</div></section>';
else: ?>
<?/*
<section class="info-block" style="margin-top: -25px; margin-bottom: 0px; z-index: 9; ">
    <div class="info-block-menu" style="margin-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                    <ul style="margin-left: 15px;">
                        <li><a href="/personal/" class="active">Избранные курсы</a></li>
                        <li><a href="/personal/calendar/">Мои курсы</a></li>
                        <li><a href="/personal/subscribe/">Подписка</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="position: relative;">
                    <a href="/personal/order/" class="personal-user-orders">
                        Заказы
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
*/?>
<?  global $USER;
    if($USER->IsAuthorized() && CModule::IncludeModule('iblock') && CModule::IncludeModule('acs')):
    $arrFavor = [];
    $USER_ID = $USER->GetID();
    $rsData = HiWrapper::id(5)->getList(["select"=>["ID","UF_USER","UF_FAVORIT"],"order"=>["UF_FAVORIT"=>"DESC"],"filter"=>["UF_USER"=>$USER_ID]]);
    while($arData = $rsData->Fetch()){
        if(intval($arData['UF_FAVORIT'])>0)
            $arrFavor[] = intval($arData['UF_FAVORIT']);
    }
    if(count($arrFavor)){
        $arrFavor = array_unique($arrFavor);
        //
        $arrEvent = [];
        $rsDataEvent = HiWrapper::id(6)->getList(["select"=>["ID","UF_USER","UF_EVENT"],"order"=>["UF_EVENT"=>"DESC"],"filter"=>["UF_USER"=>$USER_ID]]);
        while($arDataEvent = $rsDataEvent->Fetch()){
            if(intval($arDataEvent['UF_EVENT'])>0)
                $arrEvent[] = intval($arDataEvent['UF_EVENT']);
        }
        $arrEvent = array_unique($arrEvent);
        //
        $APPLICATION->IncludeComponent('acs:acs.courses','favorites',
            ['CACHE_TYPE' => "A",
                'CACHE_TIME' => "3600", // 1 hour - Cache time in seconds.
                'CACHE_GROUPS' => "Y",
                'IBLOCK_TYPE' => "catalog",
                'IBLOCK_ID' => 2,
                'DETAIL_URL' => SITE_DIR."courses/#SECTION_CODE#/#ELEMENT_CODE#/",
                'COUNT' => 20,
                //
                "FILTER_NAME"=>["ID"=>$arrFavor,">=PROPERTY_DATE" => date("Y-m-d H:i:s",time())],
                "UF_CALENDAR"=>$arrEvent,
            ],
            false
        );
    }
    //
    endif;
    ?>

<?if($USER->IsAuthorized() && CModule::IncludeModule('iblock')): ?>
    <? $APPLICATION->IncludeComponent('acs:acs.files','',
            [   'CACHE_TYPE' => "A",
                'CACHE_TIME' => "3600", // 1 hour - Cache time in seconds.
                'CACHE_GROUPS' => "Y",
            ],
            false
        ); ?>
    <? $APPLICATION->IncludeComponent('acs:acs.files.video','',
        [   'CACHE_TYPE' => "A",
            'CACHE_TIME' => "3600", // 1 hour - Cache time in seconds.
            'CACHE_GROUPS' => "Y",
        ],
        false
    ); ?>
    <? /*$APPLICATION->IncludeComponent('acs:acs.files.notice','',
        [   'CACHE_TYPE' => "A",
            'CACHE_TIME' => "3600", // 1 hour - Cache time in seconds.
            'CACHE_GROUPS' => "Y",
        ],
        false
    );*/ ?>
<? endif;?>

<?  $passed = []; $USER_ID = $USER->GetID();
    $arSelect = ["ID", "NAME", "CODE","PROPERTY_USER_ID","PROPERTY_PDF","PROPERTY_COURSE","PREVIEW_PICTURE"];
    $arFilter = ["IBLOCK_ID"=>20, "ACTIVE"=>"Y", "PROPERTY_USER_ID"=>$USER_ID];
    $res = CIBlockElement::GetList(["ID" => "DESC"], $arFilter, false, false, $arSelect);
    while($arFields = $res->GetNext()){
        $passed[] = $arFields;
    }
?>
    <? if(count($passed)): ?>
        <section class="user-certificates">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="user-certificates-list">
                            <div class="row">
                                <div class="col-12"><h5>Сертификаты пройденных курсов</h5></div>
                                <? foreach ($passed as $item): ?>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" style="margin-bottom: 30px;">
                                    <div class="user-certificates-pdf">
                                        <? if($item['PREVIEW_PICTURE']){
                                            $PR = PRM::PR($item['PREVIEW_PICTURE'], $arSize = array("width" => 220, "height" => 320));  ?>
                                            <img src="<?=$PR['SRC']?>">
                                        <? }else{ ?>
                                            <img src="<?=PRM::SRC(220)?>">
                                        <? } ?>
                                        <p><?=$item['NAME']?></p>
                                        <? if($item['PROPERTY_PDF_VALUE']){ ?>
                                            <a target="_blank" href="<?=CFile::GetPath($item['PROPERTY_PDF_VALUE'])?>">Скачать PDF</a>
                                        <? } ?>
                                    </div>
                                </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <? endif; ?>
<? /**/ ?>
<? endif; ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>