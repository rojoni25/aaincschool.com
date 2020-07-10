<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(document).ready(function(e) {
		/////////////////
		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate',
                        minLength:1,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#user_code').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////	
	   
	   	$(document).on('click', '#btn_find', function (e) {
			var value=$('#user_code').val();
			var url='<?=diamond_base()?><?=$this->uri->rsegment(1)?>/transaction/'+value;
			window.location.href=url;
		});
		
		$(document).on('submit', '#frm', function (e) {
			var amount	=	$('#amount').val();
			if(amount==''){
				return false;
			}
			var Vamount=parseFloat(amount);
			
			if(Vamount < 1 ){
				$('#amount').focus();
				return false;
			}
			
		});
		
	});
	
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Diamond Transaction
      	<div class="pull-right">
        	<a href="<?=diamond_base()?>diamond_wallet/view"><button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button></a>
        </div>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Diamond</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Transaction</li>
    </ul>
  </div>
</div>


<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
    </div>
<?php } ?>

<div class="row-fluid">
  <div class="span12">
  	
    
    
    <?php if(!isset($payment)) { ?>
    	<table class="table">
    		<tr>
                <td width="19%">Search Member</td>
                <td width="1%"></td>
                <td width="80%">
                    <input type="text" id="membername" value="" placeholder="Member Name, Code" class=" span12 {validate:{required:true}}" />
                    <input type="hidden" id="user_code" name="user_code" />
                </td>
        	</tr>
        <tr>
        	<td></td>
            <td></td>
            <td>
            	<button type="button" id="btn_find" class="btn btn-primary btnsubmit">Check</button>
            </td>
        </tr>
    </table>
  <?php }else { ?>
  		<form action="<?=diamond_base()?><?=$this->uri->rsegment(1)?>/insert/" method="post" id="frm">
        	<input type="hidden" name="usercode"  value="<?=$result[0]['usercode']?>" />
            <table class="table">
                <tr>
                    <td width="19%">Member Name</td>
                    <td width="1%"></td>
                    <td width="80%"><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
                </tr>
                <tr>
                    <td>Usercode</td>
                    <td></td>
                    <td><?=$result[0]['usercode']?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td></td>
                    <td><?=$result[0]['username']?></td>
                </tr>
                
                <tr>
                    <td>Email Id</td>
                    <td></td>
                    <td><?=$result[0]['emailid']?></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td></td>
                    <td><strong>$<?=number_format($payment['balance'],2)?></strong></td>
                </tr>
                
                <tr>
                    <td>Transaction</td>
                    <td></td>
                    <td>
                        <select id="transaction" name="transaction" class="">
                            <option value="credit">Credit</option>
                            <?php if($payment['balance']>0) { ?>
                                <option value="debit">Debit</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td></td>
                    <td><input type="number" name="amount" id="amount" placeholder="Enter Amount" required="required"></td>
                </tr>
                <tr>
                    <td>Remark</td>
                    <td></td>
                    <td>
                        <textarea id="txtdt" name="txtdt" placeholder="Remark" style="resize:none;"></textarea>
                    </td>
                </tr>
                 <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit"  class="btn btn-primary btnsubmit">Submit</button>
                </td>
            </tr>
               </table> 
        </form>    
  <?php } ?>
    
  </div>
</div>




 <?php if(isset($payment)) { ?>
	<div class="row-fluid">
  		<div class="span6">
  		<h3 class="page-header">Payment Report</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Sr.No</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody>
        <?php  for($i=0;$i<count($payment_list);$i++){
						$row_num=$i+1;
					echo '<tr>
							<td>'.$row_num.'</td>
							<td>'.date('d-m-Y',strtotime($payment_list[$i]['timedt'])).'</td>
							<td>'.$payment_list[$i]['amount'].'</td>
							<td>'.$payment_list[$i]['txtdt'].'</td>
		                </tr>';
				} ?>
      </tbody>
    </table>
  </div>
  
	 	<div class="span6">
  		<h3 class="page-header">Withdrawal Report</h3>
    <table class="table">
      <thead>
        <tr>
          <th width="10%">Sr.No</th>
          <th width="20%">Date</th>
          <th width="30%">Amount</th>
          <th width="50%">Remark</th>
        </tr>
      </thead>
      <tbody>
        <?php  for($i=0;$i<count($withdrawal_list);$i++){
						$row_num=$i+1;
					echo '<tr>
							<td>'.$row_num.'</td>
							<td>'.date('d-m-Y',strtotime($withdrawal_list[$i]['date_dt'])).'</td>
							<td>'.$withdrawal_list[$i]['amount'].'</td>
							<td>'.$withdrawal_list[$i]['text_dt'].'</td>
		                </tr>';
				} ?>
      </tbody>
    </table>
  </div>
	</div>  
<?php } ?>


