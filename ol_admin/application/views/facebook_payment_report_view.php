<div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Facebook Payment Report</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">MASTER</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Facebook Payment Report</li>
        </ul>
      </div>
    </div>

<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
  </div>
    <?php } ?>
<!-- <script>

	
	$(document).on('click', '.btnsuccess', function (e) {
		var con=confirm('Are You Sure To verify Facebook Payment Request !');
		if(con==false){
			return false;
		}
	});
</script> -->
<script>
	$(document).ready(function(e) {
		var url='<?=base_url();?>index.php/<?=$this->uri->segment(1)?>/listing/<?=$this->uri->segment(3)?>';
    console.log(url);
    	$.ajax({url:url,success:function(result){
			$("#data-table2 tbody").html(result);
			// $('#data-table2').dataTable({
			// 		"bProcessing": true,
			// 		"iDisplayLength": 25,
			// 		"responsive": true,
			// 		"bDestroy": true,
			// 		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]]
			// });		
     	}});    
    });
	
</script>
<br>

    <div class="row-fluid">
      <div class="span12 tblover">
      
            <table class="table table-striped table-bordered" id="data-table2">
                <thead>
                    <tr>
                        <th>Usercode</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Email Id</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Card Exp Month</th>
                        <th>Card Exp Year</th>
                        <th>Card Holder Name</th>
                        <th>Address</th>
                        <th>Country</th>
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