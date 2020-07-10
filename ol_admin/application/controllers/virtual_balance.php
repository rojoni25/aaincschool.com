<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class virtual_balance extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('virtual_balance_model','ObjM',TRUE);
		ob_start();
 	}
	
	public function view()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	
	
	function listing($eid)
	{
		if($eid=='5by3'){ $balance='1.50'; $type='5by3'; }
		else if($eid=='10by3'){ $balance='3'; $type='10by3'; }
		else{ $balance='1';  $type='3by3';}
		
		$result=$this->ObjM->getAll($eid,$balance);
		$count=$this->ObjM->get_tot_count_active($eid,$balance);
		
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		for($i=0;$i<count($result);$i++){
			
			$detail='<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/details/'.$result[$i]['usercode'].'/'.$type.'">Details</a>';
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['username'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['balance'],
					$detail
			);
			$output['aaData'][] = $row;
		}
		//var_dump($output);
		echo json_encode( $output );
	}
	
	
	public function details($eid,$type)
	{
		$data['member_dt']=$this->ObjM->get_member_detail($eid);
		$data['inning']=$this->ObjM->get_inning_payment($eid,$type);
		$data['daily_payment']=$this->ObjM->get_daily_payment($eid,$type);	
		$data['inning_sum']			=	$this->ObjM->get_inning_payment_sum($eid,$type);
		$data['daily_payment_sum']	=	$this->ObjM->get_daily_payment_sum($eid,$type);	
		$data['balance']			=	$data['inning_sum'] - $data['daily_payment_sum'];	
		
		$data['upling']=$this->get_upling_level($eid,$type);
		
		
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('virtual_balance_detail',$data);
		$this->load->view('comman/footer');
	}
	
	protected function get_upling_level($eid,$type){
		if($type=='3by3'){
			$upling_type='uplingmember3_3';
		}
		else if($type=='5by3'){
			$upling_type='uplingmember5_3';
		}
		else if($type=='10by3'){
			$upling_type='uplingmember10_3';
		}
		$level_1	=	$this->ObjM->tree_upling($eid,$upling_type);
		$level_2	=	$this->ObjM->tree_upling($level_1[0]['upling'],$upling_type);
		$level_3	=	$this->ObjM->tree_upling($level_2[0]['upling'],$upling_type);
		
		if($level_1!=false){
			$level_1=$this->ObjM->get_member_detail($level_1[0]['upling']);
			$level_1 = $level_1[0]['fname'].' '.$level_1[0]['lname']. ' ('.$level_1[0]['usercode'].')';
		}else{
			$level_1 = 'No Upper Level Payment To Admin';
		}
		
		if($level_2!=false){
			$level_2=$this->ObjM->get_member_detail($level_2[0]['upling']);
			$level_2 = $level_2[0]['fname'].' '.$level_2[0]['lname']. ' ('.$level_2[0]['usercode'].')';
		}
		else{
			$level_2 = 'No Upper Level Payment To Admin';
		}
		
		if($level_3!=false){
			$level_3=$this->ObjM->get_member_detail($level_3[0]['upling']);
			$level_3 = $level_3[0]['fname'].' '.$level_3[0]['lname']. ' ('.$level_3[0]['usercode'].')';
		}
		else{
			$level_3 = 'No Upper Level Payment To Admin';
		}
	
		$arr=array(
				'level1'=>$level_1,
				'level2'=>$level_2,
				'level3'=>$level_3
			);
			return $arr;
		
	}
	
	function export_excel()
	{
		$result=$this->ObjM->getAll();
		

		$output .= '"Usercode",';
		$output .= '"Name",';
		$output .= '"Email",';
		$output .= '"3x3 Monthly",';
		$output .= '"Virtaul Balance 3x3",';
		$output .= '"Virtaul Balance 5x3",';
		$output .= '"Virtaul Balance 10x3",';
		$output .= '"Coded",';
		$output .= '"Coded Match",';
		$output .= '"Residual",';
		$output .= '"Residual Match",';
		$output .="\n";
		for($i=0;$i<count($result);$i++)
		{
			
			$monthly=$this->ObjM->get_monthly_payment($result[$i]['usercode'],'monthly');
			$coded=$this->ObjM->get_monthly_payment($result[$i]['usercode'],'coded');
			$coded_match=$this->ObjM->get_monthly_payment($result[$i]['usercode'],'coded_match');
			$residual=$this->ObjM->get_monthly_payment($result[$i]['usercode'],'residual');
			$residual_match=$this->ObjM->get_monthly_payment($result[$i]['usercode'],'residual_match');
			$threebythree=$this->ObjM->get_virtual_balance($result[$i]['usercode'],'3by3');
			$fivebythree=$this->ObjM->get_virtual_balance($result[$i]['usercode'],'5by3');
			$tenbythree=$this->ObjM->get_virtual_balance($result[$i]['usercode'],'10by3');
	
			$name=$result[$i]['fname'].' '.$result[$i]['lname'];
			
			$output .='"'.$result[$i]["usercode"].'",';
			$output .='"'.$name.'",';
			$output .='"'.$result[$i]["emailid"].'",';
			$output .='"'.$monthly[$i]['total'].'",';
			$output .='"'.$threebythree[0]['total'].'",';
			$output .='"'.$fivebythree[0]['total'].'",';
			$output .='"'.$tenbythree[0]['total'].'",';
			$output .='"'.$coded[0]['total'].'",';
			$output .='"'.$coded_match[0]['total'].'",';
			$output .='"'.$residual[0]['total'].'",';
			$output .='"'.$residual_match[0]['total'].'",';
			$output .="\n";
		}
		$dt=date("d-m-Y");
		$filename = "member_payment_".$dt.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		ob_get_contents();
		echo $output;
	}
	
	
	
	
	
}

