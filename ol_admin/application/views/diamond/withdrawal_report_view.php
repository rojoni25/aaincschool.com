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
      <h3 class="page-header">Diamond Withdrawal Report
      	<div class="pull-right">
        	<a href="<?=diamond_base()?>diamond_wallet/view"><button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button></a>
        </div>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Diamond</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Withdrawal Report</li>
    </ul>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">SR.No</th>	
          <th width="15%">Usercode</th>
          <th width="15%">Name</th>
          <th width="30%">Message</th>
          <th width="15%">Amount</th>
          <th width="15%">Date</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++) { 
				$row=$i+1;
				echo '<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$result[$i]['text_dt'].'</td>
						<td>'.number_format($result[$i]['amount'],2).'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['date_dt'])).'</td>
					</tr>';
		}?>
        
      </tbody>
    </table>
  </div>
</div>
