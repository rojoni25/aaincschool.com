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

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="pull-right"> <a href="<?=MATRIX_BASE?>product/view/"><span class="label label-success">Product List</span></a> <a href="<?=MATRIX_BASE?>member/dashboard/"><span class="label label-important">Dashboard</span> </a> </div>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$result[0]['product_name']?>
      </h3>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <?=$result[0]['description']?>
  </div>
</div>
<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>
