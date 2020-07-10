<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('payment_report_model','ObjM',TRUE);
 	}
	
	public function due_payment_report()
	{
		$data['table_list']=true;
		$data['html']=$this->list_due_payment_report();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('report_due_payment');
		$this->load->view('comman/footer');
	}
	
	protected function list_due_payment_report()
	{
		$now=time();
		$result=$this->ObjM->getAll_active_due_payment();
		$html='';
		for($i=0;$i<count($result);$i++){
			$last_pay=$this->ObjM->getAll_last_payment($result[$i]['usercode']);
			$newDate = date("d-m-Y", strtotime($last_pay[0]['paydate']));
			$due_dt = date('d-m-Y', $result[$i]['due_time']);
			$tr_cls=($now < $result[$i]['due_time'] ? "tr_on":"tr_due");
			$html.='<tr class="'.$tr_cls.'">
				  		<td>'.$result[$i]['usercode'].'</td>
				  		<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
				  		<td>'.$result[$i]['username'].'</td>
				  		<td>'.$newDate.'</td>
				  		<td>'.$due_dt.'</td>
				  		<td>Update</td>
        			</tr>';
		}
		return $html;
	}
	
	function free_last_payment()
	{
		$data['table_list']=true;
		$data['last_pay']	=	$this->ObjM->last_payment_free();
		$data['tot_pay']	=	$this->ObjM->get_daily_payment_free_member($data['last_pay']);
		
		$data['send_total']	=	$this->ObjM->free_payment_email_status($data['last_pay'],'1');
		$data['fail_total']	=	$this->ObjM->free_payment_email_status($data['last_pay'],'2');
		$data['notsend_total']	=	$this->ObjM->free_payment_email_status($data['last_pay'],'0');
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('free_last_payment');
		$this->load->view('comman/footer');
	}
	
	function paid_payment_daily()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$data['html']	=	$this->listing_paid_pay();
		}
	
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('paid_payment_daily_view');
		$this->load->view('comman/footer');
	}
	
	function listing_free_pay(){
		$last_pay	=	$this->ObjM->last_payment_free();
		$result=$this->ObjM->allmember_free_pay($last_pay);
		
		for($i=0;$i<count($result);$i++)
		{
			$chk_email=$this->ObjM->free_member_check_email($result[$i]['usercode'],$last_pay);
			$ck='';
			if($chk_email[0]['send_email']=='0'){$ck='Not Send';	}
			else if($chk_email[0]['send_email']=='1'){$ck='Send';}
			else if($chk_email[0]['send_email']=='2'){$ck='Send Faild';}
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$ck
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	
	
	
	

	
	
	function listing_paid_pay(){
		
		
		$eid=strtotime($_POST['daily_date']);
		$html='';
		$result=$this->ObjM->get_listing_paid_pay($eid);
		for($i=0;$i<count($result);$i++)
		{
			$arr=array(
		 	'usercode'	=>	$result[$i]['usercode'],
			'timestm'	=>	$eid,
			'pay_type'  => $_POST['report_type'],
			);
			$total_amount=$this->ObjM->paid_member_total_amount_get($arr);
			
			$pay='<a class="payment_form" href="'.base_url().'index.php/payment_report/get_paid_from/'.$result[$i]['usercode'].'/'.$eid.'/'.$_POST['report_type'].'">'.$total_amount[0]['total'].'</a>';
			$html.='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$pay.'</td>
					</tr>';
			
		}
		return $html;
		
	}
	
	function get_paid_from($usercode, $time, $report_type){
		$arr=array(
		 	'usercode'	=>	$usercode,
			'timestm'	=>	$time,
			'pay_type'  => $report_type,
		);
		$result=$this->ObjM->get_paid_from($arr);
		
		$html='<div style="max-height:300px;overflow:auto;"><table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<td>Type</td>
						<th>Level</th>
						<th>Amount</th>
					</tr>
				</thead>
					<tbody>';		
				for($i=0;$i<count($result);$i++){
						$html.='<tr>
							<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
							<td>'.$result[$i]['pay_type'].'</td>
							<td>'.$result[$i]['level'].'</td>
							<td>$'.$result[$i]['amount'].'</td>
						</tr>';						
					}			
			$html.='</tbody>
			</table><div>';
			echo $html;
		
	}
	
	
	
	
	
}

