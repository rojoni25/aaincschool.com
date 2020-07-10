<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=kdk_admin_menu();?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Balance Tranfer (Live Wallet)</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Request</li>
    </ul>
  </div>
</div>
<?php if($this->session->flashdata('show_msg')!=''){ ?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg')?>
  </strong> </div>
<?php } ?>
<br />
<div class="row-fluid ">
  <div class="span6">
    <?php if($payment['rm_balance']){?>
    <form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/tranfer_amount" method="post" id="frm_tranfer">
    	<input type="hidden" name="usercode" value="<?=$result[0]['usercode']?>" />
      <table class="table table-striped table-bordered dataTable" id="data-table">
        <tr>
          <td>Enter Tranfer Amount <span class="req">*</span></td>
          <td>:</td>
          <td><input type="number" required="required" name="amount" id="amount" placeholder="Enter Tranfer Amount" /></td>
        </tr>
        
         <tr>
          <td>Add Note <span class="req">*</span></td>
          <td>:</td>
          <td><textarea name="msg" id="msg" placeholder="Add Note"></textarea></td>
        </tr>
        
        
        
        <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-success"><strong>Transfer Amount</strong></button></td>
        </tr>
      </table>
    </form>
    <?php } else {?>
    <p class="show_msg">Pending wallet have no balance</p>
    <?php } ?>
  </div>
  <div class="span6">
    <table class="table table-striped table-bordered dataTable" id="data-table">
      <tr>
        <td width="24%">Usercode</td>
        <td width="1%">:</td>
        <td width="75%"><?=$result[0]['usercode']?></td>
      </tr>
      <tr>
        <td>Name</td>
        <td>:</td>
        <td><?=$result[0]['name']?></td>
      </tr>
      <tr>
        <td>Pending Wallet</td>
        <td>:</td>
        <td><span class="cls_amount">$
          <?=number_format($payment['rm_balance'],2)?>
          </span></td>
      </tr>
      <tr>
        <td>Live Wallet</td>
        <td>:</td>
        <td><span class="cls_amount">$
          <?=number_format($payment['live_balance'],2)?>
          </span></td>
      </tr>
    </table>
  </div>
</div>
<br />

<div class="row-fluid ">
  <div class="span12">
    <table class="table table-striped table-bordered dataTable" id="data-table">
      <thead>
        <tr>
          <th width="10%">Id</th>
          <th width="15%">Date</th>
          <th width="15%">Amount</th>
          <th width="40%">Note</th>
         
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($list);$i++){
				$row=$i+1;
			?>
        <tr>
          <td><?=$row?></td>
          <td><?=date('M d, Y  i:j',$list[$i]['timedt'])?></td>
          <td><?=number_format($list[$i]['amount'],2)?></td>
          <td><?=$list[$i]['msg']?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
		font-size:15px;
	}
	.req{
		color:#F00;
	}
	.cls_amount{
		font-weight:bold;
	}
	#msg{
		width:90%;
		height:100px;
		resize:none;
	}
</style>
