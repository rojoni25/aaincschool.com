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
	
	if(file_exists(FCPATH."upload/company/".$result[0]['company_logo']) && $result[0]['company_logo']!="")
	{
		$logo	=	'<img src="'.base_url().'upload/company/'.$result[0]['company_logo'].'" width="70" />';
	}
	else{
		$logo	=	'';
	}
	
	
	
?>


<div class="row-fluid ">
  <div class="span12">
   		<div class="pull-right">
        	<a href="<?=MATRIX_BASE?>company_pages/view/"><span class="label label-success">Company List</span></a>
            <a href="<?=MATRIX_BASE?>martix/dashboard/"><span class="label label-important">Dashboard</span> </a>
        </div>
  </div>
</div> 
 

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=$logo?>&nbsp;&nbsp;<span class="pull-right"><?=$result[0]['company_name']?></span></h3>
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