

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"> Pending Join Request (Not Send)</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=MATRIX_CODE_LLB?> Code Unuse</li>
      
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
                	<th>Usercode</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th><?=MATRIX_CODE_LLB?> Code</th>
                </tr>
            </thead>
            <tbody>
				<?php
                for($i=0;$i<count($result);$i++){
					echo '<tr>
					<td>'.$result[$i]['usercode'].'</td>
					<td>'.$result[$i]['username'].'</td>
					<td>'.$result[$i]['name'].'</td>
					<td>'.$result[$i]['access_code'].'</td>
					</tr>';
                } 
                ?>
            </tbody>	
              
            </table>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>