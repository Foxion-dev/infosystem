<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Библиотека");

?>
<style>
    .catalog-section-list li {
        margin-bottom: 20px;
        position: relative;
        padding-left: 30px;
        font-size: 14px;
        font-family: 'OpenSans-Bold', Arial, Tahoma, Sans-Serif;
    }
    .catalog-section-list li i {
        position: absolute;
        left: 0px;
        top: 1px;
    }
</style>
<? include(dirname(__FILE__) . "/.left.menu.php");
//p($aMenuLinks,'p');
if(!empty($aMenuLinks)):
    ?><ul class="catalog-section-list have-margin-top"><?
    foreach ($aMenuLinks as $mn):
        ?><li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="<?=$mn[1]?>"><?=$mn[0]?></a></li><?
    endforeach;
    ?></ul><?
endif;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>