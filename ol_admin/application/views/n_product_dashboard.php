
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Paid Product Dashboard</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Paid Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Dashboard</li>
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets green">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-user"></i> Total Member </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><?=$total?></span><span class="n-sources">Total Member</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_tree/member_view">Total Member <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets blue-violate">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-thumbs-up"></i> Active Member </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><?=$active?></span><span class="n-sources">Active Member</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_tree/member_view?status=active">View Member<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets dark-yellow">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-thumbs-down"></i> Due Member</h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><?=$due?></span><span class="n-sources">Due Member</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_tree/member_view?status=due">View Member<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets magenta">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-lock"></i> Blog Permission </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter">&nbsp;</span><span class="n-sources">Blog Permission</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_payment/blog_permission">Go to Blog<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
</div>


<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets bondi-blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-money"></i> $15 Subscribe </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><?=$product_1?></span><span class="n-sources">Total Member</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_tree/member_view?product_type=15">Total Member <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  <div class="span3">
    <div class="board-widgets brown">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-money"></i> $100 Subscribe </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><?=$product_2?></span><span class="n-sources">Total Member</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_tree/member_view?product_type=100">View Member<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  
  <div class="span3">
    <div class="board-widgets orange">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-thumbs-up"></i> Payment Report </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter">&nbsp;</span><span class="n-sources">Payment Report</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_report/payment">View Report <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  
  <div class="span3">
    <div class="board-widgets brown">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-eye-open"></i>Under Review </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter"><?=$under_review?></span><span class="n-sources">Under Review </span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_report/under_review">View Member<i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  
  
  
</div>



<div class="row-fluid ">
  <div class="span3">
    <div class="board-widgets light-blue">
      <div class="board-widgets-head clearfix">
        <h4 class="pull-left"><i class="icon-thumbs-down"></i> Payment False </h4>
      </div>
      <div class="board-widgets-content"> <span class="n-counter">&nbsp;</span><span class="n-sources">Payment False</span> </div>
      <div class="board-widgets-botttom"> <a href="<?=base_url()?>index.php/n_product_report/payment_flase">View Report <i class="icon-double-angle-right"></i></a> </div>
    </div>
  </div>
  
 
</div>

