<?php
Class report_model extends CI_Model
{
 	
	
	function get_list()
	{
		$sQuery='SELECT  u.usercode,
		COALESCE(r.virtual_in, 0) virtual_in,
		COALESCE(n.virtual_out, 0) virtual_out,
		COALESCE(r.virtual_in, 0) -  COALESCE(n.virtual_out, 0) as virtual_balance,
		COALESCE(r1.main_in, 0) main_in,
		COALESCE(n1.main_out, 0) main_out,
		COALESCE(r1.main_in, 0) -  COALESCE(n1.main_out, 0) as main_balance,
		CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid
		FROM  vma_member as u 
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) virtual_in
		FROM    vma_virtual_wallet
		GROUP   BY usercode
		) r ON  u.usercode = r.usercode
		LEFT JOIN
		(
		SELECT  EndCode, SUM(amount) virtual_out
		FROM    vma_daily_payment
		GROUP   BY EndCode
		) n ON u.usercode = n.EndCode
		
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) main_in
		FROM    vma_daily_payment
		GROUP   BY usercode
		) r1 ON u.usercode = r1.usercode
		
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) main_out
		FROM    vma_withdrawal
		GROUP   BY usercode
		) n1 ON u.usercode = n1.usercode
		LEFT JOIN membermaster ON membermaster.usercode=u.usercode';	
		
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	function virtual_wallet_income($eid)
	{
		$this -> db -> select('vma_virtual_wallet.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('membermaster.username,membermaster.emailid');
   		$this -> db -> from('vma_virtual_wallet');
		$this -> db -> join('membermaster','membermaster.usercode = vma_virtual_wallet.by_user','left');
		$this -> db  -> where('vma_virtual_wallet.usercode',''.$eid.'');
		$this -> db  -> order_by('vma_virtual_wallet.id','DESC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function virtual_payment($eid)
	{
		$this -> db -> select('sum(amount) as tot,timedt');
   		$this -> db -> from('vma_daily_payment');
		$this -> db  -> where('EndCode',''.$eid.'');
		$this -> db  -> group_by('timedt');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function main_wallet_income($eid)
	{
		$this -> db -> select('sum(amount) as tot,timedt');
   		$this -> db -> from('vma_daily_payment');
		$this -> db  -> where('usercode',''.$eid.'');
		$this -> db  -> group_by('timedt');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function main_withdrawal($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('vma_withdrawal');
		$this -> db  -> where('usercode',''.$eid.'');
		$this -> db  -> group_by('timedt');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function virtual_wallet_month_vise($arr){
		$this -> db -> select('timedt');
   		$this -> db -> from('vma_daily_payment');
   		$this -> db -> where('timedt >=',''.$arr[0].'');
		$this -> db -> where('timedt <=',''.$arr[1].'');
		$this -> db -> group_by('timedt');
		$this -> db -> order_by('timedt','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function virtual_payment_member_list($arr)
	{
		$this -> db -> select('vma_daily_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = vma_daily_payment.EndCode','left');
   		$this -> db -> from('vma_daily_payment');
		
		$this -> db  -> where('vma_daily_payment.timedt',''.$arr['date'].'');
		$this -> db -> group_by('vma_daily_payment.usercode');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function virtual_payment_member_detail($eid){
		$this -> db -> select('vma_daily_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = vma_daily_payment.EndCode','left');
   		$this -> db -> from('vma_daily_payment');	
		$this -> db  -> where('vma_daily_payment.EndCode',''.$eid.'');
		$this -> db -> group_by('vma_daily_payment.timedt');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function get_upling($eid){
		$this -> db -> select('vma_member.*');
		$this -> db -> select('CONCAT(user1.fname," ",user1.lname) as name1',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",user2.lname) as name2',FALSE);
		$this -> db -> select('CONCAT(user3.fname," ",user3.lname) as name3',FALSE);
		
		$this -> db -> from('vma_member');
		
		$this -> db -> join('vma_member tbl1','vma_member.upling = tbl1.usercode','left');
		$this -> db -> join('membermaster user1','user1.usercode = tbl1.usercode','left');
		
		$this -> db -> join('vma_member tbl2','tbl1.upling = tbl2.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = tbl2.usercode','left');
		
		$this -> db -> join('vma_member tbl3','tbl2.upling = tbl3.usercode','left');
		$this -> db -> join('membermaster user3','user3.usercode = tbl3.usercode','left');
		
		
   		
		$this -> db  -> where('vma_member.usercode',''.$eid.'');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;		
	}
	
	function income_sum($arr){
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('vma_daily_payment');
		$this -> db  -> where('usercode',''.$arr['usercode'].'');
		if($arr['start_date']!=''){
			$this -> db  -> where('timedt >=',''.$arr['start_date'].'');
		}
		if($arr['end_date']!=''){
			$this -> db  -> where('timedt <=',''.$arr['end_date'].'');
		}
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	
	function get_member_income_by_month($arr)
	{
		$this -> db -> select('sum(amount) as tot,timedt');
   		$this -> db -> from('vma_daily_payment');
		$this -> db  -> where('usercode',''.$arr['usercode'].'');
		$this -> db  -> where('timedt >=',''.$arr['start_date'].'');
		$this -> db  -> where('timedt <=',''.$arr['end_date'].'');
		$this -> db  -> group_by('timedt');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	function income_report_datewise($usercode,$eid)
	{
		$this -> db -> select('vma_daily_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = vma_daily_payment.EndCode','left');
   		$this -> db -> from('vma_daily_payment');	
		$this -> db  -> where('vma_daily_payment.usercode',''.$usercode.'');
		$this -> db  -> where('vma_daily_payment.timedt',''.$eid.'');
		$this -> db  -> order_by('vma_daily_payment.level','ASC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function get_unqulified_list($arr)
	{
		$this -> db -> select('vma_daily_payment.*');
		$this -> db -> select('CONCAT(user1.fname," ",user1.lname) as name1',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",user2.lname) as name2',FALSE);
		
		$this -> db -> join('membermaster user1','user1.usercode = vma_daily_payment.EndCode','left');
		$this -> db -> join('membermaster user2','user2.usercode = vma_daily_payment.option','left');
		
   		$this -> db -> from('vma_daily_payment');	
		$this -> db -> where('vma_daily_payment.type','unqulified');
		
		$this -> db  -> where('vma_daily_payment.timedt >=',''.$arr['start_date'].'');
		$this -> db  -> where('vma_daily_payment.timedt <=',''.$arr['end_date'].'');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function get_unqulified_sum($arr)
	{
		$this -> db -> select('sum(amount) as tot');
   		$this -> db -> from('vma_daily_payment');
		$this -> db -> where('vma_daily_payment.type','unqulified');
		if(isset($arr['start_date'])){
			$this -> db  -> where('timedt >=',''.$arr['start_date'].'');
		}
		
		if(isset($arr['end_date'])){
			$this -> db  -> where('timedt <=',''.$arr['end_date'].'');
		}
		
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();	
		return $the_content[0]['tot'];
	}
	
	
	
	
}
?>
