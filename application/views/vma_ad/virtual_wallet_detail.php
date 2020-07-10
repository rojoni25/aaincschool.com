<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
	
	<script>
    	$(document).ready(function(e) {
            $('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});
			
        });
    </script>
	<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Virtual Wallet Income 
          		<div class="pull-right">
            		<a href="<?=vma_ad()?>report/balance_sheet"><button class="btn btn-round-min btn-success" type="button"><span><i class="icon-th-list"></i></span></button></a>
                    <a href="<?=vma_ad()?>member/detail/<?=$result['usercode']?>"><button class="btn btn-round-min btn-warning" type="button"><span><i class=" icon-user"></i></span></button></a>
                </div>
            
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">VMA Virtual Wallet</li>
        </ul>
      </div>
    </div>
    
    
    <div class="row-fluid">
    <div class="span6">
      		<table class="table table-striped table-bordered">
            	<tr>
                	<td width="19%">Usercode</td>
                    <td width="1%">:</td>
                    <td width="80%"><?=$result['usercode']?></td>
                </tr>
                <tr>
                	<td>Name</td>
                    <td>:</td>
                    <td><?=$result['name']?></td>
                </tr>
                <tr>
                	<td>Username</td>
                    <td>:</td>
                    <td><?=$result['username']?></td>
                </tr>
                
            </table>	
      </div>
      <div class="span6">
      		<table class="table table-striped table-bordered">
            	<tr>
                	<td width="19%">Total Income</td>
                    <td width="1%">:</td>
                    <td width="80%"><a href="<?=vma_ad()?>report/virtual_wallet/<?=$result['usercode']?>">$<?=number_format($payment['in'],2)?></a></td>
                </tr>
                <tr>
                	<td>Total Payment</td>
                    <td>:</td>
                    <td><a href="<?=vma_ad()?>report/virtual_wallet_user_detail/<?=$result['usercode']?>">$<?=number_format($payment['out'],2)?></a></td>
                </tr>
                <tr>
                	<td>Total Balance</td>
                    <td>:</td>
                    <td>$<?=number_format($payment['balance'],2)?></td>
                </tr>
                
                <tr>
                	<td colspan="3">
                    	<a href="<?=vma_ad()?>member/detail/<?=$result['usercode']?>"><span class="label label-success">Member Profile</span></a> &nbsp;&nbsp;
                        
                   </td>
                    
                </tr>
                
                
            </table>	
      </div>
    </div>  
    
    <div class="row-fluid">
      <div class="span12">
      	 <h3 class="page-header">Virtual Income</h3>
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
            	<th>Sr.No</th>
            	<th>Usercode</th>
              	<th>Name</th>
                <th>Amount</th>
             	<th>Level</th>
                <th>Date</th>
            </tr>
          </thead>
          <tbody>
          		<?php for($i=0;$i<count($wallet_income);$i++){
					$row=$i+1;
				?>
                    <tr>
                        <th><?=$row?></th>
                        <th><?=$wallet_income[$i]['by_user']?></th>
                        <th><?=$wallet_income[$i]['name']?></th>
                        <th><?=$wallet_income[$i]['amount']?></th>
                        <th><?=$wallet_income[$i]['level']?></th>
                         <th><?=date('d-m-Y',strtotime($wallet_income[$i]['datedt']))?></th>
                    </tr>
                <?php } ?>
           </tbody>
        </table>
      </div>
      
      
    </div>

