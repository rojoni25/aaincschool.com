<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>


<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>



<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=MATRIX_BASE?>r_matrix_member/view" class="brown"><p><?=$tot_member?></p><span>Member</span></a></li>
        <li><a href="<?=MATRIX_BASE?>r_matrix/request" class="blue"><p><?=$tot_request?></p><span>Join Request</span></a></li>
        <li><a href="<?=MATRIX_BASE?>r_matrix_tree/view/1" class=" blue-violate"><i class="icon-group"></i><span>Tree View</span></a></li>
        <li><a href="<?=MATRIX_BASE?>r_matrix/access_code" class=" magenta"><i class="icon-bar-chart"></i><span> Code</span></a></li>
        
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=MATRIX_BASE?>r_matrix_upgrade_pay/pif_send_report" class="cls-color-3"><p><?=$send_pif?></p><span>Send PIF</span></a></li>
        <li><a href="<?=MATRIX_BASE?>r_matrix_upgrade_pay/pif_remaining" class="cls-color-4"><p><?=$remaining_pif?></p><span>Remaining PIF</span></a></li>
        <li><a href="<?=MATRIX_BASE?>r_matrix/request_extra" class="cls-color-6"><p><?=$tot_extra_position?></p><span>Ex. Position Request</span></a></li>
       <li><a href="<?=MATRIX_BASE?>r_matrix/pif" class="cls-color-7"><p><?=$pif_request?></p><span> PIF Request</span></a></li>
      
       
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
       	 <li><a href="<?=MATRIX_BASE?>r_matrix_report/friend_pif" class="blue-violate"><i class="icon-file-alt"></i><span> PIF Report</span></a></li>
         <li><a href="<?=MATRIX_BASE?>r_matrix_request/request" class="green"><p><?=$tot_access_code_request?></p><span> Code Request</span></a></li>
        <li><a href="<?=MATRIX_BASE?>r_matrix_request/unuse" class="dark-yellow"><p><?=$unuse?></p><span>Unuse  Code</span></a></li>
       <li><a href="<?=MATRIX_BASE?>r_matrix_withdrawal/request" class="brown"><p><?=$tot_pending_withdrawal?></p><span>Withdrawal Request</span></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
       	 <li><a href="<?=MATRIX_BASE?>r_matrix_message/inbox" class="cls-color-5"><p><?=$tot_msg?></p><span>Message</span></a></li>
         <li><a href="<?=MATRIX_BASE?>r_matrix_member/cycle_report" class=" magenta"><i class="icon-bar-chart"></i><span>Cycle Report</span></a></li>
         <li><a href="<?=MATRIX_BASE?>r_matrix_cms/view" class="blue"><i class="icon-book"></i><span>CMS</span></a></li>
          <li><a href="<?=MATRIX_BASE?>r_matrix_request/pending" class="cls-color-3"><i class="icon-book"></i><span>Pending Join Request</span></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
            <li><a href="<?=MATRIX_BASE?>r_matrix_withdrawal/report" class="cls-color-1"><i class="icon-file-alt"></i><span>Payout Report</span></a></li>
            <li><a href="<?=MATRIX_BASE?>r_matrix_company/view" class="cls-color-4"><i class="icon-folder-open"></i><span>Company Pages</span></a></li>
             <li><a href="<?=MATRIX_BASE?>r_cms/view" class="cls-color-7"><i class="icon-folder-open"></i><span>CMS Pages</span></a></li>
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
