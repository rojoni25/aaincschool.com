

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
		
		$(document).on('click','.reject_req',function(e){
			var con=confirm('Are You Sure Reject Request ?');
			if(!con){
				e.preventDefault();
				return false;
			}
		});
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<?=kdk_admin_menu();?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">KDK PIF Request</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">KDK PIF Request</li>
      
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
                	<th width="7%">Usercode</th>
                    <th width="10%">Username</th>
                    <th width="15%">Name</th>
                    <th width="30%">Message</th>
                    <th width="15%">PIF By</th>
                    <th width="10%">Date</th>
                    <th width="30%">Remove</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result_list);$i++){
						echo '<tr>
                				<td>'.$result_list[$i]['usercode'].'</td>
                    			<td>'.$result_list[$i]['username'].'</td>
                    			<td>'.$result_list[$i]['name'].'</td>
                    			<td>'.$result_list[$i]['msg'].'</td>
                    			<td>'.$result_list[$i]['pif_by_u'].'</td>
                    			<td>'.date('M d, Y  i:j',$result_list[$i]['request_time']).'</td>
                   			 	<td>
                    				<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/request_approve/'.$result_list[$i]['request_code'].'"><span class="label label-success">Approve</span></a>&nbsp;&nbsp;
                        			<a class="reject_req" href="'.base_url().'index.php/'.$this->uri->segment(1).'/reject_request/'.$result_list[$i]['request_code'].'"><span class="label label-important">Reject</span></a>
                    			</td>
                </tr>';
				}?>
            </tbody>	
              
            </table>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>