<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_kdk_upgrade extends CI_Controller {
	
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	
	protected $upling_user	=	'';
	protected $upling_posi	=	'';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_kdk_upgrade_model','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	public function view($eid)
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_kdk_upgrade_view',$data);
		$this->load->view('comman/footer');
	}
	
	function listing(){
		
		$result=$this->ObjM->kdk_request_upgrade();
		
		$count=$this->ObjM->get_tot_pif_report();
		
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => $count[0]['tot'],
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			
			$btn='<a class="show-pop-event" href="'.$result[$i]['id'].'"><span class="label label-success">Upgrade Membership</span></a>';
			
			$row = array(
					$result[$i]['id'],
					$result[$i]['usercode'],
					$result[$i]['name'],
					date('d-M-Y', $result[$i]['time_dt']),
					$result[$i]['msg'],
					$btn,
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function upgrade_form($id)
	{
		$result			=	$this->ObjM->get_member_record($id);
		$active_member_list		=	$this->ObjM->get_all_active_member();	
		
		
		if(isset($result[0])){
			$html='<div class="pop-div-main">
			<form action="'.base_url().'index.php/'.$this->uri->segment(1).'/upgrade_membership" method="POST" id="frm_pay">
				<input type="hidden" value="'.$result[0]['id'].'" name="pay_code">
				<table class="table table-striped table-bordered dataTable">
				<tr><td colspan="3"><h4>KDK Member Upgrade<h4></td></tr>
				<tr><td>Member Name</td><td></td><td>'.$result[0]['name'].'</td></tr>
				<tr><td>Usercode</td><td></td><td>'.$result[0]['usercode'].'</td></tr>
				<tr><td>Referralid</td><td></td><td>'.$this->ref_select_list($active_member_list).'</td></tr>
				<tr class="tr_submit_tr"><td></td><td></td><td class="tr_submit_td"><button type="submit" class="btn btn-success btnsubmit"><strong>Upgrade Membership</strong></button></td></tr>
				<tr><td></td><td></td><td class="submit_process"></td></tr>
				</table>
			</form><div>';
		
		}else{
			$html='invalid';
		}
		echo $html;
		
	}
	
	
	function ref_select_list($result)
	{
		 $html='<select name="referralid" id="referralid">';
                for($i=0;$i<count($result);$i++){
						$name=$ref[$i]['fname'].' '.$ref[$i]['lname'];
						$html.='<option value="'.$result[$i]['usercode'].'">'.$result[$i]['name'].'  ('.$result[$i]['usercode'].')</option>';
					}	
					
         $html.='</select>';
		 return $html;
	}
	
	function upgrade_membership(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$result					=	$this->ObjM->get_member_record($_POST['pay_code']);
			
			if(!isset($result[0])){
				header('Location: '.base_url().'index.php/r_matrix_kdk_upgrade/view');
				exit;	
			}
			
			$referralid				=	$_POST['referralid'];
			$usercode				=	$result[0]['usercode'];
			$data = array();
			$data['referralid']		=	$referralid;
			$data['status']			=	'Active';
			$data['active_dt']		=	time();	
			$data['due_time']		=	strtotime('+1 month',time());
			$data['active_date'] 	=	strtotime(date('d-m-Y'));
			$this->ObjM->update($data,'membermaster','usercode',$usercode);	
			//***member status update***//
			
			
			
			
			
			
			$balance_sheet['usercode']	=	$usercode;
			$this->ObjM->addItem($balance_sheet,'master_balance_sheet');
			$this->ObjM->addItem($balance_sheet,'member_level_track_master');
		
			$data2=$this->entry_in_tree($referralid,$usercode);
			$data2['usercode']	=	$usercode;		
			$this->level_update($data2);
		
			$this->payment_insert($result[0]);
			
			$this->send_email_after_active($result[0]);
					
		
			$this->session->set_flashdata('show_msg','KDK Member Upgrade Successfully');
			header('Location: '.base_url().'index.php/r_matrix_kdk_upgrade/view');
			exit;
			
				
		}
	}
	
	protected function entry_in_tree($usercode,$uid){
		
			$data=array();
			$data['usercode']			=	$uid;
			
			$set_arr=array('field' => 'uplingmember3_3','position' => 3);
			$this->first_lavel_set($usercode,$set_arr);
			
			$data['uplingmember3_3']	=	$this->upling_user;
			$data['side_3_3']			=	$this->upling_posi;;
			
			$set_arr=array('field' => 'uplingmember5_3','position' => 5);
			$this->first_lavel_set($usercode,$set_arr);
			$data['uplingmember5_3']	=	$this->upling_user;
			$data['side_5_3']			=	$this->upling_posi;
			
			$set_arr=array('field' => 'uplingmember10_3','position' => 10);
			$this->first_lavel_set($usercode,$set_arr);
			$data['uplingmember10_3']	=	$this->upling_user;
			$data['side_10_3']			=	$this->upling_posi;
		
			$this->ObjM->addItem($data,'member_node_master');
			return $data;
		
	}
	
	protected function first_lavel_set($eid,$type){
		
		$result	=	$this->ObjM->get_usercode_by_tree($eid,$type['field']);
		
		///level One Setting///
		if(count($result)<$type['position']){
			$this->upling_user = $eid;
			$this->upling_posi = count($result)+1;
			return;	
		}
		
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['usercode'];
			
		}
		$this->tree_check_postion($arr,$type);
	}
	
	
	protected function tree_check_postion($arr_mem, $type){
		
		for($pos=0;$pos<$type['position'];$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
				
				$result=$this->ObjM->get_count_by_tree($arr_mem[$i],$type['field']);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					$this->upling_posi = $result[0]['tot']+1;
					return;		
				}
			
			}
		}
		
		
		
		/////
		$child_mem=array();
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->ObjM->get_usercode_by_tree($arr_mem[$i],$type['field']);			
			
		}
		
		
		$re_arr=array();
		for($pos=0;$pos<$type['position'];$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			
			}
		}
		
		$this->tree_check_postion($re_arr,$type);
		
	}
	
	
	function send_email_after_active($result)
	{
		
		$member_email	=	$this->ObjM->get_member_by_id($result['usercode']);
		$ref_email		=	$this->ObjM->get_member_by_id($_POST['referralid']);
		
			
			
			
		// $message='<p>Name	:'.$member_email[0]['fname'].' '.$member_email[0]['lname'].' is Acive Under Your Downline</p>';
		// $message.='<p>Email	:'.$member_email[0]['emailid'].'</p>';
		// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
		$message = get_email_cms_page_master('nllsys_active_member')->result()[0]->textdt;
					$message = str_replace("[fname]",$member_email[0]['fname'],$message);
					$message = str_replace("[lname]",$member_email[0]['lname'],$message);
					$message = str_replace("[email]",$member_email[0]['emailid'],$message);
					$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
		$e_array=array("heading"=>"Member Active","msg"=>$message,"contain"=>'');	
		 $message=email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('NLLSYS Active Member');
		// $this->email->message($message);
		// $this->email->to($ref_email[0]['emailid']);
  //       $this->email->send();
		 sendemail(FROM_EMAIL,'NLLSYS Active Member',$ref_email[0]['emailid'],$message);
		
		
		
		$message ='<p>Name	:'.$member_email[0]['fname'].' '.$member_email[0]['lname'].' Your Are Acive</p>';
		$message.='<p>Email	:'.$member_email[0]['emailid'].'</p>';
		$message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
		$e_array=array("heading"=>"Member Active","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('NLLSYS Active Member');
		// $this->email->message($message);
		// $this->email->to($member_email[0]['emailid']);
  //       $this->email->send();
		sendemail(FROM_EMAIL,'NLLSYS Active Member',$member_email[0]['emailid'],$message);
		
		
		
	}
	
	function level_update($arr)
	{
		
		$level_two3		=	$this->ObjM->get_upling_member($arr['uplingmember3_3'],'uplingmember3_3');
		$level_three3	=	$this->ObjM->get_upling_member($level_two3[0]['upling'],'uplingmember3_3');
		
		$level_two5		=	$this->ObjM->get_upling_member($arr['uplingmember5_3'],'uplingmember5_3');
		$level_three5	=	$this->ObjM->get_upling_member($level_two5[0]['upling'],'uplingmember5_3');
		
		
		$level_two10	=	$this->ObjM->get_upling_member($arr['uplingmember10_3'],'uplingmember10_3');
		$level_three10	=	$this->ObjM->get_upling_member($level_two10[0]['upling'],'uplingmember10_3');
		
		//*****3by3 level update*****//
		$this->ObjM->member_level_track_update($arr['uplingmember3_3'],'level_one3','active_level_one3');
		$this->ObjM->member_level_track_update($level_two3[0]['upling'],'level_two3','active_level_two3');
		$this->ObjM->member_level_track_update($level_three3[0]['upling'],'level_three3','active_level_three3');
		
		//*****5by3 level update*****//
		$this->ObjM->member_level_track_update($arr['uplingmember5_3'],'level_one5','active_level_one5');
		$this->ObjM->member_level_track_update($level_two5[0]['upling'],'level_two5','active_level_two5');
		$this->ObjM->member_level_track_update($level_three5[0]['upling'],'level_three5','active_level_three5');
		
		//*****10by3 level update*****//
		$this->ObjM->member_level_track_update($arr['uplingmember10_3'],'level_one10','active_level_one10');
		$this->ObjM->member_level_track_update($level_two10[0]['upling'],'level_two10','active_level_two10');
		$this->ObjM->member_level_track_update($level_three10[0]['upling'],'level_three10','active_level_three10');
		
		//system level tree update
		$result		=		$this->ObjM->get_system_level($arr['uplingmember3_3'],'system_level_3');
		$level['system_level_3']=$result[0]['level']+1;
		$result		=		$this->ObjM->get_system_level($arr['uplingmember5_3'],'system_level_5');
		$level['system_level_5']=$result[0]['level']+1;
		$result		=		$this->ObjM->get_system_level($arr['uplingmember10_3'],'system_level_10');
		$level['system_level_10']=$result[0]['level']+1;
		$this->ObjM->update($level,'member_level_track_master','usercode',$arr['usercode']);	
		//exit;
	}
	
	function payment_insert($arr){
		
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			$package_amount = $this->ObjM->get_setting_value_by_lable('package_amount');
			
			$data['usercode']	=	$arr['usercode'];
			$data['amount']		=	59;
			$data['paydate']	=	$nowdt;
			$data['pay_day']	=	date('d');
			$data['pay_month']	=	date('m');
			$data['pay_year']	=	date('Y');
			$data['timedt']		=	time();
			$data['due_time']	=	strtotime('+1 month',time());
			$data['status']		=	'Open';
			$paymentcode		=	$this->ObjM->addItem($data,'payment_master');	
		
			$upling_member		=	$this->ObjM->get_tree_upling($arr['usercode'],'uplingmember3_3');
			
			
			$payment_amount		=	$this->payment_amount();
			
			
			
			
			$commission			=	array($payment_amount['commission_level1'],$payment_amount['commission_level2'],$payment_amount['commission_level3']);
			
			$virtual			=	array($payment_amount['virtual_balance_level1'],$payment_amount['virtual_balance_level2'],$payment_amount['virtual_balance_level3']);
			
			$virtual_pay_type	=	array('3by3','5by3','10by3');
			
			$data=array();
			
			for($i=0;$i<count($upling_member);$i++){
				
				$data['paymentcode']	=	$paymentcode;
				$data['ref_code']		=	$arr['usercode'];
				$data['timedt']			=	$nowdt;
				$data['usercode']		=	$upling_member[$i];
				$data['amount']			=	$commission[$i];
				$data['type']			=	'monthly';		
				$this->ObjM->addItem($data,'payment_monthly');
				
				$this->ObjM->master_balance_update('main_balance',$upling_member[$i],$commission[$i],'plus');
				
				
				$data['amount']			=	$virtual[$i];
				$data['type']			=	$virtual_pay_type[$i];
				$this->ObjM->addItem($data,'payment_monthly');
				
				$this->ObjM->master_balance_update($virtual_pay_type[$i],$upling_member[$i],$virtual[$i],'plus');
				
			}	
			
			$data=array();
			$data['usercode']		=	'0';
			$data['amount']			=	$payment_amount['default_commission_to_admin'];
			$data['adminfee']		=	'1';
			$data['type']			=	'monthly';
			$data['timedt']			=	$nowdt;
			$this->ObjM->addItem($data, 'payment_monthly');
			
			$this->ObjM->master_balance_update('main_balance',0,$payment_amount['default_commission_to_admin'],'plus');
			
			$this->coded_residual($arr['usercode'],$paymentcode);
			$this->coded_residual_payment($arr['usercode'],$paymentcode);
			
			
			
	}
	
	function payment_amount(){
		$result		=	$this->ObjM->get_setting_value_all();
		for($i=0;$i<count($result);$i++){
			$data[$result[$i]['lable_acces_nm']]	=	$result[$i]['setting_value'];
		}
		return $data;
	}
	
	
	function coded_residual($usercode,$paymentcode)
	{
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$ref_user	=	$this->ObjM->get_user_reffral($usercode);
		$referralid =	$ref_user[0]['referralid'];
		
		$tot=$this->ObjM->get_total_reffral($referralid);
		if($tot[0]['tot'] > 2)
		{
			$data['usercode']		=	$usercode;
			$data['type']			=	'coded';
			$data['usercode_by']	=	$referralid;
			$data['adminfee']		=	'0';
			$this->ObjM->addItem($data,'coded_residual');
			
			$coded_match_usercode	=	$this->ObjM->get_user_reffral($referralid);
			$coded_match_usercode 	=	$coded_match_usercode[0]['referralid'];
			
			if($ref[0]['referralid']=='0'){
					$data['adminfee']			=	'1';
					$d_data['adminfee']			=	'1';
			}
			else{
					$data['adminfee']			=	'0';
			}
			
			$data['usercode']		=	$usercode;
			$data['type']			=	'coded_match';
			$data['usercode_by']	=	$coded_match_usercode;
			$this->ObjM->addItem($data,'coded_residual');
			
				
		}//end if
		else{
			$ref=$this->ObjM->get_coded_residual_entry($referralid); 
			
			if(isset($ref[0])){
				if($ref[0]['type']=='residual'){
					$data['level']		=	$ref[0]['level']+1;
				}
				
				$data['usercode']		=	$usercode;
				$data['type']			=	'residual';
				$data['usercode_by']	=	$ref[0]['ucode'];
				$this->ObjM->addItem($data,'coded_residual');
				
			}
			
			$ref=$this->ObjM->get_coded_match_residual_match($referralid);
			if(isset($ref[0]))
			{
				if($ref[0]['type']=='residual_match'){
					$data['level']		=	$ref[0]['level']+1;
				}
				$data['usercode']		=	$usercode;
				$data['type']			=	'residual_match';
				$data['usercode_by']	=	$ref[0]['ucode'];
				$this->ObjM->addItem($data,'coded_residual');
				
			}
	
			//exit;
		}//end else
	}
	
	protected function coded_residual_payment($usercode,$paymentcode)
	{
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
		$member	=	$this->ObjM->get_coded_residual($usercode);
		
		$payment_amount		=	$this->payment_amount();
		
		for($i=0;$i<count($member);$i++){
			
			$data['usercode']		=	$member[$i]['usercode_by'];
			$data['paymentcode']	=	$paymentcode;
			$data['ref_code']		=	$usercode;
			$data['timedt']			=	$nowdt;
		
			

			if($member[$i]['type']=='residual'){
				$data['amount']		=	$payment_amount['codded_residual'];
				$data['type']		=	'residual';
			}
			elseif($member[$i]['type']=='residual_match'){
				
				$data['amount']		=	$payment_amount['coded_residual_match'];
				$data['type']		=	'residual_match';
			
			}
			elseif($member[$i]['type']=='coded'){	
				$data['amount']		=	$payment_amount['enrollment_code'];
				$data['type']		=	'coded';
				
			}
			elseif($member[$i]['type']=='coded_match'){				
				$data['amount']		=	$payment_amount['enrollment_code_match'];
				$data['type']		=	'coded_match';
			}
			
			$this->ObjM->addItem($data,'payment_monthly');
			
			$this->ObjM->master_balance_update('main_balance',$member[$i]['usercode_by'],$data['amount'],'plus');
			
			
		}
		
	}
	
	
}

