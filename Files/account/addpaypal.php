<?php
include("header.php");
?>
  
  <section>


<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Add money to Account By PayPal</h4>
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

$pp = mysql_fetch_array(mysql_query("SELECT paypal FROM payment_method WHERE id='1'"));
$sitename = mysql_fetch_array(mysql_query("SELECT sitetitle FROM general_setting WHERE id='1'"));
 ?>


<form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">


    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="<?php echo $pp[0]; ?>" />
    <input type="hidden" name="cbt" value="<?php echo $sitename[0]; ?>" />
    <input type="hidden" name="currency_code" value="USD" />

    <!-- Allow the customer to enter the desired quantity -->
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="item_name" value="Add Fund To Account" />

    <!-- Custom value you want to send and process back in the IPN -->
    <input type="hidden" name="custom" value="<?php echo $uid; ?>" />



<div class="row">




  <div class="col-sm-12">

<div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input class="form-control input-lg" type="text" placeholder="AMOUNT..." name="amount"  id="amount">
                  <span class="input-group-addon">USD</span>
                </div>

<p style="color:red;">* PayPal Charges May Apply</p>


</div>

</div><br>



    <input type="hidden" name="return" value="<?php echo $baseurl; ?>"/>
    <input type="hidden" name="cancel_return" value="<?php echo $baseurl; ?>" />

    <!-- Where to send the PayPal IPN to. -->
    <input type="hidden" name="notify_url" value="<?php echo $baseurl; ?>/ipn-paypal.php" />





<button type="submit" class="btn btn-success btn-block">ADD NOW</button>

</div>
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