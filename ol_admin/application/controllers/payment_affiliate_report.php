<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_affiliate_report extends CI_Controller {

	function __construct()
 	{
   		
		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('payment_affiliate_report_model','',TRUE);
		$this->load->library('email');
		
 	}
	
	public function index()
	{
		//$data['table_list']=true;
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('payment_affiliate_report_view');
		$this->load->view('comman/footer');
	}
	
	
	function listing($id=''){
		$result		=$this->payment_affiliate_report_model->getAll();
	
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$ref		=$this->payment_affiliate_report_model->get_member_by_code($result[$i]['referralid']);
			 //$status = $this->payment_affiliate_report_model->get_status();
 
			$html .='<tr class="'.$cls.'">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['msg'].'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['timedt'].'</td>
						<td>'.$result[$i]['admin_verify'].'</td>
						<td>'.$ref[0]['fname'].' '.$ref[0]['lname'].'</td>
						<td>'.$ref[0]['mobileno'].'</td>'
						;
						$htmltd="";
						if ($result[$i]['admin_verify'] =="Pending") {
						$htmltd = $htmltd.' 
							<td>
							<a href="'.base_url().'index.php/payment_affiliate_report/accept_request/'.$result[$i]['usercode'].'" class="btnsuccess"><button class="btn-success sendbtn">Verify</button></a>
						</td>';
							
						} else{
							$htmltd = $htmltd.'<td>&nbsp;</td>';
						}
						

					$html= $html. $htmltd."	
              		</tr>'
              		";
		}
		
			echo $html;
		
	}


	
	function accept_request($id)
	{
		$ref_id = $this->session->userdata['logged_in_visa']['usercode'];
		
		
		$data['admin_verify'] = "Done";
		$data = $this->payment_affiliate_report_model->update($data,'affiliate_confirm_message',$id,$ref_id);
		
		$this->session->set_flashdata('show_msg', 'Payment Verify Successfully!');
		header('Location: '.base_url().'index.php/payment_affiliate_report');
		exit;
	}

	
}

