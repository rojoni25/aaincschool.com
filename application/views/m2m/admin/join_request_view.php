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
      <h3 class="page-header">Join Request (DFSM)
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
                        <th>date</th>
                         <th>#</th>
                    </tr>
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($result);$i++){ 
						$row=$i+1;
                    	echo '<tr>
                        		<td>'.$row.'</td>
								<td>'.$result[$i]['usercode'].'</td>
                            	<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
                            	<td>'.date('d-m-Y',strtotime($result[$i]['time_dt'])).'</td>
								<td>
									<a href="'.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/process/'.$result[$i]['usercode'].'">Process</a>
									
									</td>
                        	</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>









