<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_confirm_report extends CI_Controller {

	function __construct()
 	{
   		
		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('payment_confirm_report_model','',TRUE);
		$this->load->library('email');
		
 	}
	
	public function index()
	{
		//$data['table_list']=true;
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('payment_confirm_report_affiliate');
		$this->load->view('comman/footer');
	}
	
	
	function listing($id=''){
		$result		=$this->payment_confirm_report_model->getAll();
		
	 
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$ref		=$this->payment_confirm_report_model->get_member_by_code($result[$i]['referralid_free']);
			$status = $this->payment_confirm_report_model->get_status($result[$i]['usercode']);
			

			$html .='<tr class="'.$cls.'">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['msg'].'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['timedt'].'</td>
						<td>'.$result[$i]['type'].'</td>
						<td>'.$ref[0]['fname'].' '.$ref[0]['lname'].'</td>
						<td>'.$ref[0]['mobileno'].'</td>'
						;
						$htmltd="";
						if ($status['type'] =="Pending") {
						$htmltd = $htmltd.' 
							<td>
							<a href="'.base_url().'index.php/payment_confirm_report/accept_request/'.$result[$i]['usercode'].'" class="btnsuccess"><button class="btn-success sendbtn">Approve</button></a>
						</td>';
							
						}
						

					$html= $html. $htmltd."	
              		</tr>'
              		";
		}
		
			echo $html;
		
	}


	
	function accept_request($id)
	{
		$ref_id = $this->session->userdata['logged_ol_member']['usercode'];
		
		$data['type'] = "Done";
		$data = $this->payment_confirm_report_model->update($data,'affiliate_confirm_message',$id,$ref_id);
		
		$this->session->set_flashdata('show_msg', 'Payment Confirm Successfully!');
		header('Location: '.base_url().'index.php/payment_confirm_report');
		exit;
	}

	function page_view_aff()
	{

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view("payment_confirm_by_aff");
		$this->load->view('comman/footer');
		
	}

	function payment_accepted_by_affiliate()
	{
		$result = $this->payment_confirm_report_model->get_aff_confirm_report();
		//print_r($result); echo "<pre>";
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$ref		=$this->payment_confirm_report_model->get_member_by_code($result[$i]['referralid']);
				//print_r($ref); exit();
		$html .='<tr class="'.$cls.'">
						<td>'.$result[$i]['msg'].'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['timedt'].'</td>
						<td>'.$result[$i]['type'].'</td>
						<td>'.$ref[0]['fname'].' '.$ref[0]['lname'].'</td>
						<td>'.$ref[0]['mobileno'].'</td>
						<td style="color: green;">'."Payment Confirm By Affiliate".'</td>
              		</tr>';
              		
		}
		
			echo $html;
		


	}
	
}

