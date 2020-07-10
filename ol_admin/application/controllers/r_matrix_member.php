<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_member extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_member_model','ObjM',TRUE);
 	}
	
	public function view($eid)
	{
		
				
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_member_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing_active(){
		
		$result=$this->ObjM->getAll_active();
		$data['txt_query']=$this->db->last_query();
		$this->ObjM->addItem($data,'test_query');

		$count=$this->ObjM->get_tot_count_active();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			
			$tot=$this->ObjM->count_tot_position($result[$i]['usercode']);
			$pos=($tot) ? '<a href="'.$result[$i]['usercode'].'" class="show-pop-event">Position ('.$tot.')</a>' : "Single";
			
			$payment=$this->get_payment($result[$i]['usercode']);
			
			$btn='<a href="'.base_url().'index.php/r_matrix_member/details/'.$result[$i]['usercode'].'"><span class="label label-important">View</span></a>';
			
			$row = array(
					$result[$i]['idcode'],
					$result[$i]['usercode'],
					$result[$i]['name'],
					$payment['rm_balance'],
					$payment['coin_balance'],
					$pos,
					$result[$i]['emailid'],
					$result[$i]['name2'],
					date('d-M-Y', $result[$i]['add_time']),
					$btn,
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function get_multi_position($eid)
	{
			$result=$this->ObjM->get_multi_position($eid);
			$html='<table class="table">';
			$html.='<thead>
							<tr>
								<th>Position</th>
								<th>Upling Name</th>
								<th>Upling Username</th>
								<th>Jump Tree</th>
							</tr>
						</thead><tbody>';
			for($i=0;$i<count($result);$i++){
				$pos=$i+1;
				$html.='<tr>
							<td>Position: '.$pos.' </td>
							<td>'.$result[$i]['name2'].'</td>
							<td>'.$result[$i]['username2'].'</td>
							<td><a href="'.base_url().'index.php/r_matrix_tree/view/'.$result[$i]['idcode'].'"><span class="label label-important">Tree</span></a></td>
						</tr>';	
			}
			$html.='<tbody></table>';
			echo $html;
	}
	
	function details($eid){
		$data['member']=$this->ObjM->member_detail($eid);
		$multi_position=$this->ObjM->get_multi_position_detail($eid);	
		$data['payment']	=	$this->get_payment($eid);
		
		$data['withdrawal_rm']		=	$this->ObjM->get_withdrawal_by_type($eid,'RM');
		$data['withdrawal_coin']	=	$this->ObjM->get_withdrawal_by_type($eid,'COIN');
	
		$data['level_complate']=0;
		for($i=0;$i<count($multi_position);$i++)
		{
			
			$pos=$this->ObjM->get_position_dt($multi_position[$i]['idcode']);
			
			if($pos['status']=='Y'){ 	$data['level_complate']++;	}
			
			$multi_position[$i]['level_1']	=	$pos['level_1'];
			$multi_position[$i]['level_2']	=	$pos['level_2'];
			$multi_position[$i]['level_3']	=	$pos['level_3'];
			$multi_position[$i]['total']	=	$pos['total'];
		}
	

	
		$data['multi_position']=$multi_position;
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_member_details',$data);
		$this->load->view('comman/footer');
	}
	
	 protected function get_payment($usercode){
		$rm_pay		=	$this->ObjM->get_payment_sum_by_type($usercode,'RM');
		$coin_pay	=	$this->ObjM->get_payment_sum_by_type($usercode,'COIN');
		
		$rm_withdrawal		=	$this->ObjM->get_withdrawal_sum_by_type($usercode,'RM');
		$coin_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type($usercode,'COIN');
		
		$arr=array(
			'rm_pay'			=>	$rm_pay,
			'coin_pay'			=>	$coin_pay,
			'rm_withdrawal'		=>	$rm_withdrawal,
			'coin_withdrawal'	=>	$coin_withdrawal,
			'rm_balance'		=>	$rm_pay		-	$rm_withdrawal,
			'coin_balance'		=>	$coin_pay	-	$coin_withdrawal,
		);
	
		return $arr;	
	
	}
	
	
	
	
}

