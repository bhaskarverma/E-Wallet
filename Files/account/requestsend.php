<?php
include("header.php");
?>

  <div class="clearfix"></div>
  
 <section class="sec-padding">
    <div class="container">
      <div class="row">
 
<div class="col-md-4 col-sm-12">
  

  <div class="widget-holder">
  <h5 class="uppercase">Your Current Balance</h5>
  <div class=" sh-divider-line solid light margin"></div> 
  <br>
  <h3 class="uppercase"> <?php echo $mallu; ?> USD</h3>
  </div>


</div>
<div class="col-md-8 col-sm-12">


<?php 
$iidd = $_GET['id'];

$details = mysql_fetch_array(mysql_query("SELECT tto, frm, amount, tm, msg, status FROM reqmoney WHERE id='".$iidd."'"));

if($details[0]!=$uid){
echo "<div class=\"error-box alert\"> <span><i class=\"fa fa-exclamation-triangle\"></i> &nbsp; &nbsp;Error – You Don't Have Permission For This Action..</span></div>";
}else{
$amo = $details[2];

if($_POST){
$msg = mysql_real_escape_string($_POST["message"]);
  $err1 = 0;
  $err2 = 0;


if($amo>$mallu){
  $err1 = 1;
}

if($details[5]!=0){
  $err2 = 1;
}

$error = $err1+$err2;

if ($error == 0){
$newbal = $mallu-$amo;
$res = mysql_query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");
if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Payment Sent Successfully!

</div>";

mysql_query("UPDATE reqmoney SET status='1' WHERE id='".$iidd."'");
///--------------------------TRX
$ra4 = rand(1000,9999);
$trx = date("dmyhis", $tm).$ra4;


$recdetails = mysql_fetch_array(mysql_query("SELECT id, firstname, mallu FROM users WHERE id='".$details[1]."'"));


////--------------------->>>>>>>>>>>>>>> CHARGES
$utucharge = mysql_fetch_array(mysql_query("SELECT c1, c2 FROM charges WHERE id='2'"));
$percent = $utucharge[1]/100;
$camo = ($amo*$percent)+$utucharge[0];
$willadd = $amo-$camo;
$recnewbal = $recdetails[2]+$willadd;


mysql_query("INSERT INTO trx SET who='".$uid."', byy='".$recdetails[0]."', amount='".$amo."', sig='-', typ='Send Payment on Request', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");




mysql_query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$recdetails[0]."'");

mysql_query("INSERT INTO trx SET who='".$recdetails[0]."', byy='".$uid."', amount='".$amo."', sig='+', typ='Received Payment on Request', charge='".$camo."', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");



echo "<center><h5>$ufnm , You Sent $amo USD to $recdetails[1]</h5> <p> Transcetion # $trx</p><br/><br/></center>";


///--------------------------TRX

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$su = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'"));
$ru = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'"));

$txt = "You Send $amo USD to $ru[0] $ru[1] ($ru[3]) . Transcetion # $trx";
abiremail($su[3], "Payment Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = "Payment Received From $su[0] $su[1] ($su[3]). Amount:  $amo USD . Transcetion # $trx";
abiremail($ru[3], "Payment Received", $ru[0], $txt);
abirsms($ru[2], $txt);

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS



}else{
  echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Some Problem Occurs, Please Try Again. 

</div>";
}

} else {
  
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

You Don't Have Enough Money in Your Account!

</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
You Already Take Action of This Request Once!
</div>";
}   
}

?>



<div class="row">

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/requesttome" class="btn btn-success btn-block"> PENDING REQUEST </a>
</div>  

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/dashboard" class="btn btn-primary btn-block"> DASHBOARD </a>
</div>  


</div>

<?php

}else{









$reuser = mysql_fetch_array(mysql_query("SELECT firstname, lastname, email FROM users WHERE id='".$details[1]."'"));
echo "<h1> You Are Going to Send $amo USD to $reuser[0] $reuser[1] ($reuser[2]) </h1>";
?>

<form action="" method="post">
<input type="hidden" name="refund" value="true">

<textarea class="form-control" rows="5" name="message" placeholder="Your Message (Optional)"></textarea><br><br>
<div class="row">
<div class="col-md-6 col-sm-12">
<button type="submit" class="btn btn-success btn-block">PAY NOW</button>
</div>	
<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>" class="btn btn-primary btn-block">CANCEL</a>
</div>	
</div>
</form>


<?php
}
}


 ?>




















	  <div style="min-height: 800px;"></div>
	  
      </div>
    </div>
  </section>
  <!--end item -->

<?php
include("footer.php");
?>
</body>
</html>