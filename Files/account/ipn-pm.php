<?php
require_once('../admin/function.php');
connectdb();
session_start();


$pp = mysql_fetch_array(mysql_query("SELECT pmsec FROM payment_method WHERE id='1'"));


$passphrase=strtoupper(md5($pp[0]));


define('ALTERNATE_PHRASE_HASH',  $passphrase);
define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
$string=
      $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
      $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
      $_POST['PAYMENT_BATCH_NUM'].':'.
      $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
      $_POST['TIMESTAMPGMT'];

$hash=strtoupper(md5($string));
$hash2 = $_POST['V2_HASH'];

if($hash==$hash2){

$payid = $_POST['PAYMENT_ID'];
$paidid =  substr($payid, 10);
$amo = $_POST['PAYMENT_AMOUNT'];
$unit = $_POST['PAYMENT_UNITS'];

if($unit=="USD"){

//////////---------------------------------------->>>> ADD THE BALANCE 

$ct = mysql_fetch_array(mysql_query("SELECT mallu FROM users WHERE id='".$paidid."'"));
$ctn = $ct[0]+$amo;
mysql_query("UPDATE users SET mallu='".$ctn."' WHERE id='".$paidid."'");
//////////---------------------------------------->>>> ADD THE BALANCE

/////////////------------------------->>>>>>>>>>> Add to add_bal Table

mysql_query("INSERT INTO add_bal SET usid='".$paidid."', amount='".$amo."', via='PerfectMoney Automatic', too='".$_POST['PAYEE_ACCOUNT']."', frm='".$_POST['PAYER_ACCOUNT']."', trx='".$V2_HASH."', status='1'");
$tm = time();

mysql_query("INSERT INTO trx SET who='".$paidid."', byy='000222', amount='".$amo."', sig='+', typ='ADD MONEY BY PerfectMoney', charge='0', tm='".$tm."', trxid='".$V2_HASH."', refund='7'");


}
}


$to = "abirkhan75@gmail.com";
$subject = 'PM notify';
$message = "   $string ---- $hash ---- $hash2";
$headers = 'From: ' . "i@abir.biz \r\n" .
    'Reply-To: ' . "i@abir.biz \r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers);
?>


