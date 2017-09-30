<?php 
include('header.php');
$hometxt = mysql_fetch_array(mysql_query("SELECT head, htext FROM general_setting WHERE id='1'"));
?>
  <!-- masterslider -->
  <div class="master-slider ms-skin-default" id="masterslider"> 
    



<?php


$ddaa = mysql_query("SELECT id, img, btxt, stxt FROM slider_home ORDER BY id");
echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {
?>




    <!-- slide 1 -->
    <div class="ms-slide slide-1" data-delay="9">
      
      
      <img src="<?php echo $baseurl; ?>/js/masterslider/blank.gif" data-src="<?php echo "$mainpage/slider/$data[1]"; ?>" alt=""/>
      
      <h3 class="ms-layer text1 dark"
            style="left: 230px;top: 200px;"
            data-type="text"
            data-delay="500"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="scale(1.5,1.6)"> <?php echo $data[3]; ?> </h3>
            
      <h3 class="ms-layer text2 dark"
            style="left: 230px;top: 245px;"
            data-type="text"
            data-delay="1000"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="scale(1.5,1.6)"> <?php echo $data[2]; ?>  </h3>
            
      <a class="ms-layer sbut3" href="<?php echo $baseurl; ?>" 
            style="left: 230px; top: 395px;"
            data-type="text"
            data-delay="2000"
            data-ease="easeOutExpo"
            data-duration="1200"
            data-effect="scale(1.5,1.6)"> Sign In </a> 
            
            <a class="ms-layer sbut4"  href="<?php echo $baseurl; ?>/signup"
            style="left: 390px; top: 395px;"
            data-type="text"
            data-delay="2500"
            data-ease="easeOutExpo"
            data-duration="1200"
            data-effect="scale(1.5,1.6)"> Sign Up Now ! </a> 
            </div>
    <!-- end slide 1 --> 
    
    <?php 

} 

?>
    
  </div>
  <!-- end of masterslider -->
  <div class="clearfix"></div>

<section class="sec-padding">
<div class="container">
<div class="row slide-controls-color-13">
<div class="col-md-12">


<h2 class="section-title text-center"><?php echo $hometxt[0]; ?></h2>
<?php echo $hometxt[1]; ?>


</div>
</div>
</div>
</section>
<!-- end section -->






<div class="clearfix"></div> 






<section class="parallax-section4">
<div class="container sec-tpadding-2 sec-bpadding-2">
<div class="row">

<div class="col-md-6 bmargin">
<h2 class="section-title text-white text-left">Many More Features</h2>
<br/>
<div class="icon-plain-medium left gray"><span class="glyph-item mega" data-icon="&#xe044;"></span></div>
<div class="text-box-right">
<h5 class="text-white">Nullam turpis Cras dapibus orci rutrum adipiscing luctus </h5>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis commodo augue. Aliquam ornare hendrerit augue. Cras tellus. In pulvinar lectus a est. Curabitur eget orci consectetuer  Cras laoreet ligula.</p>
<br/>
<br/>
</div>
</div>



<div class="col-md-6 bmargin">
<h2 class="section-title text-white text-left">Excellent Support</h2>
<br/>
<div class="icon-plain-medium left gray"><span class="glyph-item mega" data-icon="&#xe04a;"></span></div>
<div class="text-box-right">
<h5 class="text-white">Nullam turpis Cras dapibus orci rutrum adipiscing luctus </h5>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis commodo augue. Aliquam ornare hendrerit augue. Cras tellus. In pulvinar lectus a est. Curabitur eget orci consectetuer  Cras laoreet ligula.</p>
<br/>
<br/>
</div>
</div>

</div>
</div>
</section>
<!--end section-->

<?php 
include('footer.php');
?>
 