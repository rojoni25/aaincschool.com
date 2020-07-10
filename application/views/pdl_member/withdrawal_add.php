<script>
	var pdl_1=<?=$this->pdl_member_class->get_value('max_withdrawal_1')?>;
	
	var pdl_2=<?=$this->pdl_member_class->get_value('max_withdrawal_2')?>;
	
	var pdl_3=<?=$this->pdl_member_class->get_value('max_withdrawal_3')?>;
	
	$(document).on('submit', '#form2', function (e) {
		var amount=$('#amount').val();
		var wallet_type=$('#wallet_type').val();
		amount=parseFloat(amount);
		if(wallet_type=='pdl_1'){
			if(amount > pdl_1){
				alert('Invalid Amount');
				$('#amount').focus();
				return false;
			}	
		}
		
		
		
		if(wallet_type=='pdl_2'){
			if(amount > pdl_2){
				alert('Invalid Amount');
				$('#amount').focus();
				return false;
			}	
		}
		
		if(wallet_type=='opp_wallet'){
			if(amount > pdl_3){
				alert('Invalid Amount');
				$('#amount').focus();
				return false;
			}	
		}
		
		
		
	});		
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
<div class="marquee_div"> <span class="spm_llb">Just Joined</span>
  <marquee>
  <h3 class="maq_h3">
    <?=$this->session->userdata["ref"]["currect_add"]?>
  </h3>
  </marquee>
</div>
<?php } ?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"> PDL Withdrawal 
      	<a href="<?=base_url()?>index.php/pdl/pdl_member_home/view" class="pull-right"><span class="label label-success llb-back">Dashboard</span></a>
      </h3>
    </div>
  </div>
</div>
<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg')?>
  </strong> </div>
