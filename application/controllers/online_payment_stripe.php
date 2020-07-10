<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class online_payment_stripe extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		 $this->load->model('online_payment_strip_model','ObjM',TRUE);

		 require_once(FCPATH."application/libraries/payment_getway/init.php");
		 //$this->load->library('init');
		 // $this->load->library('payment_getway/tests');
		 // $this->load->library('payment_getway/oauth');
 	}
	
	public function index()
	{
		$data['cms']=$this->ObjM->get_pages_contain('payment_info_multi_top_video');
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('online_payment_stripe',$data);
		$this->load->view('comman/footer');
	

	}

	function insertrecord()
	{
			$data['card_exp_month']	 =	$this->input->post('card_exp_month');	
			$data['card_exp_year']	 =	$this->input->post('card_exp_year');	
		   	$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		   	$data['email']	=	$this->session->userdata['logged_ol_member']['emailid'];
		   	
		   	$data['stripe_id']=$this->input->post('stripe_id');
		    $data['name']=$this->input->post('name');
		    $data['address'] =$this->input->post('address');
		    $data['country'] =$this->input->post('country');
		    // $user_data = array('username' => $name, 'address' => $address, 'country' => $country);
		    $token =	$this->input->post('stripeToken');

		    $secret_key =  $this->config->item('secret_key');
		   	$publishable_key = $this->config->item('publishable_key');

		     \Stripe\Stripe::setApiKey($secret_key);
    
		    //add customer to stripe
		    $customer = \Stripe\Customer::create(array(
		        'email' => $data['email'],
		        'source'  => $token
		       
		    ));
		  
		   $res['amount'] = $this->ObjM->getSoftwareLicenseAmount();
		   $Amount = round($res['amount']['setting_value'])*100;
		   
		   $orderNo = 'OR1001';
		   $itemNo = 'IN1001';

				    //item information
		    $itemName = "Software License Upgrade";
		    $itemNumber = $itemNo;
		    $itemPrice = $Amount;
		    $currency = "USD";
		    $orderID = $orderNo;
		    
		    //charge a credit or a debit card
		    $charge = \Stripe\Charge::create(array(
		        'customer' => $customer->id,
		        'amount'   => $itemPrice,
		        'currency' => $currency,
		        'description' => $itemName,
		        'metadata' => array(
		            'order_id' => $orderID
		           
		        ),
		    ));
		    
		    //retrieve charge details
		    $chargeJson = $charge->jsonSerialize();
		
		     //retrieve charge details
	   	 $chargeJson = $charge->jsonSerialize();
	   	 //$data['payment_data']=serialize($chargeJson);
	   	 
	    //check whether the charge is successful
	    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1 && $chargeJson['amount']==$Amount){
	        //order details 
	        $data['amount'] = $chargeJson['amount'];
	        $data['balance_transaction'] = $chargeJson['balance_transaction'];
	        $data['currency'] = $chargeJson['currency'];
	        //$data['status'] = $chargeJson['status'];
	        $data['status'] = 'Confirm';
	        $data['type'] = 'stripe';
	        $data['paydate'] = date("Y-m-d H:i:s");
	    }
	    	$this->ObjM->addItem($data,"payment_gateway_stripe");
	    	$this->session->set_flashdata('show_msg', 'Stripe Payment Done!');

		    echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
			exit;
	}

}