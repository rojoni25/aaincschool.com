<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<link href="<?=base_url();?>asset/tooltip/tooltip.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/tooltip/tooltip.js"></script>
<link href="<?=base_url();?>asset/tree/treecss.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>	


<script>
	$(document).on('click', '.withdrawal_history', function (e) {
			e.preventDefault();
			$('.withdrawal_div').show(500);
			$('.monthly_earning_div').hide(500);
			$('.main-div').html('');
		});	
		
		$(document).on('click', '.payment_earning', function (e) {
			e.preventDefault();
			$('.withdrawal_div').hide(500);
			$('.monthly_earning_div').show(500);
			$('.main-div').html('');
		});
		
		////for submit///
		$(document).on('submit', '#frm_sub', function (e) {
				e.preventDefault();
				var form = $(this);
				var post_url = form.attr('action');
				$.ajax({
					type: 'post',url: post_url,data: $(this).serialize(),
					success: function (result) {							
						$('.main-div').html(result);	
					}
				});
			});
               ////for submit///
		
</script> 


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">VMA Financial Report
      	<div class="pull-right">
        	<a href="<?=vma_base()?>dashboard/view"><button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button></a>
        </div>
      </h3>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>

<?=$this->load->view('vma/top_banner')?>

   
<div class="row-fluid">
   <div class="span12">
   		
   		<?php
   		$date 		= date('01-m-Y',strtotime($result[0]['timedt']));
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
  	</div>
 </div>  
 <div class="row-fluid">
  <div class="span4">
    <div class="widget-header-block">
      <h4 class="widget-header">Report Type</h4>
    </div>
    <!---widget-header-block----->
    <table class="table">
     
      <tr>
        <td><a href="#" class="payment_earning">Payment Earning</a></td>
        <td></td>
      </tr>
    </table>
  </div>
  <div class="span8">
    <div class="withdrawal_div" style="display:none;">
      <div class="widget-header-block">
        <h4 class="widget-header">Withdrawal Report</h4>
      </div>
      <!---widget-header-block----->
      <form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/withdrawal_report" method="post" id="frm_sub">
        <table class="table">
          <tr>
            <td width="20%">Select Month</td>
            <td width="1%">:</td>
            <td width="79%"><select name="month_name" id="month_name" class="clssel">
                <option value="all">All</option>
                <?php for($i=0;$i<count($month_list);$i++){?>
                <option value="<?=$month_list[$i]['month_value']?>">
                <?=$month_list[$i]['month_name']?>
                </option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Get Report" class="btn btn-success" /></td>
          </tr>
        </table>
      </form>
    </div>
    <div class="monthly_earning_div" style="display:none;">
      <div class="widget-header-block">
        <h4 class="widget-header">Monthly Earning Report</h4>
      </div>
      <!---widget-header-block----->
      <form action="<?=vma_base()?><?=$this->uri->rsegment(1)?>/earning_monthly" method="post" id="frm_sub">
        <table class="table">
         
          <tr>
            <td width="20%">Select Month</td>
            <td width="1%">:</td>
            <td width="79%"><select name="month_name" id="month_name" class="clssel">
                <option value="all">All</option>
                <?php for($i=0;$i<count($month_list);$i++){?>
                <option value="<?=$month_list[$i]['month_value']?>">
                <?=$month_list[$i]['month_name']?>
                </option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Get Report" class="btn btn-success" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
 
 <div class="row-fluid">
  <div class="span12">
  		<div class="main-div"></div>
  </div>
 </div> 




 
