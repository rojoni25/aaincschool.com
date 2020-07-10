<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Finance</a> </li>
    <li class="active-bre"><a href="#"> Payment Confirm Report</a> </li>
  </ul>
</div> 
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Payment Confirm Report</h4>
    <br>
    <?php if($this->session->flashdata('show_msg')!=''){?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
      </div>
    <?php } ?>
    <script>

    	
    	$(document).on('click', '.btnsuccess', function (e) {
    		var con=confirm('Are You Sure Confirm Payment Request !');
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

    <div class="">
      <div class="col-md-12 tblover">
      
            <table class="table table-striped table-bordered" id="data-table2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Email Id</th>
                        <th>Message</th>
                        <th>subject</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Referral</th>
                        <th>Ref. Phone No</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
   
         
      </div>
    </div>
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