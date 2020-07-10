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

<?php
	//var_dump($result);
?>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Profile
            
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
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="Edit" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['usercode']?>" />
            
             <!------------------>
          <div class="control-group">
            <label class="control-label">First Name</label>
            <div class="controls">
              <input id="fname" name="fname" value="<?=$result[0]['fname']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Last Name</label>
            <div class="controls">
              <input id="lname" name="lname" value="<?=$result[0]['lname']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
          
           <!------------------>
          <div class="control-group">
            <label class="control-label">User Name</label>
            <div class="controls">
              <input id="username" name="username" value="<?=$result[0]['username']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
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
          <!------------------>
           
            <!------------------>
          <div class="control-group">
            <label class="control-label">User Email</label>
            <div class="controls">
              <input id="emailid" name="emailid" value="<?=$result[0]['emailid']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Suffix</label>
            <div class="controls">
              <input id="suffix" name="suffix" value="<?=$result[0]['suffix']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
           
           <!------------------>
          <div class="control-group">
            <label class="control-label">Mobile No</label>
            <div class="controls">
              <input id="mobileno" name="mobileno" value="<?=$result[0]['mobileno']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
          
            <!------------------>
          <div class="control-group">
            <label class="control-label">Phone No</label>
            <div class="controls">
              <input id="phone_no" name="phone_no" value="<?=$result[0]['phone_no']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
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
              <input id="payzapay" name="payzapay" value="<?=$result[0]['payzapay']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Solid Trust Pay</label>
            <div class="controls">
              <input id="solidtrustpay" name="solidtrustpay" value="<?=$result[0]['solidtrustpay']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
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
           
          
          
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

