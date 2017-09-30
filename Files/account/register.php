<?php
include("headernonuser.php");
?>
  



  <div class="clearfix"></div>
  <section class="sec-padding">
    <div class="container">
     <div class="row">
     <div class="col-md-7 col-centered" style="min-height: 700px;">

<div class="text-center">
<a href="<?php echo $baseurl; ?>/signin"> <strong> Already Have an Account? Sign in Now </strong></a>
</div>


     <div class="text-box padding-3 border">
     
     <div class="smart-forms smart-container wrap-3">
        
          <h3>Registretion Form</h3>
            



<?php

$regst = mysql_fetch_array(mysql_query("SELECT reg FROM general_setting WHERE id='1'"));


if($regst[0]==0){

if($_POST)
{

$firstname = mysql_real_escape_string($_POST["firstname"]);
$lastname = mysql_real_escape_string($_POST["lastname"]);

$day = mysql_real_escape_string($_POST["day"]);
$month = mysql_real_escape_string($_POST["month"]);
$year = mysql_real_escape_string($_POST["year"]);

$dob = "$year*$month*$day";

$location = mysql_real_escape_string($_POST["location"]);
$gender = mysql_real_escape_string($_POST["gender"]);
$mobile = mysql_real_escape_string($_POST["mobile"]);
$email = mysql_real_escape_string($_POST["email"]);

$password = mysql_real_escape_string($_POST["password"]);
$password2 = mysql_real_escape_string($_POST["password2"]);


$err1=0;
$err2=0;
$err3=0;
$err4=0;
$err5=0;
$err6=0;
$err7=0;
$err8=0;
$err9=0;
$err10=0;
$err11=0;
$err12=0;
$err13=0;
$err14=0;



if(trim($firstname)=="")
      {
$err1=1;
}

if(trim($lastname)=="")
      {
$err2=1;
}

if(trim($day)=="")
      {
$err3=1;
}

if(trim($month)=="")
      {
$err4=1;
}

if(trim($year)=="")
      {
$err5=1;
}

if(trim($location)=="")
      {
$err6=1;
}

if(trim($gender)=="")
      {
$err7=1;
}

if(trim($mobile)=="")
      {
$err8=1;
}

if(trim($email)=="")
      {
$err9=1;
}



if($password!=$password2)
      {
$err10=1;
}

if(strlen($password)<="7")
      {
$err11=1;
}

if(strlen($password2)<="7")
      {
$err11=1;
}

$eee = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='".$email."'"));

if($eee[0]>="1")
      {
$err12=1;
}

$ppp = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE mobile='".$mobile."'"));

if($ppp[0]>="1")
      {
$err13=1;
}


$error = $err1+$err2+$err3+$err4+$err5+$err6+$err7+$err8+$err9+$err10+$err11+$err12+$err13;


if ($error == 0){

$passmd = md5($password);

$mvcode = rand(100000,999999);

$res = mysql_query("INSERT INTO users SET firstname='".$firstname."', lastname='".$lastname."', dob='".$dob."', location='".$location."', gender='".$gender."', mobile='".$mobile."', email='".$email."', password='".$passmd."', mvcode='".$mvcode."'");

if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Registretion Completed Successfully!

</div>";

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$txt = "You are successfully registered to <?php echo $gen[0]; ?>. Please Verify Your Mobile Number To Use <?php echo $gen[0]; ?>";
abiremail($email, "Registration Completed Successfully", $firstname, $txt);

$sms ="Hi $firstname, Welcome to <?php echo $gen[0]; ?>. Your Verification Code is $mvcode";
abirsms($mobile, $sms);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS



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

First Name Can Not be Empty!!!

</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Last Name Can Not be Empty!!!

</div>";
}   
  
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Please Provide a valid Date of Birth!!!

</div>";
}   











  
if ($err6 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Please Select Your Country!!!
</div>";
}   


  
if ($err7 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Please Select Your Gender!!!
</div>";
}   


  
if ($err8 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Mobile Can Not be Empty!!!
</div>";
}   


  
if ($err9 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Email Can Not be Empty!!!
</div>";
}   
  

 
if ($err10 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Password and Confirm Password not match!!!
</div>";
}   
   

  
if ($err11 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Password must be minimum 8 Char!!!
</div>";
}   
  
 

 
if ($err12 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Email Already Exist in our database... Please Use another Email!!
</div>";
}   
  
if ($err13 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Mobile Number Already Exist in our database... Please Use another Mobile Number!!
</div>";
}   

}







}

