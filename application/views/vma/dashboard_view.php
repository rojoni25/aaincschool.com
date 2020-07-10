
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=$this->load->view('vma/top_banner')?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Dashboard (VMS)</h3>
    </div>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=vma_base()?>tree/view/" class="orange"><i class="icon-group"></i><span>Tree View</span></a></li>
        <li><a href="#" class=" blue-violate"><p>$<?=$payment['balance']?></p><span>Balance</span></a></li>
        <li><a href="<?=vma_base()?>financial_report/view" class="dark-yellow"><i class="icon-share-alt"></i><span>Financial Report</span></a></li>
        <li><a href="<?=vma_base()?>dashboard/business_info" class="green"><i class="icon-th-large"></i><span>Business Info </span></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
       	<li><a href="<?=vma_base()?>unilevel/" class="cls-color-6"><i class="icon-th-large"></i><span>Unilevel</span></a></li>
        <li><a href="<?=vma_base()?>withdrawal/add" class="green"><i class="icon-suitcase"></i><span>Withdrawal</span></a></li>
      </ul>
    </div>
  </div>
</div>


<style>
	.switch_item_custom li{
		width:150px;
		height:100px;
	}
	.switch_item_custom li a{
		width:150px;
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
