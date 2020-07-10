<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upgrade_membership extends CI_Controller {
		
		protected $noti_msg			=	'';
		protected $email_heading	=	'';
		protected $email_msg		=	'';
	
		function __construct()
 		{
   			parent::__construct();
			if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
			$this->load->model('upgrade_membership_model','',TRUE); 
					$this->load->model('payment_confirm_model','ObjM',TRUE);

			$this->load->library('email');
 		}
		
		function view($st)
		{
			$this->check_member_pending();
			$result	 =	$this->upgrade_membership_model->check_request_send();
			//print_r($result);
			if(!isset($result[0]))
			{
				//$this->upgrade_request();
				//$result	 =	$this->upgrade_membership_model->check_request_send();
				//print_r($result);
			}
			if(isset($result[0]) && $result[0]['payment']=='Y')
			{
				$data['pay_message']='<div class="alert alert-success"><i class="icon-ok-sign"></i><strong>Your Payment Received Successfully</strong></div>';
			}
		
			else
			{
				 $data['pay_message']='<div class="alert"><i class="icon-exclamation-sign"></i><strong>Your Payment Not Received</strong></div>';
			}
			$data['contain']	 =	$this->upgrade_membership_model->get_pages_contain('payment_page');

			$data['status'] = $this->upgrade_membership_model->get_status($this->session->userdata['logged_ol_member']['usercode']);
			
			//$data['html']	 =	$this->get_html();
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('authorize/public_auth_header');
		//	$this->load->view('authorize/auth_payment_view');
			$this->load->view('upgrade_view',$data);
			$this->load->view('authorize/public_auth_footer');
			$this->load->view('comman/footer');
	 	}
	 
		 
	 
	 function get_html()
	 {
		$result	 =	$this->upgrade_membership_model->check_request_send();
		$data = $this->upgrade_membership_model->getPaymentData();
		//print_r($data); exit();

		$hide_class_html="";
			if(count($data) && ($data[0]['status']=='confirm' || $data[0]['status']=='processed')){
				$hide_class_html='hide-payment-20';
			}
			if($data[0]['status']=='processed' || $data[0]['status']=='confirm'){
				$show_class_html='show-payment-20';
			}
			else{
				$show_class_html='show-payment-hide-20';
			}
		
		$html='';
		if(isset($result[0]))
		{		
			if($result[0]['payment']=='Y')
			{
				$html.='<div class="span3">
				<div class="board-widgets bondi-blue"><div class="board-widgets-content"><span class="n-sources">Payment Receive</span></div>
				<div class="board-widgets-botttom"><a href="#"><i class="icon-double-angle-right"></i></a></div>
				</div></div>';
			}
			else
			{	$html.='<div class="span6 pay_div_cls temp-hide">
				<h3 class="page-header">You can pay for Upgrade Membership by $15:</h3>

				<div class="'.$show_class_html.'"><h3>Payment Successfully Done To Admin</h3></div>
				
				<a class="'.$hide_class_html.'" href="'.base_url().'index.php/monthly_payment_active_member/pay">
					<div class="board-widgets bondi-blue">
					<div class="board-widgets-content"><span class="n-sources">Online Payment</span>
						<p><img src="'.base_url().'asset/images/credit_card_img.gif" /></p>
					
					</div>
				</a>
				
				<div class="board-widgets-botttom">'.$this->pay_btn().'</div>
				</div></div>';
				
				
				
			}		
		}
		
		return $html;
	}
	
	
	protected function pay_btn()
	{ 
		$data = $this->upgrade_membership_model->getPaymentData();
		
		$hide_class_html="";
			if(count($data) && ($data[0]['status']=='confirm' || $data[0]['status']=='processed')){
				$hide_class_html='hide-payment-20';
			}

		$res = $this->upgrade_membership_model->ConfirmPaymentData();
			//$code=$this->session->userdata['logged_ol_member']['usercode'];
			$ref_id = $this->session->userdata['logged_ol_member']['referralid_free'];
		
			$r	=	$this->upgrade_membership_model->get_upling_ref_member($ref_id);
		//echo "<pre>";	print_r($r); exit();
			$stripe_details="";
			if ($r[0]["stripe"]!="") {
				$stripe_details ='<a target="_blank" href="'.$r[0]["stripe"].'">stripe:&nbsp;'.$r[0]["stripe"].'<i class="fa fa-cc-stripe" style="background:#0099ff;"></i></a>';
			}
			
			$square_details="";
			if ($r[0]["square"]!="") {
			$square_details ='<a target="_blank" href="'.$r[0]["square"].'">square:&nbsp;'.$r[0]["square"].'<i class="fa fa-credit-card" style="background:#000;"></i></a>';
			}
			

			$google_wallet="";
			if ($r[0]["payzapay"]!="") {
				$google_wallet 	='<a target="_blank" href="'.$r[0]["payzapay"].'">Google Wallet:&nbsp;'.$r[0]["payzapay"].'<i class="fa fa-google-wallet" style=" background: linear-gradient(to bottom right, #33ccff 16%, #3333ff 46%);"></i></a>';
			}
			

			$facebook="";
			if ($r[0]["facebook"]!="") {
				$facebook ='<a target="_blank" href="'.$r[0]["facebook"].'">facebook:&nbsp;'.$r[0]["facebook"].'<i class="fa fa-facebook-official" style="background:#000099;"></i></a>';
			}
			

			$paypal="";
			if ($r[0]["paypal"]!="") {
				$paypal ='<a target="_blank" href="'.$r[0]["paypal"].'">paypal:&nbsp;'.$r[0]["paypal"].'<i class="fa fa-cc-paypal" style="background: linear-gradient(to right, orange, red);"></i></a>';
			}
			


			$data_payment = array($stripe_details,$square_details,$google_wallet,$facebook,$paypal);


				

			$hide_class="";
			if(count($res) && ($res[0]['type']=='Pending' || $res[0]['type']=='Done')){
				$hide_class='hide-payment-done';
			}
			if($res[0]['type']=='Done' || $res[0]['type']=='Pending'){
				$show_class='show-payment-done';
			}
			else
			{
				$show_class='show-payment-done-hide';
			}
		
		$html='
		<div  class='.$hide_class_html.'>
		<a>Select Payment Gateway For Online Payment ^ <a href="'.base_url().'index.php/monthly_payment_active_member/pay">Square Payment</a>
			<a href="'.base_url().'index.php/online_payment_stripe">Stripe Payment</a>
			</a>
		</div>

		<div class="span6" style="width: 96%;">
    		<div class="primary-head"><h3 class="page-header">You can pay to Affiliate by $30:</h3></div>
    			<div class="'.$show_class.'"><h3>Payment Successfully Done To Affiliate</h3></div>

        	<div class="content-widgets white '.$hide_class.'">
    		<table class="table">
        	<thead>';
        	$htmltr ="";
        			foreach ($data_payment as $key => $value) {
        				
        				if (!empty($value)) {

        					$htmltr =$htmltr."
        	 	<tr>
        	 	
                	<th>".$value."</th>
                </tr>";
        				}
                }
         $html= $html. $htmltr."
               
            </thead>
            	<tbody>
            	</tbody>
        	</table>
        </div>

    </div>
			";
			return $html;
	}
	
	
	
	protected function upgrade_request()
	{
		$now = time();
		$nowdt	=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		$count	=	$this->upgrade_membership_model->check_request_send();
		if(isset($count[0]))
		{
			return;
		}
		
		$data=array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['status']		=	'Active';
		$data['st_view']	=	'N';
		$data['payment']	=	'N';
		$data['timedt']		=	strtotime(date('d-m-Y H:i:s'));
		$this->upgrade_membership_model->addItem($data,'paid_request_master');
		//$this->send_email_friend();
		return;
	
	}
	

	function pay_return()
	{
			
			if($_POST['payment_status']=='Completed' && $_POST['txn_id']!='')
			{
				$info=array();
				$info['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
				$info['timedt']		=	time();	
				$info['txn_id']		=	$_POST['txn_id'];
				$info['option']		=	json_encode($_POST);
				$info['status']		=	$_POST['payment_status'];
				$idcode=$this->upgrade_membership_model->addItem($info,'online_payment');
				
				if($this->session->userdata['logged_ol_member']['status']=='Active')
				{
					$ses_pay=array();
					$ses_pay['txn_id'] 			=	 $_POST['txn_id'];
					$ses_pay['idcode'] 			=	 $idcode;
					$ses_pay['payment_status'] 	=	 'Completed';
					$this->session->set_userdata('ses_pay',$ses_pay);
					header('Location: '.base_url().'/re_payment');
					exit;
				}
				
				//***Product Access Permition Add***//
				$info=array();
				$info['usercode']=$this->session->userdata['logged_ol_member']['usercode'];
				$info['create_by']=$this->session->userdata['logged_ol_member']['usercode'];
				$this->upgrade_membership_model->addItem($info,'product_access_permission');	
				
				$info=array();
				$info['payment']	=	'Y';
				$info['txn_id']		=	$_POST['txn_id'];
				$info['option']		=	json_encode($_POST);
				$this->upgrade_membership_model->update($info,'paid_request_master','usercode',$this->session->userdata['logged_ol_member']['usercode']);
				$this->send_email_paid();
				$data['html']='<h2>Payment Success</h2>';
				
			}
			else{
				$data['html']='<h2>Payment Processing Failed</h2>';
			}
		    $this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('upgrade_notification_view',$data);
			$this->load->view('comman/footer');
	}
	
	
	function payment($id)
	{
		if($id=='cancel')
		{
			$data['html']='<h2>Payment Processing Cancel</h2>';
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('upgrade_notification_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	protected function send_email_friend()
	{
		$arr=array();
		$arr_code=array();
		$code=$this->session->userdata['logged_ol_member']['usercode'];
		while(1){
			$r	=	$this->upgrade_membership_model->get_upling_ref_member($code);
			
			if($r[0]['usercode']=='1'){
				$arr[]=$r[0]['emailid'];
				$arr_code[]=$r[0]['referralid_free'];
				break;	
			}
			if(!isset($r[0])){
				break;
			}
			
			if($r[0]['email_verification']=='Y' && $r[0]['subscribe']=='Y')
			{
				$arr[]=$r[0]['emailid'];
			}
			
			$arr_code[]=$r[0]['referralid_free'];
			
			$code=$r[0]['referralid_free'];
		}
		
		
		// $message='<p><strong>'.$this->session->userdata['logged_ol_member']['fullname'].'</strong></p>';
		// $message.='<p>send to request to upgrade membership</p>';
		$message = get_email_cms_page_master('upgrade-membership-request')->result()[0]->textdt;
		$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);

		$e_array=array("heading"=>"Upgrade Membership Request","msg"=>$message);
		$message=email_template_one($e_array);
		
		$noti_msg		=	$this->session->userdata['logged_ol_member']['fullname'].' is send request to upgrade membership';
		
	
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('Upgrade Membership Request');
		// $this->email->message($message);
		
		for($i=0;$i<count($arr);$i++)
		{
			// $this->email->to($arr[$i]);
			// $this->email->send();
			sendemail(FROM_EMAIL,'Upgrade Membership Request',$arr[$i],$message);
			$this->send_notification($arr_code[$i],$noti_msg);
		}
	
	}
	
	protected function send_notification($code,$msg)
	{
		
		$data=array();
		$data['usercode']		=	$code;
		$data['by_usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']			=	'notification';
		$data['contain']		=	$msg;
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->upgrade_membership_model->addItem($data,'notification_master');
	}
	
	
	function message_to_admin()
	{
		
		$this->load->view('message_to_admin',$data);
	}
	
	function insertrecord_message()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
    		$data['subject']			=	$this->input->post('txtsubject');	
			$data['msg']				=	$this->input->post('txtmsg');
			$data['timedt']				=	$nowdt;	
			$data['sender_code']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['tot_send']			=	'1';
			
			$send_mail_code				=	$this->upgrade_membership_model->addItem($data,'send_mail_master');
			
			$data = array();
			$data['send_mail_code']		=	$send_mail_code;
			$data['receiver_code']		=	'-1';
			$data['receive_status']		=	'N';
			$data['status']				=	'Active';
			$data['send_succes']		=	'T';
			
			$this->upgrade_membership_model->addItem($data,'send_mail_dt');
			
			$admin_email=$this->upgrade_membership_model->get_admin_email();
			
			
			$message='<p><strong>'.$this->session->userdata['logged_ol_member']['fullname'].'</strong></p>';
			$message.='<p>'.$this->input->post('txtmsg').'</p>';
			$message.='<p>Email Id: '.$this->session->userdata['logged_ol_member']['emailid'].'</p>';
			$message.='<p>Username: '.$this->session->userdata['logged_ol_member']['username'].'</p>';
			$message.='<p>Usercode: '.$this->session->userdata['logged_ol_member']['usercode'].'</p>';
			$e_array=array("heading"=>$this->input->post('txtsubject'),"msg"=>$message);
			$message=email_template_one($e_array);
			
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email[0]['emailid']);
			// $this->email->subject($this->input->post('txtsubject'));
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,$this->input->post('txtsubject'),$admin_email[0]['emailid'],$message);
			sendemail(FROM_EMAIL,$this->input->post('txtsubject'),'jasvanthakor18@gmail.com',$message);
			
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Request sent successfully!</div>'); 
		}
		header('Location: '.base_url().'index.php/enroll');
		exit;
	}
	
	
	protected function send_email_paid()
	{
		$admin_email=$this->upgrade_membership_model->get_admin_email();
		$arr		=	array();
		$arr_code	=	array();
		$arr_code[]	=	'-1';
		$arr[]		=	$admin_email[0]['emailid'];
		
		$code=$this->session->userdata['logged_ol_member']['usercode'];
		while(1){
			$r	=	$this->upgrade_membership_model->get_upling_ref_member($code);
			
			if($r[0]['usercode']=='1'){
				$arr[]=$r[0]['emailid'];
				$arr_code[]=$r[0]['referralid_free'];
				break;	
			}
			if(!isset($r[0])){
				break;
			}
			
			if($r[0]['email_verification']=='Y' && $r[0]['subscribe']=='Y'){
				$arr[]=$r[0]['emailid'];
			}
			
			$arr_code[]=$r[0]['referralid_free'];
			$code=$r[0]['referralid_free'];
		}
		
		
		// $message='<p><strong>'.$this->session->userdata['logged_ol_member']['fullname'].'</strong></p>';
		// $message.='<p>Paid For Upgrade Membership </p>';
		$message = get_email_cms_page_master('paid-membership')->result()[0]->textdt;
		$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
		
		$e_array=array("heading"=>"Paid For Upgrade Membership","msg"=>$message);
		$message=email_template_one($e_array);
		
		$title	  =	'Affiliworx Paid Membership';
		$subject  =	'Paid Membership';

		$noti_msg		=	$this->session->userdata['logged_ol_member']['fullname'].' is paid for upgrade membership';
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('Paid Membership');
		// $this->email->message($message);
		
		for($i=0;$i<count($arr);$i++)
		{	
			// $this->email->to($arr[$i]);
			// $this->email->send();
			
			sendemail(FROM_EMAIL,'Paid Membership',$arr[$i],$message);
			$this->send_notification($arr_code[$i],$noti_msg);
		}
	}
	
	
	function check_member_pending()
	{
		if($this->session->userdata['logged_ol_member']['status']!='Pending'){
			header('Location: '.base_url());
			exit;
		}
	}
	
	//============================================== Authorize Net Make Transaction single payment ========================================================
    public function makeTransaction(){
	 $reponseType="";
	 $message="";
	  require_once 'authorize/AuthorizeNetPayment.php';
	  $authorizeNetPayment = new AuthorizeNetPayment();
	  $response = $authorizeNetPayment->chargeCreditCard($_POST);
	  if($response!=null){
		$tresponse = $response->getTransactionResponse();

		if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
		{
			$authCode = $tresponse->getAuthCode();
			$paymentResponse = $tresponse->getMessages()[0]->getDescription();
			$reponseType = "Success";
			$message = "Payment Completed Successfully. Your Transaction ID is : " . $tresponse->getTransId() ;
			$_POST["paytype"]="Credit Card";
			$_POST["date"]=date("Y-m-d H:i:s");
			$_POST["transcode"]=$tresponse->getTransId();
			$this->payByCC($_POST);
		}        
		else    {
			$authCode = "";
			$paymentResponse = $tresponse->getErrors()[0]->getErrorText();
			$reponseType = "Failed";
			$message = "Unable to Complete Your Payment Request. ".$paymentResponse;
		}
	 
	  }else{
		$reponseType = "Failed";
		$message= "Unable to Complete Your Payment Request.";
	  }
	  $data["reponseType"]=$reponseType;
	  $data["message"]=$message;

	  echo json_encode($data);
	} 	
