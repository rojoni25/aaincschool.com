<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=kdk_admin_menu();?>

<?php if($this->session->flashdata('show_msg')!='') {?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div> 
<?php } ?>  

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">R-Matrix Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=base_url()?>index.php/r_matrix_member/view" class="brown"><p><?=$tot_member?></p><span>Member</span></a></li>
        <li><a href="<?=base_url()?>index.php/r_matrix/request" class="blue"><p><?=$tot_request?></p><span>Join Request</span></a></li>
        <li><a href="<?=base_url()?>index.php/r_matrix_tree/view/1" class=" blue-violate"><i class="icon-group"></i><span>Tree View</span></a></li>
        <li><a href="<?=base_url()?>index.php/r_matrix/kdk_code" class=" magenta"><i class="icon-bar-chart"></i><span>KDK Code</span></a></li>
        
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=base_url()?>index.php/r_matrix_upgrade_pay/pif_send_report" class="cls-color-3"><p><?=$send_pif?></p><span>Send PIF</span></a></li>
        <li><a href="<?=base_url()?>index.php/r_matrix_upgrade_pay/pif_remaining" class="cls-color-4"><p><?=$remaining_pif?></p><span>Remaining PIF</span></a></li>
        <li><a href="<?=base_url()?>index.php/r_matrix/request_extra" class="cls-color-6"><p><?=$tot_extra_position?></p><span>Ex. Position Request</span></a></li>
       <li><a href="<?=base_url()?>index.php/r_matrix/kdk_pif" class="cls-color-7"><p><?=$kdk_pif_request?></p><span>KDK PIF Request</span></a></li>
      
       
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
       	 <li><a href="<?=base_url()?>index.php/r_matrix_report/friend_pif" class="blue-violate"><i class="icon-file-alt"></i><span>KDK PIF Report</span></a></li>
         <li><a href="<?=base_url()?>index.php/r_matrix_kdk_request/request" class="green"><p><?=$tot_kdk_code_request?></p><span>KDK Code Request</span></a></li>
        <li><a href="<?=base_url()?>index.php/r_matrix_kdk_request/unuse" class="dark-yellow"><p><?=$unuse_kdk?></p><span>Unuse KDK Code</span></a></li>
       <li><a href="<?=base_url()?>index.php/r_matrix_withdrawal/request" class="brown"><p><?=$tot_pending_withdrawal?></p><span>Withdrawal Request</span></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
       	 <li><a href="<?=base_url()?>index.php/r_matrix_message/inbox" class="cls-color-5"><p><?=$tot_msg?></p><span>Message</span></a></li>
         <li><a href="<?=base_url()?>index.php/r_matrix_member/cycle_report" class=" magenta"><i class="icon-bar-chart"></i><span>Cycle Report</span></a></li>
         <li><a href="<?=base_url()?>index.php/r_matrix_cms/view" class="blue"><i class="icon-book"></i><span>CMS</span></a></li>
          <li><a href="<?=base_url()?>index.php/r_matrix_kdk_request/pending" class="cls-color-7"><i class="icon-book"></i><span>Pending Join Request</span></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
          <li><a href="<?=base_url()?>index.php/r_matrix_member/mannual_payment" class="cls-color-1"><i class="icon-book"></i><span>Cycle Mannual Payment</span></a></li>
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