<?php } ?>
<div class="row-fluid">
  <div class="span4">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td colspan="3"><span style="color:#333;font-weight:bold;">PDL Wallet-1</span></td>
      </tr>
      <tr>
        <td width="29%">Wallet</td>
        <td width="1%">:</td>
        <td width="70%">$
          <?=number_format($this->pdl_member_class->get_value('payment_1'),2)?></td>
      </tr>
      <tr>
        <td>Withdrawal</td>
        <td>:</td>
        <td>$
          <?=number_format($this->pdl_member_class->get_value('withdrawal_1'),2)?></td>
      </tr>
      <tr>
        <td>balance</td>
        <td>:</td>
        <td>$
          <?=number_format($this->pdl_member_class->get_value('balance_1'),2)?></td>
      </tr>
      <tr>
        <td>Max Withdrawal</td>
        <td>:</td>
        <td><strong>$
          <?=number_format($this->pdl_member_class->get_value('max_withdrawal_1'),2)?>
          </strong></td>
      </tr>
      <?php if(isset($wallet1_pending[0])) {?>
      <tr>
        <td colspan="3"><span class="msg">One Withdrawal Request Already Pending</span></td>
      </tr>
      <tr>
        <td colspan="3"><table class="table">
            <tr>
              <th>Date</th>
              <th>Amount</th>
              <th>Delete</th>
            </tr>
            <tr>
              <td><?=date('d-m-Y',$wallet1_pending[0]['time_dt']);?></td>
              <td><strong>
                <?=number_format($wallet1_pending[0]['amount'],2)?>
                </strong></td>
              <td><a href="<?=base_url()?>index.php/pdl/pdl_member/request_delete/<?=$wallet1_pending[0]['request_code']?>" class="icon-delete"><i class="icon-">&#xf00d;</i></a></td>
            </tr>
          </table></td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <div class="span4">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td colspan="3"><span style="color:#333;font-weight:bold;">PDL Wallet-2</span></td>
      </tr>
      <tr>
        <td width="29%">Wallet</td>
        <td width="1%">:</td>
        <td width="70%">$
          <?=number_format($this->pdl_member_class->get_value('payment_2'),2)?></td>
      </tr>
      <tr>
        <td>Withdrawal</td>
        <td>:</td>
        <td>$
          <?=number_format($this->pdl_member_class->get_value('withdrawal_2'),2)?></td>
      </tr>
      <tr>
        <td>balance</td>
        <td>:</td>
        <td>$
          <?=number_format($this->pdl_member_class->get_value('balance_2'),2)?></td>
      </tr>
      <tr>
        <td>Max Withdrawal</td>
        <td>:</td>
        <td><strong>$
          <?=number_format($this->pdl_member_class->get_value('max_withdrawal_2'),2)?>
          </strong></td>
      </tr>
      <?php if(isset($wallet2_pending[0])) {?>
      <tr>
        <td colspan="3"><span class="msg">One Withdrawal Request Already Pending</span></td>
      </tr>
      <tr>
        <td colspan="3"><table class="table">
            <tr>
              <th>Date</th>
              <th>Amount</th>
              <th>Delete</th>
            </tr>
            <tr>
              <td><?=date('d-m-Y',$wallet2_pending[0]['time_dt']);?></td>
              <td><strong>
                <?=number_format($wallet2_pending[0]['amount'],2)?>
                </strong></td>
              <td><a href="<?=base_url()?>index.php/pdl/pdl_member/request_delete/<?=$wallet2_pending[0]['request_code']?>" class="icon-delete"><i class="icon-">&#xf00d;</i></a></td>
            </tr>
          </table></td>
      </tr>
      <?php } ?>
    </table>
  </div>
  
   <div class="span4">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td colspan="3"><span style="color:#333;font-weight:bold;">Referral Wallet</span></td>
      </tr>
      <tr>
        <td width="29%">Wallet</td>
        <td width="1%">:</td>
        <td width="70%">$<?=number_format($this->pdl_member_class->get_value('payment_3'),2)?></td>
      </tr>
      <tr>
        <td>Withdrawal</td>
        <td>:</td>
        <td>$<?=number_format($this->pdl_member_class->get_value('withdrawal_3'),2)?></td>
      </tr>
      <tr>
        <td>balance</td>
        <td>:</td>
        <td>$<?=number_format($this->pdl_member_class->get_value('balance_3'),2)?></td>
      </tr>
      <tr>
        <td>Max Withdrawal</td>
        <td>:</td>
        <td><strong>$<?=number_format($this->pdl_member_class->get_value('max_withdrawal_3'),2)?></strong></td>
      </tr>
      <?php if(isset($wallet3_pending[0])) {?>
      <tr>
        <td colspan="3"><span class="msg">One Withdrawal Request Already Pending</span></td>
      </tr>
      <tr>
        <td colspan="3"><table class="table">
            <tr>
              <th>Date</th>
              <th>Amount</th>
              <th>Delete</th>
            </tr>
            <tr>
              <td><?=date('d-m-Y',$wallet3_pending[0]['time_dt']);?></td>
              <td><strong>
                <?=number_format($wallet3_pending[0]['amount'],2)?>
                </strong></td>
              <td><a href="<?=base_url()?>index.php/pdl/pdl_member/request_delete/<?=$wallet3_pending[0]['request_code']?>" class="icon-delete"><i class="icon-">&#xf00d;</i></a></td>
            </tr>
          </table></td>
      </tr>
      <?php } ?>
    </table>
  </div>
  
</div>
<?php if(!isset($wallet1_pending[0]) || !isset($wallet2_pending[0]) || !isset($wallet3_pending[0])) {?>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/pdl/pdl_member/withdrawal_insertrecord" enctype="multipart/form-data">
      <table class="table  table-bordered">
        <tr>
          <td colspan="3"><span style="color:#333;font-weight:bold;">Withdrawal</span></td>
        </tr>
        <tr>
          <td width="19%">Select Wallect</td>
          <td width="1%">:</td>
          <td width="80%"><select name="wallet_type" id="wallet_type" required="required" >
                            <option value="">Select</option>
                            <?php if(!isset($wallet1_pending[0])) {?><option value="pdl_1">Wallet-1</option><?php } ?>
                            <?php if(!isset($wallet2_pending[0])) {?><option value="pdl_2">Wallet-2</option><?php } ?>
                            <?php if(!isset($wallet3_pending[0])) {?><option value="opp_wallet">Referral Wallet</option><?php } ?>
            			</select>
         </td>
        </tr>
        <tr>
          <td>Amount</td>
          <td>:</td>
          <td><input type="number" name="amount" id="amount" placeholder="$0.00"v required="required" /></td>
        </tr>
        <tr>
          <td>Payment Option</td>
          <td>:</td>
          <td><textarea id="textdt" name="textdt" placeholder="Comment"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-primary btnsubmit">Request Request</button><a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php } ?>
<div class="row-fluid">
  <h3 class="page-header">Withdrawal List</h3>
  <table class="table table-striped tbl-simple table-bordered">
    <thead>
      <tr>
        <th>Sr. No</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Wallet</th>
        <th>Message</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php for($i=0;$i<count($withdrawal_list);$i++){
				$sr=$i+1;
				$wallet=($withdrawal_list[$i]['wallet_type']=='pdl_1') ? "Wallet-1" : "Wallet-2";	
				if($withdrawal_list[$i]['wallet_type']=='pdl_1'){
					$wallet='Wallet-1';
				}
				elseif($withdrawal_list[$i]['wallet_type']=='pdl_2'){
					$wallet='Wallet-2';
				}
				elseif($withdrawal_list[$i]['wallet_type']=='opp_wallet'){
					$wallet='Referral Wallet';
				}
				
							
				echo '<tr>
					<th>'.$sr.'</th>
					<th>'.date('d-m-Y',$withdrawal_list[$i]['timedt']).'</th>
					<th>$'.number_format($withdrawal_list[$i]['amount'],2).'</th>
					<th>'.$wallet.'</th>
					<th>'.$withdrawal_list[$i]['textdt'].'</th>
					<th>'.$withdrawal_list[$i]['msg'].'</th>
				</tr>';
     	} ?>
    </tbody>
  </table>
</div>
<style>
	#textdt{
		width:90%;
		resize:none;
	}
	.msg{
		font-weight:bold;
		color:#F00;
	}
	.icon-delete, .icon-delete:hover{
		color:#666;
		font-size:16px;
		text-decoration:none;
	}
	.llb-back{
		letter-spacing:1px;
	}
</style>
