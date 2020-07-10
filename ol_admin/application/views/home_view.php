

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul> <ul class="top-banner-free"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Home</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12" style="margin-bottom: 10px;">
    <?php
      $new_url=isset($_GET['type'])&&$_GET['type']=='free'?'paid':'free';
      $switch_label=$new_url=='free'?'Switch to free':'Switch to paid';
    ?>
    <a class="btn pull-right" href="<?php echo base_url().'index.php/home?type='.$new_url; ?>"><?php echo $switch_label; ?></a>
  </div>
</div>

<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets green">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-inbox"></i>Paid Member </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $tot_paid_member[0]['tot']?></span><span class="n-sources">Total Member</span> </div>
      <div class="board-widgets-botttom"> <a href="<?php echo base_url();?>index.php/user">Go to Member <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets magenta">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-user"></i> Free Member </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $tot_free_member[0]['tot']?></span><span class="n-sources">Total Upgrades</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Upgrades<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets blue-violate">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-comment"></i> Admin Fees </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $admin_fees[0]['setting_value']?></span><span class="n-sources">Admin Fees</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Fees<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets dark-yellow">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-file-alt"></i> Surplus Balance </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $surplus_balance[0]['total']==''?'0':$surplus_balance[0]['total']; ?></span><span class="n-sources">Surplus Balance</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Surplus Balance<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
</div>

<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets orange">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-inbox"></i> Request For Paid </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $tot_request_to_paid[0]['tot']?></span><span class="n-sources">Request For Paid</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Request <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets bondi-blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-user"></i> Inactive Members </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $tot_free_member[0]['tot']?></span><span class="n-sources">Inactive Members </span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Inactive Members<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets brown">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-comment"></i> Withdrawal Request </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $tot_withdrawal_request[0]['tot']?></span><span class="n-sources">Withdrawal Request</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Withdrawal Request<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-file-alt"></i> Setting </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"></span><span class="n-sources">Setting</span> </div>
      <div class="board-widgets-botttom"> <a href="#">Go to Setting<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
</div>

<div class="row-fluid">

  <div class="span4">
  
    <table class="table table-bordered">
     <tr>
      	<th colspan="3">Summary for Stream 3 x 3</th>
      </tr>
      <tr>
        <th>Level</th>
        <th>People</th>
        <th>NO. of Active Users</th>
      </tr>
      <?php 
	  	$total_people=0;
		$total_active=0;
	  	for($i=0;$i<count($level_summery3);$i++){
		  $level=$i+1;
		  $total_people=$total_people+$level_summery3[$i]['tot'];
		  $total_active=$total_active+$level_summery3[$i]['tot2'];
      		echo '<tr>
					<td>'.$level.'</td>
					<td>'.$level_summery3[$i]['tot'].'</td>
					<td>'.$level_summery3[$i]['tot2'].'</td>
				  </tr>';
         } ?>
         <tr>
         	<td><strong>Total</strong></td>
            <td><strong><?=$total_people?></strong></td>
            <td><strong><?=$total_active?></strong></td>
         </tr>
    </table>
  </div>
  <div class="span4">
  	<table class="table table-bordered">
      <tr>
      	<th colspan="3">Summary for Stream 5 x 3</th>
      </tr>	
      <tr>
        <th>Level</th>
        <th>People</th>
        <th>NO. of Active Users</th>
      </tr>
      <?php 
	  	$total_people=0;
		$total_active=0;
	  	for($i=0;$i<count($level_summery5);$i++){
		  $level=$i+1;
		  $total_people=$total_people+$level_summery5[$i]['tot'];
		  $total_active=$total_active+$level_summery5[$i]['tot2'];
      		echo '<tr>
					<td>'.$level.'</td>
					<td>'.$level_summery5[$i]['tot'].'</td>
					<td>'.$level_summery5[$i]['tot2'].'</td>
				  </tr>';
         } ?>
        <tr>
         	<td><strong>Total</strong></td>
            <td><strong><?=$total_people?></strong></td>
            <td><strong><?=$total_active?></strong></td>
         </tr>
      
    </table>
  </div>
  <div class="span4">
  	<table class="table table-bordered">
     <tr>
      	<th colspan="3">Summary for Stream 10 x 3</th>
      </tr>
      <tr>
        <th>Level</th>
        <th>People</th>
        <th>NO. of Active Users</th>
      </tr>
      <?php 
	  	$total_people=0;
		$total_active=0;
	  	for($i=0;$i<count($level_summery10);$i++){
		  $level=$i+1;
		  $total_people=$total_people+$level_summery10[$i]['tot'];
		  $total_active=$total_active+$level_summery10[$i]['tot2'];
      		echo '<tr>
					<td>'.$level.'</td>
					<td>'.$level_summery10[$i]['tot'].'</td>
					<td>'.$level_summery10[$i]['tot2'].'</td>
				  </tr>';
         } ?>
         <tr>
         	<td><strong>Total</strong></td>
            <td><strong><?=$total_people?></strong></td>
            <td><strong><?=$total_active?></strong></td>
         </tr>
      
    </table>
  </div>
</div>


<div class="row-fluid">
  <div class="span6">
  		<h3>Cronjob for daily </h3>
		  <p><a href="<?=base_url()?>index.php/cornjob_there_by_three/" target="_blank"><h5>Cronjob for 3 x 3</h5> </a></p>
      <p><a href="<?=base_url()?>index.php/cornjob_there_by_three_free/" target="_blank"><h5>Cronjob for 3 x 3 Free</h5> </a></p>
      <p><a href="<?=base_url()?>index.php/cornjob_five_by_three/" target="_blank"><h5>Cronjob for 5 x 3</h5></a></p>
      <p><a href="<?=base_url()?>index.php/cornjob_five_by_three_free/" target="_blank"><h5>Cronjob for 5 x 3 Free</h5></a></p>
      <p><a href="<?=base_url()?>index.php/cornjob_ten_by_three/" target="_blank"><h5>Cronjob for 10 x 3 </h5></a></p>
      <p><a href="<?=base_url()?>index.php/cornjob_ten_by_three_free/" target="_blank"><h5>Cronjob for 10 x 3 Free</h5></a></p>

  </div>
   <div class="span6">
      <h3>Reverse Cronjob for daily </h3>
      <p><a href="http://acquisitionallianceinc.com/test/index.php/rg/reg_cron" target="_blank"><h5>Add New 27 Member </h5></a></p>
      <p><a href="<?=base_url()?>index.php/cornjob_reverse_five_by_three_free/" target="_blank"><h5>Cronjob for 5 x 3 Free</h5></a></p>
       <p><a href="<?=base_url()?>index.php/cornjob_reverse_ten_by_three_free/" target="_blank"><h5>Cronjob for 10 x 3 Free</h5></a></p>
       <p><a href="<?=base_url()?>index.php/cornjob_reverse_five_by_three/" target="_blank"><h5>Cronjob for 5 x 3 Paid</h5></a></p>
       <p><a href="<?=base_url()?>index.php/cornjob_reverse_ten_by_three/" target="_blank"><h5>Cronjob for 10 x 3 Paid</h5></a></p>
  </div>
</div>  
