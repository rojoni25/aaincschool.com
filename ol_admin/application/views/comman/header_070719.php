<?php
	$arr_master		=	array('country','user','view_friends','send_username_password','upgrade_request','send_email_verification','upgrade_request_send_by_admin','r_matrix_kdk_upgrade','sub_facebook_payment','payment_affiliate_report','upgrade_mem_20_controller');
	$arr_system		=	array('site_setting','manually_payment','member_inactive','membership_renewed','user_payment_level','monthly_payment_by_admin','renewed_request','refill_member_account','deduct_balance_member','renewed_request_report');
	$arr_messagemenu=	array('email_outbox','email_send','email_inbox','general_message');
	$arr_matrix		=	array('three_by_three','five_by_three','ten_by_three','unilevel','coded_leg_tree', 'reverse_three_by_three','reverse_five_by_three','reverse_ten_by_three');
	$arr_freematrix		=	array('three_by_three_free','five_by_three_free','ten_by_three_free','unilevel_free','coded_leg_tree_free','reverse_three_by_three_free','reverse_five_by_three_free','reverse_ten_by_three_free');
	$arr_finance	=	array('virtual_balance', 'virtual_balance_free', 'payment_report_paid','diamond');
	$arr_capture	=	array('capture_page','cms_pages','change_password','media_upload','email_html','company_secret_page');
	$arr_report		=	array('due_payment_report','payment_report','payment_report_paid','withdrawal_request','member_payment_report','daily_payment_by_member','join_member_report','withdrawal_monthly_report','marketing_product','money_transfer_request', 'daily_payment_by_member_free', 'payment_report_free');
	
	$arr_paid_product=array('n_product_tree','n_product_payment','n_product_blog','n_product_report');


	if(in_array($this->uri->segment(1),$arr_master)){
		$main_master='active';
		
		if($this->uri->segment(2)=='panding_member'){
			$sub_panding_member='active';
		}
		elseif($this->uri->segment(2)=='paid_member'){
			$paid_member='active';
		}
		elseif($this->uri->segment(2)=='paid_leader_wallet'){
			$wallet_member='active';
		}
		elseif($this->uri->segment(2)=='free_leader_wallet'){
			$freewallet_member='active';
		}elseif($this->uri->segment(2)=='free_bonus_wallet'){
			$freewallet_bonus='active';
		}
		elseif($this->uri->segment(2)=='aainc_wallet'){
			$aaincwallet_member='active';
		}
		elseif($this->uri->segment(2)=='inactive_member'){
			$inactive_member='active';
		}
		elseif($this->uri->segment(1)=='country'){
			$sub_country='active';
		}
		elseif($this->uri->segment(1)=='user'){
			$sub_user='active';
		}
		elseif($this->uri->segment(1)=='view_friends'){
			$sub_view_friends='active';
		}
		elseif($this->uri->segment(1)=='send_username_password'){
			$sub_send_username_password='active';
		}
		elseif($this->uri->segment(1)=='upgrade_request'){
			$sub_upgrade_request='active';
		}
		elseif($this->uri->segment(1)=='sub_facebook_payment'){
			$sub_facebook_payment='active';
		}
		elseif($this->uri->segment(1)=='payment_affiliate_report'){
			$sub_affiliate_payment='active';
		}
		elseif($this->uri->segment(1)=='upgrade_mem_20_controller')
		{
			$sub_user_upgrade='active';
		}
		elseif($this->uri->segment(1)=='send_email_verification'){
			$sub_send_email_verification='active';
		}
		elseif($this->uri->segment(1)=='upgrade_request_send_by_admin'){
			$sub_upgrade_request_send_by_admin='active';
		}
		elseif($this->uri->segment(1)=='r_matrix_kdk_upgrade'){
			$sub_r_matrix_kdk_upgrade='active';
		}
	
	}
	else if(in_array($this->uri->segment(1),$arr_messagemenu))
	{
		$main_messagemenu='active';
		if($this->uri->segment(1)=='email_outbox'){
			$sub_email_outbox		=	'active';
		}
		elseif($this->uri->segment(1)=='email_send'){
			$sub_email_send			=	'active';
		}
		elseif($this->uri->segment(1)=='email_inbox'){
			$sub_email_inbox		=	'active';
		}
		elseif($this->uri->segment(1)=='general_message'){
			if($this->uri->segment(2)=='payment_confirm'){
				$sub_payment_confirm	=	'active';
			}
			else if($this->uri->segment(2)=='viral_payment_confirmation'){
				$sub_viral_payment_confirmation	=	'active';
			}
			else{
				$sub_general_message	=	'active';
			}
		}
			
	}
	
	else if(in_array($this->uri->segment(1),$arr_report))
	{
		$main_report='active';
		if($this->uri->segment(2)=='due_payment_report'){
			$sub_due_payment_report='active';
		}
		elseif($this->uri->segment(2)=='free_last_payment'){
			$sub_free_last_payment='active';
		}
		elseif($this->uri->segment(2)=='paid_payment_daily'){
			$sub_paid_payment_daily='active';
		}
		elseif($this->uri->segment(2)=='free_payment_daily'){
			$sub_free_payment_daily='active';
		}
		elseif($this->uri->segment(1)=='member_payment_report'){
			$sub_member_payment_report='active';
		}
		elseif($this->uri->segment(1)=='payment_report_paid'){
			$sub_payment_report_paid='active';
		}
		elseif($this->uri->segment(1)=='daily_payment_by_member'){
			$sub_daily_payment_by_member='active';
		}
		elseif($this->uri->segment(1)=='daily_payment_by_member_free'){
			$sub_daily_payment_by_member_free='active';
		}
		
		
		elseif($this->uri->segment(1)=='withdrawal_request'){
			$sub_withdrawal_request='active';
		}
		
		elseif($this->uri->segment(1)=='money_transfer_request'){
			$sub_money_transfer_request='active';
		}
		
		//
		
		elseif($this->uri->segment(1)=='join_member_report'){
			$sub_join_member_report='active';
		}
		elseif($this->uri->segment(1)=='withdrawal_monthly_report'){
			$sub_withdrawal_monthly_report='active';
		}
		elseif($this->uri->segment(1)=='marketing_product'){
			if($this->uri->segment(2)=='one_time_payment'){
				if($this->uri->segment(3)=='viral'){
					$viral_one_time_payment='active';
				}else{
					$nda_one_time_payment='active';
				}
			}
			elseif($this->uri->segment(2)=='nda_agree'){
				$nda_agree='active';
			}
			
			
		}	

	}
	
	elseif($this->uri->segment(1)=='vma'){
		$main_vma_section='active';
		if($this->uri->rsegment(1)=='request'){
			if($this->uri->rsegment(2)=='view'){
				$sub_vma_join_request='active';
			}
		}
		else if($this->uri->rsegment(1)=='general'){
			if($this->uri->rsegment(2)=='payment_confirm'){
				$sub_vma_payment_confirm='active';
			}
			else if($this->uri->rsegment(2)=='vma_admin'){
				$sub_vma_admin='active';
			}
		}
		
		
		else if($this->uri->rsegment(1)=='member'){
			$sub_vma_member='active';
		}
		else if($this->uri->rsegment(1)=='withdrawal'){
			$sub_vma_withdrawal='active';
		}
		else if($this->uri->rsegment(1)=='tree'){
			$sub_vma_tree='active';
		}
		else if($this->uri->rsegment(1)=='report'){
			if($this->uri->rsegment(2)=='balance_sheet'){
				$sub_vma_balance_sheet='active';
			}
			elseif($this->uri->rsegment(2)=='virtual_wallet_month_vise'){
				$sub_virtual_wallet_month_vise='active';
			}
			elseif($this->uri->rsegment(2)=='unqulified'){
				$sub_unqulified='active';
			}
				
			
		}
		
	}
	
	else if(in_array($this->uri->segment(1),$arr_finance))
	{
		$main_finance='active';
		if($this->uri->segment(1)=='virtual_balance'){
			$sub_virtual_balance='active';
		}
		elseif($this->uri->segment(1)=='virtual_balance_free'){
			$sub_virtual_balance_free='active';
		}
		elseif($this->uri->segment(1)=='diamond'){
			$sub_diamond_wallet='active';
		}
		
		
		
		
	}
	
	else if(in_array($this->uri->segment(1),$arr_capture))
	{
		$main_capture_page='active';

		if($this->uri->segment(2)=='member_pages_list'){
			$sub_member_pages_list='active';
		}
		elseif($this->uri->segment(2)=='member_page_add'){
			$sub_member_pages_list='active';
		}
		elseif($this->uri->segment(2)=='capture_page_request'){
			$sub_capture_page_request='active';
		}
		
		elseif($this->uri->segment(1)=='capture_page'){
			$sub_capture_page='active';
		}
		elseif($this->uri->segment(1)=='cms_pages'){
			
			if(in_array($this->uri->segment(2),array('custom_page_permission','custom_page','custom_page_edit'))){
				$sub_cms_custom='active';
			}	
			else{
				$sub_cms_pages='active';
			}
			
			
		}
		elseif($this->uri->segment(1)=='change_password'){
			$sub_change_password='active';
		}
		elseif($this->uri->segment(1)=='company_secret_page'){
			$sub_company_secret_page='active';
		}
		
		elseif($this->uri->segment(1)=='media_upload'){
			$sub_media_upload='active';
		}
		elseif($this->uri->segment(1)=='email_html'){
			$sub_email_html='active';
		}
		
	}
	
	else if(in_array($this->uri->segment(1),$arr_matrix))
	{
		$main_matrix='active';
		if($this->uri->segment(1)=='three_by_three'){
			$sub_three_by_three='active';
		}
		elseif($this->uri->segment(1)=='five_by_three'){
			$sub_five_by_three='active';
		}
		elseif($this->uri->segment(1)=='ten_by_three'){
			$sub_ten_by_three='active';
		}
		elseif($this->uri->segment(1)=='unilevel'){
			$sub_unilevel='active';
		}
		elseif($this->uri->segment(1)=='coded_leg_tree'){
			$sub_coded_leg_tree='active';
		} elseif($this->uri->segment(1)=='three_by_three_free'){
			$sub_three_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='five_by_three_free'){
			$sub_five_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='ten_by_three_free'){
			$sub_ten_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='unilevel_free'){
			$sub_unilevel_free='active';
		}
		elseif($this->uri->segment(1)=='coded_leg_tree_free'){
			$sub_coded_leg_tree_free='active';
		}
	}

	else if(in_array($this->uri->segment(1),$arr_freematrix))
	{
		$main_freematrix='active';
		if($this->uri->segment(1)=='reverse_three_by_three_free'){
			$sub_reverse_three_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='reverse_five_by_three_free'){
			$sub_reverse_five_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='reverse_ten_by_three_free'){
			$sub_reverse_ten_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='three_by_three_free'){
			$sub_three_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='five_by_three_free'){
			$sub_five_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='ten_by_three_free'){
			$sub_ten_by_three_free='active';
		}
		elseif($this->uri->segment(1)=='unilevel_free'){
			$sub_unilevel_free='active';
		}
		elseif($this->uri->segment(1)=='coded_leg_tree_free'){
			$sub_coded_leg_tree_free='active';
		}
	}
	else if(in_array($this->uri->segment(1),$arr_system))
	{
		$main_site_setting='active';
		if($this->uri->segment(1)=='site_setting'){
			$sub_site_setting='active';
		}
		elseif($this->uri->segment(1)=='member_inactive'){
			$sub_member_inactive='active';
		}
		elseif($this->uri->segment(1)=='membership_renewed'){
			$sub_membership_renewed='active';
		}
		elseif($this->uri->segment(1)=='user_payment_level'){
			$sub_user_payment_level='active';
		}
		elseif($this->uri->segment(1)=='monthly_payment_by_admin'){
			$sub_monthly_payment_by_admin='active';
		}
		elseif($this->uri->segment(1)=='renewed_request'){
			$sub_renewed_request='active';
		}
		elseif($this->uri->segment(1)=='refill_member_account'){
			$sub_refill_member_account='active';
		}
		elseif($this->uri->segment(1)=='deduct_balance_member'){
			$sub_deduct_balance_member='active';
		}
		elseif($this->uri->segment(1)=='renewed_request_report'){
			$sub_renewed_request_report='active';
		}
		
		elseif($this->uri->segment(1)=='manually_payment')
		{
			if($this->uri->segment(2)=='product_access_view'){
				$sub_product_access_view='active';
			}
			else{
				$sub_manually_payment='active';
			}
			
		}
		
		
	}

	else if(in_array($this->uri->segment(1),$arr_paid_product))
	{
		$main_paid_product='active';
		if($this->uri->segment(1)=='n_product_tree'){
			if($this->uri->segment(2)=='dashboard'){
				$sub_n_dashboard='active';
			}
			if($this->uri->segment(2)=='tree'){
				$sub_n_product_tree='active';
			}
			if($this->uri->segment(2)=='member_view'){
				$sub_n_member_view='active';
			}
			if($this->uri->segment(2)=='remove_member'){
				$sub_n_remove_member='active';
			}
			if($this->uri->segment(2)=='member_permission'){
				$sub_n_member_permission='active';
			}
		}
		if($this->uri->segment(1)=='n_product_payment'){
			if($this->uri->segment(2)=='manual_payment'){
				$sub_n_product_manual='active';
			}
			if($this->uri->segment(2)=='blog_permission'){
				$sub_n_blog_permission='active';
			}
		}
		if($this->uri->segment(1)=='n_product_blog'){
			$sub_n_my_blog='active';
			
		}		
	}
	else if($this->uri->segment(1)=='reports'){
		$main_report = 'active';
		if($this->uri->rsegment(2)=='qualified_member'){
			$qualified_member='active';
		}
		if($this->uri->rsegment(2)=='unqualified_member'){
			$unqualified_member='active';
		}
	}
	else{
		if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {
			$main_dashboard='active';
		}else{
			$main_master = 'active';
		}
	}
