<script src="<?php echo base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?php echo base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>asset/js/TableTools.js"></script>

<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">


<script>
	//alert('gdf');
	$(document).on('click', '.open_popup', function (e) {
			var url=$(this).attr('href');
			e.preventDefault();
			$.magnificPopup.open({items: {src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
</script>


<script>
	$(document).ready(function(e) {
		
		get_listing();
		$(document).on('click','.reject_req',function(e){
			var con=confirm('Are You Sure Reject Request ?');
			if(!con){
				e.preventDefault();
				return false;
			}
		});
		
    });
	
	function get_listing(){
		
		var url='<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/listing/';
		
		
		$.ajax({url:url,success:function(result){
			var oTable = $('#data-table').dataTable();
  			oTable.fnDestroy();
		
			$('#data-table tbody').html(result)
	
			$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});
			
			notification_pop_set();
			
			var oTable = $("#data-table").dataTable();
			$(oTable).bind( 'draw', myfunction );
			
		}});
	}
	

	$(document).on('click','.request_remove',function(e){
		 e.preventDefault()
		 var url=$(this).attr('href');
		
		 $.ajax({url:url,success:function(result){		 	
		 		get_listing();
         }});
		 
	});
	
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
      <h3 class="page-header"><?=MATRIX_CODE_LLB?> Code Request</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=MATRIX_CODE_LLB?> Code Request</li>
      
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
	<br />




	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                	<th width="7%">Usercode</th>
                    <th width="10%">Username</th>
                    <th width="15%">Name</th>
                    <th width="30%">Message</th>
                    <th width="10%">Date</th>
                    <th width="30%">Remove</th>
                </tr>
            </thead>
            <tbody>
            	
            </tbody>	
              
            </table>



<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>

<link rel="stylesheet" href="<?php echo base_url();?>asset/popover/jquery.webui-popover.min.css">
<script type="text/javascript" src="<?php echo base_url();?>asset/popover/jquery.webui-popover.min.js"></script>

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

	

<style>

td{
	 word-wrap: break-word;
    -moz-hyphens:auto; 
    -webkit-hyphens:auto; 
    -o-hyphens:auto; 
    hyphens:auto; 
}
	
#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}

#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:500px !important;
}
.notification_link, .notification_link:hover{
	text-decoration:none;
	padding:3px;
}
.back_btn{
		font-family: Arial,Helvetica,sans-serif;
	}
</style>
