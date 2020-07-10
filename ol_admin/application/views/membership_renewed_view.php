<script>
	$(document).ready(function(e) {
		get_listing_auto();
		
		$(document).on('change', '#renewed_type', function (e) {
			var value=$(this).val();
			if(value=='2'){
				$('.head-title').html('Renewed Manually (Due Member)');
				get_listing_manually();
			}
			else{
				$('.head-title').html('Renewed Membership');
				get_listing_auto();
			}
		});
    });
	
	function get_listing_auto(){
		var oTable = $('#data-table').dataTable();
  		oTable.fnDestroy();
		var url_curr='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/renewed_auto';
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
	
	function get_listing_manually(){
		var oTable = $('#data-table').dataTable();
  		oTable.fnDestroy();
		var url_curr='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/renewed_manually';
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
          <h3 class="page-header"><span class="head-title">Renewed Membership</span>
          	    <span class="pull-right">
            	<select id="renewed_type">
                	<option value="1">Renewed (In Member Balnce)</option>
                    <option value="2">Renewed Manually (Due Member)</option>
                </select>
            </span>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Renewed Membership</li>
        </ul>
      </div>
    </div>
    <?php if($_REQUEST['status']=='fail') {?>
    	<div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-minus-sign"></i><strong><?=$_REQUEST['msg']?></strong>
        </div>
    <?php } ?>
        
	<?php if($_REQUEST['status']=='true') {?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon-ok-sign"></i><strong><?=$_REQUEST['msg']?></strong>
         </div>
    <?php } ?>
       
    
    <div class="row-fluid">
      <div class="span12 tblover">
         <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Usercode</th>
              	<th>Name</th>
             	<th>Username</th>
              	<th>Email Id</th>
                <th>Due Date</th>
                <th>Current Balance</th>
                <th></th>
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
	#renewed_type{
		margin-top:6px;
		font-weight:bold;
	}
</style>