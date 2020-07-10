<script>
	$(document).on('click','.approve',function(e){
		var con=confirm('Are You Sure');
		if(!con){
			return false;
		}else{
			return true;
		}
				
	});
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>



<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg');?>
  </strong> </div>
<?php } ?>



<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Under Process (Dreem Student)
      	<span class="pull-right">
        	<a href="<?=base_url()?>index.php/dreem_student/ad_dashboard/">
            	<button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
            </a>
        </span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Under Process</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    	
     
        <table class="table table-striped table-bordered">
            	<thead>
                <tr>
                    <th>Sr</th>
                    <th>Usercode</th>
                    <th>Name</th>
                    <th>Downline / Payment</th>
                    <th>Referral</th>
                    <th>Skype</th>
                    <th>Contact No.</th>
                    <th>Payment</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($result);$i++){ 
						
						
							
							$email_cls	=	($result[$i]['email_verification']=='Y')? 'cls_virify' : 'cls_not_virify' ;
							
							$contact_no	=	($result[$i]['mobileno']!='')? $result[$i]['mobileno'] : $result[$i]['phone_no'] ;
							
							$row=$i+1;
							if($result[$i]['tot_payment']=='0'){
								$btn='Not Send';
							}else{
								$btn='<a href="'.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/payment_view/'.$result[$i]['usercode'].'">Payment View</a>';
								$btn.='&nbsp;&nbsp;&nbsp;&nbsp;<a class="approve" href="'.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/insert_tree/'.$result[$i]['usercode'].'">Approve</a>';
							}
							echo '<tr>
								<td>'.$row.'</td>
								<td><font class="'.$email_cls.'">'.$result[$i]['usercode'].'</font></td>
								<td>'.$result[$i]['member_name'].'</td>
								<td>
									<font class="font-1">Downline Of :</font>  '.$result[$i]['upling_name'].' ('.$result[$i]['upling'].') <br>
									<font class="font-1">Payment To :</font>  '.$result[$i]['pay_name'].' ('.$result[$i]['payto'].')
								</td>
								
								<td>'.$result[$i]['ref_name'].' ('.$result[$i]['ref_code'].')</td>
								<td>'.$result[$i]['skype'].'</td>
								<td>'.$contact_no.'</td>
								<td>'.$btn.'</td>
								<td><a href="'.base_url().'index.php/dreem_student/ad_email/to_member/'.$result[$i]['usercode'].'">Send Email</a></td>
							</tr>';
                     } ?>
               </tbody> 
               </table> 
               
               
        
  </div>
</div>


<style>
	.cls_virify{
		color:#390;
		font-weight:bold;
	}
	.cls_not_virify{
		color:#F00;
		font-weight:bold;
	}
	.font-1{
		font-weight:bold;
	}
</style>







