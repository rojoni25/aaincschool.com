<script src="<?php echo base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?php echo base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>asset/js/TableTools.js"></script>

<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
		});
		
		notification_pop_set();
		var oTable = $("#data-table").dataTable();
		$(oTable).bind( 'draw', myfunction );
		
		$(document).on('click','.reject_req',function(e){
			var con=confirm('Are You Sure Reject Request ?');
			if(!con){
				e.preventDefault();
				return false;
			}
		});
    });
	
	
	
	function myfunction(){
		notification_pop_set();
	}
	
	
	
	
</script>

<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> Benefits Pages </h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Benefits Pages</li>
      
    </ul>
  </div>
</div>

 




	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                    <th width="10%">No</th>
                    <th width="15%">Logo</th>
                    <th width="15%">Name</th>
                    <th width="15%">Create Date</th>
                    <th width="15%">Opration</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result);$i++){
						$row=$i+1;
						
						if(file_exists(FCPATH."upload/company/".$result[$i]['company_logo']))
						{
							$logo	=	'<img src="'.base_url().'upload/company/'.$result[$i]['company_logo'].'" width="70" />';
						}
						else{
							$logo	=	'';
						}
						
					?>
                	<tr>
                	<td><?=$row?></td>
                   	<td><?=$logo?></td>
                    <td><?=$result[$i]['company_name']?></td>
                    <td><?=date('M d, Y',strtotime($result[$i]['create_date']))?></td>
                    <th><a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/detail/<?=$result[$i]['company_code']?>"><span class="label label-success">View Benefits Pages</span></a></th>
                  
                </tr>
                <?php } ?>
            </tbody>	
              
            </table>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>