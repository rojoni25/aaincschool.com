<script>
		
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Max Withdrawal
      	<a href="<?=base_url()?>index.php/payment_report_paid/list_view" class="pull-right">
        	<button class="btn btn-warning">Back</button>
        </a>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Max Withdrawal</li>
    </ul>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
  		<table class="table table-striped table-bordered">
            <tr>
            	<td width="24%">Max Withdrawal</td>
                <td width="1%">:</td>
                <td width="75%"><a href="#"><?=$amount['request_balance']?></a></td>
            </tr>
        </table>
  </div>	
</div> 


<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Member Name</th>
          <th>Username</th>
          <th>Total Balance</th>
          <th>Product Purchase</th>
          <th>Max Withdrawal</th>
        </tr>
      </thead>
      <tbody>
      	<?php for($i=0;$i<count($result);$i++){
				$max_withdrawal=(float)$result[$i]['main_balance']-CW_MIN;
				echo '<tr>
          				<td>'.$result[$i]['usercode'].'</td>
          				<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
          				<td>'.$result[$i]['username'].'</td>
          				<td>'.$result[$i]['main_balance'].'</td>
						<td>$'.CW_MIN.'.00</td>
          				<td><strong>'.number_format($max_withdrawal,2).'</strong></td>
        			</tr>';
		}?>
      </tbody>
    </table>
  </div>
</div>
