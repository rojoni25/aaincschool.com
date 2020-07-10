<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix extends CI_Controller {
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	protected $tot_downline		=	0;
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_model','ObjM',TRUE);
		
 	}
	function kdk_code(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if($_POST['search']=='Y'){
				$data['result']=$this->search_member();
			}
			if($_POST['get_permission']=='Y'){
				
				$chk=$this->ObjM->check_kdk_code($_POST['kdk_code']);
				
				if(isset($chk[0])){
					
					$this->session->set_flashdata('show_msg','KDK Code "'.$_POST['kdk_code'].'" is Already Exist');	
					
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/kdk_code/');
					
					exit;
				}else{
					$this->kdk_code_insert();
				}
				
				
			}
			
		}
		
		$data['result_list']=$this->ObjM->get_kdkcode_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_kdk_code',$data);
		$this->load->view('comman/footer');
		
	}
	
	protected function search_member(){
		
		$memberdt=$this->ObjM->search_member($_POST['membercode']);
		if(!isset($memberdt[0])){
			$arr['vali']	=	false;
			$arr['msg']		=	"Invailed Search";	
			return $arr;		
		}
		
		$product_member=$this->ObjM->kdk_member_dt($memberdt[0]['usercode']);
		
		if(isset($product_member[0])){
			$arr['vali']=false;
			$arr['msg']		=	"".$memberdt[0]['fname']." ".$memberdt[0]['lname']." is Already Add";			
			return $arr;
		}
		
			
			$arr['vali'] = true;
			$arr['dt']  = $memberdt[0];
			return $arr;
			
	}
	protected function kdk_code_insert()
	{
		
		$data['kdk_code']	=	$_POST['kdk_code'];
		$data['usercode']	=	$_POST['usercode'];
		$data['add_time']	=	time();
		$data['add_by']	=	$this->session->userdata['logged_in_visa']['usercode'];
		$this->ObjM->addItem($data,'rm_kdk_code');
		$this->session->set_flashdata('show_msg','Insert Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/kdk_code/');
		exit;
		
	}
	
	function remove_kdk_code($eid){
		$this->ObjM->remove_kdk_code($eid);
		$this->session->set_flashdata('show_msg','Remove Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/kdk_code/');
	}
	
	function request()
	{
		$data['result_list']=$this->ObjM->get_request_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_request',$data);
		$this->load->view('comman/footer');	
	} 
	
	function reject_request($id){
		
		$data=array();
		$data['status']	=	'C';
		$this->ObjM->update($data,'rm_matrix_request','request_code',$id);
		
		$this->session->set_flashdata('show_msg','Delete Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/request/');
		exit;		
	}
	
	function request_approve($id)
	{
		$nextpos			=	$this->get_position(1);
		$data['next_level'] =	$this->html_breadcrumb_level($this->upling_user);
		
		$data['result']		=	$this->ObjM->get_request_dt_by_id($id);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_request_approve',$data);
		$this->load->view('comman/footer');	
	} 
	
	
	
	function insert_approve(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			
			if($_POST['downline']==''){
				
				$this->session->set_flashdata('show_msg','invalid request');
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/request/');
				exit;
				
			}
			
			if($_POST['downline']=='next_position'){
				$upling_member=1;
			}
			else{
				if($_POST['select_downline']==''){
					$this->session->set_flashdata('show_msg', 'invalid request');
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/request/');
					exit;
				}else{
					$upling_member=$_POST['select_downline'];
				}
			}
			
			$request_dt	=	$this->ObjM->get_request_dt_by_id($_POST['request_code']);
			
			$this->tot_downline=0;			
			$this->get_position($upling_member);	
			
			$upling_dt=$this->ObjM->get_tree_record($this->upling_user);	
			
			$data=array();
			
			$data['usercode'] 		= 	$request_dt[0]['usercode'];
			$data['upling_member']  = 	$upling_dt[0]['usercode'];
			$data['upling_id']  	= 	$this->upling_user;
			$data['side']  			= 	$this->upling_posi;
			$data['add_time']  		= 	time();
			$data['uby']  			= 	$this->session->userdata['logged_in_visa']['usercode'];
			
			$idcode=$this->ObjM->addItem($data,'rm_matrix');
			
			//Member payment Insert//
			$arr_pay=array('usercode'=> $request_dt[0]['usercode'],'amount'=> '59','position'=> $idcode,'wallet_type'=> 'RM');
			$this->payment_insert($arr_pay);
			
				
			$top_third_member	=	$this->get_top_third_member($idcode);
			
			
		
			$this->get_total_downline($top_third_member['idcode']);
			
			
			
			
			if($this->tot_downline==14){
					
				
					$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=> '191','position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
					$this->payment_insert($arr_pay);
					
					if($top_third_member['usercode'] == RM_SYSTEM_USER){
						
						$new_position['member_list']	=	array($top_third_member,$top_third_member,$top_third_member,$top_third_member);
						$new_position['new_position_pay']	=	59;
						
					}else{
						
						$top_system=array('upling_id'=>1);
						$new_position['member_list']	=	array($top_third_member,$top_third_member,$top_system);
						$new_position['new_position_pay']	=	59;
						
					}
					
					$new_position['upling']				=	$top_third_member['idcode'];
					
					$this->insert_member_in_tree($new_position);
					
			}//end downline
			
			
				
			$info=array();
			$info['status']='A';
			$this->ObjM->update($info,'rm_matrix_request','request_code',$_POST['request_code']);
			
			$this->session->set_flashdata('show_msg', 'Member Insert In Tree successfully');
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/request/');
			exit;
			
		}
	}
	
	protected function payment_insert($arr){
		$data=array();
		$data['usercode']		=	$arr['usercode'];
		$data['amount']			=	$arr['amount'];
		$data['position']		=	$arr['position'];
		$data['wallet_type']	=	$arr['wallet_type'];
		$data['timedt']			=	time();
		$this->ObjM->addItem($data,'rm_member_payment');
		
	}
	
	protected function insert_member_in_tree($new_position){	
		
		
		$member_list=$new_position['member_list'];
		
		$upling=$new_position['upling'];
		
		for($i=0;$i<count($member_list);$i++){
			
				$this->tot_downline=0; 
				
				$this->get_position($upling);
				
				$upling_dt	=	$this->ObjM->get_tree_record($this->upling_user);
			
				
				$data=array();
				$data['usercode'] 		=  $member_list[$i]['usercode'];
				$data['upling_member']  =  $upling_dt[0]['usercode'];
				$data['upling_id']  	=  $this->upling_user;
				$data['side']  			=  $this->upling_posi;
				$data['add_time']  		=  time();
				$data['uby']  			= 	$this->session->userdata['logged_in_visa']['usercode'];
				
				$idcode=$this->ObjM->addItem($data,'rm_matrix');
				
				$arr_pay=array('usercode'=> $data['usercode'],'amount'=>'59','position'=> $idcode,'wallet_type'=> 'RM');
				$this->payment_insert($arr_pay);
				
				
				
				$top_third_member	=	$this->get_top_third_member($idcode);
				$this->get_total_downline($top_third_member['idcode']);
				
				
				
				if($this->tot_downline==14){
			
					if($top_third_member['usercode']==RM_SYSTEM_USER){
						
						$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=> '400','position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
						
						$this->payment_insert($arr_pay);
						
						$new_pos['member_list']	=	array($top_third_member,$top_third_member,$top_third_member,$top_third_member);
						
					}else{
						$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=> '191','position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
						
						$this->payment_insert($arr_pay);
						
						$top_system=array('upling_id'=>1);
						
						$new_pos['member_list']	=	array($top_third_member,$top_third_member,$top_system);
					}
					
					$new_pos['upling']				=	$top_third_member['idcode'];
					
					$this->insert_member_in_tree($new_pos);
					
				}
				
		}
	}
	
	
	function check_multi_position_ajax($id)
	{
		$dt=$this->ObjM->get_tree_member_id($id);
		$result=$this->ObjM->get_multi_postion($dt[0]['usercode']);
		
		if(count($result)>1){
			
			$html='<div class="control-group">
            			<label class="control-label">Select Position</label>
            				<div class="controls">'.$this->downline_select_list($result).'</div>
          		</div>';
			
		}
		echo $html;
		
	}
	
	function downline_select_list($record){
		
		$html='<select id="downline_2" name="downline_2"  class="span6" >';
		for($i=0;$i<count($record);$i++){
			$posi=$i+1;
			$html.='<option value="'.$record[$i]['idcode'].'">Position:'.$posi.' '.$record[0]['name1'].' downline of '.$record[0]['name2'].' </option>	';	
		}
		$html.='</select>';	
		return $html;
		
	}
	
	
	protected function get_position($code){
		
		$result			=	$this->ObjM->get_downline_record($code);
		
		//****Level First Check****//
		if(count($result)< 2){
			
			$this->upling_user = $code;
			
			$this->upling_posi = count($result)+1;
			
			return;	
		}
		
		//****Set Member For Second Level****//
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['idcode'];
			
		}
		//****Call Function To Check Next Level****//
		$this->tree_check_position($arr);
		
	}
	
	
	
	//****Check Position******//
	protected function tree_check_position($arr_mem){
		
		//****Check Position******//

		for($pos=0;$pos<2;$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
				
				
				
				$result=$this->ObjM->get_countdownline($arr_mem[$i]);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					
					$this->upling_posi = $result[0]['tot']+1;
					
					return;		
					
				}
			
			}
		}
		
		
		//****Next Level Member Get******//
		$child_mem=array();
		
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->ObjM->get_downline_record($arr_mem[$i]);			
			
		}
		
		
		//****Next Level Member Set By Position******//
		$re_arr=array();
		
		for($pos=0;$pos<2;$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['idcode'];					
			
			}
		}
		
		
		//****Function Call To Check Again******//
		$this->tree_check_position($re_arr);
		
	}
	
	//this function is use for get total downline member count//
	function get_total_downline($uid)
	{
		$result=$this->ObjM->get_downline_record($uid);
		
		for($i=0;$i<count($result);$i++){
			
			$this->tot_downline++;
			
			$this->get_total_downline($result[$i]['idcode']);
			
		}
	}
	
	function get_top_third_member($id)
	{
		$upling		=	$this->ObjM->get_tree_record($id);
		
		$upling		=	$this->ObjM->get_tree_record($upling[0]['upling_id']);
		
		$upling		=	$this->ObjM->get_tree_record($upling[0]['upling_id']);
		
		$upling		=	$this->ObjM->get_tree_record($upling[0]['upling_id']);
		
		
		if(isset($upling[0])){
			if($upling[0]['upling_id']!='0'){
				 $upling[0]['third']=true;		
			}	
			else {
				$upling[0]['third']=false;
			}
		}else{
			$upling[0]['third']=false;
		}
		
		return $upling[0];
		
	}
	
	function drow_breadcrumb_level($code){
		$user['bread']=array();
		while(1){
			$i++;
			$result=$this->ObjM->userdt_by_code($code);
			
			if(!isset($result[0])){
				break;	
			}
			else{
				$user['bread'][]=$result;
			}
			
			$code=$result[0]['upling_id'];
		}
		$newArray = array_reverse($user['bread'], false);
		return $newArray;
	}
	
	function html_breadcrumb_level($eid){
		$html='';
		$breadcrumb=$this->drow_breadcrumb_level($eid);
		
		
		for($i=0;$i<count($breadcrumb);$i++){
				
				if($i==count($breadcrumb)-1){
					$html.='<li class="active">'.$breadcrumb[$i][0]['name'].'</li>';
				}
				else{
					$html.='<li>'.$breadcrumb[$i][0]['name'].'<span class="divider "><i class="icon-angle-right"></i></span></li>';
				}		
		}
		return $html;
	}
	
	

	
	
	
	
	 
}

