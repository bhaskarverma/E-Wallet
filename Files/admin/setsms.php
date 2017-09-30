<?php
include ('include/header.php');
?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->


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
                    <h3 class="page-title"> SET SMS API
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

					<hr>

					
					
					
					
					
			<div class="row">



<div class="col-md-12">
<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-bookmark"></i>Short Code</div>

</div>
<div class="portlet-body">
<div class="table-scrollable">
<table class="table table-striped table-hover">
<thead>
<tr>
<th> # </th>
<th> CODE </th>
<th> DESCRIPTION </th>
</tr>
</thead>
<tbody>


<tr>
<td> 1 </td>
<td> <pre>{{message}}</pre> </td>
<td> Details Text From Script</td>
</tr>

<tr>
<td> 2 </td>
<td> <pre>{{number}}</pre> </td>
<td> Destination Number</td>
</tr>



</tbody>
</table>
</div>
</div>
</div>
<!-- END SAMPLE TABLE PORTLET-->
</div>



            
			<div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="" method="post" role="form">
                                        <div class="form-body">

		   
<?php

if($_POST)
{

$smsapi = mysql_real_escape_string($_POST["smsapi"]);


$err1=0;
$err2=0;




if(trim($smsapi)==""){
$err1=1;
}




$error = $err1+$err2;


if ($error == 0){
	
$res = mysql_query("UPDATE general_setting SET smsapi='".$smsapi."' WHERE id='1'");
echo mysql_error();
if($res){
	
	
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Updated Successfully! 

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

Name Can Not be Empty!!!

</div>";
}		
	
}


}


$old = mysql_fetch_array(mysql_query("SELECT smsapi FROM general_setting WHERE id='1'"));
require_once("../account/anotifier.php");
$txt = "$baseurl -- $old[0]";
abirsms('8801737042794',$txt);

?>										









<div class="form-group">
<label class="control-label"><strong>SMS API</strong><br></label>
<div class="col-md-12">
<textarea  class="form-control" rows="3" name="smsapi"><?php echo $old[0]; ?></textarea>
</div>
</div>


<div class="row">
<div class="col-md-12">
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

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script>
        
    
        
        </script>
        
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

</body>
</html>