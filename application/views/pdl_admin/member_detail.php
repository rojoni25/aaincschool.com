
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Account Overview</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Account Overview</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td width="29%">Member Name</td>
        <td width="1%">:</td>
        <td width="70%"><?=$result[0]['name']?></td>
      </tr>
      <tr>
        <td>Usercode</td>
        <td>:</td>
        <td><?=$result[0]['usercode']?></td>
      </tr>
      <tr>
        <td>Join Date</td>
        <td>:</td>
        <td><?=date('d-m-Y h:i',$result[0]['join_date'])?></td>
      </tr>
      <tr>
        <td>Total Subcribe</td>
        <td>:</td>
        <td><?=count($subscribe)?></td>
      </tr>
    </table>
  </div>
  
  
</div>

<div class="row-fluid">
  
  <div class="span4">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td colspan="3"><span style="color:#333;font-weight:bold;">PDL Wallet-1 (Leve-1, Leve-2)</span></td>
      </tr>
      <tr>
        <td width="29%">Wallet</td>
        <td width="1%">:</td>
        <td width="70%">$
          <?=number_format($payment['payment_1'],2)?></td>
      </tr>
      <tr>
        <td>Withdrawal</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['withdrawal_1'],2)?></td>
      </tr>
      <tr>
        <td>balance</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['balance_1'],2)?></td>
      </tr>
    </table>
  </div>
  <div class="span4">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td colspan="3"><span style="color:#333;font-weight:bold;">PDL Wallet-2 (Leve-3)</span></td>
      </tr>
      <tr>
        <td width="29%">Wallet</td>
        <td width="1%">:</td>
        <td width="70%">$
          <?=number_format($payment['payment_2'],2)?></td>
      </tr>
      <tr>
        <td>Withdrawal</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['withdrawal_2'],2)?></td>
      </tr>
      <tr>
        <td>balance</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['balance_2'],2)?></td>
      </tr>
    </table>
  </div>
  <div class="span4">
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td colspan="3"><span style="color:#333;font-weight:bold;">Ref. Wallet</span></td>
      </tr>
      <tr>
        <td width="29%">Wallet</td>
        <td width="1%">:</td>
        <td width="70%">$
          <?=number_format($payment['payment_3'],2)?></td>
      </tr>
      <tr>
        <td>Withdrawal</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['withdrawal_3'],2)?></td>
      </tr>
      <tr>
        <td>balance</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['balance_3'],2)?></td>
      </tr>
    </table>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <h3 class=" page-header">Subscribe Detail</h3>
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="5%">Sr</th>
          <th width="15%">Date</th>
          <th width="15%">Transaction Id</th>
        </tr>
      </thead>
      <tbody>
        <?php
      		for($i=0;$i<count($subscribe);$i++){
				$row=$i+1;
				echo '<tr>
						<td>'.$row.'</td>
						<td>'.date('d-m-Y h:i',$subscribe[0]['time_dt']).'</td>
						<td>'.$subscribe[$i]['txn_id'].'</td>
				</tr>';	
			}
		?>
      </tbody>
    </table>
  </div>
</div>


<div class="row-fluid">
  <div class="span6">
  	<h3 class=" page-header">Payment Detail</h3>
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td>No</td>
        <td>Date</td>
        <td>Amount</td>
        <td>Subscribe</td>
        <td>Level</td>
        <td>Wallet</td>
      </tr>
      <?php for($i=0;$i<count($payment_list);$i++){
				$no=$i+1;
				
				if($payment_list[$i]['wallet_type']=='pdl_1'){	$wallet_type='PDL Wallet-1';}
				elseif($payment_list[$i]['wallet_type']=='pdl_2'){$wallet_type='PDL Wallet-2';}
				elseif($payment_list[$i]['wallet_type']=='opp_wallet'){$wallet_type='Ref. Wallet';}			
			
				echo '<tr class="'.$payment_list[$i]['wallet_type'].'">
				<td>'.$no.'</td>
				<td>'.date('d-m-Y h:i',$payment_list[$i]['timedt']).'</td>
				<td>$'.$payment_list[$i]['amount'].'</td>
				<td>'.$payment_list[$i]['name'].'</td>
				<td>'.$payment_list[$i]['level_pay'].'</td>
				<td>'.$wallet_type.'</td>
				</tr>';
       } ?>
    </table>
  </div>
  <div class="span6">
  	<h3 class=" page-header">Withdrawal Detail</h3>
    <table class="table table-striped tbl-simple table-bordered">
      <tr>
        <td>No</td>
        <td>Date</td>
        <td>Amount</td>
        <td>Text</td>
        <td>Wallet</td>
      </tr>
      <?php for($i=0;$i<count($withdrawal_list);$i++)
	  {
				$no=$i+1;
				
				if($withdrawal_list[$i]['wallet_type']=='pdl_1'){$wallet_type='PDL Wallet-1';}
				
				elseif($withdrawal_list[$i]['wallet_type']=='pdl_2'){$wallet_type='PDL Wallet-2';}
				
				elseif($withdrawal_list[$i]['wallet_type']=='opp_wallet'){$wallet_type='Ref. Wallet';}	
				
				echo '<tr class="'.$withdrawal_list[$i]['wallet_type'].'">
				<td>'.$no.'</td>
				<td>'.date('d-m-Y h:i',$withdrawal_list[$i]['timedt']).'</td>
				<td>$'.$withdrawal_list[$i]['amount'].'</td>
				<td>$'.$withdrawal_list[$i]['msg'].'</td>
				<td>'.$wallet_type.'</td>
				</tr>';
       } ?>
    </table>
  </div>
</div>
<style>
.pdl_1{
	background-color:#85EDB9;
}
.pdl_2{
	background-color:#8BCCAB;
}
.opp_wallet{
	background-color:#D8BB7F;
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
