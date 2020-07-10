<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]]
	} );
} );

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Due Payment Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Due Payment Report</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Usercode</th>
          <th>Name</th>
          <th>Username</th>
          <th>Last Payment</th>
          <th>Due Date</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
      	<?=$html?>
      </tbody>
    </table>
  </div>
</div>
<style>
	.tr_due{
		background-color:#EF9E9E;
	}
	.tr_on{
		background-color:#8EEC6B;
	}	
</style>