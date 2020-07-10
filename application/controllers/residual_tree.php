<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class residual_tree extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('residual_tree_model','',TRUE);
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
		$result=$this->residual_tree_model->get_all_referral($this->session->userdata['logged_ol_member']['usercode']);
		$node_count=count($result);
					  //width				paddding+magin		border
		$first_width=(100 * $node_count)+(10 * $node_count)+(2 * $node_count);
		$line_width=$first_width-112;
		$html='<div class="coded_first_node" style="width:'.$first_width.'px;">
					<div>
						<img src="'.base_url().'/asset/images/multitree/admin.png">
						<p>'.$this->session->userdata['logged_ol_member']['fullname'].'</p>
					</div>
			   </div>';
		$html.='<div class="line_div" style="width:'.$first_width.'px;"><hr style="width:'.$line_width.'px;"></hr></div>';	   
		$html .='<ul class="coded_ul" style="width:'.$first_width.'px;margin-left:0px;padding:0px;">';
		for($i=0;$i<count($result);$i++){
			$html.='<li class="coded_li_click" level="1" posi="'.$i.'" main_margin="0" usercode="'.$result[$i]['usercode'].'">
						<img class="vr_line" src="'.base_url().'/asset/images/multitree/vr_line.jpg">
						<img src="'.base_url().'/asset/images/multitree/residual.png">
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
		 
		$result=$this->residual_tree_model->get_all_referral_next($usercode);
		//echo $this->db->last_query();
		//exit;
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
		
		
		
		
		if($margin_left < 1){
			$margin_left=0;
		}
		
		if(count($result)<1){
			echo $html ='<div class="line_div div'.$level.'" style="width:200px;margin-left:'.$margin_left.'px;"><p style="padding:"10px;>No Members Added</p></div>';
			exit;	   
		}
		
		$html ='<div class="line_div div'.$level.'" style="width:'.$first_width.'px;margin-left:'.$margin_left.'px;"><hr style="width:'.$line_width.'px;"></hr></div>';	   
		$html .='<ul class="coded_ul div'.$level.'" style="width:'.$first_width.'px;margin-left:'.$margin_left.'px;padding:0px;">';
		for($i=0;$i<count($result);$i++){
			$html.='<li class="coded_li_click" level="'.$level.'" posi="'.$i.'" main_margin="'.$margin_left.'" usercode="'.$result[$i]['usercode'].'">
						<img class="vr_line" src="'.base_url().'/asset/images/multitree/vr_line.jpg">
						<img src="'.base_url().'/asset/images/multitree/residual.png">
						<p>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</p>
					</li>';
		}
		$html.='<div style="clear:both;overflow:hidden;"></div>';
		$html.='</ul>';
		
		echo  $html;
	}
	
	
}

