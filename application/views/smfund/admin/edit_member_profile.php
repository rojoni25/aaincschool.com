<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

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
	
    <?php if($this->session->flashdata('show_msg')!=''){?>
    	<div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
    	<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
    </div>
     <?php } ?> 
                   
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Edit Member Profile
            
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Edit Member Profile</li>
        </ul>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo smfund();?><?=$this->uri->rsegment(1)?>/insert_profile" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="Edit" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['usercode']?>" />
            
             <!------------------>
          <div class="control-group">
            <label class="control-label">First Name</label>
            <div class="controls">
              <input id="fname" name="fname" value="<?=$result[0]['fname']?>" class="span12 {validate:{required:true}}" type="text" placeholder="First Name"/>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Last Name</label>
            <div class="controls">
              <input id="lname" name="lname" value="<?=$result[0]['lname']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Last Name"/>
            </div>
          </div>
          <!------------------>
          
          
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Country Name</label>
            <div class="controls">
              	<select id="country_code" name="country_code" class="span12">
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
          <!------------------>
           
         
            <!------------------>
          <div class="control-group">
            <label class="control-label">Suffix</label>
            <div class="controls">
              <input id="suffix" name="suffix" value="<?=$result[0]['suffix']?>" class="span12" type="text" placeholder="Suffix Name"/>
            </div>
          </div>
          <!------------------>
           
             <!------------------>
          <div class="control-group">
            <label class="control-label">Email Id</label>
            <div class="controls">
              <input value="<?=$result[0]['emailid']?>" class="span8" type="text" readonly/>
              <?php if($this->session->userdata["logged_ol_member"]["email_verification"]=='N'){?>
              		<a href="<?=base_url()?>index.php/welcome/email_verification">Email Verify</a>
              <?php } ?>  
            </div>
          </div>
          <!------------------>
           
           <!------------------>
          <div class="control-group">
            <label class="control-label">Mobile No</label>
            <div class="controls">
              <input id="mobileno" name="mobileno" value="<?=$result[0]['mobileno']?>" class="span12" type="text" placeholder="Mobile No"/>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Phone No</label>
            <div class="controls">
              <input id="phone_no" name="phone_no" value="<?=$result[0]['phone_no']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Phone No"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Skype</label>
            <div class="controls">
              <input id="skype" name="skype" value="<?=$result[0]['skype']?>" class="span12" type="text" placeholder="Skype"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Facebook</label>
            <div class="controls">
              <input id="facebook_link" name="facebook_link" value="<?=$result[0]['facebook_link']?>" class="span12" type="text" placeholder="Facebook"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Youtube</label>
            <div class="controls">
              <input id="youtube_link" name="youtube_link" value="<?=$result[0]['youtube_link']?>" class="span12" type="text" placeholder="Youtube Link"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Google+</label>
            <div class="controls">
              <input id="googleplus_link" name="googleplus_link" value="<?=$result[0]['googleplus_link']?>" class="span12" type="text" placeholder="Google Plus"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Twitter</label>
            <div class="controls">
              <input id="twitter_link" name="twitter_link" value="<?=$result[0]['twitter_link']?>" class="span12" type="text" placeholder="Twitter Id"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Linkedin</label>
            <div class="controls">
              <input id="linkedin_link" name="linkedin_link" value="<?=$result[0]['linkedin_link']?>" class="span12" type="text" placeholder="Linkedin"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Payza Pay</label>
            <div class="controls">
              <input id="payzapay" name="payzapay" value="<?=$result[0]['payzapay']?>" class="span12" type="text" placeholder="Payza Pay"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Solid Trust Pay</label>
            <div class="controls">
              <input id="solidtrustpay" name="solidtrustpay" value="<?=$result[0]['solidtrustpay']?>" class="span12" type="text" placeholder="Solid Trust Pay"/>
            </div>
          </div>
          <!------------------>
          
           <!------------------>
          <div class="control-group">
            <label class="control-label">Paypal</label>
            <div class="controls">
              <input id="paypal" name="paypal" value="<?=$result[0]['paypal']?>" class="span12" type="text" placeholder="Paypal"/>
            </div>
          </div>
          <!------------------>
          
           <!------------------>
          <div class="control-group">
            <label class="control-label">BTC</label>
            <div class="controls">
              <input id="btc" name="btc" value="<?=$result[0]['btc']?>" class="span12" type="text" placeholder="BTC"/>
            </div>
          </div>
          <!------------------>
          
         
         
          <div class="control-group">
           <label for="Gender" class="control-label" >Gender : </label>
           <div class="controls">
           <?PHP
           	if($result[0]['gender']=='F'){
				$female='checked';
			}
			else{
				$male='checked';
			}
		   ?>
            <input type="radio" <?=$male?> name="gender"  id="gender" value="M" /> <span class="radio" >Male</span>
            <input type="radio" <?=$female?> name="gender" id="gender" value="F" /> <span class="" >Female</span>
           </div>
          </div>
           
           
             <!------------------************----------------->
              <div class="control-group">
                <label class="control-label">Profile Picture</label>
                <div class="controls">
                  		<input type="file" name="post_img" id="post_img" onChange="Checkfiles();" />
                </div>
              </div>
          
          
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo smfund();?><?=$this->uri->rsegment(1)?>/view"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
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
	function Checkfiles()
    {
		
        var fup = document.getElementById('post_img');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		
    	if(ext =="jpeg" ||  ext=="png"  || ext=="jpg")
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
</script>