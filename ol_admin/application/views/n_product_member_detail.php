
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Paid Product Member Detail
      		<span class="pull-right">
            	<a href="<?=base_url()?>index.php/n_product_tree/member_view"><span class="label label-success">Member List</span></a>
            </span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Paid Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Paid Product Member Detail</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <tr>
        <td width="24%">Usercode</td>
        <td width="1%">:</td>
        <td width="75%"><?=$result[0]['usercode']?></td>
      </tr>
      <tr>
        <td>Username</td>
        <td>:</td>
        <td><?=$result[0]['username']?></td>
      </tr>
      <tr>
        <td>Subscription Id</td>
        <td>:</td>
        <td><?=$result[0]['subscription_id']?></td>
      </tr>
      <tr>
        <td>Member Name</td>
        <td>:</td>
        <td><?=$result[0]['name']?></td>
      </tr>
      <tr>
        <td>Join Date</td>
        <td>:</td>
        <td><?=date('d-m-Y H:i a',$result[0]['join_time'])?></td>
      </tr>
      <tr>
        <td>Due Date</td>
        <td>:</td>
        <td><?=date('d-m-Y H:i a',$result[0]['due_time'])?></td>
      </tr>
      <tr>
        <td>Status</td>
        <td>:</td>
        <td><?=($result[0]['due_time'] > time()) ? "Active" : "Due"?></td>
      </tr>
    </table>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Payment Details</h3>
    </div>
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>id</th>
          <th>Txn. Id</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Desc.</th>
        </tr>
        <?php 
			for($i=0;$i<count($payment);$i++){
				$row=$i+1;
				echo '<tr>
          				<th>'.$row.'</th>
          				<th>'.$payment[$i]['txn_id'].'</th>
          				<th>'.date('d-m-Y H:i a',$payment[$i]['time_dt']).'</th>
          				<th>$'.$payment[$i]['amount'].'</th>
          				<th>'.$payment[$i]['pay_type'].'</th>
        			</tr>';	
			}
		?>
      </thead>
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