?>

<div class="layout">
<div class="navbar navbar-inverse top-nav">
  <div class="navbar-inner">
    <div class="container"> <span class="home-link"><a href="<?php echo base_url();?>" class="icon-home"></a></span><a class="brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>asset/images/opp2015-logo.png" width="103" height="50" alt="Falgun"></a>
      <div class="nav-collapse navmainmenu">
        <ul class="nav navbar-nav">
          	<?php if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {?>
					<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large"></i> Master <b class="icon-angle-down"></b></a>
					<div class="dropdown-menu">
					  <ul>
					    <li><a href="<?php echo base_url();?>index.php/country"><i class="icon-th"></i> Country </a></li>
					    <li><a href="<?php echo base_url();?>index.php/user"><i class="icon-th"></i> Member </a></li>
					    <li><a href="<?php echo base_url();?>index.php/view_friends"><i class="icon-th"></i> View Friend </a></li>
					    <li><a href="<?php echo base_url();?>index.php/user/panding_member"><i class="icon-th"></i> Panding Request </a></li>
					    <li><a href="<?php echo base_url();?>index.php/send_username_password"><i class="icon-th"></i> Send Login Details </a></li>
					  </ul>
					</div>
					</li>
					<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-beaker"></i> System <b class="icon-angle-down"></b></a>
					<div class="dropdown-menu">
					  <ul>
					    <li><a href="<?php echo base_url();?>index.php/site_setting"><i class="icon-table"></i> Setting</a></li>
					    <li><a href="<?php echo base_url();?>index.php/web_setting"><i class="icon-table"></i> Web Setting</a></li>
					    <li><a href="<?php echo base_url();?>index.php/slider_setting"><i class="icon-table"></i> Home Slider Setting</a></li>
					  </ul>
					</div>
					</li>
					<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-beaker"></i> Email <b class="icon-angle-down"></b></a>
					<div class="dropdown-menu">
					  <ul>
					    <li><a href="#"><i class="icon-table"></i> Inbox</a></li>
					    <li><a href="<?php echo base_url();?>index.php/email_outbox"><i class="icon-table"></i>Outbox</a></li>
					    <li><a href="<?php echo base_url();?>index.php/email_send"><i class="icon-table"></i> Compose</a></li>
					  </ul>
					</div>
					</li>
					<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-group"></i> Matrix <b class="icon-angle-down"></b></a>
					<div class="dropdown-menu">
					  <ul>
					    <li><a href="<?php echo base_url();?>index.php/three_by_three/view/2"><i class="icon-table"></i>3 x 3</a></li>
					    <li><a href="<?php echo base_url();?>index.php/three_by_three_free/view/2"><i class="icon-table"></i>3 x 3 Free</a></li>
					    <li><a href="<?php echo base_url();?>index.php/five_by_three/view/2"><i class="icon-table"></i>5 x 3</a></li>
					    <li><a href="<?php echo base_url();?>index.php/five_by_three_free/view/2"><i class="icon-">&#xf022;</i>5 x 3 Free</a></li>
					    <li><a href="<?php echo base_url();?>index.php/reverse_five_by_three_free/view/2"><i class="icon-">&#xf022;</i>Reverse 5 x 3 Free</a></li>
					    <li><a href="<?php echo base_url();?>index.php/ten_by_three/view/2"><i class="icon-table"></i>10 x 3</a></li>
					    <li><a href="<?php echo base_url();?>index.php/ten_by_three_free/view/2"><i class="icon-table"></i>10 x 3 Free</a></li>
					    <li><a href="<?php echo base_url();?>index.php/unilevel"><i class="icon-table"></i>Unilevel</a></li>
					    <li><a href="<?php echo base_url();?>index.php/unilevel_free"><i class="icon-table"></i>Unilevel Free</a></li>
					    <li><a href="<?php echo base_url();?>index.php/coded_leg_tree"><i class="icon-table"></i>Coded Leg</a></li>
					  </ul>
					</div>
					</li>
          	<?php } ?>
          	<!--- END If -->
        </ul>
      </div>
      <div class="btn-toolbar pull-right notification-nav">
        <div class="btn-group"> </div>
        <div class="btn-group">
          <div class="dropdown"> <a href="<?php echo base_url();?>index.php/login/logout" class="btn btn-notification"><i class="icon-lock"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="leftbar leftbar-close clearfix">
  <div class="admin-info clearfix">
    <div class="admin-thumb"> <i class="icon-user"></i> </div>
    <div class="admin-meta">
      <ul>
        <li class="admin-username">
          <?=$this->session->userdata['logged_in_visa']['fullname']?>
        </li>
        <li><a href="<?php echo base_url();?>index.php/profile">Edit Profile</a></li>
        <li><a href="<?php echo base_url();?>index.php/profile">View Profile </a><a href="<?php echo base_url();?>index.php/login/logout"><i class="icon-lock"></i> Logout</a></li>
      </ul>
    </div>
  </div>
  <div class="left-nav clearfix">
    <div class="left-primary-nav">
      <ul id="myTab">
        <?php if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {?>
	        <li class="<?=$main_dashboard?>"><a href="#main" class="icon-desktop" title="Dashboard"></a></li>
	        <li class="<?=$main_master?>"><a href="#master" class="icon-th-large" title="Master"></a></li>
	        <li class="<?=$main_site_setting?>"><a href="#system" class="icon-beaker" title="System"></a></li>
	        <li class="<?=$main_messagemenu?>"><a href="#messagemenu" class="icon-list-alt" title="Message"></a></li>
	        <li class="<?=$main_matrix?>"><a href="#matrix" class="icon-group" title="Matrix"></a></li>
	        <li class="<?=$main_freematrix?>"><a href="#freematrix" class="icon-group" title="Free Matrix"></a></li>
	        <li class="<?=$main_finance?>"><a href="#finance" class="icon-file-alt" title="Finance"></a></li>
        <?php } ?>
        <?php if($this->session->userdata['logged_in_visa']['user_type_id']=='2'){?>
	        <li class="<?=$main_master?>"><a href="#master" class="icon-th-large" title="Master"></a></li>
	        <li class="<?=$main_capture_page?>"><a href="#page" class="icon-pencil" title="Product"></a></li>
        <?php }?>	
        <?php if($this->session->userdata['logged_in_visa']['user_type_id']=='3'){?>
	        <li class="<?=$main_master?>"><a href="#master" class="icon-th-large" title="Master"></a></li>
	        <li class="<?=$main_capture_page?>"><a href="#page" class="icon-pencil" title="CMS"></a></li>
	        <li class="<?=$main_report?>"><a href="#report" class="icon-file-alt" title="Report"></a></li>
        <?php }?>	
        <?php if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {?>
	        <li class="<?=$main_capture_page?>"><a href="#page" class="icon-pencil" title="Product"></a></li>
	        <li class="<?=$main_report?>"><a href="#report" class="icon-file-alt" title="Report"></a></li>
	        <li class="<?=$main_paid_product?>"><a href="#paid_product" class="icon-asterisk" title="Paid Product"></a></li>
	     	<li class="<?=$main_vma_section?>"><a href="#vma_section" class="icon-flag" title="VMA"></a></li>
	        <!--  Ad Multiplier  -->
	        <?php //if($this->session->userdata["tlc_matrix_admin"]['access']=='true'){?>
	        <li class="<?=$main_tlc_section?>"><a href="#tlc_section" class="icon-th-large" title="AD Multiplier"></a></li>
	        <?php //}?>
	        <!--  Ad Multiplier -->
        <?php } ?>
      </ul>
    </div>
    <div class="responsive-leftbar"> <i class="icon-list"></i> </div>
    <div class="left-secondary-nav tab-content">
      	<?php if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {?>
			<div class="tab-pane  <?=$main_dashboard?>"  id="main">
				<a href="<?php echo base_url().'index.php/home?type=free'; ?>"><h4 class="side-head">Dashboard</h4></a>
				<ul class="metro-sidenav clearfix">
				  <li><a href="#" class="brown"><i class="icon-user"></i><span>Member</span></a></li>
				  <li><a href="#" class="orange"><i class="icon-cogs"></i><span>Upgrades</span></a></li>
				  <li><a href="<?php echo base_url();?>index.php/media_upload" class="blue-violate"><i class="icon-bar-chart"></i><span>Media</span></a></li>
				  <li><a href="<?php echo base_url();?>index.php/member_login/current_login" class="green"><span class="notify-tip login_mem_llb">0</span><span><br />
				    Online Member</span></a></li>
				  <li><a href="<?php echo base_url();?>index.php/member_login/day_login" class="dark-yellow"><span class="notify-tip login_day_llb">0</span><span><br />
				    Online Daily Report</span></a></li>
				  <li><a href="" class="bondi-blue"><span><br />
				    Due Member</span></a></li>
				  <li><a href="<?php echo base_url();?>index.php/upgrade_request/view/paid" class="magenta"><span><br />
				    Paid Member</span></a></li>

				  <li><a href="<?php echo base_url();?>index.php/cmspages/p/leaders_board" style="background-color: #0d690d;"><span><br />
				    Leader Board</span></a></li>
				  <li><a href="<?php echo base_url();?>index.php/cmspages/p/leaders_board_free" style="background-color: #b32c2c;"><span><br />
				    Leader Board Free</span></a></li>
				   <li><a href="<?php echo base_url();?>index.php/user/paid_leader_wallet" style="background-color: blue;"><span><br />Paid Leader Board</span></a></li>
				    <li><a href="<?php echo base_url();?>index.php/tlc/r_matrix/dashboard" style="background-color: blue;"><span><i class="icon-file-alt"></i> Ad Multiplier</span></a></li>
				    <li><a href="<?php echo base_url();?>index.php/tlc/r_matrix_tree_free/view/1" style="background-color: blue;"><span><br>Ad Multiplier Free</span></a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_master?>" id="master">
				<h4 class="side-head">Master</h4>
				<ul id="nav" class="accordion-nav">
				  <li class="<?=$sub_country?>"><a href="<?php echo base_url();?>index.php/country"><i class="icon-th"></i> Country</a></li>
				  <li class="<?=$paid_member?>"><a href="<?php echo base_url();?>index.php/user/paid_member"><i class="icon-th"></i>Paid Member</a></li>
				  <li class="<?=$wallet_member?>"><a href="<?php echo base_url();?>index.php/user/paid_leader_wallet"><i class="icon-th"></i>Member Wallet</a></li>
				  <li class="<?=$freewallet_member?>"><a href="<?php echo base_url();?>index.php/user/free_leader_wallet"><i class="icon-th"></i> Free Member Wallet</a></li>
				  <li class="<?=$freewallet_bonus?>"><a href="<?php echo base_url();?>index.php/user/free_bonus_wallet"><i class="icon-th"></i> Free Bonus Wallet</a></li>
				  <li class="<?=$aaincwallet_member?>"><a href="<?php echo base_url();?>index.php/user/aainc_wallet"><i class="icon-th"></i> AAINC Wallet</a></li>
				  <li class="<?=$inactive_member?>"><a href="<?php echo base_url();?>index.php/user/inactive_member"><i class="icon-th"></i>Inactive Member</a></li>
				  <li class="<?=$sub_user?>"><a href="<?php echo base_url();?>index.php/user"><i class="icon-th"></i> Active Member</a></li>
				  <li class="<?=$sub_view_friends?>"><a href="<?php echo base_url();?>index.php/view_friends"><i class="icon-th"></i> View Friend</a></li>
				  <li class="<?=$sub_panding_member?>"><a href="<?php echo base_url();?>index.php/user/panding_member"><i class="icon-th"></i> Free Member </a></li>
				  <li class="<?=$sub_send_username_password?>"><a href="<?php echo base_url();?>index.php/send_username_password"><i class="icon-th"></i> Send Login Details </a></li>
				  <li class="<?=$sub_user_upgrade?>"><a href="<?php echo base_url();?>index.php/upgrade_mem_20_controller"><i class="icon-th"></i>Upgrade Request From User </a></li>

				   <li class="<?=$sub_facebook_payment?>"><a href="<?php echo base_url();?>index.php/facebook_payment_report"><i class="icon-th"></i>Facebook Payment Report </a></li>

				  <li class="<?=$sub_affiliate_payment?>"><a href="<?php echo base_url();?>index.php/payment_affiliate_report"><i class="icon-th"></i>Software License Payment Report </a></li>

				  <li class="<?=$sub_upgrade_request?>"><a href="<?php echo base_url();?>index.php/upgrade_request/view"><i class="icon-th"></i> Upgrade Request </a></li>

				   <li class="<?=$sub_r_matrix_kdk_upgrade?>"><a href="<?php echo base_url();?>index.php/r_matrix_kdk_upgrade/view"><i class="icon-th"></i>KDK Upgrade Request </a></li>
				  <li class="<?=$sub_send_email_verification?>"><a href="<?php echo base_url();?>index.php/send_email_verification"><i class="icon-th"></i> Send Email Verification </a></li>
				  <li class="<?=$sub_upgrade_request_send_by_admin?>"><a href="<?php echo base_url();?>index.php/upgrade_request_send_by_admin"><i class="icon-th"></i> Manually Upgrade Request </a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_site_setting?>" id="system">
				<h4 class="side-head">System</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_site_setting?>"><a href="<?php echo base_url();?>index.php/site_setting"><i class="icon-table"></i>Setting</a></li>
				  <?php /*?> <li class="<?=$sub_manually_payment?>"><a href="<?php echo base_url();?>index.php/manually_payment"><i class="icon-th"></i>  Manually Upgrade </a></li>	<?php */?>
				  <li class="<?=$sub_product_access_view?>"><a href="<?php echo base_url();?>index.php/manually_payment/product_access_view"><i class="icon-th"></i> Product Premission </a></li>
				  <li class="<?=$sub_member_inactive?>"><a href="<?php echo base_url();?>index.php/member_inactive"><i class="icon-table"></i>Member Inactive</a></li>
				  <li class="<?=$sub_membership_renewed?>"><a href="<?php echo base_url();?>index.php/membership_renewed"><i class="icon-table"></i>Membership Renewed</a></li>
				  <li class="<?=$sub_user_payment_level?>"><a href="<?php echo base_url();?>index.php/user_payment_level/view"><i class="icon-table"></i>Member Payment Level</a></li>
				  <li class="<?=$sub_monthly_payment_by_admin?>"><a href="<?php echo base_url();?>index.php/monthly_payment_by_admin"><i class="icon-table"></i>Manually Payment Monthly </a></li>
				  <li class="<?=$sub_renewed_request?>"><a href="<?php echo base_url();?>index.php/renewed_request"><i class="icon-table"></i>Renewed Request</a></li>
				  <li class="<?=$sub_renewed_request_report?>"><a href="<?php echo base_url();?>index.php/renewed_request_report"><i class="icon-table"></i>PIF  Report</a></li>
				  <li class="<?=$sub_refill_member_account?>"><a href="<?php echo base_url();?>index.php/refill_member_account"><i class="icon-table"></i>Refill Account</a></li>
				  <li class="<?=$sub_deduct_balance_member?>"><a href="<?php echo base_url();?>index.php/deduct_balance_member"><i class="icon-table"></i>Deduct Balance Member</a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_messagemenu?>" id="messagemenu">
				<h4 class="side-head">Email</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_email_inbox?>"><a href="<?php echo base_url();?>index.php/email_inbox"><i class="icon-">&#xf022;</i>Inbox</a></li>
				  <li class="<?=$sub_email_outbox?>"><a href="<?php echo base_url();?>index.php/email_outbox"><i class="icon-">&#xf022;</i>Outbox</a></li>
				  <li class="<?=$sub_email_send?>"><a href="<?php echo base_url();?>index.php/email_send"><i class="icon-">&#xf022;</i>Compose</a></li>
				  <li class="<?=$sub_general_message?>"><a href="<?php echo base_url();?>index.php/general_message"><i class="icon-">&#xf022;</i>General Message</a></li>
				  <li class="<?=$sub_payment_confirm?>"><a href="<?php echo base_url();?>index.php/general_message/payment_confirm"><i class="icon-">&#xf022;</i>Payment Confirm</a></li>
				   <li class="<?=$sub_viral_payment_confirmation?>"><a href="<?php echo base_url();?>index.php/general_message/viral_payment_confirmation"><i class="icon-">&#xf022;</i>Viral Payment Confirm</a></li>
				  <!-- Compose  mail to all -->
				  <li class="<?=$sub_email_send?>"><a href="<?php echo base_url();?>index.php/email_send_all"><i class="icon-">&#xf022;</i>Message To All</a></li>
				   <!--  Compose  mail to all -->
				</ul>
			</div>
			<div class="tab-pane <?=$main_matrix?>" id="matrix">
				<h4 class="side-head">Matrix</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_three_by_three?>"><a href="<?php echo base_url();?>index.php/three_by_three/view/2"><i class="icon-">&#xf022;</i>3 x 3</a></li>
				  <li class="<?=$sub_reverse_three_by_three?>"><a href="<?php echo base_url();?>index.php/reverse_three_by_three/view/2"><i class="icon-table"></i> Reverse 3 x 3 </a></li>
				  <li class="<?=$sub_five_by_three?>"><a href="<?php echo base_url();?>index.php/five_by_three/view/2"><i class="icon-">&#xf022;</i>5 x 3</a></li>
				   <li class="<?=$sub_reverse_five_by_three?>"><a href="<?php echo base_url();?>index.php/reverse_five_by_three/view/2"><i class="icon-">&#xf022;</i>Reverse 5 x 3 </a></li>
				  <li class="<?=$sub_ten_by_three?>"><a href="<?php echo base_url();?>index.php/ten_by_three/view/2"><i class="icon-">&#xf022;</i>10 x 3</a></li>
				  <li class="<?=$sub_reverse_ten_by_three?>"><a href="<?php echo base_url();?>index.php/reverse_ten_by_three/view/2"><i class="icon-table"></i> Reverse 10 x 3 </a></li>
				  <li class="<?=$sub_unilevel?>"><a href="<?php echo base_url();?>index.php/unilevel"><i class="icon-">&#xf022;</i>Unilevel</a></li>
				  <li class="<?=$sub_coded_leg_tree?>"><a href="<?php echo base_url();?>index.php/coded_leg_tree"><i class="icon-">&#xf022;</i>Coded Leg</a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_freematrix?>" id="freematrix">
				<h4 class="side-head">Free Matrix</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_three_by_three_free ?>"><a href="<?php echo base_url();?>index.php/three_by_three_free/view/2"><i class="icon-table"></i>3 x 3 Free</a></li>
				  <li class="<?=$sub_reverse_three_by_three_free?>"><a href="<?php echo base_url();?>index.php/reverse_three_by_three_free/view/2"><i class="icon-table"></i> Reverse 3 x 3 Free</a></li>
				  <li class="<?=$sub_five_by_three_free?>"><a href="<?php echo base_url();?>index.php/five_by_three_free/view/2"><i class="icon-">&#xf022;</i>5 x 3 Free</a></li>
				  <li class="<?=$sub_reverse_five_by_three_free?>"><a href="<?php echo base_url();?>index.php/reverse_five_by_three_free/view/2"><i class="icon-">&#xf022;</i>Reverse 5 x 3 Free</a></li>
				  <li class="<?=$sub_ten_by_three_free?>"><a href="<?php echo base_url();?>index.php/ten_by_three_free/view/2"><i class="icon-table"></i>10 x 3 Free</a></li>
				  <li class="<?=$sub_reverse_ten_by_three_free?>"><a href="<?php echo base_url();?>index.php/reverse_ten_by_three_free/view/2"><i class="icon-table"></i> Reverse 10 x 3 Free</a></li>
				  <li class="<?=$sub_unilevel_free?>"><a href="<?php echo base_url();?>index.php/unilevel_free"><i class="icon-">&#xf022;</i>Unilevel Free</a></li>
				  <li class="<?=$sub_coded_leg_tree_free?>"><a href="<?php echo base_url();?>index.php/coded_leg_tree_free"><i class="icon-">&#xf022;</i>Coded Leg Free</a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_finance?>" id="finance">
				<h4 class="side-head">Finance</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_virtual_balance?>"><a href="<?php echo base_url();?>index.php/virtual_balance/view/3by3"><i class="icon-file-alt"></i>Virtual Balance</a></li>
				  <li class="<?=$sub_virtual_balance_free?>"><a href="<?php echo base_url();?>index.php/virtual_balance_free/view/3by3"><i class="icon-file-alt"></i>Virtual Balance Free</a></li>
				  <li class="<?=$sub_diamond_wallet?>"><a href="<?php echo base_url();?>index.php/diamond/diamond_wallet/view"><i class="icon-file-alt"></i>Diamond Wallet</a></li>
				</ul>
			</div>
      	<?php } ?>
      	<?php if($this->session->userdata['logged_in_visa']['user_type_id']=='2') {?>
			<div class="tab-pane active" id="master">
				<h4 class="side-head">Master</h4>
				<ul id="nav" class="accordion-nav">
				  <li class="<?=$sub_panding_member?>"><a href="<?php echo base_url();?>index.php/user/panding_member"><i class="icon-th"></i> Free Member </a></li>
				  <li class="<?=$sub_send_username_password?>"><a href="<?php echo base_url();?>index.php/send_username_password"><i class="icon-th"></i> Send Login Details </a></li>
				  <li class="<?=$sub_send_email_verification?>"><a href="<?php echo base_url();?>index.php/send_email_verification"><i class="icon-th"></i> Send Email Verification </a></li>
				  <li class="<?=$sub_upgrade_request?>"><a href="<?php echo base_url();?>index.php/upgrade_request/view"><i class="icon-th"></i> Upgrade Request </a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_capture_page?>" id="page">
				<ul class="accordion-nav">
				  <li class="<?=$sub_cms_pages?>"><a href="<?php echo base_url();?>index.php/cms_pages/view"><i class="icon-file-alt"></i>CMS</a></li>
				</ul>
			</div>
      	<?php } ?>	
      	<?php if($this->session->userdata['logged_in_visa']['user_type_id']=='3') {?>
			<div class="tab-pane active" id="master">
				<h4 class="side-head">Master</h4>
				<ul id="nav" class="accordion-nav">
				  <li class="<?=$sub_panding_member?>"><a href="<?php echo base_url();?>index.php/user/panding_member"><i class="icon-th"></i> Free Member </a></li>
				  <li class="<?=$sub_send_username_password?>"><a href="<?php echo base_url();?>index.php/send_username_password"><i class="icon-th"></i> Send Login Details </a></li>
				  <li class="<?=$sub_send_email_verification?>"><a href="<?php echo base_url();?>index.php/send_email_verification"><i class="icon-th"></i> Send Email Verification </a></li>
				  <li class="<?=$sub_upgrade_request?>"><a href="<?php echo base_url();?>index.php/upgrade_request/view"><i class="icon-th"></i> Upgrade Request </a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_capture_page?>" id="page">
				<ul class="accordion-nav">
				  <li class="<?=$sub_cms_pages?>"><a href="<?php echo base_url();?>index.php/cms_pages/view"><i class="icon-file-alt"></i>CMS</a></li>
				</ul>
			</div>
			<div class="tab-pane <?=$main_report?>" id="report">
				<h4 class="side-head">Report</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_join_member_report?>"><a href="<?php echo base_url();?>index.php/join_member_report/join_member"><i class="icon-file-alt"></i>Joining Report</a></li>

				   <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/three_by_three/view/2"><i class="icon-file-alt"></i>Paid 3x3</a></li>
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/unilevel"><i class="icon-file-alt"></i>Paid Unilevel</a></li>
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/user/paid_leader_wallet"><i class="icon-file-alt"></i>Paid W1 Wallets</a></li>
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/user/aainc_wallet"><i class="icon-file-alt"></i>Paid AAINC Wallets</a></li>

				  <li class="<?=$sub_withdrawal_request?>"><a href="<?php echo base_url();?>index.php/withdrawal_request"><i class="icon-file-alt"></i>Withdrawal Request <span class="tot_request_w notify-tip">0</span></a></li>
				  <li class="<?=$sub_member_payment_report?>"><a href="<?php echo base_url();?>index.php/member_payment_report/list_view"><i class="icon-file-alt"></i>Member Payment Report</a></li>

				  <li class="<?=$qualified_member?>"><a href="<?php echo base_url();?>index.php/reports/qualified_member"><i class="icon-file-alt"></i>Qualified Member</a></li>
				  <li class="<?=$unqualified_member?>"><a href="<?php echo base_url();?>index.php/reports/unqualified_member"><i class="icon-file-alt"></i>Unqualified Member</a></li>

				</ul>
			</div>
      	<?php } ?>	
      	<?php if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {?>
			<div class="tab-pane <?=$main_capture_page?>" id="page">
				<h4 class="side-head">Capture Page</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_capture_page?>"><a href="<?php echo base_url();?>index.php/capture_page"><i class="icon-file-alt"></i>Capture Page List</a></li>
				  <li class="<?=$sub_company_secret_page?>"><a href="<?php echo base_url();?>index.php/company_secret_page"><i class="icon-file-alt"></i>Company Secret Page</a></li>
				  <li class="<?=$sub_cms_pages?>"><a href="<?php echo base_url();?>index.php/cms_pages/view"><i class="icon-file-alt"></i>CMS</a></li>
				  <li class="<?=$sub_cms_custom?>"><a href="<?php echo base_url();?>index.php/cms_pages/custom_page"><i class="icon-file-alt"></i>CMS Custom Page</a></li>
				  
				  <li class="<?=$sub_email_html?>"><a href="<?php echo base_url();?>index.php/email_html"><i class="icon-file-alt"></i>Email Contain</a></li>
				  <li class="<?=$sub_change_password?>"><a href="<?php echo base_url();?>index.php/change_password/form"><i class="icon-file-alt"></i>Change Password</a></li>
				  <li class="<?=$sub_media_upload?>"><a href="<?php echo base_url();?>index.php/media_upload"><i class="icon-file-alt"></i>Media</a></li>
				  <li class="<?=$sub_member_pages_list?>"><a href="<?php echo base_url();?>index.php/capture_page/member_pages_list"><i class="icon-file-alt"></i>Member Pages</a></li>
				  <li class="<?=$sub_capture_page_request?>"><a href="<?php echo base_url();?>index.php/capture_page/capture_page_request"><i class="icon-file-alt"></i>Capture Page Request</a></li>
				   <li class="<?=$sub_capture_issue_report?>"><a href="<?php echo base_url();?>index.php/capture_page/capture_issue_report"><i class="icon-file-alt"></i>Capture Issue Report</a></li>
				</ul>
			</div>
      	<?php  } ?>
      
      	<?php if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {?>
			<div class="tab-pane <?=$main_report?>" id="report">
				<h4 class="side-head">Report</h4>
				<ul class="accordion-nav">
				  <li class="<?=$sub_due_payment_report?>"><a href="<?php echo base_url();?>index.php/payment_report/due_payment_report"><i class="icon-file-alt"></i>Due Payment Report</a></li>
				  <li class="<?=$sub_free_last_payment?>"><a href="<?php echo base_url();?>index.php/payment_report/free_last_payment"><i class="icon-file-alt"></i>Last Payment(Free)</a></li>
				  <li class="<?=$sub_payment_report_paid?>"><a href="<?php echo base_url();?>index.php/payment_report_paid/list_view"><i class="icon-file-alt"></i>Payment Report (Active)</a></li>
				 <!--  <li class="<?=$sub_daily_payment_by_member?>"><a href="<?php echo base_url();?>index.php/daily_payment_by_member/view"><i class="icon-file-alt"></i>Daily Payment(Member)</a></li>

				  <li class="<?=$sub_daily_payment_by_member_free?>"><a href="<?php echo base_url();?>index.php/daily_payment_by_member_free/view"><i class="icon-file-alt"></i>Free Daily Payment(Member)</a></li>

				  <li class="<?=$sub_paid_payment_daily?>"><a href="<?php echo base_url();?>index.php/payment_report/paid_payment_daily"><i class="icon-file-alt"></i>Daily Payment (Paid)</a></li>

				  <li class="<?=$sub_free_payment_daily?>"><a href="<?php echo base_url();?>index.php/payment_report_free/free_payment_daily"><i class="icon-file-alt"></i>Daily Payment (Free)</a></li> -->

				  <li class="<?=$sub_withdrawal_request?>"><a href="<?php echo base_url();?>index.php/withdrawal_request"><i class="icon-file-alt"></i>Withdrawal Request <span class="tot_request_w notify-tip">0</span></a></li>
				  <li class="<?=$sub_money_transfer_request?>"><a href="<?php echo base_url();?>index.php/money_transfer_request/"><i class="icon-file-alt"></i>Money Transfer Request</a></li>
				  <li class="<?=$sub_member_payment_report?>"><a href="<?php echo base_url();?>index.php/member_payment_report/list_view"><i class="icon-file-alt"></i>Member Payment Report</a></li>
				  <li class="<?=$sub_join_member_report?>"><a href="<?php echo base_url();?>index.php/join_member_report/join_member"><i class="icon-file-alt"></i>Joining Report</a></li>
				 
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/three_by_three/view/2"><i class="icon-file-alt"></i>Paid 3x3</a></li>
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/unilevel"><i class="icon-file-alt"></i>Paid Unilevel</a></li>
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/user/paid_leader_wallet"><i class="icon-file-alt"></i>Paid W1 Wallets</a></li>
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/user/aainc_wallet"><i class="icon-file-alt"></i>Paid AAINC Wallets</a></li>
				  
				  <li class="<?=$sub_withdrawal_monthly_report?>"><a href="<?php echo base_url();?>index.php/withdrawal_monthly_report/report"><i class="icon-file-alt"></i>Withdrawal Report</a></li>

				  <li class="<?=$qualified_member?>"><a href="<?php echo base_url();?>index.php/reports/qualified_member"><i class="icon-file-alt"></i>Qualified Member</a></li>
				  <li class="<?=$unqualified_member?>"><a href="<?php echo base_url();?>index.php/reports/unqualified_member"><i class="icon-file-alt"></i>Unqualified Member</a></li>
				  <li class="<?=$remaintosmarttransfer?>"><a href="<?php echo base_url();?>index.php/reports/remaintosmarttransfer"><i class="icon-file-alt"></i>WalletR to Smartw Transfer</a></li>

				  <!-- <li class="<?=$viral_one_time_payment?>"><a href="<?php echo base_url();?>index.php/marketing_product/one_time_payment/viral"><i class="icon-file-alt"></i>Viral Marketing Payment</a></li>
				  <li class="<?=$nda_one_time_payment?>"><a href="<?php echo base_url();?>index.php/marketing_product/one_time_payment/nda"><i class="icon-file-alt"></i>NDA Payment</a></li>
				  <li class="<?=$nda_agree?>"><a href="<?php echo base_url();?>index.php/marketing_product/nda_agree/"><i class="icon-file-alt"></i>NDA Agree Report</a></li> -->
				</ul>
			</div>

			<div class="tab-pane <?=$main_paid_product?>" id="paid_product">
				<h4 class="side-head">Paid Product</h4>
				<ul class="accordion-nav">
				    <li class="<?=$sub_n_dashboard?>"><a href="<?php echo base_url();?>index.php/n_product_tree/dashboard"><i class="icon-file-alt"></i>Dashboard</a></li>
				    <li class="<?=$sub_n_member_view?>"><a href="<?php echo base_url();?>index.php/n_product_tree/member_view"><i class="icon-file-alt"></i>Member List</a></li>
				    <li class="<?=$sub_n_remove_member?>"><a href="<?php echo base_url();?>index.php/n_product_tree/remove_member"><i class="icon-file-alt"></i>Remove Member</a></li>
				    <li class="<?=$sub_n_member_permission?>"><a href="<?php echo base_url();?>index.php/n_product_tree/member_permission"><i class="icon-file-alt"></i>Product Permission</a></li>
				    <li class="<?=$sub_n_product_manual?>"><a href="<?php echo base_url();?>index.php/n_product_payment/manual_payment"><i class="icon-file-alt"></i>Manual Payment</a></li>
				    <li class="<?=$sub_n_blog_permission?>"><a href="<?php echo base_url();?>index.php/n_product_payment/blog_permission"><i class="icon-file-alt"></i>Blog Permission</a></li>
				    <li class="<?=$sub_n_my_blog?>"><a href="<?php echo base_url();?>index.php/n_product_blog/my_blog"><i class="icon-file-alt"></i>Add Blog</a></li>
				</ul>
			</div>
	      
			<div class="tab-pane <?=$main_vma_section?>" id="vma_section">
				<h4 class="side-head">VMA Section</h4>
				<ul class="accordion-nav">
				        <li class="<?=$sub_vma_join_request?>"><a href="<?php echo vma_base();?>request/view"><i class="icon-file-alt"></i>Join Request</a></li>
				        <li class="<?=$sub_vma_payment_confirm?>"><a href="<?php echo vma_base();?>general/payment_confirm"><i class="icon-file-alt"></i>Payment Confirm</a></li>
				        <li class="<?=$sub_vma_member?>"><a href="<?php echo vma_base();?>member/view"><i class="icon-file-alt"></i>Member</a></li>
				        <li class="<?=$sub_vma_tree?>"><a href="<?php echo vma_base();?>tree/view/"><i class="icon-file-alt"></i>Tree View</a></li>
				        <li class="<?=$sub_vma_balance_sheet?>"><a href="<?php echo vma_base();?>report/balance_sheet"><i class="icon-file-alt"></i>Balance Sheet</a></li>
				        <li class="<?=$sub_virtual_wallet_month_vise?>"><a href="<?php echo vma_base();?>report/virtual_wallet_month_vise"><i class="icon-file-alt"></i>Virtual Payment Report</a></li>
				        <li class="<?=$sub_unqulified?>"><a href="<?php echo vma_base();?>report/unqulified"><i class="icon-file-alt"></i>Unqulified Pay. Report</a></li>
				        <li class="<?=$sub_vma_withdrawal?>"><a href="<?php echo vma_base();?>withdrawal/request"><i class="icon-file-alt"></i>Withdrawal Request</a></li>
				        <li class="<?=$sub_vma_admin?>"><a href="<?php echo vma_base();?>general/vma_admin/"><i class="icon-file-alt"></i>VMA Admin</a></li>
				</ul>
			</div>
	      	<!-- Ad Multiplier -->
	     	<div class="tab-pane <?=$main_tlc_section?>" id="tlc_section">
		        <h4 class="side-head">AM-Matrix</h4>
		        <ul class="accordion-nav">
		                <li class="<?=$sub_tlc_join_request?>"><a href="<?=base_url();?>index.php/tlc/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
		        </ul>
		    </div>
	     	<!-- Ad Multiplier -->
      	<?php }?>	
    </div>
  </div>
</div>
<div class="main-wrapper">
	<div class="container-fluid">
		<script>
			$(document).ready(function(e) {

				var url='<?php echo base_url()?>index.php/comman_controler/get_top_banner_free';
				$.ajax({url:url,success:function(result){
					console.log(result);
					$('.top-banner-free').first().html(result);
				}});

		        var url='<?php echo base_url()?>index.php/comman_controler/get_top_banner';
				$.ajax({url:url,success:function(result){
					console.log(result);
					$('.top-banner').first().html(result);
				}});

				get_notifaction();
		        setInterval(function(){ 
		    			get_notifaction();
				}, 5000);
		    });
			</script>
			<script>
			function get_notifaction(){
				var url='<?php echo base_url()?>index.php/comman_controler/update_login_user_time/';
					
				// $.ajax({url:url,success:function(result){
				// 	var data = $.parseJSON(result);
				// 	$('.login_mem_llb').html(data[0]);
				// 	$('.login_day_llb').html(data[1]);
				// 	$('.tot_request_w').html(data[2]);
				// }});
			}
		</script>
		<style>
			.llb_span{
				float:right;
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
			.top-banner{
				margin: 10px;
			}
			.top-banner-free{
				margin:0;
			}
		</style>
