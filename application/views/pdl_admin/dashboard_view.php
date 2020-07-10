
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PDL Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=base_url()?>index.php/pdl/member_tree/member_view" class="brown"><p><?=$tot_member?></p><span>Member</span></a></li>
        <li><a href="<?=base_url()?>index.php/pdl/member_tree/member_view" class="blue"><p>$<?=$payment?></p><span>Income</span></a></li>
        <li><a href="<?=base_url()?>index.php/pdl/member_tree/subscription_under_review" class="blue-violate"><p><?=$under_review?></p><span>Under Review</span></a></li>
        <li><a href="<?=base_url()?>index.php/pdl/withdrawal_request/view" class="magenta"><p><?=$withdrawal_request?></p><span>Withdrawal Request</span></a></li>
      </ul>
    </div>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
		<li><a href="<?=base_url()?>index.php/pdl/pdl_reports/active_level_pay" class="dark-yellow"><i class="icon-book"></i><span>Active Level Pay</span></a></li>
        <li><a href="<?=base_url()?>index.php/pdl/pdl_reports/member_status/active" class="cls-color-5"><i class="icon-book"></i><span>Active Member Report</span></a></li>
        <li><a href="<?=base_url()?>index.php/pdl/pdl_reports/member_status/due" class="cls-color-4"><i class="icon-bar-chart"></i><span>Due Member Report</span></a></li>
        <li><a href="<?=base_url()?>index.php/pdl/pdl_reports/system_level" class="cls-color-7"><i class="icon-bar-chart"></i><span>System Level</span></a></li>
      </ul>
    </div>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
            <li><a href="<?=base_url()?>index.php/pdl/ad_message/inbox" class="cls-color-1"><p><?=$unread_message?></p><span>Message</span></a></li>
            <li><a href="<?=base_url()?>index.php/pdl/ad_report/payment" class="cls-color-2"><i class="icon-thumbs-up"></i><span>Payment Report </span></a></li>
            <li><a href="<?=base_url()?>index.php/pdl/ad_report/payment_flase" class="cls-color-3"><i class="icon-thumbs-down"></i><span>Payment False</span></a></li>
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