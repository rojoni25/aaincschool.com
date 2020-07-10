
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
       Transaction <?=$title?> Report
        <span class="pull-right">
        	<a href="<?=MATRIX_BASE?>ad_dashboard/dashboard" class="back_btn"><span class="label label-success">Dashboard</span></a>
        </span>	
        </h3>
        
        
        
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">
        <?=MATRIX_LLB?>
        </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Transaction Report</li>
    </ul>
  </div>
</div>

<div class="row-fluid">

     	<table class="table table-striped table-bordered dataTable">
         <tr>
        	<td width="24%">Total Credit</td>
            <td width="1%"></td>
            <td width="75%"><font style="font-weight:bold;">$<?=number_format($summary['credit'],2)?></font></td>
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

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=$title?> Report</h3>
    </div>
    <table class="table table-striped table-bordered dataTable" id="data-table">
      <thead>
        <tr>
          <th width="10%">Id</th>
          <th width="10%">Usercode</th>
          <th width="10%">Name</th>
          <th width="15%">Amount</th>
          <th width="15%">Date</th>
          <th width="40%">description</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++){	
			$row=$i+1;
		?>
        <tr>
            <td><?=$row?></td>
            <td><?=$result[$i]['usercode']?></td>
            <td><?=$result[$i]['name']?></td>
            <td>$<?=$result[$i]['amount']?></td>
            <td><?=date('M d, Y  i:j',strtotime($result[$i]['time_dt']))?></td>
            <td><?=$result[$i]['description']?></td>
        </tr>
        <?php } ?>
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
</style>
