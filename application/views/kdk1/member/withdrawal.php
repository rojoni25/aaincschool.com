<script>
	
	
	$(document).on('submit','#frm_tra',function(e){
		var amount	=	parseFloat($('#amount').val());
		if(amount <= 0){
			alert('Invalid Amount');
			$('#amount').focus();
			return false;
		}
		
	
		var balance	= parseFloat($('#balance').html());
		if(amount > balance){
			alert('Invalid Amount');
			$('#amount').focus();
			return false;
		}
			
		var con=confirm('Send Withdrawal Request');
		if(!con){  
			return false; 
		}	
		
	});
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>


<div class="row-fluid">
  <div class="span6">
  <h3 class="page-header">Pending Request</h3>
  	<table class="table table-striped table-bordered dataTable">
        <tr>
        	<td>Sr. No</td>
           
            <td>Amount</td>
            <td>Date</td>
            <td>Comment</td>
        </tr>
        <?php
        	for($i=0;$i<count($p_request);$i++){
				$row=$i+1;	
			
				echo '<tr>
        				<td>'.$row.'</td>
            			<td>'.$p_request[$i]['amount'].'</td>
            			<td>'.date('d-m-Y',strtotime($p_request[$i]['time_dt'])).'</td>
						<td>'.$p_request[$i]['description'].'</td>
        		</tr>';	
			}
		?>
     </table>	
  </div>
  <div class="span6">
    <h3 class="page-header">Withdrawal Request <div class="pull-right"><a href="<?=MATRIX_BASE?>member/dashboard/"><span class="label label-important">Dashboard</span> </a> </div></h3>
      <?php echo form_error('amount', '<p class="error">','</p>'); ?>
      <?php if(!isset($p_request[0])) { ?>
     <form method="post" action="<?=MATRIX_BASE?>account/withdrawal_insert" id="frm_tra">
     	<input type="hidden" name="balance" value="<?=$account_summary['balance']?>" />
     	<table class="table table-striped table-bordered dataTable">
     
        <tr>
        	<td>Balance</td>
            <td></td>
            <td>
            	 
            	<input type="text" value="$<?=number_format($account_summary['balance'],2)?>" readonly="readonly" />
            </td>
        </tr>
        <tr>
        	<td>Amount</td>
            <td></td>
            <td><input type="number" id="amount" name="amount"  placeholder="Enter Amount" required="required" />
            	
            </td>
        </tr>
         <tr>
        	<td>Comment</td>
            <td></td>
            <td><textarea name="description" id="description" placeholder="Comment Write Here"></textarea></td>
        </tr>
        
         <tr>
        	<td></td>
            <td></td>
            <td><button class="btn btn-success"><strong>Submit</strong></button></td>
        </tr>
    </table>
    </form>
    <?php } else {?>
    	<p style="font-weight:bold;color:#923D3D;">Your One Withdrawal Request Is Already Pending</p>
    <?php } ?>
  </div>
</div>


<?php /*?><div class="row-fluid">
  <div class="span12">
    <h3 class="page-header"><?=MATRIX_LLB?> withdrawal
    	
    </h3>
  
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Position</th>
          <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($position);$i++){			
				$no=$i+1;	
				echo '<tr>
						<th>Position-'.$no.'</th>
						<th>$'.number_format($position[$i]['credit'],2).'</th>
					</tr>';
			}?>
      </tbody>
    </table>
  </div>
</div>
<?php */?>
<style>
	.tot_m_14{
		background-color:#80cbc4 !important;	
	}
	.incomplete{
		background-color:#ffecb3;
	}
	.con_td_2{
		background-color:#80cbc4 !important;	
	}
	.con_td_4{
		background-color:#80cbc4 !important;	
	}
	.con_td_8{
		background-color:#80cbc4 !important;	
	}
	#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}
.verified{
	font-weight:bold;
	color:#060;
}
#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:700px !important;
	min-height:100px;
}
.btncustom{
	font-weight:bold;
}
.balance_inner_p{
		font-weight:bold;
		color:#F00;
	}
</style>

<?php
	function in_multiarray($elem, $array,$field)
	{
    	$top = sizeof($array) - 1;
    	$bottom = 0;
		$index=0;
    	while($bottom <= $top)
    	{	
        	if($array[$bottom][$field] == $elem){
				return $bottom+1;
			}
        	$bottom++;
    	}        
   		 return false;
	}
?>

