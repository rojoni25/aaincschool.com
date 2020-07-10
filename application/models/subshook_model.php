<?php
Class subshook_model extends CI_Model
{
    // Activate subscription for a member using subscription id
 	function activate_subscription($subsid)
 	{	$date = date('Y-m-d');
   		$this -> db -> set('subscription_status','Active');
   		$this -> db -> set('last_sub_payment_date',$date);
	  	$this -> db -> where('subscription_id', $subsid);
    	$this -> db -> update('membermaster');
 	}
 	// Deactivate subscription for a member using subscription id
 	function deactivate_subscription($subsid)
 	{	
   		$this -> db -> set('subscription_status','InActive');
	  	$this -> db -> where('subscription_id', $subsid);
    	$this -> db -> update('membermaster');
 	}
 	// Give Commision to the referals
 	function calculate_commision($subsid){
 	    $amount=5;//--------->commision amount-------------
 	   $date = date('Y-m-d H:i:s');
 	    $table="tbl_capture_page_wallet";
 	    $this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('subscription_id',''.$subsid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	$usercode=$the_content[0]["usercode"]; // get user code
        $referalcode=$the_content[0]["referralid"]; // get Referal code
   		if($this->isActiveMember($referalcode)){// only add commision if the referal is the active member
            $data=array("receiver_id"=>$referalcode,"sender_id"=>$usercode,"amount"=>$amount,"date"=>$date,"plan"=>'1');
            $this->addItem($data,$table);
   		}else{// if member is not active then $5 will go to the admin
   		     $data=array("receiver_id"=>2,"sender_id"=>$usercode,"amount"=>$amount,"date"=>$date,"plan"=>'1');
            $this->addItem($data,$table);
   		}
 	}
 	// add records in a table
 	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
    
	}
	// check whether a member is active or inactive 
	function isActiveMember($usercode){
	    //Get referal details
         $this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$usercode.'');
    	$queries = $this->db->get();
   		$the_contents = $queries->result_array();
   		$status=$the_contents[0]["status"];
   		if($status=="Active"){
   		    return true;
   		}else{
   		    return false;
   		}
	}
	

		
}
?>
