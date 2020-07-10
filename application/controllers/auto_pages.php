<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auto_pages extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->model('pages_module','ObjM',TRUE);
   		// error_reporting(E_ALL);
		require FCPATH . 'application/libraries/squareup/vendor/autoload.php';
 	}
	
	public function page()
	{ //error_reporting(E_ALL);
		$data['cms']=$this->ObjM->get_pages_contain('payment_info_multi_top_video');	
		
		//$data['result']=$this->ObjM->get_pages_contain($this->uri->segment(3));

		 $data['applicationId'] = $this->config->item('squareUp_applicationId');
         $data['locationId'] = $this->config->item('squareUp_locationId');
         $data['access_token'] = $this->config->item('squareUp_access_token');
		// if(!isset($data['result'][0])){
		// 	$data['result']=$this->ObjM->get_pages_contain('not_found');
		// }
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('auto_pages_view',$data);
		$this->load->view('comman/footer');
	}
	public function make()
	{
		$access_token = $this->config->item('squareUp_access_token');

        # Helps ensure this code has been reached via form submission
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        error_log("Received a non-POST request");
        echo "Request not allowed";
        http_response_code(405);
        return;
        }

        # Fail if the card form didn't send a value for `nonce` to the server
        $nonce = $_POST['nonce'];
        if (is_null($nonce)) {
        echo "Invalid card data";
        http_response_code(422);
        return;
        }

        \SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
        $locations_api = new \SquareConnect\Api\LocationsApi();
        
        try {
        $locations = $locations_api->listLocations();
        # We look for a location that can process payments
        $location = current(array_filter($locations->getLocations(), function($location) {
            $capabilities = $location->getCapabilities();
            return is_array($capabilities) &&
            in_array('CREDIT_CARD_PROCESSING', $capabilities);
        }));
        
        } catch (\SquareConnect\ApiException $e) {
            echo "Caught exception!<br/>";
            print_r("<strong>Response body:</strong><br/>");
            echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            echo "<br/><strong>Response headers:</strong><br/>";
            echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
            exit(1);
        }

        $transactions_api = new \SquareConnect\Api\TransactionsApi();

        $res['amount'] = $this->ObjM->getSoftwareLicenseAmount();
		   $Amount = abs($res['amount']['setting_value'])*100;

        # To learn more about splitting transactions with additional recipients,
        # see the Transactions API documentation on our [developer site]
        # (https://docs.connect.squareup.com/payments/transactions/overview#mpt-overview).
        $request_body = array (

        "card_nonce" => $nonce,

        # Monetary amounts are specified in the smallest unit of the applicable currency.
        # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
        "amount_money" => array (
            "amount" => $Amount,
            "currency" => "USD"
        ),

        # Every payment you process with the SDK must have a unique idempotency key.
        # If you're unsure whether a particular payment succeeded, you can reattempt
        # it with the same idempotency key without worrying about double charging
        # the buyer.
        "idempotency_key" => uniqid()
        );

        # The SDK throws an exception if a Connect endpoint responds with anything besides
        # a 200-level HTTP code. This block catches any exceptions that occur from the request.
        try {
            $result = $transactions_api->charge($location->getId(), $request_body);
            $transaction['usercode'] = $this->session->userdata['logged_ol_member']['usercode'];
            $transaction['squaer_id'] = $result->getTransaction()->getTenders()[0]->getId();
            $transaction['location_id'] = $result->getTransaction()->getTenders()[0]->getLocationId();
            $transaction['transaction_id'] = $result->getTransaction()->getTenders()[0]->getTransactionId();
            $transaction['paydate'] = $result->getTransaction()->getTenders()[0]->getCreatedAt();
            $transaction['note'] =  $result->getTransaction()->getTenders()[0]->getNote();
            $transaction['amount'] =  $result->getTransaction()->getTenders()[0]->getAmountMoney()->getAmount();
            $transaction['currency'] =  $result->getTransaction()->getTenders()[0]->getAmountMoney()->getCurrency();
            $transaction['status'] = 'Confirm';
            $transaction['type'] = 'square';
            if($this->ObjM->addItem($transaction,'payment_gateway_stripe')){
            	$this->session->set_flashdata('show_msg', 'SquareUp Payment Done!');
            	echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
			exit;
            }
        } catch (\SquareConnect\ApiException $e) {
            echo "Caught exception!<br/>";
            print_r("<strong>Response body:</strong><br/>");
            echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            echo "<br/><strong>Response headers:</strong><br/>";
            echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
        }
	}
	
	function send_msg_from($type){
		echo '<div class="pop-div-main"><form method="post" action="'.base_url().'index.php/'.$this->uri->segment(1).'/send_msg" id="send_msg_to_admin_from">
				<input type="hidden" name="type" value="'.$type.'">
				<table class="table">
					<tr><td><h5>Message To Admin</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter Message" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	function payment_confirm_from_viral($type){
		echo '<div class="pop-div-main"><form method="post" action="'.base_url().'index.php/'.$this->uri->segment(1).'/send_msg" id="send_msg_to_admin_from">
				<input type="hidden" name="type" value="'.$type.'">
				<table class="table">
					<tr><td><h5>Message To Admin</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter Message" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	
	function send_msg(){
		$data	=	array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']		=	$_POST['type'];
		$data['subject']	=	$_POST['subject'];
		$data['msg']		=	$_POST['msg'];
		$data['timedt']		=	date('Y-m-d h:i:s');
		$this->ObjM->addItem($data,'admin_message');
		
		$arr=array('msg'=>'<h5>Send Successfully</h5>');
		echo json_encode($arr);
		exit;
	}
	
	function payment_confirm_from($type){
		
		echo '<div class="pop-div-main"><form method="post" action="'.base_url().'index.php/'.$this->uri->segment(1).'/send_msg" id="send_msg_to_admin_from">
				<input type="hidden" name="type" value="'.$type.'">
				<table class="table">
					<tr><td><h5>Payment Confirmation</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter your payment transaction details" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	
	
}


