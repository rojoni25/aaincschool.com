<?php
	$page_field=explode(',',$master_page[0]['option']);
	if($set['mode']=='add')
	{
		$pagecode	=	$master_page[0]['pagename'];	
	}
	else{
		$pagecode	=	$result[0]['pagecode'];	
	}
?>
<script src="<?=base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>asset/js/TableTools.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script src="<?php echo base_url();?>/ckeditor/ckeditor.js"></script> 
<script src="<?php echo base_url();?>/asset/js/jscolor.js"></script> 
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
</script>
<script>
	$(document).ready(function(e) {
        $(document).on('click', '#page_priview', function (e) {
			//alert('hhh');
			e.preventDefault();
			 var form = $('#form2');
			for ( instance in CKEDITOR.instances ) {
        		CKEDITOR.instances[instance].updateElement();
    		}
             var post_url = '<?php echo smfund();?><?=$this->uri->rsegment(1)?>/insert_priview';
			// alert(post_url);
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
				var url='<?php echo base_url();?>index.php/smfund_capture/page_priview/'+pagecode+'';
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
				/****/
             }
           });
			 //////////////
		});
		
		 $(document).on('click', '#page_priview_reg', function (e) {
			 e.preventDefault();
			 var form = $('#form2');
			for ( instance in CKEDITOR.instances ) {
        		CKEDITOR.instances[instance].updateElement();
    		}
            var post_url = '<?php echo smfund();?><?=$this->uri->rsegment(1)?>/insert_priview';
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
				var url='<?php echo base_url();?>index.php/pages/reg_preview/'+pagecode+'';
			
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
				/****/
             }
           });
			/////////////
		});  
		   
		 $(document).on('click', '.open_popup', function (e) {
				var $ =jQuery.noConflict();
				var value 		= $(this).attr('value');
				mediaid			= $(this).attr('destination');
				var url='<?php echo base_url();?>index.php/capture_pages/openpopup/?type='+value;
				e.preventDefault();
				$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
		////////////////////
		
		
		   
    });
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Capture Page (<?=$set['mode']?>)
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
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo smfund();?><?=$this->uri->rsegment(1)?>/insertrecord" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$set['mode']?>" />
      <input type="hidden" name="eid" id="eid" 	 value="<?=$set['eid']?>" />
      <input type="hidden" name="master_page_code" id="master_page_code" 	value="<?=$pagecode?>" />
      <input type="hidden" name="priview_code" id="priview_code" value="<?=$priview_code?>" />
     
      <div class="row-fluid">
        <div class="span6">
          <div class="content-widgets gray">
            <div class="widget-head orange">
              <h3>Page Style</h3>
            </div>
            <div class="widget-container">
            
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
                  <input id="page_bg_img" name="page_bg_img" value="<?=$result[0]['page_bg_img']?>" class="span8 {validate:{}}" type="text" placeholder="Background Image Url"/>
                  <a href="#" class="open_popup" value="image" destination="page_bg_img"><i class="icon-picture"></i></a>
                </div>
              </div>
              <?php } ?>
              <!------------------------>
              <?php if (in_array("page_bg_video", $page_field)){?>
               <div class="control-group">
                <label class="control-label">Youtube Background Video</label>
                <div class="controls">
                  <input id="page_bg_video" name="page_bg_video" value="<?=$result[0]['page_bg_video']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                 	<?php if($result[0]['page_bg_video_mute']=='Y'){ 
								$mute='checked="checked"';
							} 
					?>
   
                     <a href="#" class="open_popup" value="video" destination="page_bg_video"><i class="icon-facetime-video"></i></a>
                     &nbsp;&nbsp;<input type="checkbox" <?=$mute?> name="page_bg_video_mute" id="page_bg_video_mute" value="Y" /> :Mute
                </div>
              </div>
               <?php } ?>
               <?php if (in_array("bg_iframe", $page_field)){?>
              <div class="control-group">
                <label class="control-label">Background Iframe</label>
                <div class="controls">
                  <input id="bg_iframe" name="bg_iframe" value="<?=$result[0]['bg_iframe']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Url"/>   
                </div>
              </div>
              <!------------------------>
              <?php } ?>
              
               <?php if (in_array("video_url1", $page_field)){?>
               <div class="control-group">
                <label class="control-label">Video/Slideshare URL 1(Main)</label>
                <div class="controls">
                  <input id="video_url1" name="video_url1" value="<?=$result[0]['video_url1']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                  <?php
                  		$chk='';
						if($result[0]['video1_autoplay']=='Y'){
							$chk='checked="checked"';
						}
				  ?>
                	
                     <a href="#" class="open_popup" value="video" destination="video_url1"><i class="icon-facetime-video"></i></a>
                </div>
              </div>
              <?php } ?>
              <!------------------------>
              
               <?php if (in_array("mutli_frame", $page_field)){?>
             
             <div class="control-group">
                <label class="control-label">Contain Video Frame</label>
                <div class="controls">
                  <select id="video_frame" name="video_frame">
                  	<option value="mflat_screen">Flat Screen</option>
                    <option value="miphone">iphone White</option>
                    <option value="mipad">iPad</option>
                    <option value="mimac">iMac</option>
                    <option value="macbook_pro">Macbook Pro</option>
                    <option value="samsung_white">Samsung White</option>
                    <option value="iphone_black">iphone Black</option>
                  </select> 
                </div>
              </div>
              <!------------------------>
              <?php } ?>
              
               <?php if (in_array("video_url2", $page_field)){?>
               <div class="control-group">
                <label class="control-label">Video/Slideshare URL 2</label>
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
              <?php } ?>
              <!------------------------>
              
         <?php if (in_array("scrolling", $page_field)){?>
             
             <div class="control-group">
                <label class="control-label">Scrolling</label>
                <div class="controls">
                  <select id="scrolling" name="scrolling">
                  	<option value="N0">No</option>
                    <option value="top">Top Scrolling</option>
                    <option value="left">Scrolling on Side</option>
                  </select> 
                </div>
              </div>
              <!------------------------>
              <?php } ?>
              
  		<?php if (in_array("scroll_top", $page_field)){?>
             
             <div class="control-group">
                <label class="control-label">Scrolling</label>
                <div class="controls">
                  <select id="scrolling" name="scrolling">
                  	<option value="N0">No</option>
                    <option value="top">Top Scrolling</option>
                  </select> 
                </div>
              </div>
              <!------------------------>
              <?php } ?>
            </div>
          </div>
            <div class="span12" style="margin-left:0px;">
                <div class="content-widgets gray">
                    <div class="widget-head orange">
                    <h3>After Registration Form</h3>
                    </div>
                    
                    <div class="widget-container">
                    
                        <div class="control-group">
                        	<label class="control-label">After Registration Form </label>
								<?php
                                $after_rg_status='';
                                if($result[0]['after_rg_status']=='Y'){$rg_status='checked="checked"';}
                                ?>
                            <div class="controls">
                            <input type="checkbox" id="chk" value="Y" name="after_rg_status" <?=$after_rg_status?> />
                            </div>
                        </div>
                        
                        <div class="control-group formvdo">
                            <label class="control-label">Video URL Form</label>
                            <div class="controls">
                            <input id="after_rg_link" name="after_rg_link" value="<?=$result[0]['after_rg_link']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                            <?php
                            $chk='';
                            if($result[0]['video1_autoplay']=='Y'){
                            $chk='checked="checked"';
                            }
                            ?>
                            <a href="#" class="open_popup" value="video" destination="after_rg_link"><i class="icon-facetime-video"></i></a>
                            </div>
                        </div>
                        
                        <div class="control-group formtxt">
                              <textarea name="after_rg_text" id="after_rg_text"><?=$result[0]['after_rg_text']?></textarea>
                                <script type="text/javascript">
                               
								CKEDITOR.replace( 'after_rg_text');
                                </script> 
                        </div>
                    
                    </div>
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
          
          </div>
          
      </div>
            <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Save</button>
            <a href="#" id="page_priview"><button type="button" class="btn btn-danger">Preview</button></a>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
            <a href="#" id="page_priview_reg"><button type="button" class="btn btn-danger aftreg">After Registration Preview</button></a>

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
<script>
  $(".formvdo").hide();
  $(".formtxt").hide();
  $(".aftreg").hide();
   
 $(document).ready(function() {
	$('#chk').change(function(){
        if (this.checked) {
            $('.formvdo').show();
			$('.formtxt').show();
			$('.aftreg').show();
        }
		else {
            $('.formvdo').hide();
			$('.formtxt').hide();
			$('.aftreg').hide();
        }   
                   
    }); 
});		
</script>