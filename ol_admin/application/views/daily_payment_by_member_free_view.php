<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">

<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>	

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
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

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Daily Payment By Member</h3>
         
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Payment</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Daily Payment By Member</li>
        </ul>
      </div>
    </div>
    
    <div class="row-fluid">
    <div class="span12">
        	<div class="content-widgets white">
            	<div class="widget-head light-blue">
                	<h3>Date</h3>
                </div><!----widget-header-block------>
                <div class="widget-container">
                    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/view" enctype="multipart/form-data">
                        <!------------------>
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
						$sel_1=($_POST['daily_date']=='3by3') ? "selected='selected'" : "";
            			$sel_2=($_POST['daily_date']=='5by3') ? "selected='selected'" : "";
						$sel_3=($_POST['daily_date']=='10by3') ? "selected='selected'" : "";
					?>
                        <div class="control-group">
                        	<label class="control-label">Payment Date</label>
                        	<div class="controls">
                        		<select id="report_type" name="report_type">
            							<option <?=$sel_1?> value="3by3">3 x 3</option>
                						<option <?=$sel_2?> value="5by3">5 x 3</option>
                						<option <?=$sel_3?> value="10by3">10 x 3</option>
            				</select>
                            
                        	</div>
                        </div>
                        
                        <?php if(isset($count[0])){?>    	
                          <div class="control-group">
                        		<label class="control-label">Total Member</label>
                        			<div class="controls">
                            			<input type="text" readonly="readonly" value="<?=$count[0]['tot']?>" />
                        			</div>
                          </div>
                       <?php } ?>
                        	
                        <div class="form-actions">
            				<button type="submit" class="btn btn-warning btnsubmit">Get Report</button>
                           
          				</div>
                    </form>        
                </div><!-- widget-container -->
            </div><!-- content-widgets -->
        </div><!-- span6 -->
    </div>
  
  
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Pay To</th>
                    <th>Detail</th>
                </tr>
          </thead>
          <tbody>
            	<?=$html?>
           </tbody>
        </table>
      </div>
    </div>


<script>
	$(document).ready(function(e) {
             	////
		$('.payment_to').each(function(i,elem) {
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
						//end webuiPopover
				 });
				////   
            });
</script>