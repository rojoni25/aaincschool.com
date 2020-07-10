<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	protected $upling_reverse_user	=	'';
	protected $upling_reverse_posi	=	'';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
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
			
	        	   $Trow='<tr class="'.$status.'">';
	        
			$html .=$Trow;
					$html .='
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
		 $count=$this->user_model->get_tot_count_active();
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
			$walletamt = $this->user_model->gethiddenwalletamount($result[$i]['usercode']);
					$loginusercode = $result[$i]['usercode'];
            	$referralcount = countreferral($loginusercode);
            	 $QStatus=0;// For Qualified Status - 0 for Unqualified - 1 for Qualified 
	        	if($referralcount>=3){
	        	   $QStatus=1;
	        	}
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref_name_details[0]['fname'].' '.$ref_name_details[0]['lname'],
					$result[$i]['tot'],$walletamt,
					date('d-M-Y', $result[$i]['active_dt']),
					$edit,
					$email_v,
					$QStatus
					

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
			$ispaid=$this->user_model->is_paid($result[$i]['usercode']);
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
					$email_v,
					$ispaid
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
				$this->send_email_after_active();
				$this->enroll_wallet($usercode);	
				$this->entry_in_reverse_tree(2,$usercode);
				session_start();
				$_SESSION['back_url'] 			= 	$this->uri->segment(1).'/panding_member';	
				$_SESSION['payment_usercode'] 	= 	$usercode;
				header('Location: '.base_url().'index.php/member_payment/insertrecord');
				exit;
			
				
		}
		header('Location: '.base_url().'index.php/upgrade_request');
		exit;
	}
	
	function enroll_wallet($usercode){
		// $usercode=$this->input->post('active_member_code');	
		// $referralid=$this->input->post('referralid');
		$member_email	=	$this->user_model->get_record($usercode);
		$upgradelevel  = $this->user_model->get_upgrade_level($usercode);
        $levelcode =  $upgradelevel['level_code'];
		$data = array();
		$amount = $upgradelevel['level_amount'];
        $data['usercode'] =  $usercode;
        $data['email'] =  $member_email[0]['emailid'];
        $data['amount'] =  $amount;
        $data['level'] =  $levelcode;
        $data['date'] =  date('Y-m-d H:i:s');
        $this->user_model->addItem($data,'tbl_payment_wallet');

        //
        //
        $userdata = $this->user_model->get_userdata($usercode);
        $referalid = $userdata['referralid'];
        $referalamt =  $upgradelevel['level_referal_commision'];
        $data = array();
        $data['receiverid'] =  $referalid;
        $data['senderid'] =  $usercode;
        $data['amount'] =  $referalamt;
        $data['plan'] =  $levelcode;
        $data['date'] =  date('Y-m-d H:i:s');
        $this->user_model->addItem($data,'tbl_visible_wallet');
        //
        //
        $uplineid = $this->user_model->get_twoleveluplineid($usercode);
        $uplineamt =  $upgradelevel['level_upline_commision'];
        if($uplineid==''){$uplineid=0;}
        $data = array();
        $data['receiverid'] =  $uplineid;
        $data['senderid'] =  $usercode;
        $data['amount'] =  $uplineamt;
        $data['plan'] =  $levelcode;
        $data['date'] =  date('Y-m-d H:i:s');
        $this->user_model->addItem($data,'tbl_hidden_wallet');

        //Level Update
        $level['current_level']	=	$member_email[0]['current_level']+1;
		$this->user_model->update($level,'membermaster','usercode',$usercode);

		//Upgrade upline level
		$nextupgradelevel  = $this->user_model->get_upgrade_level($uplineid);
		$nextlevelamt =  $nextupgradelevel['level_amount'];
		$curlevel =  $nextupgradelevel['level_code']-1;
		if($curlevel>0){
			$curentwalletamt = $this->user_model->getmemberlevelwallet($uplineid,$curlevel);
			if($nextlevelamt==$curentwalletamt){
				$memberdata	=	$this->user_model->get_record($uplineid);
				$usercode=$uplineid;
				$referralid=$memberdata[0]['referralid'];
				$this->enroll_wallet($usercode);

				/*$upgradelevel  = $this->user_model->get_upgrade_level($usercode);
		        $levelcode =  $upgradelevel['level_code'];
		        $levelamt =  $upgradelevel['level_amount'];
				$data = array();
				$amount = $levelamt;
		        $data['usercode'] =  $usercode;
		        $data['email'] =  $memberdata[0]['emailid'];
		        $data['amount'] =  $amount;
		        $data['level'] =  $levelcode;
		        $data['date'] =  date('Y-m-d H:i:s');
		        $this->user_model->addItem($data,'tbl_payment_wallet');

		        //
		        //
		        $userdata = $this->user_model->get_userdata($usercode);
		        $referalid = $userdata['referralid'];
		        $referalamt =  $upgradelevel['level_referal_commision'];
		        $data = array();
		        $data['receiverid'] =  $referalid;
		        $data['senderid'] =  $usercode;
		        $data['amount'] =  $referalamt;
		        $data['plan'] =  $levelcode;
		        $data['date'] =  date('Y-m-d H:i:s');
		        $this->user_model->addItem($data,'tbl_visible_wallet');
		        //
		        //
		        $uplineid = $this->user_model->get_twoleveluplineid($usercode);
		        $uplineamt =  $upgradelevel['level_upline_commision'];
		        if($uplineid==''){$uplineid=0;}
		        $data = array();
		        $data['receiverid'] =  $uplineid;
		        $data['senderid'] =  $usercode;
		        $data['amount'] =  $uplineamt;
		        $data['plan'] =  $levelcode;
		        $data['date'] =  date('Y-m-d H:i:s');
		        $this->user_model->addItem($data,'tbl_hidden_wallet');

		        //Level Update
		        $level['current_level']	=	$memberdata[0]['current_level']+1;
				$this->user_model->update($level,'membermaster','usercode',$usercode);
				*/
			}
		}
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
		
		$title		=	'AAINC 2019';
		$emailid	=	$member_email[0]['emailid'];
		$to 		= 	$member_email[0]['emailid'];
		$to2 		= 	$ref_email[0]['emailid'];
		$subject 	=	'AAINC Active Member';

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
	    $data['table_list']=true;
	    $walletData=$this->paid_leader_wallet_sum();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("paid_leader_wallet_list",$walletData);
		$this->load->view('comman/footer');
		
	}

	function paid_leader_wallet_get(){

		$result=$this->user_model->getAll_active();
				$count=$this->user_model->get_tot_count_active();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		$html='';
		for($i=0;$i<count($result);$i++){
		    
			$usercode = $result[$i]['usercode'];
			$referalwallet = $this->user_model->getmemberreferalwallet($usercode);
			$w1 = $this->user_model->getmemberlevelwallet($usercode,1);
			$w2 = $this->user_model->getmemberlevelwallet($usercode,2);
			$w3 = $this->user_model->getmemberlevelwallet($usercode,3);
			$w4 = $this->user_model->getmemberlevelwallet($usercode,4);
			$w5 = $this->user_model->getmemberlevelwallet($usercode,5);
			$w6 = $this->user_model->getmemberlevelwallet($usercode,6);
			$w7 = $this->user_model->getmemberlevelwallet($usercode,7);
			$w1r = $w1>60?abs(60-$w1):0;
			$w2r = $w2>300?abs(300-$w2):0;
			$w3r = $w3>1710?abs(1710-$w3):0;
			$w4r = $w4>10140?abs(10140-$w4):0;
			$w5r = $w5>60690?abs(60690-$w5):0;
			$w6r = $w6>424620?abs(424620-$w6):0;
			$w7r = $w7>3396680?abs(3396680-$w7):0;
			$w1 = $w1-$w1r;
			$w2 = $w2-$w2r;
			$w3 = $w3-$w3r;
			$w4 = $w4-$w4r;
			$w5 = $w5-$w5r;
			$w6 = $w6-$w6r;
			$w7 = $w7-$w7r;
			$a1 = 0;
			$a2 = $w2r*25/100;
			$a3 = $w3r*25/100;
			$a4 = $w4r*25/100;
			$a5 = $w5r*25/100;
			$a6 = $w6r*25/100;
			$a7 = $w7r*25/100;
			$w1tra = $this->user_model->getremainwallettosmartamt($usercode,1);
			$w2tra = $this->user_model->getremainwallettosmartamt($usercode,2);
			$w3tra = $this->user_model->getremainwallettosmartamt($usercode,3);
			$w4tra = $this->user_model->getremainwallettosmartamt($usercode,4);
			$w5tra = $this->user_model->getremainwallettosmartamt($usercode,5);
			$w6tra = $this->user_model->getremainwallettosmartamt($usercode,6);
			$w7tra = $this->user_model->getremainwallettosmartamt($usercode,7);
			$w1r = $w1r-$w1tra-$a1;
			$w2r = $w2r-$w2tra-$a2;
			$w3r = $w3r-$w3tra-$a3;
			$w4r = $w4r-$w4tra-$a4;
			$w5r = $w5r-$w5tra-$a5;
			$w6r = $w6r-$w6tra-$a6;
			$w7r = $w7r-$w7tra-$a7;
					$loginusercode = $result[$i]['usercode'];
            	$referralcount = countreferral($loginusercode);
            	$paidRefCount= $this->user_model->count_paid_members($loginusercode);
            	 $QStatus='style="color:rgba(255, 0, 0, 1)"';// For Qualified Status 
	        	if($referralcount>=3){
	        	   $QStatus='';
	        	}

			
				$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$referralcount,
					$paidRefCount,
					$referalwallet,
					$w1,
					$w1r,
					$w2,
					$w2r,
					$w3,
					$w3r,
					$w4,
					$w4r,
					$w5,
					$w5r,
					$w6,
					$w6r,
					$w7,
					$w7r
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	//====================================Sum all columns for all paid leader wallet========================================
    function paid_leader_wallet_sum(){
        	$result=$this->user_model->ref_active_member();
        	$w1Total=0;
        	$w2Total=0;
        	$w3Total=0;
        	$w4Total=0;
        	$w5Total=0;
        	$w6Total=0;
        	$w7Total=0;
        	//reverse wallets
        	$w1rTotal=0;
        	$w2rTotal=0;
        	$w3rTotal=0;
        	$w4rTotal=0;
        	$w5rTotal=0;
        	$w6rTotal=0;
        	$w7rTotal=0;
        	
        for($i=0;$i<count($result);$i++){
		    
			$usercode = $result[$i]['usercode'];
			$referalwallet = $this->user_model->getmemberreferalwallet($usercode);
			$w1 = $this->user_model->getmemberlevelwallet($usercode,1);
			$w2 = $this->user_model->getmemberlevelwallet($usercode,2);
			$w3 = $this->user_model->getmemberlevelwallet($usercode,3);
			$w4 = $this->user_model->getmemberlevelwallet($usercode,4);
			$w5 = $this->user_model->getmemberlevelwallet($usercode,5);
			$w6 = $this->user_model->getmemberlevelwallet($usercode,6);
			$w7 = $this->user_model->getmemberlevelwallet($usercode,7);
			$w1r = $w1>60?abs(60-$w1):0;
			$w2r = $w2>300?abs(300-$w2):0;
			$w3r = $w3>1710?abs(1710-$w3):0;
			$w4r = $w4>10140?abs(10140-$w4):0;
			$w5r = $w5>60690?abs(60690-$w5):0;
			$w6r = $w6>424620?abs(424620-$w6):0;
			$w7r = $w7>3396680?abs(3396680-$w7):0;
			$w1 = $w1-$w1r;
			$w2 = $w2-$w2r;
			$w3 = $w3-$w3r;
			$w4 = $w4-$w4r;
			$w5 = $w5-$w5r;
			$w6 = $w6-$w6r;
			$w7 = $w7-$w7r;
			$a1 = 0;
			$a2 = $w2r*25/100;
			$a3 = $w3r*25/100;
			$a4 = $w4r*25/100;
			$a5 = $w5r*25/100;
			$a6 = $w6r*25/100;
			$a7 = $w7r*25/100;
			$w1tra = $this->user_model->getremainwallettosmartamt($usercode,1);
			$w2tra = $this->user_model->getremainwallettosmartamt($usercode,2);
			$w3tra = $this->user_model->getremainwallettosmartamt($usercode,3);
			$w4tra = $this->user_model->getremainwallettosmartamt($usercode,4);
			$w5tra = $this->user_model->getremainwallettosmartamt($usercode,5);
			$w6tra = $this->user_model->getremainwallettosmartamt($usercode,6);
			$w7tra = $this->user_model->getremainwallettosmartamt($usercode,7);
			$w1r = $w1r-$w1tra-$a1;
			$w2r = $w2r-$w2tra-$a2;
			$w3r = $w3r-$w3tra-$a3;
			$w4r = $w4r-$w4tra-$a4;
			$w5r = $w5r-$w5tra-$a5;
			$w6r = $w6r-$w6tra-$a6;
			$w7r = $w7r-$w7tra-$a7;
			
			//sum columns
				$w1Total+=$w1;
				$w2Total+=$w2;
				$w3Total+=$w3;
				$w4Total+=$w4;
				$w5Total+=$w4;
				$w6Total+=$w6;
				$w7Total+=$w7;
			// sum reverse columns
				$w1rTotal+=$w1r;
				$w2rTotal+=$w2r;
				$w3rTotal+=$w3r;
				$w4rTotal+=$w4r;
				$w5rTotal+=$w4r;
				$w6rTotal+=$w6r;
				$w7rTotal+=$w7r;
        	
        		}
        		//adding sums into an array
        		$data=array();
        		$data["w1Total"]=$w1Total;
        		$data["w2Total"]=$w2Total;
        		$data["w3Total"]=$w3Total;
        		$data["w4Total"]=$w4Total;
        		$data["w5Total"]=$w5Total;
        		$data["w6Total"]=$w6Total;
        		$data["w7Total"]=$w7Total;
        		$data["w1rTotal"]=$w1rTotal;
        		$data["w2rTotal"]=$w2rTotal;
        		$data["w3rTotal"]=$w3rTotal;
        		$data["w4rTotal"]=$w4rTotal;
        		$data["w5rTotal"]=$w5rTotal;
        		$data["w6rTotal"]=$w6rTotal;
        		$data["w7rTotal"]=$w7rTotal;
        // 		var_dump($data);
        		return $data;
        		
    }
	function free_leader_wallet()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("free_leader_wallet_list");
		$this->load->view('comman/footer');
		
	}

	function free_leader_wallet_get(){

		$result=$this->user_model->ref_all_member();
		$count=$this->user_model->get_tot_count_panding();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		$html='';
		for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
			$referalwallet = $this->user_model->getfreememberreferalwallet($usercode);
			$w1 = $this->user_model->getfreememberlevelwallet($usercode,1);
			$w2 = $this->user_model->getfreememberlevelwallet($usercode,2);
			$w3 = $this->user_model->getfreememberlevelwallet($usercode,3);
			$w4 = $this->user_model->getfreememberlevelwallet($usercode,4);
			$w5 = $this->user_model->getfreememberlevelwallet($usercode,5);
			$w6 = $this->user_model->getfreememberlevelwallet($usercode,6);
			$w7 = $this->user_model->getfreememberlevelwallet($usercode,7);
			$w1r = $w1>60?abs(60-$w1):0;
			$w2r = $w2>300?abs(300-$w2):0;
			$w3r = $w3>1710?abs(1710-$w3):0;
			$w4r = $w4>10140?abs(10140-$w4):0;
			$w5r = $w5>60690?abs(60690-$w5):0;
			$w6r = $w6>424620?abs(424620-$w6):0;
			$w7r = $w7>3396680?abs(3396680-$w7):0;
			$w1 = $w1-$w1r;
			$w2 = $w2-$w2r;
			$w3 = $w3-$w3r;
			$w4 = $w4-$w4r;
			$w5 = $w5-$w5r;
			$w6 = $w6-$w6r;
			$w7 = $w7-$w7r;
			$a1 = 0;
			$a2 = $w2r*25/100;
			$a3 = $w3r*25/100;
			$a4 = $w4r*25/100;
			$a5 = $w5r*25/100;
			$a6 = $w6r*25/100;
			$a7 = $w7r*25/100;
      		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$referalwallet,
					$w1,
					$w1r-$a1,
					$w2,
					$w2r-$a2,
					$w3,
					$w3r-$a3,
					$w4,
					$w4r-$a4,
					$w5,
					$w5r-$a5,
					$w6,
					$w6r-$a6,
					$w7,
					$w7r-$a7
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );	
		//echo $html;
	}

	function free_bonus_wallet()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("free_bonus_wallet_list");
		$this->load->view('comman/footer');
		
	}

	function free_bonus_wallet_get(){

		$result=$this->user_model->ref_all_member();
		$count=$this->user_model->get_tot_count_panding();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		$html='';
		for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
			$fivebythree = $this->user_model->getfreememberbonuswallet($usercode,'5by3');
			$tenbythree = $this->user_model->getfreememberbonuswallet($usercode,'10by3');
      		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					bcdiv($fivebythree,1,3),
					bcdiv($tenbythree,1,3),
					bcdiv($fivebythree+$tenbythree,1,3)
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	function aainc_wallet()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("aainc_wallet_list");
		$this->load->view('comman/footer');
		
	}

	function aainc_wallet_get(){
		$result=$this->user_model->ref_all_member();
		$count=$this->user_model->get_tot_count_panding();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		$html='';
		for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
			$referalwallet = $this->user_model->getfreememberreferalwallet($usercode);
			$w1 = $this->user_model->getfreememberlevelwallet($usercode,1);
			$w2 = $this->user_model->getfreememberlevelwallet($usercode,2);
			$w3 = $this->user_model->getfreememberlevelwallet($usercode,3);
			$w4 = $this->user_model->getfreememberlevelwallet($usercode,4);
			$w5 = $this->user_model->getfreememberlevelwallet($usercode,5);
			$w6 = $this->user_model->getfreememberlevelwallet($usercode,6);
			$w7 = $this->user_model->getfreememberlevelwallet($usercode,7);
			$w1r = $w1>60?abs(60-$w1):0;
			$w2r = $w2>300?abs(300-$w2):0;
			$w3r = $w3>1710?abs(1710-$w3):0;
			$w4r = $w4>10140?abs(10140-$w4):0;
			$w5r = $w5>60690?abs(60690-$w5):0;
			$w6r = $w6>424620?abs(424620-$w6):0;
			$w7r = $w7>3396680?abs(3396680-$w7):0;
			$a2 = $w2r*25/100;
			$a3 = $w3r*25/100;
			$a4 = $w4r*25/100;
			$a5 = $w5r*25/100;
			$a6 = $w6r*25/100;
			$a7 = $w7r*25/100;
			$total = $a2 + $a3 + $a4 + $a5 + $a6 + $a7;
      		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$a2,
					$a3,
					$a4,
					$a5,
					$a6,
					$a7,
					$total
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );	
		//echo $html;	
	}

	//Reverse
	protected function entry_in_reverse_tree($pid,$uid){
		
			$data=array();
			$data['usercode']			=	$uid;
			
			$set_arr=array('field' => 'uplingmember3_3','position' => 3,'side' => 'side_3_3');
			$this->first_lavel_reverse_set($pid,$set_arr,$uid);
			$data['uplingmember3_3']	=	$this->upling_reverse_user;
			$data['side_3_3']			=	$this->upling_reverse_posi;
			
			$set_arr=array('field' => 'uplingmember5_3','position' => 5,'side' => 'side_5_3');
			$this->first_lavel_reverse_set($pid,$set_arr,$uid);
			$data['uplingmember5_3']	=	$this->upling_reverse_user;
			$data['side_5_3']			=	$this->upling_reverse_posi;
			
			$set_arr=array('field' => 'uplingmember10_3','position' => 10,'side' => 'side_10_3');
			$this->first_lavel_reverse_set($pid,$set_arr,$uid);
			$data['uplingmember10_3']	=	$this->upling_reverse_user;
			$data['side_10_3']			=	$this->upling_reverse_posi;
			$this->user_model->addItem($data,'member_node_reverse');
			
			//=====================================================Add commission in Reverse Wallet for paid users============================================
			$com5x3	=	$this->user_model->get_setting_value_by_lable('paid_rev_wallet_5x3');// get value from site settings
			$com10x3	=	$this->user_model->get_setting_value_by_lable('paid_rev_wallet_10x3');
			$rdata['amt_5_3'] = $com5x3[0]['setting_value'];
			$rdata['amt_10_3'] = $com10x3[0]['setting_value'];
			$rdata['remain_5_3'] = $com5x3[0]['setting_value'];
			$rdata['remain_10_3'] = $com10x3[0]['setting_value'];
			$rdata['usercode'] = $uid;
			$this->user_model->addItem($rdata,'tbl_reverse_wallet');// add into reverse wallet table
			return $data;
		
	}
	protected function first_lavel_reverse_set($pid,$type,$uid){
		
		$result	=	$this->user_model->get_usercode_by_reverse_tree($pid,$type['field']);
		//print_r($result);
		//die();
		///level One Setting///
		if(count($result)<$type['position']){
			$this->upling_reverse_user =   $pid;
			$this->upling_reverse_posi = 1;
			if(count($result)>0){
				for($i=0; $i <= count($result); $i++) {
					$olduid = $result[$i]['usercode'];
					$newpos = $result[$i][$type['side']]+1; 
					$this->swap_position($pid,$olduid,$newpos,$type);
				}
			}
			return;	
		}else{
			$this->upling_reverse_user =   $pid;
			$this->upling_reverse_posi = 1;
			for($i=0;$i<count($result);$i++){
				$arr[]=$result[$i]['usercode'];
			}
			$this->tree_check_reverse_postion($uid,$arr,$type);
			return;
		}
		
		
	}
	protected function tree_check_reverse_postion($uid,$arr_mem, $type){
		
		//for($pos=0;$pos<$type['position'];$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
				$result = $this->user_model->get_reverse_tree_by_usercode($arr_mem[$i]);
				if($result[$type['side']]<$type['position']){
					$eid = $result[$type['field']];
					$olduid = $result['usercode'];
					$newpos = $result[$type['side']]+1; 
					$this->swap_position($eid,$olduid,$newpos,$type);
				}else{
					$this->change_parent_tree($arr_mem[$i],$uid,$type);
				}
				
			}
		//}
		
		
	}
	public function change_parent_tree($uid,$pid,$type){
		$newpos = 1; 
		$this->swap_position_parent($uid,$pid,$newpos,$type);
		$result	=	$this->user_model->get_usercode_by_reverse_tree($uid,$type['field']);
		if(count($result)>0){
			for($i=0; $i < count($result); $i++) {
				$newpos = $i+2; 
				if($newpos<=$type['position']){
					$this->swap_position_parent($result[$i]['usercode'],$pid,$newpos,$type);
				}else{
					$this->change_parent_tree($result[$i]['usercode'],$uid,$type);
				}
			}
		}
	}
	protected function swap_position($usercode,$olduid,$newpos,$type){
		$data = array();
		$data[$type['side']] = $newpos;
		$array = array($type['field'] => $usercode, 'usercode' => $olduid);
		$this->db->where($array); 
		$this->db->update('member_node_reverse', $data); 
	}

	protected function swap_position_parent($id,$pid,$pos,$type){
		$data = array();
		$data[$type['side']] = $pos;
		$data[$type['field']] = $pid;
		$array = array('usercode' => $id);
		$this->db->where($array); 
		$this->db->update('member_node_reverse', $data); 
	}

	//
	function paid_bonus_wallet()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("paid_bonus_wallet_list");
		$this->load->view('comman/footer');
		
	}

	function paid_bonus_wallet_get(){

		$result=$this->user_model->ref_all_member();
		$count=$this->user_model->get_tot_count_panding();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		$html='';
		for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
			$fivebythree = $this->user_model->getpaidmemberbonuswallet($usercode,'5by3');
			$tenbythree = $this->user_model->getpaidmemberbonuswallet($usercode,'10by3');
      		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					bcdiv($fivebythree,1,3),
					bcdiv($tenbythree,1,3),
					bcdiv($fivebythree+$tenbythree,1,3)
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	function paid_aainc_wallet()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view("paid_aainc_wallet_list");
		$this->load->view('comman/footer');
		
	}

	function paid_aainc_wallet_get(){
		$result=$this->user_model->ref_all_member();
		$count=$this->user_model->get_tot_count_panding();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		$html='';
		for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
			$referalwallet = $this->user_model->getmemberreferalwallet($usercode);
			$w1 = $this->user_model->getmemberlevelwallet($usercode,1);
			$w2 = $this->user_model->getmemberlevelwallet($usercode,2);
			$w3 = $this->user_model->getmemberlevelwallet($usercode,3);
			$w4 = $this->user_model->getmemberlevelwallet($usercode,4);
			$w5 = $this->user_model->getmemberlevelwallet($usercode,5);
			$w6 = $this->user_model->getmemberlevelwallet($usercode,6);
			$w7 = $this->user_model->getmemberlevelwallet($usercode,7);
			$w1r = $w1>60?abs(60-$w1):0;
			$w2r = $w2>300?abs(300-$w2):0;
			$w3r = $w3>1710?abs(1710-$w3):0;
			$w4r = $w4>10140?abs(10140-$w4):0;
			$w5r = $w5>60690?abs(60690-$w5):0;
			$w6r = $w6>424620?abs(424620-$w6):0;
			$w7r = $w7>3396680?abs(3396680-$w7):0;
			$a2 = $w2r*25/100;
			$a3 = $w3r*25/100;
			$a4 = $w4r*25/100;
			$a5 = $w5r*25/100;
			$a6 = $w6r*25/100;
			$a7 = $w7r*25/100;
			$total = $a2 + $a3 + $a4 + $a5 + $a6 + $a7;
      		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$a2,
					$a3,
					$a4,
					$a5,
					$a6,
					$a7,
					$total
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );	
		//echo $html;	
	}
	//======================================================Reverse Paid Wallets=================================================================
	//-------------------Reverse paid 5x3 Wallet-------------------
	function reverse_five_by_three_wallet(){
	   	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('reverse_five_by_three_wallet_view');
		$this->load->view('comman/footer');
	}
	//-------------------Reverse paid 5x3 Wallet for ajax call-------------------
	function reverse_five_by_three_wallet_ajax(){
	    		$result=$this->user_model->getAll_paid();
		$count=$this->user_model->get_tot_count_paid();
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
	        $wallet_data=$this->user_model->get_paid_reverse_wallet($usercode);
	     
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['amount']=$wallet_data["amt_5_3"],
					$result[$i]['remain']=$wallet_data["remain_5_3"],
					
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
	}
	
	//-------------------Reverse paid 10x3 Wallet-------------------
	function reverse_ten_by_three_wallet(){
	   	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('reverse_ten_by_three_wallet_view');
		$this->load->view('comman/footer');
	}
	//-------------------Reverse paid 10x3 Wallet for ajax call-------------------
	function reverse_ten_by_three_wallet_ajax(){
	    		$result=$this->user_model->getAll_paid();
		$count=$this->user_model->get_tot_count_paid();
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
	        $wallet_data=$this->user_model->get_paid_reverse_wallet($usercode);
	     
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['amount']=$wallet_data["amt_10_3"],
					$result[$i]['remain']=$wallet_data["remain_10_3"],
					
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
	}
