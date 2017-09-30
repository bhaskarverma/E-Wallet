<?php
require_once('../admin/function.php');
connectdb();
session_start();


$pp = mysql_fetch_array(mysql_query("SELECT paypal FROM payment_method WHERE id='1'"));



//Getting records from Paypal IPN
	$payment_type		=	$_POST['payment_type'];
	$payment_date		=	$_POST['payment_date'];
	$payment_status		=	$_POST['payment_status'];
	$address_status		=	$_POST['address_status'];
	$payer_status		=	$_POST['payer_status'];
	$first_name			=	$_POST['first_name'];
	$last_name			=	$_POST['last_name'];
	$payer_email		=	$_POST['payer_email'];
	$payer_id			=	$_POST['payer_id'];
	$address_country	=	$_POST['address_country'];
	$address_country_code	=	$_POST['address_country_code'];
	$address_zip		=	$_POST['address_zip'];
	$address_state		=	$_POST['address_state'];
	$address_city		=	$_POST['address_city'];
	$address_street		=	$_POST['address_street'];
	$business			=	$_POST['business'];
	$receiver_email		=	$_POST['receiver_email'];
	$receiver_id		=	$_POST['receiver_id'];
	$residence_country	=	$_POST['residence_country'];
	$item_name			=	$_POST['item_name'];
	$item_number		=	$_POST['item_number'];
	$quantity			=	$_POST['quantity'];
	$shipping			=	$_POST['shipping'];
	$tax				=	$_POST['tax'];
	$mc_currency		=	$_POST['mc_currency'];
	$mc_fee				=	$_POST['mc_fee'];
	$mc_gross			=	$_POST['mc_gross'];
	$mc_gross_1			=	$_POST['mc_gross_1'];
	$txn_id				=	$_POST['txn_id'];
	$notify_version		=	$_POST['notify_version'];
	$custom				=	$_POST['custom'];

$ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);

if (preg_match('~^(?:.+[.])?paypal[.]com$~', gethostbyaddr($_SERVER['REMOTE_ADDR'])) > 0)

{
$uuuu = "PayPal - $ip";
}else{
$uuuu = "not Paypal - $ip";

}


if($payment_status=="Completed" && $receiver_email=="$pp[0]" && $mc_currency=="USD" && $ip=="notify.paypal.com"){

$amount_gain = $mc_gross-$mc_fee;	


//////////---------------------------------------->>>> ADD THE BALANCE 

$ct = mysql_fetch_array(mysql_query("SELECT mallu FROM users WHERE id='".$custom."'"));
$ctn = $ct[0]+$amount_gain;

mysql_query("UPDATE users SET mallu='".$ctn."' WHERE id='".$custom."'");

//////////---------------------------------------->>>> ADD THE BALANCE

/////////////------------------------->>>>>>>>>>> Add to add_bal Table

mysql_query("INSERT INTO add_bal SET usid='".$custom."', amount='".$amount_gain."', via='PayPal Automatic', too='".$receiver_email."', frm='".$payer_email."', trx='".$txn_id."', status='1'");
$tm = time();

mysql_query("INSERT INTO trx SET who='".$custom."', byy='000111', amount='".$mc_gross."', sig='+', typ='ADD MONEY BY PAYPAL', charge='".$mc_fee."', tm='".$tm."', trxid='".$txn_id."', refund='8'");


}





//Payment Confirmation Email

$headers = "From: i@abir.biz \r\n";
$headers .= "Reply-To: i@abir.biz \r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$to = "abirkhan75@gmail.com";
$mail_subject = "Notification Paypal";






$msg = "

<b>Payment Summary</b>					<br />
Order No: $custom 						<br />
Payment Made by: $first_name $last_name <br />
Payer Email: $payer_email 				<br />
Payer Country: $address_country 		<br />
Payment Status: $payment_status			<br />
Amount: $mc_gross 						<br />
Fees: $mc_fee 							<br />
<br /><br />


<b>Payment information</b>	<br />
	Payment Type: $payment_type			<br />
	payment_date: $payment_date			<br />
	payment_status: $payment_status		<br />

<b>Buyer information</b>				<br />
	address_status: $address_status		<br />
	payer_status: $payer_status			<br />
	first_name: $first_name				<br />
	last_name: $last_name				<br />
	payer_email: $payer_email			<br />
	payer_id: $payer_id					<br />
	address_country: $address_country	<br />
	address_country_code: $address_country_code	<br />
	address_zip: $address_zip			<br />
	address_state: $address_state		<br />
	address_city: $address_city			<br />
	address_street: $address_street		<br />

<b>Basic information</b>				<br />
	Business: $business					<br />
	Receiver_email: $receiver_email		<br />
	Receiver_id: $receiver_id			<br />
	Residence_country: $residence_country	<br />
	Item_name: $item_name				<br />
	Item_number: $item_number			<br />
	Quantity: $quantity					<br />
	Shipping: $shipping					<br />
	Tax: $tax							<br />

<b>Currency and currrency exchange</b>	<br />
	mc_currency: $mc_currency			<br />
	Fees: mc_fee:   $mc_fee				<br />
	Amount: mc_gross: $mc_gross			<br />
	mc_gross_1: $mc_gross_1				<br />

<b>Transaction fields</b>				<br />
	Txn_type: $txn_type					<br />
	Txn_id: $txn_id						<br />
	Notify Version: $notify_version		<br />

<b>Advanced and custom information</b>	<br />
	U No: $custom			--- $uuuu		<br />


					"; // end of mail_body



	







$message = '<html><body>';
$message .= ''."$msg";
$message .= '</body></html>';


$sent=mail($to,$mail_subject, $message, $headers);



?>


