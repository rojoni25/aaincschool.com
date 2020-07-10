<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_member extends CI_Controller {
	
	protected $opp_admin='';
	
	function __construct()
 	{
   		parent::__construct(); 
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		//if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_member_model','ObjM',TRUE);
		$this->file_setting();
		$this->opp_admin	=	$this->ObjM->get_opp_admin();
		
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
		
				
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_member_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing_active(){
		
		//$data['txt_query']='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		//$this->ObjM->addItem($data,'test_query');
		
		$result=$this->ObjM->getAll_active();
		

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
			
			$btn='<a href=""><span class="label label-important">View</span></a>';
			
			$balance		=	'$'.number_format($payment['balance'],2);
			$coin_balance	=	'$'.number_format($payment['coin_balance'],2);
			$live_balance	=	'$'.number_format($payment['live_balance'],2);
			
			if($this->opp_admin){
				$tranfer_btn='<li><a href="'.MATRIX_BASE.$this->uri->rsegment(1).'/balance_tranfer/'.$result[$i]['usercode'].'"><strong>Transfer To Live</strong></a></li>';
			}else{
				$tranfer_btn='';
			}
			
			$btn='<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-success dropdown-toggle"><strong>Action</strong><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="'.MATRIX_BASE.'r_matrix_member/details/'.$result[$i]['usercode'].'"><strong>View</strong></a></li>
								<li><a href="#"><strong>Note</strong></a></li>
								'.$tranfer_btn.'
							</ul>
						</div>';
			
			$row = array(
					$result[$i]['idcode'],
					$result[$i]['usercode'],
					$result[$i]['name'],
					$live_balance,
					$balance,
					$coin_balance,
					$pos,
					$result[$i]['emailid'],
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
			$html='<div class="inner_div_popup"><table class="table">';
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
							<td><a href="'.MATRIX_BASE.'r_matrix_tree/view/'.$result[$i]['idcode'].'"><span class="label label-important">Tree</span></a></td>
						</tr>';	
			}
			$html.='<tbody></table></div>';
			echo $html;
	}
	
	function details($eid)
	{
		$data['member']			=	$this->ObjM->member_detail($eid);
		$multi_position			=	$this->ObjM->get_multi_position_detail($eid);	
		//echo $this->db->last_query();
		//var_dump($multi_position);
		$data['payment']			=	$this->get_payment($eid);
		
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
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_member_details',$data);
		$this->load->view('comman/footer');
	}
	
	 protected function get_payment($usercode){
		$pay		=	$this->ObjM->get_payment_sum_by_type($usercode,'RM');
		$coin_pay	=	$this->ObjM->get_payment_sum_by_type($usercode,'COIN');
		$live_pay	=	$this->ObjM->get_payment_sum_by_type($usercode,'Live');
		
		$withdrawal		=	$this->ObjM->get_withdrawal_sum_by_type($usercode,'RM');
		$coin_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type($usercode,'COIN');
		$live_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type($usercode,'Live');
		
		$arr=array(
			'pay'			=>	$pay,
			'coin_pay'			=>	$coin_pay,
			'withdrawal'		=>	$withdrawal,
			'coin_withdrawal'	=>	$coin_withdrawal,
			'balance'		=>	$pay		-	$withdrawal,
			'coin_balance'		=>	$coin_pay	-	$coin_withdrawal,
			'live_pay'			=>	$live_pay,
			'live_balance'		=>	$live_pay	-	$live_withdrawal,
			
		);
	
		return $arr;	
	
	}
	
	function balance_tranfer($eid){
		
		if(!$this->opp_admin){
			exit;
		}
		$data['payment'] = $this->get_payment($eid);
		$data['result']	 = $this->ObjM->member_detail($eid);
		
		$data['list'] =	$this->ObjM->get_all_tranfer($eid);
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_balance_tranfer',$data);
		$this->load->view('comman/footer');
	}
	
	function tranfer_amount(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$fosubmit=true;
			$payment= $this->get_payment($_POST['usercode']);	
			
			$amount		=	(int)$_POST['amount'];
			
			if(!is_numeric($_POST['amount'])){
				$fosubmit=false;
				$msg='Invalid Request';
			}
			
			if(!isset($_POST['usercode']) || $_POST['usercode']==''){
				$fosubmit=false;
				$msg='Invalid Request';
			}
			
			if($payment['balance']<1){
				$fosubmit=false;
				$msg='Pending Wallet Not Enough Balance';
			}
			
			if($amount > $payment['balance']){
				$fosubmit=false;
				$msg='Invalid Request';
			}
			
			if($fosubmit){
				$this->_tranfer_amount();
				$msg='Balance Transfer Successfully';
			}
			
			$this->session->set_flashdata('show_msg',$msg);
		}
		
		header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/balance_tranfer/'.$_POST['usercode'].'');
		exit;
		
	}
	protected function _tranfer_amount(){
		
		//***Withdrawal***//
		$data=array();
		$data['usercode']		=	$_POST['usercode'];
		$data['amount']			=	$_POST['amount'];
		$data['msg']			=	$_POST['msg'];
		$data['wallet_type']	=	'RM';
		$data['type']			=	'2';
		$data['timedt']			=	time();
		$data['textdt']			=	'Tranfer To Live Wallet';
		$data['uby']			=	$this->session->userdata['logged_ol_member']['usercode'];
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_withdrawal');
		
		//***Add Amount***//
		$data=array();
		$data['usercode']		=	$_POST['usercode'];
		$data['amount']			=	$_POST['amount'];
		$data['wallet_type']	=	'Live';
		$data['timedt']			=	time();
		$data['type']			=	'2';
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'member_payment');
	
	}
	
	function cycle_report(){
		$data['result']	= $this->ObjM->cycle_report();
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/cycle_report',$data);
		$this->load->view('comman/footer');
		
	}
	
	
	
	
}

