<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<section class="info-block">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/lang.png" style="float: left;">
                <div style="margin-left: 80px;">
                    <h5>Авторизованные курсы</h5>
                    <p>В современных рыночных условиях обеспечение экономической безопасности предприятия – одна из наиболее важных задач.
                        Построение эффективной системы экономической безопасности позволяет нивелировать внешние и внутренние угрозы, а также
                        прогнозировать развитие ситуации. Представленная линейка курсов повышения квалификации и т.д.</p>
                    <a class="hide-more" href="javascript:void(0);" onclick="$(this).hide(300); $('#infoBlockHide').show(300);">Подробнее</a>
                    <p id="infoBlockHide" style="display: none">В современных рыночных условиях обеспечение экономической безопасности предприятия – одна из наиболее важных задач.
                        Построение эффективной системы экономической безопасности позволяет нивелировать внешние и внутренние угрозы, а также
                        прогнозировать развитие ситуации. Представленная линейка курсов повышения квалификации и т.д.</p>
                    <button type="button" class="button button--common button--primary" onclick="window.location.replace('/courses/konferentsii/'); return false;">Загрузить полное расписание данного направления</button>
                </div>
            </div>
        </div>
    </div>
</section>