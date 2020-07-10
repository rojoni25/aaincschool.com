<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
<div class="marquee_div"> <span class="spm_llb">Just Joined</span>
  <marquee>
  <h3 class="maq_h3">
    <?=$this->session->userdata["ref"]["currect_add"]?>
  </h3>
  </marquee>
</div>
<?php } ?>



<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Payment Confirmation Report
        <span style="margin-left: 299px;">
          <a href="<?=base_url()?>index.php/payment_confirm/affiliatePayment"><span class="label label-success" style="font-family:Arial, Helvetica, sans-serif;">Affiliate Payment Confirmation </span></a>
        </span>
       
      	<span class="pull-right">
        	<a href="<?=base_url()?>index.php/payment_confirm"><span class="label label-success" style="font-family:Arial, Helvetica, sans-serif;">Payment Confirmation Message</span></a>
        </span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Payment</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Payment Confirmation Report</li>
    </ul>
  </div>
</div>

<?php if(count($result)>0) {?>
  <div class="row-fluid">
    <div class="span12">
      <table class="table table-striped table-bordered">
      		<thead>
            	<tr>
                	<th>Sr No</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            	<?php
                	for($i=0;$i<count($result);$i++){
						$row=$i+1;	
						echo '<tr>
                				<td>'.$row.'</td>
								<td>'.$result[$i]['subject'].'</td>
                    			<td>'.$result[$i]['msg'].'</td>
                    			<td>'.date('d-m-Y',strtotime($result[$i]['timedt'])).'</td>
                			</tr>';
					}
				?>
            </tbody>
      </table>
    </div>
  </div>
<?php } ?>

<style>
	.txtarea{
		width:90%;
		height:120px;
		resize:none;
	}
	.txt{
		width:90%;
	}
</style>
