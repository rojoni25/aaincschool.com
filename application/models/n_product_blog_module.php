<?php
Class n_product_blog_module extends CI_Model
{
 	function get_my_blog()
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('n_product_blog');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status !=','Delete');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_blog_by_id($eid)
	{	
		$this -> db -> select('*');
   		$this -> db -> from('n_product_blog');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('id',''.$eid.'');
		$this -> db -> where('status !=','Delete');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_all_blog()
	{	
		$this -> db -> select('n_product_blog.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('n_product_blog');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_blog.usercode','left');
   		$this -> db -> where('(n_product_blog.usercode="'.$this->session->userdata['logged_ol_member']['usercode'].'" OR n_product_blog.usercode="-1" OR n_product_blog.usercode IN (select permission_to from n_product_blog_permission where usercode="'.$this->session->userdata['logged_ol_member']['usercode'].'"))');
		$this -> db -> where('n_product_blog.status','Active');
		$this -> db -> order_by('n_product_blog.id','DESC');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function _get_blog_by_id($eid)
	{	
		$this -> db -> select('n_product_blog.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('n_product_blog');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_blog.usercode','left');
   		$this -> db -> where('(n_product_blog.usercode="'.$this->session->userdata['logged_ol_member']['usercode'].'" OR n_product_blog.usercode="-1" OR n_product_blog.usercode IN (select permission_to from n_product_blog_permission where usercode="'.$this->session->userdata['logged_ol_member']['usercode'].'"))');
		$this -> db -> where('n_product_blog.status','Active');
		$this -> db -> where('n_product_blog.id',''.$eid.'');
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
	
	function delete_blog($data,$eid)
	{
		$this->db->where('id',$eid);
		$this->db->update('n_product_blog',$data);
	}
	
}
?>
