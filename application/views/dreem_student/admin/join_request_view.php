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
      <h3 class="page-header">Join Request (Dreem Student)
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
      <li class="active">Join Request</li>
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
                        <th>Referral</th>
                        <th>Skype</th>
                        <th>Contact No.</th>
                        <th>date</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($result);$i++){ 
						$row=$i+1;
						
						$email_cls	=	($result[$i]['email_verification']=='Y')? 'cls_virify' : 'cls_not_virify' ;
						$contact_no	=	($result[$i]['mobileno']!='')? $result[$i]['mobileno'] : $result[$i]['phone_no'] ;
						
                    	echo '<tr>
                        		<td>'.$row.'</td>
								<td><font class="'.$email_cls.'">'.$result[$i]['usercode'].'</font></td>
                            	<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
								<td>'.$result[$i]['ref_name'].' ('.$result[$i]['ref_code'].')</td>
								<td>'.$result[$i]['skype'].'</td>
								<td>'.$contact_no.'</td>
                            	<td>'.date('d-m-Y',strtotime($result[$i]['time_dt'])).'</td>
								<td>
									<a href="'.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/process/'.$result[$i]['usercode'].'">Process</a>&nbsp;&nbsp;
									<a href="'.base_url().'index.php/dreem_student/ad_email/to_member/'.$result[$i]['usercode'].'">Send Email</a>
								</td>
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






