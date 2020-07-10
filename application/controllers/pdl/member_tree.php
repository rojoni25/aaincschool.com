<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_tree extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		$this->load->model('pdl/admin/member_tree_model','ObjM',TRUE);
		
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
 	}
	
	public function view($eid)
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['tree']=$this->get_tree($eid);
		$data['breadcrumb']=$this->drow_breadcrumb_level($eid);

		$this->load->view('pdl_admin/tree_view',$data);
		$this->load->view('comman/footer');
	}
	
	public function tree()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['tree']=$this->get_tree($this->uri->rsegment(3));
		$data['breadcrumb']=$this->drow_breadcrumb_level($this->uri->rsegment(3));
		$this->load->view('pdl_admin/tree_view',$data);
		$this->load->view('comman/footer');
	}
	
	function get_tree($code=''){
		$result=$this->ObjM->get_node_three_by_three_by_id($code);
		
		$topnode=$this->ObjM->userdt_by_code($code);
		
		$tree_arr=array();

		$top_nm=$topnode[0]['fname'].' '.$topnode[0]['lname'];
		$tree_arr['top_img']="<a class='show-pop-event' href='".$topnode[0]['usercode']."'><img src='".base_url()."/asset/images/multitree/admin.png' title='".$name."' /></a>";
		$tree_arr['top_nm']=$top_nm;
		
		if(isset($result[0])){
			$name=$result[0]['fname'].' '.$result[0]['lname'];
			$tree_arr['level_one_img1']="<a class='show-pop-event' href='".$result[0]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm1']=$name;
			$room[0]=$this->ObjM->get_node_three_by_three_by_id($result[0]['usercode']);
		}
		else{
			$tree_arr['level_one_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[1])){
			$name=$result[1]['fname'].' '.$result[1]['lname'];
			$tree_arr['level_one_img2']="<a class='show-pop-event' href='".$result[1]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm2']=$name;
			$room[1]=$this->ObjM->get_node_three_by_three_by_id($result[1]['usercode']);
		}
		else{
			$tree_arr['level_one_img2']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		
		if(isset($result[2])){
			$name=$result[2]['fname'].' '.$result[2]['lname'];
			$tree_arr['level_one_img3']="<a class='show-pop-event' href='".$result[2]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_one_nm3']=$name;
			$room[2]=$this->ObjM->get_node_three_by_three_by_id($result[2]['usercode']);
		}
		else{
			$tree_arr['level_one_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='empty' />";
		}
		////////////level 2 block one/////////////
		if(isset($room[0][0])){
			$name=$room[0][0]['fname'].' '.$room[0][0]['lname'];
			$tree_arr['level_two_img1']="<a class='show-pop-event' href='".$room[0][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm1']=$name;
			$lev3[0]['code']=$room[0][0]['usercode'];
		}
		else{
			
			$tree_arr['level_two_img1']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[0]['code']='1001010101no';
		}
		
		if(isset($room[0][1])){
			$name=$room[0][1]['fname'].' '.$room[0][1]['lname'];
			$tree_arr['level_two_img2']="<a class='show-pop-event' href='".$room[0][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm2']=$name;
			$lev3[1]['code']=$room[0][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img2']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[1]['code']='1001010101no';
		}
		
		if(isset($room[0][2])){
			$name=$room[0][2]['fname'].' '.$room[0][2]['lname'];
			$tree_arr['level_two_img3']="<a class='show-pop-event' href='".$room[0][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm3']=$name;
			$lev3[2]['code']=$room[0][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img3']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[2]['code']='1001010101no';
		}
		
		////////////level 2 block two/////////////
		if(isset($room[1][0])){
			$name=$room[1][0]['fname'].' '.$room[1][0]['lname'];
			$tree_arr['level_two_img4']="<a class='show-pop-event' href='".$room[1][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm4']=$name;
			$lev3[3]['code']=$room[1][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img4']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[3]['code']='1001010101no';
		}
		
		if(isset($room[1][1])){
			$name=$room[1][1]['fname'].' '.$room[1][1]['lname'];
			$tree_arr['level_two_img5']="<a class='show-pop-event' href='".$room[1][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm5']=$name;
			$lev3[4]['code']=$room[1][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img5']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[4]['code']='1001010101no';
		}
		
		if(isset($room[1][2])){
			$name=$room[1][2]['fname'].' '.$room[1][2]['lname'];
			$tree_arr['level_two_img6']="<a class='show-pop-event' href='".$room[1][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm6']=$name;
			$lev3[5]['code']=$room[1][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img6']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[5]['code']='1001010101no';
		}
		
		////////////level 2 block three/////////////
		if(isset($room[2][0])){
			$name=$room[2][0]['fname'].' '.$room[2][0]['lname'];
			$tree_arr['level_two_img7']="<a class='show-pop-event' href='".$room[2][0]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm7']=$name;
			$lev3[6]['code']=$room[2][0]['usercode'];
		}
		else{
			$tree_arr['level_two_img7']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[6]['code']='1001010101no';
		}
		
		if(isset($room[2][1])){
			$name=$room[2][1]['fname'].' '.$room[2][1]['lname'];
			$tree_arr['level_two_img8']="<a class='show-pop-event' href='".$room[2][1]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm8']=$name;
			$lev3[7]['code']=$room[2][1]['usercode'];
		}
		else{
			$tree_arr['level_two_img8']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[7]['code']='1001010101no';
		}
		
		if(isset($room[2][2])){
			$name=$room[2][2]['fname'].' '.$room[2][2]['lname'];
			$tree_arr['level_two_img9']="<a class='show-pop-event' href='".$room[2][2]['usercode']."'><img src='".base_url()."/asset/images/multitree/member.png' title='".$name."' /></a>";
			$tree_arr['level_two_nm9']=$name;
			$lev3[8]['code']=$room[2][2]['usercode'];
		}
		else{
			$tree_arr['level_two_img9']="<img src='".base_url()."/asset/images/multitree/empty.png' title='' />";
			$lev3[8]['code']='1001010101no';
		}
		
		$p=1;
		
		for($i=0;$i<count($lev3);$i++){
			$rg=$this->ObjM->get_node_three_by_three_by_id($lev3[$i]['code']);
			
			if(isset($rg[0])){
				$tree_arr['lev3nm'.$p]=$rg[0]['fname'].' '.$rg[0]['lname'];
				$tree_arr['lev3img'.$p]="<a class='show-pop-event' href='".$rg[0]['usercode']."'><img src='".base_url()."asset/images/multitree/member.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[1])){
				$tree_arr['lev3nm'.$p]=$rg[1]['fname'].' '.$rg[1]['lname'];
				$tree_arr['lev3img'.$p]="<a class='show-pop-event' href='".$rg[1]['usercode']."'><img src='".base_url()."asset/images/multitree/member.png' title='' /></a>";		
			}
			else{
				$tree_arr['lev3nm'.$p]="";
				$tree_arr['lev3img'.$p]="<img src='".base_url()."asset/images/multitree/empty.png' title='' />";		
			}
			$p++;
			if(isset($rg[2])){
				$tree_arr['lev3nm'.$p]=$rg[2]['fname'].' '.$rg[2]['lname'];
				$tree_arr['lev3img'.$p]="<a class='show-pop-event' href='".$rg[2]['usercode']."'><img src='".base_url()."asset/images/multitree/member.png' title='' /></a>";		
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
			$result=$this->ObjM->get_breadcrumb_level($code);
			
		
			if(!isset($result[0])){
				break;	
			}
			$user['bread'][]=$result;
			$code=$result[0]['upling'];
		}
		
		$newArray = array_reverse($user['bread'], false);
		
		return $newArray;
	}
	
	function get_member_detail($eid)
	{
		$result=$this->ObjM->member_paid_product_dt($eid);
		echo $html='<table class="table">
		<tr><td width="30%">Usercode</td><td width="70%"><a href="'.base_url('index.php/pdl/').''.$this->uri->rsegment(1).'/tree/'.$result[0]['usercode'].'">'.$result[0]['usercode'].'</a></td></tr>
		<tr><td >Name</td><td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[0]['username'].'">'.$result[0]['fname'].' '.$result[0]['lname'].'</a></td></tr>
		<tr><td>Mobile No</td><td>'.$result[0]['mobileno'].'</td></tr>
		<tr><td>Phone Number</td><td>'.$result[0]['phone_no'].'</td></tr>';
	}
	
	function member_view(){
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/member_view',$data);
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
			
			$join_dt=date('d-m-y',$result[$i]['join_date']);
			$due_dt=date('d-m-y',$result[$i]['due_time']);
			
			$payment	=	$this->get_payment_detail($result[$i]['usercode']);
			
			$edit='<a href="'.base_url('index.php/pdl/').''.$this->uri->rsegment(1).'/view/'.$result[$i]['usercode'].'"><span class="label label-important">Tree</samp></a>&nbsp;&nbsp;';
			
			$edit.='<a href="'.base_url('index.php/pdl/').'member_detail/view/'.$result[$i]['usercode'].'"><span class="label label-success">Detail</samp></a>';
			
			$balance_1='$'.number_format($payment['balance_1'],2);
			$balance_2='$'.number_format($payment['balance_2'],2);
			$balance_3='$'.number_format($payment['balance_3'],2);
				
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['subscription_id'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$join_dt,
					$due_dt,
					$result[$i]['tot_pay'],
					$balance_1,
					$balance_2,
					$balance_3,
					$edit
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	
	protected function get_payment_detail($id){
		$payment_1		=	$this->ObjM->get_payment_sum_by_type($id,'pdl_1');	
		$withdrawal_1	=	$this->ObjM->get_withdrawal_sum_by_type($id,'pdl_1');
		$balance_1		=	$payment_1 - $withdrawal_1;		
		
		
		$payment_2		=	$this->ObjM->get_payment_sum_by_type($id,'pdl_2');	
		$withdrawal_2	=	$this->ObjM->get_withdrawal_sum_by_type($id,'pdl_2');
		$balance_2		=	$payment_2 - $withdrawal_2;	
		
		$payment_3		=	$this->ObjM->get_payment_sum_by_type($id,'opp_wallet');	
		$withdrawal_3	=	$this->ObjM->get_withdrawal_sum_by_type($id,'opp_wallet');
		$balance_3		=	$payment_3 - $withdrawal_3;		
		
		$arr=array(
			'payment_1'		=>	$payment_1,
			'withdrawal_1'	=>	$withdrawal_1,
			'balance_1'		=>	$balance_1,
			
			'payment_2'		=>	$payment_2,
			'withdrawal_2'	=>	$withdrawal_2,
			'balance_2'		=>	$balance_2,
			
			'payment_3'		=>	$payment_3,
			'withdrawal_3'	=>	$withdrawal_3,
			'balance_3'		=>	$balance_3
		);
		
		return $arr;
	}
	
	function subscription_under_review(){
		
		$data['result']=$this->ObjM->subscription_under_review();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/subscription_review',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

