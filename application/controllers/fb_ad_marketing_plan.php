<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fb_ad_marketing_plan extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
   		$loginusercode=$this->session->userdata['logged_ol_member']['usercode'];
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('fb_ad_marketing_plan_model','objM',TRUE);
	    $this->load->model('user_model','',TRUE);
		$this->load->library('email');
   		
 	}
 	
	public function index()
	{

	    require("stripe/stripe-config.php");
	   $page= $this->objM->get_pages_contain("fb_ads_marketing_plan");
	  
		$data["cms"] = $page;
		$data["stripe"]=$stripe;
		$this->load->view('comman/topheader.php');
		$this->load->view('comman/header.php');
		$this->load->view('fb_ad_marketing_plan_view',$data);
		$this->load->view('comman/footer.php');
		$this->send_email_up();
	}
	
		function create_subscription(){
	   
	   require("stripe/stripe-config.php");
	   
if(isset($_POST['stripeToken'])){
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
    $amount=6900;
  $plan = \Stripe\Plan::create(array(
      "product" => [
          "name" => "Social Media Marketing"
            ],
      "nickname" => "Social Media Marketing Ads",
      "interval" => "month",
      "interval_count" => "1",
      "currency" => "usd",
      "amount" => $amount,
  ));
/*
  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);
*/
// ------------ Get user details from db  :: smh --------------
           $usercode=$this->session->userdata['logged_ol_member']['usercode'];
         $user_array=  $this->objM->get_user($usercode);
           $user_name=$user_array[0]['fname']." ".$user_array[0]['lname'];
           $description="Usercode: ".$usercode;
          $customer = \Stripe\Customer::create([
              'email' => $email,
              'source'  => $token,
              'name'=>$user_name,
              'description'=>$description
          ]);
          
          // ------------ End :: Get user details from db  :: smh --------------
   $subscription = \Stripe\Subscription::create(array(
      "customer" => $customer->id,
      "items" => array(
          array(
              "plan" => $plan->id,
          ),
      ),
  ));
   if($subscription->status=="active"){
   $tbl_name="tbl_susbscribed_plans";
   $usercode=$this->session->userdata['logged_ol_member']['usercode'];
   $referralid=$this->session->userdata['logged_ol_member']['ref_by'];
    // Get subscription data from subscription object returned from stripe
    $sub_id=$subscription->id;
    $s_date=date("Y-m-d H:i:s",$subscription->current_period_start);// current subscription started date
    $e_date=date("Y-m-d H:i:s",$subscription->current_period_end);
    $c_date=date("Y-m-d H:i:s");// subscription created date
    $data=array("usercode"=>$usercode,"subscription_id"=>"$sub_id","subscription_title"=>"Social Media Marketing Ads","start_date"=>$s_date,"end_date"=>$e_date,"status"=>"Pending"
    ,"created_date"=>$c_date);
    $this->objM->addItem($data,$tbl_name);// store subscription details in database
    
    //--------------------  show thank you pro marketer here :: smh
    
    // ------------------ Email notification :: smh ---------------------
            // 
            // payment detail (customer name, email, amount , date)
            $net_amount=($amount/100);
            $customer_detail="<h2> Payment Detail</h2> <strong>Customer Name: </strong>".$customer->name."<br><strong>Email: </strong>".$email."<br><strong>Amount:</strong> $".$net_amount."<br><strong> Date: </strong>".$c_date;
            $this->send_subscription_confirmation_email($usercode,$customer_detail);
            // ------------------ End :: Email notification :: smh ---------------------
    
     $this->show_thank_you();
   }else{
        echo "<h2>Subscription Failed Contact WebMaster</h2> <a href=".base_url()."index.php/welcome> Go Back</a>";
        exit;
   }
}
	}
	
