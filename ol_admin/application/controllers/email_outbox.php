<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_outbox extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('email_outbox_model','',TRUE);
		$this->load->library('email');
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
		$result=$this->email_outbox_model->getAll();
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			if($result[$i]['all_member']=="Yes")
			{
				$allmember	=	"Yes";
				$total_send=	$result[$i]['total_member'].' / '.$result[$i]['total_send'];
			}
			else
			{
				$allmember="-";
				$total_send=$result[$i]['tot_send'];
			}
			
			$html .='<tr class="'.$status.'">
						<td><input type="checkbox" value="'.$result[$i]['send_mail_code'].'" class="recode_status_code"></td>
						<td>'.ago_time($result[$i]['timedt']).'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$total_send.'</td>
						<td>'.$allmember.'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['send_mail_code'].'" class="edit_rcd">
								<i class="icon-pencil"></i>
							</a>
						</td>
              		</tr>';
		}
		
		echo $html;
	}
	
	function addnew()
	{
		
		$data['result']=$this->email_outbox_model->get_record();
		if(count($data['result'])!=1){ $this->go_to_back();}
		$data['member']=$this->email_outbox_model->get_send_member();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->email_outbox_model->update($data,'send_mail_master','send_mail_code',$code[$i]);	
			}
		}
		
	}
	
	function go_to_back(){
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
}
