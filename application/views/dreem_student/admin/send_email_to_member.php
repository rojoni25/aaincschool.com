
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Dreem Student Email <span class="pull-right"><a href="<?=base_url()?>index.php/dreem_student/ad_dashboard/">
        <button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
        </a></span> </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Send Email</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span6">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/dreem_student/<?=$this->uri->rsegment(1)?>/send_to_member" enctype="multipart/form-data">
      <input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['usercode']?>" />
      <input type="hidden" name="ref_url" id="ref_url" 	 value="<?=$ref_url?>" />
      
      <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
          <input id="subject" name="subject" value="" type="text" class="span12" placeholder="Subject" required="required"/>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Message</label>
        <div class="controls">
          <textarea id="msg" name="msg" class="span12" placeholder="Enter Message Hear" required="required"></textarea>
        </div>
      </div>
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">Send</button>
      </div>
    </form>
  </div>
  <div class="span6">
  		<table class="table table-striped table-bordered">
        	<tr>
            	<td width="19%">Member Name</td>
                <td width="1%"></td>
                <td width="80%"><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
            </tr>
            <tr>
            	<td>Usercode</td>
                <td>:</td>
                <td><?=$result[0]['usercode']?></td>
            </tr>
            <tr>
            	<td>Username</td>
                <td>:</td>
                <td><?=$result[0]['username']?></td>
            </tr>
            <tr>
            	<td>Email Id</td>
               <td>:</td>
                <td><?=$result[0]['emailid']?></td>
            </tr>
            <?php
            	$email=($result[0]['email_verification']=='Y') ? "Yes" : "No";
			?>
            <tr>
            	<td>Email Varify</td>
                <td>:</td>
                <td><?=$email?></td>
            </tr>
        </table>
  </div>
</div>
