<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unilevel  extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;}  
		$this->load->model('unilevel_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['result']=$this->get_ref_admin();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	function get_ref_admin()
	{
		$result=$this->unilevel_model->get_all_referral($this->session->userdata['logged_in_visa']['usercode']);
		//echo $this->db->last_query();
		$node_count=count($result);
					  //width				paddding+magin		border
		$first_width=(100 * $node_count)+(10 * $node_count)+(2 * $node_count);
		$line_width=$first_width-112;
		$html='<div class="uni_first_node" style="width:'.$first_width.'px;">
					<div>
						<img src="'.base_url().'/asset/images/multitree/admin.png">
						<p>Admin Admin</p>
					</div>
			   </div>';
		$html.='<div class="line_div" style="width:'.$first_width.'px;"><hr style="width:'.$line_width.'px;"></hr></div>';	   
		$html .='<ul class="uni_ul" style="width:'.$first_width.'px;margin-left:0px;padding:0px;">';
		for($i=0;$i<count($result);$i++){
		    $loginusercode = $result[$i]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $iconimg="red";// For Qualified Status -

	        	}else{
	        	     $iconimg="admin";
	        	}
			$html.='<li class="uni_li_click cls1" level="1" posi="'.$i.'" main_margin="0" usercode="'.$result[$i]['usercode'].'">
						<img class="vr_line" src="'.base_url().'/asset/images/multitree/vr_line.jpg">
						<img src="'.base_url().'/asset/images/multitree/'.$iconimg.'.png">
						<p>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</p>
					</li>';
		}
		$html.='<div style="clear:both;overflow:hidden;"></div>';
		$html.='</ul>';
		
		return $html;
	}
	
	function get_next_level(){
		$usercode=$this->uri->segment(3);
		$level=$this->uri->segment(4)+1;
		$posi=$this->uri->segment(5);
		
		$main_margin=$this->uri->segment(6);
		 
		$result=$this->unilevel_model->get_all_referral($usercode);
		$node_count=count($result);
		$first_width=(102 * $node_count)+(10 * $node_count);
		$line_width=$first_width-112;
		$margin_left=(102 * $posi)+(10 * $posi)+$main_margin;
		
		if($node_count!='1'){
			//$margin_left=$margin_left-((100 * $node_count)/2)+($node_count * 12);
			$a=($first_width/2)-56;
			$margin_left=$margin_left-$a;
		}
		
		
		if($margin_left < 1){
			$margin_left=0;
		}
		if(count($result)<1){
			echo $html ='<div class="line_div div'.$level.'" style="width:200px;margin-left:'.$margin_left.'px;"><p style="padding:"10px;>No Members Added</p></div>';
			exit;	   
		}
		
		$html ='<div class="line_div div'.$level.'" style="width:'.$first_width.'px;margin-left:'.$margin_left.'px;"><hr style="width:'.$line_width.'px;"></hr></div>';	   
		$html .='<ul class="uni_ul div'.$level.'" style="width:'.$first_width.'px;margin-left:'.$margin_left.'px;padding:0px;">';
		for($i=0;$i<count($result);$i++){
		     $loginusercode = $result[$i]['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if(!($referralcount>=3)){
	        	              	 $iconimg="red";// For Qualified Status -

	        	}else{
	        	     $iconimg="admin";
	        	}
			$html.='<li class="uni_li_click cls'.$level.'" level="'.$level.'" posi="'.$i.'" main_margin="'.$margin_left.'" usercode="'.$result[$i]['usercode'].'">
						<img class="vr_line" src="'.base_url().'/asset/images/multitree/vr_line.jpg">
						<img src="'.base_url().'/asset/images/multitree/'.$iconimg.'.png">
						<p>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</p>
					</li>';
		}
		$html.='<div style="clear:both;overflow:hidden;"></div>';
		$html.='</ul>';
		
		echo  $html;
		
	}
	
	
	
}

