<?php
	$daily_date=date('d-m-Y',$select_time_stam);
?>
<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>

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

<script type="text/javascript">
  $(function() {
	 var nowDate = new Date();
	  var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+1, 0, 0, 0, 0);
     $('#daily_date').datetimepicker({ pickTime: false,endDate: today});
  });
</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Daily Payment Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Daily Payment Report</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
        
    <?php if($_error) { ?>
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon-exclamation-sign"></i><strong>Error!</strong> Invalid Date
        </div>
    <?php } ?>
		<div class="span6">
        	<div class="content-widgets white">
            	<div class="widget-head light-blue">
                	<h3>Date</h3>
                </div><!-- widget-header-block -->
                <div class="widget-container">
                    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/payment_report_free/free_payment_daily" enctype="multipart/form-data">
                        <input type="hidden" name="mode" id="mode" value="Edit" />
                        <input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['usercode']?>" />
                        <div class="control-group">
                        	<label class="control-label">Payment Date</label>
                        	<div class="controls">
                        		<div id="daily_date" class="input-append">
                        			<input data-format="dd-MM-yyyy" type="text" name="daily_date" value="<?=$_POST['daily_date']?>" class="{validate:{required:true}}" ></input>
                        				<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                        		</div>
                        	</div>
                        </div>
                        
                         <?php
						$sel_1=($_POST['report_type']=='3by3') ? "selected='selected'" : "";
            			$sel_2=($_POST['report_type']=='5by3') ? "selected='selected'" : "";
						$sel_3=($_POST['report_type']=='10by3') ? "selected='selected'" : "";
					?>
                        <div class="control-group">
                        	<label class="control-label">Type</label>
                        	<div class="controls">
                        		<select id="report_type" name="report_type">
            							<option <?=$sel_1?> value="3by3">3 x 3</option>
                						<option <?=$sel_2?> value="5by3">5 x 3</option>
                						<option <?=$sel_3?> value="10by3">10 x 3</option>
            				</select>
                            
                        	</div>
                        </div>
                        	
                        <div class="form-actions">
            				<button type="submit" class="btn btn-warning btnsubmit">Get Report</button>
          				</div>
                    </form>        
                </div><!-- widget-container -->
            </div><!-- content-widgets -->
        </div><!-- span6 -->
        
        
       
        
        
		   
</div>

<div class="row-fluid">
  <div class="span12 membertable">
  
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Usercode</th>
          <th>Name</th>
          <th>Username</th>
           <th>Total Get</th>
       
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

<script>
	$(document).ready(function(e) {
             	////
		$('.payment_form').each(function(i,elem) {
				 		//webuiPopover
						var url=$(this).attr('href');
					
						$(this).webuiPopover({
							constrains: 'horizontal', 
							trigger:'click',
							multi: false,
							placement:'auto',
							type:'async',
							container: "body",
							url:url,
							cache:false,
								content: function(data){
								return data;
							}
						});
						
				 });
            });
</script>