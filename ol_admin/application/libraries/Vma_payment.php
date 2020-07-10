<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Vma_payment {
	
	
	function payment($usercode,$paycode=''){
		$CI =& get_instance();	
		var_dump($usercode);
		$upling = $this->tree_upling_level($usercode);
		echo $CI->db->last_query();
		var_dump($upling);
		//level 1 payment
		$data=array();
		$data['usercode']	 =	$upling['lv1'];
		$data['paymentcode'] =	$paycode;
		$data['by_user'] 	 =	$usercode;
		$data['level']	 	 =  '1';
		$data['amount']	     =  10;
		$data['datedt']	     =  date('Y-m-d');
		$data['timedt']	     =  time();
		$this->addItem($data,'vma_virtual_wallet');
		
		//level 2 payment
		$data['usercode']	 =	$upling['lv2'];
		$data['level']	 	 =  '2';
		$data['amount']	     =  15;
		$this->addItem($data,'vma_virtual_wallet');
		
	}
	
	function tree_upling_level($eid)
	{
		$CI =& get_instance();	
		$CI -> db -> select('t1.usercode as lv1');
		$CI -> db -> select('t2.usercode as lv2');
		$CI -> db -> select('t3.usercode as lv3');
   		$CI -> db -> from('vma_member');
		$CI -> db -> join('vma_member t1','vma_member.upling = t1.usercode','left');
		$CI -> db -> join('vma_member t2','t1.upling = t2.usercode','left');
		$CI -> db -> join('vma_member t3','t2.upling = t3.usercode','left');
   		$CI -> db -> where('vma_member.usercode', ''.$eid.'');
		
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		
		if(!isset($the_content[0]['lv1']))	{	$the_content[0]['lv1']='1';	}
		if(!isset($the_content[0]['lv2']))	{	$the_content[0]['lv2']='1';	}
		if(!isset($the_content[0]['lv3']))	{	$the_content[0]['lv3']='1';	}
		
    	return $the_content[0];
	}
	
	
	function addItem($data,$table){
		$CI =& get_instance();	
    	$CI->db->insert($table , $data);
    	return $CI->db->insert_id();
	}
	
	function update($data,$table,$where)
	{
		$CI =& get_instance();	
		$CI->db->where($where);
		$CI->db->update($table, $data); 
	}
	
	
	
	
	
	
	
	
	
	
	

	
	
}
