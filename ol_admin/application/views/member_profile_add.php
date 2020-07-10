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
</script>
	
    <?php if($this->session->flashdata('show_msg')!=''){?>
    <br />
    
   
    
    <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
	<?php } ?>
    
     
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Member Profile Edit
          	<?php if($result[0]['status']=='Pending'){?>
          		<span class="pull-right"><a href="<?=base_url()?>index.php/user/panding_member">Back</a></span>
            <?php } ?>
            <?php if($result[0]['status']=='Active'){?>
          		<span class="pull-right"><a href="<?=base_url()?>index.php/user/">Back</a></span>
            <?php } ?>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Profile</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insert_member_profile" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="Edit" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['usercode']?>" />
            
             <!------------------>
          <div class="control-group">
            <label class="control-label">First Name</label>
            <div class="controls">
            <?php $form_value = set_value('fname', isset($result[0]['fname']) ? $result[0]['fname'] : ''); ?>
              <input id="fname" name="fname" value="<?=$form_value?>" class="span12" required="required" type="text" placeholder="First Name"/>
               <?php echo form_error('fname', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Last Name</label>
            <div class="controls">
            <?php $form_value = set_value('lname', isset($result[0]['lname']) ? $result[0]['lname'] : ''); ?>
              <input id="lname" name="lname" value="<?=$form_value?>" class="span12" required="required" type="text" placeholder="Last Name"/>
                <?php echo form_error('lname', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
           
 
          <div class="control-group">
            <label class="control-label">Country Name</label>
            <div class="controls">
            <?php $form_value = set_value('country_code', isset($result[0]['country_code']) ? $result[0]['country_code'] : ''); ?>
              	<select id="country_code" name="country_code" class="span12">
                	<option value="">--Select Country--</option>
                    <?php
                    	for($i=0;$i<count($country);$i++){
							$sel='';
							if($country[$i]['country_code']==$form_value){
								$sel='selected';
							}
							echo'<option  '.$sel.' value="'.$country[$i]['country_code'].'">'.$country[$i]['country_name'].'</option>';
						}
					?>
                </select>
                  <?php echo form_error('country_code', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           
            <!------------------>
          <div class="control-group">
            <label class="control-label">Email ID</label>
            <div class="controls">
            <?php $form_value = set_value('emailid', isset($result[0]['emailid']) ? $result[0]['emailid'] : ''); ?>
              <input id="emailid" name="emailid" value="<?=$form_value?>" class="span12" required="required" type="email" placeholder="User Email"/>
                <?php echo form_error('emailid', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
            <?php $form_value = set_value('username', isset($result[0]['username']) ? $result[0]['username'] : ''); ?>
              <input id="suffix" name="username" value="<?=$form_value?>" class="span12"  type="text" required="required" placeholder="Suffix"/>
                <?php echo form_error('username', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
            <?php $form_value = set_value('password', isset($result[0]['password']) ? $result[0]['password'] : ''); ?>
              <input id="suffix" name="password" value="<?=$form_value?>" class="span12"  type="text" required="required" placeholder="Suffix"/>
                <?php echo form_error('password', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Suffix</label>
            <div class="controls">
            <?php $form_value = set_value('suffix', isset($result[0]['suffix']) ? $result[0]['suffix'] : ''); ?>
              <input id="suffix" name="suffix" value="<?=$form_value?>" class="span12"  type="text" placeholder="Suffix"/>
                <?php echo form_error('suffix', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           
           <!------------------>
          <div class="control-group">
            <label class="control-label">Mobile No</label>
            <div class="controls">
            <?php $form_value = set_value('mobileno', isset($result[0]['mobileno']) ? $result[0]['mobileno'] : ''); ?>
              <input id="mobileno" name="mobileno" value="<?=$form_value?>" class="span12" required="required" type="number" placeholder="Mobile No"/>
                <?php echo form_error('mobileno', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Phone No</label>
            <div class="controls">
            <?php $form_value = set_value('phone_no', isset($result[0]['phone_no']) ? $result[0]['phone_no'] : ''); ?>
              <input id="phone_no" name="phone_no" value="<?=$form_value?>" class="span12"  type="number" placeholder="Phone No"/>
                <?php echo form_error('phone_no', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Skype</label>
            <div class="controls">
            <?php $form_value = set_value('skype', isset($result[0]['skype']) ? $result[0]['skype'] : ''); ?>
              <input id="skype" name="skype" value="<?=$form_value?>" class="span12" required="required" type="text" placeholder="Skype"/>
                <?php echo form_error('skype', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Facebook</label>
            <div class="controls">
            <?php $form_value = set_value('facebook_link', isset($result[0]['facebook_link']) ? $result[0]['facebook_link'] : ''); ?>
              <input id="facebook_link" name="facebook_link" value="<?=$form_value?>"  class="span12" type="text" placeholder="Facebook"/>
                <?php echo form_error('facebook_link', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Youtube</label>
            <div class="controls">
            <?php $form_value = set_value('youtube_link', isset($result[0]['youtube_link']) ? $result[0]['youtube_link'] : ''); ?>
              <input id="youtube_link" name="youtube_link" value="<?=$form_value?>" class="span12" type="text" placeholder="Youtube Link"/>
                <?php echo form_error('youtube_link', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Google+</label>
            <div class="controls">
            <?php $form_value = set_value('googleplus_link', isset($result[0]['googleplus_link']) ? $result[0]['googleplus_link'] : ''); ?>
              <input id="googleplus_link" name="googleplus_link" value="<?=$form_value?>" class="span12" type="text" placeholder="Google Plus"/>
                <?php echo form_error('googleplus_link', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Twitter</label>
            <div class="controls">
            <?php $form_value = set_value('twitter_link', isset($result[0]['twitter_link']) ? $result[0]['twitter_link'] : ''); ?>
              <input id="twitter_link" name="twitter_link" value="<?=$form_value?>" class="span12" type="text" placeholder="Twitter Id"/>
                <?php echo form_error('twitter_link', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Linkedin</label>
            <div class="controls">
            <?php $form_value = set_value('linkedin_link', isset($result[0]['linkedin_link']) ? $result[0]['linkedin_link'] : ''); ?>
              <input id="linkedin_link" name="linkedin_link" value="<?=$form_value?>" class="span12" type="text" placeholder="Linkedin"/>
                <?php echo form_error('fnlinkedin_linkame', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Google Wallet</label>
            <div class="controls">
            <?php $form_value = set_value('payzapay', isset($result[0]['payzapay']) ? $result[0]['payzapay'] : ''); ?>
              <input id="payzapay" name="payzapay" value="<?=$form_value?>" class="span12" type="text" placeholder="Google Wallet"/>
                <?php echo form_error('payzapay', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Cash app</label>
            <div class="controls">
            <?php $form_value = set_value('solidtrustpay', isset($result[0]['solidtrustpay']) ? $result[0]['solidtrustpay'] : ''); ?>
              <input id="solidtrustpay" name="solidtrustpay" value="<?=$form_value?>" class="span12" type="text" placeholder="Cash app"/>
                <?php echo form_error('solidtrustpay', '<p class="error_p">', '</p>'); ?>
            </div>
          </div>
          <!------------------>
          
          
          <!------------------>
          <div class="control-group">
            <label class="control-label">Crypto Wallet</label>
            <div class="controls">
            <?php $form_value = set_value('btc', isset($result[0]['btc']) ? $result[0]['btc'] : ''); ?>
              <input id="btc" name="btc" value="<?=$form_value?>" class="span12" type="text" placeholder="Crypto Wallet"/>
                <?php echo form_error('btc', '<p class="error_p">', '</p>'); ?>
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
            <label class="control-label">Skrill</label>
            <div class="controls">
              <input id="skrill" name="skrill" value="<?=$result[0]['skrill']?>" class="span12" type="text" placeholder="skrill"/>
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
           
          
          
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>


<style>
	.error_p{
		color:#781D1D;
	}

</style>