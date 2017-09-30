<?php
include("header.php");
?>
  
  <section>


<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Send Money To Another <?php echo $gen[0]; ?> Member</h4>
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

$sendto = mysql_real_escape_string($_POST["sendto"]);
$amount = mysql_real_escape_string($_POST["amount"]);
$msg = mysql_real_escape_string($_POST["message"]);


if( isset($_POST['charge']) ){
$charge = mysql_real_escape_string($_POST["charge"]);
}else{
$charge = 0;
}


$err1=0;
$err2=0;
$err3=0;
$err4=0;


########----------------------------->>>>>>>>>>>>> CONDITIONS


$recexist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='".$sendto."'"));
if($recexist[0]!=1){
$err1 = 1;
}

if($amount<=0){
  $err2 = 1;
}


////--------------------->>>>>>>>>>>>>>> CHARGES
$utucharge = mysql_fetch_array(mysql_query("SELECT c1, c2 FROM charges WHERE id='2'"));
$percent = $utucharge[1]/100;
$camo = ($amount*$percent)+$utucharge[0];

if($charge==0){
$cutbal = $amount;
$addbal = $amount-$camo;
$paycharge = 0;
$reccharge = $camo;
}else{
$cutbal = $amount+$camo;
$addbal = $amount;
$paycharge = $camo;
$reccharge = 0;
}
////--------------------->>>>>>>>>>>>>>> CHARGES

if($cutbal>$mallu){
  $err3 = 1;
}

########----------------------------->>>>>>>>>>>>> CONDITIONS




$error = $err1+$err2+$err3;


if ($error == 0){

$newbal = $mallu-$cutbal;

$res = mysql_query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");


if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Payment Completed Successfully!

</div>";

///--------------------------TRX
$ra4 = rand(1000,9999);
$trx = date("dmyhis", $tm).$ra4;


$recdetails = mysql_fetch_array(mysql_query("SELECT id, firstname, mallu FROM users WHERE email='".$sendto."'"));
$recnewbal = $recdetails[2]+$addbal;


mysql_query("INSERT INTO trx SET who='".$uid."', byy='".$recdetails[0]."', amount='".$amount."', sig='-', typ='Payment Send', charge='".$paycharge."', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");




mysql_query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$recdetails[0]."'");

mysql_query("INSERT INTO trx SET who='".$recdetails[0]."', byy='".$uid."', amount='".$amount."', sig='+', typ='Payment Received', charge='".$reccharge."', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");


echo "<center><h5>$ufnm , You Send $amount USD to $recdetails[1]</h5> <p> Transcetion # $trx</p><br/><br/></center>";



///--------------------------TRX

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$su = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'"));
$ru = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'"));

$txt = "You Send $amount USD to $ru[0] $ru[1] ($ru[3]) . Transcetion # $trx";
abiremail($su[3], "Payment Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = "Payment Received From $su[0] $su[1] ($su[3]). Amount:  $amount USD . Transcetion # $trx";
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

USER NOT FOUND !

</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Please Input A Valid Amount !

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
<a href="<?php echo $baseurl; ?>/sendmoney" class="btn btn-success btn-block"> SEND ANOTHER </a>
</div>  

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/dashboard" class="btn btn-primary btn-block"> DASHBOARD </a>
</div>  


</div>


<?php
}else{
 ?>





















  
<form action="" method="post">
  
<input type="text" class="form-control input-lg" id="sendto" name="sendto" placeholder="Receiver Email ID">



<br>
<div id="dt"></div>
<div id="dts"></div>

<div id="amountt" style="display:none;">



       <div class="input-group mb15">
         <input class="form-control input-lg" type="text" name="amount" id="am" placeholder="Amount">
         <span class="input-group-addon">USD</span>
       </div>
<br>
<textarea class="form-control" rows="5" name="message" placeholder="Your Message (Optional)"></textarea>
<br>




  <input type="hidden" name="charge" id="charge"> 
  <div id="cclick" style="display: none;">
  <i class="fa fa-times" style="color: red; padding: 3px; border: 1px solid #333; cursor: pointer; border-radius: 5px;"></i>
   <b>I will pay the charges</b>
  </div>

 <div id="cclick2">
 <i class="fa fa-check" style="color: green; padding: 3px; border: 1px solid #333; cursor: pointer; border-radius: 5px;"></i>
 <b>I will pay the charges</b>
 </div>
<div id="cp" style="color: red;"></div>
<br><br>

<button type="submit" class="btn btn-success btn-block">SEND</button>

</div>
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