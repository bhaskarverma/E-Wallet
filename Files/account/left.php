



<div class="clearfix"></div>





 <div class="widget-holder">
  <h5 class="uppercase">Your Current Balance</h5>
  <div class=" sh-divider-line solid light margin"></div> 
  <br>
  <h3 class="uppercase" style="font-weight: bold;"> <?php echo $mallu; ?> USD</h3>
  </div>

<div class="clearfix"></div>

<?php

$reqmo = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM reqmoney WHERE tto='".$uid."' AND status='0'"));

if($reqmo[0]>=1){

?>


<a href="<?php echo $baseurl; ?>/requesttome">
<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">You Have <?php echo $reqmo[0]; ?> Pending Request</h3>
            </div>
          </div>
</a>
<?php 
}
?>


<div class="clearfix"></div>


 <div class="widget-holder hidden-xs hidden-sm">

          <ul class="category-links orange-2" style="font-weight: bold;">

<li class=""> <a href="<?php echo $baseurl; ?>/activity"> Activity</a></li>
<li class=""> <a href="<?php echo $baseurl; ?>/sendmoney"> Send Money</a></li>
<li class=""> <a href="<?php echo $baseurl; ?>/requestmoney"> Request Money</a></li>
<li class=""> <a href="<?php echo $baseurl; ?>/addmoney"> Add Money</a></li>
<li class=""> <a href="<?php echo $baseurl; ?>/withrawmoney"> Withdraw Money</a></li>



          </ul>


  </div>





