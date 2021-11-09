<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расписание");
/** @var MainTemplate $template */
$template = InfoSystems\App\MainTemplate::getInstance();
?>
<link rel="stylesheet" href="/personal/schedule/assets/css/main.min.css">
<?php
$APPLICATION->IncludeComponent(
    'first-top:schedule',
    '.default',
    [
        'SEF_FOLDER' => '/personal/schedule/',
        'SEF_MODE' => 'Y',
        'SEF_URL_TEMPLATES' => [
            'index' => 'index.php',
            'detail' => '#ELEMENT_ID#/',
        ],
    ],
    null,
    [
        'HIDE_ICONS' => 'Y',
    ]
);
?>
<script src="/personal/schedule/assets/js/main.min.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
