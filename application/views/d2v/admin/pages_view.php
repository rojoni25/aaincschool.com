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
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">CMS Pages (D2V)
      	
       <span class="pull-right">
        	<a href="<?=base_url()?>index.php/d2v/ad_dashboard/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a>
        </span>
            
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">CMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Pages (D2V)</li>
    </ul>
  </div>
</div>




<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Page Name</th>
          <th>Title</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
      	<?php
       		for($i=0;$i<count($result);$i++){
				
				echo '<tr class="'.$status.'">
					<td>'.$result[$i]['pagename'].'</td>
					<td>'.$result[$i]['title'].'</td>
					<td><a href="'.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/Addnew/'.$result[$i]['cms_pages_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a></td>
				</tr>';
		}
        ?>
      </tbody>
    </table>
  </div>
</div>
