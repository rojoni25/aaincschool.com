<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-ok-sign"></i><strong> <?=$this->session->flashdata('show_msg');?></strong>
    </div>
<?php } ?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Join Request Process (D2V) <span class="pull-right"> <a href="<?=base_url()?>index.php/d2v/ad_dashboard/">
        <button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
        </a> </span> </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Direct 2 Voice</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"> Request Process</li>
    </ul>
  </div>
</div>



<div class="row-fluid">
  <div class="span6">
  	<form action="<?=base_url()?>index.php/d2v/<?=$this->uri->rsegment(1)?>/approve_member/" method="post">
      <input type="hidden" name="usercode" id="usercode" value="<?=$result[0]['usercode']?>" />
    	<table class="table table-striped table-bordered">
      <tbody>
        <tr>
          <td>Member Name</td>
          <td>:</td>
          <td><?=$result[0]['member_name']?></td>
        </tr>
        <tr>
          <td>Usercode</td>
          <td>:</td>
          <td><?=$result[0]['usercode']?></td>
        </tr>
        <tr>
          <td>Referral</td>
          <td>:</td>
          <td><?=$result[0]['ref_name']?></td>
        </tr>
        <tr>
          <td>Referral Code</td>
          <td>:</td>
          <td><?=$result[0]['ref_code']?></td>
        </tr>
        
        <tr>
          <td>Downline Of</td>
          <td>:</td>
          <td> 
          	<select required="required" id="downline_of" name="downline_of">
            	<option value="">Select</option>
                <?php for($i=0;$i<count($member_list);$i++) {?>
                	<option value="<?=$member_list[$i]['usercode']?>"><?=$member_list[$i]['name']?> (<?=$member_list[$i]['usercode']?>)</option>
                <?php } ?>
            </select>
          </td>
        </tr>
        
         <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-primary">Submit</button></td>
        </tr>
        
        
      </tbody>
    </table>
    </form>
  </div>
  <div class="span6">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Sr</th>
          <th>Paypal Account</th>
          <th>Paypal email</th>
          <th>Transaction id</th>
          <th>Note</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++){ 
						$row=$i+1;
                    	echo '<tr>
                        		<td>'.$row.'</td>
								<td>'.$result[$i]['paypal_account'].'</td>
                            	<td>'.$result[$i]['paypal_email'].'</td>
								<td>'.$result[$i]['transaction_id'].'</td>
								<td>'.$result[$i]['notes'].'</td>
                            	<td>'.date('d-m-Y',strtotime($result[$i]['date_info'])).'</td>
								
                        	</tr>';
                     } ?>
      </tbody>
    </table>
  </div>
</div>
