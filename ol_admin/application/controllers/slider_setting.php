<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slider_setting extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('media_upload_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib'); 
 	}
	
	public function index()
	{
		$p=array('image');
		
		if(isset($_REQUEST['type'])){$data['mediatype']=$_REQUEST['type'];}
		else{$data['mediatype']='image';}
		
		if(!in_array($_REQUEST['type'],$p)){
			$data['mediatype']='image';
		}
		
		$data['result']	=	$this->media_upload_model->get_slider($data['mediatype']);
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function addnew()
	{
		$p=array('image');
		
		if(isset($_REQUEST['type'])){$data['mediatype']=$_REQUEST['type'];}
		else{$data['mediatype']='image';}
		
		if(!in_array($_REQUEST['type'],$p)){
			$data['mediatype']='image';
		}
		
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->media_upload_model->get_record($this->uri->segment(4));
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord()
	{
			$files = $_FILES;
		
			$data=array();
			$filetype=explode('/',$files['post_img']['type']);
			$filetype=$filetype[0];
			
			$data['status'] 		= 	'Active';
			$path=base_url();
			if($this->input->post('type')=='audio')
			{
				$data['type'] 		=   'audio';
				$data['galleyname'] = 	$this->input->post('galleyname');
				$data['description'] = 	$this->input->post('description');
				
				$data['media_link'] = 	$this->input->post('media_link');
				$this->media_upload_model->addItem($data,'media_gallery');
			}
			if($this->input->post('type')=='ppt')
			{
				$data['type'] 		=   'ppt';
				$data['galleyname'] = 	$this->input->post('galleyname');
				$data['description'] = 	$this->input->post('description');
				
				$data['media_link'] = 	$this->input->post('media_link');
				$this->media_upload_model->addItem($data,'media_gallery');
			}
			if($this->input->post('type')=='youtube')
			{
				$data['type'] 		=   'youtube';
				$data['galleyname'] = 	$this->input->post('galleyname');
				$data['description'] = 	$this->input->post('description');
				
				$data['media_link'] = 	$this->input->post('media_link');
				$this->media_upload_model->addItem($data,'media_gallery');
			}
			if($this->input->post('type')=='mp4')
			{
				
				$data['type'] 		=   'mp4';
				$data['galleyname'] = 	$this->input->post('galleyname');
				$data['description'] = 	$this->input->post('description');
				
				if($_POST['mp4type']=='video')
				{
					$uploadedfile = $_FILES['post_img']['tmp_name'];
					$rand=rand(100000,100000000);
					$fileName=$rand.$_FILES['post_img']['name'];
					$fileName = str_replace(" ","",$fileName);
					$uploadpath='../upload/media/file/'.$fileName;
					move_uploaded_file($uploadedfile,$uploadpath);
					$path = str_replace("ol_admin/", "", $path);
        			$data['media_link']	=	$path.'upload/media/file/'.$fileName;
				}
				if($_POST['mp4type']=='link')
				{
					$data['media_link']	= $this->input->post('mp4link');
				}
				
				
				$this->media_upload_model->addItem($data,'media_gallery');
				
			}
			
			if($this->input->post('type')=='image')
			{
				$data['galleyname'] = 	$this->input->post('galleyname');
				$data['description'] = 	$this->input->post('description');
				
				$data['type'] 		=   'image';
				$path=base_url();
				$config = array();
    			$config['upload_path'] = '../upload/slider/file';
    			$config['allowed_types'] = 'gif|jpg|png|jpeg';
    			$config['max_size']      = '0';
    			$config['overwrite']     = FALSE;
				if($files['post_img']['name']!='')
				{
					$_FILES['userfile']['name'] 	= 	$files['post_img']['name'];
					$_FILES['userfile']['type'] 	= 	$files['post_img']['type'];
					$_FILES['userfile']['tmp_name']	= 	$files['post_img']['tmp_name'];
					$_FILES['userfile']['error']	= 	$files['post_img']['error'];
					$_FILES['userfile']['size']		= 	$files['post_img']['size']; 
					
					$image_info 		= getimagesize($_FILES['userfile']['tmp_name']);
					$data['width'] 		= $image_info[0];
					$data['height'] 	= $image_info[1];
					
					$rand=rand(100000,100000000);
					$fileName=$rand.$_FILES['post_img']['name'];
					$fileName = str_replace(" ","",$fileName);
					$config['file_name'] = $fileName;
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$path = str_replace("ol_admin/", "", $path);
					
					
					
					$data['media_link']	=	$path.'upload/slider/file/'.$fileName;
					$data['imgthum']	=	$path.'upload/slider/thum/'.$fileName;
					$this->media_upload_model->addItem($data,'slider_gallery');
				}
				
					
			
				
				if($filetype=='image')
				{
						$upload_data = $this->upload->data();
						$image_config["image_library"] = "gd2";
						$image_config["source_image"] = $upload_data["full_path"];
						$image_config['create_thumb'] = FALSE;
						$image_config['maintain_ratio'] = TRUE;
						$image_config['new_image'] = '../upload/slider/thum/'.$fileName;
						$image_config['quality'] = "65%";
						$image_config['width'] = 150;
						$image_config['height'] = 150;
						$this->load->library('image_lib');
						$this->image_lib->initialize($image_config);
						$this->image_lib->resize();
				}
	
			}//if image
			
			header('Location: '.base_url().'index.php/slider_setting?type='.$this->input->post('type'));
			exit;
	}
	
	function update_record()
	{
		$data['status']='Delete';
		$this->media_upload_model->update($data,'slider_gallery','gallerycode',$this->uri->segment(3));
		
		
	}
	
	
}

