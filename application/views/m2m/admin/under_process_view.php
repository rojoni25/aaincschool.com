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
      <h3 class="page-header">Under Process (DFSM)
      	<span class="pull-right">
        	<a href="<?=base_url()?>index.php/m2m/ad_dashboard/">
            	<button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
            </a>
        </span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">DFSM Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
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
                        <th>Downline Of</th>
                         <th>Payment To</th>
                    </tr>
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($result);$i++){ 
						$row=$i+1;
						if($result[$i]['tot_payment']=='0'){
							$btn='Not Send';
						}else{
							$btn='<a href="'.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/payment_view/'.$result[$i]['usercode'].'">Payment View</a>';
							$btn.='&nbsp;&nbsp;&nbsp;&nbsp;<a class="approve" href="'.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/insert_tree/'.$result[$i]['usercode'].'">Approve</a>';
						}
                    	echo '<tr>
                        		<td>'.$row.'</td>
								<td>'.$result[$i]['usercode'].'</td>
                            	<td>'.$result[$i]['member_name'].'</td>
								<td>'.$result[$i]['upling_name'].' ('.$result[$i]['upling'].')</td>
                            	<td>'.$result[$i]['pay_name'].' ('.$result[$i]['payto'].')</td>
								<td>'.$btn.'</td>
                        	</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>









