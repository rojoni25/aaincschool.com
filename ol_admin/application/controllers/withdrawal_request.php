<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdrawal_request extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('withdrawal_request_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result=$this->ObjM->getAll();
		$html='';
		for($i=0;$i<count($result);$i++){
			$newDate = date("d-m-Y", strtotime($result[$i]['timedt']));
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['request_code'].'</td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['paypal'].'</td>
						<td>'.$result[$i]['amount'].'</td>
						<td>'.$result[$i]['textdt'].'</td>
						<td>'.$newDate.'</td>
						<td>
							<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/addnew/'.$result[$i]['request_code'].'"><span class="label label-important">Withdrawal</span></a>&nbsp;
							<a class="tr_delete" href="'.base_url().'index.php/'.$this->uri->segment(1).'/record_update/'.$result[$i]['request_code'].'"><span class="label label-warning">Delete</span></a>&nbsp;
							<a href="'.base_url().'index.php/payment_report_paid/detail_view/'.$result[$i]['username'].'"><span class="label label-success">Balance Sheet</span></a>
						</td>
              		</tr>';
		}
		echo $html;
	}
	
	function addnew($eid)
	{
		$data['result']	=	$this->ObjM->get_record($eid);
		$data['dt']	=	$this->get_paid_dt($data['result'][0]['usercode']);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$result	=	$this->ObjM->get_record($_POST['eid']);
			$pay_dt	=	$this->get_paid_dt($result[0]['usercode']);
			
			
			
			$withdrawal_amount=(float)$result[0]['amount'];
			
			
			$data = array();
			$data['usercode']		=	$result[0]['usercode'];	
			$data['request_code']	=	$_POST['eid'];	
			$data['amount']			=	$withdrawal_amount;
			$data['create_date']	=	$nowdt;	
			$data['timedt']			=	time();	
			$data['timedt']			=	time();	
			$this->ObjM->addItem($data,'withdrawal_balance');
				
			$data = array();
			$data['status']			=	'done';	
			$this->ObjM->update($data,'withdrawal_request_master','request_code',$_POST['eid']);
				
				
			$msg='Withdrawal Successfully&status=true';
			$this->session->set_flashdata('show_msg','Withdrawal Successfully');
			$this->session->set_flashdata('show_msg_class','alert-success');
		
				
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'?msg='.$msg.'');
		exit;
	}
	
	
	
	function record_update($eid)
	{
		$data=array();
		$data['status']='delete';
		$this->ObjM->update($data,'withdrawal_request_master','request_code',$this->uri->segment(3));
		$result	=	$this->ObjM->get_withdrawal_request_master($eid);
		$amount = $result[0]['amount'];
		$usercode =$result[0]['usercode'];
		
		 if ($result[0]['status']=='delete') {
		 	
				  	$this->ObjM->master_balance_update('main_balance',$amount,'plus',$usercode);
				  }else{}
				  
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	function get_paid_dt($id)
	{
		$data['master_sheet']		=	$this -> ObjM -> get_master_balance_sheet($id);
		$data['pay_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_type($id,'monthly');
		$data['pay_c']				=	$this -> ObjM -> sum_monthly_pay_by_type($id,'coded');
		$data['pay_cm']				=	$this -> ObjM -> sum_monthly_pay_by_type($id,'coded_match');
		$data['pay_r']				=	$this -> ObjM -> sum_monthly_pay_by_type($id,'residual');
		$data['pay_rm']				=	$this -> ObjM -> sum_monthly_pay_by_type($id,'residual_match');
		$data['pay_refill']			=	$this -> ObjM -> sum_monthly_pay_by_type($id,'refill');
		$data['daily_3']			=	$this -> ObjM -> sum_daily_pay_by_type($id,'3by3');
		$data['daily_5']			=	$this -> ObjM -> sum_daily_pay_by_type($id,'5by3');
		$data['daily_10']			=	$this -> ObjM -> sum_daily_pay_by_type($id,'10by3');
		$data['tot_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_usercode($id);
		$data['tot_daily']			=	$this -> ObjM -> sum_daily_payment($id);
		$data['tot_withdrawal']		=	$this -> ObjM -> sum_withdrawal_balance($id,'main_balance');
		$data['pw_refill']			=	$this -> ObjM -> sum_refill($id,'PW');
		$data['cw_transfer']		=	$this -> ObjM -> sum_total_transfer($id,'main_balance');
		$data['pw_transfer']		=	$this -> ObjM -> sum_total_transfer($id,'personal_wallet');
		$data['cw_tot_transfer']	=   $data['pw_transfer']-$data['cw_transfer'];
		$data['pw_tot_transfer']	=   $data['cw_transfer']-$data['pw_transfer'];
		//$data['total_balance']		=	(float)$data['tot_monthly'][0]['total'] + (float)$data['tot_daily'][0]['total'];
		$data['total_balance']		=	$this->current_balance($id);

		$data['max_withdrawal']		=	$data['total_balance'] - CW_MIN;
		return $data;
	}
	// get current balance from referal wallet
		function current_balance($id)
	{
        	      // changed by softexprt 
        $loginusercode = $id;
        $amount=GetPaidReferalWallet($loginusercode);// calculate the referal wallet
	
		return $amount;
	}
	
	
}

