<?php
require_once('../function.php');
require_once("anotifier.php");

connectdb();
session_start();
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

<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/shaon.css">

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
          <a href="<?php echo $mainpage; ?>" class="navbar-brand"><img src="<?php echo $mainpage; ?>/logo.png" alt=""/></a> </div>
        <div id="navbar-collapse-grid" class="navbar-collapse collapse pull-right">
          <ul class="nav navbar-nav">
            

           
        
<?php 
$ddaa = mysql_query("SELECT id, name FROM menus ORDER BY id");
while ($data = mysql_fetch_array($ddaa))
{
$uri = urlmod($data[1]);
?>
  <li class="">
      <a href="<?php echo "$mainpage/menu/$data[0]/$uri"; ?>" class="dropdown-toggle">
          <?php echo $data[1];  ?>
      </a>
  </li>

<?php 
}
?>
            <li class="" style="padding-left: 40px;"> &nbsp; </li>


<li>
    <a href="<?php echo $baseurl; ?>/signin" style="color: #194a94;">
        <i class="fa fa-sign-in"> </i> Sign in
    </a> 
</li>


<li>
    <a href="<?php echo $baseurl; ?>/signup" style="color: #fd602c;">
        <i class="fa fa-edit"> </i> Sign up
    </a> 
</li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--end menu-->
  <div class="clearfix"></div>

  