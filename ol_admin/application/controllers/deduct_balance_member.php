<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class deduct_balance_member extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('deduct_balance_member_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['result']	=	$this->ObjM->getAll();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
			
			$ac_type=($_POST['account_type']=='personal_wallet') ? "personal_wallet" : "main_balance";
			$amount_dt=$this->get_balanace_info($_POST['usercode']);
			$deduct_amount=(float)$_POST['deduct_amount'];
			//******Check personal wallet******//
			if($ac_type=='personal_wallet'){
				if($deduct_amount > $amount_dt['personal_wallect']){
					$this->session->set_flashdata('show_msg', 'personal wallect not enough balance');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
					exit;
				}
			}
			else{
				//******Check company wallet******//
				if($deduct_amount > $amount_dt['company_max_withw']){
					$this->session->set_flashdata('show_msg', 'company wallect not enough balance');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
					exit;
				}
			}
			
			$data=array();
    		$data['usercode']		=	$_POST['usercode'];	 
			$data['amount']			=	$deduct_amount;
			$data['description']	=	'by_admin';
			$data['wallet_type']	=	$ac_type;
			$data['timedt']			=	time();
			$data['create_date']	=	$nowdt;
			$data['type']			=	4;
			
			$id=$this->ObjM->addItem($data,'withdrawal_balance');
			
			if($ac_type=='personal_wallet'){
				$this->ObjM->master_balance_update('personal_wallet',$_POST['usercode'],$deduct_amount,'minus');
				$this->session->set_flashdata('show_msg','personal wallet balance is successfully deduct');
			}else{
				$this->ObjM->master_balance_update('main_balance',$_POST['usercode'],$deduct_amount,'minus');
				$this->session->set_flashdata('show_msg','personal wallet balance is successfully deduct');
			}
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	function get_balance_dt($eid){
			$html='';
			$result=$this->get_balanace_info($eid);
			if($result){
				$html='<table class="table">
					<tr>
						<td width="30%">Company Wallet</td>
						<td width="70%">'.number_format($result['company_wallect'],2).'</td>
					</tr>
					<tr>
						<td>Company Wallet Max Deduct</td>
						<td>'.number_format($result['company_max_withw'],2).'</td>
					</tr>
					<tr>
						<td>Personal Wallect</td>
						<td>'.number_format($result['personal_wallect'],2).'</td>
					</tr>
				</table>';	
			}
			echo $html;
				
	}
	
	protected function get_balanace_info($eid){
		$rt=$this->ObjM->get_balance_dt($eid);
		
		if(isset($rt[0])){
			$main_balance=(float)$rt[0]['main_balance'];
			if($main_balance > CW_MIN)
			{
				$max_w = $main_balance-CW_MIN;
			}
			else{
				$max_w='0.00';
			}
		}
		else{
			return false;
		}
		$arr=array(
			'company_wallect'=>$main_balance,
			'personal_wallect'=>(float)$rt[0]['personal_wallet'],
			'company_max_withw'=>$max_w);
		return $arr;	
	}
	
	
	
	
	
}

