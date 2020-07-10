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

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> Payment Report</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Payment Report</li>
      
    </ul>
  </div>
</div>

	<table class="table">
    		<tr>
            	<td width="19%">Total Payment</td>
                <td width="1%">:</td>
                <td width="80%"><?=count($result)?></td>
            </tr>
            <tr>
            	<td>Total Amount</td>
                <td>:</td>
                <td>$<?=$total?></td>
            </tr>
    </table>

	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                	<th width="10%">Usercode</th>
                    <th width="15%">Name</th>
                    <th width="30%">Amount</th>
                    <th width="15%">Payment Type</th>
                    <th width="15%">Txn. Id</th>
                    
                    <th width="25%">Date</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result);$i++){?>
                    <tr>
                        <td><?=$result[$i]['usercode']?></td>
                        <td><?=$result[$i]['name']?></td>
                        <td>$<?=$result[$i]['amount']?></td>
                        <td><?=$result[$i]['pay_method']?></td>
                        <td><?=$result[$i]['txn_id']?></td>
                        
                        <td><?=date('M d, Y  i:j',strtotime($result[$i]['timedt']))?></td>
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