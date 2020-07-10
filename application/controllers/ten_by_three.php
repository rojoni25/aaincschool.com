<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ten_by_three extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('tree_view_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$data['tree']=$this->get_tree($this->session->userdata['logged_ol_member']['usercode']);
		$data['breadcrumb']=$this->drow_breadcrumb_level($this->session->userdata['logged_ol_member']['usercode']);
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	public function tree()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['tree']=$this->get_tree($this->uri->segment(3));
		$data['breadcrumb']=$this->drow_breadcrumb_level($this->uri->segment(3));
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	function get_tree($code=''){
		$result=$this->tree_view_model->get_node_ten_by_three_by_id($code);
		$topnode=$this->tree_view_model->userdt_by_code($code);
		
		$tree_arr=array();
		$url=''.base_url().'index.php/ten_by_three/tree/';
		$top_nm=$topnode[0]['fname'].' '.$topnode[0]['lname'];
		$tree_arr['top_img']="<img src='".base_url()."asset/images/multitree/admin.png' title='".$name."' />";
		$tree_arr['top_nm']=$top_nm;
		
		if(isset($result[0])){
			$name=$result[0]['fname'].' '.$result[0]['lname'];
			$tree_arr['node1_img']="<a href='".$url."".$result[0]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['node1_nm']=$name;
		}
		else{
			$tree_arr['node1_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[1])){
			$name=$result[1]['fname'].' '.$result[1]['lname'];
			$tree_arr['node2_img']="<a href='".$url."".$result[1]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['node2_nm']=$name;
		}
		else{
			$tree_arr['node2_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[2])){
			$name=$result[2]['fname'].' '.$result[2]['lname'];
			$tree_arr['node3_img']="<a href='".$url."".$result[2]['usercode']."'><img src='".base_url()."asset/images/multitree/green.png' title='".$name."' /></a>";
			$tree_arr['node3_nm']=$name;	
		}
		else{
			$tree_arr['node3_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		if(isset($result[3])){
			$name=$result[3]['fname'].' '.$result[3]['lname'];
			$tree_arr['node4_img']="<a href='".$url."".$result[3]['usercode']."'><img src='".base_url()."asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['node4_nm']=$name;	
		}
		else{
			$tree_arr['node4_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		if(isset($result[4])){
			$name=$result[4]['fname'].' '.$result[4]['lname'];
			$tree_arr['node5_img']="<a href='".$url."".$result[4]['usercode']."'><img src='".base_url()."asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['node5_nm']=$name;	
		}
		else{
			$tree_arr['node5_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		////////////////////////////////
		if(isset($result[5])){
			$name=$result[5]['fname'].' '.$result[5]['lname'];
			$tree_arr['node6_img']="<a href='".$url."".$result[5]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['node6_nm']=$name;
		}
		else{
			$tree_arr['node6_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[6])){
			$name=$result[6]['fname'].' '.$result[6]['lname'];
			$tree_arr['node7_img']="<a href='".$url."".$result[6]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['node7_nm']=$name;
		}
		else{
			$tree_arr['node7_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[7])){
			$name=$result[7]['fname'].' '.$result[7]['lname'];
			$tree_arr['node8_img']="<a href='".$url."".$result[7]['usercode']."'><img src='".base_url()."asset/images/multitree/green.png' title='".$name."' /></a>";
			$tree_arr['node8_nm']=$name;	
		}
		else{
			$tree_arr['node8_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		if(isset($result[8])){
			$name=$result[8]['fname'].' '.$result[8]['lname'];
			$tree_arr['node9_img']="<a href='".$url."".$result[8]['usercode']."'><img src='".base_url()."asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['node9_nm']=$name;	
		}
		else{
			$tree_arr['node9_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		if(isset($result[9])){
			$name=$result[9]['fname'].' '.$result[9]['lname'];
			$tree_arr['node10_img']="<a href='".$url."".$result[9]['usercode']."'><img src='".base_url()."asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['node10_nm']=$name;	
		}
		else{
			$tree_arr['node10_img']="<img src='".base_url()."asset/images/multitree/empty.png' title='empty' />";
		}
		
	
		return $tree_arr;
	}
	
	
	function get_dropdown_createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1){
		foreach ($array as $categoryId => $category) 
		{
			if ($currLevel > $prevLevel) echo " <ol class='tree'> "; 
			if ($currLevel == $prevLevel) echo " </li> ";
			echo '<li><label for="subfolder2">'.$category['name'].'&nbsp;<a href="#" value="'.$category['id'].'" class="clsmemdt">
					<i class="icon-circle-arrow-right"></i></a></label><input type="checkbox" id="subfolder2"/>';
			if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
			$currLevel++; 
			
			if($currLevel<3)
			{
				$child=$this->get_dropdown_parent($category['id']);
				$this->get_dropdown_createTree($child, $categoryId, $currLevel, $prevLevel);
			}
			
			$currLevel--;               
		}
		if ($currLevel == $prevLevel) echo " </li>  </ol> ";
	}
	
	function get_dropdown_parent($usercode){
		$parent=$this->tree_view_model->get_node_ten_by_three_by_id($usercode);
		$arrayCategories = array();
		for($i=0;$i<count($parent);$i++){
			$name=$parent[$i]['fname'].''.$parent[$i]['lname'];
			$arrayCategories[$parent[$i]['usercode']] = array("name" =>$name, "id" =>$parent[$i]['usercode']);   
		}
		return $arrayCategories;
	}
	
	function drow_dropdowntree(){
		$arr=$this->get_dropdown_parent($this->session->userdata['logged_ol_member']['usercode']);
		echo '<div id="contenttree" class="general-style1">';
		$this->get_dropdown_createTree($arr, 0);
		echo '</div>';
	}
	
	
	
	function drow_breadcrumb_level($code){
		$user['bread']=array();
		if($code==$this->session->userdata['logged_ol_member']['usercode']){
			$result=$this->tree_view_model->get_breadcrumb_level($code);
			$user['bread'][]=$result;
			return $user['bread'];
		}
		while(1){
			$result=$this->tree_view_model->get_breadcrumb_level($code);
			
			$user['bread'][]=$result;
			if($result[0]['uplingmember10_3']==$this->session->userdata['logged_ol_member']['usercode']){
				$result=$this->tree_view_model->get_breadcrumb_level($result[0]['uplingmember10_3']);
				$user['bread'][]=$result;
				break;	
			}
			if(!isset($result[0])){
				break;	
			}
			$code=$result[0]['uplingmember10_3'];
		}
		$newArray = array_reverse($user['bread'], false);
		
		return $newArray;
	}
	
	
	
	
	
}

