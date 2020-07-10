<?php
	if($this->uri->segment(4)=='approve'){
		$approve_request='Yes';
		$btn_text='Approve';
	}
	else{
		$approve_request='No';
		$btn_text='Update';
	}
	$page_field=explode(',',$master_page[0]['option']);

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
		$(document).on('change', '#page_for', function (e) {
			var value=$('#page_for').val();
			if(value=='particular'){
				$('.show-hide').show(500);
			}
			else{
				$('.show-hide').hide(500);
			}
		});
		
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
      <h3 class="page-header">Capture Page Request Add</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Capture Page Request Add</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord_capture_request" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="Add" />
      <input type="hidden" name="request_code" id="request_code" 	 value="<?=$this->uri->segment(3)?>" />
      <input type="hidden" name="master_page_code" id="master_page_code"  value="<?=$master_page[0]['pagename']?>" />
      <input type="hidden" name="priview_code" id="priview_code" value="<?=$priview_code?>" />
      <input type="hidden" name="page_for" id="page_for" value="particular" />
      <input type="hidden" name="approve" value="<?=$approve_request?>" />
     
      <div class="row-fluid">
        <div class="span6">
          <div class="content-widgets gray">
            <div class="widget-head orange">
              <h3>Page Style</h3>
            </div>
            <div class="widget-container">
            
            	
			<!------------------------> 
              <div class="control-group">
                <label class="control-label">Member Name</label>
                <div class="controls">
                  <input id="membername" name="membername" value="<?=$result[0]['fname']?> <?=$result[0]['lname']?>" class="span12" readonly="readonly"/>
                  <input type="hidden" id="user_code" name="user_code" value="<?=$result[0]['usercode']?>" />
                </div>
              </div> 
                   <!------------------------> 
                <div class="control-group">
                <label class="control-label">Page Section</label>
                <div class="controls">
              		<select id="page_section" name="page_section">
                    <?php
                    	if($result[0]['page_section']=='capture_page'){
							$selcapture_page='selected="selected"';
						}
						else{
							$resmain_page='selected="selected"';
						}
					?>
                    	<option <?=$resmain_page?> value="main_page">Main Page Dispaly</option>
                        <option <?=$selcapture_page?> value="capture_page">Company Page Display</option>
                      
                    </select>
                </div>
              </div>
				  <!------------------------> 
                  
                <div class="control-group">
                <label class="control-label">Change Permission</label>
                <div class="controls">
              		<?php
						$change='';
                    	if($result[0]['change']=='Y'){$change='checked="checked"';}
					?>
                  <input type="checkbox" value="Y" name="change" <?=$change?> />
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
             
              <?php if (in_array("page_bg_img", $page_field)){?>
              <div class="control-group">
                <label class="control-label">Background Image Url</label>
                <div class="controls">
                  <input id="page_bg_img" name="page_bg_img" value="<?=$result[0]['page_bg_img']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                  <a href="#" class="open_popup" value="image" destination="page_bg_img"><i class="icon-picture"></i></a>
                </div>
              </div>
              <!------------------------>
              <?php } ?>
              
               <?php if (in_array("video_url1", $page_field)){?>
              <div class="control-group">
                <label class="control-label">Video URL 1(Main)</label>
                <div class="controls">
                  <input id="video_url1" name="video_url1" value="<?=$result[0]['video_url1']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                  <?php
                  		$chk='';
						if($result[0]['video1_autoplay']=='Y'){
							$chk='checked="checked"';
						}
				  ?>
                	
                     <a href="#" class="open_popup" value="video" destination="video_url1"><i class="icon-facetime-video"></i></a>
                       <?php if (in_array("mute", $page_field)){
						   		if($result[0]['page_bg_video_mute']=='Y'){ 
									$mute='checked="checked"';
								} 
						   ?>
                      	&nbsp;&nbsp;<input type="checkbox" <?=$mute?> name="page_bg_video_mute" id="page_bg_video_mute" value="Y" /> :Mute
                      <?php   } ?>
                </div>
              </div>
              <!------------------------>
              <?php } ?>
               <?php if (in_array("video_url2", $page_field)){?>
               <div class="control-group">
                <label class="control-label">Video URL 2</label>
                <div class="controls">
                  <input id="video_url2" name="video_url2" value="<?=$result[0]['video_url2']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
          		<?php
                  		$chk='';
						if($result[0]['video2_autoplay']=='Y'){
							$chk='checked="checked"';
						}
				  ?>
                    <a href="#" class="open_popup" value="video" destination="video_url2"><i class="icon-facetime-video"></i></a>
                </div>
              </div>
              <!------------------------>
              <?php } ?>
              
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
              
              <!------------------------>
              <?php if (in_array("main_body_text", $page_field)){?>
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
							{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','FontSize' ] },
							{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] }
						],
						removePlugins: 'resize',
					});
				</script> 
                </div>
              </div>
              <!------------------------>
               <?php } ?>

            </div>
          </div>
        </div>
        <div style="clear:both;overflow:hidden;"></div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit"><strong><?=$btn_text?></strong></button>
            <a href="#" id="page_priview"><button type="button" class="btn btn-danger">Priview</button></a>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/capture_page_request"><button type="button" class="btn">Cancel</button></a>
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