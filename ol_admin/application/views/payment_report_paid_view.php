<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/payment_report_paid/get_active_member",
		"aLengthMenu": [[50, 100, 200, 500], [50, 100, 200, 500]]
	} );
} );
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Balance Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Balance Report</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
  		<table class="table table-striped table-bordered">
        	<tr>
            	<td width="24%">Total Member Balance</td>
                <td width="1%">:</td>
                <td width="75%"><?=$result['total_balance']?></td>
            </tr>
            <tr>
            	<td>Max Withdrawal Request</td>
                <td>:</td>
                <td><a href="<?=base_url()?>index.php/payment_report_paid/withdrawal_possible"><?=$result['request_balance']?></a></td>
            </tr>
        </table>
  </div>	
</div>    
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Usercode</th>
          <th width="22%">Name</th>
          <th width="10%">Username</th>
          <th>Total Amount</th>
          <th>Total Withdrawal</th>
          <th>Balance</th>
          <th>Opration</th>
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