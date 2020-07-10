<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tree extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('vma/request_model','ObjM',TRUE);
		$this->load->library('vma_class');
		
		
 	}
	
	public function view($eid)
	{
		if(!$this->comman_fun->check_record('vma_member',array('usercode'=>$eid))){
			$eid='1';
		}
		$data['tree']			=	$this->get_tree($eid);
		$data['top_usercode']	=	$eid;
		$data['breadcrumb']=$this->vma_class->upling_chain($eid);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'tree_view',$data);
		$this->load->view('comman/footer');
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
			$tree_arr['level_one_img1']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$result[0]['usercode']."'><img src='".base_url()."/asset/images/multitree/green.png' title='".$name."' /></a>";
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
			$tree_arr['level_one_img3']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$result[2]['usercode']."'><img src='".base_url()."/asset/images/multitree/blue.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm3']=$name;
			$room[2]=$this->vma_class->get_child($result[2]['usercode']);
		}
		else{
			$tree_arr['level_one_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		////////////level 2 block one/////////////
		if(isset($room[0][0])){
			$name=$room[0][0]['name'];
			$tree_arr['level_two_img1']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[0][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/green.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm1']=$name;
			$lev3[0]['code']=$room[0][0]['usercode'];
		}
		else{
			
			$tree_arr['level_two_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[0]['code']='1001010101no';
		}
		
		if(isset($room[0][1])){
			$name=$room[0][1]['name'];
			$tree_arr['level_two_img2']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[0][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
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
			$tree_arr['level_two_img4']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[1][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/green.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm4']=$name;
			$lev3[3]['code']=$room[1][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img4']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[3]['code']='1001010101no';
		}
		
		if(isset($room[1][1])){
			$name=$room[1][1]['name'];
			$tree_arr['level_two_img5']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[1][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
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
			$tree_arr['level_two_img7']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[2][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/green.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm7']=$name;
			$lev3[6]['code']=$room[2][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img7']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[6]['code']='1001010101no';
		}
		
		if(isset($room[2][1])){
			$name=$room[2][1]['name'];
			$tree_arr['level_two_img8']="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$room[2][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/red.png' title='".$name."' /></a>";
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
				$tree_arr['lev3img'.$p]="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$rg[1]['usercode']."'><img src='".base_url()."asset/images/multitree/red.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[2])){
				$tree_arr['lev3nm'.$p]=$rg[2]['name'];
				$tree_arr['lev3img'.$p]="<a  href='".vma_base().$this->uri->rsegment(1)."/view/".$rg[2]['usercode']."'><img src='".base_url()."asset/images/multitree/blue.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
		}
		
		return $tree_arr;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}

