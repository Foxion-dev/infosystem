<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо за заявку");
define("HIDE_SIDEBAR", true);
?>
    <section class="main" role="main">
        <div class="container">
            <div class="thank-container">
                <h2>Спасибо за заявку!</h2>
                <p>В ближайшее время с вами свяжется менеджер.</p>
            </div>
        </div>
    </section>
<style>
    .screen-menu {
        background: none;
    }
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
