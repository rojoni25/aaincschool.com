<?php 
$max=(float)$amount[2] - 63; 

?>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(document).on('submit', '#form2', function (e) {
		var con=confirm("Are You Sure Withdrawal Amount");
		if(!con){
			return false;
		}
	});		
</script>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Withdrawal Request
          	<a href="<?=base_url()?>index.php/withdrawal_request" class="pull-right"><span class="label label-important">Back</span></a>
          </h3>
        </div>
       <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Withdrawal Request</li>
    </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span6">
      <?php if($dt['max_withdrawal'] > 0) {?>
       
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(3)?>" />
          <div class="control-group">
            <label class="control-label">Withdrawal Amount</label>
            <div class="controls">
              <input  value="<?=$result[0]['amount']?>" class="span12" type="text" placeholder="Amount" readonly="readonly" />
            </div>
          </div>
          <!------------------>
          <?php
          	$newDate = date("d-m-Y", strtotime($result[0]['timedt']));
		  ?>
           <div class="control-group">
            <label class="control-label">Send Request Date</label>
            <div class="controls">
              <input  value="<?=$newDate?>" class="span12 {validate:{required:true}}" type="text" placeholder="Amount" readonly="readonly"/>
            </div>
          </div>
          <!------------------>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Withdrawal  Done</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
        <?php } ?>
      </div>
     
        <div class="span6">
        	<table class="table">
            	<tr>
                	<td width="35%">Usercode</td>
                    <td width="1%">:</td>
                    <td width="64%"><?=$result[0]['usercode']?></td>
                </tr>
                <tr>
                	<td>Username</td>
                    <td>:</td>
                    <td><?=$result[0]['username']?></td>
                </tr>
                <tr>
                	<td>Member Name</td>
                    <td>:</td>
                    <td><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
                </tr>
                <tr>
                	<td>Conatct No</td>
                    <td>:</td>
                    <td><?=$result[0]['mobileno']?> / <?=$result[0]['phone_no']?></td>
                </tr>
                <tr>
                	<td>Total Amount</td>
                    <td>:</td>
                    <td>$<?=$dt['total_balance']+$dt['tot_withdrawal']?></td>
                </tr>
                
                <tr>
                	<td>Total Withdrawal</td>
                    <td>:</td>
                    <td><a href="<?=base_url()?>index.php/payment_report_paid/withdrawal_detail/<?=$result[0]['username']?>">$<?=$dt['tot_withdrawal']?></a></td>
                </tr>
                
                <tr><td><strong>CW To PW transfer</strong></td><td>:</td><td><strong>$<?=$dt['cw_transfer']?></strong></td></tr>
        		<tr><td><strong>PW To CW transfer</strong></td><td>:</td><td><strong>$<?=$dt['pw_transfer']?></strong></td></tr>
        		<tr><td><strong>PW transfer (<?=($dt['cw_tot_transfer']<0) ? "Minus" : "Plus";?>)</strong></td><td>:</td><td><strong>$<?=$dt['cw_tot_transfer']?></strong></td></tr>
                
                <tr>
                	<td>Net Balance</td>
                    <td>:</td>
                    <td>$<?=$dt['total_balance']?></td>
                </tr>
                 <tr>
                	<td>Reserve Amount</td>
                    <td>:</td>
                    <td>$<?=CW_MIN?></td>
                </tr>
                
                <tr>
                	<td><strong>Max Withdrawal (After Withdrawal)</strong></td>
                    <td>:</td>
                    <td><strong>$<?=$dt['max_withdrawal']-$result[0]["amount"]?></strong></td>
                </tr>
            </table>
        </div>
    </div>

