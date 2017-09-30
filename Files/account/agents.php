<?php
include("header.php");
?>
  <section>
    <div class="pagenation-holder">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h3>Add money By <?php echo $gen[0]; ?> Agents</h3>
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
$ddaa = mysql_query("SELECT id, fullname, email, phone FROM agent ORDER BY id");
    echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {    

      ?>

<div class="col-md-4 col-sm-12">

  <div class="widget-holder">
  <h5 class="uppercase"><?php echo $data[1]; ?></h5>
  <div class=" sh-divider-line solid light margin"></div> 
  <br>

  <i class="fa fa-envelope"></i> <b><?php echo $data[2]; ?> </b><br>
  <i class="fa fa-phone"></i> <b><?php echo $data[3]; ?> </b>
  </div>
</div>


<?php 
}
 ?>





    </div>
  </section>
  <!--end item -->

<?php
include("footer.php");
?>
</body>
</html>