//=============Show thank you page on successful subscription========================
    function show_thank_you(){
        	  $login_usercode=$this->session->userdata['logged_ol_member']['usercode'];
        	  
        	   $page_content=$this->objM->get_pages_contain("pro_marketers_thank_you");
        	   
        	    $data['cms']=$page_content;
        		$this->send_email_to_all_ref($login_usercode);
                 $this->load->view('comman/topheader.php');
        		$this->load->view('comman/header.php');
        		$this->load->view('fb_plan_thank_you_view',$data);
        		$this->load->view('comman/footer.php');
	
    }
    
    function send_email_to_all_ref($usercode){
       
        $email_content=$this->objM->get_pages_contain("pro_marketers_successful_subscription_email");
	   $login_usercode=$usercode;
	   $user=$this->objM->get_user($login_usercode);
	   $user_email=$user[0]["emailid"];
	   $ref_usercode=$user[0]["referralid_free"];
	
	   if($ref_usercode==0){
	       return;
	   }else{
	          $ref_user=$this->objM->get_user($ref_usercode);
	   	   $ref_email=$ref_user[0]["emailid"];
	        $email_html= $this->build_email_html($email_content);
	        sendemail(FROM_EMAIL,$email_content[0]["title"],$ref_email,$email_html);
	        $this->send_email_to_all_ref($ref_usercode);
	   }
    }
    //Show Failure Page on errro
    function show_failed_you(){
         $this->load->view('comman/topheader.php');
		$this->load->view('comman/header.php');
		$this->load->view('fb_plan_failed_view',$data);
		$this->load->view('comman/footer.php');
    }
    
	//Send emails to 3 users above the current user
	public function send_email_up(){
	    $email_content=$this->objM->get_pages_contain("pro_marketers_email");
	   $login_usercode=$this->session->userdata['logged_ol_member']['usercode'];
	   $user=$this->objM->get_user($login_usercode);
	   $user_email=$user[0]["emailid"];
	   $ref_usercode=$user[0]["referralid_free"];
	   $ref_user=$this->objM->get_user($ref_usercode);
	   
	   $ref_email=$ref_user[0]["emailid"];
	  if($ref_usercode!=0){
	    
	      $email_html= $this->build_email_html($email_content);
	    
	      sendemail(FROM_EMAIL,$email_content[0]["title"],$ref_email,$email_html);
	   $user=$this->objM->get_user($ref_usercode);
	   $user_email=$user[0]["emailid"];
	   $ref_usercode=$user[0]["referralid_free"];
	   $ref_user=$this->objM->get_user($ref_usercode);
	   $ref_email=$ref_user[0]["emailid"];
	   if($ref_usercode!=0){
	   sendemail(FROM_EMAIL,$email_content[0]["title"],$ref_email,$email_html);
	   }
	   $user=$this->objM->get_user($ref_usercode);
	   $user_email=$user[0]["emailid"];
	   $ref_usercode=$user[0]["referralid_free"];
	   $ref_user=$this->objM->get_user($ref_usercode);
	   $ref_email=$ref_user[0]["emailid"];
	   if($ref_usercode!=0){
	    sendemail(FROM_EMAIL,$email_content[0]["title"],$ref_email,$email_html);
	   }
	  }
	}
	function build_email_html($cms){
	    $html=" <div style='margin-top:30px;'>
	  			     <div class='txtdiv '><h2>".$cms[0]['title']."</h2>
	  			        
                     </div>
                     <div class='span6' style='overflow:hidden;'>

					<div class='video_frm'>
					<div class='inner_frm'>";
				
					$html.="</div>
						</div>
					</div>
	        </div>
	        	     <!-- VIDEO DISPLAY -->
	        	     <br>
	        	     <br>
	        		<div class='txtdiv' style='overflow:hidden'>".$cms[0]['textdt']."</div>
	            	<div style='clear:both;overflow:hidden;'></div>
	        	</div>
	        			<!-- WELCOME MESSAGE -->
	        ";
	        return $html;
	}
	//---------------------- show thank you :: smh  -----------------------
		//-------------  Send subscription confirmation email to admin :: smh---------------
	function send_subscription_confirmation_email($usercode,$customer){
	    $email=$this->objM->get_user(2);
	    $email_to=$email[0]['emailid'];
	    $user=$this->objM->get_user($usercode);
	    $email_subject=$user[0]['lname']." "."has subscribed to Pro Marketers Plan";
        $email_body="<h1> Congratulation </h1><br><h4> ".$user[0]['lname']. "(".$user[0]['usercode'].")"."has just subscribed to Pro Marketers Compensation Plan successfully</h4><br>".$customer;
	    
	      sendemail(FROM_EMAIL,$email_subject,$email_to,$email_body);
	    
	}
   
}


