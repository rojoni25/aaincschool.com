<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class financial_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('financial_report_model','ObjM',TRUE);
		if($this->session->userdata['tbl']['current_account']!='Active') {
			header('Location: '.base_url().'');exit;
		}
		
		
 	}
	
	public function index()
	{
		$data['active_dt']	=	$this->ObjM->get_active_dt();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('financial_report_view',$data);
		$this->load->view('comman/footer');
	}
	
	function payment_report(){
		$payment	=	$this->ObjM->get_payment();
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
		$report		=	$this->ObjM->get_withdrawal('main_balance');
		$sum	=	$this->ObjM->get_withdrawal_sum('main_balance');
	
		
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
		$report		=	$this->ObjM->get_earning_monthly();
		$sum		=	$this->ObjM->get_earning_monthly_sum();
		
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
		
		$active_dt	=	$this->ObjM->get_active_dt();
		$all_sum	=	$this->ObjM->get_earning_sum();
		
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
								$sum	=	$this->ObjM->get_earning_monthly_sum($month_list[$i]['month_value']);
			
				
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

