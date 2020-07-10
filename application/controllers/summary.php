<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class summary extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('summary_model','ObjM',TRUE); 
 	}
	
	public function index()
	{
		$data['level']=$this->get_summary();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('summary_view',$data);
		$this->load->view('comman/footer');
	}
	
	function get_summary()
	{
		
		$coded_pay			=	$this->ObjM->get_setting_value_by_lable('enrollment_code');
		$coded_match_pay	=	$this->ObjM->get_setting_value_by_lable('enrollment_code_match');
		$residual_pay		=	$this->ObjM->get_setting_value_by_lable('codded_residual');
		$residual_match_pay	=	$this->ObjM->get_setting_value_by_lable('coded_residual_match');
		
		$coded				=	$this->ObjM->get_coded_residual_id('coded');
		$coded_match		=	$this->ObjM->get_coded_residual_id('coded_match');
		$residual			=	$this->ObjM->get_coded_residual_id('residual');
		$residual_match		=	$this->ObjM->get_coded_residual_id('residual_match');
		
		$tot_amount=$coded[0]['tot']*$coded_pay[0]['setting_value'];
		$tot_amount=$tot_amount+($coded_match[0]['tot']	*	$coded_match_pay[0]['setting_value']);
		$tot_amount=$tot_amount+($residual[0]['tot']	*	$residual_pay[0]['setting_value']);
		$tot_amount=$tot_amount+($residual_match[0]['tot']*	$residual_match_pay[0]['setting_value']);
		
		$tot_member=$coded[0]['tot']+$coded_match[0]['tot']+$residual[0]['tot']+$residual_match[0]['tot'];
		$html='
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
					<tr>
						<td><strong>Total</strong></td>
						<td><strong>'.$tot_member.'<strong></td>
						<td><strong>$'.number_format($tot_amount,2).'<strong></td>
					</tr>
					</table>';
		return $html;
	}
	
	function account_summary(){
		
		if($this->session->userdata['logged_ol_member']['status']=='Active')
		{ 
			if($this->session->userdata['tbl']['current_account']=='Active')
			{
					$data['html']=$this->paid_summary();	
						
			}
			else{
					$data['html']=$this->free_summary();
			}
		}
		if($this->session->userdata['logged_ol_member']['status']=='Pending')
		{
			$data['html']=$this->free_summary($summary);
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('summary_account_view',$data);
		$this->load->view('comman/footer');
		
	}
	
	protected function paid_summary()
	{
		$data['master_sheet']		=	$this -> ObjM -> get_daily_payment_paid();
		$data['pay_monthly']		=	$this -> ObjM -> sum_monthly_pay_by_type('monthly');
		$data['pay_c']				=	$this -> ObjM -> sum_monthly_pay_by_type('coded');
		$data['pay_cm']				=	$this -> ObjM -> sum_monthly_pay_by_type('coded_match');
		$data['pay_r']				=	$this -> ObjM -> sum_monthly_pay_by_type('residual');
		$data['pay_rm']				=	$this -> ObjM -> sum_monthly_pay_by_type('residual_match');
		$data['pay_refill']			=	$this -> ObjM -> sum_monthly_pay_by_type('refill');
		$data['daily_3']			=	$this -> ObjM -> sum_daily_pay_by_type('3by3');
		$data['daily_5']			=	$this -> ObjM -> sum_daily_pay_by_type('5by3');
		$data['daily_10']			=	$this -> ObjM -> sum_daily_pay_by_type('10by3');
		$tot_withdrawal				=	$this -> ObjM -> sum_withdrawal_balance('main_balance');	
		$tot_pif					=  	$this -> ObjM -> sum_withdrawal_balance_by_type('3');
			
		$html='<table class="table">
					<tr><td width="34%">3x3 Monthly</td><td width="1%">:</td><td width="65%"><span>$'.number_format($data['pay_monthly'],2).'</span></td></tr>
					<tr><td>3x3 Daily</td><td>:</td><td><span>$'.number_format($data['daily_3'],2).'</span></td></tr>
					<tr><td>5x3 Daily</td><td>:</td><td><span>$'.number_format($data['daily_5'],2).'</span></td></tr>
					<tr><td>10x3 Daily</td><td>:</td><td><span>$'.number_format($data['daily_10'],2).'</span></td></tr>
					<tr><td>Coded</td><td>:</td><td><span>$'.number_format($data['pay_c'],2).'</span></td></tr>
					<tr><td>Matching Coded</td><td>:</td><td><span>$'.number_format($data['pay_cm'],2).'</span></td></tr>
					<tr><td>Residual</td><td>:</td><td><span>$'.number_format($data['pay_r'],2).'</span></td></tr>
					<tr><td>Residual Match</td><td>:</td><td><span>$'.number_format($data['pay_rm'],2).'</span></td></tr>
					<tr><td>Total Withdrawal</td><td>:</td><td><span>$'.number_format($tot_withdrawal,2).'</span></td></tr>
					<tr><td>Total PIF</td><td>:</td><td><span>$'.number_format($tot_pif,2).'</span></td></tr>
					<tr><td>Company Wallet</td><td>:</td><td><span>$'.$data['master_sheet'][0]['main_balance'].'</span></td></tr>
					<tr><td>Personal Wallet</td><td>:</td><td><span>$'.$data['master_sheet'][0]['personal_wallet'].'</span></td></tr>
				</table>';
		return $html;		
	}
	
	protected function free_summary()
	{
			
			$summary	=	$this->ObjM->get_level_summary();
			$one		=	$this->ObjM->get_setting_value_by_lable('commission_level1');
			$two		=	$this->ObjM->get_setting_value_by_lable('commission_level2');
			$three		=	$this->ObjM->get_setting_value_by_lable('commission_level3');
			$monthly_total=($summary[0]['active_level_one3']*$one[0]['setting_value'])+($summary[0]['active_level_two3']*$two[0]['setting_value'])+($summary[0]['active_level_three3']*$three[0]['setting_value']);
			$coded					=	$this->ObjM->get_coded_residual_id('coded');
			$coded_match			=	$this->ObjM->get_coded_residual_id('coded_match');
			$residual				=	$this->ObjM->get_coded_residual_id('residual');
			$residual_match			=	$this->ObjM->get_coded_residual_id('residual_match');
			
			$coded_pay				=	$this->ObjM->get_setting_value_by_lable('enrollment_code');
			$coded_match_pay		=	$this->ObjM->get_setting_value_by_lable('enrollment_code_match');
			$residual_pay			=	$this->ObjM->get_setting_value_by_lable('codded_residual');
			$residual_match_pay		=	$this->ObjM->get_setting_value_by_lable('coded_residual_match');
			$payment	=	$this->ObjM->get_daily_payment_free();
			
			
			$html='<table class="table">
						<tr><td width="34%">3x3 Monthly</td><td width="1%">:</td><td width="65%"><span>$'.number_format($monthly_total,2).'</span></td></tr>
						<tr><td>3x3 Daily</td><td>:</td><td><span>$'.$payment[0]['3by3daily'].'<span></td></tr>
						<tr><td>5x3 Daily</td><td>:</td><td><span>$'.$payment[0]['5by3daily'].'<span></td></tr>
						<tr><td>10x3 Daily</td><td>:</td><td><span>$'.$payment[0]['10by3daily'].'<span></td></tr>
						<tr><td>Coded</td><td>:</td><td><span>$'.number_format($coded[0]['tot']*$coded_pay[0]['setting_value'],2).'<span></td></tr>
						<tr><td>Matching Coded</td><td>:</td><td><span>$'.number_format($coded_match[0]['tot']*$coded_match_pay[0]['setting_value'],2).'<span></td></tr>
						<tr><td>Residual</td><td>:</td><td><span>$'.number_format($residual[0]['tot']*$residual_pay[0]['setting_value'],2).'<span></td></tr>
						<tr><td>Residual Match</td><td>:</td><td><span>$'.number_format($residual_match[0]['tot']*$residual_match_pay[0]['setting_value'],2).'<span></td></tr>
						<tr><td>Wallet</td><td>:</td><td><span>$'.$pay[3].'</span></td></tr>
			</table>';
			return $html;
	}

}

