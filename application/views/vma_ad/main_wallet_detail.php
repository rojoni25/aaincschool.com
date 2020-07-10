 <script>
    	$(document).on('change','#month_name',function(e){
			var date=$('#month_name').val();
			var url='<?=vma_ad()?><?=$this->uri->rsegment(1)?>/get_income_report/<?=$eid?>/'+date;
			$.ajax({url:url,
				beforeSend: function(){
   				},
   				complete: function(){
   				},
				success:function(result){
					$('.income-inner').html(result);
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
			
		});
		
		//
		
		$(document).on('click','.date_detail_view',function(e){
			e.preventDefault();
			
			var val =	$(this).attr('href');
			var url	=	'<?=vma_ad()?><?=$this->uri->rsegment(1)?>/income_report_datewise/<?=$eid?>/'+val;
			
			$.ajax({url:url,
				beforeSend: function(){
   				},
   				complete: function(){
   				},
				success:function(result){
					var data=$.parseJSON(result);
					$('.payment_detail_dt_html').html(data['html']);
					$('.payment_detail_dt_title').html(data['title']);
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
			
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
      <h3 class="page-header">VMA Member Main Wallet
      			<div class="pull-right">
            		<a href="<?=vma_ad()?>report/balance_sheet"><button class="btn btn-round-min btn-success" type="button"><span><i class="icon-th-list"></i></span></button></a>
                    <a href="<?=vma_ad()?>member/detail/<?=$result['usercode']?>"><button class="btn btn-round-min btn-warning" type="button"><span><i class="icon-eye-open"></i></span></button></a>
                </div>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">VMA Main Wallet</li>
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
        <td width="80%">$
          <?=number_format($payment['in'],2)?></td>
      </tr>
      <tr>
        <td>Total Payment</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['out'],2)?></td>
      </tr>
      <tr>
        <td>Total Balance</td>
        <td>:</td>
        <td>$
          <?=number_format($payment['balance'],2)?></td>
      </tr>
    </table>
  </div>
</div>

<?php
	$date 		= date('01-m-Y',$time[0]['timedt']);
	$end_date 	= date('t-m-Y',time());
	$dt_show=date('F Y', strtotime($date));
	
	while (strtotime($date) <= strtotime($end_date)) {
		
		$month_list[]=array(
			'month_name' => $dt_show,
			'month_value' => $date
		);	
		
		$date = date ("d-m-Y", strtotime("+1 month", strtotime($date)));
		$dt_show=date('F Y', strtotime($date));
	}
	
?>

<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Income</h3>
    <table class="table table-striped table-bordered" id="data-table">
     	<tr>
            <td width="20%">Select Month</td>
            <td width="1%">:</td>
            <td width="79%">
              
              <select name="month_name" id="month_name" class="clssel">
                <option value="">Select</option>
                <option value="all">All</option>
                <?php for($i=0;$i<count($month_list);$i++){
						$sel=($month_list[$i]['month_value']==$sel_date) ? "selected='selected'" : "";
					?>
                	<option <?=$sel?> value="<?=$month_list[$i]['month_value']?>"><?=$month_list[$i]['month_name']?></option>
                <?php } ?>
              </select></td>
          </tr>
          
    </table>
  </div>
  
</div>

<div class="row-fluid">
  <div class="span6">
    <h3 class="page-header">Income</h3>
    <div class="income-inner">
    	<?=$html?>
    </div>
  </div>
  <div class="span6">
    <h3 class="page-header">Income Detail <span class="payment_detail_dt_title"></span></h3>
    	<div class="payment_detail_dt_html"></div>
  </div>
</div>
