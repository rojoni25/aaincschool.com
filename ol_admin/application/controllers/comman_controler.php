<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comman_controler extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('comman_controler_model','ObjM',TRUE);
		$this->load->model('user_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	function get_memberdt_by_id(){
		
		if($this->uri->segment(4)=='3'){
			$field='uplingmember3_3';
			$lable_name='3 x 3 Balance';
			$lable_value='3by3';
			$file_name='three_by_three';
		}
		elseif($this->uri->segment(4)=='5'){
			$field='uplingmember5_3';
			$lable_name='5 x 3 Balance';
			$lable_value='5by3';
			$file_name='five_by_three';
		}
		else{
			$field='uplingmember10_3';
			$lable_name='10 x 3 Balance';
			$lable_value='10by3';
			$file_name='ten_by_three';
		}
		$memberdt=$this->ObjM->get_member_all_detail_by_id($this->uri->segment(3));
		$referralid=$this->ObjM->get_member_detail_by_id($memberdt[0]['referralid']);
		$upling=$this->ObjM->get_member_detail_by_id($memberdt[0][''.$field.'']);
		
		echo $html='<table class="table">
				<tr><td width="30%">Usercode</td><td width="70%"><a href="'.base_url().'index.php/'.$file_name.'/view/'.$memberdt[0]['usercode'].'">'.$memberdt[0]['usercode'].'</a></td></tr>
				<tr><td >Name</td><td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$memberdt[0]['username'].'">'.$memberdt[0]['fname'].' '.$memberdt[0]['lname'].'</a></td></tr>
			   <tr><td>Referral</td><td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$referralid[0]['username'].'">'.$referralid[0]['fname'].' '.$referralid[0]['lname'].'</a></td></tr>
			   <tr><td>Uplink</td><td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$upling[0]['username'].'">'.$upling[0]['fname'].' '.$upling[0]['lname'].'</a></td></tr>
			   <tr><td>Mobile No</td><td>'.$memberdt[0]['mobileno'].'</td></tr>
			   <tr><td>Phone Number</td><td>'.$memberdt[0]['phone_no'].'</td></tr>
			   <tr><td>'.$lable_name.'</td><td>'.$memberdt[0][$lable_value].'</td></tr></table>';
	}
	
	
	
	function check_email_address(){
		$result=$this->ObjM->check_email_address();
		if($result[0]['tot']>0){
			echo'flase';
			exit;
		}
	}
	function check_username(){
		$result=$this->ObjM->check_username();
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
		
		$data['referral_paid']		=	$this->ObjM->get_member_detail_by_id($data['result'][0]['referralid']);
		$data['referral_free']		=	$this->ObjM->get_member_detail_by_id($data['result'][0]['referralid_free']);
		$data['tot_ref']			=	$this->ObjM->get_total_referral($data['result'][0]['usercode']);
		
		$data['tree_uplig']			=	$this->ObjM->get_member_detail_by_id($data['result'][0]['uplingmember3_3']);
		$data['five_uplig']			=	$this->ObjM->get_member_detail_by_id($data['result'][0]['uplingmember5_3']);
		$data['ten_uplig']			=	$this->ObjM->get_member_detail_by_id($data['result'][0]['uplingmember10_3']);
		
		if($data['result'][0]['status']=='Active')
		{
			$paid							=	$this->ObjM->get_paid_tree_detail($data['result'][0]['usercode']);
			$data['tree_uplig_paid']		=	$this->ObjM->get_member_detail_by_id($paid[0]['uplingmember3_3']);
			$data['five_uplig_paid']		=	$this->ObjM->get_member_detail_by_id($paid[0]['uplingmember5_3']);
			$data['ten_uplig_paid']			=	$this->ObjM->get_member_detail_by_id($paid[0]['uplingmember10_3']);	
		}
		
		$data['free_chain']		= $this->get_member_chain($data['result'][0]['usercode']);	
		
		
		$data['level_summary']		=	$this->ObjM->get_level_summary($data['result'][0]['usercode']);
		$data['level_summary_free'] =	$this->ObjM->get_level_summary_free($data['result'][0]['usercode']);

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('view_member_details_view',$data);
		$this->load->view('comman/footer');
	}
	
	protected function get_member_chain($code)
	{	
		$user['bread']=array();
		$break_loop=false;
		while(1){
			$result=$this->ObjM->get_member_detail_by_id($code);
			if(!isset($result[0]) || $result[0]['referralid_free']=='0'){
				$break_loop=true;	
			}
			
			$rt=array();
			$rt['name']		=	$result[0]['fname'].' '.$result[0]['lname'];
			$rt['usercode']	=	$result[0]['usercode'];
			$rt['status']	=	$result[0]['status'];
			$rt['username']	=	$result[0]['username'];
			
			if($result[0]['status']=='Pending')
			{
				$request=$this->ObjM->check_paid_request($result[0]['usercode']);	
				if(isset($request[0]))
				{
					$rt['pstatus']=$request[0]['status'];
					$rt['payment']=$request[0]['payment'];
				}
				
			}
			$user['bread'][]=$rt;
			$code=$result[0]['referralid_free'];
			if($break_loop){
				break;
			}
			
		}
		$newArray = array_reverse($user['bread'], false);
		return $newArray;
	}
	
	function auto_camplate(){
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->get_user_filter($filter);
	
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
	
	
	function auto_camplate_active(){
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->get_user_filter_active($filter);
	
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
		if($this->uri->segment(3)!=''){
			$eid=$this->uri->segment(3);
		}
		else{
			$eid='1';
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
		
		$level_payment		=	$this->ObjM->yesterday_payment_sum_by_level($eid,'3by3');
		$level_sum		    =	$this->ObjM->yesterday_payment_sum($eid,'3by3');
		
		if(isset($level_payment[0])){ $pay_level_one=$level_payment[0]['total'];}
		else{$pay_level_one='0.00';}		
		
		if(isset($level_payment[1])){ $pay_level_two=$level_payment[1]['total'];}
		else{$pay_level_two='0.00';}		
		
		if(isset($level_payment[2])){ $pay_level_three=$level_payment[2]['total'];}
		else{$pay_level_three='0.00';}		
	
		if($_REQUEST['tree']=='3'){
			$html='<table class="table table-bordered">
				<tr><th colspan="5">Summary for Stream 3x3</th></tr><tr>
				<td>Level</td>
				<td>People</td>
				<td>NO. of Active Users</td>
				<td>3x3 Monthly</td>
				<td>3x3 Daily(Yesterday)</td>
				</tr>
				<tr><td>Level-1</td><td>'.$summary[0]['level_one3'].'</td><td>'.$summary[0]['active_level_one3'].'</td><td>'.$m_pay_one.'</td><td>$'.$pay_level_one.'</td></tr>
				<tr><td>Level-2</td><td>'.$summary[0]['level_two3'].'</td><td>'.$summary[0]['active_level_two3'].'</td><td>'.$m_pay_two.'</td><td>$'.$pay_level_two.'</td></tr>
				<tr><td>Level-3</td><td>'.$summary[0]['level_three3'].'</td><td>'.$summary[0]['active_level_three3'].'</td><td>'.$m_pay_three.'</td><td>$'.$pay_level_three.'</td></tr>                  	
				<tr>
					<th>Total</td>
					<th>'.$tot_three_three_member.'</th>
					<th>'.$tot_three_three_member_active.'</th>
					<th>'.$tot_three_three_pay.'</th>
					<th>$'.$level_sum[0]['total'].'</th>
				</table>';
		
		}
		
		if($_REQUEST['tree']=='5'){
		$tot_three_five_member=(int)$summary[0]['level_one5']+(int)$summary[0]['level_two5']+(int)$summary[0]['level_three5'];
		$tot_three_five_member_active=(int)$summary[0]['active_level_one5']+(int)$summary[0]['active_level_two5']+(int)$summary[0]['active_level_three5'];
		
		$level_payment		=	$this->ObjM->yesterday_payment_sum_by_level($eid,'5by3');
		$level_sum		    =	$this->ObjM->yesterday_payment_sum($eid,'5by3');
		
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
		if($_REQUEST['tree']=='10'){
		
		$tot_three_ten_member=(int)$summary[0]['level_one10']+(int)$summary[0]['level_two10']+(int)$summary[0]['level_three10'];
		$tot_three_ten_member_active=(int)$summary[0]['active_level_one10']+(int)$summary[0]['active_level_two10']+(int)$summary[0]['active_level_three10'];
		$level_payment		=	$this->ObjM->yesterday_payment_sum_by_level($eid,'10by3');
		$level_sum		    =	$this->ObjM->yesterday_payment_sum($eid,'10by3');
		
		if(isset($level_payment[0])){ $pay_level_one=$level_payment[0]['total'];}
		else{$pay_level_one='0.00';}		
		
		if(isset($level_payment[1])){ $pay_level_two=$level_payment[1]['total'];}
		else{$pay_level_two='0.00';}		
		
		if(isset($level_payment[2])){ $pay_level_three=$level_payment[2]['total'];}
		else{$pay_level_three='0.00';}
		
		$html ='<table class="table table-bordered">
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

	// function get_top_banner()
	// {
	// 	$usercode = end(explode("/", $_SERVER['HTTP_REFERER']));
	// 	if ($usercode=="") {
	// 		$usercode=1;
	// 	}

	// 	$three			=	$this->ObjM->sum_by_pay_type($usercode, '3by3');
	// 	$five			=	$this->ObjM->sum_by_pay_type($usercode, '5by3');
	// 	$ten			=	$this->ObjM->sum_by_pay_type($usercode, '10by3');
	// 	$monthly    	= 	$this->ObjM->payment_monthly_by_type($usercode, 'monthly');
	// 	$coded    		= 	$this->ObjM->payment_monthly_by_type($usercode, 'coded');
	// 	$coded_match    = 	$this->ObjM->payment_monthly_by_type($usercode, 'coded_match');
	// 	$residual    	= 	$this->ObjM->payment_monthly_by_type($usercode, 'residual');
	// 	$residual_match    = 	$this->ObjM->payment_monthly_by_type($usercode, 'residual_match');
	// 	//$total			= 	$this->ObjM->payment_monthly_by_type('1','');
	// 	//$grant_total    =	number_format($three[0]['total']+$five[0]['total']+$ten[0]['total']+$total[0]['total'],2);
	// 	//$balance		= 	$this->ObjM->get_main_balance('1');
		
	// 	$html=' <ul class="top-banner">
	// 	<li><a href="#">3x3 Monthly: <span>$'.$monthly[0]['total'].'</span></a></li>
	// 	<li><a href="#">3x3 Daily:  <span>$'.$three[0]['total'].'<span></a></li>
	// 	<li><a href="#">5x3 Daily: <span>$'.$five[0]['total'].'<span></a></li>
	// 	<li><a href="#">10x3 Daily: <span>$'.$ten[0]['total'].'<span></a></li>
	// 	<li><a href="#">Coded:<span>$'.$coded[0]['total'].'<span></a></li>
	// 	<li><a href="#">Matching Coded: <span>$'.$coded_match[0]['total'].'<span></a></li>
	// 	<li><a href="#">Residual: <span>$'.$residual[0]['total'].'<span></a></li>
	// 	<li><a href="#">Res-Match: <span>$'.$residual_match[0]['total'].'<span></a></li>
	// 	<div style="clear:both;overflow:hidden;"></div>
	// 	</ul>';
	// 	echo $html;
			
	// }

	function get_top_banner_free()
	{

		$usercode = end(explode("/", $_SERVER['HTTP_REFERER']));
		if (!is_numeric($usercode) || $usercode=="") {
			//$usercode=1;
			$usercode=$this->session->userdata('logged_in_visa')['usercode'];
			if($usercode==''){
				$usercode=1;
			}
		}
		echo $html=$this->get_daily_payment_free($usercode);
		exit;
	}

	function get_top_banner()
	{

		$usercode = end(explode("/", $_SERVER['HTTP_REFERER']));
		if (!is_numeric($usercode) || $usercode=="") {
			$usercode=$this->session->userdata('logged_in_visa');
			if($usercode==''){
				$usercode=1;
			}
		}
		echo $html=$this->get_daily_payment_paid($usercode);
		exit;

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

	function get_daily_payment_paid($usercode='')
	{
		if($usercode==''){
			$usercode = end(explode("/", $_SERVER['HTTP_REFERER']));
			if ($usercode=="") {
				$usercode=1;
			}
		}

		/*$data['master_sheet']		=	$this -> ObjM -> get_daily_payment_paid($usercode);
		$data['pay_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_type('monthly', $usercode);
		$data['pay_c']				=	$this -> ObjM -> sum_monthly_pay_by_type('coded', $usercode);
		$data['pay_cm']				=	$this -> ObjM -> sum_monthly_pay_by_type('coded_match', $usercode);
		$data['pay_r']				=	$this -> ObjM -> sum_monthly_pay_by_type('residual', $usercode);
		$data['pay_rm']				=	$this -> ObjM -> sum_monthly_pay_by_type('residual_match', $usercode);
		$data['pay_refill']			=	$this -> ObjM -> sum_monthly_pay_by_type('refill', $usercode);
		$data['daily_3']			=	$this -> ObjM -> sum_daily_pay_by_type('3by3', $usercode);
		$data['daily_5']			=	$this -> ObjM -> sum_daily_pay_by_type('5by3', $usercode);
		$data['daily_10']			=	$this -> ObjM -> sum_daily_pay_by_type('10by3', $usercode);
		// $tot_withdrawal				=	$this -> ObjM -> sum_withdrawal_balance('main_balance', $usercode);	*/
		// $tot_pif					=  	$this -> ObjM -> sum_withdrawal_balance_by_type('3', $usercode); 
		
		// $dia_w						=	$this->diamond_class->main_balance();
		$dia_w = 0;

		//$html='<a href="'.base_url().'index.php/summary/account_summary" class="mobile_payment_summary_btn popover_link"><span class="badge badge-important">Account Summary</span></a><div style="clear:both;overflow:hidden;"></div>';
		/*$html.='<ul class="top-banner top_amount_list">
			<li>Paid: </li>
			<li><a href="#">3x3 Monthly:<span>$'.number_format($data['pay_monthly'],2).'</span></a></li>
			<li><a href="#">3x3 Daily:  <span>$'.number_format($data['daily_3'],2).'</span></a></li>
			<li><a href="#">5x3 Daily: <span>$'.number_format($data['daily_5'],2).'</span></a></li>
			<li><a href="#">10x3 Daily: <span>$'.number_format($data['daily_10'],2).'</span></a></li>
			<li><a href="#">Coded:<span>$'.number_format($data['pay_c'],2).'</span></a></li>
			<li><a href="#">Matching Coded: <span>$'.number_format($data['pay_cm'],2).'</span></a></li>
			<li><a href="#">Residual: <span>$'.number_format($data['pay_r'],2).'</span></a></li>
			<li><a href="#">Res-Match: <span>$'.number_format($data['pay_rm'],2).'</span></a></li>
			<div style="clear:both;overflow:hidden;"></div>
		</ul>';
		/*
		<li><a href="'.diamond_base().'page/view"><strong>Diamond Wallet</strong>: <span>$'.number_format($dia_w['balance'],2).'<span></a></li>
		<li><a href="#"><strong>Personal Wallet</strong>: <span>$'.$data['master_sheet'][0]['personal_wallet'].'<span></a></li>
		<li><a href="#"><strong>Company Wallet</strong>: <span>$'.$data['master_sheet'][0]['main_balance'].'<span></a></li>
		<li><a href="#">Total Withdrawal: <span>$'.number_format($tot_withdrawal,2).'</span></a></li>
			<li><a href="#">Total PIF: <span>$'.number_format($tot_pif,2).'</span></a></li>
		*/
		$fivebythree = $this->user_model->getpaidmemberbonuswallet(1,'5by3');
		$tenbythree = $this->user_model->getpaidmemberbonuswallet(1,'10by3');			
		$html='<ul class="top-banner top_amount_list">
			<li>Company Paid Wallet: </li>
			<li><a href="#">CBW 5x3 Wallet:  <span>$'.bcdiv($fivebythree,1,3).'</span></a></li>
			<li><a href="#">CBW 10x3 Wallet:  <span>$'.bcdiv($tenbythree,1,3).'</span></a></li>
			<li><a href="#">Smart Wallet:  <span>$'.$this->user_model->getmemberreferalwallet(0).'</span></a></li>
			<li><a href="#">Wallet 1:  <span>$'.$this->user_model->getcompanylevelwallet(1).'</span></a></li>
			<li><a href="#">Wallet 2: <span>$'.$this->user_model->getcompanylevelwallet(2).'</span></a></li>
			<li><a href="#">Wallet 3: <span>$'.$this->user_model->getcompanylevelwallet(3).'</span></a></li>
			<li><a href="#">Wallet 4: <span>$'.$this->user_model->getcompanylevelwallet(4).'</span></a></li>
			<li><a href="#">Wallet 5: <span>$'.$this->user_model->getcompanylevelwallet(5).'</span></a></li>
			<li><a href="#">Wallet 6: <span>$'.$this->user_model->getcompanylevelwallet(6).'</span></a></li>
			<li><a href="#">Wallet 7: <span>$'.$this->user_model->getcompanylevelwallet(7).'</span></a></li>
			<div style="clear:both;overflow:hidden;"></div>
		</ul>';
		return $html;
	}

	function get_daily_payment_free($usercode='')
	{
		if($usercode==''){
			$usercode = end(explode("/", $_SERVER['HTTP_REFERER']));
			if ($usercode=="") {
				$usercode=1;
			}
		}

		/*$summary	=	$this->ObjM->get_level_summary($usercode);

		$one		=	$this->ObjM->get_setting_value_by_lable('commission_level1');
		$two		=	$this->ObjM->get_setting_value_by_lable('commission_level2');
		$three		=	$this->ObjM->get_setting_value_by_lable('commission_level3');

		$monthly_total=($summary[0]['active_level_one3']*$one[0]['setting_value'])+($summary[0]['active_level_two3']*$two[0]['setting_value'])+($summary[0]['active_level_three3']*$three[0]['setting_value']);
		// error_reporting(E_ALL);
		$coded					=	$this->ObjM->get_coded_residual_id('coded', $usercode);
		$coded_match			=	$this->ObjM->get_coded_residual_id('coded_match', $usercode);
		$residual				=	$this->ObjM->get_coded_residual_id('residual', $usercode);
		$residual_match			=	$this->ObjM->get_coded_residual_id('residual_match', $usercode);
		
		$coded_pay				=	$this->ObjM->get_setting_value_by_lable('enrollment_code');
		$coded_match_pay		=	$this->ObjM->get_setting_value_by_lable('enrollment_code_match');
		$residual_pay			=	$this->ObjM->get_setting_value_by_lable('codded_residual');
		$residual_match_pay		=	$this->ObjM->get_setting_value_by_lable('coded_residual_match');
		
		$payment	=	$this->ObjM->get_daily_payment_free($usercode);
		
		
		// $dia_w						=	$this->diamond_class->main_balance();
		$dia_w=0;
		$html='<a href="'.base_url().'index.php/summary/account_summary" class="mobile_payment_summary_btn popover_link"><span class="badge badge-important">Account Summary</span></a><div style="clear:both;overflow:hidden;"></div>';
		$html.=' <ul class="top-banner top_amount_list">
		<li>Free: </li>
		<li><a href="#">3x3 Monthly: <span>$'.number_format($monthly_total,2).'</span></a></li>
		<li><a href="#">3x3 Daily:  <span>$'.$payment[0]['3by3daily'].'<span></a></li>
		<li><a href="#">5x3 Daily: <span>$'.$payment[0]['5by3daily'].'<span></a></li>
		<li><a href="#">10x3 Daily: <span>$'.$payment[0]['10by3daily'].'<span></a></li>
		<li><a href="#">Coded:<span>$'.number_format($coded[0]['tot']*$coded_pay[0]['setting_value'],2).'<span></a></li>
		<li><a href="#">Matching Coded: <span>$'.number_format($coded_match[0]['tot']*$coded_match_pay[0]['setting_value'],2).'<span></a></li>
		<li><a href="#">Residual: <span>$'.number_format($residual[0]['tot']*$residual_pay[0]['setting_value'],2).'<span></a></li>
		<li><a href="#">Res-Match: <span>$'.number_format($residual_match[0]['tot']*$residual_match_pay[0]['setting_value'],2).'<span></a></li>
		<div style="clear:both;overflow:hidden;"></div>
		</ul>';*/
		$fivebythree = $this->user_model->getfreememberbonuswallet(1,'5by3');
		$tenbythree = $this->user_model->getfreememberbonuswallet(1,'10by3');
		//$total = bcdiv($fivebythree+$tenbythree,1,3);
		$html='<ul class="top-banner top_amount_list">
			<li>Company Free Wallet: </li>
			<li><a href="#">CBW 5x3 Wallet:  <span>$'.bcdiv($fivebythree,1,3).'</span></a></li>
			<li><a href="#">CBW 10x3 Wallet:  <span>$'.bcdiv($tenbythree,1,3).'</span></a></li>
			<li><a href="#">Smart Wallet:  <span>$'.$this->user_model->getfreememberreferalwallet(0).'</span></a></li>
			<li><a href="#">Wallet 1:  <span>$'.$this->user_model->getcompanyfreelevelwallet(1).'</span></a></li>
			<li><a href="#">Wallet 2: <span>$'.$this->user_model->getcompanyfreelevelwallet(2).'</span></a></li>
			<li><a href="#">Wallet 3: <span>$'.$this->user_model->getcompanyfreelevelwallet(3).'</span></a></li>
			<li><a href="#">Wallet 4: <span>$'.$this->user_model->getcompanyfreelevelwallet(4).'</span></a></li>
			<li><a href="#">Wallet 5: <span>$'.$this->user_model->getcompanyfreelevelwallet(5).'</span></a></li>
			<li><a href="#">Wallet 6: <span>$'.$this->user_model->getcompanyfreelevelwallet(6).'</span></a></li>
			<li><a href="#">Wallet 7: <span>$'.$this->user_model->getcompanyfreelevelwallet(7).'</span></a></li>
			<div style="clear:both;overflow:hidden;"></div>
		</ul>';
		return $html;
		/*
		<li><a href="#"><strong>Wallet</strong>: <span>$'.$pay[3].'<span></a></li>
		<li><a href="'.diamond_base().'page/view"><strong>Diamond Wallet</strong>: <span>$'.number_format($dia_w['balance'],2).'<span></a></li>
		*/
	}

	function update_login_user_time()
	{
		$current=$this->ObjM->login_user_count();
		$day		=$this->ObjM->login_user_in_day();
		$w_request	=	$this->ObjM->count_withdrawal_request();
		$p=array($current[0]['tot'],count($day),$w_request[0]['tot']);
		echo json_encode($p);
	}
	
}