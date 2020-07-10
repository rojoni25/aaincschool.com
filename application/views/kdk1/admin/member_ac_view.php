
<script>
	
	
	
	$(document).on('change','#type',function(e){
		if($(this).val()=='credit'){
			$('.position_tr').show(500)
		}else{
			$('.position_tr').hide(500)	
		}
	});
			
	
	$(document).on('submit','#frm_tra',function(e){
		var amount	=	parseFloat($('#amount').val());
		if(amount <= 0){
			alert('Invalid Amount');
			$('#amount').focus();
			return false;
		}
		 if($('#type').val()=='credit'){
			var con=confirm('Confrim Credit $'+amount+' ');
			if(!con){  
				return false; 
			}		
		 }
		 
		 if($('#type').val()=='debit'){
			var balance	= parseFloat($('#balance').val());
			if(amount > balance){
				alert('Invalid Amount');
				$('#amount').focus();
				return false;
			}
			
			var con=confirm('Confrim Debit $'+amount+' ');
			if(!con){  
				return false; 
			}	
		 }
	});
</script>
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=MATRIX_LLB?>
        Member A/c
        <span class="pull-right">
        	<a href="<?=MATRIX_BASE?>ad_member/member_view" class="back_btn"><span class="label label-success">Member List</span></a>
        </span>	
        </h3>
        
        
        
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">
        <?=MATRIX_LLB?>
        </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Online Payment</li>
    </ul>
  </div>
</div>



<div class="row-fluid">
	 <div class="span6">
     	
        <div class="primary-head">
      		<h3 class="page-header">Member Detail</h3>
    	</div>
        	
     	<table class="table table-striped table-bordered dataTable">
     	<tr>
        	<td width="24%">Usercode</td>
            <td width="1%">:</td>
            <td width="75%"><?=$result[0]['usercode']?></td>
        </tr>
        <tr>
        	<td>Member Name</td>
            <td></td>
            <td><?=$result[0]['name']?></td>
        </tr>
        <tr>
        	<td>Join Date</td>
            <td></td>
            <td><?=date('d-m-Y',$result[0]['add_time'])?></td>
        </tr>
        
        <tr>
        	<td>Total Position</td>
            <td></td>
            <td><?=count($position)?></td>
        </tr>
        
        
        
         <tr>
        	<td>Total Credit</td>
            <td></td>
            <td><font style="font-weight:bold;">$<?=number_format($summary['credit'],2)?></font></td>
        </tr>
         <tr>
        	<td>Total Debit</td>
            <td></td>
             <td><font style="font-weight:bold;">$<?=number_format($summary['debit'],2)?></font></td>
        </tr>
         <tr>
        	<td>Balance</td>
            <td></td>
             <td><font style="font-weight:bold;color:#F00;">$<?=number_format($summary['balance'],2)?></font></td>
        </tr>
    </table>
     </div>
     
     
     <div class="span6">
     	<div class="primary-head">
      		<h3 class="page-header">Transaction</h3>
    	</div>
        <?php echo form_error('uid', '<p class="error">','</p>'); ?>
        <?php echo form_error('type', '<p class="error">','</p>'); ?>
        <?php echo form_error('amount', '<p class="error">','</p>'); ?>
        
        
        <?php if($this->session->flashdata('show_msg')!='') { ?>
        	<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
			</div>
        <?php }?>
        
        <form method="post" action="<?=MATRIX_BASE?>ad_account/transaction" id="frm_tra">
        <input type="hidden" id="balance" value="<?=$summary['balance']?>" />
        <input type="hidden" name="uid" value="<?=$result[0]['usercode']?>" />
     	<table class="table table-striped table-bordered dataTable">
        <tr>
        	<td>Currect Balance</td>
            <td></td>
            <td>
            	<input type="text" value="<?=number_format($summary['balance'],2)?>" readonly="readonly" />
            </td>
        </tr>
     	<tr>
        	<td>Transaction</td>
            <td></td>
            <td>
            	<select id="type" name="type" required="required">
                    <option value="credit">Credit</option>	
                    <option value="debit">Debit</option>	
                </select>
            </td>
        </tr>
        
        <tr class="position_tr">
        	<td>Position</td>
            <td></td>
            <td>
            	<select id="position_code" name="position_code">
                    <?php for($i=0;$i<count($position);$i++){
							$pos=$i+1;
							echo '<option value="'.$position[$i]['idcode'].'">Position-'.$pos.'</option>';
					}?>
                </select>
                
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
     </div>
	
</div>


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head"><h3 class="page-header">Position Detail</h3></div>
 
  
  <table class="table table-striped table-bordered dataTable" id="data-table">
      <thead>
        <tr>
 
          <th width="15%">Postion</th>
          <th width="15%">Date</th>
          <th width="15%">Credit</th>
        
        </tr>
      </thead>
    <tbody>
    	 <?php for($i=0;$i<count($position);$i++){	
			$row=$i+1;
			echo '<tr>
          			<td>Postion-'.$row.'</td>
          			<td>'.date('M d, Y',strtotime($position[$i]['create_dt'])).'</td>
					<td>$'.number_format($position[$i]['credit'],2).'</td>
          			
        		 </tr>';
         } ?>
   	</tbody>   
  </table>
   </div>
</div>  
    


<div class="row-fluid ">
  <div class="span6">
    <div class="primary-head">
      <h3 class="page-header">Credit</h3>
    </div>
    
    <table class="table table-striped table-bordered dataTable" id="data-table">
      <thead>
        <tr>
          <th width="10%">Id</th>
          <th width="15%">Amount</th>
          <th width="15%">Date</th>
          <th width="15%">Position</th>
          <th width="40%">description</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($credit);$i++){	
			$row=$i+1;
			$pos=in_multiarray($credit[$i]['position_code'],$position,'idcode'); 
			echo '<tr>
          			<td>'.$row.'</td>
          			<td>$'.$credit[$i]['amount'].'</td>
          			<td>'.date('M d, Y',strtotime($credit[$i]['time_dt'])).'</td>
					<td>Position -'.$pos.'</td>
          			<td>'.$credit[$i]['description'].'</td>
        		 </tr>';
         } ?>
      </tbody>
    </table>
  </div>
  <div class="span6">
    <div class="primary-head">
      <h3 class="page-header">Debit</h3>
    </div>
    <table class="table table-striped table-bordered dataTable" id="data-table">
      <thead>
        <tr>
          <th width="10%">Id</th>
          <th width="15%">Amount</th>
          <th width="15%">Date</th>
        
          <th width="40%">description</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($debit);$i++){	
			$row=$i+1;
		
        echo '<tr>
          		<td>'.$row.'</td>
          		<td>$'.$debit[$i]['amount'].'</td>
          		<td>'.date('M d, Y',strtotime($debit[$i]['time_dt'])).'</td>
          		<td>'.$debit[$i]['description'].'</td>
        	</tr>';
         } ?>
      </tbody>
    </table>
  </div>
</div>
<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
	#description{
		resize:none;
		width:90%;
		height:100px;
	}
	.back_btn{
		font-family: Arial,Helvetica,sans-serif;
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
