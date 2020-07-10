<script>
	$(document).ready(function(e) {
			$('#data-table2').dataTable({});
			$(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/request_page_view/'+pagecode+'';
				url=url.replace('ol_admin/', '');
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
    $(document).on('change','#report_type',function(e){
		var value=$(this).val();
		window.location.href='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/capture_page_request/'+value;
	});
 });
</script>


<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Capture Pages Request</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Capture Pages</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Capture Pages Request</li>
    </ul>
  </div>
</div>
 <div class="row-fluid">
      <div class="span12">
      		<?php
				$sel_1=($this->uri->segment(3)=='Active') ? "selected='selected'" : "";
            	$sel_2=($this->uri->segment(3)=='Done') ? "selected='selected'" : "";
				$sel_3=($this->uri->segment(3)=='Delete') ? "selected='selected'" : "";
			?>
      		<select id="report_type" name="report_type">
            	<option <?=$sel_1?> value="Active">Pending</option>
                <option <?=$sel_2?> value="Done">Approve</option>
                <option <?=$sel_3?> value="Delete">Cancle</option>
            </select>
      </div>
    </div>  
<div class="row-fluid">
  <div class="span12">
  
    <table class="table table-striped table-bordered" id="data-table2">
      <thead>
        <tr>
          <th width="7%">Request Code</th>
          <th width="7%">Usercode</th>
          <th width="20%">Member Name</th>
          <th width="20%">Page Name</th>
          <th width="10%">Status</th>
          <th width="35%">Opration</th>
        </tr>
      </thead>
      <tbody>
      <?php for($i=0;$i<count($result);$i++){?>
      			<tr>
          			<td><?=$result[$i]['request_code']?></td>
          			<td><?=$result[$i]['usercode']?></td>
          			<td><?=$result[$i]['fname']?> <?=$result[$i]['lname']?></td>
          			<td><?=$result[$i]['page_name']?></td>
                    <td><?=$result[$i]['status']?></td>
          			<td>
                    	<a href="<?=base_url()?>index.php/capture_page/capture_page_status/<?=$result[$i]['request_code']?>/Delete"><span class="label label-warning">Reject</span></a>&nbsp;&nbsp;
                        <a href="<?=base_url()?>index.php/capture_page/capture_page_request_add/<?=$result[$i]['request_code']?>"><span class="label label-info">Edit</span></a>&nbsp;&nbsp;
                        <a href="#" class="pageperview" value="<?=$result[$i]['request_code']?>"><span class="label label-danger">Preview</span></a>&nbsp;&nbsp;
                        <a href="<?=base_url()?>index.php/capture_page/capture_page_request_add/<?=$result[$i]['request_code']?>/approve"><span class="label label-success">Approve</span></a>&nbsp;&nbsp;
                        <a href="<?=base_url()?>index.php/comman_controler/member_details_view/<?=$result[$i]['username']?>"><i class="icon-eye-open"></i></a>
                      <a href="<?=base_url()?>index.php/capture_page/email_to_member/<?=$result[$i]['request_code']?>"><span class="label label-info">Member Email</span></a>

					  <?php /*?> <?php
					   if($email[$i]['email_verification']=='Y'){?>
						<a href="<?=base_url()?>index.php/capture_page/email_to_member/<?=$result[$i]['request_code']?>"><span class="label label-info">Member Email</span></a>
						<?php
					   }
					   else{  
					   }
					 ?><?php */?>
                    </td>
        		</tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<style>
	.btncls{
		border:none;
	}
</style>
