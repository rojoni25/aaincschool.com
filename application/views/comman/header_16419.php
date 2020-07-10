<?php
	$arr_dashboard=array('welcome','network','capture_pages','cmspages','opportunity','tlc');
	$arr_master=array('country','user','view_friends','invite_history','coded_residual_details','network','change_password','change_username','change_email','request_to_renewal');
	$arr_messagemenu=array('email_outbox','email_send','email_inbox','opportunity','email_training');
	$arr_product=array('capture_pages','auto_pages','member_pages','join_friend','n_product','auto_responder_email','auto_responder_training','regbyembed');
	$arr_finance=array('withdrawal_request','financial_report','summary','refill_account','my_wallet','money_transfer','payment_confirm','diamond','online_payment_stripe','payment_confirm_report');
	if(in_array($this->uri->segment(1),$arr_dashboard)){
		$main_dashboard='active';
	}elseif (in_array($this->uri->segment(1),$arr_master)) {
		$main_master='active';
	}elseif (in_array($this->uri->segment(1),$arr_messagemenu)) {
		$main_messagemenu='active';
	}elseif (in_array($this->uri->segment(1),$arr_finance)) {
		$main_financemenu='active';
	}elseif (in_array($this->uri->segment(1),$arr_product)) {
		$main_productmenu='active';
	}
?>
<script>
	$(document).ready(function(e) {
		console.log("hiiii");
        var url='<?php echo base_url()?>index.php/comman_controler/get_top_banner/';
		/*$.ajax({url:url,success:function(result){
			console.log("top banner..");
			console.log(result);
			$('.top-banner').html(result);
		}});*/
		get_notifaction();
        setInterval(function(){ 
    			get_notifaction();
		}, 10000);
		
    });
	
	function get_notifaction()
	{
		var url='<?php echo base_url()?>index.php/comman_controler/update_login_user_time/';
		$.ajax({url:url,success:function(result){
			var json = $.parseJSON(result);
			$('.notification-cls').html(json['notif'])
		}});
	}	
</script>
<style>
	.dataTables_length select {
		display: block !important;
		padding: 0 !important;
	}
	.banner-inner{
		background-color:#5299b7;
		margin-bottom:10px;
	}
	.left_side{
		padding:8px;
		text-align:right;
		color:#FFF;
		
	}
	.banner-info {
		color:#FFF;
		font-size: 15px;
	}
	.title-top{
		padding:10px;
		margin:0px;
		color:#FFF;
		font-weight:bold;
	}
	.magin0{
		margin-bottom:0px;
	}
	.n_product_bg{
		background-image:url(<?php echo base_url()?>asset/images/ams.jpg);
	}
	.n_product_bg a:hover{
		background: none repeat scroll 0% 0% !important;
	}
	.viral_marketing{
		background-image:url(<?php echo base_url()?>asset/images/viral-marketing.jpg);
	}
	.social_video_traffic{
		background-image:url(<?php echo base_url()?>asset/images/staged.jpg);
	}
	.viral_marketing a:hover{
		background: none repeat scroll 0% 0% !important;
	}
	.social_video_traffic a:hover{
		background: none repeat scroll 0% 0% !important;
	}
	.metro-sidenav li a span {
   		font-weight: bold;
	}
	.metro-sidenav li a i {
    	padding: 4px 0px !important;
	}
	.cls-color-1{
		background-color:#CF4141 !important;
	}
	.cls-color-2{
		background-color:#4C0CB6 !important;
	}
	.cls-color-3{
		background-color:#69A246 !important;
	}
	.cls-color-4{
		background-color:#6F4795 !important;
	}
	.cls-color-5{
		background-color:#75B4B4 !important;
	}
	.cls-color-6{
		background-color:#8A560C !important;
	}
	.cls-color-7{
		background-color:#0D77ED !important;
	}
	.cls-color-8{
		background-color:#8C8364 !important;
	}
	.cls-color-9{
		background-color:#743A80 !important;
	}
	
	.cls-color-10{
		background-color:#10DE46 !important;
	}
	.cls-color-11{
		background-color:#F9FF08 !important;
		color:#333;
	}
	.cls-color-12{
		background-color:#328E95 !important;
		
	}  
	.cls-color-13{
		background-color:#FFE800 !important;
	}
	 
	.cls-color-13 span{
		color:#666 !important;
	}
	.mobile_payment_summary_btn{
		display:none;
	}
	@media only screen and (max-width: 767px){
		.hide_in_mobile{
			display:none;
		}
		marquee{
			white-space: nowrap;
		}
		.top-banner li{
			padding: 3px 1px !important;
			width: 49% !important;
			float: left !important;
			font-size: 12px !important;
			margin:0px !important;
		}
		
		.top-banner .btn {
    		padding: 3px 3px !important;
		}
		.dataTables_filter {
    		text-align: left;
		}
		.mobile_payment_summary_btn{
			display:block;
			float:right;
			margin:5px;
		}
		.top_amount_list{
			display:none;
		}
		.top-banner .left_side{
			text-align:left;
		}
		.page-header{
			font-size:17px !important;
		}
		.btn {
    		padding: 2px 12px;
  
		}
	}