///update database and send email on successful transaction
	public function payByCC($orderDetails)
	{
	    
		$data	=	array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']		=	'payment_confirm';
		$data['subject']	=	'Payment Confirmation';
		$data['msg']		=	'Payment Type : '.$orderDetails['paytype'].'<br> Amount : '.$orderDetails['amount'].'<br> Date : '.$orderDetails['date'].'<br> Transaction Code: '.$orderDetails['transcode'];
		$data['timedt']		=	date('Y-m-d h:i:s');
		$this->ObjM->addItem($data,'admin_message');
		//
		if($orderDetails['amount']>0){
		    	

			$data=array();
			$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['status']		=	'Active';
			$data['st_view']	=	'N';
			$data['payment']	=	'Y';
			$data['type']	=	$orderDetails['paytype'];
			$data['amount']	=	$orderDetails['amount'];
			$data['txn_id']	=	$orderDetails['transcode'];
			$data['payment_dt']		=	date('Y-m-d H:i:s',strtotime($orderDetails['date']));
			$data['timedt']		=	strtotime(date('d-m-Y H:i:s'));
			$this->ObjM->addItem($data,'paid_request_master');
			 $confirm = array();
    	    $confirm['confirm'] 	= 	'Y';
			$this->ObjM->update($confirm,'paid_request_master','usercode',$data['usercode']);
		
		}
			$this->send_email_friend();
		
		$this->session->set_flashdata('show_msg', 'Payment Completed Successfully');
	
	//	header('Location: '.base_url().'index.php/');
	//	exit;
    }
	
	
	
}//class