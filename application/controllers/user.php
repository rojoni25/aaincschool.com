<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
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
	
	function listing_active(){
		$result=$this->user_model->getAll_active();
		
		$count=$this->user_model->get_tot_count_active();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			$edit='<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['usercode'].'" class="edit_rcd">
					<i class="icon-pencil"></i></a>&nbsp;&nbsp;
					<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd">
					<i class="icon-eye-open"></i></a>';
			$ref=$this->user_model->get_total_reffral($result[$i]['usercode']);
			
			if($result[$i]['email_verification']=='N'){
				$usercode="<span class='no_verified'>".$result[$i]['usercode']."</span>";				
			}
			else{
				$usercode="<span class='verified'>".$result[$i]['usercode']."</span>";				
			}
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref[0]['tot'],
					date('d-M-Y', $result[$i]['active_dt']),
					$edit
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
			$edit='<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd"><i class="icon-eye-open"></i></a>';
			if($result[$i]['email_verification']=='N'){
				$usercode="<span class='no_verified'>".$result[$i]['usercode']."</span>";				
			}
			else{
				$usercode="<span class='verified'>".$result[$i]['usercode']."</span>";				
			}
			
			if($result[$i]['pagecode']!=0){
				$cap_page_name	=	$this->user_model->get_capture_page_name($result[$i]['pagecode']);
				$page_name='<a target="_blank" href="'.$base_url.'index.php/capture/page/'.$result[$i]['pagecode'].'/">'.$cap_page_name[0]['page_name'].'</a>';
			}
			else{
				$page_name='Default';
			}
			$joindate=date('d-m-y',strtotime($result[$i]['create_date']));
			$ref=$this->user_model->get_ref_name($result[$i]['referralid']);
			$row = array(
					$usercode,
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['mobileno'],
					$result[$i]['emailid'],
					$ref[0]['fname'].' '.$ref[0]['lname'],
					$page_name,
					$joindate,
					$edit
			);
			$output['aaData'][] = $row;
		}
		//var_dump($output);
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
				$pay['status']='Paid';
				$this->user_model->update($pay,'paid_request_master','usercode',$this->input->post('active_member_code'));	
				
				//***member status update***//
				$this->user_model->update($data,$this->table,$this->primary_key,$this->input->post('active_member_code'));	
				$usercode=$this->input->post('active_member_code');	
				
				$data2['usercode']=$usercode;	
				$pos_three=$this->display_children_three($referralid);
					
				$data2['uplingmember3_3']	=	$pos_three['mem'];
				$data2['side_3_3']			=	$pos_three['pos'];
					
				$pos_five=$this->display_children_five($referralid);
				$data2['uplingmember5_3']	=	$pos_five['mem'];
				$data2['side_5_3']			=	$pos_five['pos'];
					
				$pos_ten=$this->display_children_ten($referralid);
				$data2['uplingmember10_3']	=	$pos_ten['mem'];
				$data2['side_10_3']			=	$pos_ten['pos'];
					
				$this->user_model->addItem($data2,'member_node_master');
				$this->level_update($data2);
				$this->send_email_after_active();
					
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
	function display_children_three($parent){
		////////////Chack Level 1//////////////
		$level_one=$this->user_model->get_usercode($parent);
		
		$posit=count($level_one);
		if($posit<3){
			if($posit==0){
				$pos='1';
			}
			elseif($posit==1){
				$pos='2';
			}
			else{
				$pos='3';
			}
			$posi['pos']=$pos;
			$posi['mem']=$parent;
			return $posi;
		}
		////////////End Level 1/////////////
		
		
		////////////Chack Level 2//////////////
			 for($i=0;$i<count($level_one);$i++){
				for($p=1;$p<=3;$p++)
				{
					$room1=$this->user_model->get_count_three($level_one[$p-1]['usercode']);
					
					 
					if($room1[0]['tot']<$i+1)
					{
						if($room1[0]['tot']==0){$pos='1';}
						elseif($room1[0]['tot']==1){$pos='2';}
						else{$pos='3';}
							$posi['pos']=$pos;
							$posi['mem']=$level_one[$p-1]['usercode'];
						return $posi;
					}
				}//p
			 }//i
		////////////End Level 2/////////////
		
		////////////Chack Level 3//////////////
		$level3[0]=$this->user_model->get_usercode($level_one[0]['usercode']);
		$level3[1]=$this->user_model->get_usercode($level_one[1]['usercode']);
		$level3[2]=$this->user_model->get_usercode($level_one[2]['usercode']);
		
		for($i=0;$i<3;$i++)
		{
			for($m=0;$m<3;$m++){ //m loop
		
				for($p=0;$p<3;$p++){
					$level_two=$this->user_model->get_count_three($level3[$p][$m]['usercode']);
					if($level_two[0]['tot']<$i+1)
					{
						if($level_two[0]['tot']==0){$pos='1';}
						elseif($level_two[0]['tot']==1){$pos='2';}
						else{$pos='3';}	
						$posi['pos']=$pos;
						$posi['mem']=$level3[$p][$m]['usercode'];
						return $posi;
					}//if
				}//p
			}//m
		}//i	
		////////////Chack Level 3//////////////
		////////////Chack Level 4//////////////
		
		$level4[0][0]=$this->user_model->get_usercode($level3[0][0]['usercode']);
		$level4[0][1]=$this->user_model->get_usercode($level3[0][1]['usercode']);
		$level4[0][2]=$this->user_model->get_usercode($level3[0][2]['usercode']);
		$level4[1][0]=$this->user_model->get_usercode($level3[1][0]['usercode']);
		$level4[1][1]=$this->user_model->get_usercode($level3[1][1]['usercode']);
		$level4[1][2]=$this->user_model->get_usercode($level3[1][2]['usercode']);
		$level4[2][0]=$this->user_model->get_usercode($level3[2][0]['usercode']);
		$level4[2][1]=$this->user_model->get_usercode($level3[2][1]['usercode']);
		$level4[2][2]=$this->user_model->get_usercode($level3[2][2]['usercode']);
		
		for($i=0;$i<3;$i++)
		{
			for($jk=0;$jk<3;$jk++)
			{
				for($m=0;$m<3;$m++){
					for($p=0;$p<3;$p++){
						$level_four=$this->user_model->get_count_three($level4[$p][$m][$jk]['usercode']);
						if($level_four[0]['tot']<$i+1)
				   		{
							if($level_four[0]['tot']==0){$pos='1';}
							elseif($level_four[0]['tot']==1){$pos='2';}	
							else{$pos='3';}
							
							$posi['pos']=$pos;
							$posi['mem']=$level4[$p][$m][$jk]['usercode'];
							return $posi;
						}	
					}//p
				}//m
			}//jk
		}//$i	
		
		////////////Chack Level 5//////////////
		for($i=0;$i<3;$i++){
			for($k=0;$k<3;$k++){
				for($p=0;$p<3;$p++){
					$level5[$i][$k][$p]=$this->user_model->get_usercode($level4[$i][$k][$p]['usercode']);	
				}//p
			}//k
		}//i
		
		for($i=0;$i<3;$i++){
			for($k=0;$k<3;$k++){
				for($p=0;$p<3;$p++){
			   		for($m=0;$m<3;$m++){
						$level_five=$this->user_model->get_count_three($level5[$m][$p][$k][$i]['usercode']);
						if($level_five[0]['tot']<$i+1)
				   		{
							if($level_five[0]['tot']==0){$pos='1';}
							elseif($level_five[0]['tot']==1){$pos='2';}	
							else{$pos='3';}
							$posi['pos']=$pos;
							$posi['mem']=$level5[$m][$p][$k][$i]['usercode'];
							return $posi;
						}
						
					}//$m
				}//$p
			}//$k
		}//$i
	
	}//function
	///**************************************************************************************************//
	
	
	
	function display_children_five($parent){
		////////////Chack Level 1//////////////
	
		$level_one=$this->user_model->get_usercode_five($parent);
		$posit=count($level_one);
		if($posit<5){
			
			$pos=$posit+1;
			$posi['pos']=$pos;
			$posi['mem']=$parent;
			return $posi;
		}
		////////////End Level 1/////////////
		
		
		////////////Chack Level 2//////////////
			 for($i=0;$i<count($level_one);$i++){
				for($p=1;$p<=5;$p++)
				{
					$room1=$this->user_model->get_count_five($level_one[$p-1]['usercode']);
				
					if($room1[0]['tot']<$i+1)
					{
						$pos=$room1[0]['tot']+1;
						$posi['pos']=$pos;
						$posi['mem']=$level_one[$p-1]['usercode'];
						return $posi;
					}
				}//p
			 }//i
		////////////End Level 2/////////////
		
		////////////Chack Level 3//////////////
		$level3[0]=$this->user_model->get_usercode_five($level_one[0]['usercode']);
		$level3[1]=$this->user_model->get_usercode_five($level_one[1]['usercode']);
		$level3[2]=$this->user_model->get_usercode_five($level_one[2]['usercode']);
		$level3[3]=$this->user_model->get_usercode_five($level_one[3]['usercode']);
		$level3[4]=$this->user_model->get_usercode_five($level_one[4]['usercode']);
		
		for($i=0;$i<5;$i++)
		{
			for($m=0;$m<5;$m++){ //m loop
		
				for($p=0;$p<5;$p++){
					$level_two=$this->user_model->get_count_five($level3[$p][$m]['usercode']);
					if($level_two[0]['tot']<$i+1)
					{
						$pos=$level_two[0]['tot']+1;
						$posi['pos']=$pos;
						$posi['mem']=$level3[$p][$m]['usercode'];
						return $posi;
					}//if
				}//p
			}//m
		}//i	
	
		////////////Chack Level 4//////////////
		$level4[0][0]=$this->user_model->get_usercode_five($level3[0][0]['usercode']);
		$level4[0][1]=$this->user_model->get_usercode_five($level3[0][1]['usercode']);
		$level4[0][2]=$this->user_model->get_usercode_five($level3[0][2]['usercode']);
		$level4[0][3]=$this->user_model->get_usercode_five($level3[0][3]['usercode']);
		$level4[0][4]=$this->user_model->get_usercode_five($level3[0][4]['usercode']);
		
		$level4[1][0]=$this->user_model->get_usercode_five($level3[1][0]['usercode']);
		$level4[1][1]=$this->user_model->get_usercode_five($level3[1][1]['usercode']);
		$level4[1][2]=$this->user_model->get_usercode_five($level3[1][2]['usercode']);
		$level4[1][3]=$this->user_model->get_usercode_five($level3[1][3]['usercode']);
		$level4[1][4]=$this->user_model->get_usercode_five($level3[1][4]['usercode']);
		
		$level4[2][0]=$this->user_model->get_usercode_five($level3[2][0]['usercode']);
		$level4[2][1]=$this->user_model->get_usercode_five($level3[2][1]['usercode']);
		$level4[2][2]=$this->user_model->get_usercode_five($level3[2][2]['usercode']);
		$level4[2][3]=$this->user_model->get_usercode_five($level3[2][3]['usercode']);
		$level4[2][4]=$this->user_model->get_usercode_five($level3[2][4]['usercode']);
		
		$level4[3][0]=$this->user_model->get_usercode_five($level3[2][0]['usercode']);
		$level4[3][1]=$this->user_model->get_usercode_five($level3[2][1]['usercode']);
		$level4[3][2]=$this->user_model->get_usercode_five($level3[2][2]['usercode']);
		$level4[3][3]=$this->user_model->get_usercode_five($level3[2][3]['usercode']);
		$level4[3][4]=$this->user_model->get_usercode_five($level3[2][4]['usercode']);
		
		$level4[4][0]=$this->user_model->get_usercode_five($level3[2][0]['usercode']);
		$level4[4][1]=$this->user_model->get_usercode_five($level3[2][1]['usercode']);
		$level4[4][2]=$this->user_model->get_usercode_five($level3[2][2]['usercode']);
		$level4[4][3]=$this->user_model->get_usercode_five($level3[2][3]['usercode']);
		$level4[4][4]=$this->user_model->get_usercode_five($level3[2][4]['usercode']);
		
		for($i=0;$i<5;$i++)
		{
			for($jk=0;$jk<5;$jk++)
			{
				for($m=0;$m<5;$m++){
					for($p=0;$p<5;$p++){
						$level_four=$this->user_model->get_count_five($level4[$p][$m][$jk]['usercode']);
						if($level_four[0]['tot']<$i+1)
				   		{
							$pos=$level_four[0]['tot']+1;
							
							$posi['pos']=$pos;
							$posi['mem']=$level4[$p][$m][$jk]['usercode'];
							return $posi;
						}	
					}//p
				}//m
			}//jk
		}//$i	
		
		////////////Chack Level 5//////////////
		for($i=0;$i<5;$i++){
			for($k=0;$k<5;$k++){
				for($p=0;$p<5;$p++){
					$level5[$i][$k][$p]=$this->user_model->get_usercode_five($level4[$i][$k][$p]['usercode']);	
				}//p
			}//k
		}//i
	
		for($i=0;$i<5;$i++){
			for($k=0;$k<5;$k++){
				for($p=0;$p<5;$p++){
			   		for($m=0;$m<5;$m++){
						$level_five=$this->user_model->get_count_five($level5[$m][$p][$k][$i]['usercode']);
						if($level_five[0]['tot']<$i+1)
				   		{
							$pos=$level_five[0]['tot']+1;
							$posi['pos']=$pos;
							$posi['mem']=$level5[$m][$p][$k][$i]['usercode'];
							return $posi;
						}
						
				}//m
			}//p
			
		}//k
		
	}//i 
	
	}//function
	///**************************************************************************************************//
	function display_children_ten($parent){
		
		////////////Chack Level 1//////////////
	
		$level_one=$this->user_model->get_usercode_ten($parent);
		$posit=count($level_one);
		if($posit<10){
			
			$pos=$posit+1;
			$posi['pos']=$pos;
			$posi['mem']=$parent;
			return $posi;
		}
		////////////End Level 1/////////////
		
		
		////////////Chack Level 2//////////////
			 for($i=0;$i<count($level_one);$i++){
				for($p=1;$p<=10;$p++)
				{
					$room1=$this->user_model->get_count_ten($level_one[$p-1]['usercode']);
				
					if($room1[0]['tot']<$i+1)
					{
						$pos=$room1[0]['tot']+1;
						$posi['pos']=$pos;
						$posi['mem']=$level_one[$p-1]['usercode'];
						return $posi;
					}
				}//p
			 }//i
		////////////End Level 2/////////////
		
		////////////Chack Level 3//////////////
		$level3[0]=$this->user_model->get_usercode_ten($level_one[0]['usercode']);
		$level3[1]=$this->user_model->get_usercode_ten($level_one[1]['usercode']);
		$level3[2]=$this->user_model->get_usercode_ten($level_one[2]['usercode']);
		$level3[3]=$this->user_model->get_usercode_ten($level_one[3]['usercode']);
		$level3[4]=$this->user_model->get_usercode_ten($level_one[4]['usercode']);
		$level3[5]=$this->user_model->get_usercode_ten($level_one[5]['usercode']);
		$level3[6]=$this->user_model->get_usercode_ten($level_one[6]['usercode']);
		$level3[7]=$this->user_model->get_usercode_ten($level_one[7]['usercode']);
		$level3[8]=$this->user_model->get_usercode_ten($level_one[8]['usercode']);
		$level3[9]=$this->user_model->get_usercode_ten($level_one[9]['usercode']);
		for($i=0;$i<10;$i++)
		{
			for($m=0;$m<10;$m++){ //m loop
		
				for($p=0;$p<10;$p++){
					$level_two=$this->user_model->get_count_ten($level3[$p][$m]['usercode']);
					if($level_two[0]['tot']<$i+1)
					{
						$pos=$level_two[0]['tot']+1;
						$posi['pos']=$pos;
						$posi['mem']=$level3[$p][$m]['usercode'];
						return $posi;
					}//if
				}//p
			}//m
		}//i
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
		$result		=		$this->user_model->get_system_level($arr['uplingmember3_3'],'system_level_3');
		$level['system_level_3']=$result[0]['level']+1;
		$result		=		$this->user_model->get_system_level($arr['uplingmember5_3'],'system_level_5');
		$level['system_level_5']=$result[0]['level']+1;
		$result		=		$this->user_model->get_system_level($arr['uplingmember10_3'],'system_level_10');
		$level['system_level_10']=$result[0]['level']+1;
		$this->user_model->update($level,'member_level_track_master','usercode',$arr['usercode']);	
		//exit;
	}
	
	
	function go_to_back(){
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	
}

