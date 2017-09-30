<?php
require_once('../function.php');
require_once("anotifier.php");

connectdb();
session_start();

if (!is_user()) {
redirect("$baseurl/signin");
}



$user = $_SESSION['username'];
$sid = $_SESSION['sid'];

$userdetails = mysql_fetch_array(mysql_query("SELECT id, firstname, mallu, block, location, sid, mv FROM users WHERE email='".$user."'"));
$uid = $userdetails[0];
$mallu = $userdetails[2];
$ufnm = $userdetails[1];

if($sid!=$userdetails[5]){
redirect("$baseurl/signin");
}


if($userdetails[6]==1){
redirect("$baseurl/dashboard");
}

$gen = mysql_fetch_array(mysql_query("SELECT sitetitle FROM general_setting WHERE id='1'"));

?>


<!doctype html>
<html lang="en">
<head>
<title>My Account - <?php echo $gen[0]; ?></title>
<meta charset="utf-8">
<!-- Meta -->
<meta name="keywords" content="" />
<meta name="author" content="">
<meta name="robots" content="" />
<meta name="description" content="" />

<!-- this styles only adds some repairs on idevices  -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo $baseurl; ?>/images/favicon.ico">

<!-- Google fonts - witch you want to use - (rest you can just remove) -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- stylesheets -->
<link rel="stylesheet" media="screen" href="<?php echo $baseurl; ?>/js/bootstrap/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/js/mainmenu/menu.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/layouts.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/shortcodes.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" media="<?php echo $baseurl; ?>/screen" href="css/responsive-leyouts.css" type="text/css" />
<link rel="stylesheet" type="<?php echo $baseurl; ?>/text/css" href="css/Simple-Line-Icons-Webfont/simple-line-icons.css" media="screen" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/et-line-font/et-line-font.css">
<link rel="stylesheet" href="<?php echo $baseurl; ?>/js/custom-scrollbar/jquery.mCustomScrollbar.css">


<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/js/smart-forms/smart-forms.css">

  

<style>
  
table {
   border: 1px solid #ddd;
    width: 95%;
} 

.btn{
    border-radius: 6px;
}

</style>


</head>

<body>
<div class="site_wrapper">

      <!--Notification bar-->
  <!--div class="topbar white topbar-padding">
    <div class="container">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quod, doloremque nostrum molestiae ab, magni omnis a optio enim distinctio quos </p>
	
    </div>
  </div-->
        <!--Notification bar END-->
  
  <div class="clearfix"></div>
  
  <div id="header">
    <div class="container">
      <div class="navbar navbar-default yamm">
        <div class="navbar-header">
          <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a href="<?php echo $baseurl; ?>/dashboard" class="navbar-brand"><img src="<?php echo $baseurl; ?>/images/logo.png" style="width: 180px;" alt=""/></a> </div>
        <div id="navbar-collapse-grid" class="navbar-collapse collapse pull-right">
          <ul class="nav navbar-nav">
            


            <li class=""> <a href="<?php echo $baseurl; ?>/dashboard" class="dropdown-toggle">Dashboard</a></li>
            <li class=""> <a href="<?php echo $baseurl; ?>/activity" class="dropdown-toggle">Activity</a></li>
            <li class=""> <a href="<?php echo $baseurl; ?>/sendmoney" class="dropdown-toggle">Send Money</a></li>
            <li class=""> <a href="<?php echo $baseurl; ?>/requestmoney" class="dropdown-toggle">Request Money</a></li>
            <li class=""> <a href="<?php echo $baseurl; ?>/addmoney" class="dropdown-toggle">Add Money</a></li>
            <li class=""> <a href="<?php echo $baseurl; ?>/withrawmoney" class="dropdown-toggle">Withdraw Money</a></li>


            <li class="" style="padding-left: 40px;"> &nbsp; </li>



<li class=""> <a href="<?php echo $baseurl; ?>/signout" class="dropdown-toggle" style="color: #000;"> <i class="fa fa-sign-out"></i>  Sign Out</a></li>
          

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--end menu-->
  <div class="clearfix"></div>

  