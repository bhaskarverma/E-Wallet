<?php
include("header.php");
?>
  
  <section>

<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Withdraw Money - PayPal</h4>
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

if($_POST){



$amount = mysql_real_escape_string($_POST["amount"]);
$goesto = mysql_real_escape_string($_POST["goesto"]);
$msg = mysql_real_escape_string($_POST["message"]);



$details="Paypal Email: $goesto";

$err1=0;
$err2=0;
$err3=0;
$err4=0;


########----------------------------->>>>>>>>>>>>> CONDITIONS


if($amount<100){
  $err1 = 1;
}


if($amount>$mallu){
  $err3 = 1;
}

########----------------------------->>>>>>>>>>>>> CONDITIONS




$error = $err1+$err2+$err3;


if ($error == 0){

$newbal = $mallu-$amount;

$res = mysql_query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");


if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Withdraw Request Sent Successfully!
</div>";

///--------------------------TRX
$ra4 = rand(1000,9999);
$trx = date("dmyhis", $tm).$ra4;



mysql_query("INSERT INTO trx SET who='".$uid."', byy='000wd', amount='".$amount."', sig='-', typ='Withdraw By PayPal', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");

mysql_query("INSERT INTO wd SET method='PayPal', usr='".$uid."', amount='".$amount."', tm='".$tm."', details='".$details."', msg='".$msg."'");


//echo "<center><h5>$ufnm , You Send $amount USD to $recdetails[1]</h5> <p> Transcetion # $trx</p><br/><br/></center>";



///--------------------------TRX

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$su = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'"));

$txt = "You Just Submit a Withdraw Request. Amount: $amount USD. Method: PayPal";
abiremail($su[3], "Withdraw Request Submitted", $su[0], $txt);
abirsms($su[2], $txt);

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

Minimum Withdraw Amount is 100 USD

</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Please Select a Country!

</div>";
}   
  
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

You Don't Have Enough Money in Your Account!

</div>";
}   





}

?>


<div class="row">

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/withrawmoney" class="btn btn-success btn-block"> WITHDRAW ANOTHER </a>
</div>  

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/dashboard" class="btn btn-primary btn-block"> DASHBOARD </a>
</div>  


</div>


<?php
}else{
 ?>





















  
<form action="" method="post">
  





       <div class="input-group mb15">
         <input class="form-control input-lg" type="text" name="amount" id="am" placeholder="Amount">
         <span class="input-group-addon">USD</span>
       </div>

<br>




<br><input type="text" class="form-control input-lg"  name="goesto" placeholder="PayPal Email" required>


<br>
<textarea class="form-control" rows="5" name="message" placeholder="Your Message (Optional)"></textarea>
<br>






<button type="submit" class="btn btn-success btn-block">SEND</button>

</form>

<?php 
}
 ?>

</div>


	  <div style="min-height: 800px;"></div>
	  
      </div>
    </div>
  </section>
  <!--end item -->














<?php
include("footer.php");
?>



<script>




jQuery(document).ready(function(){


 $("#cclick").click(function(){

 $("#cp").show();


       $("#charge").val("1");

        $("#cclick").hide();
        $("#cclick2").show();

       });
 


$("#cclick2").click(function(){

 $("#cp").hide();
       $("#charge").val("0");

        $("#cclick2").hide();
         $("#cclick").show();

       });


$("#cclick").click(function(){

var amm = $("#am").val();

    $.post( 
                  "jsapi-charge.php",
                  { 
                     amount : amm
          },
                  function(data) {
           $("#cp").html(data);
          }
    );

});


$("#am").on('input',function(){

var amm = $("#am").val();

    $.post( 
                  "jsapi-charge.php",
                  { 
                     amount : amm
          },
                  function(data) {
           $("#cp").html(data);
          }
    );

});


     $("#dt").click(function(){
       $("#sendto").fadeOut("500");
        $("#dt").fadeOut("1000",function() {
        $("#amountt").fadeIn("1000");
       });
    });


$('#sendto').on('input', function() {
var dt = $("#sendto").val();
        $.post( 
                  "jsapi-sendto.php",
                  { 
                     dt : dt
          },
                  function(data) {
 var result = $.trim(data);
if(result==="data"){
 $("#dt").hide();
  $("#dts").show();
 $("#dts").html("NO USER FOUND WITH THIS EMAIL");
} else {
  $("#dt").show();
           $("#dts").hide();
      $("#dt").html(data);
}



                             }
               );


});

  
});
</script>


</body>
</html>