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
                    <h3 class="page-title"> Add Balance To User
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

$email = mysql_real_escape_string($_POST["email"]);
$amount = mysql_real_escape_string($_POST["amount"]);
$msg = mysql_real_escape_string($_POST["msg"]);


$err1=0;
$err2=0;


$exist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='".$email."'"));

if($exist[0]!=1)
      {
$err1=1;
}

if($amount<=0){
    $err2=1;
}



$error = $err1+$err2;


if ($error == 0){
$cbal = mysql_fetch_array(mysql_query("SELECT mallu, firstname, lastname FROM users WHERE email='".$email."'"));
$newbal = $cbal[0]+$amount;
$res = mysql_query("UPDATE users SET mallu='".$newbal."' WHERE email='".$email."'");
echo mysql_error();
if($res){
	
	
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

$amount USD Successfully Added TO $cbal[1] $cbal[2] ($email) ! <br>
Balance Updated $cbal[0] USD TO $newbal USD 

</div>";




///--------------------------TRX
$ra4 = rand(1000,9999);
$trx = date("dmyhis", $tm).$ra4;

$recdetails = mysql_fetch_array(mysql_query("SELECT id, firstname, mallu FROM users WHERE email='".$email."'"));
mysql_query("INSERT INTO trx SET who='".$recdetails[0]."', byy='0', amount='".$amount."', sig='+', typ='Account Credited', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$msg."', refund='9'");
///--------------------------TRX



///------------------------- LOG
mysql_query("INSERT INTO generated SET tto='".$email."', amount='".$amount."', typ='0', tm='".$tm."', trx='".$trx."', msg='".$msg."'");
///------------------------- LOG


mysql_query("INSERT INTO add_bal SET usid='".$recdetails[0]."', amount='".$amount."', via='System', too='System', frm='System', trx='".$trx."', status='1'");





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

User $email NOT FOUND !!!

</div>";
}       
    
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Amount Should Be a Positive Number!!!

</div>";
}		
	
}




}

?>										
										
										
										
										
										
                                        
                    <div class="form-group">
                    <label class="col-md-3 control-label"><strong>Email Of User</strong></label>
                    <div class="col-md-6">
                     <input class="form-control input-lg" name="email" placeholder="" type="text">
                    </div>
                    </div>

                     
										
					<div class="form-group">
                    <label class="col-md-3 control-label"><strong>AMOUNT</strong></label>
                    <div class="col-md-6">

                    <div class="input-group mb15">
                      <input class="form-control input-lg" name="amount" placeholder="" type="text">
                      <span class="input-group-addon">USD</span>
                    </div>


                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-md-3 control-label"><strong>Message</strong></label>
                    <div class="col-md-6">
                    <textarea id="nope" class="form-control" rows="5" name="msg"></textarea>
                    </div>
                    </div>



					 
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-6">
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