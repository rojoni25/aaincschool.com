<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class capture_pages extends CI_Controller {
	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
        $this->load->model('capture_pages_model','',TRUE);
		$this->load->library('email');
 	}
	
	public function index()
	{
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		
		$this->set_frist_time_page();
		
		
	 
	    
	    
		$data['contain']=$this->capture_pages_model->get_pages_contain('capture_page_contain');

		$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";

		$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";

		$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";

		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

		$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

		
		$data['table_list']=true;
		if($_REQUEST['page_section']=='capture_page'){
			$page_section='capture_page';
		}
		else if($_REQUEST['page_section']=='my_page'){
			$page_section='my_page';
		}
		/*else if($_REQUEST['page_section']=='vma_page'){
			$page_section='vma_page';
		}*/
		else if($_REQUEST['page_section']=='travel_page'){
			$page_section='travel_page';
		}
		else{
			$page_section='main_page';
		}
		$data['page_section']	=	$page_section;
		
		$data['html']=$this->listing($page_section);
		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

		$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
		$data['result']=$this->capture_pages_model->getAll($page_section);
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function set_frist_time_page(){
		// status is active but page_for!=free
		if($this->session->userdata['logged_ol_member']['status']=='Active'){
			$result=$this->capture_pages_model->get_page_code('free');
		}
			// status is pending but page_for!=registered
		if($this->session->userdata['logged_ol_member']['status']=='Pending'){
			$result=$this->capture_pages_model->get_page_code('registered');
		}

	
		
		$field	=	$this->capture_pages_model->table_fildld_name('capture_page_master');
		for($i=0;$i<count($result);$i++){
			
			for($p=1;$p<count($field);$p++)
			{
				$data[''.$field[$p].'']	=	$result[$i][''.$field[$p].''];
			}
			$data['usercode']				=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['ref_page_code']			=	$result[$i]['capture_page_code'];
			unset($data['capture_page_code']);
			$this->capture_pages_model->addItem($data,'capture_page_master');
			$data2['usercode']				=	$this->session->userdata['logged_ol_member']['usercode'];
			$data2['capture_page_code']		=	$result[$i]['capture_page_code'];
			$this->capture_pages_model->addItem($data2,'capture_page_detail');
			
			
		}
	}
	
	function listing($page_section){

		$result=$this->capture_pages_model->getAll($page_section);
	//echo "<pre>";	print_r($result); exit();
		$username = $this->session->userdata['logged_ol_member']['username'];
		
		$html='';
		for($i=0;$i<count($result);$i++){
			$edit='';
			if($result[$i]['change']=='Y'){
				$edit='<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/addnew/Edit/'.$result[$i]['capture_page_code'].'" class="edit_rcd">Edit</a>';
			}
			
			$html .='<tr>
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.$result[$i]['pagelable'].'</td>
						<td>'.$result[$i]['pagecode'].'</td>
						<!--<td>'.base_url().'index.php/capture/page/'.$result[$i]['capture_page_code'].'/?r='.$this->session->userdata['logged_ol_member']['username'].'</td>-->						
						<td>'.base_url().'index.php/capture/page/'.$result[$i]['capture_page_code'].'/'.$this->session->userdata['logged_ol_member']['username'].'</td>
						<td>
						<div class="btn-group">

							<button data-toggle="dropdown" class="btn btn-danger btn-xs dropdown-toggle" type="button" id="btnGroupDrop1">Operation
							<span class="caret"></span></button>
							<ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu" style="border-color:black;">
							<li>'.$edit.'</li>

							<li>
							<a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'">Preview</a>
							</li>

							<li><a href="#" class="report_issue_popup" value="'.$result[$i]['capture_page_code'].'">Report Issue</a></li>
							<li><a href="'.base_url().'index.php/view_friends/invitefriends/?page='.$result[$i]['capture_page_code'].'">Send</a></li>
							<li><a onclick="copyUrl('.$result[$i]['capture_page_code'].', \''.$username.'\')" href="javascript:void(0)">Copy Link</a></li>
								</ul>
							</div>
						</td>
						
              		</tr>';
							// <li><a href="#" class="page_priview_reg" value="'.$result[$i]['capture_page_code'].'">After Preview</a></li>
		}
		
		
		// if($this->session->userdata['logged_ol_member']['product_access']=='Yes'){
		// 		$result=$this->capture_pages_model->get_free_page('registered',$page_section);
		// }
		// if($this->session->userdata['logged_ol_member']['product_access']=='No'){
		// 		$result=$this->capture_pages_model->get_free_page('free',$page_section);
		// }
		
		if($this->session->userdata['logged_ol_member']['status']=='Active'){
				$result=$this->capture_pages_model->get_free_page('registered',$page_section);

		}

		if($this->session->userdata['logged_ol_member']['status']=='Pending'){
				$result=$this->capture_pages_model->get_free_page('free',$page_section);

		}

		if($this->session->userdata['logged_ol_member']['status']=='Pending'){
				//$result=$this->capture_pages_model->get_free_page('paid',$page_section);

		}

		if($this->session->userdata['logged_ol_member']['status']=='Inactive'){
				$result=$this->capture_pages_model->get_free_page('inactive',$page_section);
				
		}
		
		$username = $this->session->userdata['logged_ol_member']['username'];
		for($i=0;$i<count($result);$i++){
			
			
			$html .='<tr>
						
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.$result[$i]['pagelable'].'</td>
						<td>'.$result[$i]['pagecode'].'</td>
						<!--<td>'.base_url().'index.php/capture/page/'.$result[$i]['capture_page_code'].'/?r='.$this->session->userdata['logged_ol_member']['username'].'</td>-->
						<td>'.base_url().'index.php/capture/page/'.$result[$i]['capture_page_code'].'/'.$this->session->userdata['logged_ol_member']['username'].'</td>
						<td>
							<div class="btn-group">
							<input type="hidden" value="'.$result[$i]['after_reg_new_tab_op'].'" >
							<input type="hidden" value="'.$result[$i]['after_reg_new_tab'].'" >
								<button data-toggle="dropdown" class="btn btn-danger btn-xs dropdown-toggle" type="button" id="btnGroupDrop1">Operation
								<span class="caret"></span></button>
									<ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu" style="border-color:black;">

										<li><a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'">Preview</a></li>
										<li><a href="#" class="report_issue_popup" value="'.$result[$i]['capture_page_code'].'">Report Issue</a></li>
										<li><a href="'.base_url().'index.php/view_friends/invitefriends/?page='.$result[$i]['capture_page_code'].'">Send</a></li>

										<li><a onclick="copyUrl('.$result[$i]['capture_page_code'].', \''.$username.'\')" href="javascript:void(0)">Copy Link</a></li>
									</ul>
							</div>
						</td>
						
						
              		</tr>';
		}
		
			return $html;
	}
	
	function addnew()
	{
		  //---------------------Restrict Access if not subscribed------------------
			if(!getSubscriptionStatus($this->session->userdata['logged_ol_member']['usercode']))
	    {
	                        header('Location: '.base_url().'index.php/capture_pages/upgrade');exit;
	   }
		$check=$this->capture_pages_model->check_pageparmision($this->uri->segment(4));
		if($check[0]['tot']=='1')
		{
			$data['result']=$this->capture_pages_model->get_record($this->uri->segment(4));
			
			$this->capture_pages_model->delete_capture_page_preview();
			$priview['page_name']	=	'priview';
			$priview['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];

			$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";

			$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";

			$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";

			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

			$data['master_page']	=	$this->capture_pages_model->get_mester_page_record_by_name($data['result'][0]['pagecode']);
			
			$data['priview_code']=$this->capture_pages_model->addItem($priview,'capture_page_preview');
			$data['cms']=$this->capture_pages_model->get_pages_contain('capture_page_top_video');
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view(''.$this->uri->segment(1).'_add',$data);
			$this->load->view('comman/footer');
		}
		else{
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
		}
		
	}
	
	function page_thum_list()
	{
		// if($this->session->userdata['logged_ol_member']['product_access']!='Yes'){
		// 	header('Location: '.base_url().'index.php/capture_pages');exit;
		// }
		if(!getSubscriptionStatus($this->session->userdata['logged_ol_member']['usercode']))
	    {
	                        header('Location: '.base_url().'index.php/capture_pages/upgrade');exit;
	   }
		$data['category']	=	$this->capture_pages_model->get_page_type();
		$data['result']	=	$this->capture_pages_model->get_page_record();
		//echo"<pre>"; print_r($data['result']); exit();
		$data['contain']=$this->capture_pages_model->get_pages_contain('capture_page_contain');

		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('page_thum_list_view',$data);
		$this->load->view('comman/footer');
	}


	public function view($id)
	{
		
		$data['result']		=	$this->capture_pages_model->get_page_record($id);
		$data['category']	=	$this->capture_pages_model->get_page_type();
		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('page_thum_list_view',$data);
		$this->load->view('comman/footer');

	}
	
	function add_new_page()
	{
	    //---------------------Restrict Access if not subscribed------------------
			if(!getSubscriptionStatus($this->session->userdata['logged_ol_member']['usercode']))
	    {
	                        header('Location: '.base_url().'index.php/capture_pages/upgrade');exit;
	   }
		// if($this->session->userdata['logged_ol_member']['product_access']!='Yes')
		// {
		// 		header('Location: '.base_url().'index.php/capture_pages');exit;
		// }
		
		if($this->uri->segment(3)=='Add')
		{
			$data['master_page']	=	$this->capture_pages_model->get_mester_page_record_by_id($this->uri->segment(4));
		}
		
		$this->capture_pages_model->delete_capture_page_preview();
		$priview['page_name']='priview';
		$data['priview_code']=$this->capture_pages_model->addItem($priview,'capture_page_preview');

		$data['cms']=$this->capture_pages_model->get_pages_contain('capture_page_'.$this->uri->segment(4).'');

		$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";

		$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";

		$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";

		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

		$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
		//$data['result']	=	$this->capture_pages_model->get_page_record();
	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			$field=$this->capture_pages_model->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['page_bg_video_mute'] = isset($_POST['page_bg_video_mute']) ? $_POST['page_bg_video_mute'] : "N";

			$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";

			$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";

			$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";

			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

			$data['headline_text']					=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			$contain['cms']=$this->capture_pages_model->get_pages_contain('capture_page_top_video');	
			
			if($this->input->post('mode')=="Add")
			{
				$data['pagecode']			=	$this->input->post('pagecode');
				$data['usercode']			=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['status']				=	'Active';
				$data['page_section']		=	'my_page';
				$data['change']				=	'Y';
				$this->capture_pages_model->addItem($data,'capture_page_master');	
			}
			if($this->input->post('mode')=="Edit"){
				$this->capture_pages_model->update($data,'capture_page_master','capture_page_code',$this->input->post('eid'));		
			}
		
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
			
		}
	}
	
	
	function insert_priview(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			
			$field=$this->capture_pages_model->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}

			$data['pagecode']				=	$this->input->post('pagecode');	
			if(!isset($_POST['pagecode'])){
				$data['pagecode']				=	$this->input->post('master_page_code');	
			}
			
			$data['usercode']			=	$this->session->userdata['logged_ol_member']['usercode'];
			//$data['headline_text']			=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			$data['headline_text']			=	$this->input->post('headline_text');
			$data['page_bg_video_mute'] = isset($_POST['page_bg_video_mute']) ? $_POST['page_bg_video_mute'] : "N";


			$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";


			$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";

			$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";


			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";


			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
			
			$this->capture_pages_model->update($data,'capture_page_preview','capture_page_code',$this->input->post('priview_code'));	
		}
	}
	
	function remove_ptag($contain){
		return str_replace(array('<p>','</p>'),'',$contain);
	}
	function make_safe($contain) 
	{
		$contain = strip_tags(mysql_real_escape_string(trim($contain)));
		return $contain; 
	}
	
	public function openpopup($eid)
	{
		
		if($eid=='mp4' || $eid=='youtube'){
			$data['mediatype']='video';
		}
		else{
			$data['mediatype']='images';
		}
		$data['mediatype']=$_REQUEST['type'];
	
		$data['result']	=	$this->capture_pages_model->get_media_for_popup($_REQUEST['type']);
		
		$this->load->view('media_file_popup_view',$data);
	}
	
	public function report_issue_popup()
	{
		//$data['result']		=	$this->capture_pages_model->get_page_record($pagecode);
		$this->load->view('report_issue_popup_view',$data);
	}
	
	
	function report_issue_insert(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			$data['issue_url_code']			=	$this->input->post('issue_url_code');
			$data['issue_url']			=	$this->input->post('issue_url');
			$data['contain']			=	$this->input->post('contain');	
			$this->capture_pages_model->addItem($data,'report_issue_master');	
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
		}
	}
	
	function show_video($eid)
	{
		$data['video_link']	=	$this->capture_pages_model->get_media_gallery($eid);
		$this->load->view('z_show_video',$data);
	}
	
	function capture_pages_request($eid,$filter){
		
		$data['page_category']	=	$this->capture_pages_model->get_capture_page_category();
		$data['result']=$this->capture_pages_model->get_capture_page_type($filter);
		if($eid!=''){
			$data['page_dt']=$this->get_capture_page_type($data['result'][0]['capture_filter_code'],$eid,TRUE);
			$this->capture_pages_model->delete_capture_page_preview();
			
			$priview['page_name']	=	'priview';
			$priview['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['priview_code']=$this->capture_pages_model->addItem($priview,'capture_page_preview');
			
		}
		
		$data['contain']=$this->capture_pages_model->get_pages_contain('capture_pages_request_video');
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('capture_pages_request_add');
		$this->load->view('comman/footer');
	}
	
	
	public function get_capture_page_type($eid,$filter)
	{	
		
		$result		=	$this->capture_pages_model->get_capture_page_type($eid);		
		for($i=0;$i<count($result);$i++){
			$sel=($result[$i]['pagename']==$this->uri->segment(3) ?"selected='selected'":"");
			$html.='<option '.$sel.' value="'.$result[$i]['pagename'].'">'.$result[$i]['pagelable'].'</option>';
			
		}
		if($filter){
			return $html;
		}
		echo $html;
	}
	
	
	function capture_pages_request_insert(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			
			$field=$this->capture_pages_model->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['usercode']   	=  $this->session->userdata['logged_ol_member']['usercode'];
			$data['status'] 		=  'Active';
			$data['request_dt'] 	=  $nowdt;
			$code=$this->capture_pages_model->addItem($data,'capture_page_request');
			$admin_email	=	$this->capture_pages_model->get_admin_email();
			// $message='<p><h3>Capture Page Request</h3></p>';
			// $message.='<p>Member Name	:'.$this->session->userdata['logged_ol_member']['fullname'].'</p>';
			// $message.='<p>Username	:'.$this->session->userdata['logged_ol_member']['username'].'</p>';
			// $message.='<p>Username	:'.$this->session->userdata['logged_ol_member']['usercode'].'</p>';
			// $message.='<p>Request Page Code	:'.$code.'</p>';
	
			$message = get_email_cms_page_master('capture_page_request_insert')->result()[0]->textdt;
			$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
			$message = str_replace("[username]",$this->session->userdata['logged_ol_member']['username'],$message);
			$message = str_replace("[usercode]",$this->session->userdata['logged_ol_member']['usercode'],$message);
			$message = str_replace("[requestedpagecode]",$code,$message);
			
			$e_array=array("heading"=>"Capture Page Request","msg"=>$message,"msg"=>$message,"contain"=>"");
			$message=email_template_one($e_array);
			
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email[0]['emailid']);
			// $this->email->subject('Capture Page Request');
			// $this->email->message($message);
			// $this->email->send();
			$resp_code = sendemail(FROM_EMAIL,'Capture Page Request',$admin_email[0]['emailid'],$message);
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
						
		}
	}
	
	function grt(){
		$result	=	$this->capture_pages_model->table_fildld_name('capture_page_master');
		var_dump($result);
		
	}	
	public  function upgrade()
	{
	      //---------------------Restrict Access if not subscribed------------------
			if(getSubscriptionStatus($this->session->userdata['logged_ol_member']['usercode']))
	    {
	                        header('Location: '.base_url().'index.php/capture_pages');exit;
	   }
		$data['cms']	=	$this->capture_pages_model->get_upgrade_page_contain();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('authorize/public_auth_sub_header.php');
		$this->load->view(''.$this->uri->segment(1).'_upgrade',$data);
		$this->load->view('authorize/public_auth_sub_footer.php');
		$this->load->view('comman/footer');	
	}
	//===============================Authorize.net create subscription for capture pages==============================
	public function create_subscription(){
	    $reponseType="";
        $message="";
      require_once 'authorize/AuthorizeNetPayment.php';
        $authorizeNetPayment = new AuthorizeNetPayment();
      $response = $authorizeNetPayment->createSubscription($_POST,30);// creating subscription on authorize.net interval=30
       
      
          if(($response != null)&&$response->getMessages()->getResultCode() == "Ok"){
            $reponseType = "Success";
            $message = "Thank You For Your Subscription. Your Subscription ID is : " .  $response->getSubscriptionId() ;
            $this->update_subscription_id($response->getSubscriptionId());
            
          }else
          {
              $reponseType = "Failed";
              // $message = "Unable to Complete the Your Request. ";
              $errorMessages = $response->getMessages()->getMessage();
              $message = "Error : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
          }
     
        $data["reponseType"]=$reponseType;
      $data["message"]=$message;
        echo json_encode($data);
	}
	//==============Update subscription id in database table "membermaster"===========
	public function update_subscription_id($subid){
	    $usercode=$this->session->userdata['logged_ol_member']['usercode'];
	    $this->capture_pages_model->add_subscription_id($usercode,$subid);
	    	//----------------Activate Subscription ----------
        $this->capture_pages_model->activate_subscription($usercode);
	
	}

	
	
	
}

