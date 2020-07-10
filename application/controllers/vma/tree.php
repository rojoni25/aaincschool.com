<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tree extends CI_Controller {
	
	
	protected $tree_html='';
	
	function __construct()
 	{
		parent::__construct(); 
		$this->load->library('vma_class');
   		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		if(!$this->vma_class->check_in_tree()){
			header('Location: '.base_url().'');
			exit;	
		}
		
		
		
 	}
	
	public function view($eid)
	{
		
		
		
		$eid	= $this->session->userdata['logged_ol_member']['usercode'];
	
		$data['breadcrumb']		=	$this->vma_class->upling_chain($eid);
		$data['tree']			=	$this->get_tree($eid);
		$data['service_tree']	=	$this->drow_dropdowntree();
		$data['top_usercode']	=	$eid;
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'tree_view',$data);
		$this->load->view('comman/footer');
	}
	
	function t($code){
		var_dump($code);
		$topnode=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$code));
		var_dump($topnode);
	}
	
	function get_tree($code=''){
		$result	=	$this->vma_class->get_child($code);
		
		
		$topnode=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$code));
		
	
		$tree_arr=array();

		$top_nm=$topnode[0]['fname'].' '.$topnode[0]['lname'];
		$tree_arr['top_img']="<img src='".base_url()."/asset/images/multitree/admin.png' title='".$name."' />";
		$tree_arr['top_nm']=$top_nm;
		
		if(isset($result[0])){
			$name=$result[0]['name'];
			$tree_arr['level_one_img1']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$result[0]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm1']=$name;
			$room[0]=$this->vma_class->get_child($result[0]['usercode']);
		}
		else{
			$tree_arr['level_one_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[1])){
			$name=$result[1]['name'];
			$tree_arr['level_one_img2']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$result[1]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm2']=$name;
			$room[1]=$this->vma_class->get_child($result[1]['usercode']);
		}
		else{
			$tree_arr['level_one_img2']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[2])){
			$name=$result[2]['name'];
			$tree_arr['level_one_img3']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$result[2]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm3']=$name;
			$room[2]=$this->vma_class->get_child($result[2]['usercode']);
		}
		else{
			$tree_arr['level_one_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		////////////level 2 block one/////////////
		if(isset($room[0][0])){
			$name=$room[0][0]['name'];
			$tree_arr['level_two_img1']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[0][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm1']=$name;
			$lev3[0]['code']=$room[0][0]['usercode'];
		}
		else{
			
			$tree_arr['level_two_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[0]['code']='1001010101no';
		}
		
		if(isset($room[0][1])){
			$name=$room[0][1]['name'];
			$tree_arr['level_two_img2']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[0][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm2']=$name;
			$lev3[1]['code']=$room[0][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img2']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[1]['code']='1001010101no';
		}
		
		if(isset($room[0][2])){
			$name=$room[0][2]['name'];
			$tree_arr['level_two_img3']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[0][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm3']=$name;
			$lev3[2]['code']=$room[0][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[2]['code']='1001010101no';
		}
		
		////////////level 2 block two/////////////
		if(isset($room[1][0])){
			$name=$room[1][0]['name'];
			$tree_arr['level_two_img4']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[1][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm4']=$name;
			$lev3[3]['code']=$room[1][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img4']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[3]['code']='1001010101no';
		}
		
		if(isset($room[1][1])){
			$name=$room[1][1]['name'];
			$tree_arr['level_two_img5']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[1][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm5']=$name;
			$lev3[4]['code']=$room[1][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img5']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[4]['code']='1001010101no';
		}
		
		if(isset($room[1][2])){
			$name=$room[1][2]['name'];
			$tree_arr['level_two_img6']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[1][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm6']=$name;
			$lev3[5]['code']=$room[1][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img6']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[5]['code']='1001010101no';
		}
		
		////////////level 2 block three/////////////
		if(isset($room[2][0])){
			$name=$room[2][0]['name'];
			$tree_arr['level_two_img7']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[2][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm7']=$name;
			$lev3[6]['code']=$room[2][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img7']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[6]['code']='1001010101no';
		}
		
		if(isset($room[2][1])){
			$name=$room[2][1]['name'];
			$tree_arr['level_two_img8']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[2][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm8']=$name;
			$lev3[7]['code']=$room[2][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img8']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[7]['code']='1001010101no';
		}
		
		if(isset($room[2][2])){
			$name=$room[2][2]['name'];
			$tree_arr['level_two_img9']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[2][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm9']=$name;
			$lev3[8]['code']=$room[2][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img9']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[8]['code']='1001010101no';
		}
		
		$p=1;
		
		for($i=0;$i<count($lev3);$i++){
			$rg=$this->vma_class->get_child($lev3[$i]['code']);
			
			if(isset($rg[0])){
				$tree_arr['lev3nm'.$p]=$rg[0]['name'];
				$tree_arr['lev3img'.$p]="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$rg[0]['usercode']."'><img src='".base_url()."asset/images/multitree/green.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[1])){
				$tree_arr['lev3nm'.$p]=$rg[1]['name'];
				$tree_arr['lev3img'.$p]="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$rg[1]['usercode']."'><img src='".base_url()."asset/images/multitree/green.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[2])){
				$tree_arr['lev3nm'.$p]=$rg[2]['name'];
				$tree_arr['lev3img'.$p]="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$rg[2]['usercode']."'><img src='".base_url()."asset/images/multitree/green.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
		}
		
		return $tree_arr;
	}
	
	
	
	function get_dropdown_createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1){
		foreach ($array as $categoryId => $category) 
		{
			if ($currLevel > $prevLevel)  $this->tree_html.= " <ol class='tree'> "; 
			if ($currLevel == $prevLevel)  $this->tree_html.= " </li> ";
			$this->tree_html.='<li class="'.$currLevel.'-'.$prevLevel.'"><label for="subfolder2" class="llb'.$currLevel.'">'.$category['name'].'&nbsp;<a href="#" value="'.$category['id'].'" class="clsmemdt">
					<i class="icon-circle-arrow-right"></i></a></label><input type="checkbox" id="subfolder2"/>';
			if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
			$currLevel++;
			if($currLevel<4){
				$child=$this->get_dropdown_parent($category['id']);
				$this->get_dropdown_createTree($child, $categoryId, $currLevel, $prevLevel);
			} 
			
			$currLevel--;               
		}
		if ($currLevel == $prevLevel) $this->tree_html.=" </li>  </ol> ";
	}
	
	function get_dropdown_parent($usercode){
		$parent=$this->vma_class->get_child($usercode);
		$arrayCategories = array();
		for($i=0;$i<count($parent);$i++){
			$arrayCategories[$parent[$i]['usercode']] = array("name" =>$parent[$i]['name'], "id" =>$parent[$i]['usercode']);   
		}
		return $arrayCategories;
	}
	
	function drow_dropdowntree(){
		$arr=$this->get_dropdown_parent($this->session->userdata['logged_ol_member']['usercode']);
		$this->tree_html.='<div id="contenttree" class="general-style1">';
		$this->get_dropdown_createTree($arr, 0);
		$this->tree_html.='</div>';
		return $this->tree_html;
	}
	
	
	
	
	
	
	
	
	
	
}

