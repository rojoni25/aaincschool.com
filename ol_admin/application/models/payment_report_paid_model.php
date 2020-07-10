<?php
Class payment_report_paid_model extends CI_Model
{
 

	function get_member_by_username($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status','Active');
		$this -> db -> where('username',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function count_all_paid_member()
	{	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_master_balance_sheet($eid){
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_all_balance(){
		$this -> db -> select("main_balance,usercode");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode !=','0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_possible_withdrawal_member(){
		$this -> db -> select("master_balance_sheet.main_balance, master_balance_sheet.usercode");
		$this -> db -> select("membermaster.fname, membermaster.lname, membermaster.username, membermaster.emailid");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
		$this -> db -> where('master_balance_sheet.usercode !=','0');
		$this -> db -> where('master_balance_sheet.main_balance >=',''.CW_MIN.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function sum_monthly_pay_by_usercode($eid){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('type NOT IN("3by3","5by3","10by3")');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_daily_pay_by_type($eid,$pay_type)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('pay_type',''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_monthly_pay_by_type($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_refill($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('refill_account');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('ac_type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function sum_daily_payment($eid){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_withdrawal_balance($eid,$wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type !=','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_total_transfer($eid,$wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	

	
	function get_active_member($eid)
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
			
		if ( $sWhere == "" ){$sWhere = "WHERE status='Active'";}
		else{$sWhere .= " AND status='Active'";}
			
		$sQuery = "
		SELECT * FROM  	membermaster
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	
	function withdrawal_list($eid){
		$this -> db -> select("*");
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> order_by("withdrawal_code","desc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	
	//////////////////////////////////////////////////////
	function get_payment($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_withdrawal($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('withdrawal_balance');
   		$this -> db -> where('usercode',''.$eid.'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}	
		}
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_withdrawal_sum($eid)
	{
		
		//$this -> db -> select('sum(amount) as tot_sum');
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('withdrawal_balance');
   		$this -> db -> where('usercode',''.$eid.'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}	
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_active_dt($eid)
	{
		$this -> db -> select('active_dt');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_monthly($eid)
	{
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
		$this -> db -> select('timestm');
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('pay_type',''.$_POST['daily_earning'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timestm >=',''.strtotime($date).'');
				$this -> db -> where('timestm <=',''.strtotime($end_date).'');
			}	
		}
		 $this -> db -> group_by('timestm'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_monthly_sum($month_name,$eid)
	{
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('pay_type',''.$_POST['daily_earning'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timestm >=',''.strtotime($date).'');
				$this -> db -> where('timestm <=',''.strtotime($end_date).'');
			}
			else{
				$date 		= date('01-m-Y',strtotime($month_name));
   				$end_date 	= date('t-m-Y',strtotime($month_name));
				
				$this -> db -> where('timestm >=',''.strtotime($date).'');
				$this -> db -> where('timestm <=',''.strtotime($end_date).'');
			}	
		}
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_sum($eid){
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('pay_type',''.$_POST['daily_earning'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
 
 
	
}
?>
