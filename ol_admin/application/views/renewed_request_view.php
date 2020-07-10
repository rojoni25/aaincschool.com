<script>
	$(document).ready(function(e) {
		get_listing();
        $(document).on('click', '.remove_record',function(e){ 
			e.preventDefault();
			var url=$(this).attr('href');
			
	
			var con=confirm('Are You Sure You Want To Delete Request');
			if(!con){
				return false;
			}
			$.ajax({
				url:url,
				success: function(e){
					get_listing();
					
				}
			})
		});
    });
	
	function get_listing(){
		
		var oTable = $('#data-table').dataTable();
  		oTable.fnDestroy();
		
		var url_curr='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing';
		$.ajax({url:url_curr,success:function(result){
			$("#data-table tbody").html(result);
			$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});	
			oTable.fnAdjustColumnSizing();	
     	}});	
	}
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Renewed Request</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Renewed Request</li>
        </ul>
      </div>
    </div>
  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
    
    <div class="row-fluid">
      <div class="span12 tblover">
         <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th>Request Send By</th>
             	<th>Request For</th>
                <th>Current Balance</th>
              	<th>Date</th>
                <th>Opration</th>
               
            </tr>
          </thead>
          <tbody>
           </tbody>
        </table>
      </div>
    </div>

<style>
	.tblover{
		overflow-x: auto;
	}
	.strong-font{
		font-weight:bold;
		padding-left:10px !important;
	}
	.iconcls, .iconcls:hover{
		font-size:16px;
		color:#666 !important;
		text-decoration:none;
	}
	.pen-member{
		color:#F00 !important;
	}
</style>