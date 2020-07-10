<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="<?=base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>asset/js/TableTools.js"></script>
<script>
	$(document).ready(function(e) {
		
		$('#tbldata').dataTable();
	
		 $(document).on('click', '.select_url', function (e) {
			 e.preventDefault();
			 var value 		= $(this).attr('value');
			 $('#'+mediaid).val(value);
			 $.magnificPopup.close();
		 });
		
		 $(document).on('click', '.image_view', function (e) {
			 e.preventDefault();
			 var value 		= $(this).attr('value');
			 	params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php //echo base_url(); ?>'+value+'';
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
		 });

		 $(document).on('click', '.video_view', function (e) {
			 e.preventDefault();
			 var value 		= $(this).attr('value');
			 	params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture_page/show_video/'+value+'';
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
		 });
	});
</script>
</head>
<style>
.mfp-content {
	width: 960px;
	background-color: #fff;
	padding: 15px;
	padding-bottom: 30px;
	margin: 20px auto;
}
.fromclose {
	float: right;
	text-decoration: none;
	color: #333;
}
.right_fol {
	float: right;
	text-decoration: none;
	margin-right: 10px;
	color: #333;
}
.right_fol:hover {
	text-decoration: none;
}
.fromclose:hover {
	text-decoration: none;
	color: #333;
}
#h2_head {
	font-size: 20px;
}
.table_popup{
	font-size:15px;
}
</style>
<body>
<h2>
  <h2 id="h2_head">
    Media
    <a class="popup-modal-dismiss fromclose" href="#" title="Close"><i class="icon-remove"></i></a></h2>
</h2>

<?php if($mediatype=='image') {?>
  		<div class="tblimg tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
          
            <th>Images</th>
             <th>Title</th>
            <th>Height</th>
            <th>Wight</th>
            <th>URL</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
					echo '<tr>
              				<td><img src="'.$result[$i]['imgthum'].'" style="height:100px;" /></th>
							<td>'.$result[$i]['galleyname'].'</td>
              				<td>'.$result[$i]['height'].'</td>
                			<td>'.$result[$i]['width'].'</td>
							<td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
							<td><a href="#" value="'.$result[$i]['media_link'].'" class="select_url">Select</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="#" value="'.$result[$i]['media_link'].'" class="image_view">View</a>
							</td></tr>';	
				}?>
        </tbody>
      </table>
    </div>
  <?php } ?>
    <?php if($mediatype=='video') {?>
    <div class="tbl4 tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
            <th>Title</th>
            <th>description</th>
            <th>Type</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
			  			
					echo '<tr>
              				<td>'.$result[$i]['galleyname'].'</td>
							<td>'.$result[$i]['description'].'</td>
							<td>'.$result[$i]['type'].'</td>
							<td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
							<td><a href="#" value="'.$result[$i]['media_link'].'" class="select_url">Select</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="#" value="'.$result[$i]['gallerycode'].'" class="video_view">View</a>
							</td></tr>';	
				}?>
        </tbody>
      </table>
    </div>
    <?php } ?>
   
    <?php if($mediatype=='ppt') {?>
    <div class="tbl4 tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
            <th>Title</th>
            <th>description</th>
            <th>Type</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
			  			
					echo '<tr>
              				<td>'.$result[$i]['galleyname'].'</td>
							<td>'.$result[$i]['description'].'</td>
							<td>'.$result[$i]['type'].'</td>
							<td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
							<td><a href="#" value="'.$result[$i]['media_link'].'" class="select_url">Select</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="#" value="'.$result[$i]['gallerycode'].'" class="video_view">View</a>
							</td></tr>';	
				}?>
        </tbody>
      </table>
    </div>
    <?php } ?>


    <?php if($mediatype=='audio') {?>
    <div class="tbl4 tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
            <th>Title</th>
            <th>description</th>
            <th>Type</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
			  			
					echo '<tr>
              				<td>'.$result[$i]['galleyname'].'</td>
							<td>'.$result[$i]['description'].'</td>
							<td>'.$result[$i]['type'].'</td>
							<td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
							<td><a href="#" value="'.$result[$i]['media_link'].'" class="select_url">Select</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="#" value="'.$result[$i]['gallerycode'].'" class="video_view">View</a>
							</td></tr>';	
				}?>
        </tbody>
      </table>
    </div>
    <?php } ?>
    
    
    <div style="clear:both;overflow:hidden;"></div>
  




</body>
</html>
<style>
.leftd {
	float: left;
	width: 48%;
	position: relative;
	overflow: hidden;
}
.rightd {
	float: right;
	width: 48%;
	position: relative;
	overflow: hidden;
}
.linethro {
	text-decoration: line-through;
}
.textcur{
		cursor:copy !important;
	}
	.btncls{
		border:none;
		margin-right:5px;
	}
	.thumdiv{
		width:250px;
		height:240px;
		float:left;
		margin-left:10px;
		margin-bottom:10px;
	}
	.txtyoutube{
		text-align:center;
		cursor:copy !important;
	}
</style>
