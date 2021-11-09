<?
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видеогалерея");
$APPLICATION->SetPageProperty("shareYandex", "");
$APPLICATION->SetPageProperty("particlesBG", "Y");


?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