?>























            <form method="post" action="" id="reg">

              <div class="form-body">
                
                  <label for="names" class="field-label">Your names</label>
                  <div class="frm-row">
                    
                        <div class="section colm colm6">
                            <label class="field prepend-icon">
                                <input name="firstname" id="firstname" class="gui-input" placeholder="First name..." type="text">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm6">
                            <label class="field prepend-icon">
                                <input name="lastname" id="lastname" class="gui-input" placeholder="Last name..." type="text">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section --> 
                                                                   
                    </div><!-- end frm-row section -->


                    
                    <label for="birthday" class="field-label">Your birthday</label>
                    <div class="frm-row">
                        <div class="section colm colm4">
                            <label for="month" class="field select">
                                <select id="month" name="month">
                                    <option value="01">01 - Jan</option>
                                    <option value="02">02 - Feb</option>
                                    <option value="03">03 - Mar</option>
                                    <option value="04">04 - Apr</option>
                                    <option value="05">05 - May</option>
                                    <option value="06">06 - Jun</option>
                                    <option value="07">07 - Jul</option>
                                    <option value="08">08 - Aug</option>
                                    <option value="09">09 - Sep</option>
                                    <option value="10">10 - Oct</option>
                                    <option value="11">11 - Nov</option>
                                    <option value="12">12 - Dec</option>
                                </select>
                                <i class="arrow double"></i>                             
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm4">
                            <label for="day" class="field">
                                <input name="day" id="day" class="gui-input" placeholder="Day..." type="text">
                            </label>
                        </div><!-- end section -->                        
                        
                        <div class="section colm colm4">
                            <label for="year" class="field">
                                <input name="year" id="year" class="gui-input" placeholder="Year..." type="text">
                            </label>
                        </div><!-- end section -->                     
                    
                    </div><!-- end .frm-row section -->
                    
                    <div class="section">
                      <label for="location" class="field-label">Country </label>
                        <label class="field select">
                            <select id="location" name="location">
                                <option value="">Select country...</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AG">Antigua and Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan Republic</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BR">Brazil</option>
                                <option value="BN">Brunei</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="C2">China Worldwide</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="HR">Croatia</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="CD">Democratic Republic of the Congo</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="GA">Gabon Republic</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GT">Guatemala</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IE">Ireland</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Laos</option>
                                <option value="LV">Latvia</option>
                                <option value="LS">Lesotho</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia</option>
                                <option value="MN">Mongolia</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="AN">Netherlands Antilles</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PW">Palau</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn Islands</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="QA">Qatar</option>
                                <option value="CG">Republic of the Congo</option>
                                <option value="RE">Reunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russia</option>
                                <option value="RW">Rwanda</option>
                                <option value="KN">Saint Kitts and Nevis Anguilla</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
                                <option value="VC">Saint Vincent and Grenadines</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">São Tomé and Príncipe</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="SO">Somalia</option>
                                <option value="ZA">South Africa</option>
                                <option value="KR">South Korea</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SH">St. Helena</option>
                                <option value="LC">St. Lucia</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="TW">Taiwan</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania</option>
                                <option value="TH">Thailand</option>
                                <option value="TG">Togo</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad and Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks and Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US">United States</option>
                                <option value="UY">Uruguay</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VA">Vatican City State</option>
                                <option value="VE">Venezuela</option>
                                <option value="VN">Vietnam</option>
                                <option value="VG">Virgin Islands (British)</option>
                                <option value="WF">Wallis and Futuna Islands</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                            </select>
                            <i class="arrow double"></i>                    
                        </label>  
                    </div><!-- end section -->                    
                    
                    <div class="section">
                      <label for="gender" class="field-label">Gender </label>
                        <label class="field select">
                            <select id="gender" name="gender">
                                <option value="">I am...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <i class="arrow double"></i>                    
                        </label>  
                    </div><!-- end section -->


                  <div class="section">
                      <label for="mobile" class="field-label">Mobile Number [Need Verification] </label>
                      <label class="field prepend-icon">
                          <input name="mobile" id="mobile" class="gui-input" placeholder="Number With Country Code" type="tel">
                            <span class="field-icon"><i class="fa fa-phone-square"></i></span>  
                        </label>
                    </div><!-- end section -->                   
                    
                  <div class="section">
                      <label for="email" class="field-label">Your Email Address [Never Be Changed]</label>
                      <label class="field prepend-icon">
                          <input name="email" id="email" class="gui-input" placeholder="example@domain.com..." type="email">
                            <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                        </label>
                    </div><!-- end section -->                    
                                        
                  <div class="section">
                      <label for="password" class="field-label">Create a password</label>
                      <label class="field prepend-icon">
					  <input name="password" id="password" class="gui-input" data-validation="strength" data-validation-strength="2" type="password">
					  
					  
                        <span class="field-icon"><i class="fa fa-lock"></i></span>  
                        </label>
						<div id="info" style="display: none;">
						<span id="noti1" class="fa fa-times" style="color:red;">Your Password Must Have One Small latter</span><br>
                    	<span id="noti2" class="fa fa-times" style="color:red;">Your Password Must Have One Capital latter</span><br>
                    	<span id="noti3" class="fa fa-times" style="color:red;">Your Password Must Have One Number</span><br>
                    	<span id="noti4" class="fa fa-times" style="color:red;">Your Password Must Have One Special Character</span>
                    	<span id="noti5" class="fa fa-times" style="color:red;">Your Password Must Be 8 Character long</span>
                    	</div>
                    </div><!-- end section -->
				
				
				
                  <div class="section">
                      <label for="confirmPassword" class="field-label">Confirm your password</label>
                      <label class="field prepend-icon">
                          <input name="password2" id="confirmPassword" data-validation="confirmation" data-validation-confirm="password" data-validation-error-msg="Your Password Did not match." class="gui-input" type="password">
                            <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>  
                        </label>
						
						<span id="noti6" class="fa fa-times" style="color:red; display:none;">Comfirm Password Must Match With Password</span>
                    </div><!-- end section -->


                    
                </div><!-- end .form-body section -->
                <div class="form-footer">
                  <button type="submit" class="button btn-primary btn-block">Create Account</button>
                </div><!-- end .form-footer section -->
            </form>
            
