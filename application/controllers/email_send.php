<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_send extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('email_send_model','ObjM',TRUE);
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
		$result=$this->ObjM->getAll();
		$html='';
		for($i=0;$i<count($result);$i++){
			
			$html .='<tr>
						<td><input type="checkbox" id="chKid'.$i.'" class="filled-in" name="usercode_list[]" value="'.$result[$i]['usercode'].'"><label for="chKid'.$i.'"></label></td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
              		</tr>';
		}
		
			echo $html;
	}
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->ObjM->get_record($this->uri->segment(4));
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$result		=	$this->get_email_id();
			
		

			
			$data = array();
			$receiver_dt  		= 	$this->input->post('usercode_list');
			
    		$data['subject']	=	$this->input->post('subject');	
			$data['msg']		=	$this->input->post('msg');
			$data['timedt']		=	date('Y-m-d H:i:s');	
			$data['sender_code']=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['tot_send']	=	count($result['email']);
			$email_list	= array_chunk($result['email'],10);
			$send_mail_code=$this->ObjM->addItem($data,'send_mail_master');	
			
			$this->send_email($email_list);
			$this->insert_email_dt($result['id'],$send_mail_code);
			
			if($this->input->post('all_member')=='Y'){
				$receiver_dt  = $this->ObjM->get_all_member();
				$all_member=true;
				$data['tot_send']	=	count($receiver_dt);
			}
			
			
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	function get_email_id(){
		$arr['email']	=array();
		$arr['id']		=	array();
		
		if($_POST['all_member']=='Y'){
			$result  = $this->ObjM->get_all_member();
			for($i=0;$i<count($result);$i++){
				$list[] = $result[$i]['emailid'];
				$id_list[] = $result[$i]['usercode'];
			}
		}else{
			$id_list		=	$_POST['usercode_list'];
			if(count($_POST['usercode_list']) > 0){
				$email_list = $this->ObjM->get_email_list(implode(',',$_POST['usercode_list']));
			}
			for($i=0;$i<count($email_list);$i++){
				$list[] = $email_list[$i]['emailid'];
			}
			
		}
		
		$arr['email']	=	$list;
		$arr['id']		=	$id_list;
		
		return $arr;	
		
	}
	
	protected function send_email($email_list){
		
		$e_array=array("heading"=>$_POST['subject'],"msg"=>$_POST['msg'],"contain"=>'');	
		$message=email_template_one($e_array);
		for($i=0;$i<count($email_list);$i++){

			$resp_code = sendemail(FROM_EMAIL,$_POST['subject'],$email_list[$i],$message);
			$t=($resp_code>=200 && $resp_code<=299);
			//if($t)
//			{
//				echo 'email send';
//			}else
//			{
//				 echo $this->email->print_debugger();
//			}
//			exit;
			
		}
	}
	
	protected function insert_email_dt($arr,$id){
		$data=array();
		for($i=0;$i<count($arr);$i++){
			$data['send_mail_code']	=	$id;
			$data['receiver_code']	=	$arr[$i];
			$data['status']			=	'Active';
			$this->ObjM->addItem($data,'send_mail_dt');
		}	
	}
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->ObjM->update($data,$this->table,$this->primary_key,$code[$i]);	
			}
		}
		
		
	}
}

