<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>






<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Dreem Student Admin Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        
        <li><a href="<?=base_url()?>index.php/dreem_student/ad_join_request/view" class="blue"><p><?=$join_request?></p><span>Join Request</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/ad_join_request/under_process" class="brown"><p><?=$under_process?></p><span>Under Process</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/ad_member/member_list" class=" blue-violate"><p><?=$count_member?></p><span>Member List</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/ad_cms/view/" class=" magenta"><i class="icon-file-alt"></i><span> CMS Page</span></a></li>
        
      </ul>
    </div>
  </div>
</div>



<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        
        <li><a href="<?=base_url()?>index.php/dreem_student/ad_email/send_all/" class="green"><i class="icon-share-alt"></i><span>Send Email To Add </span></a></li>
       
        
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
