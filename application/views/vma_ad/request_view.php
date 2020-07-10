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
	<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">VMA Request</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Request</li>
        </ul>
      </div>
    </div>
    
    <?php if($this->session->flashdata('show_msg')!=''){?>
    	<div class="alert alert-success">
   	 		<button type="button" class="close" data-dismiss="alert">&times;</button>
    		<strong><?=$this->session->flashdata('show_msg')?></strong> 
    	</div>
   <?php } ?>
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
            	<th>Usercode</th>
            	<th>Name</th>
              	<th>Username</th>
                <th>Message</th>
             	<th>Date</th>
                <th>Opration</th>
            </tr>
          </thead>
          <tbody>
          		
            	<?php for($i=0;$i<count($result);$i++) { 
							
						if(isset($result[$i]['payment_code']) && $result[$i]['payment_code']!=''){
							$btn='<a href="'.vma_ad().$this->uri->rsegment(1).'/approve/'.$result[$i]['request_code'].'"><span class="label label-success">Join</span></a>';		
						}else{
							
							if($this->comman_fun->check_record('vma_message',array('type'=>'payment_confirm','status'=>'Active','usercode'=>$result[$i]['usercode']))){
								$btn='<a href="'.vma_ad().$this->uri->rsegment(1).'/payment_confirm/'.$result[$i]['request_code'].'"><span class="label label-important">Payment Confirm</span></a>&nbsp;&nbsp;';	
								$btn.='<a href="'.vma_ad().'general/payment_detail/'.$result[$i]['usercode'].'"><span class="label label-success">View Payment</span></a>';
							}else{
								$btn='Not Send';	
							}
							
						}
						
						$btn.='&nbsp;&nbsp;&nbsp;<a href="'.vma_ad().'message/send/'.$result[$i]['usercode'].'"><span class="label label-info">Send Email</span></a>';
				?>
            	<tr>
            		<th><?=$result[$i]['usercode']?></th>
            		<th><?=$result[$i]['name']?></th>
              		<th><?=$result[$i]['username']?></th>
                    <th><?=$result[$i]['msg']?></th>
             		<th><?=$result[$i]['timedt']?></th>
                	<th><?=$btn?></th>
            	</tr>
            <?php } ?>
           </tbody>
        </table>
      </div>
    </div>

