
<script>
	$(document).ready(function(e) {
		$(document).on('click', '.payment_history', function (e) {
			e.preventDefault();
			$('.withdrawal_div').hide(500);
			$('.monthly_earning_div').hide(500);
			$('.main-div').html('');
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/payment_report/<?=$result[0]['usercode']?>';
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
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Balance Report
      	<a href="<?=base_url()?>index.php/payment_report_paid/list_view" class="pull-right"><span class="label label-important">Back</span></a>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Balance Report</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered">
     	<tr><td>Usercode</td><td>:</td><td><?=$result[0]['usercode']?></td></tr>
        <tr><td>Member Name</td><td>:</td><td><?=$result[0]['fname']?> <?=$result[0]['lname']?></td></tr>
        <tr><td>Username</td><td>:</td><td><?=$result[0]['username']?></td></tr>
        <tr><td>Contatc No</td><td>:</td><td><?=$result[0]['mobileno']?>  /  <?=$result[0]['phone_no']?></td></tr>
        <tr><td>Email Id</td><td>:</td><td><?=$result[0]['emailid']?></td></tr>
         <tr><td></td><td>:</td><td><p style="text-transform:capitalize;"><?=convert_number_to_words($net_balance)?> dollar</p></td></tr>
    </table>
  </div>
  
  <div style="clear:both;overflow:hidden;"></div>
</div>


<div class="row-fluid">
  <div class="span6">
    <h4 class="widget-header">Personal Wallet</h4>
    <table class="table table-striped table-bordered">
    	<tr><td><strong>Refill</strong></td><td>:</td><td><strong>$<?=$pw_refill?></strong></td></tr>
        <tr><td><strong>CW To PW transfer</strong></td><td>:</td><td><strong>$<?=$cw_transfer?></strong></td></tr>
        <tr><td><strong>PW To CW transfer</strong></td><td>:</td><td><strong>$<?=$pw_transfer?></strong></td></tr>
        <tr><td><strong>PW transfer (<?=($pw_tot_transfer<0) ? "Minus" : "Plus";?>)</strong></td><td>:</td><td><strong>$<?=$pw_tot_transfer?></strong></td></tr>
        <tr><td>Current Balance</td><td>:</td><td>$<?=$master_sheet[0]['personal_wallet']?></td></tr>
    </table>
  </div>
   <div class="span6" style="vertical-align:top;">
    <h4 class="widget-header">Company Wallet</h4>
    <table class="table table-striped table-bordered">
     	<tr><td width="30%">Monthly Payment</td><td width="1%">:</td><td width="70%">$<?=$pay_monthly[0]['total']?></td></tr>
        <tr><td>Coded</td><td>:</td><td>$<?=$pay_c[0]['total']?></td></td></tr>
        <tr><td>Coded Match</td><td>:</td><td>$<?=$pay_cm[0]['total']?></td></tr>
        <tr><td>Residual</td><td>:</td><td>$<?=$pay_r[0]['total']?></td></td></tr>
        <tr><td>Residual Match</td><td>:</td><td>$<?=$pay_rm[0]['total']?></td></tr>
    	<tr><td>3 X 3 Daily</td><td>:</td><td>$<?=$daily_3[0]['total']?></td></tr>
        <tr><td>5 X 3 Daily</td><td>:</td><td>$<?=$daily_5[0]['total']?></td></tr>
        <tr><td>10 X 3 Daily</td><td>:</td><td>$<?=$daily_10[0]['total']?></td></tr>
        <tr><td>Refill Account</td><td>:</td><td>$<?=$pay_refill[0]['total']?></td></tr>
        <tr><td><strong>Total</strong></td><td>:</td><td><strong>$<?=$total_balance?></strong></td></tr>
        <tr><td><strong>CW To PW transfer</strong></td><td>:</td><td><strong>$<?=$cw_transfer?></strong></td></tr>
        <tr><td><strong>PW To CW transfer</strong></td><td>:</td><td><strong>$<?=$pw_transfer?></strong></td></tr>
        <tr><td><strong>PW transfer (<?=($cw_tot_transfer<0) ? "Minus" : "Plus";?>)</strong></td><td>:</td><td><strong>$<?=$cw_tot_transfer?></strong></td></tr>
        <tr><td><strong>Total Withdrawal</strong></td><td>:</td><td><strong><a href="<?=base_url()?>index.php/payment_report_paid/withdrawal_detail/<?=$result[0]['username']?>">$<?=$tot_withdrawal[0]['total']?></a></strong></td></tr>
        <tr><td><font class="font-txt">Current Balance</font></td><td>:</td><td><font class="font-txt">$<?=$master_sheet[0]['main_balance']?></font></td></tr>
        <tr><td></td><td></td><td><p style="text-transform:capitalize;"><?=convert_number_to_words($master_sheet[0]['main_balance'])?> dollar</p></td></tr>
    </table>
  </div>
  <div style="clear:both;overflow:hidden;"></div>
</div>

<?php
   		$date 		= date('01-m-Y', $result[0]['active_dt']);
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
  <div class="span4">
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
  <div class="span8">
    <div class="withdrawal_div" style="display:none;">
      <div class="widget-header-block">
        <h4 class="widget-header">Withdrawal Report</h4>
      </div>
      <!---widget-header-block----->
      <form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/withdrawal_report" method="post" id="frm_sub">
      	<input type="hidden" name="usercode" id="usercode" value="<?=$result[0]['usercode']?>" />
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
      	<input type="hidden" name="usercode" id="usercode" value="<?=$result[0]['usercode']?>" />
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
<div class="row-fluid">
  <div class="span12 main-div"> </div>
</div>

<style>
	.font-txt{
		font-weight:bold;
		color:#F00;
		font-size:14px;
	}
	
</style>

<?php
	
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

?>