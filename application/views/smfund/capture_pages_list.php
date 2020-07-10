<script>
	$(document).ready(function(e) {
		
		
		
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/smfund_capture/page/'+pagecode+'/<?=$this->session->userdata['logged_ol_member']['username']?>';
				//var url='<?php echo base_url();?>index.php/smfund_capture/page/'+pagecode+'/<?=$adminnm[0]['username']?>';
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		$(document).on('click', '.page_priview_reg', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/pages/after_reg_preview/'+pagecode+'';
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		 $(document).on('click', '.report_issue_popup', function (e) {
			var pagecode=$(this).attr('value');
			var url='<?php echo base_url();?>index.php/capture_pages/report_issue_popup/'+pagecode;
			e.preventDefault();
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
    });
</script>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Capture Pages List</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Smfund</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Capture Pages List</li>
    </ul>
  </div>
</div>
<?php
	$smfund_admin = $this->comman_fun->check_record('smfund_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'admin'=>'Yes'));
	//var_dump($adminnm);
	//echo $adminnm[0]['username'];
	//exit;
?>
<div class="row-fluid">
  <div class="span12 membertable">
    <table id="data-table" class="table table-striped table-bordered dataTable">
      <thead>
        <tr>
          <th>Page Name</th>
          <th>Page Type</th>
          <th>URL</th>
          <th>Opration</th>
        </tr>
      </thead>
      <tbody>
		<?php for($i=0;$i<count($result);$i++){
				echo '<tr>
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.$result[$i]['pagelable'].'</td>
						<td>'.base_url().'index.php/smfund_capture/page/'.$result[$i]['capture_page_code'].'/'.$this->session->userdata['logged_ol_member']['username'].'</td>
						<td><div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-danger btn-xs dropdown-toggle" type="button" id="btnGroupDrop1">Operation
						<span class="caret"></span></button>
						
						<ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu">';
							if($smfund_admin){
								echo '<li><a href="'.smfund().$this->uri->rsegment(1).'/edit_page/edit/'.$result[$i]['capture_page_code'].'">Edit</a></li>';
							}					
							echo '<li><a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'">Preview</a></li>
							<li><a href="'.smfund().'/view_friends/invitefriends/?page='.$result[$i]['capture_page_code'].'">Send</a></li>
						</ul>
						
						</div></td>
					</tr>';
        }?>
      </tbody>
    </table>
  </div>
</div>