//======================================================Reverse Free Wallets=================================================================
	//-------------------Reverse Free 5x3 Wallet-------------------
		function reverse_five_by_three_wallet_free(){
	   	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('reverse_five_by_three_wallet_view_free');
		$this->load->view('comman/footer');
	}
    //-------------------Reverse Free 5x3 Wallet for ajax call-------------------
    	function reverse_five_by_three_wallet_free_ajax(){
	    	$result=$this->user_model->ref_all_member();	
		 $count=$this->user_model->get_tot_count_panding();
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
	        $wallet_data=$this->user_model->get_free_reverse_wallet($usercode);
	     
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['amount']=$wallet_data["amt_5_3"],
					$result[$i]['remain']=$wallet_data["remain_5_3"],
					
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
	}
		//-------------------Reverse Free 10x3 Wallet-------------------
    function reverse_ten_by_three_wallet_free(){
	   	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('reverse_ten_by_three_wallet_view_free');
		$this->load->view('comman/footer');
	}
	    //-------------------Reverse Free 10x3 Wallet for ajax call-------------------
    	function reverse_ten_by_three_wallet_free_ajax(){
	    	$result=$this->user_model->ref_all_member();	
		// $count=$this->user_model->get_tot_count_panding();
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => count($result),
			"iTotalDisplayRecords" => ''.count($result).'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
			$usercode = $result[$i]['usercode'];
	        $wallet_data=$this->user_model->get_free_reverse_wallet($usercode);
	     
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['amount']=$wallet_data["amt_10_3"],
					$result[$i]['remain']=$wallet_data["remain_10_3"],
					
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
	}
	
	//to add amount in reverse wallet for existing user
