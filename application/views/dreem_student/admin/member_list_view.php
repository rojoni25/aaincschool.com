<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
					
			});
    });
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>






<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member List (Dreem Student)
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
    	
       
      
             <table class="table table-striped table-bordered" id="data-table">
            	<thead>
                    <tr>
                    <th>Sr</th>
                    <th>Usercode</th>
                    <th>Login</th>
                    <th>Name</th>
                    <th>Upling Member</th>
                    <th>Payment To</th>
                    <th>Referral</th>
                    <th>Skype</th>
                    <th>Contact No.</th>
                    <th>Date</th>
                    <th>#</th>
   
                    </tr> 
                </thead>
                <tbody>
                	
                	<?php for($i=0;$i<count($result);$i++){ 
							
							$email_cls	=	($result[$i]['email_verification']=='Y')? 'cls_virify' : 'cls_not_virify' ;
							$contact_no	=	($result[$i]['mobileno']!='')? $result[$i]['mobileno'] : $result[$i]['phone_no'] ;
							
							$tr_cls=($result[$i]['type']=='resiual') ? "cls_resiual" : "";
							$row=$i+1;
							echo '<tr class="'.$tr_cls.'">
								<td>'.$row.'</td>
								<td><font class="'.$email_cls.'">'.$result[$i]['usercode'].'</font></td>
								<td>Username : '.$result[$i]['member_username'].'<br>
									Password : '.$result[$i]['password'].'
								</td>
								<td>'.$result[$i]['member_name'].'</td>
								<td>'.$result[$i]['upling_name'].' ('.$result[$i]['upling'].')</td>
								<td>'.$result[$i]['pay_name'].' ('.$result[$i]['payto'].')</td>
								<td>'.$result[$i]['ref_name'].' ('.$result[$i]['ref_code'].')</td>
								<td>'.$result[$i]['skype'].'</td>
								<td>'.$contact_no.'</td>
								<td>'.date('d-m-Y',strtotime($result[$i]['create_date'])).'</td>
								<td><a href="'.base_url().'index.php/dreem_student/ad_email/to_member/'.$result[$i]['usercode'].'">Send Email</a></td>
							</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>



<style>
	.cls_resiual{
		background-color:#E0AFA9;
	}
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







