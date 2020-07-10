<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_report_paid extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('payment_report_paid_model','ObjM',TRUE);
 	}
	
	public function list_view()
	{
		$data['result']=$this->total_balance_report();
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('payment_report_paid_view',$data);
		$this->load->view('comman/footer');
	}
	
	function get_active_member(){
	
		//$data['txt_query'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//$this->ObjM->addItem($data,'test_query');
		$result=$this->ObjM->get_active_member($last_pay);
		$count	=	$this->ObjM->count_all_paid_member();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => count($result),
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		
		for($i=0;$i<count($result);$i++)
		{
			$arr=$this->get_paid_dt($result[$i]['usercode']);
			$net_amount='<strong>'.$arr[2].'</strong>';
			$btn_show='<a href="'.base_url().'index.php/payment_report_paid/detail_view/'.$result[$i]['username'].'" class="edit_rcd">
								<i class="icon-eye-open"></i></a>';
			if((float)$arr[1]>0){
				$withdrawal='<a href="'.base_url().'index.php/payment_report_paid/withdrawal_detail/'.$result[$i]['username'].'">'.$arr[1].'</a>';						
			}else{
				$withdrawal=$arr[1];
			}					
			
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$arr[0],
					$withdrawal,
					$net_amount,
					$btn_show
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function detail_view($username){
		$data['result']				=	$this->ObjM->get_member_by_username($username);
		if(!isset($data['result'][0])){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/list_view');
			exit;
		}
		
		$data['master_sheet']		=	$this -> ObjM -> get_master_balance_sheet($data['result'][0]['usercode']);
		$data['pay_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_type($data['result'][0]['usercode'],'monthly');
		$data['pay_c']				=	$this -> ObjM -> sum_monthly_pay_by_type($data['result'][0]['usercode'],'coded');
		$data['pay_cm']				=	$this -> ObjM -> sum_monthly_pay_by_type($data['result'][0]['usercode'],'coded_match');
		$data['pay_r']				=	$this -> ObjM -> sum_monthly_pay_by_type($data['result'][0]['usercode'],'residual');
		$data['pay_rm']				=	$this -> ObjM -> sum_monthly_pay_by_type($data['result'][0]['usercode'],'residual_match');
		$data['pay_refill']			=	$this -> ObjM -> sum_monthly_pay_by_type($data['result'][0]['usercode'],'refill');
		
		$data['daily_3']			=	$this -> ObjM -> sum_daily_pay_by_type($data['result'][0]['usercode'],'3by3');
		$data['daily_5']			=	$this -> ObjM -> sum_daily_pay_by_type($data['result'][0]['usercode'],'5by3');
		$data['daily_10']			=	$this -> ObjM -> sum_daily_pay_by_type($data['result'][0]['usercode'],'10by3');
		
		$data['tot_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_usercode($data['result'][0]['usercode']);
		$data['tot_daily']			=	$this -> ObjM -> sum_daily_payment($data['result'][0]['usercode']);
		$data['tot_withdrawal']		=	$this -> ObjM -> sum_withdrawal_balance($data['result'][0]['usercode'],'main_balance');
		
		
		$data['pw_refill']			=	$this -> ObjM -> sum_refill($data['result'][0]['usercode'],'PW');
		
		$data['cw_transfer']		=	$this -> ObjM -> sum_total_transfer($data['result'][0]['usercode'],'main_balance');
		$data['pw_transfer']		=	$this -> ObjM -> sum_total_transfer($data['result'][0]['usercode'],'personal_wallet');
		$data['cw_tot_transfer']	=   $data['pw_transfer']-$data['cw_transfer'];
		
		$data['pw_tot_transfer']	=   $data['cw_transfer']-$data['pw_transfer'];
		$data['total_balance']		=	(float)$data['tot_monthly'][0]['total'] + (float)$data['tot_daily'][0]['total'];
		
		
		
		
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('payment_report_paid_detail');
		$this->load->view('comman/footer');
	}
	
	function total_balance_report()
	{
		$member	=	$this->ObjM->get_all_balance();
		$total_balance=0;
		$request_balance=0;
		for($i=0;$i<count($member);$i++){
			$main_balance=(float)$member[$i]['main_balance'];
			
			$total_balance+=$main_balance;
			if($main_balance > CW_MIN){
				$max_withdrawal	=	$main_balance-CW_MIN;
				$request_balance+= $max_withdrawal;
			}
		}
		$arr=array('total_balance'=>$total_balance,'request_balance'=>$request_balance);
		return $arr;
	}
	
	function get_paid_dt($id)
	{
		$monthly	=	$this->ObjM->sum_monthly_pay_by_usercode($id);
		$daily		=	$this->ObjM->sum_daily_payment($id);
		$withdrawal	=	$this->ObjM->sum_withdrawal_balance($id,'main_balance');
		$total_balance=(float)$monthly[0]['total'] + (float)$daily[0]['total'];
		$net_balance= $total_balance - (float)$withdrawal[0]['total'];
		$arr=array($total_balance,$withdrawal[0]['total'],$net_balance);
		return $arr;
	}
	
	function withdrawal_detail($username)
	{
		$data['result']				=	$this->ObjM->get_member_by_username($username);
		if(!isset($data['result'][0])){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/list_view');
			exit;
		}
		$data['tot_withdrawal']		=	$this->ObjM->sum_withdrawal_balance($data['result'][0]['usercode'],'main_balance');
		$data['withdrawal_list']	=	$this->ObjM->withdrawal_list($data['result'][0]['usercode']);
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('withdrawal_detail_view');
		$this->load->view('comman/footer');	
	}
	
	function withdrawal_possible()
	{
		$data['amount']		=	$this->total_balance_report();
		$data['result']		=	$this->ObjM->get_possible_withdrawal_member();
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('withdrawal_possible_view');
		$this->load->view('comman/footer');	
				
	}
	
	
	function payment_report($eid){
		$payment	=	$this->ObjM->get_payment($eid);
		$html='<div class="widget-header-block">
        				<h4 class="widget-header">Payment History</h4>
        			</div>
         				<table class="table">
         					<tr>
								<td>Id</td>
								<td>Date</td>
								<td>Amount</td>
            				</tr>';
            for($i=0;$i<count($payment);$i++){
				$p=$i+1;
            	$html.='<tr>
            			<td>'.$p.'</td>
                		<td>'.date('d-m-Y',$payment[$i]['timedt']).'</td>
                		<td><strong>$'.$payment[$i]['amount'].'</strong></td>
            			</tr>';
             } 
         $html.='</table>';
	  echo $html;
	}
	
	
	function withdrawal_report(){
		
		$report		=	$this->ObjM->get_withdrawal($_POST['usercode']);
		$sum	=	$this->ObjM->get_withdrawal_sum($_POST['usercode']);
		
		$html='<div class="widget-header-block">
        				<h4 class="widget-header">Withdrawal History</h4>
        			</div>
         				<table class="table">
         					<tr>
								<td>Id</td>
								<td>Date</td>
								<td>Amount</td>
            				</tr>';
            for($i=0;$i<count($report);$i++){
				$p=$i+1;
            	$html.='<tr>
            			<td>'.$p.'</td>
                		<td>'.date('d-m-Y',$report[$i]['timedt']).'</td>
                		<td><strong>$'.$report[$i]['amount'].'</strong></td>
            			</tr>';
                } 
				
				$html.='<tr>
            			<td></td>
                		<td><font style="font-size:15px;color:#F00;">Total</font></td>
                		<td><font style="font-size:15px;color:#F00;">$'.$sum[0]['tot_sum'].'</font></td>
            			</tr>';
						
         $html.='</table>';
	  echo $html;
	}
	
	function earning_monthly(){
		if($_POST['month_name']=='all'){
			$html=$this->earning_month_all();	
		}
		else{
			$html=$this->earning_month_wise();	
		}
		
	  	echo $html;
	}
	
	function earning_month_wise(){
		$report		=	$this->ObjM->get_earning_monthly($_POST['usercode']);
		$sum		=	$this->ObjM->get_earning_monthly_sum('',$_POST['usercode']);
		
		$html='<div class="widget-header-block">
        				<h4 class="widget-header">Earning Report</h4>
        			</div>
         				<table class="table">
         					<tr>
								<td>Date</td>
								<td>Amount</td>
            				</tr>';
            for($i=0;$i<count($report);$i++){
            	$html.='<tr>
                			<td>'.date('d-m-Y',$report[$i]['timestm']).'</td>
                			<td><strong>$'.$report[$i]['tot_sum'].'</strong></td>
            			</tr>';
                } 
				
				$html.='<tr>
                		<td><font style="font-size:15px;color:#F00;">Total</font></td>
                		<td><font style="font-size:15px;color:#F00;">$'.$sum[0]['tot_sum'].'</font></td>
            			</tr>';
						
         $html.='</table>';
		 return $html;
	}
	
	function earning_month_all(){
		
		$active_dt	=	$this->ObjM->get_active_dt($_POST['usercode']);
		$all_sum	=	$this->ObjM->get_earning_sum($_POST['usercode']);
		
		$date 		= date('01-m-Y', $active_dt[0]['active_dt']);
   		$end_date 	= date('t-m-Y',time());
 		$dt_show=date('F Y', strtotime($date));
 		while (strtotime($date) <= strtotime($end_date)) {
			$month_list[]=array(
				'month_name' => $dt_show,
				'month_value' => $date
			);	
 			$date = date ("d-m-Y", strtotime("+1 month", strtotime($date)));
			$dt_show=date('F Y', strtotime($date));
 		}
		
		$html='<div class="widget-header-block">
        				<h4 class="widget-header">Monthly Earning Report</h4>
        			</div>
         				<table class="table">
         					<tr><td>Date</td><td>Amount</td></tr>';
            				for($i=0;$i<count($month_list);$i++){
								$sum	=	$this->ObjM->get_earning_monthly_sum($month_list[$i]['month_value'],$_POST['usercode']);
			
				
            					$html.='<tr>
                							<td>'.$month_list[$i]['month_name'].'</td>
                							<td><strong>$'.$sum[0]['tot_sum'].'</strong></td>
            							</tr>';
                				} 
				
						$html.='<tr><td><font style="font-size:15px;color:#F00;">Total</font></td><td><font style="font-size:15px;color:#F00;">$'.$all_sum[0]['tot_sum'].'</font></td></tr>';
						
         		$html.='</table>';
		 		return $html;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}

