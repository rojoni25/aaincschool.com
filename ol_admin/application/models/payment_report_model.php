<?php
Class payment_report_model extends CI_Model
{
 
	function getAll_active_due_payment()
 	{	
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status','Active');
		$this -> db -> where('usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function getAll_last_payment($eid)
 	{	
		$this -> db -> select('*');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('status','Open');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> order_by("paymentcode", "desc");
    	$this -> db -> limit(1);
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function last_payment_free()
	{
		$this -> db -> select_max('timestm');
   		$this -> db -> from('payment_daily_free'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['timestm'];	
	}
	
	function last_payment_paid()
	{
		$this -> db -> select_max('timestm');
   		$this -> db -> from('payment_daily'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['timestm'];	
	}
	
	function get_daily_payment_free_member($eid)
	{	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode IN(select usercode from payment_daily_free where timestm="'.$eid.'")');
		$this -> db -> where('membermaster.status','Pending');
		$this -> db -> order_by('usercode', 'asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_daily_payment_paid_member($eid)
	{	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode IN(select usercode from payment_daily where timestm="'.$eid.'")');
		$this -> db -> where('membermaster.status','Active');
		$this -> db -> order_by('usercode', 'asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function free_payment_email_status($eid, $status)
	{	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode IN(select usercode from payment_daily_free where timestm="'.$eid.'" and send_email="'.$status.'")');
		$this -> db -> where('membermaster.status','Pending');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function paid_payment_email_status($eid, $status)
	{	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode IN(select usercode from payment_daily where timestm="'.$eid.'" and send_email="'.$status.'")');
		$this -> db -> where('membermaster.status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function free_member_check_email($user_code, $timestm)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_daily_free');
   		$this -> db -> where('timestm',''.$timestm.'');
		$this -> db -> where('usercode',''.$user_code.'');
    	$this -> db -> limit(1);
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function paid_member_check_email($user_code, $timestm)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('timestm',''.$timestm.'');
		$this -> db -> where('usercode',''.$user_code.'');
    	$this -> db -> limit(1);
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function allmember_free_pay($eid)
 	{	
		
		$aColumns = array( 'usercode','fname', 'lname', 'emailid','mobileno');
		
   		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
		}
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
		
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		////////////
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		////////////
			
			if ( $sWhere == "" ){$sWhere = "WHERE usercode IN(select usercode from payment_daily_free where timestm='".$eid."')";}
			else{$sWhere .= " AND usercode IN(select usercode from payment_daily_free where timestm='".$eid."')";}
			
		$sQuery = "
		SELECT * FROM  	membermaster
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	
	
	
	
	
	function get_listing_paid_pay($eid)
 	{	
		
		$this -> db -> select('payment_daily.*');
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
   		$this -> db -> from('payment_daily');
		$this -> db -> join('membermaster','payment_daily.usercode = membermaster.usercode','left');
   		$this -> db -> where('payment_daily.timestm',''.strtotime($_POST['daily_date']).'');
		$this -> db -> where('payment_daily.pay_type',''.$_POST['report_type'].'');
		$this -> db -> group_by('payment_daily.usercode');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}

 	function get_listing_free_pay($eid)
 	{
		
		$this -> db -> select('payment_daily_free.*'); 
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
   		$this -> db -> from('payment_daily_free');
		$this -> db -> join('membermaster','payment_daily_free.usercode = membermaster.usercode','left');
   		$this -> db -> where('payment_daily_free.timestm',''.strtotime($_POST['daily_date']).'');
		$this -> db -> where('payment_daily_free.pay_type',''.$_POST['report_type'].'');
		$this -> db -> group_by('payment_daily_free.usercode');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function paid_member_total_amount_get($arr){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$arr['usercode'].'');
		$this -> db -> where('timestm',''.$arr['timestm'].'');
		$this -> db -> where('pay_type',''.$arr['pay_type'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function free_member_total_amount_get($arr){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily_free');
		$this -> db -> where('usercode',''.$arr['usercode'].'');
		$this -> db -> where('timestm',''.$arr['timestm'].'');
		$this -> db -> where('pay_type',''.$arr['pay_type'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_paid_from($arr){
		$this -> db -> select('payment_daily.*');
		$this -> db -> select('membermaster.fname,membermaster.lname');
   		$this -> db -> from('payment_daily');
		$this -> db -> join('membermaster','payment_daily.paymentcode = membermaster.usercode','left');
   		$this -> db -> where('payment_daily.timestm',''.$arr['timestm'].'');
		$this -> db -> where('payment_daily.usercode',''.$arr['usercode'].'');
		$this -> db -> where('payment_daily.pay_type',''.$arr['pay_type'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_free_from($arr){
		$this -> db -> select('payment_daily_free.*');
		$this -> db -> select('membermaster.fname,membermaster.lname');
   		$this -> db -> from('payment_daily_free');
		$this -> db -> join('membermaster','payment_daily_free.paymentcode = membermaster.usercode','left');
   		$this -> db -> where('payment_daily_free.timestm',''.$arr['timestm'].'');
		$this -> db -> where('payment_daily_free.usercode',''.$arr['usercode'].'');
		$this -> db -> where('payment_daily_free.pay_type',''.$arr['pay_type'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	
	
 
 
	
}
?>
