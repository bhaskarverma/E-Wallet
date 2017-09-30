<?php

function abirsms($to,$txt){

$sendtext = urlencode("$txt");

$data = mysql_fetch_array(mysql_query("SELECT smsapi FROM general_setting WHERE id='1'"));

$appi = $data[0];
$appi = str_replace("{{number}}",$to,$appi);     
$appi = str_replace("{{message}}",$sendtext,$appi); 

$result = file_get_contents($appi);

}

/////////////////////--------------------------------------------------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




function abiremail($to,$subject,$uname,$txt){

$data = mysql_fetch_array(mysql_query("SELECT notimail, emailtemp, sitetitle FROM general_setting WHERE id='1'"));


$headers = "From: $data[2] <$data[0]> \r\n";
$headers .= "Reply-To: $data[2] <$data[0]> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$mm = str_replace("{{name}}",$uname,$data[1]);     
$message = str_replace("{{message}}",$txt,$mm); 



   if (mail($to, $subject, $message, $headers)) {
         //   echo 'Your message has been sent.';
            } else {
           // echo 'There was a problem sending the email.';
            }


}
?>