</style>
<!--== BODY CONTNAINER ==-->
	<div class="container-fluid sb2">
		<div class="row">
			<div class="sb2-1">
				<!--== USER INFO ==-->
				<div class="sb2-12">
					<ul>
						<li><img src="<?=base_url()?>upload/user_thum/<?=$this->session->userdata['logged_ol_member']['user_img']?>" alt=""> </li>
						<li>
							<h5><?=$this->session->userdata['logged_ol_member']['fullname']?> <span> <a href="<?php echo base_url();?>index.php/profile">Edit Profile</a> </span></h5> 
							<i class="fa fa-sign-in" aria-hidden="true"></i> <a href="<?php echo base_url();?>index.php/login/logout"> Logout</a>
						</li>
					</ul>
				</div>
				<!--== LEFT MENU ==-->
				<div class="sb2-13">
					<ul class="collapsible" data-collapsible="accordion">
					<?php
		            if($this->session->userdata['logged_ol_member']['status']=='Active')
		            { 
			        ?>
						<li class="<?=$main_dashboard?>"><a href="javascript:void(0)" class="collapsible-header menu-active <?=$main_dashboard?>"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a> 
							<div class="collapsible-body left-sub-menu">
								<ul>
										<li><a href="<?=base_url()?>index.php/network"><i class="fa fa-user"></i>My Leads</a> </li>
										<li><a href="<?=base_url()?>index.php/capture_pages"><i class="fa fa-cogs"></i> Affiliworx Pages</a> </li>
										<li><a href="<?=base_url()?>index.php/cmspages/p/affiliate_page"><i class="fa fa-table"></i> Affiliworx Affiliate</a> </li>
										<li><a href="<?=base_url()?>index.php/cmspages/p/webinar_page"><i class="fa fa-tasks"></i> Webinars</a> </li>
										<li><a href="<?=base_url()?>index.php/opportunity/page/business"><i class="fa fa-file-text-o"></i>Your Opportunities</a> </li>
										<li><a href="<?=base_url()?>index.php/tlc/martix/dashboard/"><i class="fa fa-file-text-o"></i>Ad Multiplier</a> </li>
								</ul>
							</div>
						</li>
					<?
					}else{
					?>
						<li class="<?=$main_dashboard?>"><a href="<?=base_url()?>index.php/welcome" class="collapsible-header menu-active <?=$main_dashboard?>"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a> </li>
						<li class="<?=$main_master?>"><a href="javascript:void(0)" class="collapsible-header <?=$main_master?>"><i class="fa fa-th-large" aria-hidden="true"></i> Invite Friends</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?=base_url()?>index.php/view_friends/invite_friends_history"><i class="fa fa-th"></i>Invite Friends History  </a> </li>
									<li><a href="<?php echo base_url();?>index.php/view_friends"><i class="fa fa-th"></i> View  Leads</a> </li>
									
								</ul>
							</div>
						</li>
						<li class="<?=$sub_unilevel?>"><a href="<?php echo base_url();?>index.php/unilevel" class="collapsible-header menu-active <?=$sub_unilevel?>"><i class="fa fa-desktop" aria-hidden="true"></i> AAINC  Unilevel </a> </li>
					<?	
					}
					?>
	
					<?php
		            if($this->session->userdata['logged_ol_member']['status']=='Active')
		            { 
			        ?>
						<li class="<?=$main_master?>"><a href="javascript:void(0)" class="collapsible-header <?=$main_master?>"><i class="fa fa-th-large" aria-hidden="true"></i> Master</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url();?>index.php/view_friends"><i class="fa fa-th"></i> View Friend</a> </li>
									<li><a href="<?=base_url()?>index.php/view_friends/invite_friends_history"><i class="fa fa-th"></i>Invite Friends</a> </li>
									<li><a href="<?=base_url()?>index.php/network"><i class="fa fa-th"></i> Network</a> </li>
									<li><a href="<?=base_url()?>index.php/change_password/form"><i class="fa fa-th"></i> Change Password</a> </li>
									<li><a href="<?=base_url()?>index.php/change_username/form"><i class="fa fa-th"></i> Change Username</a> </li>
									<li><a href="<?=base_url()?>index.php/change_email/form"><i class="fa fa-th"></i> Change Email</a> </li>
									<li><a href="<?=base_url()?>index.php/request_to_renewal"><i class="fa fa-th"></i> PIF Balance</a> </li>
								</ul>
							</div>
						</li>
						<li class="<?=$main_messagemenu?>"><a href="javascript:void(0)" class="collapsible-header <?=$main_messagemenu?>"><i class="fa fa-folder-open-o" aria-hidden="true"></i> Email</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?=base_url()?>index.php/email_inbox"><i class="fa fa-share"></i> Inbox</a> </li>
									<li><a href="<?=base_url()?>index.php/email_outbox"><i class="fa fa-reply"></i> Outbox</a> </li>
									<li><a href="<?=base_url()?>index.php/email_send"><i class="fa fa-pencil-square-o"></i> Compose</a> </li>
									<li><a href="mailto:thecoachmark@gmail.com"><i class="fa fa-life-ring"></i> Live Support</a> </li>
									<li><a href="<?=base_url()?>index.php/opportunity/page/"><i class="fa fa-th"></i> View My Opportunity</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-users" aria-hidden="true"></i>Unilevel</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="#"></a> </li>
								</ul>
							</div>
						</li>
						<li class="<?=$main_financemenu?>"><a href="javascript:void(0)" class="collapsible-header <?=$main_financemenu?>"><i class="fa fa-briefcase" aria-hidden="true"></i>Finance</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<?php if($this->session->userdata['logged_ol_member']['status']=='Active') { ?>
										<li><a href="<?=base_url()?>index.php/financial_report"><i class="fa fa-money"></i> Financial Report</a> </li>
									<?php  } ?>
									<?php if($this->session->userdata['logged_ol_member']['status']=='Pending') { ?>
										<li class="<?=$online_payment_stripe?>"><a href="<?php echo base_url();?>index.php/online_payment_stripe"><i class="icon-">&#xf022;</i>Online Payment Stripe</a></li>
          							<?php } ?>
									<li><a href="<?=base_url()?>index.php/payment_confirm_report"><i class="fa fa-list-alt"></i> Payment Confirm Report</a> </li>
								</ul>
							</div>
						</li>
					<?
					}
					?>
					<?php
		            if($this->session->userdata['logged_ol_member']['status']=='Active')
		            { 
			        ?>
						<li class="<?=$main_productmenu?>"><a href="javascript:void(0)" class="collapsible-header <?=$main_productmenu?>"><i class="fa fa-book" aria-hidden="true"></i>Products</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?=base_url()?>index.php/capture_pages"><i class="fa fa-th"></i> Affiloworx Pages</a> </li>
									<li><a href="<?=base_url()?>index.php/join_friend/"><i class="fa fa-th"></i> Join Friend</a> </li>
									<li><a href="<?=base_url()?>index.php/opportunity/page/business"><i class="fa fa-th"></i> New Opportunity</a> </li>
									<li><a href="<?=base_url()?>index.php/welcome#myModal"><i class="fa fa-th"></i> &lt;/code&gt;</a> </li>
									<li><a href="<?=base_url()?>index.php/regbyembed"><i class="fa fa-th"></i> &lt;/code&gt; Websites</a> </li>
									<li><a href="<?=base_url()?>index.php/auto_responder_email"><i class="fa fa-th"></i> Auto Responser Email</a> </li>
								</ul>
							</div>
						</li>
					<?
					}else{
					?>
						<li class="<?=$main_master?>"><a href="javascript:void(0)" class="collapsible-header <?=$main_master?>"><i class="fa fa-user" aria-hidden="true"></i> Login Detail</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?=base_url()?>index.php/change_password/form"><i class="fa fa-exchange"></i> Change Password</a> </li>
									<li><a href="<?=base_url()?>index.php/change_username/form"><i class="fa fa-exchange"></i> Change Username</a> </li>
									<li><a href="<?=base_url()?>index.php/change_email/form"><i class="fa fa-exchange"></i> Change Email</a> </li>
								</ul>
							</div>
						</li>
						<li class="<?=$main_productmenu?>"><a href="<?php echo base_url();?>index.php/products" class="collapsible-header <?=$main_productmenu?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Education </a></li>
					<?	
					}
					?>	
					</ul>
				</div>
			</div>
			<!--== BODY INNER CONTAINER ==-->
			<div class="sb2-2">
