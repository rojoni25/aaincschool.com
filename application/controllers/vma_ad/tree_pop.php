<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tree_pop extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){header('Location: '.base_url().'index.php/vma/dashboard/view');exit;}
		$this->load->model('vma_ad/request_model','ObjM',TRUE);
		$this->load->library('vma_ad/vma_class');
		
		
 	}
	
	public function tree_popup($eid)
	{
		
		$this->load->view('vma_ad/tree_popup',$data);
		
	}
	
	function get_tree($eid){
		$arr=array();
		$arr['tree']=$this->drow_tree($eid);
		$arr['upling_chain']=$this->upling_chain($eid);
		echo json_encode($arr);
	}
	
	function drow_tree($eid)
	{
		$html='';
		$topnode=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
		
	
		
		$level1	=	$this->vma_class->get_child($eid);
		
		
		
		if(isset($level1[0])){
			$level1_1	=	$this->vma_class->get_child($level1[0]['usercode']);
		}
		if(isset($level1[1])){
			$level1_2	=	$this->vma_class->get_child($level1[1]['usercode']);
		}
		if(isset($level1[2])){
			$level1_3	=	$this->vma_class->get_child($level1[2]['usercode']);
		}
		
		
		
		
		
		
		
		
		$empty='<div class="tree-node pull-left">
		<p class="center"><a href="#"><img src="'.base_url().'asset/images/multitree/empty.png" /></a></p>
		<p class="center">Empty</p>
		</div>';
		
		
		$html.='
		<div class="level-1">
		<p class="center"><a class="select_user" href="'.$topnode[0]['usercode'].'"><img src="'.base_url().'asset/images/multitree/admin.png" /></a></p>
		<p class="center">'.$topnode[0]['fname'].' '.$topnode[0]['fname'].'</p>
		</div>';
		
		$html.='<div class="div2-divider">&nbsp;</div>';
		
		$html.='<div class="level-2">';
		
		$node=$level1;
		
		if(isset($node[0])){
			$html.='<div class="tree-node pull-left">
				<p class="center"><a class="select_user" href="'.$node[0]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
				<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[0]['usercode'].'">'.$node[0]['name'].'</a></p>
			</div>';
		}else{
			$html.=$empty;
		}
		
		if(isset($node[1])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[1]['usercode'].'""><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[1]['usercode'].'">'.$node[1]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
		if(isset($node[2])){
				$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[2]['usercode'].'"><img src="'.base_url().'asset/images/multitree/blue.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[2]['usercode'].'">'.$node[2]['name'].'</a></p>
		</div>';	
		}else{
			$html.=$empty;
		}
		
		
	
		
		$html.='</div>';
		
		$html.='<div class="level-3-section pull-left">';
		
		$html.='<div class="div2-divider">&nbsp;</div>';
		
		$node=$level1_1;
		
		
		
		if(isset($node[0])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[0]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[0]['usercode'].'">'.$node[0]['name'].'</a></p>
		</div>';	
		}else{
			$html.=$empty;
		}
			
		if(isset($node[1])){
					
		$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[1]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[1]['usercode'].'">'.$node[1]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
		if(isset($node[2])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[2]['usercode'].'"><img src="'.base_url().'asset/images/multitree/blue.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[2]['usercode'].'">'.$node[2]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
		
		
	
		
		
		
		$html.='</div>';
		
		$html.='<div class="level-3-section pull-left">';
		
		$html.='<div class="div2-divider">&nbsp;</div>';
		
		$node=$level1_2;
		if(isset($node[0])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[0]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[0]['usercode'].'">'.$node[0]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
			
		if(isset($node[1])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[1]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[1]['usercode'].'">'.$node[1]['name'].'</a></p>
		</div>';	
		}else{
			$html.=$empty;
		}
		if(isset($node[2])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[2]['usercode'].'"><img src="'.base_url().'asset/images/multitree/blue.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[2]['usercode'].'">'.$node[2]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
		
		
		
		
		
		
		$html.='</div>';
		
		$html.='<div class="level-3-section pull-left">';
		
		$html.='<div class="div2-divider">&nbsp;</div>';
		
		$node=$level1_3;
		if(isset($node[0])){
				$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[0]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[0]['usercode'].'">'.$node[0]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
			
		if(isset($node[1])){
				$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[1]['usercode'].'"><img src="'.base_url().'asset/images/multitree/red.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[1]['usercode'].'">'.$node[1]['name'].'</a></p>
		</div>';
		}else{
			$html.=$empty;
		}
		if(isset($node[2])){
			$html.='<div class="tree-node pull-left">
		<p class="center"><a class="select_user" href="'.$node[2]['usercode'].'"><img src="'.base_url().'asset/images/multitree/blue.png" /></a></p>
		<p class="center"><a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$node[2]['usercode'].'">'.$node[2]['name'].'</a></p>
		</div>';	
		}else{
			$html.=$empty;
		}
		
		
		
		
		
		
		$html.='</div>';
		
		return $html;
		
	}
	
	
	
	function upling_chain($eid){
		$html='';
		$result		=	$this->vma_class->upling_chain($eid);
	
			for($i=0;$i<count($result);$i++){
				if($i==count($result)-1){$html.=$result[$i]['name'];}
				else{
					$html.='<a class="tree-user" href="'.vma_ad().$this->uri->rsegment(1).'/get_tree/'.$result[$i]['usercode'].'">'.$result[$i]['name'].'</a>&nbsp;&nbsp;<i class="icon-angle-right"></i>&nbsp;&nbsp;';
				}		
			}
		return $html;
	}
	
	function upling_chain_select($eid){
		$html='';
		$result		=	$this->vma_class->upling_chain($eid);
	
			for($i=0;$i<count($result);$i++){
				if($i==count($result)-1){$html.='<span class="spna-bold">'.$result[$i]['name'].' ('.$result[$i]['usercode'].')</span>';}
				else{
					$html.=''.$result[$i]['name'].'</a>&nbsp;&nbsp;<i class="icon-angle-right"></i>&nbsp;&nbsp;';
				}		
			}
		return $html;
	}
	
	function select_user($eid)
	{
		$arr=array();
		$arr['upling_chain']	=	$this->upling_chain_select($eid);
		echo json_encode($arr);
	}
		
		
}

