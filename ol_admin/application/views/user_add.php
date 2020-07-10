<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php
	if($this->uri->segment(3)=='Edit'){
		$btn='Update';
	}
	else{
		$btn='Add';
	}
?>
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script>
	$(document).ready(function(e) {
       //////////
	   $("#referralname").autocomplete({
                        source:'<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1)?>/auto_camplate',
                        minLength:2,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#referralid').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#referralid').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#referralid').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////
	   ////////////
	   		$(document).on('change', '#emailid', function (e) {
				
				var value 		= $('#emailid').val();
		
				var url='<?php echo base_url()?>index.php/comman_controler/check_email_address/'+value+'/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>';
	
				$.ajax({url:url,success:function(result){
					if(result=='flase'){
						alert('"'+value+'" Email id is already exist');
						$('#emailid').val('');
					}
				}});
			});
	   ////////////
	   ////////////
	   	$(document).on('change', '#username', function (e) {
				
				var value 		= $('#username').val();
		
				var url='<?php echo base_url()?>index.php/comman_controler/check_username/'+value+'/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>';
				
				$.ajax({url:url,success:function(result){
					
					if(result=='flase'){
						alert('"'+value+'" Username is already sxist');
						$('#username').val('');
					}
				
				}});
			});
	   ////////////
    });
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
          <h3 class="page-header">Add-User
            
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">User Information</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
            
             <!------------------>
           <?php if($this->uri->segment(3)=='Add'){?>
           
           <div class="control-group">
            <label class="control-label">Referralid</label>
            <div class="controls">
              <input id="referralname" name="referralname" value="" class="span12 {validate:{required:true}}" type="text" placeholder="Referral Name"/>
              <input  type="hidden" id="referralid" name="referralid" value=""/>
            </div>
          </div>  
           
           <?php } ?>
         
             
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
              <input id="lname" name="lname" value="<?=$result[0]['lname']?>" class="span12" type="text" placeholder="Last Name"/>
            </div>
          </div>
          <!------------------>
          
           <!------------------>
          <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input id="username" name="username" value="<?=$result[0]['username']?>" class="span12" type="text" placeholder="Username"/>
            </div>
          </div>
          <!------------------>
          
           <!------------------>
          <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input id="password" name="password" value="<?=$result[0]['password']?>" class="span12" type="password" placeholder="Username"/>
            </div>
          </div>
          <!------------------>
          
           <!------------------>
          <div class="control-group">
            <label class="control-label">Confirm Password</label>
            <div class="controls">
              <input id="confirm_password" name="confirm_password" value="<?=$result[0]['password']?>" class="span12 {validate:{equalTo:password}}" type="password" placeholder="Username"/>
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
            <label class="control-label">User Email</label>
            <div class="controls">
              <input id="emailid" name="emailid" value="<?=$result[0]['emailid']?>" class="span12" type="email" placeholder="Email"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Suffix</label>
            <div class="controls">
              <input id="suffix" name="suffix" value="<?=$result[0]['suffix']?>" class="span12" type="text" placeholder="Suffix"/>
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
              <input id="phone_no" name="phone_no" value="<?=$result[0]['phone_no']?>" class="span12" type="text" placeholder="Phone No"/>
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
            <button type="submit" class="btn btn-primary btnsubmit"><?=$btn?></button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

