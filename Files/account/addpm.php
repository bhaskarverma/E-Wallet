<?php
include("header.php");
?>
  
  <section>
<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Add money to Account By Perfect Money</h4>
</div>
<div class="overlay bg-opacity-5"></div>
<img src="<?php echo $mainpage; ?>/header-img.jpg" alt="" class="img-responsive"> </div>

  </section>
  <!--end section-->


  <div class="clearfix"></div>
  
 <section class="sec-padding">
    <div class="container">
      <div class="row">
      
<div class="col-md-6 col-md-offset-3 col-sm-12">





 <?php 
$tm = time();
$dt = date("YmdH", $tm);
$payid = "$dt$uid";


$pp = mysql_fetch_array(mysql_query("SELECT pmuid FROM payment_method WHERE id='1'"));
$sitename = mysql_fetch_array(mysql_query("SELECT sitetitle FROM general_setting WHERE id='1'"));


?>
<form action="https://perfectmoney.is/api/step1.asp" method="POST">
<input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $pp[0]; ?>">
<input type="hidden" name="PAYEE_NAME" value="<?php echo $sitename[0]; ?>">
<input type='hidden' name='PAYMENT_ID' value='<?php echo $payid; ?>'>

<div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input class="form-control input-lg" type="text" placeholder="AMOUNT..." name="PAYMENT_AMOUNT">
                  <span class="input-group-addon">USD</span>
                </div>



<input type="hidden" name="PAYMENT_UNITS" value="USD">
<input type="hidden" name="STATUS_URL" value="<?php echo $baseurl; ?>/ipn-pm.php">
<input type="hidden" name="PAYMENT_URL" value="<?php echo $baseurl;  ?>">
<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="NOPAYMENT_URL" value="<?php echo $baseurl;  ?>">
<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="SUGGESTED_MEMO" value="">
<input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>




<p style="color:red;">* PerfectMoney Charges May Apply</p>

<input type="submit" name="PAYMENT_METHOD" class="btn btn-success btn-block" value="ADD NOW" class=""><br><br>
</form>
 








</div>


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