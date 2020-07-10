<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){header('Location: '.base_url().'index.php/vma/dashboard/view');exit;}
		$this->load->model('vma_ad/report_model','ObjM',TRUE);
		$this->load->library('vma_ad/vma_class');
 	}
	
	
	public function balance_sheet()
	{
		$data['html'] = $this->listing();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/member_balance_shit_list',$data);
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result = $this->ObjM->get_list();
		
		for($i=0;$i<count($result);$i++)
		{
			$html.='<tr>
					<td>'.$result[$i]['usercode'].'</td>
					<td>'.$result[$i]['name'].'</td>
					<td>'.$result[$i]['username'].'</td>
					<td><a href="'.vma_ad().''.$this->uri->rsegment(1).'/virtual_wallet/'.$result[$i]['usercode'].'">'.$result[$i]['virtual_in'].'</a></td>
					<td><a href="'.vma_ad().''.$this->uri->rsegment(1).'/virtual_wallet/'.$result[$i]['usercode'].'">'.$result[$i]['virtual_out'].'</a></td>
					<td><a href="'.vma_ad().''.$this->uri->rsegment(1).'/virtual_wallet/'.$result[$i]['usercode'].'">'.$result[$i]['virtual_balance'].'</a></td>
					<td><a href="'.vma_ad().''.$this->uri->rsegment(1).'/main_wallet/'.$result[$i]['usercode'].'">'.$result[$i]['main_in'].'</a></td>
					<td><a href="'.vma_ad().''.$this->uri->rsegment(1).'/main_wallet/'.$result[$i]['usercode'].'">'.$result[$i]['main_out'].'</a></td>
					<td><a href="'.vma_ad().''.$this->uri->rsegment(1).'/main_wallet/'.$result[$i]['usercode'].'">'.$result[$i]['main_balance'].'</a></td>
					
			</tr>';
		}
		return $html;
	}
	
	function virtual_wallet($eid)
	{
		$data['result']				=		$this->vma_class->get_member_by_code($eid);
		$data['payment']			=		$this->vma_class->virtual_balance($eid);
		$data['wallet_income'] 		= 		$this->ObjM->virtual_wallet_income($eid);
		
	
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/virtual_wallet_detail',$data);
		$this->load->view('comman/footer');
	}
	
	
	function main_wallet($eid)
	{
		
		$data['eid']	=$eid;
		$sQuery						=		'SELECT MIN( timedt ) AS timedt FROM vma_daily_payment WHERE usercode="'.$eid.'"';
		$data['time']				=		$this->comman_fun->select_query($sQuery);
		
		$data['result']				=		$this->vma_class->get_member_by_code($eid);
		$data['payment']			=		$this->vma_class->main_balance($eid);
		$data['html'] 				=	 	$this->get_income_report($eid,'all',true);
		
		$data['wallet_withdrawal'] 	= 		$this->ObjM->main_withdrawal($eid);
	
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/main_wallet_detail',$data);
		$this->load->view('comman/footer');
	}
	
	function virtual_wallet_month_vise()
	{
		$data['date_frm']	=	true;
		$sQuery				=	'SELECT MIN( timedt ) AS timedt FROM vma_daily_payment';
		$data['time']		=	$this->comman_fun->select_query($sQuery);
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/virtual_wallet_month_vise_list',$data);
		$this->load->view('comman/footer');
	}
	
	function virtual_wallet_user_detail($eid)
	{
		$data['result']				=		$this->vma_class->get_member_by_code($eid);
		$data['payment']			=		$this->vma_class->virtual_balance($eid);
		$data['wallet_income'] 		= 		$this->ObjM->virtual_wallet_income($eid);
		
		$data['html']	=	$this->virtual_payment_member_detail($eid);
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/virtual_wallet_payment_report',$data);
		$this->load->view('comman/footer');
	}
	
	
	function get_month_date_list($date){
		$start_date		=	strtotime($date);
		$end_date 		= 	strtotime(date('t-m-Y',strtotime($date)));	
		$result			= 	$this->ObjM->virtual_wallet_month_vise(array($start_date,$end_date));
		
		$html='<option value="">Select Date</option>';
		
		for($i=0;$i<count($result);$i++){
			$dt=date('d-m-Y',$result[$i]['timedt']);
			$html.='<option value="'.$dt.'">'.$dt.'</option>';
		}
		
		echo $html;	
	}
	
	function virtual_payment_member_list($date){
		$date		=	strtotime($date);
		$result		=	$this->ObjM->virtual_payment_member_list(array('date'=>$date));
		
		$dt			=	date('d-m-Y',$date);
		
		
	
		for($i=0;$i<count($result);$i++){
			
			$upling		=	$this->ObjM->get_upling($result[$i]['usercode']);
			
			
			
			$row=$i+1;
			
			$name1	=	(isset($upling[0]['name1']))?$upling[0]['name1']: "<strong>System</strong>";
			$name2	=	(isset($upling[0]['name2']))?$upling[0]['name2']: "<strong>System</strong>";
			$name3	=	(isset($upling[0]['name3']))?$upling[0]['name3']: "<strong>System</strong>";
			
			$html.='<tr>
				<td>'.$row.'</td>
				<td>'.$result[$i]['EndCode'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.date('d-m-Y',$result[$i]['timedt']).'</td>
				<td>'.$name1.'</td>
				<td>'.$name2.'</td>
				<td>'.$name3.'</td>
			</tr>';
		}
		echo $html;
	}
	
	function virtual_payment_member_detail($eid){
		
		$result		=	$this->ObjM->virtual_payment_member_detail($eid);
	
	
		for($i=0;$i<count($result);$i++){
			
			$upling		=	$this->ObjM->get_upling($result[$i]['usercode']);
			
			
			
			$row=$i+1;
			
			$name1	=	(isset($upling[0]['name1']))?$upling[0]['name1']: "<strong>System</strong>";
			$name2	=	(isset($upling[0]['name2']))?$upling[0]['name2']: "<strong>System</strong>";
			$name3	=	(isset($upling[0]['name3']))?$upling[0]['name3']: "<strong>System</strong>";
			
			$html.='<tr>
				<td>'.$row.'</td>
				<td>'.$result[$i]['EndCode'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.date('d-m-Y',$result[$i]['timedt']).'</td>
				<td>'.$name1.'</td>
				<td>'.$name2.'</td>
				<td>'.$name3.'</td>
			</tr>';
		}
		return $html;
	}
	
	
	function get_income_report($usercode,$eid,$rt){
		if($eid=='all'){
			$html  =	$this->get_income_month_wise($usercode);
		}else{
			$html  =	$this->get_member_income_by_month($usercode,$eid);	
		}	
		if($rt){
			return $html; 
		}
		echo $html;	
	}
	
	function get_member_income_by_month($usercode,$eid){
		$html='';
		$start_date 	= 	strtotime(date('01-m-Y',strtotime($eid)));
   		$end_date 		= 	strtotime(date('t-m-Y',$start_date));
		
		$result=$this->ObjM->get_member_income_by_month(array('usercode'=>$usercode,'start_date'=>$start_date,'end_date'=>$end_date));	
		$html.='<table class="table">';
		$html.='<thead><tr><th>Date</th><th>Amount</th><th>#</th></tr></thead><tbody>';
		for($i=0;$i<count($result);$i++)
		{
			$html.='<tr><td>'.date('d-m-Y',$result[$i]['timedt']).'</td><td>$'.number_format($result[$i]['tot'],2).'</td><td><a href="'.$result[$i]['timedt'].'" class="date_detail_view">View</a></td></tr>';
		}
		
		$amount=$this->ObjM->income_sum(array('usercode'=>$usercode,'start_date'=>$start_date,'end_date'=>$end_date));
		$html.='<tr><td>Total</td><td>$'.number_format($amount[0]['tot'],2).'</td></tr>';
		
		$html.='<tbody></table>';
		
		return $html;
		
	}
	
	
	protected function get_income_month_wise($usercode){
		
		$html='';
		$sQuery		=	'SELECT MIN( timedt ) AS timedt FROM vma_daily_payment WHERE usercode="'.$usercode.'"';
		$time		=	$this->comman_fun->select_query($sQuery);
		
		$date 		= 	date('01-m-Y',$time[0]['timedt']);
   		$end_date 	= 	date('t-m-Y',time());
 		$dt_show	=	date('F Y', strtotime($date));
		
 		while (strtotime($date) <= strtotime($end_date)) {
			$month_list[]=array(
				'month_name' => $dt_show,
				'month_value' => $date
			);	
 			$date = date ("d-m-Y", strtotime("+1 month", strtotime($date)));
			$dt_show=date('F Y', strtotime($date));
		}
		
		$html.='<table class="table">';
		$html.='<thead><tr><th>Month</th><th>Amount</th></tr></thead><tbody>';
		for($i=0;$i<count($month_list);$i++)
		{
			$start_date		=	strtotime($month_list[$i]['month_value']);
			$end_date 		= 	strtotime(date('t-m-Y',strtotime($date)));
			
			$amount=$this->ObjM->income_sum(array('usercode'=>$usercode,'start_date'=>$start_date,'end_date'=>$end_date));
			$html.='<tr><td>'.date('M Y',$start_date).'</td><td>$'.number_format($amount[0]['tot'],2).'</td></tr>';
			
		}
		
		$amount=$this->ObjM->income_sum(array('usercode'=>$usercode));
		$html.='<tr><td>Total</td><td>$'.number_format($amount[0]['tot'],2).'</td></tr>';
		
		$html.='<tbody></table>';
		
		return $html;
		
	}
	
	function income_report_datewise($usercode,$eid){
		$html		=	'';
		$result		=	$this->ObjM->income_report_datewise($usercode,$eid);
		
		$html.='<table class="table">';
		$html.='<thead><tr><th>SR</th><th>Member</th><th>Amount</th><th>Level</th></tr></thead><tbody>';
		for($i=0;$i<count($result);$i++)
		{
			$row=$i+1;
			$html.='<tr>
					<td>'.$row.'</td>
					<td>'.$result[$i]['name'].'</td>
					<td>$'.number_format($result[0]['amount'],2).'</td>
					<td>'.$result[$i]['level'].'</td>
			</tr>';
			
		}
		
		$amount=$this->ObjM->income_sum(array('usercode'=>$usercode,'start_date'=>$eid,'end_date'=>$eid));
		$html.='<tfoot><tr><th colspan="2">Total</th><th colspan="2">$'.number_format($amount[0]['tot'],2).'</th></tr></tfoot>';
		
		$arr=array(
			'html'  => $html,
			'title' => '('.date('d-m-Y',$eid).')'   
		);
		
		echo json_encode($arr);
		
	}
	
	function unqulified()
	{
		$data['date_frm']	=	true;
		$sQuery				=	'SELECT MIN( timedt ) AS timedt FROM vma_daily_payment';
		$data['time']		=	$this->comman_fun->select_query($sQuery);
		
		$data['tot']		=	$this->ObjM->get_unqulified_sum();
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/unqulified_list',$data);
		$this->load->view('comman/footer');	
	}
	
	function get_unqulified_list($date)
	{
		$html='';
		$start_date		=	strtotime($date);
		$end_date 		= 	strtotime(date('t-m-Y',strtotime($date)));	
	
		
		$result			= 	$this->ObjM->get_unqulified_list(array('start_date'=>$start_date,'end_date'=>$end_date));		
		
		$tot			=	$this->ObjM->get_unqulified_sum(array('start_date'=>$start_date,'end_date'=>$end_date));
		
		
		
		for($i=0;$i<count($result);$i++){
			$row=$i+1;
			$html.='<tr>
                	<td>'.$row.'</td>
                    <td>'.$result[$i]['name1'].' ('.$result[$i]['EndCode'].')</td>
                    <td>'.$result[$i]['name2'].' ('.$result[$i]['option'].')</td>
                    <td>'.date('d-m-Y',$result[$i]['timedt']).'</td>
					<td>$'.number_format($result[$i]['amount'],2).'</td>
                </tr>';
		}
		
		$html.='<tr>
                	<td></td>
                    <td></td>
                    <td></td>
					<td><strong>Total</strong></td>
                    <td>$'.number_format($tot,2).'</td>
                </tr>';
		
		echo $html;
		
	}
	
	
	
	
	
	
	
	
}

