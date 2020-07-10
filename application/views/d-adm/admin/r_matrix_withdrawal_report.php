<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
		
		})
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Payout Report</h3>
    </div>
     <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Payout Report</li>
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
            <th width="20%">Name</th>
            <th width="15%">Amount</th>
            <th width="15%">Date</th>
        </tr>
      </thead>
      <tbody>
      <?=$html?>
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