<?php
	$page_field=explode(',',$master_page[0]['option']);
	if($this->uri->segment(3)=='Add')
	{
		$option_form='checked="checked"';
	}
	else{
		if($result[0]['option_form']=='Y'){
			$option_form='checked="checked"';
		}
	}
?>

<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">




<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script src="<?php echo base_url();?>/ckeditor/ckeditor.js"></script> 
<script src="<?php echo base_url();?>/asset/js/jscolor.js"></script> 
<script>
	var mediaid=='';
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
			
			
</script>
<script>
	$(document).ready(function(e) {
        $(document).on('click', '#page_priview', function (e) {
			e.preventDefault();
			
			 var form = $('#form2');
			for ( instance in CKEDITOR.instances ) {
        		CKEDITOR.instances[instance].updateElement();
    		}
             var post_url = '<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insert_priview';
			
			 //////////////
			 $.ajax({
             type: 'post',url: post_url,data: form.serialize(),
             success: function (result) {
				/****/
				
				var pagecode=$('#priview_code').val();
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page_priview/'+pagecode+'';
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
				
				/****/
		
             }
           });
			 //////////////
		});
		
		/////////////////////
		 $(document).on('click', '.open_popup', function (e) {
			var value 		= $(this).attr('value');
			mediaid			= $(this).attr('destination');
			
			var url='<?php echo base_url();?>index.php/capture_page/openpopup/?type='+value;
			e.preventDefault();
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
		////////////////////
		//////////
	   		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate',
                        minLength:2,selectFirst: true,selectOnly: true,
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
	   /////auto///////
		
		
    });
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Page
        <?=$this->uri->segment(3)?>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Capture Page</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
      <input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
       <input type="hidden" name="master_page_code" id="master_page_code" 	 value="page15" />
      <input type="hidden" name="priview_code" id="priview_code" value="<?=$priview_code?>" />
      <input type="hidden" name="form_type" id="form_type" value="member_pages" />
     
      <div class="row-fluid">
        <div class="span6">
          <div class="content-widgets gray">
            <div class="widget-head orange">
              <h3>Page Style</h3>
            </div>
            <div class="widget-container">
            
            	
                  
               <div class="control-group">
                <label class="control-label">Member Name</label>
                <div class="controls">
                  <input id="membername" name="membername" value="<?=$membername[0]['fname']?> <?=$membername[0]['lname']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Enter Member Name"/>
                  <input type="hidden" id="user_code" name="user_code" value="<?=$result[0]['usercode']?>" />
                </div>
              </div>
              <!------------------------>   
                  
                          	
              <div class="control-group">
                <label class="control-label">Page Name</label>
                <div class="controls">
                  <input id="page_name" name="page_name" value="<?=$result[0]['page_name']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Page Name"/>
                </div>
              </div>
              <!------------------------>
             
             
              <div class="control-group">
                <label class="control-label">Background Image Url</label>
                <div class="controls">
                  <input id="page_bg_img" name="page_bg_img" value="<?=$result[0]['page_bg_img']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                  <a href="#" class="open_popup" value="image" destination="page_bg_img"><i class="icon-picture"></i></a>
                </div>
              </div>
              <!------------------------>
             
              
              
              <div class="control-group">
                <label class="control-label">Page Background Video</label>
                <div class="controls">
                  <input id="video_url1" name="video_url1" value="<?=$result[0]['video_url1']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                 	<?php if($result[0]['page_bg_video_mute']=='Y'){ 
								$mute='checked="checked"';
							} 
					?>
   
                     <a href="#" class="open_popup" value="video" destination="video_url1"><i class="icon-facetime-video"></i></a>
                     &nbsp;&nbsp;<input type="checkbox" <?=$mute?> name="page_bg_video_mute" id="page_bg_video_mute" value="Y" /> :Mute
                </div>
              </div>
              <!------------------------>
               <div class="control-group">
                <label class="control-label">Contain Video</label>
                <div class="controls">
                  <input id="video_url2" name="video_url2" value="<?=$result[0]['video_url2']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                    <a href="#" class="open_popup" value="video" destination="video_url2"><i class="icon-facetime-video"></i></a>
                </div>
              </div>
              <!------------------------>
              <!------------------------>
               <div class="control-group">
                <label class="control-label">Contain Video Frame</label>
                <div class="controls">
                  <select id="video_frame" name="video_frame">
                  	<option value="mflat_screen">Flat Screen</option>
                    <option value="miphone">iphone</option>
                    <option value="mipad">iPad</option>
                    <option value="mimac">iMac</option>
                  </select> 
                </div>
              </div>
              <!------------------------>
           		<!------------------------>
              <div class="control-group">
                <label class="control-label">Contain Box BG Image Url</label>
                <div class="controls">
                  <input id="box_bg_img" name="box_bg_img" value="<?=$result[0]['box_bg_img']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Box BG Image Url"/>
                  <a href="#" class="open_popup" value="image" destination="box_bg_img"><i class="icon-picture"></i></a>
                </div>
              </div>
              <!------------------------>
              
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Contain Box BG Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="box_bg_color" name="box_bg_color" value="<?=$result[0]['box_bg_color']?>"/>
                    	
                </div>
              </div>
              <!------------------------>
               <!------------------------>
              
              <div class="control-group">
                <label class="control-label">Registration Form Show</label>
                <div class="controls">
                    	<input type="checkbox" value="Y" <?=$option_form?> name="option_form" id="option_form" />
                    	
                </div>
              </div>
              <!------------------------>
              
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Form BG Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="form_bg_color" name="form_bg_color" value="<?=$result[0]['form_bg_color']?>"/>	
                </div>
              </div>
              <!------------------------>
              
               <!------------------------>
              <div class="control-group">
                <label class="control-label">Field BG Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="form_field_bg_color" name="form_field_bg_color" value="<?=$result[0]['form_field_bg_color']?>"/>
                    	
                </div>
              </div>
              <!------------------------>
              
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Form Text Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="form_text_color" name="form_text_color" value="<?=$result[0]['form_text_color']?>"/>
                    	
                </div>
              </div>
              <!------------------------>
              
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Submit Button BG Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="	form_btn_color" name="form_btn_color" value="<?=$result[0]['form_btn_color']?>"/>
                    	
                </div>
              </div>
              <!------------------------>
              
              <div class="control-group">
                <label class="control-label">Redirect URL</label>
                <div class="controls">
                  <input id="redirect_url" name="redirect_url" value="<?=$result[0]['redirect_url']?>" class="span12 {validate:{url:true}}" type="text" placeholder="Redirect URL"/>
          			<p style="color:#F00;">empty to default</p>
                </div>
              </div>
              
              
              
              <!------------------------>  
            </div>
          </div>
        </div>
        <div class="span6">
          <div class="content-widgets gray">
            <div class="widget-head orange">
              <h3>Page Contain</h3>
            </div>
            <div class="widget-container">
            <!------------------------>
     			
                 <!------------------------>
              <div class="control-group">
                <label class="control-label">Page Header Bg Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="headercolor" name="headercolor" value="<?=$result[0]['headercolor']?>"/>
                </div>
              </div>
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Page Header Bg Image</label>
                <div class="controls">
                  <input id="headerimg" name="headerimg" value="<?=$result[0]['headerimg']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Page Header Bg Image"/>
                  <a href="#" class="open_popup" value="image" destination="headerimg"><i class="icon-picture"></i></a>
                </div>
              </div>
              <!------------------------>  
               <!------------------------>
              <div class="control-group">
                <label class="control-label">Headline Text Color</label>
                <div class="controls">
                    	<input type="text" class="color" id="headertxt_color" name="headertxt_color" value="<?=$result[0]['headertxt_color']?>"/>
                </div>
              </div>
              <!------------------------>
                
               <div class="control-group">
                <label class="control-label">Headline Text</label>
                <div class="controls">
                 <textarea name="headline_text" id="headline_text"><?=$result[0]['headline_text']?></textarea>
          		<script type="text/javascript">
    				CKEDITOR.replace( 'headline_text',
					{
						toolbar :
						[
							{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','FontSize' ] }
						],
						removePlugins: 'resize',
						
						
        				
					});
				</script> 
                </div>
              </div>
             
             
              
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Main Body Text</label>
                <div class="controls">
                 <textarea name="main_body_text" id="main_body_text"><?=$result[0]['main_body_text']?></textarea>
          		<script type="text/javascript">
    				CKEDITOR.replace( 'main_body_text',
					{
						toolbar :
						[
							{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','FontSize','Styles' ] },
							{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
							{ name: 'colors', items: [ 'TextColor', 'BGColor','Font' ] }
						],
						removePlugins: 'resize',
					});
				</script> 
                </div>
              </div>
              <!------------------------>
               

            </div>
          </div>
        </div>
        <div style="clear:both;overflow:hidden;"></div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Save</button>
            <a href="#" id="page_priview"><button type="button" class="btn btn-danger">Priview</button></a>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
      </div>
    </form>
  </div>
</div>

<style>
	.open_popup{
		color:#000;
		text-decoration:none;
		margin-left:5px;
	}
	.open_popup:hover{
		color:#000;
		text-decoration:none;
	}
</style>