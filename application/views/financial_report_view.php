<script>
	$(document).ready(function(e) {
		$(document).on('click', '.payment_history', function (e) {
			e.preventDefault();
			$('.withdrawal_div').hide(500);
			$('.monthly_earning_div').hide(500);
			$('.main-div').html('');
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/payment_report';
			$.ajax({url:url,success:function(result){	
				$('.main-div').html(result);	 	
            }});	
		});	
		
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
			$('form#frm_sub').on('submit', function (e) {
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
    });
</script>
<div class="row">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Finance</a> </li>
    <li class="active-bre"><a href="#"> Financial Report</a> </li>
  </ul>
</div> 
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Financial Report</h4>
    <br>


    <style>
    	.pp{
			overflow:hidden;
		}
    </style>
    <?php
     		$date 		= date('01-m-Y', $active_dt[0]['active_dt']);
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
    <div class="row">
      <div class="col-md-4">
        <div class="widget-header-block">
          <h4 class="widget-header">Report Type</h4>
        </div>
        <!---widget-header-block----->
        <table class="table">
          <tr>
            <td><a href="#" class="payment_history">Payment History</a></td>
            <td></td>
          </tr>
          <tr>
            <td><a href="#" class="withdrawal_history">Withdrawal History</a></td>
            <td></td>
          </tr>
          <tr>
            <td><a href="#" class="payment_earning">Payment Earning</a></td>
            <td></td>
          </tr>
        </table>
      </div>
      <div class="col-md-8">
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
          <form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/earning_monthly" method="post" id="frm_sub">
            <table class="table">
              <tr>
                <td width="20%">Report Type</td>
                <td width="1%">:</td>
                <td width="79%"><select name="daily_earning" id="daily_earning" class="clssel">
                    <option value="3by3">3 x 3</option>
                    <option value="5by3">5 x 3</option>
                    <option value="10by3">10 x 3</option>
                  </select></td>
              </tr>
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
    <div class="row">
      <div class="col-md-12 main-div"> </div>
    </div>
  </div>
</div>
    <style>
    	.clssel{
			width:250px;
			border:#666 solid 1px;
		}
    </style>
