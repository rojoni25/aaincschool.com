<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

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
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=$title?></h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Message</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=$title?></li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th id="5%">Usercode</th>
          <th width="10%">Name</th>
          <th width="10%">Username</th>
          <th width="10%">Status</th>
          <th width="15%">Date</th>
          <th width="10%">Subject</th>
          <th width="40%">Meassage</th>
          <th width="10%">Delete</th>
        </tr>
      </thead>
      <tbody>
      	<?=$html?>
      </tbody>
    </table>
  </div>
</div>
