<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Dreem Student Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=base_url()?>index.php/dreem_student/join_request/under_process" class="brown"><p><?=$under_process?></p><span>Under Process</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/member/member_list" class="blue-violate"><p><?=$get_member?></p><span>Your Referral</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/member/gift_earned" class="magenta"><i class="icon-gift"></i><span>Donation</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/payment_option" class="dark-yellow"><i class="icon-money"></i><span>Receiving Option</span></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=base_url()?>index.php/dreem_student/member/capture_page" class="brown"><i class="icon-align-justify"></i><span>Capture Page</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/page/page_view/webinar" class="cls-color-6"><i class="icon-star"></i><span>Webinar</span></a></li>
        <li><a href="<?=base_url()?>index.php/dreem_student/page/page_view/ph_gh" class="cls-color-7"><i class="icon-th-large"></i><span>PH-GH</span></a></li>
       
      </ul>
    </div>
  </div>
</div>


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Sent Donation</h3>
    </div>
      <table class="table table-striped table-bordered">
    	<tr>
        	<td width="19%">Sent Donation</td>
            <td width="1%"></td>
            <td width="80%"><?=$detail[0]['pay_name']?></td>
        </tr>
        <tr>
        	<td>You Are Downline Of</td>
            <td></td>
            <td><?=$detail[0]['upling_name']?></td>
        </tr>
    </table>
    
     <div class="primary-head">
      <h3 class="page-header">Sent Donation Detail</h3>
    </div>
      <table class="table table-striped table-bordered">
      	<thead>
            <tr>
	            <th>Sr</th>
    	        <th>Subject</th>
        	    <th>Payment Detail</th>
            </tr>
        </thead>
    	<tbody>
        	<?php for($i=0;$i<count($send_payment_list);$i++){ 
				$row=$i+1;
			?>
            	<tr>
	            	<td><?=$row?></td>
    	        	<td><?=$send_payment_list[$i]['subject']?></td>
        	    	<td><?=$send_payment_list[$i]['textdt']?></td>
            	</tr>
            <?php } ?>
        </tbody>
        
    </table>
    
  </div>
</div>



<style>
	.switch_item_custom li{
		width:180px;
		height:100px;
	}
	.switch_item_custom li a{
		width:180px;
		height:100px;
	}
	.switch_item_custom li p{
		font-size:20px !important;
		font-weight:bold;
		padding-top:20px;
		color:#FFF;
	}
	.switch_item_custom li a span {
		font-weight:bold;
		font-size:14px !important;
	}
	
	
</style>
