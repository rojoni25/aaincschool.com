<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class general_message extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('general_message_model','ObjM',TRUE);
		
 	}
	
	public function index()
	{
		$data['html']=$this->listing('viral_marketing');
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	public function payment_confirm()
	{
		$data['html']	=	$this->listing2('payment_confirm');
		$data['title']		=	'Payment Confirmation Message';
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_pc');
		$this->load->view('comman/footer');
	}
	
	public function viral_payment_confirmation()
	{
		$data['title']		=	'Viral Payment Confirmation';
		$data['html']=$this->listing2('viral_payment_confirmation');
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_pc');
		$this->load->view('comman/footer');
	}
	
	
	
	function listing($eid){
		$result=$this->ObjM->get_gen_msg($eid);
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$html .='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['timedt'])).'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['msg'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/delete/'.$result[$i]['id'].'"><span class="label label-important">Delete</span></a></td>
              		</tr>';
		}
		
		return $html;
	}
	
	function listing2($eid){
		$result=$this->ObjM->get_gen_msg($eid);
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$html .='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['status'].'</td>
					
						<td>'.date('d-m-Y',strtotime($result[$i]['timedt'])).'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['msg'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/delete/'.$result[$i]['id'].'"><span class="label label-important">Delete</span></a></td>
              		</tr>';
		}
		
		return $html;
	}
	
	function delete($eid){
		$result=$this->ObjM->get_msg_by_id($eid);
		$this->ObjM->delete('admin_message',array('id'=>$eid));
		
		if($result[0]['type']=='payment_confirm'){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/payment_confirm');
			exit;	
		}
		if($result[0]['type']=='viral_marketing'){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/');
			exit;
		}
		if($result[0]['type']=='viral_payment_confirmation'){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/viral_payment_confirmation');
			exit;
		}
		
		
		
		
	}
	
	
}

