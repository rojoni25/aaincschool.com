<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_send_all extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('email_send_all_model','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	public function index()
	{
		$data['result']	=	$this->comman_fun->get_table_data('send_email_to_add',array('status !='=>'Inactive'));
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	////////////////
	function listing()
	{
		//$data['txt_query']='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		//$this->comman_fun->addItem($data,'test_query');
		
		
		//$result=$this->ObjM->getAll_panding();
		$result=$this->ObjM->getAll_Member();
		//$result=$this->ObjM->getAll();
		$count=$this->ObjM->get_count_member();
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
			$data['result']=$this->ObjM->get_record($this->uri->segment(4));
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			$data = array();
    		$data['subject']		=	$_POST['subject'];	
			$data['msg']			=	$_POST['msg'];	
			$data['timedt']			=	date('Y-m-d H:i:s');	
			$data['status']			=	'Active';
			$this->ObjM->addItem($data,'send_email_to_add');
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	
	
}

