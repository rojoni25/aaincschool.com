<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span6">
    <h3 class="page-header">Position Details</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th width="24%">Total Position</th>
          <th width="1%">:</th>
          <th width="75"><?=count($multi_position)?></th>
        </tr>
        <tr>
          <th>Complate Position</th>
          <th>:</th>
          <th><?=$complated_level?></th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="span6">
    <h3 class="page-header">Wallet  <a href="<?=MATRIX_BASE?>page/view/?page_key=tlc" class="pull-right"><span class="label label-success"><font style="font-weight:bold;letter-spacing:1px;">Dashboard</font></span></a></h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th width="24%">Wallet</th>
          <th width="1%">:</th>
          <th width="75%">$
            <?=number_format($payment['coin_pay'],2)?></th>
        </tr>
        <tr>
          <th>Withdrawal</th>
          <th>:</th>
          <th width="75%">$
            <?=number_format($payment['coin_withdrawal'],2)?></th>
        </tr>
        <tr>
          <th>Balance</th>
          <th>:</th>
          <th width="75%">$
            <?=number_format($payment['coin_balance'],2)?></th>
        </tr>
      </thead>
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
        
          <th>Re-Cycler</th>
          <th>Wallet</th>
          <th></th>
        </tr>
      </thead>
      <thead>
        <?php for($i=0;$i<count($multi_position);$i++){
					$position=$i+1;
					echo '<tr class="tot_m_'.$multi_position[$i]['total'].'">
							<th>Position-'.$position.'</th>
                    		
                    		
                    		<th class="incomplete con_td_3_'.$multi_position[$i]['level_1'].'">'.$multi_position[$i]['level_3'].'</th>
                    		
							<th>'.$multi_position[$i]['coin'].'</th>
							
							<th><a href="'.MATRIX_BASE.'martix_position_free/position_detail/'.$multi_position[$i]['idcode'].'"><span class="label label-info">Member</span></a></th>
					</tr>';
				}?>
      </thead>
      <tfoot>
        <tr>
          <th></th>
          <th style="text-align:right;"></th>
          <th style="text-align:right;">Total</th>
          <th>$
            <?=number_format($payment['coin_pay'],2)?></th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>



<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Withdrawal Record</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <thead>
        <?php for($i=0;$i<count($withdrawal_record);$i++){
					$id=$i+1;
					echo '<tr>
          					<th>'.$id.'</th>
          					<th>'.number_format($withdrawal_record[$i]['amount'],2).'</th>
          					<th>'.date('d-m-Y',$withdrawal_record[$i]['timedt']).'</th>
          					<th>'.$withdrawal_record[$i]['textdt'].'</th>
        				</tr>';
				}?>
      </thead>
      <tfoot>
        <tr>
          <th style="text-align:right;">Total</th>
          <th>$
            <?=number_format($payment['coin_withdrawal'],2)?></th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<style>
	.tot_m_14{
		background-color:#80cbc4 !important;	
	}
	.incomplete{
		background-color:#ffecb3;
	}
	.con_td_1_2{
		background-color:#80cbc4 !important;	
	}
	.con_td_2_4{
		background-color:#80cbc4 !important;	
	}
	.con_td_3_8{
		background-color:#80cbc4 !important;	
	}
</style>
