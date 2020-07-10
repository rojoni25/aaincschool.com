<div class="row">  
  <div class="span12">    
    <ul class="top-banner"></ul>
  </div>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<script>
	$(function () {
      var validator = $("#form2").validate({
          meta: "validate"
      });
			$(".btnsubmit").click(function () {
                   var validator = $("#form2").validate({
                  	meta: "validate"
              	});
              });
              $(".cancel").click(function () {
                  validator.resetForm();
              });
			
          });
			$(document).on('change', '#emailid', function (e) {
				var value=$(this).val();
				if(value==''){
					return false;
				}
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(value)) {
					$(this).val('');
   		 			alert("Enter Vailed Email Address");
    				return false;
 				}
				var url_update='<?=base_url();?>index.php/<?=$this->uri->segment(1)?>/check_email/'+value;
				$.ajax({url:url_update,success:function(result){	
  					if(result=='1'){
  						alert('" '+value+' " is already exist');
  						$('#emailid').val('');
  					}	 	
        }});	
			});	
</script>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Master</a> </li>
    <li class="active-bre"><a href="#"> Profile</a> </li>
    <li class="page-back"><a href="<?php echo base_url();?>index.php/welcome"><i class="fa fa-backward" aria-hidden="true"></i> Back to Home</a> </li>
  </ul>
</div>
<?php
	//var_dump($result);
