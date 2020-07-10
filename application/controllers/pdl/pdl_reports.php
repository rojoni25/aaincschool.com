<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdl_reports extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		$this->load->model('pdl/admin/pdl_reports_model','ObjM',TRUE);
		
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
 	}
	

	function active_level_pay(){
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/active_level_pay_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function member_list()
	{
		$data['txt_query']='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$this->ObjM->addItem($data,'test_query');
			
		$filter = preg_replace('/\s\s+/', ' ',$_GET["sSearch"]);
		$filter=explode(" ",$filter);
		
		
	
		$result=$this->ObjM->member_list($filter);
		$count=$this->ObjM->member_count();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			
			$arr=$this->downline_level($result[$i]['usercode']);
			
			$level_1 = '<span class="cls_bold">'.$arr['level_1']['active']. '</span> /  <span class="cls_bold">'. $arr['level_1']['due'].'</span>';
			$level_2 = '<span class="cls_bold">'.$arr['level_2']['active']. '</span> /  <span class="cls_bold">'. $arr['level_2']['due'].'</span>';
			$level_3 = '<span class="cls_bold">'.$arr['level_3']['active']. '</span> /  <span class="cls_bold">'. $arr['level_3']['due'].'</span>';
				
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$level_1,
					$level_2,
					$level_3
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	
	function downline_level($eid){
		
		$arr=array();
		$result			=	$this->downline_member_list($eid);
		
		$arr['level_1']	=	$this->count_status($result['level_1']);
		$arr['level_2']	=	$this->count_status($result['level_2']);
		$arr['level_3']	=	$this->count_status($result['level_3']);
		
		return $arr;
	}
	
	
	
	protected function downline_member_list($code)
	{
		
		$arr=array();
		$level_1	=	$this->ObjM->get_downline_one_level($code);
		$level_2	=	$this->ObjM->get_downline_one_level($this->set_idcode($level_1));
		$level_3	=	$this->ObjM->get_downline_one_level($this->set_idcode($level_2));
		
		$arr=array(
		  'level_1'	=>	$level_1,
		  'level_2'	=>	$level_2,
		  'level_3'	=>	$level_3	
		);
			
		return $arr;
		
	}
	
	protected  function set_idcode($result){
		
		$arr=array();
		
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['usercode'];
			
		}
		
		return implode(",",$arr);
	}
	
	protected function count_status($result)
	{
		$now_time=time();
		$active=0;
		$due=0;
		for($i=0;$i<count($result);$i++){
			$due_time=(float)$result[$i]['due_time'];
			if((float)$result[$i]['due_time'] > $now_time){
				$active++;
			}else{
				$due++;
			}
		}
		
		$arr=array('active'=>$active,'due'=>$due);
		return $arr;
		
	}
	
	
	
	
	
	function member_status($status)
	{
		$data['html']=$this->member_status_listing($status);
		
		if($status=='due'){
			$data['title']='Due Member Report';
		}
		if($status=='active'){
			$data['title']='Active Member Report';
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/report_member_status_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function member_status_listing($status)
	{
		$result=$this->ObjM->get_member_status($status);	
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
			$row=$i+1;
			$html.='<tr>
					<td>'.$row.'</td>
					<td>'.$result[$i]['name'].'</td>
					<td>'.$result[$i]['username'].'</td>
					<td>'.date('d-m-Y',$result[$i]['due_time']).'</td>
					</tr>';
			
		}
		
		return $html;
	}
	
	function system_level(){
		
		$data['title']='System Level';
		
		$data['level']=$this->get_system_level(PDL_SYSTEM_USER);
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/report_system_level',$data);
		$this->load->view('comman/footer');
	}
	
	 protected function get_system_level($code)
	 {
		$arr=array();
		while(1)
		{
			$result	=	$this->ObjM->get_downline_one_level($code);	
			if(!isset($result[0])){
				break;
			}
			$arr[]=count($result);
			$code=$this->set_idcode($result);
		}
		
		return $arr;
			
	}
		
	
}