// 	function add50toReverseWallets(){
// 	    $result=$this->user_model->getAll();
// 		for($i=0;$i<count($result);$i++){
// 		    $user_code=$result[$i]["usercode"];
// 		    $this->user_model->addItemToReverseWallet($user_code);
// 		}
// 	}

//====================================== Capture Pages Subscribers =======================================

function active_cp_member(){
    	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(2).'_view');
		$this->load->view('comman/footer');
}
//get list of active capture pages subscribers
function active_cp_member_ajax(){
    	$result=$this->user_model->get_cp_members("Active");	
		 $count=$this->user_model->get_tot_cp_members("Active");
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
	        $ref_name_details=$this->user_model->get_ref_name($result[$i]['referralid']);
			$usercode = $result[$i]['usercode'];
			if($result[$i]['subscription_id']=="")
	        $deactivate_link="<a href=".base_url()."index.php/user/activate_subscription?usercode=".$usercode."&status=InActive>Deactivate</a>";
	        else
	        $deactivate_link="";
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['status'],
					$result[$i]['emailid'],
					$ref_name_details[0]['fname'].' '.$ref_name_details[0]['lname'],
					$result[$i]['subscription_id'],
					$result[$i]['subscription_date'],
					$result[$i]['subscription_status'],
					$deactivate_link
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
}

