<script>
	
	$(document).on('click', '.btnreject', function (e) {
		var con=confirm('Are You Sure Reject Request !');
		if(con==false){
			return false;
		}
	});
	
	$(document).on('click', '.manually-pay', function (e) {
		var con=confirm('Are You Sure Manually Pay !');
		if(con==false){
			return false;
		}
	});
</script>
<script>
	$(document).ready(function(e) {
		var url='<?=base_url();?>index.php/<?=$this->uri->segment(1)?>/listing/<?=$this->uri->segment(3)?>';
    	$.ajax({url:url,success:function(result){
			$("#data-table2 tbody").html(result);
			$('#data-table2').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true,
					"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]]
			});		
     	}});    
    });
	
</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Upgrade Request
          	 <a href="<?php echo base_url();?>index.php/export_excel/send_request/<?=$this->uri->segment(3)?>" style="float:right;" title="Export To Excel"><img src="<?php echo base_url();?>asset/images/excel-icon.png" width="30" /></a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Upgrade Request</li>
        </ul>
      </div>
    </div>
    
   
    
    <div class="row-fluid">
      <div class="span12 tblover">
      <?php   if($upling){  ?>
      		<p style="font-size:16px;font-weight:100;"><font style="color:#FF0000;"><?=$record[0]['fname']?> <?=$record[0]['lname']?></font> 
            	 Upling Member Send Request To Upgrade Membership Active First </p>
            <p><a href="<?=base_url()?>index.php/upgrade_request/check_record/<?=$this->uri->segment(3)?>">
            <button type="button" value="Active" class="btn btn-danger"><strong>Active <?=$record[0]['fname']?> <?=$record[0]['lname']?></strong></button></a></p>
           
           
      <?php } else { ?>
            <table class="table table-striped table-bordered" id="data-table2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Email Id</th>
                        <th>Time</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                        <th>Payment Type</th>
                        <th>Referral</th>
                        <th>Ref. Phone No</th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
      <?php } ?>
         
      </div>
    </div>

<style>
	.tblover{
		overflow-x: auto;
	}
	.sendbtn {
		border: medium none;
		padding: 0px 10px;
	}
	.trpaid{
		background-color:#3BE61A !important;
		font-weight:bold;
	}
	.trunpaid{
		background-color:#98E49C  !important;
	}
</style>