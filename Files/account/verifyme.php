<?php
include("header.php");
?>
  
  <section>
    <div class="pagenation-holder">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h3>Withdraw Money - Bank</h3>
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

      <?php 
if(!you_valid($uid)){
echo "<h1>Account Already Verified </h1>";
}else{
 ?>


<div class="col-md-6 col-md-offset-3 col-sm-12">





<?php 

if($_POST){


$typ = mysql_real_escape_string($_POST["typ"]);
$msg = mysql_real_escape_string($_POST["message"]);


// IMAGE UPLOAD //////////////////////////////////////////////////////////
 $folder = "memberdocs/";
 $extention = strrchr($_FILES['nidb']['name'], ".");
$dt = date("YmdHis", $tm);
$random = rand(1000,9999);
$fnm = $_FILES['nidb']['name'];
   
    $string = strtolower($fnm);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", "", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "_", $string);
    $ok = substr("$string", 0, -3);

$fnl = "$dt$random$ok"."ABIR";

    $new_name = $fnl;
    $nidb = $new_name.'.jpg';
    $uploaddir = $folder . $nidb;
    move_uploaded_file($_FILES['nidb']['tmp_name'], $uploaddir);


    //--------------------------------------------------------



    $folder = "memberdocs/";
    $extention = strrchr($_FILES['nidf']['name'], ".");
  
$dt = date("YmdHis", $tm);
$random = rand(1000,9999);
$fnm = $_FILES['nidf']['name'];
    
    $string = strtolower($fnm);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", "", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "_", $string);
    $ok = substr("$string", 0, -3);
    
$fnl = "$dt$random$ok"."ABIR";

    $new_name = $fnl;
    $nidf = $new_name.'.jpg';
    $uploaddir = $folder . $nidf;
    move_uploaded_file($_FILES['nidf']['tmp_name'], $uploaddir);

//////////////////////////////////////////////////////////////////////

$error = 0;


if ($error == 0){

$res = mysql_query("INSERT INTO verify_docs SET usid='".$uid."', typ='".$typ."', d1='".$nidf."', d2='".$nidb."', msg='".$msg."'");


if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Document Submitted Successfully!
</div>";

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


<div class="col-md-12 col-sm-12">
<a href="<?php echo $baseurl; ?>/dashboard" class="btn btn-primary btn-block"> DASHBOARD </a>
</div>  


</div>


<?php
}else{
 ?>





















  
<form action="" method="post" enctype="multipart/form-data">
  



<select name="typ" class="form-control input-lg">
<option value="Pasport">Pasport</option>
<option value="National_ID">National ID</option>
</select>

<br><br>
        <input name="nidf" type="file" id="txt" /><br>
        <input name="nidb" type="file" id="txt" /><br>



<br>
<textarea class="form-control" rows="5" name="message" placeholder="Your Message (Optional)"></textarea>
<br>






<button type="submit" class="btn btn-success btn-block">SEND</button>

</form>

<?php 
}
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