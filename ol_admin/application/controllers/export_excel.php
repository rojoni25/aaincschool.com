<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class export_excel extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('export_excel_model','',TRUE);
		ob_start();
 	}
	
	function member()
	{
		$result=$this->export_excel_model->get_member($_REQUEST['r']);
		$output .= '"Usercode",';
		$output .= '"Name",';
		$output .= '"Email",';
		$output .= '"Mobile No",';
		$output .= '"Phone No",';
		$output .= '"Skype",';
		$output .= '"Payza Pay",';
		$output .= '"Solid Trus Pay",';
		$output .= '"Paypal",';
		$output .= '"Username",';
		$output .= '"Password",';
		$output .= '"Status",';
	
		$output .="\n";
		for($i=0;$i<count($result);$i++)
		{
			
			
			$name=$result[$i]['fname'].' '.$result[$i]['lname'];
			$output .='"'.$result[$i]["usercode"].'",';
			$output .='"'.$name.'",';
			$output .='"'.$result[$i]["emailid"].'",';
			$output .='"'.$result[$i]['mobileno'].'",';
			$output .='"'.$result[$i]['phone_no'].'",';
			$output .='"'.$result[$i]['skype'].'",';
			$output .='"'.$result[$i]['payzapay'].'",';
			$output .='"'.$result[$i]['solidtrustpay'].'",';
			$output .='"'.$result[$i]['paypal'].'",';
			$output .='"'.$result[$i]['username'].'",';
			$output .='"'.$result[$i]['password'].'",';
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
	
	function send_request($eid)
	{	
		$result=$this->export_excel_model->get_member_request_send($eid);
		$output .= '"Usercode",';
		$output .= '"Name",';
		$output .= '"Email",';
		$output .= '"Mobile No",';
		$output .= '"Phone No",';
		$output .= '"Skype",';
		$output .= '"Payza Pay",';
		$output .= '"Solid Trus Pay",';
		$output .= '"Paypal",';
		$output .= '"Username",';
		$output .= '"Password",';
		$output .= '"Status",';
		$output .= '"Payment Status",';
		$output .= '"Request Date",';
		$output .="\n";
		for($i=0;$i<count($result);$i++)
		{
			$name=$result[$i]['fname'].' '.$result[$i]['lname'];
			$payment_st=($result[$i]['payment']=='Y' ? "Paid" : "Not Paid");
			$timedt=date('d/m/Y',$result[$i]['timedt']);
			$output .='"'.$result[$i]["usercode"].'",';
			$output .='"'.$name.'",';
			$output .='"'.$result[$i]["emailid"].'",';
			$output .='"'.$result[$i]['mobileno'].'",';
			$output .='"'.$result[$i]['phone_no'].'",';
			$output .='"'.$result[$i]['skype'].'",';
			$output .='"'.$result[$i]['payzapay'].'",';
			$output .='"'.$result[$i]['solidtrustpay'].'",';
			$output .='"'.$result[$i]['paypal'].'",';
			$output .='"'.$result[$i]['username'].'",';
			$output .='"'.$result[$i]['password'].'",';
			$output .='"'.$result[$i]['status'].'",';
			$output .='"'.$payment_st.'",';
			$output .='"'.$timedt.'",';
			$output .="\n";
		}
		$dt=date("d-m-Y");
		$filename = "member_payment_".$dt.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		ob_get_contents();
		echo $output;
	}
	
	function member_all()
	{
		$result=$this->export_excel_model->get_member_all();
		$output .= '"Usercode",';
		$output .= '"Email Id",';
		$output .="\n";
		for($i=0;$i<count($result);$i++)
		{
			$output .='"'.$result[$i]["usercode"].'",';
			$output .='"'.$result[$i]["emailid"].'",';
			$output .="\n";
		}
		$dt=date("d-m-Y");
		$filename = "member_payment_".$dt.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		ob_get_contents();
		echo $output;
	}
	
	function unverification_member()
	{
		$result=$this->export_excel_model->get_unverification_member();
		$output .= '"Usercode",';
		$output .= '"Name",';
		$output .= '"Email",';
		$output .= '"Email Verified",';
		$output .= '"Mobile No",';
		$output .= '"Phone No",';
		$output .= '"Skype",';
		$output .= '"Payza Pay",';
		$output .= '"Solid Trus Pay",';
		$output .= '"Paypal",';
		$output .= '"Username",';
		$output .= '"Password",';
		$output .= '"Status",';
		$output .="\n";
		for($i=0;$i<count($result);$i++)
		{
			$name=$result[$i]['fname'].' '.$result[$i]['lname'];
			$verified=($result[$i]["email_verification"]=='Y')?"YES":"NO";
			
			$output .='"'.$result[$i]["usercode"].'",';
			$output .='"'.$name.'",';
			$output .='"'.$result[$i]["emailid"].'",';
			$output .='"'.$verified.'",';
			$output .='"'.$result[$i]['mobileno'].'",';
			$output .='"'.$result[$i]['phone_no'].'",';
			$output .='"'.$result[$i]['skype'].'",';
			$output .='"'.$result[$i]['payzapay'].'",';
			$output .='"'.$result[$i]['solidtrustpay'].'",';
			$output .='"'.$result[$i]['paypal'].'",';
			$output .='"'.$result[$i]['username'].'",';
			$output .='"'.$result[$i]['password'].'",';
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

