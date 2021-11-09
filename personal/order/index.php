<? define("SHOW_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
//
global $USER;
if($USER->IsAuthorized()): ?>
	<?/*
	<section class="info-block" style="margin-top: -25px; margin-bottom: 15px; z-index: 9; ">
		<div class="info-block-menu" style="margin-bottom: 0px;">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
						<ul style="margin-left:0px;">
							<li><a href="/personal/">Избранные курсы</a></li>
							<li><a href="/personal/calendar/">Мои курсы</a></li>
                            <li><a href="/personal/subscribe/">Подписка</a></li>
						</ul>
					</div>
					<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="position: relative;">
						<a href="/personal/order/" class="personal-user-orders active" style="right: -25px;">
							Заказы
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	*/?>
<? endif; ?>

<? print '<section class="main"><div class="container">'; ?>
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", ".default", array(
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/personal/order/",
	"ORDERS_PER_PAGE" => "10",
	"PATH_TO_PAYMENT" => "/personal/order/payment/",
	"PATH_TO_BASKET" => "/personal/cart/",
	"SET_TITLE" => "Y",
	"SAVE_IN_SESSION" => "N",
	"NAV_TEMPLATE" => "round",
	"SEF_URL_TEMPLATES" => array(
		"list" => "index.php",
		"detail" => "detail/#ID#/",
		"cancel" => "cancel/#ID#/",
	),
	"SHOW_ACCOUNT_NUMBER" => "Y",
	"ALLOW_INNER" => "N",
	"ONLY_INNER_FULL" => "N",
    "GUEST_MODE"=>"Y",
	),
	false
);?>
<? print '</div></section>'; ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>