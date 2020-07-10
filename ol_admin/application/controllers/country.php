<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class country extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('country_model','',TRUE);
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
		$result=$this->country_model->getAll();
		$html='';
		for($i=0;$i<count($result);$i++){
			if($result[$i]['status']=='Inactive'){
				$status='st_inactive';
			}
			else{
				$status='';
			}
			if($result[$i]['country_flag']!=''){
				$img='<img src="'.base_url().'/upload/country_flag/'.$result[$i]['country_flag'].'">';
			}
			else{
					$img='-';
			}
			$html .='<tr class="'.$status.'">
						<td><input type="checkbox" value="'.$result[$i]['country_code'].'" class="recode_status_code"></td>
						<td>'.$img.'</td>
						<td>'.$result[$i]['country_name'].'</td>
						<td>'.$result[$i]['country_pri_code'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['country_code'].'" class="edit_rcd">
								<i class="icon-pencil"></i>
							</a>
						</td>
              		</tr>';
		}
		
			echo $html;
	}
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->country_model->get_record($this->uri->segment(4));
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
    		$data['country_name']=$this->input->post('country_name');	
			$data['country_pri_code']=$this->input->post('country_pri_code');
			
			$files = $_FILES;
			$config = array();
    		$config['upload_path'] = './upload/country_flag';
    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
    		$config['max_size']      = '0';
    		$config['overwrite']     = FALSE;
			
			if($files['post_img']['name']){
				
				$_FILES['userfile']['name'] 	= 	$files['post_img']['name'];
        		$_FILES['userfile']['type'] 	= 	$files['post_img']['type'];
        		$_FILES['userfile']['tmp_name']	= 	$files['post_img']['tmp_name'];
        		$_FILES['userfile']['error']	= 	$files['post_img']['error'];
        		$_FILES['userfile']['size']		= 	$files['post_img']['size']; 
				$image_info 	= getimagesize($_FILES['userfile']['tmp_name']);
				$image_width 	= $image_info[0];
				$image_height 	= $image_info[1];
				
				
				
				$rand=rand(100000,100000000);
				$fileName=$rand.$_FILES['post_img']['name'];
				$fileName = str_replace(" ","",$fileName);
        		$config['file_name'] = $fileName;
    			$this->upload->initialize($config);
    			$this->upload->do_upload();
				$data['country_flag']	=	$fileName;
			
			}	
			
				
			if($this->input->post('mode')=="Add"){
				
				$data['create_date']	=	$nowdt;	
				$country_code=$this->country_model->addItem($data,$this->table);
			}
			if($this->input->post('mode')=="Edit"){
				$data['update_date']	=	$nowdt;	
				$this->country_model->update($data,$this->table,$this->primary_key,$this->input->post('eid'));	
				
			}
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->country_model->update($data,$this->table,$this->primary_key,$code[$i]);	
			}
		}
	
	}
	
	
	
	
	
	public function test()
	{
		$result=$this->country_model->get_record_member();	
		
		
		
		for($i=0;$i<count($result);$i++){
			
			$pay['status']='Paid';
			//$this->country_model->update($pay,'paid_request_master','usercode',$result[$i]['usercode']);	
				
			//***member status update***//
			$data=array();
			$data['status']='Pending';
			//$this->country_model->update($data,'membermaster','usercode',$result[$i]['usercode']);	
		}	
	
		
	}
	
	
	
	function test2($eid)
	{
		$result=$this->country_model->n_product_member();
		
		for($i=0;$i<count($result);$i++)
		{
			$payment=$this->country_model->last_payment($result[$i]['usercode']);
			
			echo 'Join Date '.date('d-m-Y h:i:s',$result[$i]['join_time']).'<br>';
			echo 'Join Date '.date('d-m-Y h:i:s',$result[$i]['due_time']).'<br>';
			echo $result[$i]['product_type'].'<br>';
			echo '---------<br>';
			
			if($result[$i]['product_type']=='2')
			{
				$data['due_time']	=	strtotime('+6 month',$payment[0]['time_dt']);
				$this->country_model->update($data,'n_product_member','id',$result[$i]['id']);	
				
			}
			else{
				$data['due_time']	=	strtotime('+1 month',$payment[0]['time_dt']);
				$this->country_model->update($data,'n_product_member','id',$result[$i]['id']);	
			}
			
		}
		var_dump($result);
		
		
	}
	
	
	
	
	
	
	
	
}

