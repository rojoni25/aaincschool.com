<?php

	if($this->comman_fun->check_record('smfund_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'admin'=>'Yes'))){
		$smfund_admin_valid	=	true;	
	}
	
	//if($this->comman_fun->check_record('d2v_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
//		$d2v_admin_valid	=	true;	
//	}
	
	if($this->comman_fun->check_record('dreem_student_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
		$dreem_student_admin_valid	=	true;	
	}
	
	if($this->comman_fun->check_record('dreem_student_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
		$dreem_student_member_valid	=	true;	
	}
	
	$arr_master=array('country','user','view_friends','coded_residual_details','network','change_password','change_username','change_email','request_to_renewal');
	$arr_system=array('site_setting');
	$arr_messagemenu=array('email_outbox','email_send','email_inbox','opportunity');
	$arr_matrix=array('three_by_three','five_by_three','ten_by_three','unilevel','coded_match_tree','residual_match_tree','residual_tree','coded_tree');
	$arr_product=array('capture_pages','auto_pages','member_pages','join_friend','n_product','auto_responder_email');
	$arr_finance=array('withdrawal_request','financial_report','summary','refill_account','my_wallet','money_transfer','payment_confirm','diamond');
	$arr_partners=array('auto_pages_par');
	$arr_r_matrix=array('r_matrix','r_matrix_tree','r_matrix_member','r_matrix_kdk_request','r_matrix_upgrade_pay','r_matrix_withdrawal','r_matrix_message');
	$arr_club_matrix=array('club');
	$arr_pdl_admin=array('pdl');
	$arr_smfund=array('smfund');
	
	
	
	if(in_array($this->uri->segment(1),$arr_master)){
		$main_master='active';
		if($this->uri->segment(1)=='coded_residual_details'){$sub_coded_residual_details='active';}
		elseif($this->uri->segment(1)=='user'){$sub_user='active';}
		elseif($this->uri->segment(1)=='view_friends'){$sub_view_friends='active';}
		elseif($this->uri->segment(1)=='network'){$sub_network='active';}
		elseif($this->uri->segment(1)=='change_password'){$sub_change_password='active';}
		elseif($this->uri->segment(1)=='change_username'){$sub_change_username='active';}
		elseif($this->uri->segment(1)=='change_email'){$sub_change_email='active';}
		elseif($this->uri->segment(1)=='request_to_renewal'){$sub_request_to_renewal='active';}
	}
	
	else if(in_array($this->uri->segment(1),$arr_messagemenu))
	{
		$main_messagemenu='active';
		if($this->uri->segment(1)=='email_outbox'){$sub_email_outbox='active';}
		elseif($this->uri->segment(1)=='email_send'){$sub_email_send='active';}
		elseif($this->uri->segment(1)=='email_inbox'){$sub_email_inbox='active';}
		elseif($this->uri->segment(1)=='opportunity'){
			if($this->uri->segment(3)=='business'){$sub_business='active';}
			elseif($this->uri->segment(2)=='page'){$sub_opportunity_page='active';}
			elseif($this->uri->segment(2)=='page_view'){$sub_opportunity_page='active';}
		}
	}
	else if(in_array($this->uri->segment(1),$arr_matrix))
	{
		$main_matrix='active';
		if($this->uri->segment(1)=='three_by_three'){$sub_three_by_three='active';}
		elseif($this->uri->segment(1)=='five_by_three'){$sub_five_by_three='active';}
		elseif($this->uri->segment(1)=='ten_by_three'){$sub_ten_by_three='active';}
		elseif($this->uri->segment(1)=='unilevel'){$sub_unilevel='active';}
		elseif($this->uri->segment(1)=='coded_match_tree'){$sub_coded_match_tree='active';}
		elseif($this->uri->segment(1)=='residual_match_tree'){$sub_residual_match_tree='active';}
		elseif($this->uri->segment(1)=='residual_tree'){$sub_residual_tree='active';}
		elseif($this->uri->segment(1)=='coded_tree'){$sub_coded_tree='active';}
	}
	
	else if(in_array($this->uri->segment(1),$arr_product))
	{
		$main_product='active';
		if($this->uri->segment(1)=='capture_pages'){$sub_capture_pages='active';}
		else if($this->uri->segment(1)=='auto_pages'){
			if($this->uri->segment(3)=='viral_marketing'){$sub_viral_marketing='active';}
			if($this->uri->segment(3)=='social_video_traffic'){$sub_social_video_traffic='active';}
		}
		else if($this->uri->segment(1)=='n_product'){$sub_n_product='active';}
		else if($this->uri->segment(1)=='member_pages'){$sub_member_pages='active';}
		else if($this->uri->segment(1)=='join_friend'){$sub_join_friend='active';}
		else if($this->uri->segment(1)=='auto_responder_email'){$sub_auto_responder_email='active';}
		
	}
	elseif($this->uri->segment(1)=='site_setting'){
		$main_site_setting='active';
		$sub_site_setting='active';
	}
	else if(in_array($this->uri->segment(1),$arr_finance))
	{
		$main_finance='active';
		if($this->uri->segment(1)=='withdrawal_request'){$sub_withdrawal_request='active';}
		elseif($this->uri->segment(1)=='financial_report'){$sub_financial_report='active';}
		elseif($this->uri->segment(1)=='summary'){$sub_summary='active';}
		elseif($this->uri->segment(1)=='refill_account'){$sub_refill_account='active';}
		elseif($this->uri->segment(1)=='my_wallet'){$sub_my_wallet='active';}
		elseif($this->uri->segment(1)=='money_transfer'){$sub_money_transfer='active';}
		elseif($this->uri->segment(1)=='payment_confirm'){
		if($this->uri->segment(2)=='report'){$sub_payment_confirm_report='active';}
			
		}
		
		elseif($this->uri->segment(1)=='diamond'){$sub_diamond_wallet='active';}

		
	}
	
	else if(in_array($this->uri->segment(1),$arr_partners))
	{
		$main_partners='active';
		if($this->uri->segment(3)=='web_conex'){$sub_web_conex='active';}
		elseif($this->uri->segment(3)=='nemafcu'){$sub_nemafcu='active';}
		else{$sub_partners='active';}
	}
	
	
	else if(in_array($this->uri->segment(1),$arr_r_matrix))
	{
		$main_r_matrix='active';

		if($this->uri->segment(1)=='r_matrix_tree'){$sub_r_matrix_tree='active';}
		elseif($this->uri->segment(1)=='r_matrix_member'){	$sub_r_matrix_member='active';}
		elseif($this->uri->segment(1)=='r_matrix_kdk_request'){	$sub_r_matrix_kdk_request='active';}
		elseif($this->uri->segment(1)=='r_matrix_message'){$sub_r_matrix_message_active='active';}	
		elseif($this->uri->segment(1)=='r_matrix_upgrade_pay'){
			if($this->uri->segment(2)=='pif_send_report'){	$sub_rm_pif_send_report='active';}
			elseif($this->uri->segment(2)=='pif_remaining'){$sub_rm_pif_remaining='active';}
		}
		elseif($this->uri->segment(1)=='r_matrix_withdrawal'){
			if($this->uri->segment(2)=='request'){	$sub_r_matrix_withdrawal_active='active'; }
			elseif($this->uri->segment(2)=='pif_remaining'){ $sub_rm_pif_remaining='active';}
		}
		elseif($this->uri->segment(1)=='r_matrix'){
			if($this->uri->segment(2)=='dashboard'){$sub_rm_dashboard='active';}
			elseif($this->uri->segment(2)=='kdk_code'){$sub_kdk_code='active';}
			elseif($this->uri->segment(2)=='request'){$sub_rm_request='active';}
			elseif($this->uri->segment(2)=='request_approve'){$sub_rm_request='active';}
			elseif($this->uri->segment(2)=='request_extra'){$sub_rm_request_extra='active';}
			elseif($this->uri->segment(2)=='kdk_pif'){$sub_rm_kdk_pif='active';}	
		}
	}
	
	else if(in_array($this->uri->segment(1),$arr_pdl_admin))
	{
		$main_pdl_admin='active';
		
		if($this->uri->rsegment(1)=='member_tree'){
			if($this->uri->rsegment(2)=='view'){$sub_pdl_tree='active';}
			elseif($this->uri->rsegment(2)=='member_view'){$sub_pdl_member='active';}
			elseif($this->uri->rsegment(2)=='subscription_under_review'){$sub_subscription_under_review='active';}	
		}
		
	}
	
	
	else if(in_array($this->uri->segment(1),$arr_r_matrix))
	{
		$main_r_matrix='active';
			
	}
	
	else if(in_array($this->uri->segment(1),$arr_club_matrix1))
	{
		$arr_coin_matrix='active';
			
	}
	
	elseif($this->uri->segment(1)=='vma_ad'){
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
	
	else if(in_array($this->uri->segment(1),$arr_smfund))
	{
		
		
		$arr1=array('capture_pages','cms_pages','member');
		$arr2=array('capture_pages_list','view_friends','welcome');
		
		if(in_array($this->uri->rsegment(1),$arr1)){
			$main_smfund_admin		=	'active';
			
			if($this->uri->rsegment(1)=='capture_pages'){
				if($this->uri->rsegment(2)=='view'){$smfund_admin_cap_view='active';}
				elseif($this->uri->rsegment(2)=='list_view'){$smfund_admin_cap_list='active';}
			}
			if($this->uri->rsegment(1)=='member'){
				if($this->uri->rsegment(2)=='view'){$smfund_admin_mem_view='active';}
				elseif($this->uri->rsegment(2)=='friend'){$smfund_admin_mem_friend='active';}
				elseif($this->uri->rsegment(2)=='outbox'){$smfund_admin_outbox='active';}
				elseif($this->uri->rsegment(2)=='inbox'){$smfund_admin_inbox='active';}
			}
			if($this->uri->rsegment(1)=='cms_pages'){
				$smfund_admin_cms_pages='active';
			}
		}
		
		if(in_array($this->uri->rsegment(1),$arr2)){
			$main_smfund_member		=	'active';
			if($this->uri->rsegment(1)=='capture_pages_list'){
				$smfund_mem_cp_list='active';
			}
			if($this->uri->rsegment(1)=='view_friends'){
				if($this->uri->rsegment(2)=='friend'){$smfund_mem_friend='active';}
				if($this->uri->rsegment(2)=='msg_to_admin'){$smfund_msg_to_admin		=	'active';}
				if($this->uri->rsegment(2)=='outbox'){$smfund_member_outbox		=	'active';}
				if($this->uri->rsegment(2)=='inbox'){$smfund_member_inbox		=	'active';}
			}
		}
		
		
	}
	else if($this->uri->segment(1)=='d2v')
	{
		$main_d2v='active';
			
	}
	else if($this->uri->segment(1)=='dreem_student')
	{
		$arr_ds	=	array('ad_cms','ad_dashboard','ad_join_request','ad_member');
		if(in_array($this->uri->rsegment(1),$arr_ds)){
			$main_dreem_student_admin	=	'active';
		}else{
			$main_dreem_student_mem	=	'active';
		}
		
			
	}
	
	else{
		$main_dashboard='active';
	}

?>

<?php
	if($this->session->userdata['logged_smfund_member']){
		$welcome_url	=	smfund().'/welcome/view';
	}else{
		$welcome_url	=	base_url().'index.php/welcome/';
	}
?>


<div class="layout">
<div class="navbar navbar-inverse top-nav">
  <div class="navbar-inner">
    <div class="container"> <span class="home-link"><a href="<?php echo $welcome_url;?>" class="icon-home1">Back To Home</a></span> <a class="brand" href="<?php echo base_url();?>index.php/dashboard"></a>
      <div class="nav-collapse navmainmenu">
        <ul class="nav">
          <li class="dropdown"><a  href="#"><strong>My Sponsor :</strong></a>
          <li class="dropdown"><a  href="#">
            <?=$this->session->userdata['ref']['name']?>
            </a>
          <li class="dropdown"><a  href="#">
            <?=$this->session->userdata['ref']['emailid']?>
            </a>
          <li class="dropdown"><a  href="#">
            <?=$this->session->userdata['ref']['mobileno']?>
            </a>
            <?php 
			 	if($this->session->userdata['ref']['skype']!='') {
					echo '<li class="dropdown"><a  href="skype:'.$this->session->userdata["ref"]["skype"].'?chat"><i class="flaticon-skype12"></i></a></li>';	
			  	}
				if($this->session->userdata['ref']['facebook_link']!='') {
					echo '<li class="dropdown"><a  href="'.$this->session->userdata["ref"]["facebook_link"].'"><i class="flaticon-facebook29"></i></a></li>';	
			  	}
				if($this->session->userdata['ref']['twitter_link']!='') {
					echo '<li class="dropdown"><a  href="'.$this->session->userdata["ref"]["twitter_link"].'"><i class="flaticon-twitter1"></i></a></li>';		
			  	}
				if($this->session->userdata['ref']['linkedin_link']!='') {
					echo '<li class="dropdown"><a  href="'.$this->session->userdata["ref"]["linkedin_link"].'"><i class="flaticon-linkedin11"></i></a></li>';	
			  	}
				if($this->session->userdata['ref']['googleplus_link']!='') {
					echo '<li class="dropdown"><a  href="'.$this->session->userdata["ref"]["googleplus_link"].'"><i class="flaticon-google2"></i></a></li>';		
			  	}
				if($this->session->userdata['ref']['youtube_link']!='') {
					echo '<li class="dropdown"><a  href="'.$this->session->userdata["ref"]["youtube_link"].'"><i class="flaticon-youtube18"></i></a></li>';		
			  	}
			  
			  ?>
          <li class="dropdown"><a  href="<?=base_url()?>index.php/opportunity/page/business">New Opportunities</a></li>
          </li>
        </ul>
      </div>
      <div class="btn-toolbar pull-right notification-nav">
        <div class="btn-group">
          <div class="dropdown"> <a href="<?=base_url()?>index.php/notification" class="btn btn-notification dropdown-toggle"><i class="icon-globe"><span class="notify-tip notification-cls">0</span></i></a> </div>
        </div>
        <div class="btn-group"> </div>
        <?php if($this->session->userdata['logged_ol_member']['status']=='Active')
		{ 
				if($this->session->userdata['tbl']['current_account']=='Active')
				{
					$change_text='Paid';
				}
				else{
					$change_text='Free';
				}
		?>
        <div class="btn-group">
          <div class="dropdown"> <a class="btn btn-notification dropdown-toggle" data-toggle="dropdown" style="font-size:14px;">
            <?=$change_text?>
            </a>
            <div class="dropdown-menu pull-right "> <a href="<?=base_url()?>index.php/login/go_in_paid" class="msg-container clearfix"><span class="notification-thumb" style="height:35px;width:35px;"></span> <span class="notification-intro" style="font-size:16px;"> Paid Account</span></a> <a href="<?=base_url()?>index.php/login/go_in_free" class="msg-container clearfix"><span class="notification-thumb" style="height:35px;width:35px;"></span> <span class="notification-intro" style="font-size:16px;"> Free Account</span></a> </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="leftbar leftbar-close clearfix">
  <div class="admin-info clearfix">
    <div class="admin-thumb" style="line-height:0px;"><img src="<?=base_url()?>upload/user_thum/<?=$this->session->userdata['logged_ol_member']['user_img']?>" style="height:50px;width:50px;" /></div>
    <div class="admin-meta">
      <ul>
        <li class="admin-username">
          <?=$this->session->userdata['logged_ol_member']['fullname']?>
        </li>
        <li><a href="<?php echo base_url();?>index.php/profile">Edit Profile</a></li>
        <li><a href="<?php echo base_url();?>index.php/profile">View Profile </a><a href="<?php echo base_url();?>index.php/login/logout"><i class="icon-lock"></i> Logout</a></li>
      </ul>
    </div>
  </div>
  <div class="left-nav clearfix">
    <div class="left-primary-nav">
      <ul id="myTab">
        <li class="<?=$main_dashboard?>"><a href="#main" class="icon-desktop" title="Dashboard"></a></li>
        <li class="<?=$main_master?>"><a href="#master" class="icon-th-large" title="Master"></a></li>
        <li class="<?=$main_messagemenu?>"><a href="#messagemenu" class="icon-folder-open" title="Message"></a></li>
        <li class="<?=$main_matrix?>"><a href="#matrix" class="icon-group" title="Matrix"></a></li>
        <li class="<?=$main_finance?>"><a href="#finance" class="icon-suitcase" title="Finance"></a></li>
        <li class="<?=$main_product?>"><a href="#product" class="icon-book" title="Product"></a></li>
        <li class="<?=$main_partners?>"><a href="#partners" class="icon-star" title="Partners"></a></li>
        <?php if($this->session->userdata["r_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_r_matrix?>"><a href="#r_matrix" class="icon-briefcase" title="KDK"></a></li>
        <?php } ?>
        <?php if($this->session->userdata["logged_ol_member"]['usercode']==PDL_SYSTEM_USER) {?>
        <li class="<?=$main_pdl_admin?>"><a href="#pdl_admin" class="icon-asterisk" title="PDL"></a></li>
        <?php } ?>
        <?php if($this->session->userdata["club_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_club_matrix?>"><a href="#club_matrix" class="icon-th-large" title="Club JOIN"></a></li>
        <?php } ?>
        <?php if($this->session->userdata["tl_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_tl_matrix?>"><a href="#tl_matrix" class="icon-th-large" title="Team Leverage JOIN"></a></li>
        <?php } ?>
        <!------TLC-------------->
      	<?php if($this->session->userdata["tlc_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_tlc_matrix?>"><a href="#tlc_matrix" class="icon-th-large" title="Ad Multiplier Admin"></a></li>
      	<?php } ?>
        <!-------TLC----------->
        <?php if($this->session->userdata["ang_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_ang_matrix?>"><a href="#ang_matrix" class="icon-th-large" title="Angle JOIN"></a></li>
        <?php } ?>
        <?php if($this->session->userdata["rec_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_rec_matrix?>"><a href="#rec_matrix" class="icon-th-large" title="REC JOIN"></a></li>
        <?php } ?>
        <?php if($this->session->userdata["gcp_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_gcp_matrix?>"><a href="#gcp_matrix" class="icon-th-large" title="GCP JOIN"></a></li>
        <?php } ?>
        <?php if($this->session->userdata["kdk1_matrix_admin"]['access']=='true'){?>
        <li class="<?=$main_gcp_matrix?>"><a href="#kdk1_matrix" class="icon-th-large" title="KDK1"></a></li>
        <?php } ?>
        
        <?php if($this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
        <li class="<?=$main_vma_section?>"><a href="#vma_admin" class="icon-th-large" title="VMA Admin"></a></li>
        <?php } ?>
        
        
        <!----DFSM(It's your dream now)-->
        <?php if($this->comman_fun->check_record('m2m_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
        <li class="<?=$main_m2m_admin?>"><a href="#m2m_admin" class="icon-flag" title="DFSM Admin"></a></li>
        <?php } ?>
        <?php if($this->comman_fun->check_record('m2m_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
        <li class="<?=$main_m2m_member?>"><a href="#m2m_member" class="fa fa-graduation-cap" title="DFSM"></a></li>
        <?php } ?>
        <!----DFSM(It's your dream now)-->
        
       
        
        <?php if($smfund_admin_valid){?>
        <li class="<?=$main_smfund_admin?>"><a href="#smfund_admin" class="icon-adjust " title="Smfund Admin"></a></li>
        <?php } ?>
		<?php if($this->session->userdata['logged_smfund_member']){?>
        	<li class="<?=$main_smfund_member?>"><a href="#smfund_member" class="icon-tint" title="Smfund Member"></a></li>
        <?php } ?>
        
      <?php /*?>  <?php if($d2v_admin_valid){?>
        <li class="<?=$main_d2v?>"><a href="#d2v_admin" class="icon-lightbulb" title="D2V Admin"></a></li>
        <?php } ?><?php */?>
        
        <?php if($dreem_student_admin_valid){?>
        	<li class="<?=$main_dreem_student_admin?>"><a href="#dreem_student_admin" class="icon-certificate" title="Dreem Student Admin"></a></li>
        <?php } ?>
        
        <?php if($dreem_student_member_valid){?>
        	<li class="<?=$main_dreem_student_mem?>"><a href="#dreem_student_member" class="icon-cog" title="Dreem Student Member"></a></li>
        <?php } ?>
        
        
        
      </ul>
    </div>
    <div class="responsive-leftbar"> <i class="icon-list"></i> </div>
    <div class="left-secondary-nav tab-content"> 
      
      <!--dashboard-->
      <div class="tab-pane  <?=$main_dashboard?>"  id="main">
        <h4 class="side-head">Dashboard</h4>
        <ul class="metro-sidenav clearfix">
          <li><a href="<?=base_url();?>index.php/network" class="brown"><i class="icon-user"></i><span>My Friend</span></a></li>
          <li><a href="<?=base_url();?>index.php/capture_pages" class="orange"><i class="icon-cogs"></i><span>Capture Pages</span></a></li>
          <li><a href="<?=base_url();?>index.php/cmspages/p/affiliate_page" class="green"><i class="icon-table"></i><span>Super Affiliate</span></a></li>
          <li><a href="<?=base_url();?>index.php/three_by_three" class="dark-yellow"><i class="icon-group"></i><span>My Matrix</span></a></li>
          <li><a href="<?=base_url();?>index.php/auto_responder_email" class="bondi-blue"><i class="icon-road"></i><span>Auto Responder</span></a></li>
          <li><a href="<?=base_url();?>index.php/auto_pages/page/viral_marketing" class="blue-violate"><i class="icon-thumbs-up"></i><span>Viral Marketers</span></a></li>
          <li><a href="<?=base_url();?>index.php/cmspages/p/trainning_page" class="dark-yellow"><i class="icon-tasks"></i><span>Training</span></a></li>
          <li><a href="<?=base_url();?>index.php/opportunity/page/business" class="cls-color-1"><i class="icon-file-alt"></i><span>Your Opportunities</span></a></li>
          <li><a href="<?=base_url();?>index.php/cmspages/p/webinar_page" class="cls-color-3"><i class="icon-headphones"></i><span>Webinar</span></a></li>
          <li><a href="<?=base_url();?>index.php/scompany/" class="cls-color-6"><i class="icon-trophy"></i><span>Team Build Partners</span></a></li>
 <!--         <li><a href="<?=base_url();?>index.php/d2v/page/view/" class="cls-color-13"><i class="icon-file-alt"></i><span><font style="color:#333 !important;">Direct 2 Voice</font></span></a></li>-->
          
          <?php /*?> <li><a href="<?=base_url();?>index.php/auto_pages/page/tax_exempt" class="brown"><i class="icon-file-alt"></i><span>Tax Exempt</span></a></li>    
            <li><a href="<?=base_url();?>index.php/diamond/page/view" class="cls-color-11"><p style="margin:0px;padding:0px;"><img style="margin-top:5px;" src="<?=base_url()?>asset/images/dd.png" /></p><span style="">
            <font style="color:#000;">Diamand Residual</font></span></a></li><?php */?>
          <?php if($this->session->userdata["r_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/rm_martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>KDK</span></a></li>
          <?php }else {
          		if($this->session->userdata["logged_ol_member"]['kdk_code_enter']=='true'){
					echo '<li><a href="'.base_url().'index.php/rm_martix/view/" class="cls-color-8"><i class="icon-file-alt"></i><span>KDK</span></a></li>';
				}
           } ?>
          <?php if($this->session->userdata["club_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/club/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>Club</span></a></li>
          <?php }?>
          <?php if($this->session->userdata["tl_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/tl/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>TL</span></a></li>
          <?php } ?>
         
         
         <!------TLC-------------->
<?php /*?>  		 <?php if($this->session->userdata["tlc_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/tlc/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>Ad Multiplier</span></a></li>
      	 <?php }?>
<?php */?>         <!------TLC-------------->
          
          
          
         <!------TLC NEW--------------> 
           <?php if($t=$this->session->userdata["tlc_matrix_join"]['join']=='true'){?>
			   <li><a href="<?=base_url();?>index.php/tlc/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>Ad Multiplier</span></a></li>
		   <?php }else{?>
				<li><a href="<?=base_url();?>index.php/tlc/page/view/?page_key=tlc" class="cls-color-7"><i class="icon-file-alt"></i><span>Ad Multiplier</span></a></li>   
		   <?php }?>
		  
         <!------TLC NEW-------------->
          
          <?php if($this->session->userdata["ang_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/ang/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>ANG</span></a></li>
          <?php } ?>
          <?php if($this->session->userdata["rec_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/rec/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>REC</span></a></li>
          <?php } ?>
          <?php if($this->session->userdata["gcp_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/gcp/martix/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>GCP</span></a></li>
          <?php } ?>
          <?php if($this->session->userdata["kdk1_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/kdk1/member/dashboard/" class="cls-color-7"><i class="icon-file-alt"></i><span>KDK wallet</span></a></li>
          <?php } ?>
          <?php if($this->session->userdata["pdl_matrix_join"]['join']=='true'){?>
          <li><a href="<?=base_url();?>index.php/pdl/pdl_member_home/view" class="brown"><i class="icon-file-alt"></i><span>PDL</span></a></li>
          <?php } ?>
          <?php /*?><li><a href="<?=base_url();?>index.php/cmspages/p/free_leads_page" class="cls-color-9"><i class="icon-file-alt"></i><span>Unlimited Leads</span></a></li><?php */?>
          <li><a href="<?=base_url();?>index.php/cms_s/page/vma" class="cls-color-10"><i class="icon-file-alt"></i><span>VMA Owners</span></a></li>
          <?php if($this->comman_fun->check_record('m2m_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
          
          <!----DFSM(It's your dream now)-->
           <li><a href="<?=base_url();?>index.php/m2m/page/view/" class="cls-color-12"><i class="fa fa-graduation-cap"></i><span>DFSM</span></a></li>
          <?php } ?>
          <!----DFSM(It's your dream now)-->
        
        </ul>
      </div>
      
      <!--master-->
      <div class="tab-pane <?=$main_master?>" id="master">
        <h4 class="side-head">Master</h4>
        <ul id="nav" class="accordion-nav">
          <li class="<?=$sub_view_friends?>"><a href="<?php echo base_url();?>index.php/view_friends"><i class="icon-th"></i> View Friend</a></li>
          <li class="<?=$sub_network?>"><a href="<?php echo base_url();?>index.php/network"><i class="icon-th"></i>Network</a></li>
          <li class="<?=$sub_summary?>"><a href="<?php echo base_url();?>index.php/summary"><i class="icon-th"></i>Summary</a></li>
          <li class="<?=$sub_change_password?>"><a href="<?php echo base_url();?>index.php/change_password/form"><i class="icon-th"></i>Change Password</a></li>
          <li class="<?=$sub_change_username?>"><a href="<?php echo base_url();?>index.php/change_username/form"><i class="icon-th"></i>Change Username</a></li>
          <li class="<?=$sub_change_email?>"><a href="<?php echo base_url();?>index.php/change_email/form"><i class="icon-th"></i>Change Email</a></li>
          <li class="<?=$sub_coded_residual_details?>"><a href="<?php echo base_url();?>index.php/coded_residual_details"><i class="icon-th"></i>Coded & Residual</a></li>
          <?php if($this->session->userdata['logged_ol_member']['status']=='Active') {?>
          <li class="<?=$sub_request_to_renewal?>"><a href="<?php echo base_url();?>index.php/request_to_renewal"><i class="icon-th"></i>PIF Balance</a></li>
          <?php } ?>
        </ul>
      </div>
      
      <!--Email-->
      <div class="tab-pane <?=$main_messagemenu?>" id="messagemenu">
        <h4 class="side-head">Email</h4>
        <ul class="accordion-nav">
          <li class="<?=$sub_email_inbox?>"><a href="<?php echo base_url();?>index.php/email_inbox"><i class="icon-">&#xf064;</i>Inbox</a></li>
          <li class="<?=$sub_email_outbox?>"><a href="<?php echo base_url();?>index.php/email_outbox"><i class="icon-">&#xf112;</i>Outbox</a></li>
          <li class="<?=$sub_email_send?>"><a href="<?php echo base_url();?>index.php/email_send"><i class="icon-">&#xf044;</i>Compose</a></li>
          <li class=""><a target="_blank" href="http://messenger.providesupport.com/messenger/0eesnosom64bt01pvcy5dphiow.html"><i class="icon-">&#xf0ac;</i>Live Support </a></li>
          <li class="<?=$sub_opportunity_page?>"><a href="<?php echo base_url();?>index.php/opportunity/page/"><i class="icon-th"></i>View My Opportunity</a></li>
        </ul>
      </div>
      
      <!--Matrix-->
      <div class="tab-pane <?=$main_matrix?>" id="matrix">
        <h4 class="side-head">Matrix</h4>
        <ul class="accordion-nav">
          <li class="<?=$sub_three_by_three?>"><a href="<?php echo base_url();?>index.php/three_by_three"><i class="icon-">&#xf022;</i>3 x 3</a></li>
          <li class="<?=$sub_five_by_three?>"><a href="<?php echo base_url();?>index.php/five_by_three"><i class="icon-">&#xf022;</i>5 x 3</a></li>
          <li class="<?=$sub_ten_by_three?>"><a href="<?php echo base_url();?>index.php/ten_by_three"><i class="icon-">&#xf022;</i>10 x 3</a></li>
          <li class="<?=$sub_unilevel?>"><a href="<?php echo base_url();?>index.php/unilevel"><i class="icon-">&#xf022;</i>Unilevel</a></li>
          <li class="<?=$sub_coded_tree?>"><a href="<?php echo base_url();?>index.php/coded_tree"><i class="icon-">&#xf022;</i>Coded</a></li>
          <li class="<?=$sub_coded_match_tree?>"><a href="<?php echo base_url();?>index.php/coded_match_tree"><i class="icon-">&#xf022;</i>Coded Match</a></li>
          <li class="<?=$sub_residual_tree?>"><a href="<?php echo base_url();?>index.php/residual_tree"><i class="icon-">&#xf022;</i>Residual</a></li>
          <li class="<?=$sub_residual_match_tree?>"><a href="<?php echo base_url();?>index.php/residual_match_tree"><i class="icon-">&#xf022;</i>Residual Match</a></li>
        </ul>
      </div>
      
      <!--Finance-->
      <div class="tab-pane <?=$main_finance?>" id="finance">
        <h4 class="side-head">Finance</h4>
        <ul class="accordion-nav">
          <?php if($this->session->userdata['logged_ol_member']['status']=='Active') { ?>
          <li class="<?=$sub_withdrawal_request?>"><a href="<?php echo base_url();?>index.php/withdrawal_request"><i class="icon-">&#xf022;</i>Withdrawal Request</a></li>
          <li class="<?=$sub_financial_report?>"><a href="<?php echo base_url();?>index.php/financial_report"><i class="icon-">&#xf0d6;</i>Financial Report</a></li>
          <li class="<?=$sub_summary?>"><a href="<?php echo base_url();?>index.php/summary"><i class="icon-">&#xf022;</i>Summary</a></li>
          <?php /*?><li class="<?=$sub_refill_account?>"><a href="<?php echo base_url();?>index.php/refill_account"><i class="icon-">&#xf022;</i>Refill Account</a></li><?php */?>
          <li class="<?=$sub_my_wallet?>"><a href="<?php echo base_url();?>index.php/my_wallet"><i class="icon-">&#xf022;</i>My Wallet</a></li>
          <li class="<?=$sub_money_transfer?>"><a href="<?php echo base_url();?>index.php/money_transfer"><i class="icon-">&#xf022;</i>Money Transfer</a></li>
          <?php  } ?>
          <li class="<?=$sub_payment_confirm_report?>"><a href="<?php echo base_url();?>index.php/payment_confirm/report"><i class="icon-">&#xf022;</i>Payment Confirm</a></li>
          <li class="<?=$sub_diamond_wallet?>"><a href="<?php echo base_url();?>index.php/diamond/page/view"><i class="icon-">&#xf022;</i>Diamond Wallet</a></li>
        </ul>
      </div>
      
      <!--Product-->
      <div class="tab-pane <?=$main_product?>" id="product">
        <h4 class="side-head">Product</h4>
        <ul class="accordion-nav">
          <li class="<?=$sub_capture_pages?>"><a href="<?php echo base_url();?>index.php/capture_pages"><i class="icon-th"></i>Free Capture Pages</a></li>
          <li class="n_product_bg"><a href="<?php echo base_url();?>index.php/n_product">&nbsp;</a></li>
          <li class="<?=$sub_member_pages?>"><a href="<?php echo base_url();?>index.php/member_pages"><i class="icon-th"></i>Member Pages</a></li>
          <?php /*?><li class="social_video_traffic"><a href="<?php echo base_url();?>index.php/auto_pages/page/social_video_traffic">&nbsp;</a></li><?php */?>
          <li class="viral_marketing"><a href="<?php echo base_url();?>index.php/vma/page/view">&nbsp;</a></li>
          <?php /*?> <li class="viral_marketing"><a href="<?php echo base_url();?>index.php/auto_pages/page/viral_marketing">&nbsp;</a></li><?php */?>
          <li class="<?=$sub_join_friend?>"><a href="<?php echo base_url();?>index.php/join_friend/"><i class="icon-th"></i>Join Friend</a></li>
          <li class="<?=$sub_business?>"><a href="<?php echo base_url();?>index.php/opportunity/page/business"><i class="icon-th"></i>New Opportunities</a></li>
          <li class="<?=$sub_auto_responder_email?>"><a href="<?php echo base_url();?>index.php/auto_responder_email"><i class="icon-th"></i>Auto Responder Email</a></li>
          <li class="<?=$sub_business?>"><a href="<?php echo base_url();?>index.php/cmspages/p/free_leads_page"><i class="icon-th"></i>Free Leads</a></li>
          <li class="<?=$sub_business?>"><a href="<?php echo base_url();?>index.php/cmspages/p/free_tools_page"><i class="icon-th"></i>Free Tools</a></li>
          <li class="<?=$sub_business?>"><a href="<?php echo base_url();?>index.php/cmspages/affiliate"><i class="icon-th"></i>Active Affiliate</a></li>
          <li class=""><a href="<?=base_url();?>index.php/auto_pages/page/50k_credit_tax_guru"><i class="icon-th"></i>50K Credit Tax Guru</a></li>
          <li class=""><a href="<?=base_url();?>index.php/n_product/"><i class="icon-th"></i>AMS</a></li>
        </ul>
      </div>
      
      <!--Partners-->
      <div class="tab-pane <?=$main_partners?>" id="partners">
        <h4 class="side-head">Partners</h4>
        <ul id="nav" class="accordion-nav">
          <li class="<?=$sub_partners?>"><a href="<?=base_url();?>index.php/cmspages/p/partners_page"><i class="icon-th"></i>Partners</a></li>
          <li class="<?=$sub_web_conex?>"><a href="<?php echo base_url();?>index.php/auto_pages_par/page/web_conex"><i class="icon-th"></i>WBNES</a></li>
          <li class="<?=$sub_nemafcu?>"><a href="<?php echo base_url();?>index.php/auto_pages_par/page/nemafcu"><i class="icon-th"></i>NEMAFCU</a></li>
        </ul>
      </div>
      
      <!--R-Matrix-->
      <?php if($this->session->userdata["club_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$arr_coin_matrix?>" id="club_matrix">
        <h4 class="side-head">Club Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$arr_coin_matrix?>"><a href="<?php echo base_url();?>index.php/club/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      
      <!--R-Matrix-->
      <?php if($this->session->userdata["r_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_r_matrix?>" id="r_matrix">
        <h4 class="side-head">R-Matrix Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_r_matrix?>"><a href="<?php echo base_url();?>index.php/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      
      <?php if($this->session->userdata["tl_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_tl_matrix?>" id="tl_matrix">
        <h4 class="side-head">TL-Matrix Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_tl_matrix?>"><a href="<?php echo base_url();?>index.php/tl/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <!------TLC-------------->
       <?php if($this->session->userdata["tlc_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_tlc_matrix?>" id="tlc_matrix">
        <h4 class="side-head">AM-Matrix Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_tlc_matrix?>"><a href="<?php echo base_url();?>index.php/tlc/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <!------TLC-------------->
      <?php if($this->session->userdata["ang_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_ang_matrix?>" id="ang_matrix">
        <h4 class="side-head">ANG-Matrix Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_ang_matrix?>"><a href="<?php echo base_url();?>index.php/ang/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($this->session->userdata["rec_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_rec_matrix?>" id="rec_matrix">
        <h4 class="side-head">REC-Matrix Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_rec_matrix?>"><a href="<?php echo base_url();?>index.php/rec/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($this->session->userdata["gcp_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_gcp_matrix?>" id="gcp_matrix">
        <h4 class="side-head">GCP Admin Menu</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_gcp_matrix?>"><a href="<?php echo base_url();?>index.php/gcp/r_matrix/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($this->session->userdata["kdk1_matrix_admin"]['access']=='true'){?>
      <div class="tab-pane <?=$main_gcp_matrix?>" id="kdk1_matrix">
        <h4 class="side-head">KDK1 Admin</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_kdk1_matrix?>"><a href="<?php echo base_url();?>index.php/kdk1/ad_dashboard/dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
      <div class="tab-pane <?=$main_vma_section?>" id="vma_admin">
        <h4 class="side-head">VMA Admin</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_dashboard?>"><a href="<?php echo vma_ad();?>dashboard/view"><i class="icon-dashboard"></i>Dashboard</a></li>
          <li class="<?=$sub_vma_join_request?>"><a href="<?php echo vma_ad();?>request/view"><i class="icon-file-alt"></i>Join Request</a></li>
          <li class="<?=$sub_vma_payment_confirm?>"><a href="<?php echo vma_ad();?>general/payment_confirm"><i class="icon-file-alt"></i>Payment Confirm</a></li>
          <li class="<?=$sub_vma_member?>"><a href="<?php echo vma_ad();?>member/view"><i class="icon-file-alt"></i>Member</a></li>
          <li class="<?=$sub_vma_tree?>"><a href="<?php echo vma_ad();?>tree/view/"><i class="icon-file-alt"></i>Tree View</a></li>
          <li class="<?=$sub_vma_balance_sheet?>"><a href="<?php echo vma_ad();?>report/balance_sheet"><i class="icon-file-alt"></i>Balance Sheet</a></li>
          <li class="<?=$sub_virtual_wallet_month_vise?>"><a href="<?php echo vma_ad();?>report/virtual_wallet_month_vise"><i class="icon-file-alt"></i>Virtual Payment Report</a></li>
          <li class="<?=$sub_unqulified?>"><a href="<?php echo vma_ad();?>report/unqulified"><i class="icon-file-alt"></i>Unqulified Pay. Report</a></li>
          <li class="<?=$sub_vma_withdrawal?>"><a href="<?php echo vma_ad();?>withdrawal/request"><i class="icon-file-alt"></i>Withdrawal Request</a></li>
        </ul>
      </div>
      <?php } ?>
      
      <!--Partners-->
      <?php if($this->session->userdata["logged_ol_member"]['usercode']==PDL_SYSTEM_USER) {?>
      <div class="tab-pane <?=$main_pdl_admin?>" id="pdl_admin">
        <h4 class="side-head">PDL</h4>
        <ul id="nav" class="accordion-nav">
          <li class="<?=$sub_pdl_dashboard?>"><a href="<?=base_url();?>index.php/pdl/dashboard/view/"><i class="icon-th"></i>Dashboard</a></li>
          <li class="<?=$sub_pdl_tree?>"><a href="<?=base_url();?>index.php/pdl/member_tree/view/<?=PDL_SYSTEM_USER?>"><i class="icon-th"></i>Tree</a></li>
          <li class="<?=$sub_pdl_member?>"><a href="<?=base_url();?>index.php/pdl/member_tree/member_view"><i class="icon-th"></i>Member List</a></li>
          <li class="<?=$sub_subscription_under_review?>"><a href="<?=base_url();?>index.php/pdl/member_tree/subscription_under_review"><i class="icon-th"></i>Under Review</a></li>
          <li class="<?=$sub_pdl_cms?>"><a href="<?=base_url();?>index.php/pdl/cms/view"><i class="icon-th"></i>CMS</a></li>
          <li class="<?=$sub_fund_distribution?>"><a href="<?=base_url();?>index.php/pdl/fund_distribution/view"><i class="icon-th"></i>Fund Distribution</a></li>
          <li class="<?=$sub_pdl_withdrawal_request?>"><a href="<?=base_url();?>index.php/pdl/withdrawal_request/view"><i class="icon-th"></i>Withdrawal Request</a></li>
          <li class="<?=$sub_pdl_withdrawal_request?>"><a href="<?=base_url();?>index.php/pdl/withdrawal_request/pdl_to_opp_payment"><i class="icon-th"></i>Opp. Payment</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($this->comman_fun->check_record('m2m_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
      <div class="tab-pane <?=$main_m2m_admin?>" id="m2m_admin">
        <!----DFSM(It's your dream now)-->
        <h4 class="side-head">DFSM Admin</h4>
          <!----DFSM(It's your dream now)-->
        <ul class="accordion-nav">
          <li class=""><a href="<?=base_url();?>index.php/m2m/ad_dashboard"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($this->comman_fun->check_record('m2m_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
      <div class="tab-pane <?=$main_m2m_member?>" id="m2m_member">
      	<!----DFSM(It's your dream now)-->
      	<h4 class="side-head">DFSM</h4>
        <!----DFSM(It's your dream now)-->
        <ul class="accordion-nav">
          <li class=""><a href="<?=base_url();?>index.php/m2m/page/view"><i class="icon-dashboard"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      <?php if($smfund_admin_valid){?>
      <div class="tab-pane <?=$main_smfund_admin?>" id="smfund_admin">
        <h4 class="side-head">Smfund Admin</h4>
        <ul class="accordion-nav">
          <li class="<?=$smfund_admin_cap_view?>"><a href="<?=smfund();?>capture_pages/view"><i class="icon-th"></i>Add Capture Page</a></li>
          <li class="<?=$smfund_admin_cms_pages?>"><a href="<?=smfund();?>cms_pages/view/"><i class="icon-th"></i>CMS</a></li>
          <li class="<?=$smfund_admin_cap_list?>"><a href="<?=smfund();?>capture_pages/list_view"><i class="icon-th"></i>View Capture Page</a></li>
          <li class="<?=$smfund_admin_mem_view?>"><a href="<?=smfund();?>member/view"><i class="icon-th"></i>Member List</a></li>
          <li class="<?=$smfund_admin_mem_friend?>"><a href="<?=smfund();?>member/friend"><i class="icon-th"></i>Your Friend</a></li>
          
          <li class="<?=$smfund_admin_outbox?>"><a href="<?=smfund();?>member/outbox"><i class="icon-th"></i>Outbox</a></li>
          <li class="<?=$smfund_admin_inbox?>"><a href="<?=smfund();?>member/inbox"><i class="icon-th"></i>Inbox</a></li>
          
        </ul>
      </div>
      <?php } ?>
      
     
      
      <?php if($this->session->userdata['logged_smfund_member']){?>
            <div class="tab-pane <?=$main_smfund_member?>" id="smfund_member">
                <h4 class="side-head">Smfund Member</h4>
                <ul class="accordion-nav">
                   <li class="<?=$smfund_mem_cp_list?>"><a href="<?=smfund();?>capture_pages_list/"><i class="icon-th"></i>View Capture Page</a></li>		
                <li class="<?=$smfund_mem_friend?>"><a href="<?=smfund();?>view_friends/friend"><i class="icon-th"></i>Your Friend</a></li>
                
                 <li class="<?=$smfund_msg_to_admin?>"><a href="<?=smfund();?>view_friends/msg_to_admin"><i class="icon-th"></i>Message To Admin</a></li>
                <li class="<?=$smfund_member_outbox?>"><a href="<?=smfund();?>view_friends/outbox"><i class="icon-th"></i>Outbox</a></li>
          		<li class="<?=$smfund_member_inbox?>"><a href="<?=smfund();?>view_friends/inbox"><i class="icon-th"></i>Inbox</a></li>
                </ul>
            </div>
       <?php } ?>
       
     <?php /*?> <?php if($d2v_admin_valid){?>
      	<div class="tab-pane <?=$main_d2v?>" id="d2v_admin">
        <h4 class="side-head">D2V Admin</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_d2v?>"><a href="<?=base_url();?>index.php/d2v/ad_dashboard/"><i class="icon-th"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?> <?php */?>
      
       <?php if($dreem_student_admin_valid){?>
      	<div class="tab-pane <?=$main_dreem_student_admin?>" id="dreem_student_admin">
        <h4 class="side-head">Dreem Student Admin</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_dreem_student_admin?>"><a href="<?=base_url();?>index.php/dreem_student/ad_dashboard/"><i class="icon-th"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?> 
      
      <?php if($dreem_student_member_valid){?>
      	<div class="tab-pane <?=$main_dreem_student_mem?>" id="dreem_student_member">
        <h4 class="side-head">Dreem Student Member</h4>
        <ul class="accordion-nav">
          <li class="<?=$main_dreem_student_mem?>"><a href="<?=base_url();?>index.php/dreem_student/page/view/"><i class="icon-th"></i>Dashboard</a></li>
        </ul>
      </div>
      <?php } ?>
      
      
       
    </div>
  </div>
</div>



<div class="main-wrapper">
<div class="container-fluid">
<script>
	$(document).ready(function(e) {
        var url='<?php echo base_url()?>index.php/comman_controler/get_top_banner/';
		$.ajax({url:url,success:function(result){
			$('.top-banner').html(result);
			
		}});
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
<link rel="stylesheet" href="<?=base_url();?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url();?>asset/popover/jquery.webui-popover.min.js"></script>
<style>
	.banner-inner{
		background-color:#5299b7;
		margin-bottom:10px;
	}
	.left_side{
		padding:8px;
		text-align:right;
		color:#FFF;
		
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
