<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daily_payment_by_member extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('daily_payment_by_member_model','ObjM',TRUE);
		ob_start();
 	}
	
	public function view()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$data['html']=$this->listing();
			$data['count']=$this->ObjM->get_count();
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	protected function listing()
	{
		$html='';
		$result=$this->ObjM->getAll();
		$time_stm=strtotime($_POST['daily_date']);
		for($i=0;$i<count($result);$i++){
			$html.='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.date('d-m-Y',$result[$i]['time_stm']).'</td>
						<td>'.$result[$i]['balance_type'].'</td>
						<td>$'.$result[$i]['amount'].'</td>
						<td><a class="payment_to" href="'.base_url().'index.php/'.$this->uri->segment(1).'/get_payment_to/'.$result[$i]['usercode'].'/'.$_POST['report_type'].'/'.$time_stm.'" class="">Pay To</a></td>
						<td><a href="'.base_url().'index.php/virtual_balance/details/'.$result[$i]['usercode'].'/'.$_POST['report_type'].'">Detail</a></td>
					</tr>';
		}
		return $html;
	}
	
	
	
	
	function get_payment_to($user,$type,$time){
		$arr=array(
			'usercode'=>$user,
			'pay_type'=>$type,
			'timestm'=>$time
		);
		$result=$this->ObjM->get_payment_to($arr);
		
		
		$html='<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Amount</th>
					</tr>
				</thead>
					<tbody>';		
				for($i=0;$i<count($result);$i++){
						$html.='<tr>
							<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
							<td>$'.$result[$i]['amount'].'</td>
						</tr>';						
					}			
			$html.='</tbody>
			</table>';
			echo $html;
		
	}
	
	
	
	
	
	
	
}

