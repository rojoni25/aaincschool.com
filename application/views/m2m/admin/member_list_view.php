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
      <h3 class="page-header">Member List (DFSM)
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
    	
       
      
             <table class="table table-striped table-bordered" id="data-table">
            	<thead>
                    <tr>
                        <th>Sr</th>
                        <th>Usercode</th>
                        <th>Name</th>
                        <th>Upling Member</th>
                        <th>Payment To</th>
                        <th>Date</th>
   
                    </tr> 
                </thead>
                <tbody>
                	
                	<?php for($i=0;$i<count($result);$i++){ 
							
							
							$tr_cls=($result[$i]['type']=='resiual') ? "cls_resiual" : "";
							$row=$i+1;
							echo '<tr class="'.$tr_cls.'">
								<td>'.$row.'</td>
								<td>'.$result[$i]['usercode'].'</td>
								<td>'.$result[$i]['member_name'].'</td>
								<td>'.$result[$i]['upling_name'].' ('.$result[$i]['upling'].')</td>
								<td>'.$result[$i]['pay_name'].' ('.$result[$i]['payto'].')</td>
								<td>'.date('d-m-Y',strtotime($result[$i]['create_date'])).'</td>
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
</style>







