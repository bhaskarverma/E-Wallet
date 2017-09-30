<?php
include("header.php");
?>
  
  <section>

<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Request Money From Another <?php echo $gen[0]; ?> Member</h4>
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


########----------------------------->>>>>>>>>>>>> CONDITIONS




$error = $err1+$err2;


if ($error == 0){

$recdetails = mysql_fetch_array(mysql_query("SELECT id, firstname, mallu FROM users WHERE email='".$sendto."'"));

$res = mysql_query("INSERT INTO reqmoney SET tto='".$recdetails[0]."', frm='".$uid."', amount='".$amount."', tm='".$tm."', msg='".$msg."', status='0'");
echo mysql_error();


if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Request Sent Successfully!

</div>";




echo "<center><h5>$ufnm , Request of $amount USD  Sent Successfully to $recdetails[1]</h5> <br/><br/></center>";



///--------------------------TRX


///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$su = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'"));
$ru = mysql_fetch_array(mysql_query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'"));

$txt = "You Send a Request of $amount USD to $ru[0] $ru[1] ($ru[3]).";
abiremail($su[3], "Request Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = " $su[0] $su[1] ($su[3]) Request a Payment of $amount USD.";
abiremail($ru[3], "Payment Request", $ru[0], $txt);
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
<a href="<?php echo $baseurl; ?>/requestmoney" class="btn btn-success btn-block"> SEND ANOTHER </a>
</div>  

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/dashboard" class="btn btn-primary btn-block"> DASHBOARD </a>
</div>  


</div>


<?php
}else{
 ?>





















  
<form action="" method="post">
  
<input type="text" class="form-control input-lg" id="sendto" name="sendto" placeholder="Email ID for Request">



<br>
<div id="dt"></div>
<div id="dts"></div>

<div id="amountt" style="display:none;">



       <div class="input-group mb15">
         <input class="form-control input-lg" type="text" name="amount" placeholder="Amount">
         <span class="input-group-addon">USD</span>
       </div>
<br>
<textarea class="form-control" rows="5" name="message" placeholder="Your Message (Optional)"></textarea>
<br>




<button type="submit" class="btn btn-success btn-block">SEND REQUEST</button>

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