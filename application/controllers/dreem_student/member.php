<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {

	protected $admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		//---------------change--------------------------//
		if(!$this->comman_fun->check_record('dreem_student_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'])))
		{header('Location: '.base_url().'index.php/dashboard');exit;}
		//---------------change--------------------------//
		$this->load->model('dreem_student/me_module','ObjM',TRUE); 
 	}
	
	
	function member_list(){
		$data['result']=$this->tree();
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'your_referral'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/member_list_view',$data);
		$this->load->view('comman/footer');	
	}
	
	function gift_earned(){
		
		$data['result']=$this->ObjM->gift_earned();
		
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'donation'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/gift_earned_view',$data);
		$this->load->view('comman/footer');			
	}
	
	function gift_earned_detail($eid){
		$data['result']	 =	$this->ObjM->gift_earned_detail($eid);
		
		if(isset($data['result'][0])){
			$data['list']	 =	$this->comman_fun->get_table_data('dreem_student_payment_confirmation',array('usercode'=>$eid));	
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('dreem_student/member/gift_earned_detail',$data);
			$this->load->view('comman/footer');	
		}
		
	}
	
	function capture_page(){
			$data['result']	 =	$this->comman_fun->get_table_data('dreem_student_capture_page');	
			
			$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'capture_page'));
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('dreem_student/member/capture_page',$data);
			$this->load->view('comman/footer');	
	}
	
	
	function tree()
	{
		$result=$data['result']=$this->ObjM->get_member();
		
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
						<img src="'.base_url().'/asset/images/multitree/coded.png">
						<p>'.$result[$i]['member_name'].'</p>
					</li>';
		}
		$html.='<div style="clear:both;overflow:hidden;"></div>';
		$html.='</ul>';
		
		return $html;
	}
	
	function get_next_level(){
		$usercode=$this->uri->rsegment(3);
		$level=$this->uri->rsegment(4)+1;
		$posi=$this->uri->rsegment(5);
		
		$main_margin=$this->uri->rsegment(6);
		 
		$result=$this->ObjM->next_level_member($usercode);
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
			$html.='<li class="coded_li_click lev'.$level.'" level="'.$level.'" posi="'.$i.'" main_margin="'.$margin_left.'" usercode="'.$result[$i]['usercode'].'">
						<img class="vr_line" src="'.base_url().'/asset/images/multitree/vr_line.jpg">
						<img src="'.base_url().'/asset/images/multitree/coded.png">
						<p>'.$result[$i]['member_name'].'</p>
					</li>';
		}
		$html.='<div style="clear:both;overflow:hidden;"></div>';
		$html.='</ul>';
		
		echo  $html;
	}
	
	
	
}


