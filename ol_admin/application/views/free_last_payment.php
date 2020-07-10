<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/payment_report/listing_free_pay",
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]]
	} );
} );

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Free Member Last Payment</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Free Member Last Payment</li>
    </ul>
  </div>
</div>
<table class="table">
	<?php
    	$pay_date = date('d-m-Y', $last_pay);
	?>
	<tr>
    	<td width="19%">Payment Date</td>
        <td width="1%">:</td>
        <td width="80%"><?=$pay_date?></td>
    </tr>
    <tr>
    	<td>Total Member Payment</td>
        <td>:</td>
        <td><?=$tot_pay[0]['tot']?></td>
    </tr>
    <tr>
    	<td>Total Send Email</td>
        <td>:</td>
        <td><?=$send_total[0]['tot']?></td>
    </tr>
    <tr>
    	<td>Sending Fail</td>
        <td>:</td>
        <td><?=$fail_total[0]['tot']?></td>
    </tr>
    <tr>
    	<td>Sending Remaining</td>
        <td>:</td>
        <td><?=$notsend_total[0]['tot']?></td>
    </tr>
</table>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Usercode</th>
          <th>Name</th>
          <th>Username</th>
          <th>Email Status</th>
          
        </tr>
      </thead>
      <tbody>
    
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