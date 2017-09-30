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
                    <h3 class="page-title"> SET CHARGES
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

// $atu1 = $_POST["atu1"];
// $atu2 = $_POST["atu2"];
$utu1 = $_POST["utu1"];
$utu2 = $_POST["utu2"];


	
// $res = mysql_query("UPDATE charges SET c1='".$atu1."', c2='".$atu2."' WHERE id='1'");
$res = mysql_query("UPDATE charges SET c1='".$utu1."', c2='".$utu2."' WHERE id='2'");

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


}


// $atu = mysql_fetch_array(mysql_query("SELECT c1, c2 FROM charges WHERE id='1'"));
$utu = mysql_fetch_array(mysql_query("SELECT c1, c2 FROM charges WHERE id='2'"));


?>										
										
										
										
										

                    <!--  
								
                     
                    
                                        
                    <div class="form-group">
                    <label class="col-md-3 control-label"><strong>Agent To User:</strong></label>
                    
                    <div class="col-md-2">
                    <div class="input-group mb15">
                    <input class="form-control input-lg" name="atu1" value="<?php echo $atu[0]; ?>" type="text">
                    <span class="input-group-addon">$</span>
                     </div>
                    </div>
                    
                    <div class="col-md-1"><b class="btn btn-success btn-block">AND</b></div>
                
                    
                    <div class="col-md-2">
                    <div class="input-group mb15">
                    <input class="form-control input-lg" name="atu2" value="<?php echo $atu[1]; ?>"  type="text">
                    <span class="input-group-addon">%</span>
                     </div>
                    </div>  

                    
                    </div> -->
                     
                                
                        
                    
                                        
                    <div class="form-group">
                    <label class="col-md-3 control-label"><strong>Transfer Charge <br>User To User:</strong></label>
                    
                    <div class="col-md-2">
                    <div class="input-group mb15">
                    <input class="form-control input-lg" name="utu1" value="<?php echo $utu[0]; ?>" type="text">
                    <span class="input-group-addon">$</span>
                     </div>
                    </div>
                    
                    <div class="col-md-1"><b class="btn btn-success btn-block">AND</b></div>
                
                    
                    <div class="col-md-2">
                    <div class="input-group mb15">
                    <input class="form-control input-lg" name="utu2" value="<?php echo $utu[1]; ?>"  type="text">
                    <span class="input-group-addon">%</span>
                     </div>
                    </div>  

                    
                    </div>
                     
                                
                     


					 
										
					
                     


					 
										
				
                     
								
                     


					 
										
					
                     
								
                     


					 
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-5">
                                                    <button type="submit" class="btn blue btn-block">Submit</button>
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