<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class join_friend extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->model('join_friend_model','',TRUE);
 	}
	
	public function index()
	{
		$data['table_list']=true;
		$data['contain']=$this->join_friend_model->get_pages_contain('join_friend');
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$html='';
		$result		=$this->join_friend_model->self_company();
		for($i=0;$i<count($result);$i++)
		{
			$refcode=$this->join_friend_model->get_refcode($result[$i]['company_code']);
			$html .='<tr class="mycomp">
						<td><img src="'.base_url().'upload/company/'.$result[$i]['logo'].'" alt="Logo" width="50" /></td>
						<td>'.$result[$i]['company_name'].'</td>
						<td>'.$result[$i]['short_desc'].'</td>
						<td>'.$result[$i]['refurl'].'</td>
						<td>
							<table width="100%" class="membertable1">
								<tr>
								<td><input type="text" id="txtref'.$result[$i]['company_code'].'" class="txtref span12" name="txtref" value="'.$refcode[0]['referralid'].'" /></td>
								<td><button class="btnclssubmit btn-success" type="submit" company_code="'.$result[$i]['company_code'].'">Save</button></td>
								</tr>
						   </table> 
						</td>
						<td><a href="#" class="test_link" company_code="'.$result[$i]['company_code'].'" url="'.$result[$i]['refurl'].'" >Test Link</a></td>
              		</tr>';
		}
		
		$result		=$this->join_friend_model->getAll();
		for($i=0;$i<count($result);$i++)
		{
			$refcode=$this->join_friend_model->get_refcode($result[$i]['company_code']);
			$html .='<tr>
						<td><img src="'.base_url().'upload/company/'.$result[$i]['logo'].'" alt="Logo" width="50" /></td>
						<td>'.$result[$i]['company_name'].'</td>
						<td>'.$result[$i]['short_desc'].'</td>
						<td>'.$result[$i]['refurl'].'</td>
						<td>
								<table width="100%" class="membertable1">
									<tr>
									<td><input type="text" id="txtref'.$result[$i]['company_code'].'" class="txtref span12" name="txtref" value="'.$refcode[0]['referralid'].'" /></td>
									<td><button class="btnclssubmit btn-success" type="submit" company_code="'.$result[$i]['company_code'].'">Save</button></td>
									</tr>
							   </table>
						   
						</td>
						<td><a href="#" class="test_link" company_code="'.$result[$i]['company_code'].'" url="'.$result[$i]['refurl'].'" >Test Link</a></td>
              		</tr>';
		}
		echo $html;
	}
	
	
	
	function invitefriends_insertrecord()
	{
	if ($this->input->server('REQUEST_METHOD') === 'POST')
	{	
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$data['invite_emailid']	=	$this->input->post('invite_emailid');	
		$data['subject']		=	$this->input->post('subject');
		$data['message']		=	$this->input->post('message');
		$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['timedt']			=	$nowdt;	
		$data['status']			=	'Active';
		$data['pagecode']		=	$this->input->post('pagecode');
		$data['send_url']		=	$this->input->post('current_url');

		$id=$this->join_friend_model->addItem($data,'invite_friend_master');
  	
	}
	header('Location: '.$_POST['current_url']);
	exit;
}

	function add_company()
	{
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data = array();
		
		$refcode=$this->join_friend_model->check_refcode($this->uri->segment(3));
		if(isset($refcode[0])){
			$data['referralid']			=	$this->uri->segment(4);
			$this->join_friend_model->update($data,'company_join_dt','joindtcode',$refcode[0]['joindtcode']);	
		}
		else{
			$data['company_code']		=	$this->uri->segment(3);
			$data['usercode']			=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['referralid']			=	$this->uri->segment(4);
			$data['join_date']			=	$nowdt;
			$this->join_friend_model->addItem($data,'company_join_dt');
		}
		
	}	
	
	
}

