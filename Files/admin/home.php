<?php
include ('include/header.php');
?>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">


<?php
include ('include/sidebar.php');
?>

 

		
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Dashboard
                        <small>Statistics</small>
                    </h3>
                    <!-- END PAGE TITLE-->

					<hr>


<?php

$numuser = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users"));
$numuserb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE block='1'"));
$tfuser = mysql_fetch_array(mysql_query("SELECT SUM(mallu) FROM users"));
$generated = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM generated"));


?>





<!-- START -->
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">$<?php echo $tfuser[0]; ?></div>
<div class="desc"> USERS TOTAL FUND </div>
</div>
</div>
</div>
<!-- END -->



<!-- START -->
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number"> $<?php echo $generated[0]; ?></div>
<div class="desc"> ADMIN GENERATED </div>
</div>
</div>
</div>
<!-- END -->
	
				
<!-- START -->
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat purple">
<div class="visual">
<i class="fa fa-users"></i>
</div>
<div class="details">
<div class="number"> <?php echo $numuser[0]; ?></div>
<div class="desc">TOTAL USER </div>
</div>
</div>
</div>
<!-- END -->



<!-- START -->
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat red">
<div class="visual">
<i class="fa fa-times"></i>
</div>
<div class="details">
<div class="number"> <?php echo $numuserb[0]; ?></div>
<div class="desc">BANNED USER </div>
</div>
</div>
</div>
<!-- END -->





	
					
					
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
			


<?php
 include ('include/footer.php');
 ?>


</body>
</html>