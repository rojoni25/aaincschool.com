
<script>
	$(document).ready(function(e) {
        $('.llbcoded').html( $('#llbcoded').val());
		$('.llbcoded_match').html( $('#llbcoded_match').val());
		$('.llbresidual').html( $('#llbresidual').val());
		$('.llbresidual_match').html( $('#llbresidual_match').val());
    });
</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
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

<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets green">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-inbox"></i> My Case Wallet </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter">
        <?=$tot_member[0]['tot']?>
        </span><span class="n-sources">Case Wallet</span> </div>
      <div class="board-widgets-botttom"> <a href="<?php echo base_url();?>index.php/view_friends">My Total Case Balance <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets magenta">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-user"></i> 3 X 3 </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $payment[0]['3by3daily']; ?></span><span class="n-sources">3 X 3</span> </div>
      <div class="board-widgets-botttom"> <a href="#">3 X 3 Daily<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets blue-violate">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-comment"></i> 5 X 3 </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $payment[0]['5by3daily']; ?></span><span class="n-sources">5 X 3</span> </div>
      <div class="board-widgets-botttom"> <a href="#">5 X 3 Daily<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets dark-yellow">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-file-alt"></i> 10 X 3 </h4>
        <a href="#" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter"><?php echo $payment[0]['10by3daily']; ?></span><span class="n-sources">10 X 3</span> </div>
      <div class="board-widgets-botttom"> <a href="#">10 X 3 Daily<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
</div>

<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets orange">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-inbox"></i> Coded </h4>
        <a href="<?=base_url();?>index.php/coded_residual_details" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter llbcoded"></span><span class="n-sources">Coded</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url();?>index.php/coded_residual_details">Go to Coded<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets bondi-blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-user"></i> Matching Coded </h4>
        <a href="<?=base_url();?>index.php/coded_residual_details" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter llbcoded_match"></span><span class="n-sources">Matching Coded</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url();?>index.php/coded_residual_details">Go to Matching Coded<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets brown">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-comment"></i> Residual </h4>
        <a href="<?=base_url();?>index.php/coded_residual_details" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter llbresidual"></span><span class="n-sources">Residual</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url();?>index.php/coded_residual_details">Go to Residual<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class=" icon-file-alt"></i> Res-Match </h4>
        <a href="<?=base_url();?>index.php/coded_residual_details" class="widget-settings"><i class="icon-cog "></i></a> </div>
      <div class="board-widgets-content"> <span class="n-counter llbresidual_match"></span><span class="n-sources">Residual Match</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url();?>index.php/coded_residual_details">Go to Res-Match<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
</div>
<?php 		if($this->session->userdata['logged_ol_member']['usercode']!='1'){?>

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
      <tr>
        <th>Level-1</th>
        <th><?=$summary[0]['level_one3']?></th>
        <th><?=$summary[0]['active_level_one3']?></th>
      </tr>
      <tr>
        <th>Level-2</th>
        <th><?=$summary[0]['level_two3']?></th>
        <th><?=$summary[0]['active_level_two3']?></th>
      </tr>
      <tr>
        <th>Level-3</th>
        <th><?=$summary[0]['level_three3']?></th>
        <th><?=$summary[0]['active_level_three3']?></th>
      </tr>
      <tr>
        <th><strong>Total</strong></th>
        <th><?php echo $summary[0]['level_one3']+$summary[0]['level_two3']+$summary[0]['level_three3']; ?></th>
        <th><?php echo $summary[0]['active_level_one3']+$summary[0]['active_level_two3']+$summary[0]['active_level_three3']; ?></th>
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
       <tr>
        <th>Level-1</th>
        <th><?=$summary[0]['level_one5']?></th>
        <th><?=$summary[0]['active_level_one5']?></th>
      </tr>
      <tr>
        <th>Level-2</th>
        <th><?=$summary[0]['level_two5']?></th>
        <th><?=$summary[0]['active_level_two5']?></th>
      </tr>
      <tr>
        <th>Level-3</th>
        <th><?=$summary[0]['level_three5']?></th>
        <th><?=$summary[0]['active_level_three5']?></th>
      </tr>
      <tr>
        <th><strong>Total</strong></th>
        <th><?php echo $summary[0]['level_one5']+$summary[0]['level_two5']+$summary[0]['level_three5']; ?></th>
        <th><?php echo $summary[0]['active_level_one5']+$summary[0]['active_level_two5']+$summary[0]['active_level_three5']; ?></th>
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
       <tr>
        <th>Level-1</th>
        <th><?=$summary[0]['level_one10']?></th>
        <th><?=$summary[0]['active_level_one10']?></th>
      </tr>
      <tr>
        <th>Level-2</th>
        <th><?=$summary[0]['level_two10']?></th>
        <th><?=$summary[0]['active_level_two10']?></th>
      </tr>
      <tr>
        <th>Level-3</th>
        <th><?=$summary[0]['level_three10']?></th>
        <th><?=$summary[0]['active_level_three10']?></th>
      </tr>
       <tr>
        <th><strong>Total</strong></th>
        <th><?php echo $summary[0]['level_one10']+$summary[0]['level_two10']+$summary[0]['level_three10']; ?></th>
        <th><?php echo $summary[0]['active_level_one10']+$summary[0]['active_level_two10']+$summary[0]['active_level_three10']; ?></th>
      </tr>
    </table>
  </div>
</div>
<?php } 
else{
?>

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
<?php } ?>

	<div class="row-fluid">
		<?=$payment_monthly?>
	</div>
