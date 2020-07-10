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
	
    });
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=kdk_admin_menu();?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PIF Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">PIF Report</li>
    </ul>
  </div>
</div>
<table class="table table-striped table-bordered dataTable" id="data-table">
  <thead>
    <tr>
      <th width="10%">Usercode</th>
      <th width="15%">Username</th>
      <th width="15%">Name</th>
      <th width="30%">Message</th>
    </tr>
  </thead>
  <tbody>
    <?=$html?>
  </tbody>
</table>
<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>
