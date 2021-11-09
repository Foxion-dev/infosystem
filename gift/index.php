<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подарки за бонусы");
$APPLICATION->SetPageProperty("particlesBG", "Y");
?>

<?$APPLICATION->IncludeComponent('acs:acs.gift','.default',
    ['CACHE_TYPE' => "A",
        'CACHE_TIME' => "3600", // 1 hour - Cache time in seconds.
        'CACHE_GROUPS' => "Y",
        'IBLOCK_TYPE' => "catalog",
        'IBLOCK_ID' => 24,
        'DETAIL_URL' => SITE_DIR."gift/#ELEMENT_ID#/",
        'COUNT' => 10,
        //
        // "FILTER_NAME"=>["!PROPERTY_SPECIALOFFER"=>false,">=PROPERTY_DATE" => date("Y-m-d H:i:s",time())],
    ],
    false
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>