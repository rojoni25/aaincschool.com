<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeNetPayment
{

    private $APILoginId;
    private $APIKey;
    private $refId;
    private $merchantAuthentication;
    public $responseText;


    public function __construct()
    {
        //For live and real transactions
        $this->APILoginId = "68fSbphD7TC";
        $this->APIKey = "28a97x9nQu3X3YAt";
        //For sandbox testing 
        // $this->APILoginId = "53h4vACf";
        // $this->APIKey = "4VcyQ82Y5gtRL568";
        $this->refId = 'ref' . time();
        $this->merchantAuthentication = $this->setMerchantAuthentication();
        $this->responseText = array("1"=>"Approved", "2"=>"Declined", "3"=>"Error", "4"=>"Held for Review");
    }

    public function setMerchantAuthentication()
    {
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->APILoginId);
        $merchantAuthentication->setTransactionKey($this->APIKey);  
        return $merchantAuthentication;
    }
    
    public function setCreditCard($cardDetails)
    {
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardDetails["cardnumber"]);
        $creditCard->setExpirationDate( $cardDetails["expirydate"]);
        $creditCard->setCardCode($cardDetails['ccode']);
        $paymentType = new AnetAPI\PaymentType();
        $paymentType->setCreditCard($creditCard);
        
        return $paymentType;
    }
    
    public function setTransactionRequestType($paymentType,$billTo, $amount)
    {
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentType);
        $transactionRequestType->setBillTo($billTo);
        
        return $transactionRequestType;
    }
/// charge card for one time payment
    public function chargeCreditCard($cardDetails)
    {
        $paymentType = $this->setCreditCard($_POST);
        $billTo = $this->setBillingDetails($_POST);
        $transactionRequestType = $this->setTransactionRequestType($paymentType,$billTo ,$_POST["amount"]);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($this->merchantAuthentication);
        $request->setRefId( $this->refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        return $response;
    }
    public function setBillingDetails($billingDetails){
        // Preparin customer information object
		$billto = new net\authorize\api\contract\v1\CustomerAddressType();
		$billto->setFirstName($_POST['fname']);
		$billto->setLastName($_POST['lname']);
		$billto->setAddress($_POST['address']);
		$billto->setCity($_POST['city']);
		$billto->setCountry($_POST['country']);
		$billto->setZip($_POST['zipcode']);
	return $billto;
    }
    //==================Create a recurring payment subscription for capture pages===========================
     public function createSubscription($cardDetails,$intervalLength)
    {
       
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($this->merchantAuthentication);
        $merchantAuthentication=$this->merchantAuthentication;
        // Set the transaction's refId
        $refId = $this->refId;
        // Subscription Type Info
        $subscription = new AnetAPI\ARBSubscriptionType();
        $subscription->setName("Capture Page Subscription");
        $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
        $interval->setLength($intervalLength);
        $interval->setUnit("days");
        $paymentSchedule = new AnetAPI\PaymentScheduleType();
        $paymentSchedule->setInterval($interval);
        $paymentSchedule->setStartDate(new DateTime(date('Y-m-d')));
        $paymentSchedule->setTotalOccurrences("9999");
         
        $subscription->setPaymentSchedule($paymentSchedule);
        $subscription->setAmount($_POST["amount"]);
        $paymentType = $this->setCreditCard($_POST);
        $subscription->setPayment($paymentType);
        $billTo = $this->setBillingDetails($_POST);
        $subscription->setBillTo($billTo);
        $request = new AnetAPI\ARBCreateSubscriptionRequest();
        $request->setSubscription($subscription);
        $request->setmerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $controller = new AnetController\ARBCreateSubscriptionController($request);
        $responsesub = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        return $responsesub;
       
       
    }
}
    ?>