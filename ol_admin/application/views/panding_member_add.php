<?php
	
		$btn='Active Member';
	
?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Active</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Member</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Active</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
   
    <?PHP if($payment[0]['payment']=='Y'){ ?>
   		<div class="alert alert-success">
    		<i class="icon-ok-sign"></i><strong>Payment Received</strong> 
    	</div>
     <?php } 
	 else { ?> 
    	<div class="alert">
    		<i class="icon-exclamation-sign"></i><strong><?=$result[0]['fname']?> <?=$result[0]['lname']?> </strong> Not Paid Member
    	</div>   
     <?php } ?>
    
    
     
    
                    
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="Add" />
        <input type="hidden" name="active_member" value="Yes" />
        <input type="hidden" name="active_member_code" value="<?=$result[0]['usercode']?>" />
      <!------------------>
      
      <div class="control-group">
        <label class="control-label">Referral Name</label>
        <div class="controls">
          	<p style="padding:5px 0px;"><strong><?=$ref_member[0]['fname']?> <?=$ref_member[0]['lname']?>  (<?=$ref_member[0]['usercode']?>)</strong></p>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Referralid</label>
        <div class="controls">
          <select name="referralid" id="referralid">
          
          		<?php
                	for($i=0;$i<count($ref);$i++){
						$name=$ref[$i]['fname'].' '.$ref[$i]['lname'];
						echo'<option value="'.$ref[$i]['usercode'].'">'.$name.'  ('.$ref[$i]['usercode'].')</option>';
					}	
				?>	
          </select>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">First Name</label>
        <div class="controls">
          <input id="fname" name="fname" value="<?=$result[0]['fname']?>" class="span12" type="text" placeholder="First Name" readonly="readonly"/>
        </div>
      </div>
      <!------------------> 
      
      <!------------------>
      <div class="control-group">
        <label class="control-label">Last Name</label>
        <div class="controls">
          <input id="lname" name="lname" value="<?=$result[0]['lname']?>" class="span12" type="text" placeholder="Last Name" readonly="readonly"/>
        </div>
      </div>
      <!------------------> 
      
      <!------------------>
      <div class="control-group">
        <label class="control-label">Username</label>
        <div class="controls">
          <input id="username" name="username" value="<?=$result[0]['username']?>" class="span12" type="text" placeholder="Username" readonly="readonly"/>
        </div>
      </div>
      <!------------------> 
      
      <!------------------>
      <div class="control-group">
        <label class="control-label">User Email</label>
        <div class="controls">
          <input id="emailid" name="emailid" value="<?=$result[0]['emailid']?>" class="span12" type="email" placeholder="Email" readonly="readonly"/>
        </div>
      </div>
      <!------------------> 
      
      <!------------------>
      <div class="control-group">
        <label class="control-label">Mobile No</label>
        <div class="controls">
          <input id="mobileno" name="mobileno" value="<?=$result[0]['mobileno']?>" class="span12" type="text" placeholder="Mobile No" readonly="readonly"/>
        </div>
      </div>
      <!------------------>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">
        <?=$btn?>
        </button>
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>
