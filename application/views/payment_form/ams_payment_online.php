
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="<?php echo base_url();?>asset/js/jquery.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<script>
	$(document).ready(function(e) {
       $('#frm').submit();	
    });
</script>
<body>
    <form method='post' action='<?php echo $option['url']; ?>' id="frm" >
        <input type='HIDDEN' name='x_login' value='<?php echo $option['loginID']; ?>' />
        <input type='HIDDEN' name='x_amount' value='<?php echo $amount; ?>' />    
        <input type='HIDDEN' name='x_invoice_num' value='<?php echo $invoice; ?>' />
        <input type='HIDDEN' name='x_cust_id' value='<?php echo $this->session->userdata['logged_ol_member']['usercode']; ?>' />
        <input type="HIDDEN" name="x_first_name" value="<?=$result[0]['fname']?>">
        <input type="HIDDEN" name="x_last_name" value="<?=$result[0]['lname']?>">
        <input type='HIDDEN' name='x_fp_sequence' value='<?php echo $sequence; ?>' />
        <input type='HIDDEN' name='x_fp_timestamp' value='<?php echo $timeStamp; ?>' />
        <input type='HIDDEN' name='x_fp_hash' value='<?php echo $fingerprint; ?>' />
        <input type='HIDDEN' name='x_test_request' value='<?php echo $option['testMode']; ?>' />
        <input type='HIDDEN' name='x_show_form' value='PAYMENT_FORM' />
        <input type='HIDDEN' name='x_cancel_url' value='<?php echo $option['url_cancel']?>'/> 
        <input type="HIDDEN" name="x_cancel_url _text" value="Back to Oportunity Launch">        
        <INPUT type="HIDDEN" NAME="x_relay_response" VALUE="TRUE">
        <INPUT type="HIDDEN" NAME="x_relay_url" VALUE="<?php echo $option['url_succes']?>">
    </form>
    
    
    
</body>
</html>