<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_login extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('member_login_model','',TRUE);
		ob_start();
 	}
	
	public function day_login()
	{
		$data['html']=$this->login_day_list();
		$data['table_list']=true;
		$data['title']='Member Login In Day';
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('member_login_view',$data);
		$this->load->view('comman/footer');
	}
	
	function current_login()
	{
		$data['html']=$this->current_login_list();
		$data['table_list']=true;
		$data['title']='Login Member';
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('member_login_view',$data);
		$this->load->view('comman/footer');
	}
	
	protected function current_login_list()
	{
		$result	=	$this->member_login_model->getAll();
		$html='';
		for($i=0;$i<count($result);$i++){
			if($result[$i]['sts']=='Active')
			{
				$sts='Paid';
			}
			else{
				$sts='Pending';
			}
			
			$html.='<tr>
          				<td>'.$result[$i]["usercode"].'</td>
          				<td>'.$result[$i]["fname"].' '.$result[$i]["lname"].'</td>
          				<td>'.$result[$i]["mobileno"].'</td>
          				<td>'.$result[$i]["emailid"].'</td>
						<td>'.date('j F Y (h:i a)',$result[$i]['logintime']).' <sub>'.ago_time(date('d-m-Y H:i:s',$result[$i]['logintime'])).'</sub></td>
						<td>'.$sts.'</td>
        	</tr>';
		}
		return $html;
	}

	protected function login_day_list()
	{
		$result	=	$this->member_login_model->login_in_day();
		$html='';
		for($i=0;$i<count($result);$i++){
			if($result[$i]['sts']=='Active')
			{
				$sts='Paid';
			}
			else{
				$sts='Pending';
			}
			$html.='<tr>
          				<td>'.$result[$i]["usercode"].'</td>
          				<td>'.$result[$i]["fname"].' '.$result[$i]["lname"].'</td>
          				<td>'.$result[$i]["mobileno"].'</td>
          				<td>'.$result[$i]["emailid"].'</td>
						<td>'.date('j F Y (h:i a)',$result[$i]['logintime']).' <sub>'.ago_time(date('d-m-Y H:i:s',$result[$i]['logintime'])).'</sub></td>
						<td>'.$sts.'</td>
        	</tr>';
		}
		return $html;
	
	}
	
	function login_filter($todt='', $fromdt='')
	{
		$to = strtotime($todt);
		$from = strtotime($fromdt)+86399;
		$result	=	$this->member_login_model->filder_date($to, $from);
		////////////
		$html='';
		for($i=0;$i<count($result);$i++){
			
			if($result[$i]['sts']=='Active')
			{
				$sts='Paid';
			}
			else{
				$sts='Pending';
			}
			
			$html.='<tr>
          				<td>'.$result[$i]["usercode"].'</td>
          				<td>'.$result[$i]["fname"].' '.$result[$i]["lname"].'</td>
          				<td>'.$result[$i]["mobileno"].'</td>
          				<td>'.$result[$i]["emailid"].'</td>
						<td>'.date('j F Y (h:i a)',$result[$i]['logintime']).' <sub>'.ago_time(date('d-m-Y H:i:s',$result[$i]['logintime'])).'</sub></td>
						<td>'.$sts.'</td>
        	</tr>';
		}
		echo $html;
		///////////
		
	
	}
	
	
	
	
}

