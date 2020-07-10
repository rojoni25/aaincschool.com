<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>	

<script>
	$(document).on('submit','#fpay',function(e){
		e.preventDefault();
		var con=confirm("Are You Sure?");
		if(!con){
			return false;
		}
		var form = $(this);
		var post_url = form.attr('action');
		$(".submit_process").html("<i class='icon-spinner icon-spin'></i> processing......");
		$('.tr_submit_tr').hide();
		$.ajax({
			type: 'post',url: post_url,data: $(this).serialize(),
			success: function (result) {							
				var data	=	$.parseJSON(result);
				if(data['vali']=='true'){
					$('.pop-div-main').html(data['msg']);
					listing();
				}
				
			}
		});
			
	});
	
	$(document).on('click','.delete_request',function(e){
		
		e.preventDefault();
		
		var con=confirm('Are You Sure Delete Request ?');
		
		if(!con){
			
			return false;
			
		}
		
		var url=$(this).attr('href');
		
		$.ajax({url:url,success:function(result){
			
			listing();	
			
		}});
	});	
	
</script>

<script>
	$(document).ready(function() {
		listing();
	});
	
	function listing(){
		
		var url='<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/listing/';
		var oTable = $('#data-table').dataTable();
  		oTable.fnDestroy();
		$.ajax({url:url,success:function(result){
			$('#data-table tbody').html(result);
				$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
				});
				
				get_popover();
				
				notification_pop_set();
				var oTable = $("#data-table").dataTable();
				$(oTable).bind( 'draw', myfunction );
				
		}});
	}
	
	function get_popover(){
		/////
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
							url:'<?php echo MATRIX_BASE?><?=$this->uri->rsegment(1)?>/popover_form/'+value+'',
							cache:false,
								content: function(data){
								return data;
							}
						});
						//end webuiPopover
		});
		////
	}
	
	function myfunction(){
		notification_pop_set();
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
      <h3 class="page-header">Member Withdrawal Request</h3>
    </div>
     <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Withdrawal Request</li>
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
            <th width="15%">Message</th>  
            <th width="15%">Opration</th>          
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
	width:500px !important;
}
</style>






<script>	
	$(document).on('submit','#notification_send',function(e){
		e.preventDefault();
		
		if($('#noti_description').val()==''){
			$('#noti_description').focus();
			return false;
		}
		
		var form = $(this);
		var post_url = form.attr('action');
		$(".submit_process").html("<i class='icon-spinner icon-spin'></i> processing......");
		$('.tr_submit_tr').hide();
		$.ajax({
			type: 'post',url: post_url,data: $(this).serialize(),
			success: function (result) {							
				var data	=	$.parseJSON(result);
				$('.pop-div-main').html(data['msg']);	
			}
		});
			
	});
	
	function notification_pop_set(){
		/////
		$('.notification_link').each(function(i,elem) {
			//webuiPopover
			var value=$(this).attr('href');
			$(this).webuiPopover({
				constrains: 'horizontal', 
				trigger:'click',
				multi: false,
				placement:'auto',
				type:'async',
				container: "body",
				url:value,
				cache:false,
					content: function(data){
					return data;
				}
			});
			//end webuiPopover
		});
		////
	}
</script>

