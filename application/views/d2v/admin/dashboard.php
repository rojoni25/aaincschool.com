<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>






<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">D2V Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Direct 2 Voice</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
            <li><a href="<?=base_url()?>index.php/d2v/ad_member/request/" class="blue"><p><?=$count_request?></p><span>Join Request</span></a></li>
            <li><a href="<?=base_url()?>index.php/d2v/ad_member/member_list/" class="brown"><p><?=$count_member?></p><span>Member List</span></a></li>
            <li><a href="<?=base_url()?>index.php/d2v/ad_cms/view/" class=" magenta"><i class="icon-file-alt"></i><span> CMS Page</span></a></li>
            <li><a href="<?=base_url()?>index.php/d2v/ad_msg/" class=" blue-violate"><p><?=$count_msg?></p><span>Message</span></a></li>
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
