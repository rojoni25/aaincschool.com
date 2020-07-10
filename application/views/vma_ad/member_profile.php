
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">VMA Member
      	<div class="pull-right">
        	<a href="<?=vma_ad()?>tree/view/<?=$member['usercode']?>"><button class="btn btn-round-min btn-danger"><span><i class="icon-group"></i></span></button></a>
        </div>
      </h3>
    </div>
    
    <ul class="breadcrumb">
      <?php 
	  for($i=0;$i<count($upling_chain);$i++){
		  
			if($i<count($upling_chain)-1){
				echo '<li><a href="'.vma_ad().''.$this->uri->rsegment(1).'/detail/'.$upling_chain[$i]['usercode'].'">'.$upling_chain[$i]['name'].'</a> <i class="icon-angle-right"></i>';		
			}
			else{
				echo '<li>'.$upling_chain[$i]['name'].'';		
			}
			
	   } ?>
    </ul>
    
  </div>
</div>
<div class="row-fluid">
  <div class="span6">
    <table class="table">
      <tr>
        <td>Usercode</td>
        <td>:</td>
        <td><?=$member['usercode']?></td>
      </tr>
      <tr>
        <td>Useranme</td>
        <td>:</td>
        <td><?=$member['username']?></td>
      </tr>
      <tr>
        <td>Name</td>
        <td>:</td>
        <td><?=$member['name']?></td>
      </tr>
      <tr>
        <td>Emailid</td>
        <td>:</td>
        <td><?=$member['emailid']?></td>
      </tr>
      <tr>
        <td>Join Date</td>
        <td>:</td>
        <td><?=date('d-m-Y',strtotime($member['timedt']))?></td>
      </tr>
      
      <tr>
        <td>Due Date</td>
        <td>:</td>
        <td><?=date('d-m-Y',$member['due_time'])?></td>
      </tr>
      
      <tr>
        <td>Payment</td>
        <td>:</td>
        <td><?php if(time()< $member['due_time']){
				echo '<span class="font-1">Active</span>';
			}else{
				echo '<span class="font-2">Due</span>';
			}?></td>
      </tr>
      
      <?php
      		if($this->vma_class->check_unqulified($member['usercode'])){
				$st='Qulified';
			}else{
				$st='Unqulified';
			}
	  ?>
      <tr>
        <td>Status</td>
        <td>:</td>
        <td><strong><?=$st?></strong></td>
      </tr>
      <?php
	  		$count_unilevel		=	$this->vma_class->get_count_unilevel($member['usercode']);
			$active_unilevel	=	$this->vma_class->get_count_unilevel_active($member['usercode']);
			
			if($this->vma_class->manully_qulified($member['usercode'])){
				$manully = 'Yes';
				$manully.= '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.vma_ad().$this->uri->rsegment(1).'/unqulified/'.$member['usercode'].'">Unqulified</a>';
			}else{
				$manully='No';
				$manully.= '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.vma_ad().$this->uri->rsegment(1).'/qulified/'.$member['usercode'].'">Qulified</a>';
			}
      	
		
	  ?>
       <tr>
        <td>Unilevel Total</td>
        <td>:</td>
        <td><strong><?=$count_unilevel?></strong></td>
      </tr>
       <tr>
        <td>Unilevel Qulified</td>
        <td>:</td>
        <td><strong><?=$active_unilevel?></strong></td>
      </tr>
      
      <tr>
        <td>Manully Qulified</td>
        <td>:</td>
        <td><?=$manully?></td>
      </tr>
       
       
      
    </table>
  </div>
  <div class="span6">
    <table class="table">
      <tr>
        <td width="19%">Level-One Member</td>
        <td width="1%"></td>
        <td width="80%"><?=$this->vma_class->count_member_on_level1($member['usercode'])?></td>
      </tr>
      <tr>
        <td>Level-Two Member</td>
        <td></td>
        <td><?=$this->vma_class->count_member_on_level2($member['usercode'])?></td>
      </tr>
      <tr>
        <td>Level-Three Member</td>
        <td></td>
        <td><?=$this->vma_class->count_member_on_level3($member['usercode'])?></td>
      </tr>
      <tr>
        <td>Level-Four Member</td>
        <td></td>
        <td><?=$this->vma_class->count_member_on_level4($member['usercode'])?></td>
      </tr>
      
      
     
      
    </table>
  </div>
</div>

<div class="row-fluid">
	 <div class="span6">
	 <h3 class="page-header">virtual wallet</h3>
	<table class="table">
      
          <tr>
            <td width="24%">Virtual Income</td>
            <td width="1%">:</td>
            <td width="75%"><a href="<?=vma_ad()?>report/virtual_wallet/<?=$member['usercode']?>">$<?=$member_balance[0]['virtual_in']?></a></td>
          </tr>
          
          <tr>
            <td>Virtual Payment</td>
            <td>:</td>
            <td><a href="<?=vma_ad()?>report/virtual_wallet_user_detail/<?=$member['usercode']?>">$<?=$member_balance[0]['virtual_out']?></a></td>
          </tr>
          
          <tr>
            <td>Virtual Balance</td>
            <td>:</td>
             <td><font class="font-2">$<?=$member_balance[0]['virtual_balance']?></font></td>
          </tr>
          
          <tr>
            <td></td>
            <td></td>
           <td><a href="<?=vma_ad()?>report/virtual_wallet/<?=$member['usercode']?>">Virtual Account</a></td>
          </tr>
      
     </table> 
     </div>
     
     <div class="span6">
	 <h3 class="page-header">Main Wallet</h3>
   
	<table class="table">
      
          <tr>
            <td width="24%">Income</td>
            <td width="1%">:</td>
            <td width="75%"><font class="font-2">$<?=$member_balance[0]['main_in']?></font></td>
          </tr>
          
          <tr>
            <td>Withdrawal </td>
            <td>:</td>
            <td><font class="font-2">$<?=$member_balance[0]['main_out']?></font></td>
          </tr>
          
          <tr>
            <td>Balance</td>
            <td>:</td>
             <td><font class="font-2">$<?=$member_balance[0]['main_balance']?></font></td>
          </tr>
          
          <tr>
            <td></td>
            <td></td>
           <td><a href="<?=vma_ad()?>report/main_wallet/<?=$member['usercode']?>">Main Account</a></td>
          </tr>
      
     </table> 
     </div>
     
</div>


<div class="row-fluid">
	 <h3 class="page-header">Payment Detail</h3>
	<table class="table">
      <tr>
        <td width="20%">Sr</td>
        <td width="20%">Amount</td>
        <td width="80%">date</td>
      </tr>
      <?php
      	for($i=0;$i<count($payment);$i++){
			$row=$i+1;	
			echo '<tr>
				<td width="20%">'.$row.'</td>
				<td width="20%">'.$payment[$i]['amount'].'</td>
				<td width="80%">'.date('d-m-Y',$payment[$i]['time_dt']).'</td>
			</tr>';
		}
	  ?>
     </table> 
</div>
<style>
	.font-1{
		font-weight:bold;
		font-style:italic;
	}
	.font-2{
		font-weight:bold;
		font-style:italic;
		color:#666;
	}
</style>



