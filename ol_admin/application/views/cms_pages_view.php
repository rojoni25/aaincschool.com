<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>


<script>
	$(document).ready(function(e) {
		get_listing();
        $(document).on('change','#page_type',function(e){
			var value=$(this).val();
			var url='<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/view/'+value;
			window.location.href=url;
		});
    });
	
	function get_listing(){
		var url_l='<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/listing/<?=$this->uri->segment(3)?>';	
		$.ajax({url:url_l,success:function(result){
			$("#data-table tbody").html(result);
			$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});
			
			
     	}});
	}
</script>



<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

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
    <table class="table" id="">
      <tr>
      		<td width="19%">Page Type</td>
            <td width="1%"></td>
            <td width="80%">
            	<select id="page_type" name="page_type" class="">
                	<option value="">All</option>
                    <?php
						for($i=0;$i<count($page_type);$i++){
							$sel=($page_type[$i]['page_type']==$this->uri->segment(3)) ? "selected='selected'" : "";
							$name=str_replace('_',' ',$page_type[$i]['page_type']);
							echo  '<option '.$sel.' value="'.$page_type[$i]['page_type'].'">'.$name.'</option>';		
						}                    
					?>
                    
                </select>
            </td>
      </tr>
    </table>
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
      </tbody>
    </table>
  </div>
</div>
