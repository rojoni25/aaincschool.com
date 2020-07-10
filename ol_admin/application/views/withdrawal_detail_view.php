
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Withdrawal Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Withdrawal Report</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span6">
    <table class="table table-striped table-bordered">
     	<tr><td>Usercode</td><td>:</td><td><?=$result[0]['usercode']?></td></tr>
        <tr><td>Member Name</td><td>:</td><td><?=$result[0]['fname']?> <?=$result[0]['lname']?></td></tr>
        <tr><td>Username</td><td>:</td><td><?=$result[0]['username']?></td></tr>
        <tr><td>Contatc No</td><td>:</td><td><?=$result[0]['mobileno']?>  /  <?=$result[0]['phone_no']?></td></tr>
        <tr><td>Email Id</td><td>:</td><td><?=$result[0]['emailid']?></td></tr>
        <tr><td><strong>Total Withdrawal</strong></td><td>:</td><td>$<?=$tot_withdrawal[0]['total']?></td></tr>
       
    </table>
  </div>
   <div class="span6" style="vertical-align:top;">
 	
    <table class="table table-striped table-bordered">
     		<tr>
    			<td>Id</td>
                <td>Amout</td>
                <td>Date</td>
                <td>Desc.</td>
        	</tr>  
            <?php for($i=0;$i<count($withdrawal_list);$i++){
				$newDate = date("d-m-Y", strtotime($withdrawal_list[$i]['create_date']));	
				echo'<tr>
    					<td>'.$withdrawal_list[$i]['withdrawal_code'].'</td>
                		<td>$'.$withdrawal_list[$i]['amount'].'</td>
                		<td>'.$newDate.'</td>
						<td>'.$withdrawal_list[$i]['description'].'</td>
        			</tr>';
			}?>
            <tr>
    			<td></td>
                <td>Total</td>
                <td><strong>$<?=$tot_withdrawal[0]['total']?></strong></td>
        	</tr>
    </table>
  </div>
  <div style="clear:both;overflow:hidden;"></div>
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