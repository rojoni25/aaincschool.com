<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cornjob_payment_status extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_daily_model','',TRUE); 
 	}

	public function index()
	{
		// $this->cornjob_daily_model->check_payment_status();
		// exit;


		// $result = $this->cornjob_daily_model->check_date();
		
		// $package_amt=$this->cornjob_daily_model->get_package_amt();

		// foreach ($result as $key => $value) 
		// {
		// 	$usercode= $value['usercode'];
			
		// 	$due_time =$value['due_time'];

		// 	$amount = $this->cornjob_daily_model->get_ammount_master_balance_sheet($usercode);
			
		// 	$balance =	$amount[0]['main_balance']-CW_MIN;

			

		// 	if ($balance > CW_MIN) 
		// 	{
		// 		$this->db->query("update master_balance_sheet set main_balance=$balance where usercode=$usercode");

		// 		$effectiveDate = strtotime(date('Y-m-d',$due_time)." +1 months");
				
		// 		$this->db->query("update membermaster set due_time=$effectiveDate where usercode = $usercode");

		// 	}
		// 	else
		// 	{
		// 		$this->db->query("update membermaster set status='Inactive' where usercode=$usercode");
				
		// 	}


		// for software license referral member 

		$payment = $this->cornjob_daily_model->getPaymentValue();

		$result = $this->cornjob_daily_model->check_date();
    	
		
		foreach ($result as $key => $value) 
		{
			$usercode= $value['usercode'];
			
			$due_time =$value['due_time'];

			$amount = $this->cornjob_daily_model->get_ammount_master_balance_sheet($usercode);
			
			$balance =	$amount[0]['main_balance']-$payment;
			

			if ($balance > $payment) 
			{
				
				$a = $this->db->query("update master_balance_sheet set main_balance=$balance where usercode=$usercode");

				$effectiveDate = strtotime(date('Y-m-d',$due_time)." +1 months");
				
				$this->db->query("update membermaster set due_time=$effectiveDate where usercode = $usercode");

			}
			else
			{
				$this->db->query("update membermaster set status='Inactive' where usercode=$usercode");
				
			}

			
		}

		// error_reporting(E_ALL);
		// $this->load->model('monthly_payment_active_online_module','',TRUE);
		
		// $result = $this->cornjob_daily_model->check_payment_status();
		// $package_amt=$this->cornjob_daily_model->get_package_amt();
		// foreach ($result as $key => $value) {
		// 	$usercode= $value['usercode'];
		// 	$member_info = $this->cornjob_daily_model->get_member_info($usercode);
		// 	if(isset($member_info[0]) && $package_amt!='' && $package_amt>0){
		// 		echo "Charging #$usercode";
		// 		$authzToken = $this->config->item('squareup_access_token');
		// 		$locationId = $this->config->item('squareup_location');

		// 		// Create and configure a new API client object
		// 		$defaultApiConfig = new \SquareConnect\Configuration();
		// 		$defaultApiConfig->setAccessToken($authzToken);
		// 		$defaultApiClient = new \SquareConnect\ApiClient($defaultApiConfig) ;

		// 		// Create a LocationsApi client to load the location ID
		// 		$locationsApi = new SquareConnect\Api\LocationsApi($defaultApiClient);




		// 		$buyerInfo = array();
		// 		$buyerInfo['buyer_email_address'] = $value['emailid'];

		// 		$idempotencyKey = uniqid();

		// 		$paymentInfo = array();
		// 		$paymentInfo['idempotency_key'] = $idempotencyKey;
		// 		$paymentInfo['amount_money'] = array('amount' => ($package_amt*100), 'currency' => "USD");
		// 		$paymentInfo['customer_id'] = $member_info[0]['squareup_cust_id'];
		// 		$paymentInfo['customer_card_id'] = $member_info[0]['squareup_cof_id'];

		// 		$referenceIfo = array();
		// 		$referenceIfo['reference_id'] = '#'.$usercode.'-'.strtotime(date('Y-m-d H:i:s'));
		// 		$referenceIfo['note'] = 'A useful note about this transaction';

		// 		$txRequest = array_merge(
		// 		  $buyerInfo,
		// 		  $paymentInfo,
		// 		  $referenceIfo
		// 		);

		// 		$transactionsApi = new \SquareConnect\Api\TransactionsApi($defaultApiClient);

		// 		try {

		// 		  $result = $transactionsApi->charge($locationId, $txRequest);

		// 		  $am=$result->getTransaction()->getTenders()[0]->getAmountMoney();
		// 		  $charged_amt=$am->getAmount();
		// 		  if($charged_amt==((int) $package_amt*100)){

		// 		  $am=$result->getTransaction()->getTenders()[0]->getAmountMoney();
		//   $str_all="ID: ".$result->getTransaction()->getTenders()[0]->getId()."\n".
		//   "Location ID: ".$result->getTransaction()->getTenders()[0]->getLocationId()."\n".
		//   "Transaction ID: ".$result->getTransaction()->getTenders()[0]->getTransactionId()."\n".

		//   "Created At: ".$result->getTransaction()->getTenders()[0]->getCreatedAt()."\n".
		//   "Note: ".$result->getTransaction()->getTenders()[0]->getNote()."\n".
		//   "Amount (in cent): ".$am->getAmount()."\n".
		//   "Currency: ".$am->getCurrency();

		// 	 	$data = array();
		// 		$data['payment'] 	= 	'Y';
		// 		$data['payment_dt'] = 	time();
		// 		$data['usercode']	=	$usercode;
		// 		$data['status']		= 	'Active';
		// 		$data['st_view']	= 	'N';
		// 		$data['timedt']		= 	strtotime(date('Y-m-d'));
		// 		$data['txn_id']		= 	$result->getTransaction()->getTenders()[0]->getTransactionId();
		// 		$data['payment_dt']	= 	date('Y-m-d H:i:s');
		// 		$data['option']		= 	$str_all;

		// 		$this->monthly_payment_active_online_module->add_payment($data);

		// 		$data = array();
		// 		$data['usercode'] 	= 	$this->uri->segment(3);
		// 		$data['timedt'] 	= 	time();	
		// 		$data['create_by'] 	= 	$usercode;
		// 		$this->monthly_payment_active_online_module->addItem($data,'product_access_permission');

		// 		}

		// 		redirect(base_url().'index.php/upgrade_membership/view');


		// 		} catch (\SquareConnect\ApiException $e) {
		// 		  echo "<hr>" .
		// 		       "The SquareConnect\Api\TransactionsApi object threw an exception.<br>" .
		// 		       "API call: <code>TransactionsApi->charge</code>" .
		// 		       "<pre>" . var_dump($e) . "</pre>";
		// 		  throw $e;
		// 		}

		// 	} else{
		// 		$this->cornjob_daily_model->inactive_member($usercode);
		// 	}
		// }
	}
}