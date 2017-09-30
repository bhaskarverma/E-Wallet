<?php
include("header-vm.php");
?>
  
  <section>
    <div class="pagenation-holder">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h3>Account Verification - Mobile Verification</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--end section-->


  <div class="clearfix"></div>
  
 <section class="sec-padding">
    <div class="container">
      <div class="row">




<div class="col-md-12 col-sm-12">





<?php 

if(isset($_POST['verify'])){

$code = mysql_real_escape_string($_POST["code"]);
$original = mysql_fetch_array(mysql_query("SELECT mvcode FROM users WHERE id='".$uid."'"));

if($code==$original[0]){

echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Phone Number Verified Successfully!!!
</div>";

$res = mysql_query("UPDATE users SET mv='1' WHERE id='".$uid."'");

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


$deta = mysql_fetch_array(mysql_query("SELECT mobile, email, firstname FROM users WHERE id='".$uid."'"));

$txt = "Your Mobile Number Verified Successfully.";
abiremail($deta[1], "Mobile Number Verified Successfully", $deta[2], $txt);
abirsms($deta[0], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS



}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
WRONG CODE !!!
</div>";
}


}


if(isset($_POST['again'])){

$num = mysql_real_escape_string($_POST["num"]);
$exist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE mobile='".$num."' AND id<>$uid"));

if($exist[0]>="1"){

echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Mobile Number Already Exist in our Database... Please Use another Mobile Number!!
</div>";

}else{



$mvcode = rand(100000,999999);
$res = mysql_query("UPDATE users SET mvcode='".$mvcode."', mobile='".$num."' WHERE id='".$uid."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
CODE Sent Successfully To $num !
</div>";
///////////////////////////////////---------------------------->>>>>>>>>>>SMS
$gen = mysql_fetch_array(mysql_query("SELECT sitetitle FROM general_setting WHERE id='1'"));
$txt = "Your $gen[0] Mobile Number Verification Code is $mvcode.";
abirsms($num, $txt);
///////////////////////////////////---------------------------->>>>>>>>>>>SMS
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Some Problem Occurs, Please Try Again. 
</div>";
}

}


}

?>
















<div class="row">


<div class="col-md-6 col-sm-12">
  
<form action="" method="post">
<?php
$num = mysql_fetch_array(mysql_query("SELECT mobile FROM users WHERE id='".$uid."'"));
echo "A Verification Code Send To <b> $num[0]</b>. Input The Code To Verify Your Account";
?> 

<br><br><input type="text" class="form-control input-lg"  name="code" placeholder="CODE" required><br>

<input type="hidden" name="verify" value="1">

<button type="submit" class="btn btn-success btn-block">VERIFY</button><br>
</form>
</div>








<div class="col-md-6 col-sm-12">
  
<form action="" method="post">
<?php
$num = mysql_fetch_array(mysql_query("SELECT mobile FROM users WHERE id='".$uid."'"));
echo "Don't Have a Code? Request Code Again";
?> 

<input type="hidden" name="again" value="1">
<br><br><input type="text" class="form-control input-lg"  name="num" value="<?php echo $num[0]; ?>" placeholder="Mobile Number With Country Code" required><br>
<button type="submit" class="btn btn-primary btn-block">SEND CODE TO ABOVE NUMBER</button><br>
</form>
</div>



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