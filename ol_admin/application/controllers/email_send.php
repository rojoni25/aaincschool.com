<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_send extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('email_send_model','',TRUE);
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
	
	
	////////////////
	function listing()
	{
		$result=$this->email_send_model->getAll_panding();
		$count=$this->email_send_model->get_count_member();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			$chkbox='<input type="checkbox" id="chKid" name="emailid[]" value="'.$result[$i]['usercode'].'|'.$result[$i]['emailid'].'">';
			$row = array(
					$chkbox,
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['emailid'],
					$edit
			);
			$output['aaData'][] = $row;
		}
		//var_dump($output);
		echo json_encode( $output );	
	}
	////////////////
	
	
	
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->email_send_model->get_record($this->uri->segment(4));
		}
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
			$receiver_dt  = $this->input->post('emailid');
    		$data['subject']		=	$this->input->post('subject');	
			$data['msg']			=	$this->input->post('msg');
			$data['timedt']			=	$nowdt;	
			$data['sender_code']	=	'-1';
			$data['tot_send']=count($receiver_dt);
			
			if($this->input->post('all_member')=='Y')
			{
				//all_member,total_member,total_send
				$receiver_dt			=	false;
				$data['all_member']	   	= 	'Yes';
				$total_member  			= 	$this->email_send_model->get_count_member();
				$data['total_member']	=	$total_member[0]['tot'];
			}
			
			$send_mail_code=$this->email_send_model->addItem($data,'send_mail_master');
			
			$from_emailid	=	 $this->session->userdata['logged_in_visa']['emailid'];
			$subject 		=	 $this->input->post('subject');
			$title			=	'NLLSYS-2018';
		
			$message		=	$this->input->post('msg');
			$headers 		= 	"MIME-Version: 1.0" . "\r\n";
			$headers 	   	.=  "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers 		.=  'From: '.$title.' <'.$from_emailid.'>' . "\r\n";
			
	
			
				
			if(!empty($receiver_dt)){
				
				for($i=0;$i<count($receiver_dt);$i++)
				{
					$dt=explode('|',$receiver_dt[$i]);
					$receiver_code	=	$dt[0];
					$send_to		=	$dt[1];
					$data2['send_mail_code']	=	$send_mail_code;
					$data2['receiver_code']		=	$receiver_code;
					$data2['receive_status']	=	'N';
					$data2['status']			=	'Active';
					$data2['send_succes']		=	'T';
					$this->email_send_model->addItem($data2,'send_mail_dt');
					
					$contain=$this->email_comman_contan($receiver_code);
					$e_array=array("heading"=>$this->input->post('subject'),"msg"=>$this->input->post('msg'),"contain"=>$contain);
					$message	=  	email_template_one($e_array);
					
					// $this->email->from(FROM_EMAIL);
					//$this->email->from('hap1994@gmail.com');
					
					// $this->email->subject($this->input->post('subject'));
					//$this->email->message($message);
					// $this->email->to($send_to);
					
        			
					// $this->email->send();
					sendemail(FROM_EMAIL,$this->input->post('subject'),$send_to,$message);
					//echo $this->email->print_debugger();
					//exit;	

				}
			}
			
			
			
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}

	
	
	function email_comman_contan($eid){
		$mem_dt		=	$this->email_send_model->get_member_by_code($eid);
		$ref_type	=	($mem_dt[0]['status']=='Active' ? "referralid" : "referralid_free");
		$ref_tot	=	$this->email_send_model->get_tot_ref($eid,$ref_type);
		$ref_nm		=	$this->email_send_model->get_member_by_code($mem_dt[0][$ref_type]);
		$html='<p>Username : '.$mem_dt[0]['username'].'</p>';
		$html.='<p>Password : '.$mem_dt[0]['password'].'</p>';
		$html.='<p>Total Referral : '.$ref_tot[0]['tot'].'</p>';
		$html.='<p>Referral : '.$ref_nm[0]['fname'].' '.$ref_nm[0]['lname'].'</p>';
		return $html;
	}
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->email_send_model->update($data,$this->table,$this->primary_key,$code[$i]);	
			}
		}
		
		
	}
}

