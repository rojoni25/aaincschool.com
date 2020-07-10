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



<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-ok-sign"></i><strong> <?=$this->session->flashdata('show_msg');?></strong>
    </div>
<?php } ?>



<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Join Request (D2V)
      	<span class="pull-right">
        	<a href="<?=base_url()?>index.php/d2v/ad_dashboard/">
            	<button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
            </a>
        </span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">M2M Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Join Request</li>
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
                        <th>Name</th>
                         <th>Ref. Name</th>
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
                            	<td>'.$result[$i]['member_name'].'</td>
								<td>'.$result[$i]['ref_name'].' ('.$result[$i]['ref_code'].')</td>
                            	<td>'.date('d-m-Y',strtotime($result[$i]['date_info'])).'</td>
								<td>
									<a href="'.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/process/'.$result[$i]['usercode'].'">Process</a>
									
									</td>
                        	</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>