//------------------------Inactive cp members-----------------------
function inactive_cp_member(){
    	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(2).'_view');
		$this->load->view('comman/footer');
}

//get list of inactive capture pages members subscribers
function inactive_cp_member_ajax(){
    
    	$result=$this->user_model->get_cp_members("InActive");	
		 $count=$this->user_model->get_tot_cp_members("InActive");
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
	        $ref_name_details=$this->user_model->get_ref_name($result[$i]['referralid']);
			$usercode = $result[$i]['usercode'];
	        $activate_link="<a href=".base_url()."index.php/user/activate_subscription?usercode=".$usercode."&status=Active>Activate</a>";
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['status'],
					$result[$i]['emailid'],
					$ref_name_details[0]['fname'].' '.$ref_name_details[0]['lname'],
					$result[$i]['subscription_status'],
					$activate_link
					
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
}
//=======to activated user==========================
function activate_subscription(){
    $usercode=$_GET["usercode"];
    $status=$_GET["status"];
    
    if($status=="Active"){
        $this->user_model->update_cp_members_status($usercode,"Active");
        $redirect_url=base_url().'index.php/user/inactive_cp_member';
        echo"<script>alert('Activated Successfully');window.location='".$redirect_url."';
        </script>";
      
       
    }else if($status=="InActive"){
        $this->user_model->update_cp_members_status($usercode,"InActive");
        $redirect_url=base_url().'index.php/user/active_cp_member';
        echo"<script>alert('Deactivated Successfully');window.location='".$redirect_url."';
        </script>";
    }
    
}
//========================================================Capture Page Wallet================================================================
function capture_page_wallet(){
    	$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(2).'_view');
		$this->load->view('comman/footer');
}
function get_capture_page_wallet_ajax(){
    	$result=$this->user_model->getAll_active();	
		// $count=$this->user_model->get_tot_count_panding();
		   $output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => count($result),
			"iTotalDisplayRecords" => ''.count($result).'',
			"aaData" => array()
		);
	    for($i=0;$i<count($result);$i++){
	        
			$usercode = $result[$i]['usercode'];
			$ref_name_details=$this->user_model->get_ref_name($result[$i]['referralid']);
	        $wallet_data=$this->user_model->get_capture_page_wallet($usercode);
	        if($wallet_data["amount"]==""){
	            $amount='0.00';	        
	                    }else{
	                        $amount=$wallet_data["amount"];
	                    }
	     
	    		$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$ref_name_details[0]['fname'].' '.$ref_name_details[0]['lname'],
					$amount='0.00'
					
			);
			$output['aaData'][] = $row;    
	    }
	    echo json_encode( $output );
}

}

