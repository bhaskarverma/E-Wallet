<?php
require_once('function.php');
connectdb();
session_start();
$gen = mysql_fetch_array(mysql_query("SELECT sitetitle FROM general_setting WHERE id='1'"));
?>


<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<!--<![endif]-->
<html lang="en">

<head>
<title><?php echo $gen[0]; ?></title>
<meta charset="utf-8">
<!-- Meta -->
<meta name="keywords" content="" />
<meta name="author" content="">
<meta name="robots" content="" />
<meta name="description" content="" />

<!-- this styles only adds some repairs on idevices  -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

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
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/shortcodes.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" media="screen" href="<?php echo $baseurl; ?>/css/responsive-leyouts.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/js/masterslider/style/masterslider.css" />
<link href="<?php echo $baseurl; ?>/js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/js/cubeportfolio/cubeportfolio.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/Simple-Line-Icons-Webfont/simple-line-icons.css" media="screen" />
<link href="<?php echo $baseurl; ?>/js/owl-carousel/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="js/tabs/assets/css/responsive-tabs.css">
<link rel="stylesheet" href="<?php echo $baseurl; ?>/js/ytplayer/ytplayer.css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/js/style-swicher/style-swicher.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseurl; ?>/js/custom-scrollbar/jquery.mCustomScrollbar.css">



</head>

<body>
<div class="site_wrapper">

  


  <div class="clearfix"></div>
  
  <div id="header">
    <div class="container">
      <div class="navbar navbar-default yamm">
        <div class="navbar-header">
          <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a href="<?php echo $mainpage; ?>" class="navbar-brand"><img src="<?php echo $mainpage; ?>/logo.png" style="width: 180px;" alt=""/></a> </div>
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

  