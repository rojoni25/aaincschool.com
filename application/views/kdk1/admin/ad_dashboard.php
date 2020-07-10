<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=MATRIX_LLB?>
        Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">
        <?=MATRIX_LLB?>
        </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=MATRIX_BASE?>ad_member/member_view" class="brown"><p><?=$tot_member?></p><span>Member</span></a></li>
         <li><a href="<?=MATRIX_BASE?>ad_member/member_view" class="cls-color-8"><p><?=$total_position?></p><span>Total Position</span></a></li>
        <li><a href="<?=MATRIX_BASE?>ad_member/join_request" class="blue"><p><?=$join_request?></p><span>Join Request</span></a></li>
        <li><a href="<?=MATRIX_BASE?>ad_member/request_extra" class="cls-color-6"><p><?=$extra_position?></p><span>Ex. Postion Request</span></a></li>
       
      </ul>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
        <ul class="clearfix switch-item switch_item_custom">
            <li><a href="<?=MATRIX_BASE?>ad_withdrawal/view/" class="cls-color-7"><p><?=$withdrawal_request?></p><span>Withdrawal Request</span></a></li> 	
            <li><a href="<?=MATRIX_BASE?>ad_request/request/" class="blue-violate"><p><?=$code_request?></p><span>Code Request</span></a></li> 	
            <li><a href="<?=MATRIX_BASE?>ad_member/access_code/" class=" magenta"><i class="icon-bar-chart"></i><span>Access Code</span></a></li>
            <li><a href="<?=MATRIX_BASE?>ad_product/view" class="cls-color-1"><i class="icon-file-alt"></i><span>Product</span></a></li>        
        </ul>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
        <ul class="clearfix switch-item switch_item_custom">
            <li><a href="<?=MATRIX_BASE?>ad_message/inbox" class="cls-color-3"><p><?=$count_msg?></p><span>Message</span></a></li>
            <li><a href="<?=MATRIX_BASE?>ad_account/transaction_report/credit" class="dark-yellow"><i class="icon-money"></i><span>Credit Report</span></a></li>
            <li><a href="<?=MATRIX_BASE?>ad_account/transaction_report/debit" class="brown"><i class="icon-money"></i><span>Debit Report</span></a></li>
            <li><a href="<?=MATRIX_BASE?>ad_account/payment" class="cls-color-8"><i class="icon-money"></i><span>Payment Report</span></a></li>
        </ul>
    </div>
  </div>
</div>
<style>
	.switch_item_custom li{
		width:180px;
		height:100px;
	}
	.switch_item_custom li a{
		width:180px;
		height:100px;
	}
	.switch_item_custom li p{
		font-size:20px !important;
		font-weight:bold;
		padding-top:20px;
		color:#FFF;
	}
	.switch_item_custom li a span {
		font-weight:bold;
		font-size:14px !important;
	}
	
	
</style>
