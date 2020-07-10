<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class enroll extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('enroll_model','ObjM',TRUE);
		$this->load->library('email');
 	}

	public function index()
	{
		$data['cms']	=	$this->ObjM->get_page_contain();
		$data['pay_type'] = $this->ObjM->getType();
		$usercode=$this->session->userdata['logged_ol_member']['usercode'];
        $data['upgradelevel']  = $this->ObjM->get_upgrade_level($usercode);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}

	public function pay(){
        try {	
            require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
            Stripe::setApiKey("sk_test_Ih0PK9Osz1AoVQ4QeDheTKFX"); //Replace with your Secret Key
            $usercode=$this->session->userdata['logged_ol_member']['usercode'];
            $upgradelevel  = $this->ObjM->get_upgrade_level($usercode);
            $levelcode =  $upgradelevel['level_code'];
            $amount =  $upgradelevel['level_amount'];
            $charge = Stripe_Charge::create(array(
      				"amount" => $upgradelevel['level_amount'].'00',
      				"currency" => "usd",
      				"card" => $_POST['stripeToken'],
      				"description" => "Enroll Payment"
            ));
            //print_r($_POST);
            $data = array();
            $data['current_level'] =  $levelcode;
            $data['status'] =  'Active';
            $this->ObjM->update($data,'membermaster','usercode',$usercode);
            //
            $data = array();
            $stripeemail =  $_POST['stripeEmail'];
            $stripetoken =  $_POST['stripeToken'];
            $data['usercode'] =  $usercode;
            $data['token'] =  $stripetoken;
            $data['email'] =  $stripeemail;
            $data['amount'] =  $amount;
            $data['level'] =  $levelcode;
            $data['date'] =  date('Y-m-d H:i:s');
            $this->ObjM->addItem($data,'tbl_payment_wallet');
            //
            $userdata = $this->ObjM->get_userdata($usercode);
            $referalid = $userdata['referralid_free'];
            $referalamt =  $upgradelevel['level_referal_commision'];
            $data = array();
            $data['receiverid'] =  $referalid;
            $data['senderid'] =  $usercode;
            $data['amount'] =  $referalamt;
            $data['plan'] =  $levelcode;
            $data['date'] =  date('Y-m-d H:i:s');
            $this->ObjM->addItem($data,'tbl_visible_wallet');
            //
            $referaldata = $this->ObjM->get_userdata($referalid);
            $uplineid = $referaldata['referralid_free'];
            $uplineamt =  $upgradelevel['level_upline_commision'];
            if($uplineid==''){$uplineid=0;}
            $data = array();
            $data['receiverid'] =  $uplineid;
            $data['senderid'] =  $usercode;
            $data['amount'] =  $uplineamt;
            $data['plan'] =  $levelcode;
            $data['date'] =  date('Y-m-d H:i:s');
            $this->ObjM->addItem($data,'tbl_hidden_wallet');

            echo "<script>alert('Payment completed Successfully!'); window.location.href='".base_url()."index.php/enroll/'</script>";
            //redirect('upgrade_membership/view/');
            
        }

        catch(Stripe_CardError $e) {
        }

        //catch the errors in any way you like
        catch (Stripe_InvalidRequestError $e) {
          // Invalid parameters were supplied to Stripe's API
        	echo '1';
        } catch (Stripe_AuthenticationError $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
        	echo '2';
        } catch (Stripe_ApiConnectionError $e) {
          // Network communication with Stripe failed
        	echo '3';
        } catch (Stripe_Error $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
        	echo '4';
        } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
        	echo '5';
        }
    }
	
}


