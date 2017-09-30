<?php
include("header.php");
?>
  
  <section>


  <div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Change Your Password, <?php echo $ufnm; ?></h4>
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

if($_POST)
{

$oldword = $_POST["oldword"];
$newword = $_POST["newword"];
$newwword = $_POST["newwword"];

$oldmd = MD5($oldword);

$cpass = mysql_fetch_array(mysql_query("SELECT password FROM users WHERE id='".$uid."'"));


///////////////////////-------------------->> CURRENT PASS THIK ACHE TO?
if ($cpass[0]!=$oldmd){
$err1=1;
}

///////////////////////-------------------->> 2 bar ki same?
if ($newword!=$newwword){
$err2=1;
}

///////////////////////-------------------->> Pass ki faka??

 if(trim($newword)=="")
      {
$err3=1;
}

 if(strlen($newword)<=7)
      {
$err4=1;
}

$error = $err1+$err2+$err3+$err4;


if ($error == 0){
$passmd = MD5($newword);
$res = mysql_query("UPDATE users SET password='".$passmd."' WHERE id='".$uid."'");
if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Password Updated Successfully!

</div>";
}else{
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	
Some Problem Occure. Please Try Again Later !

</div>";
}
} else {
	
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Your Current Password Does Not Match.

</div>";
}		
if ($err2 == 1){
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

You Enter Different Password in two field. Please enter same password in both field.

</div>";

}		
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Password Can Not Be Empty!!!

</div>";
echo"<h1></h1>";
}		
if ($err4 == 1){
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Password Must be 8 or more char.

</div>";
}	

	
}



} 
	?>
			
	


















  
<form action="" method="post">
  






                 <input class="form-control input-lg" placeholder="Current Password" name="oldword" type="password" required><br><br>
                 <input class="form-control input-lg" placeholder="New Password" name="newword" type="password" required><br><br>
                 <input class="form-control input-lg" placeholder="New Password Again" name="newwword" type="password" required><br><br>




<button type="submit" class="btn btn-success btn-block">CHANGE</button>

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