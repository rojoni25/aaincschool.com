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
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PDL To Opp Payment</h3>
    </div>
     <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Payment</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">PDL To Opp Payment</li>
    </ul>
   
  </div>
</div>
	
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
            <th width="7%">Id</th>
            <th width="10%">Usercode</th>
            <th width="10%">Name</th>
            <th width="15%">Amount</th>  
            <th width="10%">Date</th>
        </tr>
      </thead>
      <tbody>
      	<?php for($i=0;$i<count($result);$i++){
				$row=$i+1;
			?>
                <tr>
                    <td><?=$row?></td>
                    <td><?=$result[$i]['usercode']?></td>
                    <td><?=$result[$i]['name']?></td>
                    <td><?=$result[$i]['amount']?></td>
                    <td><?=date('d-m-Y',$result[$i]['timedt'])?></td>
                </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<style>

	
#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}
.verified{
	font-weight:bold;
	color:#060;
}
#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:500px !important;
}
</style>