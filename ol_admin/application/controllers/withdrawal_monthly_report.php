<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdrawal_monthly_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('withdrawal_monthly_report_model','ObjM',TRUE);
 	}
	

	function report()
	{
	
		$data['first_dt']=$this->ObjM->get_first_member_add_date();
			
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('withdrawal_monthly_report_view',$data);
		$this->load->view('comman/footer');
	}
	
	function report_month_date_wise(){
		$result	=	$this -> ObjM -> report_month_date_wise();
		$tot	=	$this -> ObjM -> report_month_date_wise_tot();
		$html='<table class="stat-table table table-stats table-striped table-sortable table-bordered table_main">
				<thead>
					<tr>
						<td>Sr. No</td>
						<td>Usercode</td>
						<td>Name</td>
						<td>Amount</td>
					
						<td>Date</td>
					</tr>
				</thead>
				<tbody>';
		for($i=0;$i<count($result);$i++){
			$srno=$i+1;
			$html.='<tr>
						<td>'.$srno.'</td>	
						<td>'.$result[$i]['usercode'].'</td>	
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>	
						<td>$'.$result[$i]['amount'].'</td>	
						<td>'.date('d-m-Y',$result[$i]['timedt']).'</td>				
					</tr>';
		}
		$html.='<tr>
					<td colspan="3"><strong>Total</strong></td>				
					<td><strong>$'.$tot[0]['sum'].'</strong></td>
					
					<td></td>
					<td></td>
				</tr></tbody></table>';
		echo $html;
		
	}
	
	
	
	
	

}

