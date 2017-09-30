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
                    <h3 class="page-title"> Registration Control
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

					<hr>

					
					
					
					
					
			<div class="row">
			<div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="" method="post" role="form">
                                        <div class="form-body">

		   
<?php
if($_POST)
{

$reg = mysql_real_escape_string($_POST["reg"]);


$err1=0;
$err2=0;
$err3=0;




$error = $err1+$err2+$err3;


if ($error == 0){
$res = mysql_query("UPDATE general_setting SET reg='".$reg."' WHERE id='1'");
echo mysql_error();
if($res){
	
	
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

UPDATED Successfully! 

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

Website Title Can Not be Empty!!!

</div>";
}		
	




}




}

$old = mysql_fetch_array(mysql_query("SELECT reg FROM general_setting WHERE id='1'"));

if($old[0]==0){
	$st = "ON";
}else{
	$st = "OFF";	
}


?>										
										
										
										
										
										
										
					<div class="form-group">
                    <label class="col-md-3 control-label"><strong>New Registration</strong></label>
                    <div class="col-md-4">

                    <select name="reg" class="form-control input-lg">
                    	<option value="0">ON</option>
                    	<option value="1">OFF</option>
                    </select>
                    </div>
                    <div class="col-md-5">
                    <strong> Current Status: <b class="btn btn-info "> <?php echo $st; ?></b></strong>
                    </div>
                    </div>
                     


					 
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-4">
                                                    <button type="submit" class="btn blue btn-block">UPDATE</button>
                                                </div>
                                            </div>
											
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>		
                        </div><!---ROW-->		
					
					
					
					
					
					
			
					
					
					
					
					
					
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
			


<?php
 include ('include/footer.php');
 ?>


</body>
</html>