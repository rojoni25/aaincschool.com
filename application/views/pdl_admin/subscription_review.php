<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
<script>
	$(document).ready(function() {
	$('#data-table').dataTable({
		
	});
} );

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
    </div>
<?php } ?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Subscription Under Review
      	<div class="pull-right"> <a href="<?=base_url()?>index.php/pdl/member_tree/subscription_under_review?r=payment_flase" class="cls_payment_flase">Payment Flase</a></div>
      </h3>
    </div>
   
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Subscription Under Review</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="5%">Usercode</th>
          <th width="15%">Username</th>
          <th width="15%">Subscription Id</th>
          <th width="15%">Name</th>
          <th width="15%">Referral</th>
          <th width="10%">Date</th>
         
        </tr>
      </thead>
      <tbody>
      <?php
      		for($i=0;$i<count($result);$i++){
				
				$trclass=(isset($result[$i]['payment_false'])) ? "cls_payment_flase" : "";
				
				if($_REQUEST['r']=='payment_flase'){
					if(!isset($result[$i]['payment_false'])){
						continue;
					}
				}
				
				echo '<tr class="'.$trclass.' ">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['subscription_id'].'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$result[$i]['refname'].'</td>
						<td>'.date('d-m-Y  h:i:s',$result[$i]['subscription_time']).'  <br> (<font style="color:#F00;font-weight:bold;">'.ago_time(date('d-m-Y H:i:s',$result[$i]['subscription_time'])).'</font>)</td>
							
					</tr>';	
			}
		?>
      </tbody>
    </table>
  </div>
</div>

<?php /*?><form action="'.base_url().'index.php/pdl_online_payment/monthly_subscription_rep" method="post">
							<input type="hidden" name="x_subscription_id11" value="'.$result[$i]['subscription_id'].'" />
							<input type="hidden" name="x_response_code11" value="1" />
							<input type="hidden" name="x_amoun11t" value="25" />
							<input type="hidden" name="x_trans_id11" value="'.time().'" />
							<input type="submit" value="Payment" />
						</form><?php */?>
<style>

.payment_flase_link{
	font-size:12px;
}
.cls_payment_flase, .cls_payment_flase:hover{
	background-color:#BCD5C3;
	font-size:15px;
	padding:10px;
	text-decoration:none;
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

.no_verified{
	font-weight:bold;
	color:#F00;
}
.verified{
	font-weight:bold;
	color:#060;
}
</style>