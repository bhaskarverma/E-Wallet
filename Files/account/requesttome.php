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



</div><div class="col-md-8 col-sm-12">


<?php 


if($reqmo[0]==0){

echo "<div class=\"success-box alert\"> <span><i class=\"fa fa-check\"></i> &nbsp; &nbsp; NO Pending Request Exist Now</span></div>";
}



$ddaa = mysql_query("SELECT id, frm, amount, msg FROM reqmoney WHERE tto='".$uid."' AND status='0' ORDER BY id DESC");
    echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {     

$byy = mysql_fetch_array(mysql_query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'"));
?>

<div class="panel panel-primary">

<div class="panel-heading">Request Of <?php echo $data[2]; ?> USD</div>
            <div class="panel-body">
<b>Request From:</b> <?php echo "$byy[0] $byy[1] ($byy[2])"; ?> <br><br>
<b>Message:</b> <?php echo $data[3]; ?> <br><br>

           </div><!-- panel-body -->
            <div class="panel-footer">

            <div class="row">
            <div class="col-md-6"><a href="<?php echo $baseurl; ?>/requestsend/<?php echo $data[0]; ?>" class="btn btn-success btn-block">PAY NOW</a></div>
            <div class="col-md-6"><a href="<?php echo $baseurl; ?>/requestreject/<?php echo $data[0]; ?>" class="btn btn-danger btn-block">REJECT</a></div>

</div>
           </div><!-- panel-footer -->
          </div>

<?php 
}
 ?>















	  <div style="min-height: 100px;"></div>
	  
      </div>
    </div>
  </section>
  <!--end item -->

<?php
include("footer.php");
?>
</body>
</html>