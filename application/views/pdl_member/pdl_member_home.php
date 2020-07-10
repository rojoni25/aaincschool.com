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
      <h3 class="page-header"> PDL Member dashboard </h3>
    </div>
  </div>
</div>


<div class="row-fluid">
  <div class="span3">
    <div class="board-widgets green">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"> PDL Wallet-1 </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter">$
        <?=number_format($this->pdl_member_class->get_value('payment_1'),2)?>
        </span><span class="n-sources">PDL Wallet-1</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Matrix Level 1 & 2 payment <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets blue-violate">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left">PDL Wallet-2 </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter">$
        <?=number_format($this->pdl_member_class->get_value('payment_2'),2)?>
        </span><span class="n-sources">PDL Wallet-2</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Matrix Level 3 Payment<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets dark-yellow">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-user"></i> Referral Wallet </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter">$
        <?=number_format($this->pdl_member_class->get_value('payment_3'),2)?>
        </span><span class="n-sources">Ref. Wallet</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Referral Wallet<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets magenta">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left">Tree View </h4>
      </div>
      <div class="board-widgets-content" style="padding: 20px 20px 0px 10px;"> <span class="n-counter"><i class="icon-group"></i></span><span class="n-sources">Tree View</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/pdl/pdl_downline_tree/view">Go to User<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span3">
    <div class="board-widgets green">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"> Withdrawal </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><i class="icon-book"></i>
        </span><span class="n-sources">Withdrawal</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/pdl/pdl_member/withdrawal">Withdrawal<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets brown">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left">PDL License Tools</h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><i class="icon-book"></i>
        </span><span class="n-sources">PDL License Tools</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/pdl/pdl_member/product">PDL License Tools<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  
  
   <div class="span3">
    <div class="board-widgets  bondi-blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left">Massege</h4>
      </div>
      <div class="board-widgets-content"> 
            <a href="<?=base_url()?>index.php/pdl/member_message/inbox">
	            <span class="n-counter"><?=$unread_message?>
    	        </span><span class="n-sources">Unread Message</span> 
            </a>       
        </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/pdl/member_message/compose">Send Message To Admin<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  
</div>




<style>
	<style>
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	.txtdiv{
		width:95%;
		position:relative;
		margin:auto;
	}
</style>
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
