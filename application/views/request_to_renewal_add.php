<div class="">    
  <ul class="top-banner"></ul>
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
</script>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Friend</a> </li>
    <li class="active-bre"><a href="#"> Request To Renewal Friend</a> </li>
  </ul>
</div>    
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Request To Renewal Friend</h4>
   
    <div class="hom-cre-acc-left hom-cre-acc-right">
      <div class="col-md-6">
    
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/send_request">
        	<input type="hidden" name="renewal_usercode" id="renewal_usercode" value="<?=$member[0]['usercode']?>" />
        	<? if($msg!=''){?>
            	<div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
           <span style="font-weight:bold;color:#F00;"> <?=$msg?></span>
            </div>
          </div>
            <?php } ?>
          <div class="control-group">
            <label class="control-label"><strong>Enter Usercode / Username</strong></label>
            <div class="controls">
              <input id="find_key" name="find_key" value="<?=$_POST['find_key']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Enter Usercode / Username"/>
            </div>
          </div>
          
          
           <!------------------>
           <div class="control-group">
            <label class="control-label"><strong>Renewal From</strong></label>
            <div class="controls">
              	<select name="account_type" id="account_type">
                	<?php
                    	$sel1=($_POST['account_type']=='main_balance') ? "selected='selected'":"";
						$sel2=($_POST['account_type']=='personal_wallet') ? "selected='selected'":"";
					?>
                	<?php if($balance['main_balance']>=CW_MIN) { ?>
                    	<option <?=$sel1?> value="main_balance">Company Balance</option>
                    <?php } ?>
                    <?php if($balance['personal_wallet']>=PW_MIN) {?>
                    	<option <?=$sel2?> value="personal_wallet">Personal Wallet</option>
                    <?php } ?>
                </select>
            </div>
          </div>
          <!------------------>
          
          <!------------------>
           <div class="control-group">
            <label class="control-label"><strong>Current Company Balance</strong></label>
            <div class="controls">
              	<label class="llbbalnce">$<?=$balance['main_balance']?></label>
            </div>
          </div>
          <!------------------>
          
           <div class="control-group">
            <label class="control-label"><strong>Current Personal Wallet</strong></label>
            <div class="controls">
              	<label class="llbbalnce">$<?=$balance['personal_wallet']?></label>
            </div>
          </div>
          <!------------------>
         
          <div class="form-actions">
            <button type="submit" name="find" value="1" class="btn btn-primary btnsubmit">Find </button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
            <?php if(isset($member[0])) { ?>
            	 <button type="submit" name="send_request" value="1" class="btn btn-success">Send Request </button>
            <?php } ?>
          </div>
        </form>
      </div>
      
      <div class="col-md-6">
        <?php if(isset($member[0])) { ?>
          <table class="table">
          		<tr><td colspan="3"><h4>Member Detail</h4></td></tr>
          		<tr><td width="29%">Member Name</td><td>:</td><td width="70%"><?=$member[0]['fname']?> <?=$member[0]['lname']?></td></tr>
                <tr><td>Code</td><td>:</td><td><?=$member[0]['usercode']?></td></tr>
                <?php 
    					if($member[0]['status']!='Active'){
    						$status='Free';
    					}
    					else{
    						$status=(time() > $member[0]['due_time'] ? "Due" : "Active"); 
    					}
    					
    				
    				?>
                 <tr><td>Current Status</td><td>:</td><td><?=$status?></td></tr>
          </table>
        <?php } ?>
      </div>
      
    </div>
  </div>
</div>
<style>
	.llbbalnce{
		margin-top:5px;
		font-weight:bold;
		color:#F00;
	}
</style>