<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>	



<script>
	$(document).ready(function() {
		listing();
	});
	
	function listing(){
		////
		var oTable = $('#data-table').dataTable();
  		oTable.fnDestroy();
							
		$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": false,
		"sAjaxSource": "<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/listing_pif_report",
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
		"fnDrawCallback": function (oSettings) {
    
		  ///////////
		  $('.show-pop-event').each(function(i,elem) {
				 		//webuiPopover
						var value=$(this).attr('href');
						$(this).webuiPopover({
							constrains: 'horizontal', 
							trigger:'click',
							multi: false,
							placement:'auto',
							type:'async',
							container: "body",
							url:'<?php echo MATRIX_BASE?><?=$this->uri->rsegment(1)?>/upgrade_payment_form/'+value+'',
							cache:false,
								content: function(data){
								return data;
							}
						});
						//end webuiPopover
		});
		  //////////
     	}
		
	});
		////
	}

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PIF Send Report</h3>
    </div>
     <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">PIF Send Report</li>
    </ul>
   
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
            <th width="7%">Id</th>
            <th width="7%">Usercode</th>
            <th>Name</th>
            <th>Date</th>
            <th>Message</th>      
            <th>Status</th>         
        </tr>
      </thead>
      <tbody>
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
	width:700px !important;
}
</style>