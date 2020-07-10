<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Comman_fun {

	function get_table_data($tbl, $where){
		$CI =& get_instance();
		$CI -> db -> select('*');
		$CI -> db -> from($tbl);
		if(is_array($where)){
			$CI -> db -> where($where);
		}
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	
	function select_query($sQuery){
		
		$CI =& get_instance();
		
		if($sQuery==''){
			return false;
		}
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
		return $the_content;
	}
	
 	function check_record($tbl, $where){
		$CI =& get_instance();
		$CI -> db -> select('*');
		$CI -> db -> from($tbl);
		$CI -> db -> where($where);
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();	
		$check_entry=(isset($the_content[0])) ? true : false; 
		return $check_entry;
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
		
		if($CI->db->affected_rows()>0){
			return true;
		}else{
			return false;	
		}
		
		
	}
	function delete($table,$where)
	{
		$CI =& get_instance();	
		$CI->db->where($where);
		$CI->db->delete($table); 
	}
	
	
	
	function get_member_by_code_opp($eid,$tbl){
		$CI =& get_instance();
		$CI -> db -> select(''.$tbl.'.*');
		$CI -> db -> select('CONCAT (membermaster.fname," ",membermaster.lname) as name, membermaster.emailid, membermaster.username, membermaster.email_verification, membermaster.usercode',FALSE);
		$CI -> db -> from($tbl);
		$CI -> db -> join('membermaster','membermaster.usercode = '.$tbl.'.usercode','left');
		$CI -> db -> where(''.$tbl.'.usercode',''.$eid.'');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content[0];
	}
	
	function upling_chain_opp($eid, $tbl){
	
		$CI =& get_instance();
		$arr    = array();
		$code=$eid;

		while(true){
			
			$result = $this->get_member_by_code_opp($code,$tbl);
			
			if(!is_array($result)){
				break;	
			}
			if($result['usercode']=='1'){
				$arr[]=$result;
				break;
			}
			$arr[]=$result;
			$code=$result['uplingmember3_3'];
		}
		
		$arr=array_reverse($arr);
		return $arr;
		
	}
	
	
	
	
	
	

	
	
}
