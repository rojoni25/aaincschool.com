<?php
	if($this->uri->segment(4)=='3by3'){
		$title='3 x 3 Payment Details';
	}
	else if($this->uri->segment(4)=='5by3'){
		$title='5 x 3 Payment Details';
	}
	else if($this->uri->segment(4)=='10by3'){
		$title='10 x 3 Payment Details';
	}
	 
?>

<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	

$(document).ready(function(e) {
    $(document).on('change','#report_type',function(e){
		var value=$(this).val();
		window.location.href='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/view/'+value;
	});

});
</script>

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">
          		<?=$title?>
          </h3>
         
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Virtual Balance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Virtual Balance Details</li>
        </ul>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span6">
      		<div class="page-header">Member Details</div>
      		<table class="table">
            	<tr>
                	<td width="29%">Usercode</td>
                    <td width="1%">:</td>
                    <td width="70%"><?=$member_dt[0]['usercode']?></td>
                </tr>
               <tr>
                	<td width="29%">Username</td>
                    <td width="1%">:</td>
                    <td width="70%"><?=$member_dt[0]['username']?></td>
                </tr>
               <tr>
                	<td width="29%">Name</td>
                    <td width="1%">:</td>
                    <td width="70%"><?=$member_dt[0]['fname']?> <?=$member_dt[0]['lname']?></td>
                </tr>
                 <tr>
                	<td width="29%">Level One</td>
                    <td width="1%">:</td>
                    <td width="70%"><?=$upling['level1']?></td>
                </tr>
                 <tr>
                	<td width="29%">Level Two</td>
                    <td width="1%">:</td>
                    <td width="70%"><?=$upling['level2']?></td>
                </tr>
                 <tr>
                	<td width="29%">Level Three</td>
                    <td width="1%">:</td>
                    <td width="70%"><?=$upling['level3']?></td>
                </tr>
            </table>
      </div>
      <div class="span6">
      		<div class="page-header">Payment Details</div>
      		<table class="table">
            	<tr>
                	<td width="29%">Total Inning Balance</td>
                    <td width="1%">:</td>
                    <td width="70%">$<?=number_format($inning_sum,2)?></td>
                </tr>
                <tr>
                	<td>Total Daily Paid</td>
                    <td>:</td>
                    <td>$<?=number_format($daily_payment_sum,2)?></td>
                </tr>
                <tr>
                	<td>Balance</td>
                    <td>:</td>
                    <td>$<?=number_format($balance,2)?></td>
                </tr>
            </table>
      </div>
    </div>  
    
    <div class="row-fluid">
    <?php /*?>  <div class="span6">
      		<div class="page-header">Inning Balance</div>
            <table class="table table-striped table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>By User</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($inning);$i++){?>
                	<tr>
                    	<th><?=date('d-m-Y',strtotime($inning[$i]['timedt']))?></th>
                        <th><?=$inning[$i]['fname']?> <?=$inning[$i]['lname']?> ( <?=$inning[$i]['ref_code']?> )</th>
                        <th>$<?=$inning[$i]['amount']?></th>	
                    </tr>
                <?php } ?>
                </tbody>
            </table>
      </div><!---span6---><?php */?>
      <div class="span12">
      		<div class="page-header">Daily Payment</div>
      		<table class="table table-striped table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Aamout</th>
                    </tr>
                </thead>
                <tbody>
                 <?php for($i=0;$i<count($daily_payment);$i++){?>
                	<tr>
                    	<th><?=date('d-m-Y',$daily_payment[$i]['time_stm'])?></th>
                        <th>$<?=$daily_payment[$i]['amount']?></th>	
                    </tr>
                <?php } ?>
                </tbody>
            </table>
      </div><!---span6--->
    </div>  
   
  
   

<style>
	#report_type{
		width:250px;
		height:27px;
		border:#666 solid 1px;
		font-weight:bold;
	}
	#report_type option{
		padding:2px 2px;
	}
</style>
