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
      <h3 class="page-header">CMS Pages</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">CMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Pages</li>
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
			echo '<tr >
						<td>'.$result[$i]['pagename'].'</td>
						<td>'.$result[$i]['title'].'</td>
						<td>
							<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/custom_page_edit/'.$result[$i]['pagecode'].'"><button class="btn btn-success smallbtn" type="button">Edit</button></a>
							<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/custom_page_permission/'.$result[$i]['pagecode'].'"><button class="btn btn-warning smallbtn" type="button">Permission</button></a>
						</td>
              		</tr>';
		}
	  ?>
      </tbody>
    </table>
  </div>
</div>

<style>
	.smallbtn{
		padding:2px 12px;
		font-weight:bold;
	}
</style>
