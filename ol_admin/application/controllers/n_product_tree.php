<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product_tree extends CI_Controller 
{
	
	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('n_product_tree_model','ObjM',TRUE);
 	}
	
	function dashboard()
	{
		$data['total']			=	$this->ObjM->count_member_by_status();
		$data['active']			=	$this->ObjM->count_member_by_status('active');
		$data['due']			=	$this->ObjM->count_member_by_status('due');
		$data['under_review']	=	$this->ObjM->count_under_review();
		
		
		
		$result=$this->ObjM->get_all_active_member();
		
		$data['product_1']=0;
		$data['product_2']=0;
		
		for($i=0;$i<count($result);$i++){
			$payment=$this->ObjM->last_payment($result[$i]['usercode']);
			if(((int)$payment[0]['amount'])==15){
				$data['product_1']++;
			}	
				if(((int)$payment[0]['amount'])==100){
				$data['product_2']++;
			}
		}
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_dashboard',$data);
		$this->load->view('comman/footer');
	}

	
	
	function member_view()
	{
		$data['html']	=	$this->member_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_member_view',$data);
		$this->load->view('comman/footer');
	}
	
		
	
	function member_list()
	{
		$result=$this->ObjM->member_list();
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$payment=$this->ObjM->last_payment($result[$i]['usercode']);
			
			if($_REQUEST['product_type']!=''){
				if(((int)$_REQUEST['product_type'])!=((int)$payment[0]['amount'])){
					continue;
				}
			}
			
			$join_dt=date('d-m-Y',$result[$i]['join_date']);
			$due_dt=date('d-m-Y',$result[$i]['due_time']);
			$edit='<a href="'.base_url().'index.php/n_product_tree/detail/'.$result[$i]['usercode'].'"><span class="label label-important">Details</samp></a>';
			$html.='<tr>
					<td>'.$result[$i]['usercode'].'</td>
					<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
					<td>'.$result[$i]['username'].'</td>
					<td>'.$join_dt.'</td>
					<td>'.$due_dt.'</td>
					<td>'.$payment[0]['amount'].'</td>
					<td>'.date('d-m-Y',$payment[0]['time_dt']).'</td>
					<td>'.$result[$i]['status'].'</td>
					<td>'.$edit.'</td>
				 </tr>';			
		}
		
		return $html;
	}
	
	function detail($eid){
		
		$data['result']		=	$this->ObjM->get_ams_member($eid);
		$data['payment']	=	$this->ObjM->get_all_payment($eid);
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_member_detail',$data);
		$this->load->view('comman/footer');
	}
	
	
	function remove_member()
	{
		$data['member_list']	 =	$this->ObjM->get_no_bottom_line_member();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_member_remove',$data);
		$this->load->view('comman/footer');
		
	}
	
	function remove_from_true(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$member_dt=$this->ObjM->product_member_dt($_POST['membercode']);
			//***Check Remove Member Is Exist Or Not***//
			if(isset($member_dt[0])){
				
				$chk=$this->ObjM->check_bottom_member($_POST['membercode']);
				
				//***Check Bottom Member***//
				if(!isset($chk[0])){
					
					$return=$this->process_to_remove();
					$msg='Member Remove From Tree';
					
				}else{
					
					$msg='Invailed Query';	
				}
			}
			else{
				$msg='Invailed Query';
			}
			
			$this->session->set_flashdata('show_msg',$msg);	
				
			
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/remove_member/');
		exit;
	}
	
	protected function process_to_remove(){
		
		
		$member_dt=$this->ObjM->product_member_dt($_POST['membercode']);
		
		//**Get All Upling Payment**//
		$upling_pay=$this->ObjM->get_upling_member_pay($_POST['membercode']);
		
		//**Update Upling Member Payment**//
		for($i=0;$i<count($upling_pay);$i++){
			
			$this->ObjM->product_balance_update($upling_pay[$i]['usercode'],$upling_pay[$i]['amount']);
			
		}
		
		//**Get Member Monthly Payment**//
		$member_pay=$this->ObjM->get_member_payment_monthly($_POST['membercode']);
		
		//**Delete upling Member Payment**//
		$this->ObjM->delete_upling_payment($_POST['membercode']);
		
		//**Delete  Member Monthly Payment**//
		$this->ObjM->delete_monthly_payment($_POST['membercode']);
		
		//**Delete  Member Monthly Payment**//
		$this->ObjM->delete_from_tree($_POST['membercode']);
		
		$data=array();
		$json['member_dt']   =  $member_dt;
		$json['upling_pay']  =  $upling_pay;
		$json['member_pay']  =  $member_pay;
		$json['member_pay']  =  $member_pay;
		
		$data['option_dt'] 	 =  json_encode($json);
		$data['usercode'] 	 =  $_POST['membercode'];
		$data['timedt']		 =  time(); 
		
		$this->ObjM->addItem($data,'n_product_member_remove');
		
	}
	
	function member_permission(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if($_POST['search']=='Y'){
				$data['result']=$this->search_member();
			}
			if($_POST['get_permission']=='Y'){
				$this->permission_insert();
			}
			
		}
		
		$data['result_list']=$this->ObjM->get_permition_member_list();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_member_permission',$data);
		$this->load->view('comman/footer');
		
	}
	
	protected function search_member(){
		
		$memberdt=$this->ObjM->search_member($_POST['membercode']);
		if(!isset($memberdt[0])){
			$arr['vali']	=	false;
			$arr['msg']		=	"Invailed Search";	
			return $arr;		
		}
		
		$product_member=$this->ObjM->product_member_dt($memberdt[0]['usercode']);
		
		if(isset($product_member[0])){
			$arr['vali']=false;
			$arr['msg']		=	"".$memberdt[0]['fname']." ".$memberdt[0]['lname']." is Already Exist Is Tree";			
			return $arr;
		}
			
		$chk_permission = $this->ObjM->get_usercode_in_permission($memberdt[0]['usercode']);
			
		if(isset($chk_permission[0])){
			$arr['vali']=false;
			$arr['msg']		=	"".$memberdt[0]['fname']." ".$memberdt[0]['lname']." is Already Product Permission";			
			return $arr;
		}
			
			$arr['vali'] = true;
			$arr['dt']  = $memberdt[0];
			return $arr;
			
	}
	protected function permission_insert()
	{
		$data['usercode']	=	$_POST['usercode'];
		$data['timedt']		=	time();
		
		$this->ObjM->addItem($data,'n_product_permission');
		$this->session->set_flashdata('show_msg','Permission Insert Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/member_permission/');
		exit;
		
	}
	
	function remove_permission($eid){
		$this->ObjM->remove_permission($eid);
		$this->session->set_flashdata('show_msg','Permission Remove Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/member_permission/');
	}
	
	
	function under_view(){
		$data['html']=$this->under_member_list();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_under_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function under_member_list()
	{
		$result=$this->ObjM->get_under_member_list();
		
		$html='';
		for($i=0;$i<count($result);$i++){
			
		$join_dt=date('d-m-Y',$result[$i]['subscription_time']);
			
		$html.='<tr>
          <td>'.$result[$i]['usercode'].'</td>
		  <td>'.$result[$i]['subscription_id'].'</td>
          <td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
          <td>'.$join_dt.'</td>
        </tr>';
			
		}
		
	return $html;
	}
	
	
	
	
	
}

