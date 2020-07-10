<script>
	$(document).ready(function(e) {
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/preview_after/'+pagecode+'';
				url=url.replace('ol_admin/', '');
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		 $(document).on('click', '.delete', function (e) {
			var pagecode=$(this).attr('value');
			var url='<?=base_url();?>index.php/capture_page/record_update/'+pagecode;
			var con=confirm('Are You Sure Delete Page');
			if(!con){
				return false;
			}
			$(this).parent().parent().remove();
			$.ajax({url:url,success:function(result){		 	
            }});	
		 });
		
		
    });
</script>


<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Capture Pages</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Capture Pages</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Pages</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">PageCode</th>
          <th width="30%">Page Type</th>
          <th width="20%">Page Name</th>
          <th width="20%">Page Section</th>
          <th width="20%">Update</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<style>
	.btncls{
		border:none;
	}
</style>
