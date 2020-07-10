<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
<script>
	$(document).ready(function() {
		$('#data-table').dataTable( {
			
		});
	});
	
	$(document).on('click','.cls_approve',function(e){
		var con=confirm('Are You Sore Approve Withdrawal Request');
		if(!con){
			return false;
		}
	});
	
	
	$(document).on('click','.cls_reject',function(e){
		var con=confirm('Are You Sore Reject Request');
		if(!con){
			return false;
		}
	});
	
</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> Withdrawal Request
      	 <span class="pull-right">
        	<a href="<?=MATRIX_BASE?>ad_dashboard/dashboard" class="back_btn"><span class="label label-success">Dashboard</span></a>
        </span>	
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Withdrawal Request</li>
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
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
            <th width="7%">Sr. No</th>
            <th width="7%">Usercode</th>
            <th width="15%">Name</th>
            <th width="5%">Amount</th>
            <th width="15%">Balance</th>      
            <th width="15%">Date</th>     
            <th width="15%">Opration</th>        
        </tr>
      </thead>
      <tbody>
      	<?php 
			for($i=0;$i<count($result);$i++){
				$row=$i+1;
				echo'<tr>
						<th>'.$row.'</th>
						<th>'.$result[$i]['usercode'].'</th>
						<th>'.$result[$i]['name'].'</th>
						<th>'.$result[$i]['amount'].'</th>
						<th>$'.number_format($result[$i]['balance'],2).'</th> 
						<th>'.$result[$i]['time_dt'].'</th>      
						<th>
							<a href="'.MATRIX_BASE.''.$this->uri->rsegment(1).'/approve_request/'.$result[$i]['req_id'].'" class="cls_approve"><button class="btn btn-small btn-success">Approve</button></a> 
							<a href="'.MATRIX_BASE.''.$this->uri->rsegment(1).'/approve_cancel/'.$result[$i]['req_id'].'" class="cls_reject"><button class="btn btn-small btn-danger">Reject</button></a>
						</th>        
			        </tr>';
			}
		?>
      </tbody>
    </table>
  </div>
</div>
<style>
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

.no_verified{
	font-weight:bold;
	color:#F00;
}
.verified{
	font-weight:bold;
	color:#060;
}

.webui-popover {
	width:700px !important;
	
}
.inner_div_popup{
	max-height:400px;
	
	overflow:auto;
}

.back_btn{
		font-family: Arial,Helvetica,sans-serif;
	}

</style>