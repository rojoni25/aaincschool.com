<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>






<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">DFSM Admin Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">DFSM Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        
        <li><a href="<?=base_url()?>index.php/m2m/ad_join_request/view" class="blue"><p><?=$join_request?></p><span>Join Request</span></a></li>
        <li><a href="<?=base_url()?>index.php/m2m/ad_join_request/under_process" class="brown"><p><?=$under_process?></p><span>Under Process</span></a></li>
        <li><a href="<?=base_url()?>index.php/m2m/ad_member/member_list" class="blue-violate"><p><?=$m2m_member?></p><span>Member List</span></a></li>
        <li><a href="<?=base_url()?>index.php/m2m/ad_cms/view/" class=" magenta"><i class="icon-file-alt"></i><span> CMS Page</span></a></li>
        <!----------------------------dfsm------------------------>
        <li><a href="<?=base_url()?>index.php/m2m/capture_master/view/"  class="blue"><i class="icon-file-alt"></i><span> Add Capture Page</span></a></li>
        <!----------------------------dfsm------------------------>
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
