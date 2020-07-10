<?php
	if($mediatype=='image'){
		$btltext='Upload Image';
		$label='Image';
		$cls='btn btn-success';
	}
	else if($mediatype=='youtube'){
		$btltext='Add Youtube Video';
		$label='Youtube';
		$cls='btn btn-warning';
	}
	else if($mediatype=='mp4'){
		$btltext='Upload And Add MP4';
		$label='MP4';
		$cls='btn btn-danger';
	}else if($mediatype=='ppt'){
    $btltext='Add PPT';
    $label='ppt';
    $cls='btn btn-primary';
  }
  else if($mediatype=='audio'){
    $btltext='Add Audio';
    $label='audio';
    $cls='btn btn-info';
  }
?>

<script>
	$(document).ready(function(e) {
		$('#tbldata').dataTable({});
		$(document).on('click', '.remove_row', function (e) {
			var value 		= $(this).attr('value');
			$(this).parent().parent().remove();
			var url_update='<?=base_url()?>index.php/slider_setting/update_record/'+value;
			$.ajax({url:url_update,success:function(result){		 	
            }});
		});

    $(document).on('click', '.image_view', function (e) {
       e.preventDefault();
       var value    = $(this).attr('value');
        params  = 'width='+screen.width;
        params += ', height='+screen.height;
        params += ', top=0, left=0'
        params += ', fullscreen=yes';
        var url='<?php //echo base_url(); ?>'+value+'';
        newwin=window.open(url,'', params);
        if (window.focus) {newwin.focus()}
     });

    jQuery(document).on('click', '.video_view', function (e) {
       e.preventDefault();
        var value     = $(this).attr('value');
        params  = 'width='+screen.width;
        params += ', height='+screen.height;
        params += ', top=0, left=0'
        params += ', fullscreen=yes';
        //var url='<?php echo base_url();?>index.php/capture_pages/show_video/?v='+value+'';
        
        var url='<?php echo base_url();?>index.php/capture_pages/show_video/'+value+'';
        url=url.replace('ol_admin/', '');
        newwin=window.open(url,'', params);
        if (window.focus) {newwin.focus()}
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
      <h3 class="page-header">Slider Image List 
        
      </h3>
    </div>
    <div style="margin-bottom:10px;">
    <a href="<?=base_url()?>index.php/slider_setting/addnew/Add/?type=<?=$mediatype?>"><button class="<?=$cls?>" type="button"><strong><?=$btltext?></strong></button></a>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Upload Slider</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=$label?></li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
  <?php if($mediatype=='image') {?>
  		<div class="tblimg tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
          
            <th>Images</th>
             <th>Title</th>
            <th>Height</th>
            <th>Wight</th>
           
            <th>Link</th>
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
							<td><a href="#" value="'.$result[$i]['gallerycode'].'" class="remove_row">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#" value="'.$result[$i]['media_link'].'" class="image_view">View</a>
              </td></tr>';	
				}?>
        </tbody>
      </table>
    </div>
  <?php } ?>
    <?php if($mediatype=='mp4') {?>
    <div class="tbl4 tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
             <th>Title</th>
            <th>Description</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
           <?php for($i=0;$i<count($result);$i++){
					echo '<tr>
              				<td>'.$result[$i]['galleyname'].'</td>
							<td>'.$result[$i]['description'].'</td>
							<td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
							<td><a href="#" value="'.$result[$i]['gallerycode'].'" class="remove_row">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#" value="'.$result[$i]['gallerycode'].'" class="video_view">View</a>
              </td></tr>';	
				}?>
        </tbody>
      </table>
    </div>
    <?php } ?>
    

    <?php if($mediatype=='youtube') {?>
    
    	 <div class="tbl4 tbldiv">
      <table class="table table-striped table-bordered" id="tbldata">
        <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
					echo '<tr>
              				<td>'.$result[$i]['galleyname'].'</td>
							<td>'.$result[$i]['description'].'</td>
							<td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
							<td><a href="#" value="'.$result[$i]['gallerycode'].'" class="remove_row">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;
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
            <th>Description</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
          echo '<tr>
                      <td>'.$result[$i]['galleyname'].'</td>
              <td>'.$result[$i]['description'].'</td>
              <td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
              <td><a href="#" value="'.$result[$i]['gallerycode'].'" class="remove_row">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;
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
            <th>Description</th>
            <th>Link</th>
            <th>Opration</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($result);$i++){
          echo '<tr>
                      <td>'.$result[$i]['galleyname'].'</td>
              <td>'.$result[$i]['description'].'</td>
              <td><input type="text" readonly="readonly" class="textcur" value="'.$result[$i]['media_link'].'" /></td>
              <td><a href="#" value="'.$result[$i]['gallerycode'].'" class="remove_row">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#" value="'.$result[$i]['gallerycode'].'" class="video_view">View</a>
              </td></tr>';  
        }?>
        </tbody>
      </table>
    </div>
   
     <?php } ?>
    
    <div style="clear:both;overflow:hidden;"></div>
    
    
  </div>
</div>
<style>
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
