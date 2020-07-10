<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdrawal extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('vma/withdrawal_model','ObjM',TRUE);
		$this->load->library('vma_class');
 	}
	
	
	public function request()
	{
		$data['html'] = $this->request_listing();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'withdrawal_list',$data);
		$this->load->view('comman/footer');
	}
	
	function request_listing(){
		$result = $this->ObjM->withdrawal_request();
		$html='';	
		for($i=0;$i<count($result);$i++){
			$row=$i+1;
			$html.='<tr>
				<td>'.$row.'</td>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.$result[$i]['username'].'</td>
				<td>'.$result[$i]['amount'].'</td>
				<td>'.$result[$i]['text_dt'].'</td>
				<td>'.date('d-m-Y',strtotime($result[$i]['date_dt'])).'</td>
				<td>
					<div class="btn-group">
							<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="'.vma_base().$this->uri->rsegment(1).'/delete_request/'.$result[$i]['id'].'">Delete</a></li>
								<li><a href="'.vma_base().$this->uri->rsegment(1).'/approve_request/'.$result[$i]['id'].'">Approve</a></li>
							</ul>
						</div>
				</td>	
			</tr>';	
		}
		return $html;
		
	}
	
	function delete_request($eid){
		$info	=	array();
		$info['status']	=	'delete';
		$r=$this->comman_fun->update($info,'vma_withdrawal',array('id'=>$eid,'status'=>'process'));
		if($r){
			$this->session->set_flashdata('show_msg','Request Delete');	
		}else{
			$this->session->set_flashdata('show_msg','Invaild');
		}

		header('Location: '.vma_base().$this->uri->rsegment(1).'/request');
		exit;
	}
	function approve_request($eid){
		$info	=	array();
		$info['status']	=	'confirm';
		$r=$this->comman_fun->update($info,'vma_withdrawal',array('id'=>$eid,'status'=>'process'));
		
		if($r){
			$this->session->set_flashdata('show_msg','Request Approve Successfully');
		}else{
			$this->session->set_flashdata('show_msg','Invaild');
		}
		
		
		header('Location: '.vma_base().$this->uri->rsegment(1).'/request');
		exit;
	}
	
	

}

