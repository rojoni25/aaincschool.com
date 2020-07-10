<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(function () {
                var validator = $("#form2").validate({
                    meta: "validate"
                });
				$(".btnsubmit").click(function () {
                     var validator = $("#form2").validate({
                    	meta: "validate"
                	});
                });
                $(".cancel").click(function () {
                    validator.resetForm();
                });
            });
			
			$(document).on('change', '#mp4type', function (e) {
				var value=$('#mp4type').val();
				$('.mp4cls').hide(500);
				$('.'+value).show(500);
			
			});
</script>
		<script>
        	function validationform()
			{
				var type=document.getElementById('type').value;
				if(type=='mp4')
				{
					var mp4type=document.getElementById('mp4type');
					var post_img=document.getElementById('post_img');
					var mp4link=document.getElementById('mp4link');
				
					if(mp4type.value=='video')
					{
						if(post_img.value==''){
							alert('Select MP4 Video');
							post_img.focus();
							return false;
						}
					}
					if(mp4type.value=='link'){
						if(mp4link.value==''){
							alert('Enter MP4 Video Link');
							post_img.focus();
							return false;
						}
					}
					
				}	
			}
			function is_valid_url(url)
			{
     			return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
			}
        </script>

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Slider  <?=$this->uri->segment(3)?> '<?=$mediatype?>'
           
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Slider</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active"><?=$mediatype?></li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
            <input type="hidden" name="type" id="type" 	 value="<?=$mediatype?>" />
			<?php if($mediatype=='image'){?>          
             <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
              	<input type="text" name="galleyname" id="galleyname" class="span12 {validate:{required:true}}" value="" placeholder="Enter Title"/>
            </div>
          	</div> 
          <!------------------>  
            <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              	<input type="text" name="description" id="description" class="span12 " value="" placeholder="Description"/>
            </div>
          	</div> 
          <!------------------>
            <div class="control-group">
            <label class="control-label">Select Images</label>
            <div class="controls">
              	<input type="file" name="post_img" id="post_img" class="span12" onChange="Checkfiles();" value=""/>
            </div>
          </div>
          	<?php } ?>
            
            <?php if($mediatype=='mp4'){?>
            <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
              	<input type="text" name="galleyname" id="galleyname" class="span12" value="" placeholder="Enter Title"/>
            </div>
          </div>    
          
           <div class="control-group">
            <label class="control-label">Upload Type</label>
            <div class="controls">
                <select name="mp4type" id="mp4type" class="span6">
                	<option value="video">Uplaod Mp4 Video</option>
                    <option value="link">Insert Mp4 Link</option>
                </select>
            </div>
          </div> 
          
          
           <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              	<input type="text" name="description" id="description" class="span12" value="" placeholder="Description"/>
            </div>
          	</div>
                  
          <!------------------>
          <div></div>
            <div class="control-group video mp4cls">
            <label class="control-label">Select MP4 Video</label>
            <div class="controls">
              	<input type="file" name="post_img" id="post_img" class="span12" onChange="Checkfiles();" value=""/>
                <img id="loader" style="display: none;width: 50px;" src="<?php echo base_url()?>asset/images/loading_spinner.gif"/>
            </div>
          </div>
           
           <div class="control-group link mp4cls"  style="display:none;">
            <label class="control-label">Select MP4 Link</label>
            <div class="controls">
              	<input type="text" name="mp4link" id="mp4link" class="span12" value=""/>
            </div>
          </div>
          	<?php } ?>
             <?php if($mediatype=='youtube'){?>
             
             <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
              	<input type="text" name="galleyname" id="galleyname" class="span12 {validate:{required:true}}" value="" placeholder="Enter Title"/>
            </div>
          	</div> 
            
            <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              	<input type="text" name="description" id="description" class="span12 " value="" placeholder="Description"/>
            </div>
          	</div> 
          
             	<div class="control-group">
            <label class="control-label">Enter Youtube Video Link</label>
            <div class="controls">
              	<input type="text" name="media_link" id="media_link" class="span12 {validate:{url:true,required:true}}" value="" placeholder="Enter Title"/>
            </div>
          </div> 
             <?php } ?>

             <?php if($mediatype=='ppt'){?>
             
             <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <input type="text" name="galleyname" id="galleyname" class="span12 {validate:{required:true}}" value="" placeholder="Enter Title"/>
            </div>
            </div> 
            
            <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <input type="text" name="description" id="description" class="span12 " value="" placeholder="Description"/>
            </div>
            </div> 
          
              <div class="control-group">
            <label class="control-label">Enter ppt Video Link</label>
            <div class="controls">
                <input type="text" name="media_link" id="media_link" class="span12 {validate:{url:true,required:true}}" value="" placeholder="Enter Title"/>
            </div>
          </div> 
             <?php } ?>

             <?php if($mediatype=='audio'){?>
             
             <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <input type="text" name="galleyname" id="galleyname" class="span12 {validate:{required:true}}" value="" placeholder="Enter Title"/>
            </div>
            </div> 
            
            <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <input type="text" name="description" id="description" class="span12 " value="" placeholder="Description"/>
            </div>
            </div> 
          
              <div class="control-group">
            <label class="control-label">Enter Audio Link</label>
            <div class="controls">
                <input type="text" name="media_link" id="media_link" class="span12 {validate:{url:true,required:true}}" value="" placeholder="Enter Title"/>
            </div>
          </div> 
             <?php } ?>
          <!------------------>
          <div class="form-actions">
            <button type="submit" id="showloader" class="btn btn-primary btnsubmit" onclick="return validationform();">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

<script>
  $("#showloader").click(function(){
    $("#loader").css("display","block");
  });
	function Checkfiles()
    {
		
		var type = document.getElementById('type').value;
		
        var fup = document.getElementById('post_img');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		
		if(type=='image')
		{
			if(ext =="jpeg" ||  ext=="png"  || ext=="jpg"){return true;}
    		else{alert("Upload jpeg,png,jpg Images only");fup.value="";return false;}
		}
		if(type=='mp4')
		{
			if(ext =="mp4"){return true;}
			else{alert("Select Only Mp4 File");	fup.value="";return false;}
		}
    	
    }
</script>
