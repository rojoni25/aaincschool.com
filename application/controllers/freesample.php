<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class freesample extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('notification_module','',TRUE);
 	}
	public function index()
	{	
		$data['contain']=$result=$this->notification_module->get_pages_contain('freesample_page');
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function get_noti()
	{
		$rt 	=	$this->notification_module->get_notification();
		$arr=array('alert-error','alert-success','alert-info');
		$html='';
		for($i=0;$i<count($rt);$i++)
		{
			$ref_code=($rt[$i]['status']=='Active') ? $rt[$i]['referralid'] : $rt[$i]['referralid_free'];
			$ref_dt=$this->notification_module->member_detail($ref_code);
			
			$html.='<div class="alert noto-div">
					<p class="noti-date">'.date('jS F Y',$rt[$i]['timedt']).' <sub>'.ago_time(date('d-m-Y H:i:s',$rt[$i]['timedt'])).'</sub></p>
					<button type="button" class="close btn-delete" data-dismiss="alert" value="'.$rt[$i]['notification_code'].'">&times;</button>
					'.$rt[$i]['contain'].'<br>
					<ul class="list_um">
						<li>Member Name :<strong>'.$rt[$i]['mem_nm'].'</strong></li>
						<li>Member ID :<strong>'.$rt[$i]['by_usercode'].'</strong></li>
						<li>Referral Name :<strong>'.$ref_dt[0]['nm'].' ('.$ref_dt[0]['usercode'].')</strong></li>
					</ul>
					<div style="clear:both;overflow:hidden;"></div>
			</div>';
		}
		return $html;			

	}
	function record_update($eid)
	{
		$data=array();
		$data['status']			=	'Inactive';
		$data['update_time']	=	time();
		$this->notification_module->update($data,'notification_master','notification_code',$eid);
	}	
}