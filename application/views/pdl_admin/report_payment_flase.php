<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		
	});
} );

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PDL Payment Flase</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">PDL Payment Flase</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
        	<th>Sr</th>
            <th>Usercode</th>
            <th>Username</th>
             <th>Name</th>
            <th>Subscription Id</th>
            <th>Date</th>
            <th>Desc.</th>
        </tr>
      </thead>
      <?php
      		for($i=0;$i<count($result);$i++){
				$field=json_decode($result[$i]['post_data'],true);
				$sr=$i+1;
				echo '<tr>
						<td>'.$sr.'</td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$field['x_subscription_id'].'</td>
						<td>'.date('d-m-Y H:i a ',$result[$i]['time_dt']).'</td>
						<td>'.$field['x_response_reason_text'].'</td>
					</tr>';	
			}
	  ?>
      <tbody>
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
	content: "Usercode";
}
.membertable td:nth-of-type(2):before {
	content: "Subscription";
}
.membertable td:nth-of-type(3):before {
	content: "Name";
}
.membertable td:nth-of-type(4):before {
	content: "Username";
}
.membertable td:nth-of-type(5):before {
	content: "Join Date";
}
.membertable td:nth-of-type(6):before {
	content: "Due Date";
}
.membertable td:nth-of-type(7):before {
	content: "Total Subscribe";
}
.membertable td:nth-of-type(8):before {
	content: "PDL-W.1";
}
.membertable td:nth-of-type(9):before {
	content: "PDL-W.2";
}
.membertable td:nth-of-type(10):before {
	content: "Ref-W.";
}
.membertable td:nth-of-type(11):before {
	content: "Opration";
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