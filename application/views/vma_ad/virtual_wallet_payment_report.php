
    
    
    
	<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Virtual Payment Report</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Virtual Payment Report</li>
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
       <h3 class="page-header">Virtual Payment</h3>
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
                <th>SRno.</th>
                <th>Usercode</th>
                <th>Name</th>
                <th>Date</th>
                <th>Level-1</th>  
                <th>Level-2</th>  
                <th>Level-3</th>   
            </tr>
          </thead>
          <tbody>
         		<?=$html?>
           </tbody>
        </table>
      </div>
    </div>

