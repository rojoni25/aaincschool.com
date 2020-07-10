<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_tree extends CI_Controller {
	
	protected $tree_level_count=0;
	protected $tree_arr;
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_tree_model','ObjM',TRUE);
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function view($eid)
	{
		
		$arr[]=$eid;
		$this->tree_elements($arr);
		$data['tree_elements']=$this->tree_arr;
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['breadcrumb']=$this->drow_breadcrumb_level($eid);
		
		$data['top']	=	$this->ObjM->userdt_by_code($eid);
		$data['position']=$this->ObjM->get_multi_position($data['top'][0]['usercode']);
		
		$data['third_level']=$this->position_downline_member_third_level($eid);
		
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_tree_view',$data);
		$this->load->view('comman/footer');
	}
	
	public function tree($eid)
	{
		$arr[]=$eid;
		$this->tree_elements($arr);
		$data['tree_elements']=$this->tree_arr;
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['breadcrumb']=$this->drow_breadcrumb_level($eid);
		
		$data['top']=$this->ObjM->userdt_by_code($eid);
		$data['position']=$this->ObjM->get_multi_position($data['top'][0]['usercode']);
		
		$data['third_level']=$this->position_downline_member_third_level($eid);
		
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_tree_view',$data);
		$this->load->view('comman/footer');
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
	
	function auto_camplate(){
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->get_user_filter($filter);
		
		$data['txt_query']=$this->db->last_query();
		$this->ObjM->addItem($data,'test_query');
		
		$json=array();
		for($i=0;$i<count($user);$i++){
			$name=$user[$i]['name'].' ('.$user[$i]['usercode'].')';
			$json[]=array(
				'label'=>$name,
				'value'=>$user[$i]['idcode']
        	);
		}
		
		$data['txt_query']=json_encode($json);
		$this->ObjM->addItem($data,'test_query');
		echo json_encode($json);
	}
	
	function get_memberdt_by_id($id)
	{
		$result =	$this->ObjM->member_all_dt_by_code($id);
		
		echo $html='<table class="table">
					<tr><td width="30%">Usercode</td><td width="70%"><a href="'.MATRIX_BASE.$this->uri->rsegment(1).'/view/'.$result[0]['idcode'].'">'.$result[0]['usercode'].'</a></td></tr>
					<tr><td>Name</td><td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[0]['username'].'">'.$result[0]['name'].'</a></td></tr>
					<tr><td>Username</td><td>'.$result[0]['username'].'</td></tr>
					<tr><td>Mobile No</td><td>'.$result[0]['mobileno'].'</td></tr>
					<tr><td>Phone Number</td><td>'.$result[0]['phone_no'].'</td></tr></table>';
		
	}
	
  function test($p){
		$arr[]=$p;
		$this->tree_elements($arr);
		$data['tree_elements']=$this->tree_arr; 
		var_dump($this->tree_arr);
	}
 
 	
	
	
	//****Check Position******//
	protected function tree_elements($arr_mem){
		
		//****Check Position******//
		if($this->tree_level_count>2){
			return;
		}
		
		//****Next Level Member Get******//
		for($i=0;$i<count($arr_mem);$i++){
			
			$result	=	$this->ObjM->get_downline_member($arr_mem[$i]);	
			
			if(isset($result[0])){
				$result[0]['child']=$this->ObjM->get_downline_member_count($result[0]['idcode']);
				$result[0]['img']="<img src='".base_url()."/asset/images/multitree/admin.png'  />";
				$this->tree_arr[]=$result[0];
			}
			else{
				$result[0]['idcode']='-222';
				$p=array('member'=>'No','img'=> "<img src='".base_url()."/asset/images/multitree/empty.png' />");
				$this->tree_arr[]=$p;
			}
			
			if(isset($result[1])){
				$result[1]['child']=$this->ObjM->get_downline_member_count($result[1]['idcode']);
				$result[1]['img']="<img src='".base_url()."/asset/images/multitree/admin.png'  />";
				
				$this->tree_arr[]=$result[1];
			}
			else{
				$result[1]['idcode']='-222';
				$p=array('member'=>'No','img'=> "<img src='".base_url()."/asset/images/multitree/empty.png' />");
				$this->tree_arr[]=$p;
			}
			
			
			
			$arr[]=$result[0]['idcode'];
			$arr[]=$result[1]['idcode'];
		}
		
		$this->tree_level_count++;
		//****Function Call To Check Again******//
		$this->tree_elements($arr);
		
	}
	
	function get_mutli_postion($eid, $idcode){
		$result=$this->ObjM->get_multi_position($eid);
		if(count($result)>1){
			$html='<select id="multi_position">';
       		 for($i=0;$i<count($result);$i++){
		   		$pos=$i+1;
				$sel=($result[$i]['idcode']==$idcode) ? "selected='selected'" : "";
       			$html.='<option '.$sel.' value="'.$result[$i]['idcode'].'">Position :'.$pos.'</option>';
        	} 
       		$html.='</select>';
		}
		return $html;
	}
	
	function html_breadcrumb_level($eid){
		$html='';
		$breadcrumb=$this->drow_breadcrumb_level($eid);
		
		
		for($i=0;$i<count($breadcrumb);$i++){
				
				if($i==count($breadcrumb)-1){
					$html.='<li class="active">'.$breadcrumb[$i][0]['name'].'</li>';
				}
				else{
					$html.='<li><a class="next_level" href="'.$breadcrumb[$i][0]['idcode'].'">'.$breadcrumb[$i][0]['name'].'</a><span class="divider "><i class="icon-angle-right"></i></span></li>';
				}		
		}
		return $html;
	}
	
	function tree_drow($eid){

		$top=$this->ObjM->userdt_by_code($eid);		
		$arr[]=$eid;
		
		$this->tree_elements($arr);
		$tree_elements=$this->tree_arr;
		
		
		$top_child=$this->ObjM->get_downline_member_count($eid);
		
		
			
			if($top_child < 2){
				$img_btn='<a class="set_member" href="'.$eid.'" sname="'.$top[0]['name'].'"><img src="'.base_url().'asset/images/multitree/green.png"  /></a>';
			}
			else{
				$img_btn='<img src="'.base_url().'asset/images/multitree/red.png"  />';
			}
			
		
		
		
		
		$html='<div class="top" style="text-align:center;">'.$img_btn.'<p><a  class="next_level" href='.$eid.'>'.$top[0]['name'].'</a></p></div>
		<div style="height:30px;"></div>
		<div class="level1">
		<ul class="child1">
			<img class="linehr1" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[0]).'
			'.$this->set_node($tree_elements[1]).'
			
		</ul>
		</div>
		<div class="clear"></div>
		<div style="height:30px;"></div>
		<div class="level2">
		<ul class="child2">
			<img class="linehr2" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[2]).'
			'.$this->set_node($tree_elements[3]).'
			<div class="clear"></div>
		</ul>
		<ul class="child2">
			<img class="linehr2" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[4]).'
			'.$this->set_node($tree_elements[5]).'
			<div class="clear"></div>
		</ul>
		</div>
		<div class="clear"></div>
		<div style="height:30px;"></div>
		<div class="level3">
		<ul class="child3">
			<img class="linehr2" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[6]).'
			'.$this->set_node($tree_elements[7]).'
			<div class="clear"></div>
		</ul>
		<ul class="child3">
			<img class="linehr2" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[8]).'
			'.$this->set_node($tree_elements[9]).'
			<div class="clear"></div>
		</ul>
		<ul class="child3">
			<img class="linehr2" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[10]).'
			'.$this->set_node($tree_elements[11]).'
			
		</ul>
		<ul class="child3">
			<img class="linehr2" src="'.base_url().'asset/images/multitree/44.png" />
			'.$this->set_node($tree_elements[12]).'
			'.$this->set_node($tree_elements[13]).'
			
		</ul>
		</div>';
		
		$data['tree']		=	$html;
		$data['breadcrumb']	=	$this->html_breadcrumb_level($eid);
		$data['postion']	= $this->get_mutli_postion($top[0]['usercode'],$eid);
		
		echo json_encode($data);
			
	}
	
	protected function set_node($record){
		
		$name=($record['usercode']=='-1') ? "System" : $record['name'];
		
		if(isset($record['idcode'])){
			if($record['child'] < 2){
				$img_btn='<a class="set_member" href="'.$record['idcode'].'" sname="'.$name.'"><img src="'.base_url().'asset/images/multitree/green.png"  /></a>';
			}
			else{
				$img_btn='<img src="'.base_url().'asset/images/multitree/red.png"  />';
			}
		}
		
		else{
			$img_btn='<img src="'.base_url().'asset/images/multitree/empty.png"  />';
		}
		
		$p='<li><img class="line" src="'.base_url().'asset/images/multitree/vr_line.jpg" />'.$img_btn.'<p><a  class="next_level"  href='.$record['idcode'].'>'.$name.'</a></p></li>';
		
		return $p;
	}
	
	//**Open Popup**//
	function tree_popup($id)
	{
		$data['id']	=	$id;
		
		
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_tree_popup',$data);
	}
	
	//**Open Popup Search Memeber**//
	function find_member($filter)
	{
		$filter=urldecode($filter);
		$filter = preg_replace('/\s\s+/', ' ',$filter);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->member_search($filter);
	
		if(isset($user[0])){
			$html='<span class="search_txt">'.$user[0]['name'].' ('.$user[0]['usercode'].')</span> <a class="next_level" href="'.$user[0]['idcode'].'"> <button class="btn btn-danger">Go</button></a>';
		}
		else{
			$html='Not Found';
		}
		echo $html;
	}
	
	
	protected function position_downline_member_third_level($code)
	{
		
		$arr=array();
		$result	=	$this->ObjM->get_downline_one_level($code);
		$result	=	$this->ObjM->get_downline_one_level($this->set_idcode($result));
		$result	=	$this->ObjM->get_downline_one_level($this->set_idcode($result));
	
		for($i=0;$i<count($result);$i++){
			$result[$i]['level']=$p;
			array_push($arr,$result[$i]);
		}
		return $arr;
		
	}
	
	protected  function set_idcode($result){
		
		$arr=array();
		
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['idcode'];
			
		}
		
		return implode(",",$arr);
	}
	
	
	function get_upling_path_for_pop_up($eid){
		$breadcrumb=$this->drow_breadcrumb_level($eid);
		$arr=array();
		for($i=0;$i<count($breadcrumb);$i++){
			$arr[] = $breadcrumb[$i][0]['name'];
		}
		
		$json['msg']=implode(' > ',$arr);
		echo json_encode($json);
		
	}


}
