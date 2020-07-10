<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('home_module','',TRUE);
		$this->load->library('email');
   		
 	}
	public function index()
	{
		$data['current_join']=$this->get_currect_add_member();
		$data['slider']=$this->home_module->get_slider();
		$this->load->view('public/public_header',$data);
		$this->load->view('public/home_view',$data);
		$this->load->view('public/public_footer');
	}
	function get_social_media_link()
	{	
			$facebook=$this->home_module->get_pages_contain('facebook_link');
			
			$twitter=$this->home_module->get_pages_contain('twitter_link');
			$googleplus=$this->home_module->get_pages_contain('googleplus_link');
			$skype=$this->home_module->get_pages_contain('skype_id');
			
			echo'<li><em>Connect to:</em></li>
			<li><a href="'.$facebook[0]['textdt'].'" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<li><a href="'.$twitter[0]['textdt'].'" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li><a href="'.$googleplus[0]['textdt'].'" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<li><a href="skype:'.$skype[0]['textdt'].'?chat"><i class="fa fa-skype"></i></a></li>';
	}
	
	
	function unsubscribe($username)
	{
		if($username!=''){
			$result=$this->home_module->get_member_by_username($username);
			$data=array();
			$data['subscribe']='N';
			$this->home_module->update($data,'membermaster','usercode',$result[0]['usercode']);
		}
		header('Location: '.base_url().'');
		exit;
	}
	
		function email_verification($id){

		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		if($id!=''){
			$result=$this->home_module->get_email_verification_by_key($id);
			if(isset($result[0])){
				if($result[0]["status"]=="Y"){
				    echo '<script>window.location.href="'.base_url().'index.php/pages/verify_sucess"</script>';
				    exit;
				}
				$data=array();
				$data['status']		=	'Y';
				$data['verify_ip']	=	$_SERVER['REMOTE_ADDR'];
				$data['verify_date']=	$nowdt;
				$this->home_module->update($data,'email_verification','verification_code',$result[0]['verification_code']);	
			
				$data=array();
				$member_dt=$this->home_module->get_member_by_usercode($result[0]['usercode']);
				
				
				$verification_time=(int)$member_dt[0]['verification_time'];
			
				if($verification_time < 1){	
					$data['verification_time']	=	strtotime(date('d-m-Y'));
				}
				$data['email_verification']		=	'Y';
				$this->home_module->update($data,'membermaster','usercode',$result[0]['usercode']);
				
				$this->send_email_after_verify($result[0]['usercode']);			
				echo '<script>window.location.href="'.base_url().'index.php/pages/verify_sucess"</script>';
				exit;
			}else{
			    echo "<h4>Unable Verify Your Email. Kindly contact your webmaster for more details</h4>";
			}
		}	
	}
	
	function send_email_after_verify($usercode){
		
		$member_dt		=	$this->home_module->get_member_by_usercode($usercode);
		$upling_code	=	($member_dt[0]['status']=='Pending') ? $member_dt[0]['referralid_free']	: $member_dt[0]['referralid'];
		
		$arr			=	array('access_name'=>'after_verify','usercode'=>$upling_code);
		$email_html		=	$this->home_module->get_email_html_by_access_name($arr);
		
		
		$ref_dt			=	$this->home_module->get_member_by_usercode($upling_code);
		$admin			=	$this->home_module->get_admin_email_id();
		
		
		
		//Email To Admin
		// $message='<p>Name	:'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].'</p>';
		// $message.='<p>Usercode	:'.$member_dt[0]['usercode'].'</p>';
		// $message.='<p>Email	:'.$member_dt[0]['emailid'].'</p>';
		// $message.='<p>Referral	:'.$ref_dt[0]['fname'].' '.$ref_dt[0]['lname'].'</p>';
		// $message.='<p>Referral Usercode	:'.$ref_dt[0]['usercode'].'</p>';
		$message = get_email_cms_page_master('send_email_after_verify')->result()[0]->textdt;
		$message = str_replace("[fname]",$member_dt[0]['fname'],$message);
		$message = str_replace("[lname]",$member_dt[0]['lname'],$message);
		$message = str_replace("[email]",$member_dt[0]['emailid'],$message);
		$message = str_replace("[usercode]",$member_dt[0]['usercode'],$message);
		$message = str_replace("[ref-fname]",$ref_dt[0]['fname'],$message);
		$message = str_replace("[ref-lname]",$ref_dt[0]['lname'],$message);
		$message = str_replace("[ref-usercode]",$ref_dt[0]['usercode'],$message);
		
		$text = $email_html['html'].'</br></br>';
		$text.= $email_html['admin_contain'];
		
		$e_array=array("heading"=>"Member Email Verified","msg"=>$message,"contain"=>$text);	
		$message=email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($admin[0]['emailid']);
		// $this->email->subject($email_html['subject']);
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,$email_html['subject'],$admin[0]['emailid'],$message);
		
		//Email To member
		$e_array=array("heading"=>"Email Verified","msg"=>$email_html[0]['email_text'],"contain"=>$email_html['html']);	
		$message=email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($member_dt[0]['emailid']);
		// $this->email->subject($email_html[0]['email_subject']);
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,$email_html[0]['email_subject'],$member_dt[0]['emailid'],$message);
	
		
	}
	protected function get_currect_add_member()
	{
		$result=$this->home_module->get_currect_add_member();
		$list=array();	
		for($i=0;$i<count($result);$i++){
			$list[]=ucwords(strtolower($result[$i]['name']));
		}
		return $p=implode(', ',$list);
	}
	
	
}


