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
		
    });	
</script>

<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=MATRIX_LLB?> CMS </h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">CMS</li>
      
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
	<br />

   

	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                    <th width="10%">Page Name</th>
                    <th width="25%">Title</th>
                    <th width="35%">Opration</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result);$i++){
						$row=$i+1;
	
					?>
                	<tr>
                    	<td><?=$result[$i]['page_name']?></td> 
                    	<td><?=$result[$i]['page_title']?></td> 	
                    	<th><a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/addnew/Edit/<?=$result[$i]['page_code']?>"><span class="label label-success">Edit</span></a></th>
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