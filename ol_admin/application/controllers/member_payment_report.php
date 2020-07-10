<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_payment_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('member_payment_report_model','ObjM',TRUE);
 	}
	
	public function list_view()
	{
		
		if($_POST['excel']=='excel'){
			$this->excel_sheel();
			exit;
		}
		
		$data['total']	=	$this->ObjM->get_pay_sum();	
		$data['html']	=	$this->get_listing();
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('member_payment_report_view');
		$this->load->view('comman/footer');
	}
	
	
	
	public function get_listing()
	{
	
		$html="";
		$result=$this->ObjM->get_pay_member_list();	
		
		for($i=0;$i<count($result);$i++){
			
			$ref	=	$this->ObjM->get_member_by_usercode($result[$i]['referralid']);	
			$datedt = date('d-m-Y', $result[$i]['timedt']);
			$ref='<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$ref[0]['username'].'">'.$ref[0]['fname'].' '.$ref[0]['lname'].'</a>';
			$html.='<tr>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
				<td>'.$result[$i]['username'].'</td>
				<td>'.$ref.'</td>
				<td>$'.$result[$i]['amount'].'</td>
				<td>'.$datedt.'</td>
				<td>'.$result[$i]['skype'].'</td>
				<td>'.$result[$i]['mobileno'].'</td>
				<td>'.$result[$i]['emailid'].'</td>
				
			</tr>';
		}
		return $html;
	}
	
	
	function excel_sheel(){
		ob_start();
		$result=$this->ObjM->get_pay_member_list();
		
		$output .= '"Usercode",';
		$output .= '"Name",';
		$output .= '"Sponsor",';
		$output .= '"Amount($)",';
		$output .= '"Payment Date",';
		$output .= '"Email",';
		$output .= '"Mobile No",';
		$output .= '"Phone No",';
		$output .= '"Skype",';
		$output .= '"Payza Pay",';
		$output .= '"Solid Trus Pay",';
		$output .= '"Paypal",';
		$output .= '"Username",';
		$output .= '"Status",';
		$output .="\n";
		for($i=0;$i<count($result);$i++)
		{
			$ref	=	$this->ObjM->get_member_by_usercode($result[$i]['referralid']);	
			$ref_name=$ref[0]['fname'].' '.$ref[0]['lname'].'('.$ref[0]['usercode'].')';
			$name=$result[$i]['fname'].' '.$result[$i]['lname'];
			$datedt = date('d-m-Y', $result[$i]['timedt']);
			
			$output .='"'.$result[$i]["usercode"].'",';
			$output .='"'.$name.'",';
			$output .='"'.$ref_name.'",';
			$output .='"'.$result[$i]['amount'].'",';
			$output .='"'.$datedt.'",';
			$output .='"'.$result[$i]["emailid"].'",';
			$output .='"'.$result[$i]['mobileno'].'",';
			$output .='"'.$result[$i]['phone_no'].'",';
			$output .='"'.$result[$i]['skype'].'",';
			$output .='"'.$result[$i]['payzapay'].'",';
			$output .='"'.$result[$i]['solidtrustpay'].'",';
			$output .='"'.$result[$i]['paypal'].'",';
			$output .='"'.$result[$i]['username'].'",';
			$output .='"'.$result[$i]['status'].'",';
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

