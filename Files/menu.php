<?php 
include('header.php');
$iidd = mysql_real_escape_string($_GET['id']);
$hometxt = mysql_fetch_array(mysql_query("SELECT name, btext FROM menus WHERE id='".$iidd."'"));

?>
  
  <div class="clearfix"></div>

<section class="sec-padding">
<div class="container">
<div class="row slide-controls-color-13">
<div class="col-md-12">


<h2 class="section-title text-center"><?php echo $hometxt[0]; ?></h2>
<?php echo $hometxt[1]; ?>


</div>
</div>
</div>
</section>
<!-- end section -->






<div class="clearfix"></div> 






<?php 
include('footer.php');
?>
 