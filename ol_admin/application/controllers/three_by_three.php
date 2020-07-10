<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class three_by_three extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('tree_view_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function view($eid)
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['tree']=$this->get_tree($eid);
		$data['breadcrumb']=$this->drow_breadcrumb_level($eid);

		$this->load->view('three_by_three_view',$data);
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
		$result=$this->tree_view_model->get_node_three_by_three_by_id($code);
		$topnode=$this->tree_view_model->userdt_by_code($code);
		
		$tree_arr=array();
        
		$top_nm=$topnode[0]['fname'].' '.$topnode[0]['lname'];
		  $loginusercode = $code;
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $topnode[0]['img']="red";// For Qualified Status -

	        	}else{
	        	     $topnode[0]['img']="admin";
	        	}
		$tree_arr['top_img']="<img src='".base_url()."/asset/images/multitree/".$topnode[0]['img'].".png' title='".$name."' />";
		$tree_arr['top_nm']=$top_nm;
		
		if(isset($result[0])){
		    $loginusercode = $result[0]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $result[0]['img']="red";// For Qualified Status -

	        	}
			$name=$result[0]['fname'].' '.$result[0]['lname'];
			$tree_arr['level_one_img1']="<a class='show-pop-event' href='".$result[0]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$result[0]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_one_nm1']=$name;
			$room[0]=$this->tree_view_model->get_node_three_by_three_by_id($result[0]['usercode']);
		}
		else{
			$tree_arr['level_one_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[1])){
		    $loginusercode = $result[1]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $result[1]['img']="red";// For Qualified Status -

	        	}
			$name=$result[1]['fname'].' '.$result[1]['lname'];
			$tree_arr['level_one_img2']="<a class='show-pop-event' href='".$result[1]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$result[1]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_one_nm2']=$name;
			$room[1]=$this->tree_view_model->get_node_three_by_three_by_id($result[1]['usercode']);
		}
		else{
			$tree_arr['level_one_img2']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[2])){
		    $loginusercode = $result[2]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $result[2]['img']="red";// For Qualified Status -

	        	}
			$name=$result[2]['fname'].' '.$result[2]['lname'];
			$tree_arr['level_one_img3']="<a class='show-pop-event' href='".$result[2]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$result[2]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_one_nm3']=$name;
			$room[2]=$this->tree_view_model->get_node_three_by_three_by_id($result[2]['usercode']);
		}
		else{
			$tree_arr['level_one_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		////////////level 2 block one/////////////
		if(isset($room[0][0])){
		    $loginusercode = $room[0][0]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[0][0]['img']="red";// For Qualified Status -

	        	}
			$name=$room[0][0]['fname'].' '.$room[0][0]['lname'];
			$tree_arr['level_two_img1']="<a class='show-pop-event' href='".$room[0][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[0][0]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm1']=$name;
			$lev3[0]['code']=$room[0][0]['usercode'];
		}
		else{
			
			$tree_arr['level_two_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[0]['code']='1001010101no';
		}
		
		if(isset($room[0][1])){
		    $loginusercode = $room[0][1]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[0][1]['img']="red";// For Qualified Status -

	        	}
			$name=$room[0][1]['fname'].' '.$room[0][1]['lname'];
			$tree_arr['level_two_img2']="<a class='show-pop-event' href='".$room[0][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[0][1]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm2']=$name;
			$lev3[1]['code']=$room[0][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img2']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[1]['code']='1001010101no';
		}
		
		if(isset($room[0][2])){
		    $loginusercode = $room[0][2]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[0][2]['img']="red";// For Qualified Status -

	        	}
			$name=$room[0][2]['fname'].' '.$room[0][2]['lname'];
			$tree_arr['level_two_img3']="<a class='show-pop-event' href='".$room[0][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[0][2]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm3']=$name;
			$lev3[2]['code']=$room[0][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[2]['code']='1001010101no';
		}
		
		////////////level 2 block two/////////////
		if(isset($room[1][0])){
		    	$loginusercode = $room[1][0]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[1][0]['img']="red";// For Qualified Status -

	        	}
			$name=$room[1][0]['fname'].' '.$room[1][0]['lname'];
			$tree_arr['level_two_img4']="<a class='show-pop-event' href='".$room[1][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[1][0]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm4']=$name;
			$lev3[3]['code']=$room[1][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img4']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[3]['code']='1001010101no';
		}
		
		if(isset($room[1][1])){
		    	$loginusercode = $room[1][1]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[1][1]['img']="red";// For Qualified Status -

	        	}
			$name=$room[1][1]['fname'].' '.$room[1][1]['lname'];
			$tree_arr['level_two_img5']="<a class='show-pop-event' href='".$room[1][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[1][1]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm5']=$name;
			$lev3[4]['code']=$room[1][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img5']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[4]['code']='1001010101no';
		}
		
		if(isset($room[1][2])){
		    	$loginusercode = $room[1][2]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[1][2]['img']="red";// For Qualified Status -

	        	}
			$name=$room[1][2]['fname'].' '.$room[1][2]['lname'];
			$tree_arr['level_two_img6']="<a class='show-pop-event' href='".$room[1][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[1][2]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm6']=$name;
			$lev3[5]['code']=$room[1][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img6']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[5]['code']='1001010101no';
		}
		
		////////////level 2 block three/////////////
		if(isset($room[2][0])){
		    	$loginusercode = $room[2][0]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[2][0]['img']="red";// For Qualified Status -

	        	}
			$name=$room[2][0]['fname'].' '.$room[2][0]['lname'];
			$tree_arr['level_two_img7']="<a class='show-pop-event' href='".$room[2][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[2][0]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm7']=$name;
			$lev3[6]['code']=$room[2][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img7']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[6]['code']='1001010101no';
		}
		
		if(isset($room[2][1])){
		    	$loginusercode = $room[2][1]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[2][1]['img']="red";// For Qualified Status -

	        	}
			$name=$room[2][1]['fname'].' '.$room[2][1]['lname'];
			$tree_arr['level_two_img8']="<a class='show-pop-event' href='".$room[2][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[2][1]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm8']=$name;
			$lev3[7]['code']=$room[2][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img8']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[7]['code']='1001010101no';
		}
		
		if(isset($room[2][2])){
		      		$loginusercode = $room[2][2]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $room[2][2]['img']="red";// For Qualified Status -

	        	}
			$name=$room[2][2]['fname'].' '.$room[2][2]['lname'];
			$tree_arr['level_two_img9']="<a class='show-pop-event' href='".$room[2][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/".$room[2][2]['img'].".png' title='".$name."' /></a>";
			$tree_arr['level_two_nm9']=$name;
			$lev3[8]['code']=$room[2][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img9']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[8]['code']='1001010101no';
		}
		
		$p=1;
		
		for($i=0;$i<count($lev3);$i++){
			$rg=$this->tree_view_model->get_node_three_by_three_by_id($lev3[$i]['code']);
			
			if(isset($rg[0])){
			      		$loginusercode = $rg[0]['usercode'];
            	$referralcount = countreferral($loginusercode);
            	 $QStatusImg="red";// For Qualified Status -
	        	if($referralcount>=3){
	        	   $QStatusImg=$rg[0]['img'];
	        	}
				$tree_arr['lev3nm'.$p]=$rg[0]['fname'].' '.$rg[0]['lname'];
				$tree_arr['lev3img'.$p]="<a class='show-pop-event' href='".$rg[0]['usercode']."'><img src='".base_url()."asset/images/multitree/".$QStatusImg.".png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[1])){
			    	$loginusercode = $rg[1]['usercode'];
            	$referralcount = countreferral($loginusercode);
            	 $QStatusImg="red";// For Qualified Status -
	        	if($referralcount>=3){
	        	   $QStatusImg=$rg[1]['img'];
	        	}
				$tree_arr['lev3nm'.$p]=$rg[1]['fname'].' '.$rg[1]['lname'];
			

				$tree_arr['lev3img'.$p]="<a class='show-pop-event' href='".$rg[1]['usercode']."'><img src='".base_url()."asset/images/multitree/".$QStatusImg.".png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[2])){
			    		$loginusercode = $rg[2]['usercode'];
            	$referralcount = countreferral($loginusercode);
            	 $QStatusImg="red";// For Qualified Status -
	        	if($referralcount>=3){
	        	   $QStatusImg=$rg[2]['img'];
	        	}
				$tree_arr['lev3nm'.$p]=$rg[2]['fname'].' '.$rg[2]['lname'];
				$tree_arr['lev3img'.$p]="<a class='show-pop-event' href='".$rg[2]['usercode']."'><img src='".base_url()."asset/images/multitree/".$QStatusImg.".png' title='' /></a>";		
			}
			else{
			   
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
		}
		
		return $tree_arr;
	}
	
	
	
	
	
	
	function drow_breadcrumb_level($code){
		$user['bread']=array();
		
		while(1){
			$result=$this->tree_view_model->get_breadcrumb_level($code);
			
			$user['bread'][]=$result;
			if($result[0]['uplingmember3_3']==$code){
				$result=$this->tree_view_model->get_breadcrumb_level($result[0]['uplingmember3_3']);
				$user['bread'][]=$result;
				break;	
			}
			if(!isset($result[0])){
				break;	
			}
			$code=$result[0]['uplingmember3_3'];
		}
		$newArray = array_reverse($user['bread'], false);
		
		return $newArray;
	}

	function get_dropdown_parent($usercode){
		$parent=$this->tree_view_model->get_node_three_by_three_by_id($usercode);
		$arrayCategories = array();
		for($i=0;$i<count($parent);$i++){
			$name=$parent[$i]['fname'].''.$parent[$i]['lname'];
			$arrayCategories[$parent[$i]['usercode']] = array("name" =>$name, "id" =>$parent[$i]['usercode']);   
		}
		return $arrayCategories;
	}
	
	
	function drow_dropdowntree($eid){
		$arr=$this->get_dropdown_parent($eid);
		echo '<div id="contenttree" class="general-style1">';
		$this->get_dropdown_createTree($arr, 0);
		echo '</div>';
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
	
	
	
}

