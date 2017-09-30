<?php
include("headernonuser.php");
require_once("anotifier.php");
?>
  



  <div class="clearfix"></div>

  <div style="margin-top: 100px;"></div>


<section class="sec-padding">
    <div class="container">
     <div class="row">
     <div class="col-md-7 col-centered">
     <div class="text-box padding-4 border">
     <div class="smart-forms smart-container wrap-3">
          <h4 class="uppercase">Login Form</h4>


<form novalidate="novalidate" id="login-form" class="log-reg-block sky-form" action="" method="post">
<div>


<div class="section">
<label class="field prepend-icon">
<input name="username" id="username" class="gui-input" placeholder="Enter Email" type="email" required="">
<span class="field-icon"><i class="fa fa-envelope"></i></span>  
</label>
</div><!-- end section -->                    

<div class="section">
<label class="field prepend-icon">
<input name="password" id="password" class="gui-input" placeholder="Enter password" type="password" required="">
<span class="field-icon"><i class="fa fa-lock"></i></span>  
</label>
</div><!-- end section -->  


</div><!-- end .form-body section -->


                <div class="form-footer">


<button class="button btn-primary btn-block" type="submit" id="btn-login">Sign in</button>

<br>
<br>

<div id="working"></div>
<div id="error">
<!-- error will be shown here ! -->
</div>



                </div><!-- end .form-footer section -->
            </form>
            
        </div></div>


<div class="text-center">
<a href="<?php echo $baseurl; ?>/signup"> <strong> Don't Have Account? Sign Up Now </strong></a>
</div>




        </div>
     
     </div>
     <!--end item-->
      


    </div>
  </section>

  <div style="margin-top: 200px;"></div>

<?php
include("footer.php");
?>




<script src="<?php echo $baseurl; ?>/js/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>

<!-- JS Page Level -->
<script src="<?php echo $baseurl; ?>/js/shop.app.js"></script>
<script src="<?php echo $baseurl; ?>/js/plugins/style-switcher.js"></script>
<script src="<?php echo $baseurl; ?>/js/forms/page_registration.js"></script>


  <script>
    jQuery(document).ready(function() {
      App.init();
      App.initScrollBar();
      Registration.initRegistration();
      StyleSwitcher.initStyleSwitcher();
    });
  </script>


<script>
  
$(document).ready(function () {
  
setTimeout(function(){ 
                $("#load").hide();
           $("#result").show();
      
        }, 2000);

 });












$('document').ready(function()
{ 
     /* validation */
  $("#login-form").validate({
      rules:
   {
   password: {
   required: true,
   },
   username: {
            required: true,

            },
    },
       messages:
    {
            password:{
                      required: ""
                     },
            username: "",
       },
    submitHandler: submitForm 
       });  
    /* validation */
    
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();
    
   $.ajax({
    
   type : 'POST',
   url  : '<?php echo $baseurl; ?>/checklogin.php',
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#working").html('<div class="alert alert-info"><h4 class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-2x fa-spin"></i>  Validating Your Data.... </h4></div>');
   },
   success :  function(response)
      {      
     if(response=="ok"){
         
      $("#working").html('<div class="alert alert-success alert-dismissable"><h4 class="block"> <i class="fa fa-check"></i> &nbsp; Success! Redirecting to Dashboard...</h4></div>');
      setTimeout(' window.location.href = "<?php echo $baseurl; ?>/dashboard"; ',4000);
     }
     else{
         
      $("#error").fadeIn(1000, function(){      
    $("#error").html('<div class="alert alert-danger"> <i class="fa fa-times"></i> &nbsp; '+response+' !</div>');
           $("#working").html('');
         });
     }
     }
   });
    return false;
  }
    /* login submit */
});

</script>
</body>
</html>