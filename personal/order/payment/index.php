<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Оплата заказа");
use \Bitrix\Sale;

if($_GET['autoPay'] == 'Y'){
	CModule::IncludeModule("sale");
	$ORDER_ID=intval($_GET["ORDER_ID"]);
	
	$orderObj  = Sale\Order::load( $ORDER_ID );
	$paymentCollection  =  $orderObj ->getPaymentCollection();
	$payment  =  $paymentCollection [0];
	$service  = Sale\PaySystem\Manager::getObjectById( $payment ->getPaymentSystemId());
	$context  = \Bitrix\Main\Application::getInstance()->getContext();
	$service ->initiatePay( $payment ,  $context ->getRequest()); 
	 
	$initResult = $service->initiatePay($payment, $context->getRequest(), \Bitrix\Sale\PaySystem\BaseServiceHandler::STRING);
	$buffered_output = $initResult->getTemplate();
	?>
	<script type="text/javascript"> document.getElementsByTagName('a')[0].click(); </script> 
	<?
}else{

	$APPLICATION->IncludeComponent(
		"bitrix:sale.order.payment",
		"",
		Array(
		)
	);
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>