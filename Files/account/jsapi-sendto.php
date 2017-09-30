<?php

require_once('../function.php');
connectdb();
session_start();

if(isset($_POST["dt"])) {
$email = mysql_real_escape_string($_POST["dt"]);

$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='".$email."'"));

if($count[0]!=1){

echo "data";


}else{

echo "<p class=\"btn btn-primary btn-block\" id=\"next\"> NEXT </p> ";

}


} 
?>


