<?php
	 $todate = date('d-m-Y');
	 $fromdate = date('d-m-Y');
?>
<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">
<script>
	$(document).ready(function() {
		$('#data-table').dataTable();
		
		$(document).on('click', '.btnfilter', function (e) {
			var todate=$('#txtto').val();	
			var fromdate=$('#txtfrom').val();	
			var url_curr='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/login_filter/'+todate+'/'+fromdate;
			$.ajax({url:url_curr,success:function(result){
			$('#data-table').dataTable().fnClearTable();	
			$("#data-table tbody").html(result);
				$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
				});
     		}});
		});
		
});

</script>

<script type="text/javascript">
  $(function() {
	  var nowDate = new Date();
	  var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+1, 0, 0, 0, 0);
	  
    	$('#todate').datetimepicker({ pickTime: false,endDate: today});
	 	$('#fromdate').datetimepicker({ pickTime: false, endDate: today });
  });
</script>
<div class="row-fluid">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=$title?></h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=$title?></li>
    </ul>
  </div>
</div>


	<div>
    	<table class="">
        	<tr>
                    <td width="30%"> 
                        <div class="control-group">
                            <label class="control-label">To Date</label>
                            	<div class="controls">
                            		<div id="todate" class="input-append">
                                        <input data-format="dd-MM-yyyy" type="text" name="todate" id="txtto" value="<?=$todate?>" class="" >
                                        </input>
                                        <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span> 
                                    </div>
                            	</div>
                        </div>
                    </td>
                <td width="30%"> 
                        <div class="control-group">
                            <label class="control-label">From Date</label>
                            	<div class="controls">
                            		<div id="fromdate" class="input-append">
                                        <input data-format="dd-MM-yyyy" type="text" name="fromdate" id="txtfrom" value="<?=$fromdate?>" class="" <?=$inqu_date?> >
                                        </input>
                                        <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span> 
                                    </div>
                            	</div>
                        </div>
                    </td>
                <td>
                	<input type="button" class="btn2 btn-info btnfilter" value="Filter" />
                </td>
            </tr>
        </table>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
    <div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
    	<?=$html?>
      </tbody>
    </table>
  </div>
  
 
  
  
</div>
  
<style>
sub{
	color:#F00 !important;
}
.btn2{
	border:none;
	padding:5px 10px;
	margin-top:13px;
}
@media  only screen and (max-width: 760px),  (min-device-width: 768px) and (max-device-width: 1024px) {

.membertable table, .membertable thead, .membertable tbody, .membertable th, .membertable td, .membertable tr {
	display: block;
}
.membertable thead tr {
	position: absolute;
	top: -9999px;
	left: -9999px;
}
.membertable tr {
	border: 1px solid #ccc;
}
.membertable td {
	border: none;
	border-bottom: 1px solid #eee;
	position: relative;
	padding-left: 50% !important;
}
.membertable td:before {
	position: absolute;
	top: 6px;
	left: 6px;
	width: 45%;
	padding-right: 10px;
	white-space: nowrap;
}
.membertable td:nth-of-type(1):before {
	content: "Operation";
}
.membertable td:nth-of-type(2):before {
	content: "Name";
}
.membertable td:nth-of-type(3):before {
	content: "Mobile No";
}
.membertable td:nth-of-type(4):before {
	content: "Email Id";
}
.membertable td:nth-of-type(5):before {
	content: "Referral";
}
.membertable td:nth-of-type(6):before {
	content: "Update";
}
}
	
.membertable{
	overflow-x: auto;
}	
</style>