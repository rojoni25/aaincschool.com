<?php
	$show_frm=true;
	if($payment['coin_balance']< 1 ){
		$show_frm=false;
		$notish_msg='No Balance';
	}

	if(isset($pending_request[0])){
		$show_frm=false;
		$notish_msg='Your One Withdrawal Request Is Already Pending';
	}
?>
<script>
	$(document).on('submit','#send_request',function(e){
		if($('#amount').val()==''){
			$('#amount').focus();
			return false;
		}
		if(isNaN($('#amount').val())){
			alert('Enter Vailed Number');
			$('#amount').val('');
			$('#amount').focus();
			return false;
		}
		
		if(parseInt($('#amount').val())<0){
			alert('Enter Vailed Amount');
			$('#amount').val('');
			$('#amount').focus();
			return false;
		}
		
		if(parseInt($('#amount').val()) > parseInt($('#grand_balance').val())){
			alert('enter amount is greater than wallet');
			$('#amount').val('');
			$('#amount').focus();
			return false;
		}
		
		
	});
</script>
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
	
    <?php $show_msg=$this->session->flashdata('show_msg'); ?>
	
    <?php if(is_array($show_msg)){ ?>
   		 <div class="<?=$show_msg['class']?>">
    		<button type="button" class="close" data-dismiss="alert">&times;</button>
    		<i class="<?=$show_msg['sign']?>"></i><strong><?=$show_msg['text']?></strong>
    	</div> 
    <?php } ?>
  

<div class="row-fluid">
  <div class="span6">
    <h3 class="page-header">Withdrawal Amount</h3>
    <?php if($show_frm){ ?>
    		<form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/insert_request" method="POST" id="send_request">
    	<input type="hidden" id="grand_balance" value="<?=$payment['coin_balance']?>" />
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th  width="24%">Balance</th>
            <th width="1%">:</th>
            <th width="75%"><font style="font-weight:bold;color:#F00;">$
              <?=number_format($payment['coin_balance'],2)?>
              </font></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Amount</td>
            <td>:</td>
            <td><input type="text" name="amount" id="amount" placeholder="Enter Your Amount " class="span12" /></td>
          </tr>
          <tr>
            <td valign="top">GCR Coin Address</td>
            <td>:</td>
            <td><textarea id="txtmsg" name="txtmsg" placeholder="GCR Coin Address" class="span12 txt_area"></textarea></td>
          </tr>
          
          <tr>
            <td></td>
            <td></td>
            <td><button type="submit" class="btn btn-success btnsubmit"><strong>Send Withdrawal Request</strong></button></td>
          </tr>

          
        </tbody>
      </table>
    </form>
    <?php } else {?>
    	<h5 style="">Currect Balance : <font style="color:#C32222;"><?=number_format($payment['coin_balance'],2)?></font></h5>
    	<h5 style="color:#A23838;"><?=$notish_msg?></h5>
    <?php } ?>
    
  </div>
  <div class="span6">
    <h3 class="page-header">Pending Request <a href="<?=base_url()?>index.php/rm_martix/dashboard/" class="pull-right"><span class="label label-success"><font style="font-weight:bold;letter-spacing:1px;">Dashboard</font></span></a></h3>
    
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
        <?php 
			for($i=0;$i<count($pending_request);$i++){
				$no=$i+1;
				echo '<tr>
							<th>'.$no.'</th>
							<th>'.$pending_request[$i]['amount'].'</th>
							<th>'.date('d-m-Y h:i a',$pending_request[$i]['time_dt']).'</th>
        			</tr>';
			}
		 ?>
      </thead>
    </table>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Withdrawal Record</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <thead>
        <?php for($i=0;$i<count($withdrawal_record);$i++){
					$id=$i+1;
					echo '<tr>
          					<th>'.$id.'</th>
          					<th>'.number_format($withdrawal_record[$i]['amount'],2).'</th>
          					<th>'.date('d-m-Y',$withdrawal_record[$i]['timedt']).'</th>
          					<th>'.$withdrawal_record[$i]['textdt'].'</th>
        				</tr>';
				}?>
      </thead>
      <tfoot>
        <tr>
          <th style="text-align:right;">Total</th>
          <th>$
            <?=number_format($payment['coin_withdrawal'],2)?></th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<style>
	.tot_m_14{
		background-color:#80cbc4 !important;	
	}
	.incomplete{
		background-color:#ffecb3;
	}
	.con_td_1_2{
		background-color:#80cbc4 !important;	
	}
	.con_td_2_4{
		background-color:#80cbc4 !important;	
	}
	.con_td_3_8{
		background-color:#80cbc4 !important;	
	}
	.txt_area{
		resize:none;
	}
</style>
