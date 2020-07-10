<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class opportunity extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){
		    header('Location: '.base_url().'index.php/login');
		    exit;
		} 
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->model('opportunity_model','',TRUE);
		$this->load->model('rg_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('email');
   		
 	}
	public function pages_list()
	{
// 		if($this->session->userdata['logged_ol_member']['status']=='Active')
// 		{
            $data['contain']=$this->opportunity_model->get_pages_contain_two('opportunity_page');
			$data['html']=$this->get_date();
			$data2['table_list']=true;
			$this->load->view('comman/topheader',$data2);
			$this->load->view('comman/header');
			$this->load->view('opportunity_view',$data);
			$this->load->view('comman/footer');
// 		}
// 		else
// 		{
// 			$now = time();
// 			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
// 			$data['result']	=	$this->opportunity_model->get_page();
// 			$data['eid']	=	$data['result'][0]['company_code'];
// 			$data['mode']	=	'Edit';
// 			if(!isset($data['result'][0]))
// 			{
// 				$info['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
// 				$info['create_date']	=	$nowdt;
// 				$company_code=$this->opportunity_model->addItem($info,'company_master');
// 				$data['eid']=$company_code;
// 				$data['mode']='Edit';
// 			}
			
// 			$this->load->view('comman/topheader');
// 			$this->load->view('comman/header');
// 			$this->load->view('opportunity_add',$data);
// 			$this->load->view('comman/footer');
// 		}
	
	}
	
	function insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
    		
			$data['company_name']	=	$this->input->post('company_name');	
			$data['short_desc']		=	$this->input->post('short_desc');
			$data['pagename']		=	$this->input->post('pagename');
			$data['page_contain']	=	$this->input->post('page_contain');
			$data['video_url1']		=	$this->input->post('video_url1');
			$data['video_url2']		=	$this->input->post('video_url2');
			$data['video_url3']		=	$this->input->post('video_url3');
			$data['status']			=	$this->input->post('status');
			$data['refurl']			=	$this->input->post('refurl');
			$data['capturepage_url']=	$this->input->post('capturepage_url');
			
			if($_FILES['post_img']['name'])
			{
				$data['logo']		=	$this->uploadimg();
			}
			
			if($this->input->post('mode')=="Add")
			{	
				$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['create_date']	=	$nowdt;	
				$company_code=$this->opportunity_model->addItem($data,'company_master');
			}
			if($this->input->post('mode')=="Edit")
			{
				$data['update_date']	=	$nowdt;	
				$this->opportunity_model->update($data,"company_master","company_code",$this->input->post('eid'));	
				$company_code=$this->input->post('eid');
			}
			
			$this->opportunity_model->row_delete($company_code);	
			$info['usercode']			=	$this->session->userdata['logged_ol_member']['usercode'];
			$info['company_code']		=	$company_code;
			$info['join_date']			=	$nowdt;
			$info['referralid']			=	$this->session->userdata['logged_ol_member']['username'];
			$this->opportunity_model->addItem($info,'company_join_dt');
	
			header('Location: '.base_url().'index.php/opportunity/pages_list');
			exit;
			
		}
	}
	
	function uploadimg()
	{
			$files = $_FILES;
			$config = array();
    		$config['upload_path'] = 'upload/company';
    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
    		$config['max_size']      = '0';
    		$config['overwrite']     = TRUE;
			
			
				
				$_FILES['userfile']['name'] 	= 	$files['post_img']['name'];
        		$_FILES['userfile']['type'] 	= 	$files['post_img']['type'];
        		$_FILES['userfile']['tmp_name']	= 	$files['post_img']['tmp_name'];
        		$_FILES['userfile']['error']	= 	$files['post_img']['error'];
        		$_FILES['userfile']['size']		= 	$files['post_img']['size']; 
				$image_info 	= getimagesize($_FILES['userfile']['tmp_name']);
				$image_width 	= $image_info[0];
				$image_height 	= $image_info[1];
				
				$rand=rand(100000,100000000);
				$fileName=$rand.$_FILES['post_img']['name'];
				$fileName = str_replace(" ","",$fileName);
        		$config['file_name'] = $fileName;
    			$this->upload->initialize($config);
    			$this->upload->do_upload();
				
				
				$upload_data = $this->upload->data();
				$image_config["image_library"] = "gd2";
				$image_config["source_image"] = $upload_data["full_path"];
				$image_config['create_thumb'] = FALSE;
				$image_config['maintain_ratio'] = TRUE;
				$image_config['new_image'] = 'upload/company/'.$fileName;
				$image_config['quality'] = "65%";
				$image_config['width'] = 100;
				$image_config['height'] = 100;
				$this->load->library('image_lib');
				$this->image_lib->initialize($image_config);
				$this->image_lib->resize();
				return $fileName;
			
			
	}
	
	function get_date()
	{
		$result=$this->opportunity_model->get_all();
		$html='';
		for($i=0;$i<count($result);$i++){
			$html.='<tr>
					<td><img src="'.base_url().'upload/company/'.$result[$i]['logo'].'" width="50" /></td>
					<td>'.$result[$i]['company_name'].'</td>
					<td>'.$result[$i]['pagename'].'</td>
					<td><a href="'.base_url().'index.php/opportunity/addnew/Edit/'.$result[$i]['company_code'].'"><button class="btn-info btncls" type="button">Edit</button></a></td>
			</tr>';
		}
		
		
		return $html;
	}
	
	function addnew()
	{
	
		if($this->uri->segment(3)=='Edit')
		{
			$data['result']=$this->opportunity_model->get_record($this->uri->segment(4));
			$data['eid']=$data['result'][0]['company_code'];
			$data['mode']='Edit';
		}
		else{
		    	if($this->session->userdata['logged_ol_member']['status']!='Active')
		    {
		    
		         if($this->opportunity_model->get_pages_count()>0){
		           header("Location:".base_url()."index.php/opportunity/pages_list");
		           exit;
		       }else{
		           $data['mode']='Add';
		       }
		    	
		    }else{
		      $data['mode']='Add';
		    }
			
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function page()
	{
		$data['contain']=$this->opportunity_model->get_pages_contain_two('opportunity_page');
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$data['html']=$this->listing();
		$this->load->view('opportunity_page_list',$data);
		$this->load->view('comman/footer');
		if($this->uri->segment(3)=='business')
		{
			$sub = 'Money Train Page Open';
			$message = $this->session->userdata['logged_ol_member']['fullname'].' open other Money Train';
			//Send Email
	        $ref_email=$this->rg_model->get_member_detail_by_code($this->session->userdata['logged_ol_member']['ref_by']);	
	        $e_array=array("heading"=>"Member clicked on Money Train","msg"=>$message,"contain"=>'');	
	        $msg=email_template_money_train($e_array);
	        $fromemail = $this->session->userdata['logged_ol_member']['emailid'];
	        sendemail($fromemail,$sub,$ref_email[0]['emailid'],$msg);
	        // Send Notification
	        $data=array();
	        $data['usercode']=$this->session->userdata['logged_ol_member']['ref_by'];
	        $data['by_usercode']=$this->session->userdata['logged_ol_member']['usercode'];
	        $data['type']='notification';
	        $data['contain']=$message;
	        $data['timedt']=time();
	        $data['status']='Active';
	        //print_r($data);
	        $this->opportunity_model->addItem($data,'notification_master');
	        
	    }
	}
	
	function listing(){
		$html='';
		$result		=$this->opportunity_model->self_company();
		if($this->uri->segment(3)=='business')
		{
		    
			$result	=$this->opportunity_model->getAll_pages();
// 			$html.=var_export($result, true);
			
			   
				for($i=0;$i<count($result);$i++)
				{
				    if ($result[$i]['status']=='Active') {
					$videohtml1 = "";
					if($result[$i]['video_url1']!=''){
						$videohtml1 = '<a href="'.base_url().'index.php/opportunity/show_video/'.$result[$i]['company_code'].'/1" target="_blank"><button type="button" class="btn btn-danger">Video 1</button></a>';
					}
					$videohtml2 = "";
					if($result[$i]['video_url2']!=''){
						$videohtml2 = '<a href="'.base_url().'index.php/opportunity/show_video/'.$result[$i]['company_code'].'/2" target="_blank"><button type="button" class="btn btn-danger">Video 2</button></a>';
					}

					$videohtml3 = "";
					if($result[$i]['video_url3']!=''){
						$videohtml3 = '<a href="'.base_url().'index.php/opportunity/show_video/'.$result[$i]['company_code'].'/3" target="_blank"><button type="button" class="btn btn-danger">Video 3</button></a>';
					}
						//-----Button for joining opportunity---
					$btn_join='<a href="'.base_url().'index.php/opportunity/onJoinReferalLink?id='.$result[$i]['company_code'].'&url='.$result[$i]['refurl'].'" target="_blank"><button type="button" class="btn btn-danger">Join</button></a>';
					$html .='<tr>
					<td><img src="'.base_url().'upload/company/'.$result[$i]['logo'].'" alt="Logo" width="50" /></td>
					<td>'.$result[$i]['company_name'].'</td>
					<td>'.$result[$i]['short_desc'].'</td>
					<td>'.$result[$i]['status'].'</td>
					<td> '.$btn_join. '  '.$videohtml1.'  '.$videohtml2.'  '.$videohtml3.'</td>
				</tr>';
				}
			}
		}
		else
		{
			
			for($i=0;$i<count($result);$i++)
			{	
			    	$videohtml1 = "";
					if($result[$i]['video_url1']!=''){
						$videohtml1 = '<a href="'.base_url().'index.php/opportunity/show_video/'.$result[$i]['company_code'].'/1" target="_blank"><button type="button" class="btn btn-danger">Video 1</button></a>';
					}
					$videohtml2 = "";
					if($result[$i]['video_url2']!=''){
						$videohtml2 = '<a href="'.base_url().'index.php/opportunity/show_video/'.$result[$i]['company_code'].'/2" target="_blank"><button type="button" class="btn btn-danger">Video 2</button></a>';
					}

					$videohtml3 = "";
					if($result[$i]['video_url3']!=''){
						$videohtml3 = '<a href="'.base_url().'index.php/opportunity/show_video/'.$result[$i]['company_code'].'/3" target="_blank"><button type="button" class="btn btn-danger">Video 3</button></a>';
					}
					//--------Button for joining opportunity---------
					$btn_join='<a href="" onclick="notifyOnJoining('.$result[$i]['company_code'].',\''.$result[$i]['refurl'].'\')" target="_blank"><button type="button" class="btn btn-danger">Join</button></a>';
				$html .='<tr class="">
						<td><img src="'.base_url().'upload/company/'.$result[$i]['logo'].'" alt="Logo" width="50" /></td>
						<td>'.$result[$i]['company_name'].'</td>
						<td>'.$result[$i]['short_desc'].'</td>
						<td>'.$result[$i]['status'].'</td>
              	        <td>'.$videohtml1.'  '.$videohtml2.' '.$videohtml3.'</td>

              		</tr>';
              						//  		<td><a href="'.base_url().'index.php/opportunity/page_view/'.$result[$i]['company_code'].'"><button type="button" class="btn btn-danger">View</button></a></td>

			}
			
		}
		
		
		return $html;
	}
	
	function page_view()
	{
		$data['contain']	=	$this->opportunity_model->get_pages_contain($this->uri->segment(3));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('opportunity_page_view',$data);
		$this->load->view('comman/footer');
	}
	function show_video($eid)
	{
		$pageArr	=	$this->opportunity_model->get_pages_contain($eid);
		$data['video_link']	= '';
		$sub = '';
		$message = '';
		if($this->uri->segment(4)==1){
			$data['video_link']	= $pageArr[0]['video_url1'];
			$sub = 'Money Train Page Video 1 review';
			$message = $this->session->userdata['logged_ol_member']['fullname'].' clicked on video 1 on your Money Train page';
		}
		if($this->uri->segment(4)==2){
			$data['video_link']	= $pageArr[0]['video_url2'];
			$sub = 'Money Train Page Video 2 review';
			$message = $this->session->userdata['logged_ol_member']['fullname'].' clicked on video 2 on your Money Train page';
		}
		if($this->uri->segment(4)==3){
			$data['video_link']	= $pageArr[0]['video_url3'];
			$sub = 'Money Train Page Video 3 review';
			$message = $this->session->userdata['logged_ol_member']['fullname'].' clicked on video 3 on your Money Train page';
		}
		$this->load->view('opportuniy_show_video',$data);

		//Send Email
        $ref_email=$this->rg_model->get_member_detail_by_code($this->session->userdata['logged_ol_member']['ref_by']);	
        $e_array=array("heading"=>"Member clicked on Video","msg"=>$message,"contain"=>'');	
        $msg=email_template_money_train($e_array);
        $fromemail = $this->session->userdata['logged_ol_member']['emailid'];
        sendemail($fromemail,$sub,$ref_email[0]['emailid'],$msg);
         // Send Notification
        $data=array();
        $data['usercode']=$this->session->userdata['logged_ol_member']['ref_by'];
        $data['by_usercode']=$this->session->userdata['logged_ol_member']['usercode'];
        $data['type']='notification';
        $data['contain']=$message;
        $data['timedt']=time();
        $data['status']='Active';
        //print_r($data);
        $this->opportunity_model->addItem($data,'notification_master');
	}
	function sendnotification($page){
		$pageArr	=	$this->opportunity_model->get_pages_contain($page);
		$sub = 'Opportunity Page View Click';
		$message = $this->session->userdata['logged_ol_member']['fullname'].' clicked on View button of '.$pageArr[0]['company_name'];
		//Send Email
        $ref_email=$this->rg_model->get_member_detail_by_code($this->session->userdata['logged_ol_member']['ref_by']);	
        $e_array=array("heading"=>"Member clicked on View","msg"=>$message,"contain"=>'');	
        $msg=email_template_money_train($e_array);
        $fromemail = $this->session->userdata['logged_ol_member']['emailid'];
        sendemail($fromemail,$sub,$ref_email[0]['emailid'],$msg);
        // Send Notification
        $data=array();
        $data['usercode']=$this->session->userdata['logged_ol_member']['ref_by'];
        $data['by_usercode']=$this->session->userdata['logged_ol_member']['usercode'];
        $data['type']='notification';
        $data['contain']=$message;
        $data['timedt']=time();
        $data['status']='Active';
        //print_r($data);
        $this->opportunity_model->addItem($data,'notification_master');
	}
	//============================== AJAX Call Clicked on join====================================
	function onJoinReferalLink(){
	    $page=$_REQUEST["id"];
	    $url=$_REQUEST["url"];
	    $pageArr=$this->opportunity_model->get_pages_contain($page);
	    	// =======================Send Notification=====================================
	    	$message=$this->session->userdata['logged_ol_member']['fullname'].' clicked on Join button of '.$pageArr[0]['company_name'];
	    	$sub = 'Money Train Join';
	    //-----Send Email--------------
	    //Send Email
        $ref_email=$this->rg_model->get_member_detail_by_code($this->session->userdata['logged_ol_member']['ref_by']);	
        $e_array=array("heading"=>"Member clicked on Join Button","msg"=>$message,"contain"=>'');	
        $msg=email_template_money_train($e_array);
        $fromemail = $this->session->userdata['logged_ol_member']['emailid'];
        //------for debugging ---
        // echo $fromemail;
        // echo $ref_email[0]['emailid'];
        //var_dump($msg);
        //--------------
        sendemail($fromemail,$sub,$ref_email[0]['emailid'],$msg);
      
	        $data=array();
	        $data['usercode']=$this->session->userdata['logged_ol_member']['ref_by'];
	        $data['by_usercode']=$this->session->userdata['logged_ol_member']['usercode'];
	        $data['type']='notification';
	        $data['contain']=$message;
	        $data['timedt']=time();
	        $data['status']='Active';
	        //print_r($data);
	        $this->opportunity_model->addItem($data,'notification_master');
	       // echo '<script>var win = window.open(\''.$url.'\', "_blank");
        //       win.focus();</script>';
	        header("Location:".$url);
	}
}


