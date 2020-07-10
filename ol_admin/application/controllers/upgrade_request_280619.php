<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upgrade_request extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('upgrade_request_model','',TRUE);
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
	
	public function view()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		
		$this->load->view('comman/footer');
	}
	
	
	function listing($id=''){
		$result		=$this->upgrade_request_model->getAll($id);
		
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$ref		=$this->upgrade_request_model->get_member_by_code($result[$i]['referralid_free']); 
		 	
			if($result[$i]['payment']=='Y')
			{
				$payment='Paid';
				$cls='trpaid';
				$pay_btn='<a href="'.base_url().'index.php/upgrade_request/check_record/'.$result[$i]['usercode'].'"><button class="sendbtn btn-info">Active Member</button></a>';
				$pay_date=date("d-m-Y", strtotime($result[$i]['payment_dt']));
			}
			else{
				$pay_btn='<a href="'.base_url().'index.php/upgrade_request/manually_payment/'.$result[$i]['usercode'].'" class="manually-pay"><button class="sendbtn btn-warning">Manually Pay</button></a>';
				$payment='Not Paid';
				$cls='trunpaid';
				$pay_date='-';
			}
			
			
			
			$html .='<tr class="'.$cls.'">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.ago_time(date('d-m-Y H:i:s',$result[$i]['timedt'])).'</td>
						<td><strong>'.$payment.'</strong></td>
						<td>'.$pay_date.'</td>
						<td>'.$result[$i]['type'].'</td>
						<td>'.$ref[0]['fname'].' '.$ref[0]['lname'].'</td>
						<td>'.$ref[0]['mobileno'].'</td>
						<td>&nbsp;'.$pay_btn.'&nbsp;
							<a href="'.base_url().'index.php/upgrade_request/reject_request/'.$result[$i]['usercode'].'" class="btnreject"><button class="btn-danger sendbtn">Reject</button></a>
							<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'"><i class="icon-eye-open"></i></a>
						</td>
              		</tr>';
		}
		
			echo $html;
		
	}
	
	
	

	function manually_payment()
	{
		$data = array();
    	$data['payment'] 	= 	'Y';
		$data['payment_dt'] = 	time();
		$this->upgrade_request_model->update($data,'paid_request_master','usercode',$this->uri->segment(3));
		
		$data = array();
    	$data['usercode'] 	= 	$this->uri->segment(3);
		$data['timedt'] 	= 	time();	
		$data['create_by'] 	= 	'1';
		$this->upgrade_request_model->addItem($data,'product_access_permission');		
			
		
		header('Location: '.base_url().'index.php/upgrade_request/view');
		exit;
	}
	
	function check_record()
	{
		
		$check=$this->upgrade_request_model->check_request($this->uri->segment(3));
		

		if(!isset($check[0])){
			header('Location: '.base_url().'index.php/upgrade_request');
			exit;
		}
		$record=$this->upgrade_request_model->get_member_by_code($this->uri->segment(3));
		$ref=$this->upgrade_request_model->check_request($record[0]['referralid_free']);

		if(isset($ref[0]))
		{
			header('Location: '.base_url().'index.php/upgrade_request/upling_active/'.$record[0]['referralid_free']);
			exit;
		}
		
		header('Location: '.base_url().'index.php/user/panding_member_active/'.$this->uri->segment(3));
		exit;
	
	}
	
	function upling_active()
	{
		
		$data['record']=$this->upgrade_request_model->check_request($this->uri->segment(3));
		if(!isset($data['record'][0]))
		{
			header('Location: '.base_url().'index.php/upgrade_request');
			exit;
		}
		
		
		$data['upling']=true;
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
		
	}
	
	
	
	
	function reject_request()
	{
		$this->upgrade_request_model->delete_request($this->uri->segment(3));		
		header('Location: '.base_url().'index.php/upgrade_request');
		exit;
	}

	
}

