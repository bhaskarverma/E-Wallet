<?php
$baseurl = "http://idealbrothers.thesoftking.com/wallet/account";
$mainpage = "http://idealbrothers.thesoftking.com/wallet";

$dbname = "rexbdnet_ibwallet";
$dbhost = "localhost";
$dbuser = "rexbdnet_demo";
$dbpass = "Dd1210##";


////------------------>>>>>>>>> DO NOT EDIT BELOW IF NOT NEEDED

date_default_timezone_set("Asia/Dhaka");
$tm = time();
error_reporting(E_ALL);
	

function connectdb()
{
    global $dbname, $dbuser, $dbhost, $dbpass;
    $conms = @mysql_connect($dbhost,$dbuser,$dbpass); //connect mysql
    if(!$conms) return false;
    $condb = @mysql_select_db($dbname);
    if(!$condb) return false;
    return true;
}

function attempt($username, $password)
{
$mdpass = md5($password);
$data = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='".$username."' and password='".$mdpass."'"));

	if ($data[0] == 1) {
		# set session
		$_SESSION['username'] = $username;
		return true;
	} else {
		return false;
	}
}



function attemptadmin($username, $password)
{
$mdpass = md5($password);
$data = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM admin WHERE username='".$username."' and password='".$mdpass."'"));

	if ($data[0] == 1) {
		# set session
		$_SESSION['username'] = $username;
		return true;
	} else {
		return false;
	}
}



function you_valid($usssr)
{

$aa = mysql_fetch_array(mysql_query("SELECT verify FROM users WHERE id='".$usssr."'"));

	if ($aa[0]==0){
		return true;
	}
}




function is_user()
{
	if (isset($_SESSION['username']))
		return true;
}

function redirect($url)
{
	header('Location: ' .$url);
	exit;
}



function urlmod($txt){

	$string = strtolower($txt);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    $url = $string;


	return $url;
}










?>