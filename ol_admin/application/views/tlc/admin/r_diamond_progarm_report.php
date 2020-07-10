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
		
		$('#data-table2').dataTable({
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
<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"> <?=MATRIX_CODE_LLB?> Diamond Purchase Program </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">
        <?=MATRIX_LLB?>
        </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">
        <?=MATRIX_CODE_LLB?>
        Code Request</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
  		<table class="table">
        	<tr>
            	<th width="19%">Total Success</th>
                <th width="1%">:</th>
                <th width="80%"><?=$count_true?></th>
            </tr>
            <tr>
            	<th>Total Failed</th>
                <th>:</th>
                <th><?=$count_false?></th>
            </tr>
        </table>
  </div>
</div> 

<div class="row-fluid">
  <div class="span6">
  	 <div class="primary-head">
      	<h3 class="page-header">Payment Success Report</h3>
    </div>
    <table class="table table-striped table-bordered dataTable" id="data-table">
      <thead>
        <tr>
          <th width="10%">Sr. No</th>
          <th width="10%">Usercode</th>
          <th width="15%">Name</th>
          <th width="20%">Amount</th>
          <th width="20%">Date</th>
          <th width="10%">Status</th>
        </tr>
      </thead>
      <tbody>
		<?php
			for($i=0;$i<count($result);$i++){
				$row=$i+1;
				echo '<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$result[$i]['amount'].'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['timedt'])).'</td> 
						<td>'.$result[$i]['status'].'</td>
					 </tr>';
			}
        ?>
      </tbody>
    </table>
  </div>
  
  <div class="span6">
  <div class="primary-head">
      	<h3 class="page-header">Payment Failed Report</h3>
    </div>
    <table class="table table-striped table-bordered dataTable" id="data-table2">
      <thead>
        <tr>
          <th width="10%">Sr. No</th>
          <th width="10%">Usercode</th>
          <th width="15%">Name</th>
          <th width="20%">Amount</th>
          <th width="20%">Date</th>
          <th width="10%">Status</th>
        </tr>
      </thead>
      <tbody>
		<?php
			for($i=0;$i<count($result2);$i++){
				$row=$i+1;
				echo '<tr>
						<td>'.$row.'</td>
						<td>'.$result2[$i]['usercode'].'</td>
						<td>'.$result2[$i]['name'].'</td>
						<td>'.$result2[$i]['amount'].'</td>
						<td>'.date('d-m-Y',strtotime($result2[$i]['timedt'])).'</td> 
						<td>'.$result2[$i]['status'].'</td>
					 </tr>';
			}
        ?>
      </tbody>
    </table>
  </div>
  
</div>
<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>
