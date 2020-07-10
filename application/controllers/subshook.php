<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//===========================Lilsten to Transactions from authorize.net and activates or deactivates the capture pages subscription==============================
class subshook extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //For live and real transactions
        $this->login = "68fSbphD7TC";
        $this->transactionKey = "28a97x9nQu3X3YAt";
        $this->signature = "7D0C40C18113EAE289D064833EAB7F8EB74E4690725FDB6735D9EC726DF92E183EE84A05CAF96A8A977A052DDC13B0F8945B0603D3E69F93B5E2A624B075341B";
       //sandbox
        // $this->transactionKey = "4VcyQ82Y5gtRL568"; // Transaction Key
        // $this->login = "53h4vACf"; //Login Key
        // $this->signature = "9733C3055D798F0F9128274731150F0345E201D74119BFFE41FBD0126A2CD613A5A3E47D6C0AABB6085C6FCE93CA34EBDB0FB389AD2F729A0478CAB555D20DBD"; // Signature key

        $this->headers = $this->getAllHeaders();
        $this->headers = array_change_key_case($this->headers, CASE_UPPER);
        $this->load->model('subshook_model', 'objM', true);
        //-------------------------API Live URL-----------------------------
         $this->url = 'https://api.authorize.net/xml/v1/request.api';
        //-----------------------API Sandbox URL----------------------------
        // $this->url = 'https://apitest.authorize.net/xml/v1/request.api';

    }
    public function index()
    {
        //----- For Debugging -----
        $fileheader = "./authorize_logs/header_dump.txt";
        $file = "./authorize_logs/postResponse.txt";
        $fileError ="./authorize_logs/error.txt";
        $this->webhookJson = file_get_contents("php://input");
        if ($this->isValid()) {
            $this->webhook = json_decode($this->webhookJson);
            $req_dump = print_r($this->webhook, true);
            file_put_contents($fileheader, "Transaction ID: " . $this->webhook->payload->id . " \n POST Data" . $req_dump); // dump into a txt file
            //Send Post request to get more information about the transaction
            $authentication = [
                'merchantAuthentication' => [
                    'name' => $this->login,
                    'transactionKey' => $this->transactionKey,
                ],
            ];
            $call = [];
            $call = array('transId' => $this->webhook->payload->id);
            $parameters = [
                "getTransactionDetailsRequest" => $authentication + $call,
            ];
            $payload = json_encode($parameters);
            //Send Curl Request to server
            $result = $this->curl_request($payload);
               $result=substr($result,3);//removing bad characters
           $result=json_decode($result);
            $data_dump = print_r($result, true);
            file_put_contents($file, $data_dump); // dump latest request in a file
            //if the transaction is for subscription
            if ( $result->messages->resultCode == "Ok") {
                if ($result->transaction->recurringBilling) {
                    $subs_id = $result->transaction->subscription->id; // get subscription id

                    /* payNum: Identifies the number of this transaction, in
                    terms of how many transactions have been submitted for
                    this subscription.For example, the third transaction
                    processed for this subscription will return payNum set to 3.*/
                    $pay_num = $result->transaction->subscription->payNum;
                    if ($pay_num == 1) {
                        $this->objM->activate_subscription($subs_id);
                    } else {
                        $this->objM->activate_subscription($subs_id); // activate subscription if its inactive
                        $this->objM->calculate_commision($subs_id); // calculate commission
                    }
                } else {
                    file_put_contents($fileError, "This is not a recurring transaction");
                }

            } else {
                file_put_contents($fileError, "Invalid Response :" . $result->messages->message->code . "  " . $result->messages->message->text);
            }

        } else {
            file_put_contents($fileError, "Request is not from valid source");
        }

    }
    public function curl_request($payload)
    {
        //create a new cURL resource
        $ch = curl_init($this->url);
        //attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 curl_setopt($ch, CURLOPT_HEADER, false);
        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //execute the POST request
        $result = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        return $result;
    }
    // check if the request is from valid source or not
    public function isValid()
    {
        $hashedBody = strtoupper(hash_hmac('sha512', $this->webhookJson, $this->signature));
        return (isset($this->headers['X-ANET-SIGNATURE']) && strtoupper(explode('=', $this->headers['X-ANET-SIGNATURE'])[1]) === $hashedBody);
    }

    protected function getAllHeaders()
    {
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            $headers = array_filter($_SERVER, function ($key) {
                return strpos($key, 'HTTP_') === 0;
            }, ARRAY_FILTER_USE_KEY);
        }
        return $headers;
    }
    public function cancelSubscription()
    {
  //----- For Debugging -----
        $fileheader = "./authorize_logs/cancel_sub_header_dump.txt";
        $file = "./authorize_logs/cancel_sub_postResponse.txt";
        $fileError ="./authorize_logs/cancel_sub_error.txt";
        $this->webhookJson = file_get_contents("php://input");
        if ($this->isValid()) {
            $this->webhook = json_decode($this->webhookJson);
            $req_dump = print_r($this->webhook, true);
            file_put_contents($fileheader, "Transaction ID: " . $this->webhook->payload->id . " \n POST Data" . $req_dump); // dump into a txt file
            //Send Post request to get more information about the transaction
            $authentication = [
                'merchantAuthentication' => [
                    'name' => $this->login,
                    'transactionKey' => $this->transactionKey,
                ],
            ];
            $subs_id=$this->webhook->payload->id;
            $call = [];
            $call = array('subscriptionId' => $this->webhook->payload->id);
            $parameters = [
                "ARBGetSubscriptionRequest" => $authentication + $call,
            ];
            $payload = json_encode($parameters);
            //Send Curl Request to server
            $result = $this->curl_request($payload);
            $result=substr($result,3);//removing bad characters
           $result=json_decode($result);
            $data_dump = print_r($result , true);
            file_put_contents($file, $data_dump); // dump latest request in a file
            //if the transaction is for subscription
            if ( $result->messages->resultCode == "Ok") {
                $subs_name="Capture Page Subscription";
                $res_subs_name=$result->subscription->name;
                if($subs_name==$res_subs_name){
                    $this->objM->deactivate_subscription($subs_id);
                }

            } else {
                file_put_contents($fileError, "Invalid Response :" . $result->messages->message->code . "  " . $result->messages->message->text);
            }

        } else {
            file_put_contents($fileError, "Request is not from valid source");
        }


    }
     function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }
}
?>