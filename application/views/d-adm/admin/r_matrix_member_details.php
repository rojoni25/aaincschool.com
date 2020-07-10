
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> Member
      	<a href="<?=MATRIX_BASE?>r_matrix_member/view" class="pull-right"><span class="label label-success">Member List</span></a>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Memebr</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="page-header">Member Detail</div>
    <table class="table">
      <tbody>
        <tr>
          <th width="25%">User Code</th>
          <td width="1%">:</td>
          <td width="74%"><?=$member[0]['usercode']?></td>
        </tr>
        <tr>
          <th>Name</th>
          <td>:</td>
          <td><?=$member[0]['name']?></td>
        </tr>
        <tr>
          <th>Total Position</th>
          <th>:</th>
          <th><?=count($multi_position)?></th>
        </tr>
        <tr>
          <th>Complate Level</th>
          <th>:</th>
          <th><?=$level_complate?></th>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row-fluid">
  <div class="span6">
    <div class="page-header">Cash Wallet</div>
    <table class="table">
      <tbody>
        <tr>
          <th width="25%">Cash Wallet</th>
          <td width="1%">:</td>
          <td width="74%">$
            <?=number_format($payment['coin_pay'],2)?></td>
        </tr>
        <tr>
          <th>Coin Withdrawal</th>
          <td>:</td>
          <td>$
            <?=number_format($payment['coin_withdrawal'],2)?></td>
        </tr>
        <tr>
          <th>Coin Balance</th>
          <th>:</th>
          <th>$
            <?=number_format($payment['coin_balance'],2)?></th>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="span6">
    <div class="page-header">Pending Wallet</div>
    <table class="table">
      <tbody>
        <tr>
          <th>Pending Wallet</th>
          <td>:</td>
          <td>$
            <?=number_format($payment['pay'],2)?></td>
        </tr>
        <tr>
          <th>RM Withdrawal</th>
          <td>:</td>
          <td>$
            <?=number_format($payment['withdrawal'],2)?></td>
        </tr>
        <tr>
          <th>RM Balance</th>
          <th>:</th>
          <th>$
            <?=number_format($payment['balance'],2)?></th>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
   <h3 class="page-header">Position Details</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Position</th>
          <th>Upling</th>
          <th>Level-1</th>
          <th>Level-2</th>
          <th>Level-3</th>
          <th>Total Member</th>
          <th>Cash Wallet</th>
          <th>Pending Wallet</th>
          <th></th>
        </tr>
      </thead>
      <thead>
        <?php for($i=0;$i<count($multi_position);$i++){
					$position=$i+1;
					echo '<tr class="tot_m_'.$multi_position[$i]['total'].'">
							<th>Position-'.$position.'</th>
                    		<th>'.$multi_position[$i]['name2'].'</th>
                    		<th>'.$multi_position[$i]['level_1'].'</th>
                    		<th>'.$multi_position[$i]['level_2'].'</th>
                    		<th>'.$multi_position[$i]['level_3'].'</th>
                    		<th>'.$multi_position[$i]['total'].'</th>
							<th>'.$multi_position[$i]['coin'].'</th>
							<th>'.$multi_position[$i]['rm'].'</th>
							<th><a href="'.MATRIX_BASE.'r_matrix_tree/view/'.$multi_position[$i]['idcode'].'"><span class="label label-info">Tree View</span></a></th>
					</tr>';
				}?>
      </thead>
      <tfoot>
      	 <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th style="text-align:right;">Total</th>
          <th> <?=number_format($payment['coin_pay'],2)?></th>
          <th> <?=number_format($payment['pay'],2)?></th>
           <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>





<div class="row-fluid">
  <div class="span6">
    <div class="page-header">Cash Wallet Withdrawal</div>
    <table class="table table-striped table-bordered">
      <thead>
      		<tr>
          		<th>Id</th>
          		<th>Amount</th>
          		<th>Time</th>
        	</tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<count($withdrawal_coin); $i++){
			$id=$i+1;
			echo '<tr>
          			<td>'.$id.'</td>
          			<td>'.number_format($withdrawal_coin[$i]['amount'],2).'</td>
          			<td>'.date('d-m-Y',$withdrawal_coin[$i]['timedt']).'</td>
        	</tr>';
		}?>
      </tbody>
       <tfoot>
      		<tr>
          		<th>Total</th>
          		<th><?=number_format($payment['coin_withdrawal'],2)?></th>
          		<th></th>
        	</tr>
      <tfoot>
    </table>
  </div>
  <div class="span6">
    <div class="page-header">Pending Wallet Withdrawal</div>
    <table class="table table-striped table-bordered">
      <thead>
      		<tr>
          		<th>Id</th>
          		<td>Amount</td>
          		<td>Time</td>
        	</tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<count($withdrawal_rm); $i++){
			$id=$i+1;
			echo '<tr>
          			<td>'.$id.'</td>
          			<td>'.number_format($withdrawal_rm[$i]['amount'],2).'</td>
          			<td>'.date('d-m-Y',$withdrawal_rm[$i]['timedt']).'</td>
        	</tr>';
		}?> 
      </tbody>
      <tfoot>
      		<tr>
          		<th>Total</th>
          		<th><?=number_format($payment['withdrawal'],2)?></th>
          		<th></th>
        	</tr>
      <tfoot>
    </table>
  </div>
</div>
<style>

.tot_m_14{
	background-color:#DEC696;
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

.webui-popover {
	width:700px !important;
}
</style>
