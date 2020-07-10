<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class facebook_stripe_payment_100 extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		 $this->load->model('facebook_stripe_payment_100_model','ObjM',TRUE);

		 require_once(FCPATH."application/libraries/payment_getway/init.php");
		 //$this->load->library('init');
		 // $this->load->library('payment_getway/tests');
		 // $this->load->library('payment_getway/oauth');
 	}
	
	public function index()
	{
		$data['cms']=$this->ObjM->get_pages_contain('facebook_payment_100');
		//print_r($data); exit();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('facebook_stripe_payment_100_view',$data);
		$this->load->view('comman/footer');
	

	}

	function insertrecord()
	{
			$data['card_exp_month']	 =	$this->input->post('card_exp_month');	
			$data['card_exp_year']	 =	$this->input->post('card_exp_year');	
		   	$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		   	$data['email']	=	$this->session->userdata['logged_ol_member']['emailid'];
		   	
		   	$data['amount']=$this->input->post('amount');
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
		  
		   //$res['amount'] = $this->ObjM->getFacebookAmount();
		   //print_r($res); exit();
		   $Amount_tmp = $this->input->post('amount');
		   $Amount=0;
		   foreach ($Amount_tmp as $key => $value) {
		   	$Amount+=$value;
		   }
		   
		   $orderNo = 'OR1001';
		   $itemNo = 'IN1001';

				    //item information
		    $itemName = "Facebook Ads Pack Payment";
		    $itemNumber = $itemNo;
		    $itemPrice = $Amount;
		    $currency = "USD";
		    $orderID = $orderNo;
		    
		    //charge a credit or a debit card
		    $charge = \Stripe\Charge::create(array(
		        'customer' => $customer->id,
		        'amount'   => $itemPrice*100,
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

	   	 	    
		    //print_r($chargeJson); 

	    //check whether the charge is successful
	    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1 && $chargeJson['amount']==$Amount*100){
	    	foreach ($Amount_tmp as $key => $value) {
	    		//order details 
		        $data['amount'] = $value;
		        $data['balance_transaction'] = $chargeJson['balance_transaction'];
		        $data['currency'] = $chargeJson['currency'];
		        //$data['status'] = $chargeJson['status'];
		        $data['status'] = 'Confirm';
		        $data['type'] = 'Stripe';
		        $data['timedt'] = date("Y-m-d H:i:s");
		        //$this->ObjM->addItem($data,"facebook_payment_stripe");
	    		$this->ObjM->addItem($data,"tl_member_payment");
	    	}
	    }


	    	$this->session->set_flashdata('show_msg', 'Facebook Ads Pack Payment Done!');

		    echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
			exit;
	}

}