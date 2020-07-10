<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('user_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{	
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result=$this->user_model->getAll();
		
		$html='';
		for($i=0;$i<count($result);$i++){
			$ref=$this->user_model->get_total_reffral($result[$i]['usercode']);
			if($result[$i]['status']=='Inactive'){ $status='st_inactive';}
			else{$status='';}
			
			$html .='<tr class="'.$status.'">
						<td><input type="checkbox" value="'.$result[$i]['usercode'].'" class="recode_status_code"></td>
						<td>'.$result[$i]['fname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['password'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$ref[0]['tot'].'</td>
			
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['usercode'].'" class="edit_rcd">
								<i class="icon-pencil"></i>
							</a>&nbsp;&nbsp;
							<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd">
								<i class="icon-eye-open"></i>
							</a>
						</td>
              		</tr>';
		}
		
			echo $html;
		
	}
	
	function listing_active()
	{
		
		//$data['txt_query']='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		//$this->user_model->addItem($data,'test_query');
		
		$result=$this->user_model->getAll_active();	
		// $count=$this->user_model->get_tot_count_active();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			$edit='<a href="'.base_url().'index.php/profile/member_profile/'.$result[$i]['usercode'].'" class="edit_rcd">
					<i class="icon-pencil"></i></a>&nbsp;&nbsp;
					<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd">
					<i class="icon-eye-open"></i></a>';
			// $ref=$this->user_model->get_total_reffral($result[$i]['usercode']);
			$ref_name_details=$this->user_model->get_ref_name($result[$i]['referralid']);
			if($result[$i]['email_verification']=='N'){
				$usercode="<span class='no_verified'>".$result[$i]['usercode']."</span>";				
			}
			else{
				$usercode="<span class='verified'>".$result[$i]['usercode']."</span>";				
			}

			if($result[$i]['email_verification']=='N'){
				$email_v= "<a href='javascript:void(0)' onclick='email_verify(".$result[$i]['usercode'].")' > email verfy </a>";
			}
			else{
				$email_v=" ";
			}
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref_name_details[0]['fname'].' '.$ref_name_details[0]['lname'],
					$result[$i]['tot'],
					date('d-M-Y', $result[$i]['active_dt']),
					$edit,
					$email_v

			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function panding_member(){
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('panding_member_view');
		$this->load->view('comman/footer');
	}	

	
	function listing_pandding()
	{
		
		$result=$this->user_model->getAll_panding();
		$count=$this->user_model->get_tot_count_panding();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		$base_url=str_replace('ol_admin/','',base_url());
		
		for($i=0;$i<count($result);$i++){
			if($this->session->userdata['logged_in_visa']['user_type_id']=='1') {
				$edit='<a href="'.base_url().'index.php/profile/member_profile/'.$result[$i]['usercode'].'" class="edit_rcd"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
				       <a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd"><i class="icon-eye-open"></i></a>';
			}else{
				$edit='<a href="'.base_url().'index.php/profile/member_profile/'.$result[$i]['usercode'].'" class="edit_rcd"><i class="icon-pencil"></i></a>';
			}
			if($result[$i]['email_verification']=='N'){
				$usercode="<span class='no_verified'>".$result[$i]['usercode']."</span>";				
			}
			else{
				$usercode="<span class='verified'>".$result[$i]['usercode']."</span>";				
			}
			if($result[$i]['email_verification']=='N'){
				
			$email_v= "<a href='javascript:void(0)' onclick='email_verify(".$result[$i]['usercode'].")' > email verfy </a>"; 			
		//	$email_v= $result[$i]['usercode'];	
			}
			else{
				$email_v=" ";				
			}
			
			if($result[$i]['pagecode']!=0){
				$cap_page_name	=	$this->user_model->get_capture_page_name($result[$i]['pagecode']);
				$page_nm		=	($cap_page_name[0]['page_name']=='')?"Page" : $cap_page_name[0]['page_name'];
				$page_name		=	'<a target="_blank" href="'.$base_url.'index.php/capture/preview_after/'.$result[$i]['pagecode'].'/">'.$page_nm.'</a>';
			}
			else{
				$page_name		=	'<a target="_blank" href="'.$base_url.'index.php/rg/">Default</a>';
			}
			$joindate=date('d-m-y',strtotime($result[$i]['create_date']));
			$ref=$this->user_model->get_ref_name($result[$i]['referralid']);
			// $ref_total_count=$this->user_model->get_total_reffral($result[$i]['usercode']);
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref[0]['fname'].' '.$ref[0]['lname'],
					$result[$i]['tot'],
					$page_name,
					$joindate,
					$edit,
					$email_v
			);
			$output['aaData'][] = $row;
		}
		//var_dump($output);die;
		echo json_encode( $output );	
	}
	
	function inactive_member(){
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('inactive_member_view');
		$this->load->view('comman/footer');
	}

	function paid_member(){
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('paid_member_view');
		$this->load->view('comman/footer');
	}


	function listing_inactive()
	{
		$result=$this->user_model->getAll_inactive();
		$count=$this->user_model->get_tot_count_inactive();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		$base_url=str_replace('ol_admin/','',base_url());
		
		for($i=0;$i<count($result);$i++){
			$edit='<a href="'.base_url().'index.php/profile/member_profile/'.$result[$i]['usercode'].'" class="edit_rcd"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
			       <a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd"><i class="icon-eye-open"></i></a>';
			if($result[$i]['email_verification']=='N'){
				$usercode="<span class='no_verified'>".$result[$i]['usercode']."</span>";				
			}
			else{
				$usercode="<span class='verified'>".$result[$i]['usercode']."</span>";				
			}
			if($result[$i]['email_verification']=='N'){
				
			$email_v= "<a href='javascript:void(0)' onclick='email_verify(".$result[$i]['usercode'].")' > email verfy </a>"; 			
		//	$email_v= $result[$i]['usercode'];	
			}
			else{
				$email_v=" ";				
			}
			
			if($result[$i]['pagecode']!=0){
				$cap_page_name	=	$this->user_model->get_capture_page_name($result[$i]['pagecode']);
				$page_nm		=	($cap_page_name[0]['page_name']=='')?"Page" : $cap_page_name[0]['page_name'];
				$page_name		=	'<a target="_blank" href="'.$base_url.'index.php/capture/preview_after/'.$result[$i]['pagecode'].'/">'.$page_nm.'</a>';
			}
			else{
				$page_name		=	'<a target="_blank" href="'.$base_url.'index.php/rg/">Default</a>';
			}
			$joindate=date('d-m-y',strtotime($result[$i]['create_date']));
			$ref=$this->user_model->get_ref_name($result[$i]['referralid']);
			// $ref_total_count=$this->user_model->get_total_reffral($result[$i]['usercode']);
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref[0]['fname'].' '.$ref[0]['lname'],
					$result[$i]['tot'],
					$page_name,
					$joindate,
					$edit,
					$email_v
			);
			$output['aaData'][] = $row;
		}
		//var_dump($output);die;
		echo json_encode( $output );	
	}

	function listing_paid()
	{
		$result=$this->user_model->getAll_paid();
		$count=$this->user_model->get_tot_count_paid();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		$base_url=str_replace('ol_admin/','',base_url());
		
		for($i=0;$i<count($result);$i++){
			$edit='<a href="'.base_url().'index.php/profile/member_profile/'.$result[$i]['usercode'].'" class="edit_rcd"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
			       <a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd"><i class="icon-eye-open"></i></a>';
			if($result[$i]['email_verification']=='N'){
				$usercode="<span class='no_verified'>".$result[$i]['usercode']."</span>";				
			}
			else{
				$usercode="<span class='verified'>".$result[$i]['usercode']."</span>";				
			}
			if($result[$i]['email_verification']=='N'){
				
			$email_v= "<a href='javascript:void(0)' onclick='email_verify(".$result[$i]['usercode'].")' > email verfy </a>"; 			
		//	$email_v= $result[$i]['usercode'];	
			}
			else{
				$email_v=" ";				
			}
			
			if($result[$i]['pagecode']!=0){
				$cap_page_name	=	$this->user_model->get_capture_page_name($result[$i]['pagecode']);
				$page_nm		=	($cap_page_name[0]['page_name']=='')?"Page" : $cap_page_name[0]['page_name'];
				$page_name		=	'<a target="_blank" href="'.$base_url.'index.php/capture/preview_after/'.$result[$i]['pagecode'].'/">'.$page_nm.'</a>';
			}
			else{
				$page_name		=	'<a target="_blank" href="'.$base_url.'index.php/rg/">Default</a>';
			}
			$joindate=date('d-m-y',strtotime($result[$i]['create_date']));
			$ref=$this->user_model->get_ref_name($result[$i]['referralid']);
			// $ref_total_count=$this->user_model->get_total_reffral($result[$i]['usercode']);
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref[0]['fname'].' '.$ref[0]['lname'],
					$result[$i]['tot'],
					$page_name,
					$joindate,
					$edit,
					$email_v
			);
			$output['aaData'][] = $row;
		}
		//var_dump($output);die;
		echo json_encode( $output );	
	}
	
	function panding_member_active()
	{
		$data['result']		=	$this->user_model->get_record_panding_member($this->uri->segment(3));
		$data['payment']	=	$this->user_model->get_payment_status($this->uri->segment(3));
		
		$data['ref']		=	$this->user_model->ref_active_member();
		$data['ref_member'] =  	$this->user_model->get_record($data['result'][0]['referralid_free']);
		if(count($data['result'])!='1' && $data['payment'][0]['payment']!='Y')
		{
				$this->go_to_back();
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('panding_member_add',$data);
		$this->load->view('comman/footer');
	}
	
	function get_referralid_paid($referralid){
		$user['bread']=array();
		while(1)
		{
			$record=$this->user_model->get_record($referralid);
			
			if($record[0]['status']=='Active'){
				$user['bread'][]=$record;
			}
			if(!isset($record[0]))
			{
				$newArray = array_reverse($user['bread'], false);
				return $newArray;
			}
			$referralid=$record[0]['referralid'];
		}
		
		
	}
	
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->user_model->get_record($this->uri->segment(4));
			if(count($data['result'])!='1'){
				$this->go_to_back();
			}
		}
		$data['country']=$this->user_model->get_country();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			
				$data = array();
				$data['referralid']		=	$this->input->post('referralid');
				$data['status']			=	'Active';
				$data['active_dt']		=	time();	
				$data['due_time']		=	strtotime('+1 month',time());
				$data['active_date'] 	=	strtotime(date('d-m-Y'));
				$referralid=$this->input->post('referralid');
				
				
				
				//***paid_request update***//
				// $pay['status']='Paid';
				// $this->user_model->update($pay,'paid_request_master','usercode',$this->input->post('active_member_code'));	


				// UPDATE admin payment done
				$pay2['type']='processed';
				$this->user_model->update($pay2,'affiliate_confirm_message','usercode',$this->input->post('active_member_code'));

				// UPDATE affiliate payment done
				$pay['status']='processed';
				$this->user_model->update($pay,'payment_gateway_stripe','usercode',$this->input->post('active_member_code'));
				
				//***member status update***//
				$this->user_model->update($data,$this->table,$this->primary_key,$this->input->post('active_member_code'));	
				$usercode=$this->input->post('active_member_code');	
				
				$data2['usercode']=$usercode;	
				$data2=$this->entry_in_tree($referralid,$usercode);
					
				
				$this->level_update($data2);
			//	$this->send_email_after_active();
					
				session_start();
				$_SESSION['back_url'] 			= 	$this->uri->segment(1).'/panding_member';	
				$_SESSION['payment_usercode'] 	= 	$usercode;
				header('Location: '.base_url().'index.php/member_payment/insertrecord');
				exit;
			
				
		}
		header('Location: '.base_url().'index.php/upgrade_request');
		exit;
	}
	
	
	function send_email_after_active()
	{
		
		$member_email	=	$this->user_model->get_record($_POST['active_member_code']);
		$ref_email		=	$this->user_model->get_record($_POST['referralid']);
		
		$message='<p>Name	:'.$member_email[0]['fname'].' '.$member_email[0]['lname'].' is Acive Under Your Downline</p>';
		$message.='<p>Email	:'.$member_email[0]['emailid'].'</p>';
		$message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
		$e_array=array("heading"=>"Member Active","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		
		
		$message2 ='<p>Name	:'.$member_email[0]['fname'].' '.$member_email[0]['lname'].' Your Are Acive</p>';
		$message2.='<p>Email	:'.$member_email[0]['emailid'].'</p>';
		$message2.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
		$e_array=array("heading"=>"Member Active","msg"=>$message2,"contain"=>'');	
		$message2=email_template_one($e_array);
		
		$title		=	'NLLSYS 2018';
		$emailid	=	$member_email[0]['emailid'];
		$to 		= 	$member_email[0]['emailid'];
		$to2 		= 	$ref_email[0]['emailid'];
		$subject 	=	'NLLSYS Active Member';

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: '.$title.' <'.$emailid.'>' . "\r\n";
		mail($to,$subject,$message,$headers);
		mail($to2,$subject,$message2,$headers);
		
	}
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->user_model->update($data,$this->table,$this->primary_key,$code[$i]);	
			}
		}	
	}
	
	
	function auto_camplate(){
		$user=$this->user_model->get_user_filter($_GET["term"]);
		$json=array();
		for($i=0;$i<count($user);$i++){
			$name=$user[$i]['fname'].' '.$user[$i]['lname'].' ('.$user[$i]['usercode'].')';
			$json[]=array(
				'label'=>$name,
				'value'=>$user[$i]['usercode']
        	);
		}
		echo json_encode($json);
	}
	
	///**************************************************************************************************//
	
	
	
	
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
			
			
			
			$this->user_model->addItem($data,'member_node_master');
			return $data;
		
	}
	
	
    protected function first_lavel_set($eid,$type){
		
		$result	=	$this->user_model->get_usercode_by_tree($eid,$type['field']);
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
				
				$result=$this->user_model->get_count_by_tree($arr_mem[$i],$type['field']);
				
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
			
			$child_mem[]=$this->user_model->get_usercode_by_tree($arr_mem[$i],$type['field']);			
			
		}
		
		
		$re_arr=array();
		for($pos=0;$pos<$type['position'];$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			
			}
		}
		
		$this->tree_check_postion($re_arr,$type);
		
	}
	
	function level_update($arr)
	{
		$data3['usercode']	=	$arr['usercode'];
		$this->user_model->addItem($data3,'member_level_track_master');
		$this->user_model->addItem($data3,'master_balance_sheet');
		
		$level_two3		=	$this->user_model->get_upling_member($arr['uplingmember3_3'],'uplingmember3_3');
		$level_three3	=	$this->user_model->get_upling_member($level_two3[0]['upling'],'uplingmember3_3');
		
		$level_two5		=	$this->user_model->get_upling_member($arr['uplingmember5_3'],'uplingmember5_3');
		$level_three5	=	$this->user_model->get_upling_member($level_two5[0]['upling'],'uplingmember5_3');
		
		
		$level_two10	=	$this->user_model->get_upling_member($arr['uplingmember10_3'],'uplingmember10_3');
		$level_three10	=	$this->user_model->get_upling_member($level_two10[0]['upling'],'uplingmember10_3');
		
		//*****3by3 level update*****//
		$this->user_model->member_level_track_update($arr['uplingmember3_3'],'level_one3','active_level_one3');
		$this->user_model->member_level_track_update($level_two3[0]['upling'],'level_two3','active_level_two3');
		$this->user_model->member_level_track_update($level_three3[0]['upling'],'level_three3','active_level_three3');
		
		//*****5by3 level update*****//
		$this->user_model->member_level_track_update($arr['uplingmember5_3'],'level_one5','active_level_one5');
		$this->user_model->member_level_track_update($level_two5[0]['upling'],'level_two5','active_level_two5');
		$this->user_model->member_level_track_update($level_three5[0]['upling'],'level_three5','active_level_three5');
		
		//*****10by3 level update*****//
		$this->user_model->member_level_track_update($arr['uplingmember10_3'],'level_one10','active_level_one10');
		$this->user_model->member_level_track_update($level_two10[0]['upling'],'level_two10','active_level_two10');
		$this->user_model->member_level_track_update($level_three10[0]['upling'],'level_three10','active_level_three10');
		
		//system level tree update
		$result						=	$this->user_model->get_system_level($arr['uplingmember3_3'],'system_level_3');
		$level['system_level_3']	=	$result[0]['level']+1;
		$result						=	$this->user_model->get_system_level($arr['uplingmember5_3'],'system_level_5');
		$level['system_level_5']	=	$result[0]['level']+1;
		$result						=	$this->user_model->get_system_level($arr['uplingmember10_3'],'system_level_10');
		$level['system_level_10']	=	$result[0]['level']+1;
		$this->user_model->update($level,'member_level_track_master','usercode',$arr['usercode']);	
		//exit;
	}
	
	
	function go_to_back(){
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}

	function email_verify($id)
	{
		$this->user_model->email_verify($id);
		header('Location: '.base_url().'index.php/user/panding_member');
	}

	function paid_leader_wallet()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view("paid_leader_wallet_list");
		$this->load->view('comman/footer');
		
	}

	function paid_leader_wallet_get(){

		$result=$this->user_model->getAll_paid_leader_wallet();
		$html='';
		for($i=0;$i<count($result);$i++){
			
			$html .='<tr>
						<td>'.$result[$i]['fname']." ".$result[$i]['lname'].'</td>
						<td>'.$result[$i]['main_balance'].'</td>
						<td>'.$result[$i]['3by3'].'</td>
						<td>'.$result[$i]['3by3daily'].'</td>
						<td>'.$result[$i]['5by3daily'].'</td>
						<td>'.$result[$i]['10by3daily'].'</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
              		</tr>';
		}
		
			echo $html;
	}
}

