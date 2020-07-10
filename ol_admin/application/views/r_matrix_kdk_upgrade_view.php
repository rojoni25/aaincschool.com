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
		"sAjaxSource": "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing",
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
							url:'<?php echo base_url()?>index.php/<?=$this->uri->segment(1)?>/upgrade_form/'+value+'',
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
<script>
	$(document).on('submit','#frm_pay',function(e){
		
		var con=confirm("Are You Sure Upgrade Membership ?");
		if(!con){
			e.preventDefault();
			return false;
		}
		$('.tr_submit_td').html('');
		$('.tr_submit_tr').hide();
		$('.submit_process').html('processing..');
			
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
      <h3 class="page-header">KDK Upgrade Request</h3>
    </div>
    <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">KDK Upgrade Request</li>
    </ul>
  </div>
</div>
	<?php if($this->session->flashdata('show_msg')!='') { ?>
        <div class="alert alert-success">
        	<button type="button" class="close" data-dismiss="alert">&times;</button>
        	<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong> 
        </div>
    <?php } ?>

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
.submit_process{
	color:#F00;
	font-weight:bold;
}
</style>