?>
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Profile</h4>
    <div class="tz-2-main-com bot-sp-20">
        <?php
          if($contain[0]['video_url']!=''){
              echo '<div class="video_frm">';
              echo '<div class="inner_frm">';
              if (strpos($contain[0]['video_url'], 'youtube') !== false)
              {
                echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
              }
              else{
                echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
              }
              echo '</div>';
              echo '</div>';
          }
        ?>
         <div class="row">
            <ul class="tabs pg-ele-tab">
              <li class="tab active"><a data-toggle="tab" href="#personal-info">Personal Info</a></li>
              <li class="tab "><a data-toggle="tab" href="#address">Address</a></li>
              <li class="tab "><a data-toggle="tab" href="#contact-info">Contact Info</a></li>
              <li class="tab "><a data-toggle="tab" href="#accounts-details">Accounts Details</a></li>
              <li class="tab "><a data-toggle="tab" href="#other-details">Social</a></li>
              <li class="tab "><a data-toggle="tab" href="#payment-details">Payment Details</a></li>
              <li class="tab "><a data-toggle="tab" href="#affiliate-links">Affiliate Links</a></li>
            </ul>
            <div class="hom-cre-acc-left hom-cre-acc-right">
              <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
                  <input type="hidden" name="mode" id="mode" value="Edit" />
                  <input type="hidden" name="eid" id="eid"   value="<?=$result[0]['usercode']?>" />

                  <div class="tab-content" style="min-height: 500px;">
                    <div id="personal-info" class="tab-pane fade in active">
                      <div class="control-group">
                        <label class="control-label" for="fname">First Name</label>
                        <div class="controls">
                          <input id="fname" name="fname" value="<?=$result[0]['fname']?>" class="validate {validate:{required:true}}" type="text" placeholder="First Name"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="lname">Last Name</label>
                        <div class="controls">
                          <input id="lname" name="lname" value="<?=$result[0]['lname']?>" class="validate {validate:{required:true}}" type="text" placeholder="Last Name"/>
                          
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Date Of Birth</label>
                        <div class="controls">
                          <input id="fname" name="dob" value="<?=$result[0]['dob']?>" class="span12 {validate:{required:true}}" type="text" placeholder="yyyy-mm-dd"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Suffix</label>
                        <div class="controls">
                          <input id="suffix" name="suffix" value="<?=$result[0]['suffix']?>" class="span12" type="text" placeholder="Suffix Name"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label for="Gender" class="control-label" >Gender : </label>
                        <div class="controls">
                          <?php
                            if($result[0]['gender']=='F'){
                              $female='checked';
                            }
                            else{
                              $male='checked';
                            }
                          ?>
                          <input type="radio" <?=$male?> name="gender"  id="ldis1" value="M" class="with-gap"/> 
                          <label for="ldis1">Male</label>
                          <input type="radio" <?=$female?> name="gender" id="ldis2" value="F" class="with-gap"/> 
                          <label for="ldis2">Female</label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Profile Picture</label>
                        <div class="controls">
                            <div class="file-field input-field">
                              <div class="tz-up-btn"> <span>File</span>
                                <input type="file" name="post_img" onChange="Checkfiles();"><br> </div>
                              <div class="file-path-wrapper db-v2-pg-inp">
                                <input class="file-path validate" type="text"> 
                              </div>
                            </div>
                            <img id="loader" style="display: none;width: 50px;" src="<?php echo base_url()?>asset/images/loading_spinner.gif"/>
                        </div>
                      </div>
                      <?php if($result[0]['user_img']!=''){?>
                        <img src="<?php echo base_url();?>upload/user_thum/<?=$result[0]['user_img']; ?>" style="
                        ">
                      <?php } ?>
                    </div>
                    <div id="address" class="tab-pane fade">
                      <div class="control-group">
                        <label class="control-label">Address line One</label>
                        <div class="controls">
                          <input id="addresslineone" name="addresslineone" value="<?=$result[0]['addresslineone']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Address line One"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Address line Two</label>
                        <div class="controls">
                          <input id="addresslinetwo" name="addresslinetwo" value="<?=$result[0]['addresslinetwo']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Address line Two"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">City</label>
                        <div class="controls">
                          <input id="city" name="city" value="<?=$result[0]['city']?>" class="span12 {validate:{required:true}}" type="text" placeholder="City"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">State</label>
                        <div class="controls">
                          <input id="state" name="state" value="<?=$result[0]['state']?>" class="span12 {validate:{required:true}}" type="text" placeholder="State"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Country Name</label>
                        <div class="controls">
                            <select id="country_code" name="country_code" class="span12 {validate:{required:true}}">
                              <option value="">--Select Country--</option>
                                <?php
                                  for($i=0;$i<count($country);$i++){
                          $sel='';
                          if($country[$i]['country_code']==$result[0]['country_code']){
                            $sel='selected';
                          }
                          echo'<option  '.$sel.' value="'.$country[$i]['country_code'].'">'.$country[$i]['country_name'].'</option>';
                        }
                      ?>
                            </select>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Zip Code</label>
                        <div class="controls">
                          <input id="zip_code" name="zip_code" value="<?=$result[0]['zip_code']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Zip Code"/>
                        </div>
                      </div>
                    </div>
                    <div id="contact-info" class="tab-pane fade">
                      <div class="control-group">
                        <label class="control-label">User Email</label>
                        <div class="controls">
                          <input id="emailid" name="emailid" value="<?=$result[0]['emailid']?>" class="span12 {validate:{required:true}}" type="text" placeholder="User Email"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Mobile No</label>
                        <div class="controls">
                          <input id="mobileno" name="mobileno" value="<?=$result[0]['mobileno']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Mobile"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Phone No</label>
                        <div class="controls">
                          <input id="phone_no" name="phone_no" value="<?=$result[0]['phone_no']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Phone"/>
                        </div>
                      </div>
                    </div>
                    <div id="accounts-details" class="tab-pane fade">
                      <h6> Bank Account</h6>
                      <div class="control-group">
                        <label class="control-label">Routing Number</label>
                        <div class="controls">
                          <input id="bank_account_branchId" name="bank_account_branchId" value="<?=$result[0]['bank_account_branchId']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Routing Number"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Account Number</label>
                        <div class="controls">
                          <input id="bank_account_bankAccountId" name="bank_account_bankAccountId" value="<?=$result[0]['bank_account_bankAccountId']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Account Number"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Account Type</label>
                        <div class="controls">
                            <select id="bank_account_bankAccountPurpose" name="bank_account_bankAccountPurpose" class="span12 {validate:{required:true}}">
                              <option value="">--Select Account Type--</option>
                              <option value="CHECKING" <?php 
                                if($result[0]['bank_account_bankAccountPurpose'] == "CHECKING"){
                                  echo 'selected="selected"';
                                }
                              ?>>CHECKING</option>
                              <option value="SAVINGS" <?php 
                                if($result[0]['bank_account_bankAccountPurpose'] == "SAVINGS"){
                                  echo 'selected="selected"';
                                }
                              ?>>SAVINGS</option>
                            </select>
                        </div>
                      </div>
                      <h6> Wire Account</h6>
                      <div class="control-group">
                        <label class="control-label">Account Number OR IBAN</label>
                        <div class="controls">
                          <input id="wire_account_bankAccountId" name="wire_account_bankAccountId" value="<?=$result[0]['wire_account_bankAccountId']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Account Number"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Routing Number</label>
                        <div class="controls">
                          <input id="wire_account_bankId" name="wire_account_bankId" value="<?=$result[0]['wire_account_bankId']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Routing Number"/>
                        </div>
                      </div>
                    </div>
                    <div id="other-details" class="tab-pane fade">
                      <div class="control-group">
                        <label class="control-label">Skype</label>
                        <div class="controls">
                          <input id="skype" name="skype" value="<?=$result[0]['skype']?>" class="span12" type="text" placeholder="Skype"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Facebook</label>
                        <div class="controls">
                          <input id="facebook_link" name="facebook_link" value="<?=$result[0]['facebook_link']?>" class="span12" type="text" placeholder="Facebook"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Youtube</label>
                        <div class="controls">
                          <input id="youtube_link" name="youtube_link" value="<?=$result[0]['youtube_link']?>" class="span12" type="text" placeholder="Youtube Link"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Google+</label>
                        <div class="controls">
                          <input id="googleplus_link" name="googleplus_link" value="<?=$result[0]['googleplus_link']?>" class="span12" type="text" placeholder="Google Plus"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Twitter</label>
                        <div class="controls">
                          <input id="twitter_link" name="twitter_link" value="<?=$result[0]['twitter_link']?>" class="span12" type="text" placeholder="Twitter Id"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Linkedin</label>
                        <div class="controls">
                          <input id="linkedin_link" name="linkedin_link" value="<?=$result[0]['linkedin_link']?>" class="span12" type="text" placeholder="Linkedin"/>
                        </div>
                      </div>
                    </div>
                    <!-- for Payment details -->
                    <div id="payment-details" class="tab-pane fade">
                      <div class="control-group">
                        <label class="control-label">Facebook</label>
                        <div class="controls">
                          <input id="facebook" name="facebook" value="<?=$result[0]['facebook']?>" class="span12" type="text" placeholder="Facebook"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Google Wallet</label>
                        <div class="controls">
                           <input id="payzapay" name="payzapay" value="<?=$result[0]['payzapay']?>" class="span12" type="text" placeholder="Google Wallet"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Paypal</label>
                        <div class="controls">
                          <input id="paypal" name="paypal" value="<?=$result[0]['paypal']?>" class="span12" type="text" placeholder="Paypal"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Stripe</label>
                        <div class="controls">
                          <input id="stripe" name="stripe" value="<?=$result[0]['stripe']?>" class="span12" type="text" placeholder="Stripe"/>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Square</label>
                        <div class="controls">
                          <input id="square" name="square" value="<?=$result[0]['square']?>" class="span12" type="text" placeholder="Square"/>
                        </div>
                      </div>
                    </div>
                    <!-- End Payment details -->
                    <div id="affiliate-links" class="tab-pane fade">
                      <div class="control-group">
                          <label class="control-label"><a href="#" onclick="preview('helixlife')">Preview</a> Helixlife</label>
                          <div class="controls">
                              <input id="helixlife" name="royaltie" value="<?=$result[0]['royaltie']?>" class="span12" type="text" placeholder="Helixlife"/>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions">
                    <button type="submit" id="showloader" class="btn btn-primary btnsubmit">Update</button>
                    <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
                  </div>
              </form>
            </div>
        </div>
    </div>
  </div>
</div>

<style>
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
	
	@media  only screen and (max-width: 500px){
.video_frm {
    width: 330px;
	height: 233px;
 
}
.inner_frm {
  	height: 205px;
	width: 273px;
	margin-top: 14px;
	margin-left: 28px;
}
}
@media  only screen and (max-width: 360px){
.video_frm {
    width: 225px;
	height: 159px;
 
}
.inner_frm {
  	height: 139px;
    width: 186px;
    margin-top: 10px;
    margin-left: 19px;
}
}

</style>
<script>
  $("#showloader").click(function(){
    $("#loader").css("display","block");
    //window.location = "base_url()/index.php/";
  });
	function Checkfiles()
    {
		
        var fup = document.getElementById('post_img');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		
    	if(ext =="jpeg" ||  ext=="png"  || ext=="jpg" || ext =="PNG" || ext =="JPG" || ext =="JPEG")
    	{
        	return true;
   		}
    	else
    	{
        	alert("Upload jpeg,png,jpg Images only");
			fup.value="";
        	return false;
    	}
    }
  function preview(e){
    if(e=='helixlife'){
        var helixlife=document.getElementById("helixlife").value;
        window.open("https://www.helixlife.com/default.aspx?UserName="+helixlife);
    } 
  }  
</script>