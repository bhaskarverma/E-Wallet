<?php
include("header.php");
?>
        <link rel="stylesheet" href="css/datepicker.css">

  <div class="clearfix"></div>
  


<div class="header-inner two" style="margin-bottom: 20px;">
<div class="inner text-center">
<h4 class="title text-white uppercase"> Here is your Activity, <?php echo $ufnm; ?></h4>
</div>
<div class="overlay bg-opacity-5"></div>
<img src="<?php echo $mainpage; ?>/header-img.jpg" alt="" class="img-responsive"> </div>


 <section class="sec-padding">
    <div class="container">

<div class="row">


 
<div class="col-md-4 col-sm-12">



<form action="" method="post">

<div class="row">
<div class="col-sm-12">

           <div class="input-daterange" id="datepicker" >
               <div class="input-group">
                  <input class="form-control input-lg" type="text" placeholder="Start Date" name="start">
                  <span class="input-group-addon">TO</span>
                   <input class="form-control input-lg" type="text" placeholder="End Date" name="end">
                </div>
            </div>    
</div>

<div class="col-sm-12"><br>
<button type="submit" name="d2d" class="btn btn-success btn-block"> SEARCH</button>
</div>
</div>

</form>





    
</div>


<div class="col-md-4 col-sm-12 pull-right">



<form action="" method="post">
<div class="row">
<div class="col-sm-12">
<input class="form-control input-lg" type="text" placeholder="Search By Email" name="mail">
</div>
<div class="col-sm-12"><br>
<button type="submit" name="mma" class="btn btn-success btn-block"> SEARCH</button>
</div>
</div>
</form>


    
</div>
</div>

<div style="min-height: 40px;"></div>

<div class="row">
 
<div class="col-md-12 col-sm-12">


<table class="table table-hover table-responsive table-striped table-condensed" style="border-collapse:collapse;">
<tbody>

<?php 

$ddaa = mysql_query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund FROM trx WHERE who='".$uid."' ORDER BY id DESC LIMIT 0,30");


if( isset($_POST['mma']) )
{
$mail = mysql_real_escape_string($_POST["mail"]);
$ssiidd = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE email='".$mail."'"));

$ddaa = mysql_query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund FROM trx WHERE who='".$uid."' AND byy='".$ssiidd[0]."' ORDER BY id DESC");

echo "<h1>Showing Results For $mail</h1>";
}


if( isset($_POST['d2d']) )
{
$start = mysql_real_escape_string($_POST["start"]);
$end = mysql_real_escape_string($_POST["end"]);

$d1=strtotime($start);
$d2=strtotime($end)+24*60*60;




$ddaa = mysql_query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund FROM trx WHERE who='".$uid."' AND tm BETWEEN '".$d1."' AND '".$d2."' ORDER BY id DESC");

echo "<h1>Showing Results For $start TO $end</h1>";
}


    echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {     

$month = date("M", $data[6]);
$tarikh = date("d", $data[6]);
$monthname =  strtoupper($month);
$byy = mysql_fetch_array(mysql_query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'"));

if($data[1]==0){
$byy = array($gen[0], 'SYSTEM', '' );
}

if($data[1]=="000111"){
$byy = array('PayPal', 'Autometic', '' );
}

if($data[1]=="000222"){
$byy = array('PerfectMoney', 'Autometic', '' );
}

if($data[1]=="000333"){
$byy = array($gen[0], 'Staff', '' );
}



if($data[3]=="-"){
$sig = "<i class=\"fa fa-minus\" style=\"color: red;\"></i>";
$amo = number_format($data[2]+$data[5], 2);
$amount = "<b style=\"font-size: 20px;\"> $ $amo &nbsp;&nbsp;&nbsp;</b>";
$paytxt = "Sent To";
$printrefund = "";
}

if($data[3]=="+"){
$sig = "<i class=\"fa fa-plus\" style=\"color: green;\"></i>";
$amo = number_format($data[2]-$data[5], 2);
$amount = "<b style=\"font-size: 20px;\"> $ $amo &nbsp;&nbsp;&nbsp;</b>";
$paytxt = "Paid By";
$printrefund = "<a href=\"$baseurl/refund/$data[0]\" class=\"btn btn-warning btn-sm pull-right\"> <i class=\"fa fa-repeat\"></i> REFUND</a>";
}

if($data[10]!=0){
$printrefund = "<a href=\"#\" class=\"btn btn-default btn-sm pull-right\"> <i class=\"fa fa-times\"></i> REFUND</a>";
}


if($data[8]==""){
$messageprint ="";
}else{
$messageprint="<br><br><b>Message:</b><br> $data[8]<br><br>";
}

?>
        <tr data-toggle="collapse" data-target="#<?php echo $data[0] ?>" class="accordion-toggle">
      
       <td style="text-align: center; width: 100px; padding: 5px;"><b style="font-size: 20px;"><?php echo $tarikh; ?></b><br><?php echo $monthname; ?></td>
      <td style="width: 14px;"></td>
           
            <td style=" padding-top: 10px;"><b><?php echo "$byy[0] $byy[1]"; ?></b><br><?php echo $data[4]; ?></td>

          <td style="text-align: right; padding-top: 16px;"> <?php echo "$sig $amount"; ?></td>

        </tr>

        <tr></tr>
 <tr><td colspan="10" class="hiddenRow"><div class="accordian-body collapse" id="<?php echo $data[0] ?>"> 


<div class="row">
<div class="col-md-10 col-md-offset-1 col-sm-12">

<div class="col-md-6 col-sm-12">
<b><?php echo "$paytxt"; ?></b><br>
<?php echo "$byy[0] $byy[1]"; ?><br>
<a href="mailto:<?php echo "$byy[2]"; ?>" style="color: blue;"><?php echo "$byy[2]"; ?></a>
<br><br>

<b>Transaction ID</b><br>
<?php echo "$data[7]"; ?><br>

</div>

<div class="col-md-6 col-sm-12">
<b>Details</b><br>

<p><?php echo "$paytxt $byy[0] $byy[1]"; ?>   <span class="pull-right"><?php echo number_format($data[2], 2); ?> USD</span>  <br></p>
<p>Fee  <span class="pull-right"><?php echo number_format($data[5], 2); ?> USD</span>  <br></p>
<p><b>TOTAL <span class="pull-right"><?php echo $amo; ?> USD</span>  </b><br></p>

<p><?php echo $printrefund; ?></p>


</div>

<div class="col-md-12">
  
<?php echo "$messageprint"; ?>

</div>


</div>

</div>
   </div> </td> </tr>

        
<?php 
}
 ?>
        
</tbody>
</table>












	  <div style="min-height: 100px;"></div>
	  
      </div>
    </div>
  </section>
  <!--end item -->

<?php
include("footer.php");
?>

        <script src="<?php echo $baseurl; ?>/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('.input-daterange').datepicker({
                    todayBtn: "linked"
                });
            
            });
        </script>

</body>
</html>