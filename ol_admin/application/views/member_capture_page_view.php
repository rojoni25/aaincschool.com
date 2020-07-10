<?php
	if($_REQUEST['filter']=='Y'){
		$sel_page_type	=	$_REQUEST['page_type'];
		$sel_membername	=	$_REQUEST['membername'];
		$sel_user_code	=	$_REQUEST['user_code'];
		$request=http_build_query($_REQUEST);
	}else{
		$request='';
	}
?>
<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/capture_page/capture_report_listing?<?=$request?>",
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]]
	});
	
	//////////////
	$("#membername").autocomplete({
		source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate',
		minLength:1,selectFirst: true,selectOnly: true,
		select: function(event, ui) {
		event.preventDefault();
		$(this).parent().children('#user_code').val(ui.item.value);
		//$('#category_code').val(ui.item.value);
		$('#name').val(ui.item.label);},
		
		focus: function(event, ui) {
		event.preventDefault();
			$(this).parent().children('#user_code').val(ui.item.value);
			$(this).val(ui.item.label);
			$(this).removeClass('loading');},
		change: function(event,ui){
		if(ui.item==null){
			$(this).val((ui.item ? ui.item.id : ""));
			$(this).parent().children('#user_code').val('');
			$(this).removeClass('loading');}
		else{
			$(this).removeClass('loading');}},
		search: function(){
			$(this).addClass('loading');
		},
		open: function(){
			$(this).removeClass('loading');
		}
	});
	//////////////
	
} );

</script>
<script src="<?php echo base_url();?>/asset/js/jquery.tablecloth.js"></script>
<script src="<?php echo base_url();?>/asset/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>/asset/js/ZeroClipboard.js"></script>
<script src="<?php echo base_url();?>/asset/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>/asset/js/TableTools.js"></script>
<script src="<?php echo base_url();?>/ol_admin/asset/js/all_fun.js"></script>
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
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});

        $(document).on('click', '.delete', function (e) {
        	var yes=confirm("Are you sure?");
        	var id=$(this).attr('value');
        	if(yes){
        		$.ajax({
        			url:"<?php echo base_url().'index.php/'.$this->uri->segment(1).'/record_update/' ?>"+id,
        			success:function(){
        				location.reload();
        			}
        		})

        	}
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
      <h3 class="page-header">Capture Pages Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Capture Pages Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Pages</li>
    </ul>
  </div>
</div>

<?php
	if($_REQUEST['filter']=='Y'){
		$sel_page_type	=	$_REQUEST['page_type'];
		$sel_membername	=	$_REQUEST['membername'];
		$sel_user_code	=	$_REQUEST['user_code'];
	}
?>

<div class="row-fluid ">
  <div class="span12">
  	<form method="get" action="">
     <table class="table">
     	<tr>
        	<th width="19%">Select Page Type</th>
            <th width="1%"></th>
            <th width="80%">
            	<select name="page_type">
                	<option  value="">All</option>
                    <?php
						for($i=0;$i<count($capture_page_list);$i++){
							
							$sel=($capture_page_list[$i]['pagename']==$sel_page_type)? "selected='selected'" : "";
							
							echo '<option '.$sel.' value="'.$capture_page_list[$i]['pagename'].'">'.$capture_page_list[$i]['pagelable'].'</option>';
						}
                    	
					?>
                </select>
            </th>
        </tr>
        
        <tr>
        	<th width="19%">Member Name</th>
            <th width="1%"></th>
            <th width="80%"><input type="text" id="membername" name="membername" value="<?=$sel_membername?>" placeholder="Search Member" />
    						<input type="hidden" id="user_code" name="user_code" value="<?=$sel_user_code?>" />
             </th>
        </tr>
        
        <tr>
        	<th></th>
            <th></th>
            <th>
            	<button type="submit" name="filter" value="Y">Filter</button>
                <button type="submit" name="refresh" value="Y">Refresh</button>
             </th>
        </tr>
     </table>
     </form>
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
          <th width="20%">User Name</th>
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
