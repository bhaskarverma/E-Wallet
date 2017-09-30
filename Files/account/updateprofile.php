<?php
include("header.php");
?>
  
  <section>

<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase">Update your Profile - <?php echo $ufnm; ?></h4>
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

$fnm= $_POST["fnm"];
$lnm= $_POST["lnm"];

$err1 = 0;
$err2 = 0;


 if(trim($fnm)=="")
      {
$err1=1;
}
 if(trim($lnm)=="")
      {
$err2=1;
}

$error = $err1+$err2;


if ($error == 0){
  $res = mysql_query("UPDATE users SET firstname='".$fnm."', lastname='".$lnm."' WHERE id='".$uid."'");
if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Updated Successfully!

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

First Name Can Not Be Empty!!!

</div>";
}		
if ($err2 == 1){
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Last Name Can Not Be Empty!!!

</div>";

}		
	
}



} 

$old = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='".$uid."'"));

?>
			
	


















  
<form action="" method="post">
  






First Name:                 
<input class="form-control input-lg" name="fnm" type="text" value="<?php echo $old['firstname'];?>" required><br><br>
Last Name:                 
<input class="form-control input-lg" name="lnm" type="text" value="<?php echo $old['lastname'];?>" required><br><br>




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