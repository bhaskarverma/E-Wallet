<?php
include("header.php");
?>

  <div class="clearfix"></div>
  
 <section class="sec-padding">
    <div class="container">
      <div class="row">
 
<div class="col-md-4 col-sm-12">
  
<?php
include("left.php");
?>


</div>
<div class="col-md-8 col-sm-12">


<?php 
$iidd = $_GET['id'];


$details = mysql_fetch_array(mysql_query("SELECT tto, frm, amount, tm, msg, status FROM reqmoney WHERE id='".$iidd."'"));

if($details[0]!=$uid){
echo "<div class=\"error-box alert\"> <span><i class=\"fa fa-exclamation-triangle\"></i> &nbsp; &nbsp;Error – You Don't Have Permission For This Action..</span></div>";
}else{
if($details[5]!=0){
echo "<div class=\"error-box alert\"> <span><i class=\"fa fa-exclamation-triangle\"></i> &nbsp; &nbsp;Error – You Already Take a Action..</span></div>";
}else{

$res = mysql_query("UPDATE reqmoney SET status='2' WHERE id='".$iidd."'");

if($res){
echo "<div class=\"success-box alert\"> <span><i class=\"fa fa-check\"></i> &nbsp; &nbsp; Success – Request Rejected Successfully.</span></div>";
}else{
echo "<div class=\"error-box alert\"> <span><i class=\"fa fa-exclamation-triangle\"></i> &nbsp; &nbsp;Error – Some Problem Occurs, Please Try Again.</span></div>";
}


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