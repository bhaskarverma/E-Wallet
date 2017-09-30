<?php

require_once('../function.php');
connectdb();
session_start();

if(isset($_POST["amount"])) {
$amount = mysql_real_escape_string($_POST["amount"]);

$utucharge = mysql_fetch_array(mysql_query("SELECT c1, c2 FROM charges WHERE id='2'"));
$percent = $utucharge[1]/100;
$camo = ($amount*$percent)+$utucharge[0];
$ttl = $amount+$camo;
echo "<b>Charge is: $camo USD and $ttl USD Will Debited From Your Account</b>";

} 
?>


