<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('dashboard_model','',TRUE); 
 	}
	
	public function index()
	{

		header('Location: '.base_url().'index.php/welcome');
		exit;
		$data['tot_member']=$this->dashboard_model->get_all_member_count();

		$this->load->model('comman_controler_model','ObjM',TRUE);
		if($this->session->userdata['logged_ol_member']['status']=='Active' && $this->session->userdata['tbl']['current_account']=='Active') { 
			$data['payment'] = $this->ObjM->get_daily_payment_paid();
		} else{
			$data['payment'] = $this->ObjM->get_daily_payment_free();
			$coded					=	$this->ObjM->get_coded_residual_id('coded');
			$coded_match			=	$this->ObjM->get_coded_residual_id('coded_match');
			$residual				=	$this->ObjM->get_coded_residual_id('residual');
			$residual_match			=	$this->ObjM->get_coded_residual_id('residual_match');
			
			$coded_pay				=	$this->ObjM->get_setting_value_by_lable('enrollment_code');
			$coded_match_pay		=	$this->ObjM->get_setting_value_by_lable('enrollment_code_match');
			$residual_pay			=	$this->ObjM->get_setting_value_by_lable('codded_residual');
			$residual_match_pay		=	$this->ObjM->get_setting_value_by_lable('coded_residual_match');

			$data['coded']=number_format($coded[0]['tot']*$coded_pay[0]['setting_value'],2);
			$data['matching_coded']=number_format($coded_match[0]['tot']*$coded_match_pay[0]['setting_value'],2);
		}
		
		
		if($this->session->userdata['logged_ol_member']['usercode']=='1')
		{
			$data['level_summery3']=$this->dashboard_model->get_level_summery_admin('system_level_3');
			$data['level_summery5']=$this->dashboard_model->get_level_summery_admin('system_level_5');
			$data['level_summery10']=$this->dashboard_model->get_level_summery_admin('system_level_10');
		}
		else{
			$data['summary']=$this->dashboard_model->get_level_summary();
		}
	
		$data['payment_monthly']=$this->get_monthly_payment();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dashboard_view',$data);
		$this->load->view('comman/footer');
	}
	
	function get_monthly_payment(){
		$summary	=	$this->dashboard_model->get_level_summary();
		
		$one		=	$this->dashboard_model->get_setting_value_by_lable('commission_level1');
		$two		=	$this->dashboard_model->get_setting_value_by_lable('commission_level2');
		$three		=	$this->dashboard_model->get_setting_value_by_lable('commission_level3');
		
		$coded_pay			=	$this->dashboard_model->get_setting_value_by_lable('enrollment_code');
		$coded_match_pay	=	$this->dashboard_model->get_setting_value_by_lable('enrollment_code_match');
		$residual_pay		=	$this->dashboard_model->get_setting_value_by_lable('codded_residual');
		$residual_match_pay	=	$this->dashboard_model->get_setting_value_by_lable('coded_residual_match');
		
		$total_peple=$summary[0]['level_one3']+$summary[0]['level_two3']+$summary[0]['level_three3'];
		$total_active=$summary[0]['active_level_one3']+$summary[0]['active_level_two3']+$summary[0]['active_level_three3'];
		
		$total_one	=	number_format($summary[0]['active_level_one3']	*	$one[0]['setting_value'],2);
		$total_two	=	number_format($summary[0]['active_level_two3']	*	$two[0]['setting_value'],2);
		$total_three=	number_format($summary[0]['active_level_three3']	*	$three[0]['setting_value'],2);
		$grant_total=	number_format($total_one + $total_two + $total_three,2);
		$html='
  <div class="span4">
    <table class="table table-bordered">
     <tr>
      	<th colspan="3">Monthly Payment 3 x 3</th>
      </tr>
      <tr>
        <th>Level</th>
        <th>People</th>
        <th>NO. of Active Users</th>
		<th>Amount</th>
      </tr>
      <tr>
        <th>Level-1</th>
        <th>'.$summary[0]['level_one3'].'</th>
        <th>'.$summary[0]['active_level_one3'].'</th>
		<th>$'.$total_one.'</th>
      </tr>
      <tr>
        <th>Level-2</th>
        <th>'.$summary[0]['level_two3'].'</th>
        <th>'.$summary[0]['active_level_two3'].'</th>
		<th>$'.$total_two.'</th>
      </tr>
      <tr>
        <th>Level-3</th>
         <th>'.$summary[0]['level_three3'].'</th>
         <th>'.$summary[0]['active_level_three3'].'</th>
		 <th>$'.$total_three.'</th>
      </tr>
      <tr>
        <th><strong>Total</strong></th>
        <th>'.$total_peple.'</th>
        <th>'.$total_active.'</th>
		<th>$'.$grant_total.'</th>
      </tr>
    </table>
  </div>';
  		
		$coded			=	$this->dashboard_model->get_coded_residual_id('coded');
		$coded_match	=	$this->dashboard_model->get_coded_residual_id('coded_match');
		$residual		=	$this->dashboard_model->get_coded_residual_id('residual');
		$residual_match	=	$this->dashboard_model->get_coded_residual_id('residual_match');
		//
		
  
		$html .='<div class="span4">
				 <table class="table table-bordered">
     				<tr>
      					<th colspan="3">Monthly Payment </th>
      				</tr>
					<tr>
      					<th>Type</th>
						<th>Total Member</th>
						<th>Total Amount</th>
      				</tr>
					<tr>
						<td>Coded</td>
						<td>'.$coded[0]['tot'].'</td>
						<td>$'.number_format($coded[0]['tot']*$coded_pay[0]['setting_value'],2).'</td>
					</tr>
					<tr>
						<td>Matching Coded</td>
						<td>'.$coded_match[0]['tot'].'</td>
						<td>$'.number_format($coded_match[0]['tot']*$coded_match_pay[0]['setting_value'],2).'</td>
					</tr>
					<tr>
						<td>Residual</td>
						<td>'.$residual[0]['tot'].'</td>
						<td>$'.number_format($residual[0]['tot']*$residual_pay[0]['setting_value'],2).'</td>
					</tr>
					<tr>
						<td>Res-Match</td>
						<td>'.$residual_match[0]['tot'].'</td>
						<td>$'.number_format($residual_match[0]['tot']*$residual_match_pay[0]['setting_value'],2).'</td>
					</tr>
					</table>
					<input type="hidden" id="llbcoded" value="'.$coded[0]['tot'].'">
					<input type="hidden" id="llbcoded_match" value="'.$coded_match[0]['tot'].'">
					<input type="hidden" id="llbresidual" value="'.$residual[0]['tot'].'">
					<input type="hidden" id="llbresidual_match" value="'.$residual_match[0]['tot'].'">
		</div>';
		return $html;
	}
	
	
	
	
	
}

