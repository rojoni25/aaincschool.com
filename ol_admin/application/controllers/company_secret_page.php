<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class company_secret_page extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('company_secret_page_model','ObjM',TRUE);
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
			if($result[$i]['status']=='Inactive'){
				$status='st_inactive';
			}
			else{
				$status='';
			}
			
			$html .='<tr class="'.$status.'">
						<td><input type="checkbox" value="'.$result[$i]['secret_page_code'].'" class="recode_status_code"></td>
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.$result[$i]['page_title'].'</td>
						<td>'.$result[$i]['page_key'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['secret_page_code'].'" class="edit_rcd">
								<i class="icon-pencil"></i>
							</a>&nbsp;&nbsp;
							<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/permission/'.$result[$i]['secret_page_code'].'" class="edit_rcd">
								Member Permission
							</a>
							
						</td>
              		</tr>';
		}
		
			echo $html;
	}
	
	
	function permission($secret_page_code)
	{
			$data['result']=$this->ObjM->get_record($secret_page_code);
			$data['html']=$this->get_permission_listing($secret_page_code);
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('company_secret_page_permission',$data);
			$this->load->view('comman/footer');
	}
	
	function get_permission_listing($secret_page_code){
		$result=$this->ObjM->get_permission_listing($secret_page_code);
		$html='';
		for($i=0;$i<count($result);$i++){
			$html.='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td><a class="cls_remove" href="'.base_url().'index.php/'.$this->uri->segment(1).'/remove_permission/'.$result[$i]['permission_code'].'"><i class="icon-remove"></i></a></td>
					</tr>';
		}
		return $html;
	}
	
	function add_permission(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$data['usercode']			=	$_POST['usercode'];
			$data['secret_page_code']	=	$_POST['secret_page_code'];
			$data['create_date'] 		= 	$now;
		
			
			
			$arr=array('usercode'=>$_POST['usercode'],'secret_page_code'=>$_POST['secret_page_code']);
			$chk=$this->ObjM->check_permition($arr);
		
			if(!isset($chk[0])){
				$permission_code	=	$this->ObjM->addItem($data,'compay_secret_page_permission');
				$memberdt			=	$this->ObjM->get_member_by_usercode($_POST['usercode']);
				$return['message']='Member Add Successfully';
				$return['html']='<tr>
								<td>'.$memberdt[0]['usercode'].'</td>
								<td>'.$memberdt[0]['username'].'</td>
								<td>'.$memberdt[0]['fname'].' '.$result[0]['lname'].'</td>
								<td><a class="cls_remove" href="'.base_url().'index.php/'.$this->uri->segment(1).'/remove_permission/'.$permission_code.'"><i class="icon-remove"></i></a></td>
					</tr>';
			}
			else{
				$return['message']='Member Already Add';
			}
			echo json_encode($return);
			exit;
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/permission/'.$_POST['secret_page_code']);
		exit;
	}
	
	function remove_permission($eid){
		$this->ObjM->row_delete($eid);
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
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$data['page_name']=$this->input->post('page_name');	
			$data['page_title']=$this->input->post('page_title');
			$data['video_link']=$this->input->post('video_link');
			$data['contain']=$this->input->post('contain');
			$data['page_key']=$this->input->post('page_key');
			
		
			if($this->input->post('mode')=="Add"){
				$data['create_date']	=	$nowdt;	
				$data['create_by']		=	$this->session->userdata['logged_in_visa']['usercode'];
				$secret_page_code=$this->ObjM->addItem($data,'compay_secret_page');
			}
			if($this->input->post('mode')=="Edit"){
				$data['update_date']	=	$nowdt;	
				$data['update_by']		=	$this->session->userdata['logged_in_visa']['usercode'];
				$this->ObjM->update($data,'compay_secret_page','secret_page_code',$this->input->post('eid'));	
				
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
				$this->ObjM->update($data,'compay_secret_page','secret_page_code',$code[$i]);	
			}
		}	
	}
	
	function auto_camplate($pagecode){
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->get_user_filter($filter,$pagecode);
	
		$json=array();
		for($i=0;$i<count($user);$i++){
			$name=$user[$i]['fname'].' '.$user[$i]['lname'].' ('.$user[$i]['usercode'].')';
			$json[]=array(
				'label'=>$name,
				'value'=>$user[$i]['usercode']
        	);
		}
		echo json_encode($json);
	}
	
	
	
}

