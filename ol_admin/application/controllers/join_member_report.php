<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class join_member_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('join_member_report_model','ObjM',TRUE);
 	}
	

	function join_member()
	{
		
		$data['first_dt']=$this->ObjM->get_first_member_add_date();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('join_member_report_view',$data);
		$this->load->view('comman/footer');
	}
	
	function join_month_date_wise(){
		if($_POST['report_type']=='renew_member'){
			$data=$this->re_new_rt();
		}
		else{
			$data=$this->get_joining_rt();
		}	
		echo $data;
		
	}
	
	protected function get_joining_rt()
	{
		$result	=	$this -> ObjM -> join_month_date_wise();
		$tot	=	$this -> ObjM -> join_month_wise_tot();
		$html='<table class="stat-table table table-stats table-striped table-sortable table-bordered table_main">
				<thead>
					<tr>
						<td>Sr. No</td>
						<td>Date</td>
						<td>Total Member Join</td>
						<td></td>
					</tr>
				</thead>
				<tbody>';
		for($i=0;$i<count($result);$i++){
			$srno=$i+1;
			$html.='<tr>
						<td>'.$srno.'</td>		
						<td>'.date('d-m-Y',$result[$i]['timedt']).'</td>				
						<td>'.$result[$i]['tot'].'</td>
						<td><a class="open_popup" href="'.base_url().'index.php/'.$this->uri->segment(1).'/view_detail/'.$_POST['report_type'].'/'.$result[$i]['timedt'].'">view</a></td>
					</tr>';
		}
		$html.='<tr>
					<td colspan="2"><strong>Total</strong></td>				
					<td><strong>'.$tot[0]['tot'].'</strong></td>
				</tr></tbody></table>';
		return $html;
	}
	
	protected function re_new_rt(){
		$result	=	$this -> ObjM -> report_renew();
	
		$html='<table class="stat-table table table-stats table-striped table-sortable table-bordered table_main">
		<thead>
		<tr>
			<td>Usercode</td>
			<td>Username</td>
			<td>Name</td>
			<td>Date</td>
		</tr>';
		
		for($i=0;$i<count($result);$i++){
			$srno=$i+1;
			$html.='<tr>
						<td>'.$result[$i]['usercode'].'</td>		
						<td>'.$result[$i]['username'].'</td>		
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>		
						<td>'.date('d-m-Y',$result[$i]['timedt']).'</td>
					</tr>';
		}
		$html.='<tr>
					<td colspan="3"><strong>Total</strong></td>				
					<td><strong>'.count($result).'</strong></td>
				</tr></tbody></table>';
		return  $html;
	}
	
	function view_detail($type, $dt){
		
		$arr=array(
			'report_type'=> $type,
			'dt'=> $dt,
		);
		$data['result']=$this->ObjM->get_member_by_detail($arr);
		$this->load->view('join_active_popup',$data);
		
	}
	

}

