<script src="<?php echo base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?php echo base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>asset/js/TableTools.js"></script>

<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
		});
		
		notification_pop_set();
		var oTable = $("#data-table").dataTable();
		$(oTable).bind( 'draw', myfunction );
		
		$(document).on('click','.reject_req',function(e){
			var con=confirm('Are You Sure Reject Request ?');
			if(!con){
				e.preventDefault();
				return false;
			}
		});
    });
	
	
	
	function myfunction(){
		notification_pop_set();
	}
	
	
	
	
</script>



<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> Request</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Request</li>
      
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
	<br />




	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                	<th width="10%">Usercode</th>
                    <th width="15%">Username</th>
                    <th width="15%">Name</th>
                    <th width="30%">Message</th>
                    <th width="15%">Date</th>
                    <th width="25%">Remove</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result_list);$i++){?>
                	<tr>
                	<td><?=$result_list[$i]['usercode']?></td>
                    <td><?=$result_list[$i]['username']?></td>
                    <td><?=$result_list[$i]['name']?></td>
                    <td><?=$result_list[$i]['msg']?></td>
                    <td><?=date('M d, Y  i:j',$result_list[$i]['request_time'])?></td>
                    <td>
                    	<a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/request_approve/<?=$result_list[$i]['request_code']?>"><span class="label label-success">Approve</span></a>&nbsp;&nbsp;
                        <a class="reject_req" href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/reject_request/<?=$result_list[$i]['request_code']?>"><span class="label label-important">Reject</span></a>
                        <a class="notification_link" href="<?=MATRIX_BASE?>r_matrix_notification/popup/<?=$result_list[$i]['usercode']?>"><i class="icon-bell-alt"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>	
              
            </table>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>