<?php 
}else{

echo "<h1> REGISTRATION IS OFF NOW </h1>";

}
 ?>


        </div></div></div>
     
     </div>
     <!--end item-->
      
    </div>
  </section>


<?php
include("footer.php");
?>


<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

<script>

  
$(document).ready(function () {
  
  var err = 1;
  var err1 = 1;
  var err2 = 1;
  var err3 = 1;
  var err4 = 1;
  var err5 = 1;
  var err6 = 1;
  
  
  $("#password").focusin(function(){
    $('#password').addClass('error');
      $("#info").show();
    });

  
  
  
  $("#confirmPassword").focusin(function(){
      $("#noti6").show();
    $('#confirmPassword').addClass('error');
    });

  
    

    
    
    
    
  $('#password').on('input',function(e){
   
   var pswd = $('#password').val();
  
  
    
    
  
    if ( pswd.match(/[a-z]/) ) {
      $('#noti1').removeClass('fa fa-times').addClass('fa fa-check');
          $('#noti1').css('color','green');
        err1 = 0;
        $('#password').removeClass('error').addClass('valid');
    } else {
      $('#noti1').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti1').css('color','red');
      err1 = 1;
      $('#password').removeClass('valid').addClass('error');
    }
    
    
    if ( pswd.match(/[A-Z]/) ) {
      $('#noti2').removeClass('fa fa-times').addClass('fa fa-check');
          $('#noti2').css('color','green');
        err2 = 0;
        $('#password').addClass('valid');
    } else {
      $('#noti2').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti2').css('color','red');
      err2 = 1;
      $('#password').removeClass('error').removeClass('valid').addClass('error');
    }
  
  
    if ( pswd.match(/\d/) ) {
      $('#noti3').removeClass('fa fa-times').addClass('fa fa-check');
          $('#noti3').css('color','green');
        err3 = 0;
        $('#password').removeClass('error').addClass('valid');
    } else {
      
      $('#noti3').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti3').css('color','red');
      err3 = 1;
      $('#password').removeClass('valid').addClass('error');
    }
    
    if(/^[a-zA-Z0-9- ]*$/.test(pswd) == true){
    $('#noti4').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti4').css('color','red');
      err4 = 1;
      $('#password').removeClass('valid').addClass('error');
    
        }else {
    
    $('#noti4').removeClass('fa fa-times').addClass('fa fa-check');
    $('#noti4').css('color','green');
    err4 = 0;
    $('#password').removeClass('error').addClass('valid');
    
  }
  
  if ( pswd.length < 8 ) {
      $('#noti5').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti5').css('color','red');
      
      err5 = 1;
      
      
    } else {
        $('#noti5').removeClass('fa fa-times').addClass('fa fa-check');
          $('#noti5').css('color','green');
        
        err5 = 0;
        $('#password').removeClass('error').addClass('valid');
    }

    var errlu = err1+err2+err3+err4+err5;
  
    if(errlu == 0){

      $('#password').removeClass('error').addClass('valid');
    }else{

      $('#password').removeClass('valid').addClass('error');
    }


  
  
  
  var pscn = $('#confirmPassword').val();
  
  
    if ( pswd == pscn ) {
      $('#noti6').removeClass('fa fa-times').addClass('fa fa-check');
          $('#noti6').css('color','green');
        err6 = 0;
      $('#confirmPassword').removeClass('error').addClass('valid');
    } else {
        
    $('#noti6').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti6').css('color','red');
    err6 = 1;
    $('#confirmPassword').removeClass('valid').addClass('error');
    }
   
    });
  
  
  $('#confirmPassword').on('input',function(e){
   
   var pswd = $('#password').val();
   var pscn = $('#confirmPassword').val();
  
  
    if ( pswd == pscn ) {
      $('#noti6').removeClass('fa fa-times').addClass('fa fa-check');
          $('#noti6').css('color','green');
        err6 = 0;
      $('#confirmPassword').removeClass('error').addClass('valid');
    } else {
        
    $('#noti6').removeClass('fa fa-check').addClass('fa fa-times');
      $('#noti6').css('color','red');
    err6 = 1;
    $('#confirmPassword').removeClass('valid').addClass('error');
    }
    
  
   
    });
  
  
  $("form").submit(function(e){
  
    
    err = err1+err2+err3+err4+err5+err6;
  
    if(err != 0){
        e.preventDefault();
    }
    });
  
  
});
  
  
</script>


</body>
</html>