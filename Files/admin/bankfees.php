<?php
include ('include/header.php');
?>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
		
		
		
		</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        
		
	
<?php
include ('include/sidebar.php');
?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Manage Bank Fees<small></small></h3>
					<hr>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    
<?php





if($_POST) {
$country = mysql_real_escape_string($_POST["country"]);
$fees = mysql_real_escape_string($_POST["fees"]);

$res = mysql_query("INSERT INTO bank_fees SET country='".$country."', fee='".$fees."'");
if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Added Successfully! 
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Some Problem Occurs, Please Try Again. 
</div>";
}
}



           
//------------------------------------------->>> DELETE             

if(isset($_GET['did'])) {
$did = $_GET["did"];
$exist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bank_fees WHERE id='".$did."'"));
if($exist[0]>=1){
    
$res = mysql_query("DELETE FROM bank_fees WHERE id='".$did."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
DELETED Successfully! 
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Some Problem Occurs, Please Try Again. 
</div>";
}
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
NOT FOUND IN DATABASE (MAY ALREADY DELETED)
</div>";
}   
}
//------------------------------------------->>> DELETE         




if(isset($_GET['fees'])) {
$id = $_GET['id']; 
$fees = $_GET['fees']; 
mysql_query("UPDATE bank_fees SET fee='".$fees."' WHERE id='".$id."'");
//echo mysql_error();
}



?>					




                    
 <div class="row">

<form action="" method="post">

<div class="col-md-4">
<input type="text" name="country" class="form-control input-lg" placeholder="Name Of Country">
</div>

<div class="col-md-4">


<div class="input-group mb15">
                  <input type="text" name="fees" class="form-control input-lg" placeholder="Fees">
                  <span class="input-group-addon">%</span>
                </div>


</div>

<div class="col-md-4">
<input type="submit" class="btn btn-primary btn-block" value="ADD NEW">
</div>

</form>

</div>

<hr>






					
					
                    <div class="row">
                        <div class="col-md-12">
                            
							
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <!--i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">AAA</span-->
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>

										
										
<tr>
<th> ID# </th>
<th> Country </th>
<th> Fees </th>
<th> Delete </th>
</tr>

</thead><tbody>

<?php
$ddaa = mysql_query("SELECT id, country, fee FROM bank_fees ORDER BY id");
    echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {
 echo "                                
 <tr>
 
   <td>$data[0]</td>
   <td>$data[1]</td>
   <td> 

<form action=\"\" method=\"get\">
<input type=\"text\" name=\"fees\" value=\"$data[2]\">% 
<input type=\"hidden\" name=\"id\" value=\"$data[0]\">
<input type=\"submit\" class=\"btn btn-primary btn-xs\" value=\"UPDATE\">


</form>

   </td>
   <td>   <a href=\"?did=$data[0]\"><button class=\"btn red btn-xs\"> <i class=\"fa fa-times\"></i> DELETE</button></a>  </td>

   


</tr>";
	
	}
	
//$edt = "<a href=\"editcat.php?id=$data[0]\"><button class=\"btn purple btn-xs\"> <i class=\"fa fa-edit\"></i> EDIT</button></a>";
	
?>
				
			

                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                            
                        </div>
                    </div><!-- ROW-->
					
					
					
					
					
			
			
		
					
					
					
					
					
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
            
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
      <?php
 include ('include/footer.php');
 ?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		
		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
 
 </body>
</html>