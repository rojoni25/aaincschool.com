<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reports extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('report_model','',TRUE);
		$this->load->model('user_model','',TRUE);
 	}
	

	function qualified_member()
	{
		
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('qualified_member_view');
		$this->load->view('comman/footer');
	}
	
	function listing_qualified_member(){
		$result=$this->report_model->get_all_qualified();	
		$count=$this->report_model->get_tot_count_qualified();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){ 
			$totalrefcnt = countreferral($result[$i]['usercode']);
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$totalrefcnt,
					date('d-M-Y', $result[$i]['add_time']),
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function unqualified_member()
	{
		
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('unqualified_member_view');
		$this->load->view('comman/footer');
	}
	
	function listing_unqualified_member(){
		$result=$this->report_model->get_all_unqualified_member();	
		$count=$this->report_model->get_tot_count_unqualified_member();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){ 
			$totalrefcnt = countreferral($result[$i]['usercode']);
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$totalrefcnt,
					date('d-M-Y', $result[$i]['add_time']),
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}

	//
	function remaintosmarttransfer(){
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('remaintosmarttransfer_view');
		$this->load->view('comman/footer');
	}

	function getremainwalletamt(){
		$wallet = $this->input->post('wallet');
		$uid = $this->input->post('uid');
		if($wallet>0 && $uid>0){
			$w1 = $this->user_model->getmemberlevelwallet($uid,$wallet);
			$w1r = $w1>60?abs(60-$w1):0;
			$w1tra = $this->user_model->getremainwallettosmartamt($uid,$wallet);
			echo $w1r-$w1tra;
		}else{
			echo '0';
		}
	}
	function insert_transfer(){
		$usercode = $this->input->post('user_code');
		$remainwallet = $this->input->post('remainwallet');
		$transferamt = $this->input->post('transferamt');
		if($transferamt>0){
			if($remainwallet>0 && $usercode>0){
				$data = array();
		        $data['receiverid'] =  $usercode;
		        $data['senderid'] =  $usercode;
		        $data['amount'] =  $transferamt;
		        $data['plan'] =  $remainwallet;
		        $data['type'] =  'remain';
		        $data['date'] =  date('Y-m-d H:i:s');
		        $this->user_model->addItem($data,'tbl_visible_wallet');
		        $data = array();
		        $data['userid'] =  $usercode;
		        $data['amount'] =  $transferamt;
		        $data['wallet'] =  $remainwallet;
		        $data['date'] =  date('Y-m-d H:i:s');
		        $this->user_model->addItem($data,'tbl_remain_smart_transfer');
			}
		}else{

		}
		header('Location: '.base_url().'index.php/reports/remaintosmarttransfer');
	}

	function remaintosmart_transfer_report()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("remaintosmart_transfer_report");
		$this->load->view('comman/footer');
		
	}

	function remaintosmart_transfer_report_get(){

		$result=$this->report_model->smartwtrasfer_all_record();
		$html='';
		for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['userid'];
			$wallet = $result[$i]['wallet'];
			$html .='<tr>
						<td>'.$usercode.'</td>
						<td>'.$result[$i]['fname']." ".$result[$i]['lname'].'</td>
						<td>W'.$wallet.' R</td>
						<td>'.$result[$i]['amount'].'</td>
						<td>'.date('d-M-Y H:i:s',strtotime($result[$i]['date'])).'</td>
              		</tr>';
		}
		echo $html;
	}
}

