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
		
		$(document).on('click','.delete',function(e){
			e.preventDefault();
			var url=$(this).attr('href');
			var tr=$(this).closest('tr');
			$.ajax({url:url,success:function(result){
				tr.remove();
			}});
			
		});
		
    });
	
	
</script>



<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Message (D2V)
      	
       <span class="pull-right">
        	<a href="<?=base_url()?>index.php/d2v/ad_dashboard/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a>
        </span>
            
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">CMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Message (D2V)</li>
    </ul>
  </div>
</div>




<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="5%">Sr. No</th>
          <th width="10%">Usercode</th>
          <th width="15%">Name</th>
          <th width="15%">Subject</th>
          <th width="35%">Message</th>
          <th width="15%">Date</th>
          <th width="10%">#</th>
        </tr>
      </thead>
      <tbody>
      	<?php
       		for($i=0;$i<count($result);$i++){
				$row=$i+1;				
				echo '<tr class="'.$status.'">
						<td>'.$row.'</td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['msg'].'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['timedt'])).'</td>
						<td><a class="delete" href="'.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/delete/'.$result[$i]['id'].'">Delete</a></td>
					</tr>';
		}
        ?>
      </tbody>
    </table>
  </div>
</div>
