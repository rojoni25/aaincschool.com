<?php
	if($_POST['todate']!=''){
		$todate=$_POST['todate'];
	}
	else{
		//$todate=date('d-m-Y');
	}
	if($_POST['fromdate']!=''){
		$fromdate=$_POST['fromdate'];
	}
	else{
		//$fromdate=date('d-m-Y');
	}
?>
<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script type="text/javascript">
  $(function() {
	 var nowDate = new Date();
	  var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+1, 0, 0, 0, 0);
      $('#todate').datetimepicker({ pickTime: false,endDate: today});
	  $('#fromdate').datetimepicker({ pickTime: false,endDate: today});
  });
</script>

<script>
	$(document).ready(function(e) {
        //////////
	   		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate_active',
                        minLength:1,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#user_code').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////
    });
</script>

<div class="row-fluid "><div class="span12"><ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Balance Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Balance Report</li>
    </ul>
  </div>
</div>
<!----------------------->
<div class="row-fluid">
		<!------------error msg------------------>
        
        <?php if($_error) { ?>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon-exclamation-sign"></i><strong>Error!</strong> Invalid Date
            </div>
        <?php } ?>    
        <!-----------error msg End------------------->
		<div class="span6">
        	<div class="content-widgets white">
            	<div class="widget-head light-blue">
                	<h3>Date</h3>
                </div><!----widget-header-block------>
                <div class="widget-container">
                    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/member_payment_report/list_view" enctype="multipart/form-data">
                        <!------------------>
                        <div class="control-group">
                        	<label class="control-label">To Date</label>
                        	<div class="controls">
                        		<div id="todate" class="input-append">
                        			<input data-format="dd-MM-yyyy" type="text" name="todate" value="<?=$todate?>" class="{validate:{required:true}}" ></input>
                        				<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                        		</div>
                        	</div>
                        </div>
                        
                        <div class="control-group">
                        	<label class="control-label">From Date</label>
                        	<div class="controls">
                        		<div id="fromdate" class="input-append">
                        			<input data-format="dd-MM-yyyy" type="text" name="fromdate" value="<?=$fromdate?>" class="{validate:{required:true}}" ></input>
                        				<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                        		</div>
                        	</div>
                        </div>
                        
                        <div class="control-group">
                        	<label class="control-label">Member</label>
                        	<div class="controls">
                                <input type="text" id="membername" name="membername" value="<?=$_POST['membername']?>" placeholder="Search Member" />
    							<input type="hidden" id="user_code" name="usercode" value="<?=$_POST['usercode']?>" name="usercode" />
                        	</div>
                        </div>
                        	
                        <div class="form-actions">
            				<button type="submit" name="report" value="report" class="btn btn-warning btnsubmit">Get Report</button>
                            <button type="submit" name="excel" value="excel" class="btn btn-info btnsubmit">Excel</button>
          				</div>
                    </form>        
                </div><!-----widget-container------>
            </div><!-----content-widgets------>
        </div><!---span6----->
        
        
        <div class="span6">
        	<div class="content-widgets white">
            	<div class="widget-head light-blue">
                	<h3>Report</h3>
                </div><!----widget-header-block------>
                <div class="widget-container">
              
                    <table class="table">
                    	<tr>
                            <td width="30%">Total Payment</td>
                            <td width="1%">:</td>
                            <td width="69%"><?=$total[0]['total']?></td>
                        </tr>
                    </table>
                    
                </div><!-----widget-container------>
            </div><!-----content-widgets------>
        </div><!---span6----->
    </div>
<!----------------------->
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Usercode</th>
          <th width="22%">Name</th>
          <th width="10%">Username</th>
          <th>Sponsor</th>
          <th>Amount</th>
           <th>Date</th>
          <th>Skype</th>
          <th>Contact No</th>
          <th>Email Id</th>
         
          
        </tr>
      </thead>
      <tbody>
      	<?=$html?>
      </tbody>
    </table>
  </div>
</div>
<style>
	.tr_due{
		background-color:#EF9E9E;
	}
	.tr_on{
		background-color:#8EEC6B;
	}	
</style>