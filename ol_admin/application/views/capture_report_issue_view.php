<script>
	$(document).ready(function(e) {
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page/'+pagecode+'';
				url=url.replace('ol_admin/', '');
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		 $(document).on('click', '.delete', function (e) {
			var pagecode=$(this).attr('value');
			var url='<?=base_url();?>index.php/capture_page/issue_report_update/'+pagecode;
			var con=confirm('Are You Sure Delete Page');
			if(!con){
				return false;
			}
			$(this).parent().parent().remove();
			$.ajax({url:url,success:function(result){		 	
            }});	
		 });
		
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
          <h3 class="page-header">Report Issue</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Capture Pages</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Report Issue</li>
        </ul>
      </div>
    </div>
    
  
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th>Code</th>
                <th>Url</th>
                <th>Text</th>
                <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php
            	for($i=0;$i<count($result);$i++){
			
					echo '<tr>
						<td>'.$result[$i]['report_issue_code'].'</td>
						<td>'.$result[$i]['issue_url'].'</td>
						<td>'.$result[$i]['contain'].'</td>
						<td>
						<a href="#" class="delete" value="'.$result[$i]['report_issue_code'].'"><button class="btn-primary btncls" type="button">Delete</button></a>
						</td>
              		</tr>';
		}
			?>
           </tbody>
        </table>
      </div>
    </div>
<style>
	.btncls{
		border:none;
	}
</style>
