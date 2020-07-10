<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class withdrawal_request extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('withdrawal_request_module','ObjM',TRUE);
		$this->load->library('email');
   		
 	}
	
	public function index()
	{
		$data['contain']	=	$this->ObjM->get_pages_contain('withdrawal_page_contain');
		$data['request']	=	$this->get_withdrawal_request();
		$data['withdrawal']	=	$this->get_withdrawal();
		
		$data['cw_transfer']		=	$this->ObjM->sum_total_transfer('main_balance');
		$data['pw_transfer']		=	$this->ObjM->sum_total_transfer('personal_wallet');
		$data['cw_tot_transfer']	=   $data['pw_transfer']-$data['cw_transfer'];
		$data['pw_tot_transfer']	=   $data['cw_transfer']-$data['pw_transfer'];
		
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function add_withdrawal()
	{
		
		$data['result']=$this->ObjM->get_last_withdrawal_request();
		$data['balance']=$this->current_balance();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add');
		$this->load->view('comman/footer');
	}
	
	function withdrawal_insertrecord()
	{
	    
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		  
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$balance 		= 	$this->current_balance();
			$balance		=	(float)$balance-CW_MIN;

			if($_POST['amount']!==''){	
			     $amount=$_POST['amount'];
				if($amount < $balance){
					$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
					$data['amount']		=	$amount;
					$data['timedt']		=	$nowdt;
					$data['textdt']		=	$_POST['textdt'];

					$message='';
					if($_POST['withdrawl_type']=='paypal'){
						$message="\n Withdrawl Type: Paypal\n Email: ".$_POST['email']."\n";
					} elseif($_POST['withdrawl_type']=='skrill'){
						$message="\n Withdrawl Type: Skrill\n Email: ".$_POST['email']."\n";
					} elseif($_POST['withdrawl_type']=='bitcoin'){
						$message="\n Withdrawl Type: Bitcoin\n Wallet Id: ".$_POST['wallet_id']."\n";
					} elseif($_POST['withdrawl_type']=='direct_deposit'){
						$message="\n
						Withdrawl Type: Direct Deposit\n
						Name On Account: {$_POST['acc_name']}\n
						Bank Name: {$_POST['bank_name']}\n
						City: {$_POST['city']}\n
						Routing #: {$_POST['routing']}\n
						Account #: {$_POST['account']}\n
						";
					}
					$data['textdt']=$message.$data['textdt'];
					$this->ObjM->addItem($data,'withdrawal_request_master');
					
					///$this->ObjM->master_balance_update('main_balance',$this->session->userdata['logged_ol_member']['usercode'],$amount,'minus');
					//TODO: Reduce balance from smartwallet
					
					$this->send_email_to_admin($amount);
				}
			}
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	function send_email_to_admin($amount)
	{
			$admin_email	= $this->ObjM->get_admin_emailid();
			
			$message='<p><h3>Withdrawal Request</h3></p>';
			$message.='<p>Usercode	:'.$this->session->userdata['logged_ol_member']['usercode'].'</p>';
			$message.='<p>Username	:'.$this->session->userdata['logged_ol_member']['username'].'</p>';
			$message.='<p>Member Name	:'.$this->session->userdata['logged_ol_member']['fullname'].'</p>';
			$message.='<p>Email Id	:'.$this->session->userdata['logged_ol_member']['emailid'].'</p>';
			$message.='<p>Withdrawal Request Amount :$'.number_format($amount,2).'</p>';
		
			$e_array=array("heading"=>"Withdrawal Request","msg"=>$message,"msg"=>$message,"contain"=>"");
			
			$message	=	email_template_one($e_array);
			
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email[0]['emailid']);
			// $this->email->subject('Withdrawal Request');
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,'Withdrawal Request',$admin_email[0]['emailid'],$message);
	}
	
	function current_balance()
	{
        	      // changed by softexprt 
        $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
        $amount=GetPaidReferalWallet($loginusercode);// calculate the referal wallet
	
		return $amount;
	}
	
	function get_withdrawal_request()
	{
		$html	=	'';
		$result	=	$this->ObjM->get_all_withdrawal_request();
		
		for($i=0;$i<count($result);$i++){
				 $newDate = date("d-m-Y", strtotime($result[$i]['timedt']));
				 if($result[$i]['status']=='pending'){
					$btn='<a class="btn_rem" href="'.base_url().'index.php/'.$this->uri->segment(1).'/delete_req/'.$result[$i]['request_code'].'"><i class="icon-remove"></i></a>';	
				  }else{
					$btn='';
				  }	
			     $html.='<tr>
							<td>'.$result[$i]['request_code'].'</td>
							<td>'.$result[$i]['amount'].'</td>
							<td>'.$newDate.'</td>
							<td>'.$result[$i]['status'].'</td>
							<td>'.$btn.'</td>
						</tr>';
		 } 
		 return $html;
	}
	
	
	function get_withdrawal(){
		$html='';
		$result				=	$this->ObjM->get_all_withdrawal('main_balance');
		
		$tot_withdrawal		=	$this->ObjM->sum_withdrawal_balance('main_balance');
		
		for($i=0;$i<count($result);$i++){
			$newDate = date("d-m-Y", strtotime($result[$i]['create_date']));	
			$html.='<tr>
				<td>'.$result[$i]['withdrawal_code'].'</td>
				<td>'.$result[$i]['amount'].'</td>
				<td>'.$newDate.'</td>
			</tr>';
		}
		$html.='<tr>
				<td colspan="2" style="text-align:right"><strong>Total Withdrawal :</strong></td>
				<td><strong>'.$tot_withdrawal[0]['total'].'</strong></td>
			</tr>';
		return $html;
	}
	
	function delete_req($eid){
		$data=array();
		$data['status']='delete';
		$this->ObjM->delete_record($data,$eid);
		
		$result	=	$this->ObjM->get_all_withdrawal_request();
		$amount = $result[0]['amount'];
		 if ($result[0]['status']=='delete') {
				  	$this->ObjM->master_balance_update('main_balance',$this->session->userdata['logged_ol_member']['usercode'],$amount,'plus');
				  }else{}

		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
}


