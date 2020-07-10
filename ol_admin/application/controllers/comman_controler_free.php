<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comman_controler_free extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('comman_controler_free_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}

	function get_memberdt_by_id(){
		$this->uri->segment(4);
		if($this->uri->segment(4)=='10'){
			$field='uplingmember10_3';
		}
		elseif($this->uri->segment(4)=='5'){
			$field='uplingmember5_3';
		}
		else{
			$field='uplingmember3_3';
		}
		$memberdt=$this->ObjM->get_member_all_detail_by_id($this->uri->segment(3));
		$referralid=$this->ObjM->get_member_detail_by_id($memberdt[0]['referralid']);
		$upling=$this->ObjM->get_member_detail_by_id($memberdt[0][''.$field.'']);
		
		echo $html='<tr><td width="25%">Name</td><td>'.$memberdt[0]['fname'].' '.$memberdt[0]['lname'].'</td></tr>
			   <tr><td>Referral</td><td>'.$referralid[0]['fname'].' '.$referralid[0]['lname'].'</td></tr>';
	}
	
	function check_email_address(){
		$result=$this->ObjM->check_email_address();
		if($result[0]['tot']>0){
			echo'flase';
			exit;
		}
		
		$result=$this->ObjM->check_email_address_panding_member();
		if($result[0]['tot']>0){
			echo'flase';
			exit;
		}
		//check in pandding
	}
	function check_username(){
		$result=$this->ObjM->check_username();
		if($result[0]['tot']>0){
			echo'flase';
			exit;
		}
		$result=$this->ObjM->check_username_panding_member();
		if($result[0]['tot']>0){
			echo'flase';
			exit;
		}
	}
	
	public function member_details_view()
	{
		$data['result']		=	$this->ObjM->get_member_all_detail_by_username($this->uri->segment(3));
		if(count($data['result'])!='1'){
			header('Location: '.base_url().'index.php/user');
			exit;
		}
		
		$data['referral']	=	$this->ObjM->get_member_detail_by_id($data['result'][0]['referralid']);
		$data['tot_ref']	=	$this->ObjM->get_total_referral($data['result'][0]['usercode']);
		$data['tree_uplig']	=	$this->ObjM->get_member_detail_by_id($data['result'][0]['uplingmember3_3']);
		$data['five_uplig']	=	$this->ObjM->get_member_detail_by_id($data['result'][0]['uplingmember5_3']);
		$data['ten_uplig']	=	$this->ObjM->get_member_detail_by_id($data['result'][0]['uplingmember10_3']);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('view_member_details_view',$data);
		$this->load->view('comman/footer');
	}
	
	function auto_camplate(){
		$user=$this->ObjM->get_user_filter($_GET["term"]);
		$json=array();
		for($i=0;$i<count($user);$i++){
			$name=$user[$i]['fname'].' '.$user[$i]['lname'].' ('.$user[$i]['usercode'].')';
			$json[]=array(
				'label'=>$name,
				'value'=>$user[$i]['usercode']
        	);
		}
		echo json_encode($json);
	}
	
	function get_level_summary(){

		$u_code = end(explode("/", $_SERVER['HTTP_REFERER']));

		if($this->uri->segment(3)!=''){
			$eid=$this->uri->segment(3);
		} else{
			$eid='';
		}
		$summary=$this->ObjM->get_level_summary($eid);
		
		$level_one		=	$this->ObjM->get_setting_value_by_lable('commission_level1');
		$level_two		=	$this->ObjM->get_setting_value_by_lable('commission_level2');
		$level_three	=	$this->ObjM->get_setting_value_by_lable('commission_level3');
		
		$m_pay_one		=	number_format((float)$level_one[0]['setting_value']*(int)$summary[0]['active_level_one3'],2);
		$m_pay_two		=	number_format((float)$level_two[0]['setting_value']*(int)$summary[0]['active_level_two3'],2);
		$m_pay_three	=	number_format((float)$level_three[0]['setting_value']*(int)$summary[0]['active_level_three3'],2);

		$tot_three_three_pay= number_format($m_pay_one+$m_pay_two+$m_pay_three,2);
		
		$tot_three_three_member=(int)$summary[0]['level_one3']+(int)$summary[0]['level_two3']+(int)$summary[0]['level_three3'];
		$tot_three_three_member_active=(int)$summary[0]['active_level_one3']+(int)$summary[0]['active_level_two3']+(int)$summary[0]['active_level_three3'];
		
		$level_payment		=	$this->ObjM->yesterday_payment_sum_by_level($u_code, '3by3');
		$level_sum		    =	$this->ObjM->yesterday_payment_sum($u_code, '3by3');

		if(isset($level_payment[0])){ $pay_level_one=$level_payment[0]['total'];}
		else{$pay_level_one='0.00';}		
		
		if(isset($level_payment[1])){ $pay_level_two=$level_payment[1]['total'];}
		else{$pay_level_two='0.00';}		
		
		if(isset($level_payment[2])){ $pay_level_three=$level_payment[2]['total'];}
		else{$pay_level_three='0.00';}		
		
		if($_REQUEST['tree']=='3')
		{
			$html='<table class="table table-bordered">
					<tr><th colspan="5">Summary for Stream 3x3</th></tr><tr>
					<td>Level</td>
					<td>People</td>
					<td>NO. of Active Users</td>
					<td>3x3 Monthly</td>
					<td>3x3 Daily(Yesterday)</td>
					</tr>
					<tr>
						<td>Level-1</td>
						<td>'.$summary[0]['level_one3'].'</td>
						<td>'.$summary[0]['active_level_one3'].'</td>
						<td>'.$m_pay_one.'</td>
						<td>$'.$pay_level_one.'</td>
					</tr>
					<tr>
						<td>Level-2</td>
						<td>'.$summary[0]['level_two3'].'</td>
						<td>'.$summary[0]['active_level_two3'].'</td>
						<td>'.$m_pay_two.'</td>
						<td>$'.$pay_level_two.'</td>
					</tr>
					<tr>
					<td>Level-3</td>
						<td>'.$summary[0]['level_three3'].'</td>
						<td>'.$summary[0]['active_level_three3'].'</td>
						<td>'.$m_pay_three.'</td>
						<td>$'.$pay_level_three.'</td>
					</tr>                  	
					<tr>
						<th>Total</td>
						<th>'.$tot_three_three_member.'</th>
						<th>'.$tot_three_three_member_active.'</th>
						<th>'.$tot_three_three_pay.'</th>
						<th>$'.$level_sum[0]['total'].'</th>
					</table>';
		}
		if($_REQUEST['tree']=='5')
		{
		$tot_three_five_member=(int)$summary[0]['level_one5']+(int)$summary[0]['level_two5']+(int)$summary[0]['level_three5'];
		$tot_three_five_member_active=(int)$summary[0]['active_level_one5']+(int)$summary[0]['active_level_two5']+(int)$summary[0]['active_level_three5'];
		
		$level_payment		=	$this->ObjM->yesterday_payment_sum_by_level($u_code, '5by3');
		$level_sum		    =	$this->ObjM->yesterday_payment_sum($u_code, '5by3');
		
		if(isset($level_payment[0])){ $pay_level_one=$level_payment[0]['total'];}
		else{$pay_level_one='0.00';}		
		
		if(isset($level_payment[1])){ $pay_level_two=$level_payment[1]['total'];}
		else{$pay_level_two='0.00';}		
		
		if(isset($level_payment[2])){ $pay_level_three=$level_payment[2]['total'];}
		else{$pay_level_three='0.00';}
		
		$html ='<table class="table table-bordered">
				<tr><th colspan="4">Summary for Stream 5x3</th></tr><tr>
				<td>Level</td>
				<td>People</td>
				<td>NO. of Active Users</td>
				<td>5x3 Daily(Yesterday)</td>
				</tr>
				<tr><td>Level-1</td><td>'.$summary[0]['level_one5'].'</td><td>'.$summary[0]['active_level_one5'].'</td><td>$'.$pay_level_one.'</td></tr>
				<tr><td>Level-2</td><td>'.$summary[0]['level_two5'].'</td><td>'.$summary[0]['active_level_two5'].'</td><td>$'.$pay_level_two.'</td></tr>
				<tr><td>Level-3</td><td>'.$summary[0]['level_three5'].'</td><td>'.$summary[0]['active_level_three5'].'</td><td>$'.$pay_level_three.'</td></tr>  
				<tr>
					<th>Total</th>
					<th>'.$tot_three_five_member.'</th>
					<th>'.$tot_three_five_member_active.'</th>
					<th>$'.$level_sum[0]['total'].'</th>
					        	
				</table>';
		 }		
		if($_REQUEST['tree']=='10')
		{
		$tot_three_ten_member=(int)$summary[0]['level_one10']+(int)$summary[0]['level_two10']+(int)$summary[0]['level_three10'];
		$tot_three_ten_member_active=(int)$summary[0]['active_level_one10']+(int)$summary[0]['active_level_two10']+(int)$summary[0]['active_level_three10'];
		$level_payment		=	$this->ObjM->yesterday_payment_sum_by_level($u_code, '10by3');
		$level_sum		    =	$this->ObjM->yesterday_payment_sum($u_code, '10by3');
		
		if(isset($level_payment[0])){ $pay_level_one=$level_payment[0]['total'];}
		else{$pay_level_one='0.00';}		
		
		if(isset($level_payment[1])){ $pay_level_two=$level_payment[1]['total'];}
		else{$pay_level_two='0.00';}		
		
		if(isset($level_payment[2])){ $pay_level_three=$level_payment[2]['total'];}
		else{$pay_level_three='0.00';}
		
		$html .='<table class="table table-bordered">
				<tr><th colspan="4">Summary for Stream 10x3</th></tr><tr>
				<td>Level</td>
				<td>People</td>
				<td>NO. of Active Users</td>
				<td>10x3 Daily(Yesterday)</td>
				</tr>
				<tr><td>Level-1</td><td>'.$summary[0]['level_one10'].'</td><td>'.$summary[0]['active_level_one10'].'</td><td>$'.$pay_level_one.'</td></tr>
				<tr><td>Level-2</td><td>'.$summary[0]['level_two10'].'</td><td>'.$summary[0]['active_level_two10'].'</td><td>$'.$pay_level_two.'</td></tr>
				<tr><td>Level-3</td><td>'.$summary[0]['level_three10'].'</td><td>'.$summary[0]['active_level_three10'].'</td><td>$'.$pay_level_three.'</td></tr>    
				<tr>
					<td>Total</td>
					<th>'.$tot_three_ten_member.'</th>
					<th>'.$tot_three_ten_member_active.'</th>
					<th>$'.$level_sum[0]['total'].'</th>
					  	
				</table>';
		}
		echo  $html;
	}
	
	function get_top_banner2()
	{
		$three			=	$this->ObjM->sum_by_pay_type('3by3');
		$five			=	$this->ObjM->sum_by_pay_type('5by3');
		$ten			=	$this->ObjM->sum_by_pay_type('10by3');
		$monthly    	= 	$this->ObjM->payment_monthly_by_type('monthly');
		$coded    		= 	$this->ObjM->payment_monthly_by_type('coded');
		$coded_match    = 	$this->ObjM->payment_monthly_by_type('coded_match');
		$residual    	= 	$this->ObjM->payment_monthly_by_type('residual');
		$residual_match = 	$this->ObjM->payment_monthly_by_type('residual_match');
		//$total			= 	$this->ObjM->payment_monthly_by_type();
		//$grant_total    =	number_format($three[0]['total']+$five[0]['total']+$ten[0]['total']+$total[0]['total'],2);
		//$balance		= 	$this->ObjM->get_main_balance();
		
		$html=' <ul class="top-banner">
		<li><a href="#">3x3 Monthly: <span>$'.$monthly[0]['total'].'</span></a></li>
		<li><a href="#">3x3 Daily:  <span>$'.$three[0]['total'].'<span></a></li>
		<li><a href="#">5x3 Daily: <span>$'.$five[0]['total'].'<span></a></li>
		<li><a href="#">10x3 Daily: <span>$'.$ten[0]['total'].'<span></a></li>
		<li><a href="#">Coded:<span>$'.$coded[0]['total'].'<span></a></li>
		<li><a href="#">Matching Coded: <span>$'.$coded_match[0]['total'].'<span></a></li>
		<li><a href="#">Residual: <span>$'.$residual[0]['total'].'<span></a></li>
		<li><a href="#">Res-Match: <span>$'.$residual_match[0]['total'].'<span></a></li>
		<div style="clear:both;overflow:hidden;"></div>
		</ul>';
		echo $html;
			
	}
	function get_top_banner()
	{
			
			$html='';
			
			if($this->session->userdata['logged_ol_member']['status']=='Active')
			{ 
				if($this->session->userdata['tbl']['current_account']=='Active')
				{
					$html.=$this->get_daily_payment_paid();	
						
				}
				else{
					$html.=$this->get_daily_payment_free();
				}
			}
			if($this->session->userdata['logged_ol_member']['status']=='Pending')
			{
					$html.=$this->get_daily_payment_free($summary);
			}
			
		if($this->session->userdata['logged_ol_member']['status']=='Pending')
		{
			$request	=	$this->ObjM->get_check_upgrade_request();
			if(!isset($request[0]))
			{
				//$html.='<div class="alert alert-error"><i class="icon-exclamation-sign"></i><strong>Upgrade Membership: </strong>Curently Your Membership Is Free For More Benefit Upgrade Your Membership';
				//$html.='<a href="'.base_url().'index.php/upgrade_membership/view" style="float:right;margin-top:-5px;"><button class="btn btn btn-warning"><strong>Upgrade Membership</strong></button></a> <span class="pull-right cls-txt1">ONE TIME PAYMENT &nbsp;</span></div>';
				
				$html.='<div class="banner-inner">
            			<div class="span8"><div class="alert alert-info magin0"><span class="hide_in_mobile">Curently Your Membership Is Free For More Benefit Upgrade Your Membership</span> </div></div>
       	 				<div class="span4"><div class="left_side info magin0"><strong>ONE TIME PAYMENT</strong> &nbsp;<a href="'.base_url().'index.php/upgrade_membership/view"><button class="btn btn btn-warning"><strong>Upgrade Membership</strong></button></a></div></div>
                		<div style="clear:both;overflow:hidden;"></div>
            		  </div>';
				
			}
			else{
				if($request[0]['payment']=='Y')
				{
					$cms_text	=	$this->ObjM->cms_by_lable('payment_receipt_label');
					$html.='<div class="alert alert-error"><i class="icon-ok-sign"></i>'.$cms_text[0]['textdt'].'</div>';
				}
				else
				{
					//$html.='<div class="alert alert-error"><i class="icon-exclamation-sign"></i><strong>Upgrade Membership: </strong>Curently Your Membership Is Free For More Benefit Upgrade Your Membership';
				//	$html.='<a href="'.base_url().'index.php/upgrade_membership/view" style="float:right;margin-top:-5px;"><button style="float:right;margin-top:-5px;" class="btn btn-warning"><strong>Upgrade Membership</strong></button></a><span class="pull-right cls-txt1">ONE TIME PAYMENT &nbsp;</span>';
					
					$html.='<div class="banner-inner">
            			<div class="span8"><div class="alert alert-info magin0"><span class="hide_in_mobile">Curently Your Membership Is Free For More Benefit Upgrade Your Membership</span></div></div>
       	 				<div class="span4"><div class="left_side info magin0"><strong>ONE TIME PAYMENT</strong> &nbsp;<a href="'.base_url().'index.php/upgrade_membership/view"><button class="btn btn btn-warning"><strong>Upgrade Membership</strong></button></a></div></div>
                		<div style="clear:both;overflow:hidden;"></div>
            		  </div>';
					
				}
			}
		
		}
		if($this->session->userdata['logged_ol_member']['status']=='Active' && $this->session->userdata['logged_ol_member']['usercode']!='1')
		{
			$duedt=date('M d Y', $this->session->userdata['logged_ol_member']['due_time']);
			$due_day7	=	strtotime('-7 day',$this->session->userdata['logged_ol_member']['due_time']);
			if(time() < $this->session->userdata['logged_ol_member']['due_time']){
				//$days_between = ceil(abs($this->session->userdata['logged_ol_member']['due_time'] - time()) / 86400);
				$msg='Your payment is due on';
			}
			else{
				$msg='Your payment Due on';
			}
			if($due_day7 < time()){
	
				$html.='<div class="banner-inner">
            			<div class="span8"><div class="alert alert-info magin0"><strong><i class="icon-ok-sign"></i>'.$msg.' </strong>'.$duedt.'</div></div>
       	 				<div class="span4"><div class="left_side info magin0 temp-hide"><a href="'.base_url().'index.php/monthly_payment_active_member/pay"><button class="btn btn btn-primary"><strong>Active Affiliate</strong></button></a></div></div>
                		<div style="clear:both;overflow:hidden;"></div>
            		  </div>';
				
			}
			
		}
		if($this->session->userdata['logged_ol_member']['status']=='Active'){
			$html.='<div class="pull-right"><strong>Payment Level : '.$this->session->userdata['logged_ol_member']['payment_level'].'</strong><div>';
		}
		
		
		echo $html;
		
		
	}
	
	function get_daily_payment_paid()
	{
		$data['master_sheet']		=	$this -> ObjM -> get_daily_payment_paid();
		$data['pay_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_type('monthly');
		$data['pay_c']				=	$this -> ObjM -> sum_monthly_pay_by_type('coded');
		$data['pay_cm']				=	$this -> ObjM -> sum_monthly_pay_by_type('coded_match');
		$data['pay_r']				=	$this -> ObjM -> sum_monthly_pay_by_type('residual');
		$data['pay_rm']				=	$this -> ObjM -> sum_monthly_pay_by_type('residual_match');
		$data['pay_refill']			=	$this -> ObjM -> sum_monthly_pay_by_type('refill');
		$data['daily_3']			=	$this -> ObjM -> sum_daily_pay_by_type('3by3');
		$data['daily_5']			=	$this -> ObjM -> sum_daily_pay_by_type('5by3');
		$data['daily_10']			=	$this -> ObjM -> sum_daily_pay_by_type('10by3');
		$tot_withdrawal				=	$this -> ObjM -> sum_withdrawal_balance('main_balance');	
		$tot_pif					=  	$this -> ObjM -> sum_withdrawal_balance_by_type('3'); 
		
		$dia_w						=	$this->diamond_class->main_balance();
		
		$html='<a href="'.base_url().'index.php/summary/account_summary" class="mobile_payment_summary_btn popover_link"><span class="badge badge-important">Account Summary</span></a><div style="clear:both;overflow:hidden;"></div>';
		$html.='<ul class="top-banner top_amount_list">
					<li><a href="#">3x3 Monthly:<span>$'.number_format($data['pay_monthly'],2).'</span></a></li>
					<li><a href="#">3x3 Daily:  <span>$'.number_format($data['daily_3'],2).'</span></a></li>
					<li><a href="#">5x3 Daily: <span>$'.number_format($data['daily_5'],2).'</span></a></li>
					<li><a href="#">10x3 Daily: <span>$'.number_format($data['daily_10'],2).'</span></a></li>
					<li><a href="#">Coded:<span>$'.number_format($data['pay_c'],2).'</span></a></li>
					<li><a href="#">Matching Coded: <span>$'.number_format($data['pay_cm'],2).'</span></a></li>
					<li><a href="#">Residual: <span>$'.number_format($data['pay_r'],2).'</span></a></li>
					<li><a href="#">Res-Match: <span>$'.number_format($data['pay_rm'],2).'</span></a></li>
					<li><a href="#">Total Withdrawal: <span>$'.number_format($tot_withdrawal,2).'</span></a></li>
					<li><a href="#">Total PIF: <span>$'.number_format($tot_pif,2).'</span></a></li>
					<li><a href="#"><strong>Company Wallet</strong>: <span>$'.$data['master_sheet'][0]['main_balance'].'<span></a></li>
					<li><a href="#"><strong>Personal Wallet</strong>: <span>$'.$data['master_sheet'][0]['personal_wallet'].'<span></a></li>
					<li><a href="'.diamond_base().'page/view"><strong>Diamond Wallet</strong>: <span>$'.number_format($dia_w['balance'],2).'<span></a></li>
					<div style="clear:both;overflow:hidden;"></div>
				</ul>';
		
		return $html;
	}
	
	
	
	function get_daily_payment_free()
	{
			
			$summary	=	$this->ObjM->get_level_summary();
			
			$one		=	$this->ObjM->get_setting_value_by_lable('commission_level1');
			$two		=	$this->ObjM->get_setting_value_by_lable('commission_level2');
			$three		=	$this->ObjM->get_setting_value_by_lable('commission_level3');
			
			
			$monthly_total=($summary[0]['active_level_one3']*$one[0]['setting_value'])+($summary[0]['active_level_two3']*$two[0]['setting_value'])+($summary[0]['active_level_three3']*$three[0]['setting_value']);
			

			$coded					=	$this->ObjM->get_coded_residual_id('coded');
			$coded_match			=	$this->ObjM->get_coded_residual_id('coded_match');
			$residual				=	$this->ObjM->get_coded_residual_id('residual');
			$residual_match			=	$this->ObjM->get_coded_residual_id('residual_match');
			
			$coded_pay				=	$this->ObjM->get_setting_value_by_lable('enrollment_code');
			$coded_match_pay		=	$this->ObjM->get_setting_value_by_lable('enrollment_code_match');
			$residual_pay			=	$this->ObjM->get_setting_value_by_lable('codded_residual');
			$residual_match_pay		=	$this->ObjM->get_setting_value_by_lable('coded_residual_match');
			
			$payment	=	$this->ObjM->get_daily_payment_free();
			
			
			$dia_w						=	$this->diamond_class->main_balance();
			
			$html='<a href="'.base_url().'index.php/summary/account_summary" class="mobile_payment_summary_btn popover_link"><span class="badge badge-important">Account Summary</span></a><div style="clear:both;overflow:hidden;"></div>';
			$html.=' <ul class="top-banner top_amount_list">
			<li><a href="#">3x3 Monthly: <span>$'.number_format($monthly_total,2).'</span></a></li>
			<li><a href="#">3x3 Daily:  <span>$'.$payment[0]['3by3daily'].'<span></a></li>
			<li><a href="#">5x3 Daily: <span>$'.$payment[0]['5by3daily'].'<span></a></li>
			<li><a href="#">10x3 Daily: <span>$'.$payment[0]['10by3daily'].'<span></a></li>
			<li><a href="#">Coded:<span>$'.number_format($coded[0]['tot']*$coded_pay[0]['setting_value'],2).'<span></a></li>
			<li><a href="#">Matching Coded: <span>$'.number_format($coded_match[0]['tot']*$coded_match_pay[0]['setting_value'],2).'<span></a></li>
			<li><a href="#">Residual: <span>$'.number_format($residual[0]['tot']*$residual_pay[0]['setting_value'],2).'<span></a></li>
			<li><a href="#">Res-Match: <span>$'.number_format($residual_match[0]['tot']*$residual_match_pay[0]['setting_value'],2).'<span></a></li>
			<li><a href="#"><strong>Wallet</strong>: <span>$'.$pay[3].'<span></a></li>
			<li><a href="'.diamond_base().'page/view"><strong>Diamond Wallet</strong>: <span>$'.number_format($dia_w['balance'],2).'<span></a></li>
			<div style="clear:both;overflow:hidden;"></div>
			</ul>';
			return $html;
	}
	
	function update_login_user_time()
	{
		$data['last_event']	=	time();
		$this->ObjM->update($data,'login_info','login_code',$this->session->userdata['logged_ol_member']['login_code']);
		$noti=$this->ObjM->get_notification($this->session->userdata['logged_ol_member']['usercode']);
		$json_arr=array();
		$json_arr['notif']=$noti[0]['tot'];
		echo json_encode($json_arr);
	
	}
	
	function payment_summary()
	{
			
	}

}

