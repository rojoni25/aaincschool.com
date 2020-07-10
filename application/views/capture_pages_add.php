<?php 
  $page_field=explode(',',$master_page[0]['option']);
  
	if($this->uri->segment(3)=='Add')
	{
		$pagecode	=	$master_page[0]['pagename'];	

	}
	else{
		$pagecode	=	$result[0]['pagecode'];	
	}
//print_r($result[0]['pagecode']); exit();
  $page_field_1 =$master_page[0]['pagename'];
  //print_r($page_field_1); exit();

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

<div class="row">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script> 
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
             var post_url = '<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insert_priview';
			 //alert(post_url);
			 //////////////
			 $.ajax({
             type: 'post',url: post_url,data: form.serialize(),
             success: function (result) {
				/****/
				var pagecode=$('#priview_code').val();
        console.log(pagecode);
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page_priview/'+pagecode+'';
				url=url.replace('ol_admin/', '')
				//alert(url);
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
				/****/

       if($("#after_reg_new_tab_op").prop("checked")){
          newwin1=window.open($("#after_reg_new_tab").val(),'', params);

          if (window.focus) {newwin1.focus()}
        }
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
            var post_url = '<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insert_priview';
            console.log(post_url);
			//////////////
			$.ajax({
             type: 'post',url: post_url,data: form.serialize(),
             success: function (result) {
				//////////////////
				var pagecode=$('#priview_code').val();
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/pages/reg_preview/'+pagecode+'';
			
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			

     
        
         

            
       if($("#after_reg_new_tab_op").prop("checked")){
          newwin1=window.open($("#after_reg_new_tab").val(),'', params);
        }
         if (window.focus) {newwin1.focus()}
            console.log(newwin1); 
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
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
     <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Master</a> </li>
    <li class="active-bre"><a href="#"> Capture Page</a> </li>
   
  </ul>
</div>
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Add <?php echo $cms[0]['pagename']; ?></h4>
    <div class="tz-2-main-com bot-sp-20">
      <div class="tz-2-com tz-2-main thumbnails-videos">
        <div class="split-row row">
            <?php
            $video_link = explode('||',$cms[0]['video_url']);
            for($i=0;$i<count($video_link);$i++){
              if($video_link[$i]!=''){
                $spep=$i+1;
                $cls=("");
                echo '<div class="col-md-6 '.$cls.'"><h3>Step '.$spep.'</h3>';
                echo '<div class="video_frm">';
                echo '<div class="inner_frm">';
                if (strpos($video_link[$i], 'youtube') !== false)
                {
                    echo '<iframe width="100%" height="100%" src="'.$video_link[$i].'" frameborder="0" allowfullscreen></iframe>';
                }
                else{
                    echo '<video width="100%" height="100%" controls="controls"><source src="'.$video_link[$i].'" type="video/mp4"></video>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            } 
          ?>
           <br><br>
        </div>
      </div>

      <!-- VIDEO DISPLAY -->
      <div class="hom-cre-acc-right">
        <div class="tz-2-com tz-2-main">
          <form class="form-horizontal" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data" style="background: none;border:none;padding: 0;">
            <input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
            <input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
            <input type="hidden" name="pagecode" id="pagecode" 	value="<?=$pagecode?>" />
            <input type="hidden" name="priview_code" id="priview_code" value="<?=$priview_code?>" />
            <br><br>
            <div class="split-row">
              <div class="col-md-6">
                <div class="box-inn-sp">
                  <div class="inn-title">
                    <h4>Page Style</h4>
                  </div>
                  <div class="tab-inn">
                      <!------------New Changes here (page Section, Change Permission, Title Background, Background, etc------------>
                    
                     
                  
                      
                    <!----------  Page Name -------------->             	
                    <div class="control-group">
                      <label class="control-label">Page Name</label>
                      <div class="controls">
                        <input id="page_name" name="page_name" value="<?=$result[0]['page_name']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Page Name"/>
                      </div>
                    </div>
                    <!------------------------>
                    
                     <!------////////------Title background----/////////------->
                    
                    <?php if( $page_field_1=='page32'){?>
                    <div class="control-group">
                      
                      <div class="controls">
                        <?php $head_bg='';
                            if($result[0]['head_bg']=='Y'){$head_bg='checked="checked"';}
                        ?>
                        <input type="checkbox" onclick="switch_col()" value="Y" name="head_bg" id="head_bg" <?=$head_bg?> class="filled-in"/>
                        <label class="cbx_label" for="head_bg">Title Background?</label>
                        
                      </div>
                    </div>
                   
                    <div class="control-group" id="title_col_hidden" <?php if($result[0]['head_bg']!='Y'){ echo 'style="display:none"';} ?>>
                      
                      <div class="controls">
                        <?php $head_bg_col='';
                            if($result[0]['head_bg']=='Y'){$head_bg_col='checked="checked"';}
                        ?>
                        <input type="minicolors" data-format="rgb" data-opacity=".5" value="rgba(255, 255, 255, 0.7)" id="head_bg_col" name="head_bg_col" <?=$head_bg_col?> />
                      </div>
                    </div>
                        <?php } ?>
                    
                    
                    <!--///////////// background color Page32-/////////////-->
                     <?php if($page_field_1=='page32'){?>
                          <div class="control-group">
                                            
                                            <div class="controls">
                                               <?php $background_bg='';
                                                  if($result[0]['background_bg']=='Y'){$background_bg='checked="checked"';}
                                                  ?>
                                               <input type="checkbox" onclick="switch_background_col()" value="Y" name="background_bg" id="background_bg" <?=$background_bg?> class="filled-in"/>
                                              <label class="cbx_label" for="background_bg">Background Color?</label>
                                            </div>
                                         </div>
                                         <div class="control-group" id="background_col_hidden" <?php if($result[0]['background_bg']!='Y'){ echo 'style="display:none"';} ?>>
                                           
                                            <div class="controls">
                                               <?php $head_bg_col='';
                                                  if($result[0]['background_bg']=='Y'){$background_bg_col='checked="checked"';}
                             if($result[0]['background_bg']=='Y'){
                              $background_col=$result[0]['background_bg_col'];
                              }else{
                              $background_col='rgba(255, 255, 255, 0.7)';
                             }
                                                  ?>
                                               <input type="minicolors" data-format="rgb" data-opacity=".5" value="<?=$background_col?>" id="background_bg_col" name="background_bg_col" <?=$background_bg_col?> />
                                            </div>
                                         </div>
                          <?php } ?>
                      
                    
                    
                    <!------------------------>
                    
                    
                    
                    <?php if (in_array("page_bg_img", $page_field)){
                    ?>
                    <div class="control-group">
                      <label class="control-label">Background Image Url</label>
                      <div class="controls">
                         <input id="page_bg_img" name="page_bg_img" value="<?=$result[0]['page_bg_img']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                         <a href="#" class="open_popup" value="image" destination="page_bg_img"><i class="fa fa-file-picture-o"></i></a>
                      </div>
                    </div>

                    <?php if ($page_field_1=='page1' || $page_field_1=='page2' || $page_field_1=='page3' || $page_field_1=='page22' || $page_field_1=='page23' || $page_field_1=='page24' || $page_field_1=='page25') { ?>
                    <div class="control-group">
                      <label class="control-label">Background Audio Url</label>
                      <div class="controls">
                         <input id="audio" name="audio" value="<?=$result[0]['audio']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background audio Url"/>
                         <a href="#" class="open_popup" value="audio" destination="audio"><i class="fa fa-file-audio-o" style="font-size:15px"></i></a>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    
                    
                       
                    <?php if ($page_field_1=='page31') { ?>
                     <!-- 1st img -->
                     <div class="control-group">
                        <label class="control-label">Background Image Url 1</label>
                        <div class="controls">
                           <input id="page_bg_img_1" name="page_bg_img_1" value="<?=$result[0]['page_bg_img_1']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                           <a href="#" class="open_popup" value="image" destination="page_bg_img_1"><i class="fa fa-file-picture-o"></i></a>
                        </div>
                     </div>
                     <!-- 2nd img -->
                     <div class="control-group">
                        <label class="control-label">Background Image Url 2</label>
                        <div class="controls">
                           <input id="page_bg_img_2" name="page_bg_img_2" value="<?=$result[0]['page_bg_img_2']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                           <a href="#" class="open_popup" value="image" destination="page_bg_img_2"><i class="fa fa-file-picture-o"></i></a>
                        </div>
                     </div>
                     <!-- 3rd img -->
                     <div class="control-group">
                        <label class="control-label">Background Image Url 3</label>
                        <div class="controls">
                           <input id="page_bg_img_3" name="page_bg_img_3" value="<?=$result[0]['page_bg_img_3']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                           <a href="#" class="open_popup" value="image" destination="page_bg_img_3"><i class="fa fa-file-picture-o"></i></a>
                        </div>
                     </div>
                     <!-- 4th img -->
                     <div class="control-group">
                        <label class="control-label">Background Image Url 4</label>
                        <div class="controls">
                           <input id="page_bg_img_4" name="page_bg_img_4" value="<?=$result[0]['page_bg_img_4']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background Image Url"/>
                           <a href="#" class="open_popup" value="image" destination="page_bg_img_4"><i class="fa fa-file-picture-o"></i></a>
                        </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label">Slideshare URL </label>
                        <div class="controls">
                           <input id="ppt" name="ppt" value="" class="span8 {validate:{url:true}}" type="text" placeholder="PPT Url"/>
                           <a href="#" class="open_popup" value="ppt" destination="ppt" style="font-size:18px"><i class="fa fa-file-powerpoint-o"></i></a>
                        </div>
                     </div>
                    <?php } ?>
                    <br>
                    <!--//////////////// end imgaes////////////////////// -->

                    <?php if (in_array("video_url1", $page_field) || in_array("video_url2", $page_field)){?>
                    <?php if ($page_field_1=='page4' || $page_field_1== 'page5' || $page_field_1== 'page6' || $page_field_1== 'page7' || $page_field_1== 'page8' || $page_field_1== 'page19' || $page_field_1== 'page20'|| $page_field_1== 'page21' || $page_field_1== 'page26' || $page_field_1== 'page27') { ?>
                      <div class="control-group">
                        <label class="control-label">Video Frame Type</label>
                        <div class="controls">
                           <select id="video_frame" name="video_frame">
                              <option value="flat_monitor" <? if($master_page[0]['video_frame'] == 'flat_monitor') echo 'selected'; ?>>Flat Monitor</option>
                              <option value="miphone" <? if($master_page[0]['video_frame'] == 'miphone') echo 'selected'; ?>>iPhone</option>
                              <option value="mflat_screen" <? if($master_page[0]['video_frame'] == 'mflat_screen') echo 'selected'; ?>>Flat Screen</option>
                              <option value="mipad" <? if($master_page[0]['video_frame'] == 'mipad') echo 'selected'; ?>>iPad</option>
                              <option value="mimac" <? if($master_page[0]['video_frame'] == 'mimac') echo 'selected'; ?>>iMac</option>
                              <option value="macbook_pro" <? if($master_page[0]['video_frame'] == 'macbook_pro') echo 'selected'; ?>>Macbook Pro</option>
                           </select>
                        </div>
                      </div>
                    <?php } ?>
                    <?php } ?>
                    
                    
                    <?php if (in_array("page_bg_video", $page_field)){?>
                           <div class="control-group">
                              <label class="control-label">Youtube Background Video</label>
                              <div class="controls">
                                 <input id="page_bg_video" name="page_bg_video" value="<?=$result[0]['page_bg_video']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                                 <?php if($result[0]['page_bg_video_mute']=='Y'){ 
                                    $mute='checked="checked"';
                                    } 
                                    ?>
                                 <a href="#" class="open_popup" value="video" destination="page_bg_video"><i class="fa fa-file-video-o"></i></a>
                                  
                                  <label> &nbsp;&nbsp; Mute : &nbsp;&nbsp;</label> <input type="checkbox" <?=$mute?> name="page_bg_video_mute" id="page_bg_video_mute" value="Y" class="filled-in"/> <label for="page_bg_video_mute" style="height: 12px;"></label>

                                  <label> &nbsp;&nbsp; Autoplay : &nbsp;&nbsp;</label><input type="checkbox" name="page_bg_video_autoplay_3" id="page_bg_video_autoplay_3" value="Y" checked="checked" class="filled-in"/><label for="page_bg_video_autoplay_3" style="height: 12px;"></label>

                                 

                              </div>
                           </div>
                    <?php } ?>
                    <?php if (in_array("bg_iframe", $page_field)){?>
                      <div class="control-group">
                        <label class="control-label" style="color:#F00;">https://</label>
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
                                 <a href="#" class="open_popup" value="<?php if($page_field_1 == "page9" || $page_field_1 == "page10" || $page_field_1 == "page17"){
                                    echo "ppt";
                                 }else{
                                    echo "video";
                                 }?>" destination="video_url1">
                                 <i class="<?php if($page_field_1 == "page9" || $page_field_1 == "page10" || $page_field_1 == "page17"){
                                    echo "icon-file";
                                 }else{
                                    echo "fa fa-file-video-o";
                                 }?>" style="font-size:12px"></i></a>
                                 <?php if (in_array("mute", $page_field)){
                                    if($result[0]['page_bg_video_mute']=='Y'){ 
                                    $mute='checked="checked"';
                                    } 
                                    ?>
                                 &nbsp;&nbsp; Mute : <input type="checkbox" <?=$mute?> name="page_bg_video_mute" id="page_bg_video_mute" value="Y" /> <label for="page_bg_video_mute" style="height: 12px;"></label>
                                 <?php } ?>
                                 <!-- autoplay video checkbox start-->
                               <?php if ($page_field_1=='page4' || $page_field_1== 'page5' || $page_field_1== 'page6' || $page_field_1== 'page7' || $page_field_1== 'page8' || $page_field_1== 'page11'|| $page_field_1== 'page12'|| $page_field_1== 'page13' || $page_field_1== 'page14' || $page_field_1== 'page16' || $page_field_1== 'page19' || $page_field_1== 'page20' || $page_field_1== 'page21'|| $page_field_1== 'page26' || $page_field_1== 'page27' ||  $page_field_1== 'page28' ||  $page_field_1== 'page29') { ?>
                                 <label> &nbsp;&nbsp; Autoplay : &nbsp;&nbsp;</label><input type="checkbox" name="page_bg_video_autoplay" id="page_bg_video_autoplay" value="Y" checked="checked" class="filled-in"/><label for="page_bg_video_autoplay" style="height: 12px;"></label>
                                 
                               <?php } ?>
                               
                               
                                
                                 <!-- autoplay video checkbox end-->
                              </div>
                           </div>
                    <?php } ?> <br>
                    <!------------------------>
                    <?php if($page_field_1=='page7'){ ?>
                    <?php if($this->session->userdata['logged_ol_member']['status'] !='Active'){ ?>
                          <div class="control-group">
                              <label class="control-label">Background Audio Url</label>
                              <div class="controls">
                                 <input id="audio_p7" name="audio_p7" value="<?=$result[0]['audio']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Background audio Url"/>
                                 <a href="#" class="open_popup" value="audio_p7" destination="audio_p7"><i class="fa fa-file-audio-o" style="font-size:15px"></i></a>
                                 <label> &nbsp;&nbsp; Mute : &nbsp;&nbsp;</label><input type="checkbox" name="page_bg_video_mute" id="page_bg_video_mute" value="Y" checked="checked"/><label for="page_bg_video_mute" style="height: 12px;"></label>

                              </div>
                          </div>
                    <?php } ?>
                    <?php } ?>
                    <?php if (in_array("video_url2", $page_field)){?>
                           <div class="control-group">
                              <label class="control-label">Video/Slideshare URL 2</label>
                              <div class="controls">
                                 <input id="video_url2" name="video_url2" value="<?=$result[0]['video_url2']?>" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
                                 <?php
                                    $chk='';
                                    if($result[0]['page_bg_video_autoplay_2']=='Y'){
                                    $chk='checked="checked"';
                                    }
                                    ?>
                                 <a href="#" class="open_popup" value="video" destination="video_url2"><i class="fa fa-file-video-o"></i></a>

                                 <label> &nbsp;&nbsp; Autoplay : &nbsp;&nbsp;</label><input type="checkbox" name="page_bg_video_autoplay_2" id="page_bg_video_autoplay_2" value="Y" checked="checked" class="filled-in"/><label for="page_bg_video_autoplay_2" style="height: 12px;"></label>
                              </div>
                           </div>
                          
                    <?php } ?>
                    
                    
                    <!-- /////////////  Video checkbox   /////////////// -->
                    
                    <?php if($page_field_1=='page1' || $page_field_1=='page8'|| $page_field_1=='page7' || $page_field_1=='page16' || $page_field_1=='page28' || $page_field_1=='page32'){?>
					 <div class="control-group">
					     
					     <div class="controls">
                              <input type="checkbox" onclick="switch_video_col()" value="Y" name="video_bg" id="video_bg" class="filled-in">
                                <label class="cbx_label" for="video_bg">Video Background?</label>
                        </div>
					     
                     </div>
                     <div class="control-group" id="video_col_hidden" <?php if($result[0]['video_bg']!='Y'){ echo 'style="display:none"';} ?>>
                        
                        <div class="controls">
                           <?php $head_bg_col='';
                              if($result[0]['video_bg']=='Y'){$video_bg_col='checked="checked"';}
							  if($result[0]['video_bg']=='Y'){
								  $video_col=$result[0]['video_bg_col'];
								  }else{
								  $video_col='rgba(255, 255, 255, 0.7)';
							  }
                              ?>
                           <input type="minicolors" data-format="rgb" data-opacity=".5" value="<?=$video_col?>" id="video_bg_col" name="video_bg_col" <?=$video_bg_col?> />
                        </div>
                     </div>
					 <?php } ?> <br>
					 
                    <!--  ///         Form Checkbox  Background////         -->
                    
                    <?php if($page_field_1=='page1' || $page_field_1=='page8'|| $page_field_1=='page7' || $page_field_1=='page16' || $page_field_1=='page28' || $page_field_1=='page32'){?>
                    <div class="control-group">
					     <?php $form_bg='';
                              if($result[0]['form_bg']=='Y'){$form_bg='checked="checked"';}
                              ?>
					     <div class="controls">
                               <input type="checkbox" onclick="switch_form_col()" value="Y" name="form_bg" id="form_bg" <?=$form_bg?> class="filled-in" />
                           <label class="cbx_label" for="form_bg" >Form Background?</label>
                        </div>
					     
                     </div>
					 
                     <div class="control-group" id="form_col_hidden" <?php if($result[0]['form_bg']!='Y'){ echo 'style="display:none"';} ?>>
                       
                        <div class="controls">
                            
                           <?php $form_bg_col='';
                              if($result[0]['form_bg']=='Y'){$form_bg_col='checked="checked"';}
							  if($result[0]['form_bg']=='Y'){
								  $form_col=$result[0]['form_bg_col'];
								  }else{
								  $form_col='rgba(255, 255, 255, 0.7)';
							  }
                              ?>
                           <input type="minicolors" data-format="rgb" data-opacity=".5" value="<?=$form_col?>" id="form_bg_col" name="form_bg_col" <?=$form_bg_col?> />
                        </div>
                     </div>
					 <?php } ?>
                    
                    
                    	 <!---------- Form Title --------------> 
					 
					 
					 <?php if($page_field_1=='page32'|| $page_field_1=='page28'){?>
					       <div class="control-group">
                        <label class="control-label">Form Title</label>
                        <div class="controls">
                           <select id="page_for_form_title" name="page_for_form_title">
                              <option <?=$register_form?> value="Registere Now!">Registere Now!</option>
                              <option <?=$free_tour_form?> value="Take A Free Tour Now!">Take A Free Tour Now!</option>
                              <option <?=$custom_form?> value="false">Custom</option>
                           </select>
                        </div>
                     </div>
                     <!------------------------> 
                     <!------------------------>

                     <div class="control-group form_title_cb" style="display: <?=$result[0]['form_title']!=''?'block':'none'?>">
                        <label class="control-label">Form Custom Title</label>
                        <div class="controls">
                           <input id="form_title" name="form_title" value="<?=$result[0]['form_title']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Form Custom Title"/>
                        </div>
                     </div>
					<?php } ?>
					 
                    
                    
                    <!-- Submit background -->
                    
                    <?php if($page_field_1=='page32'){?>
					 <div class="control-group">
                        
                        <div class="controls">
                           <?php $submit_bg='';
                              if($result[0]['submit_bg']=='Y'){$submit_bg='checked="checked"';}
							  if($result[0]['submit_bg']=='Y'){
								  $submit_col=$result[0]['submit_bg_col'];
								  }else{
								  $submit_col='rgba(255, 255, 255, 0.7)';
							  }
                              ?>
                           <input type="checkbox" onclick="switch_submit_col()" value="Y" name="submit_bg" id="submit_bg" <?=$submit_bg?> class="filled-in" />
                           <label class="cbx_label" for="submit_bg">Submit Background?</label>
                        </div>
                     </div>
                     <div class="control-group" id="submit_col_hidden" <?php if($result[0]['submit_bg']!='Y'){ echo 'style="display:none"';} ?>>
                        
                        <div class="controls">
                           <?php $submit_bg_col='';
                              if($result[0]['submit_bg']=='Y'){$submit_bg_col='checked="checked"';}
                              ?>
                           <input type="minicolors" data-format="rgb" data-opacity=".5" value="<?=$submit_col?>" id="submit_bg_col" name="submit_bg_col" <?=$submit_bg_col?> />
                        </div>
                     </div>
					 <?php } ?>
                       
                       
                       <!-- Submit Title -->
                     <div class="control-group">
                        <label class="control-label">Submit Button Title</label>
                        <div class="controls">
                           <select id="page_for_submit_button_title" name="page_for_submit_button_title">
                              <option <?=$register?> value="Registere Now!">Registere Now!</option>
                              <option <?=$free_tour?> value="Take A Free Tour Now!">Take A Free Tour Now!</option>
                              <option <?=$custom?> value="false">Custom</option>
                           </select>
                        </div>
                     </div>
                     <!------------------------> 
                     <!------------------------>
                     <div class="control-group submit_button_title_cb" style="display: <?=$result[0]['submit_button_title']!=''?'block':'none'?>">
                        <label class="control-label">Submit Button Custom Title</label>
                        <div class="controls">
                           <input id="submit_button_title" name="submit_button_title" value="<?=$result[0]['submit_button_title']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Submit Button Custom Title"/>
                        </div>
                     </div>
                     
                     
                     <!-----------Scrolling-------------> 
                    
                   

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
                    
                <?php }?>
                    <!----------Scrolling-------------->
                    
                    
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
                        <div class="control-group">
                          <label class="control-label">New Tab URL? </label>
                            <div class="controls">
                              <?php $after_reg_new_tab_op='';
                              if($result[0]['after_reg_new_tab_op']=='Y'){$after_reg_new_tab_op='checked="checked"';}
                              ?>
                              <input type="checkbox" name="after_reg_new_tab_op" value="Y" id="after_reg_new_tab_op" <?=$after_reg_new_tab_op?> class="filled-in"><label for="after_reg_new_tab_op"></label>
                            </div>
                        </div>

                        <div class="control-group" id="after_reg_new_tab_div" style="display: none">
                          <label class="control-label">Enter URL </label>
                          <div class="controls">
                            
                            <input type="text" id="after_reg_new_tab" name="after_reg_new_tab" placeholder="url" value="<?=$result[0]['after_reg_new_tab']?>" >
                          </div>
                          <label style="color: red;">(https://)</label>

                          <span id="redirect_url_preview" style="display: none">
                          <a style="" id="redirect_url_href" target="_blank" href="">Preview Enter URL</a></span>
                        </div>
                        <div class="control-group" style="display: none" id="after_reg_new_tab_div">
                          <label class="control-label">New Tab URL </label>
                            <div class="controls">
                              <input type="checkbox" name="after_reg_new_tab" value="Y" id="after_reg_new_tab" class="filled-in"><label for="after_reg_new_tab"></label>
                            </div>
                        </div>
                  </div>
                </div>
                <div class="box-inn-sp">
                    <div class="inn-title">
                      <h4>After Registration Form</h4>
                    </div>  
                    <div class="tab-inn">
                        <div class="control-group">
                        	<label class="control-label">After Registration Form </label>
								            <?php
                            $after_rg_status='';
                            if($result[0]['after_rg_status']=='Y'){$rg_status='checked="checked"';}
                            ?>
                            <div class="controls">
                                <input type="checkbox" id="chk" value="Y" name="after_rg_status" <?=$after_rg_status?> class="filled-in"/> <label for="chk"></label>
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
             
              <div class="col-md-6">
                  <div class="box-inn-sp">
                    <div class="inn-title">
                      <h4>Page Contain</h4>
                    </div>
                    <div class="tab-inn">
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
                                  { name: 'basicstyles', items : [ 'Font', 'Colors','Bold','Italic','Underline','FontSize' ] },
                                  { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                                  { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
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
                                { name: 'basicstyles', items : [ 'Font', 'Colors','Bold','Italic','Underline','FontSize' ] },
                                { name: 'paragraph', items : [ 'NumberedList','BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                                { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
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
            <div class="split-row">
              <div class="col-md-12">
                <div class="form-actions">
                      <?php //if($this->session->userdata['logged_ol_member']['status']=='Active'){ ?>
                      <button type="submit" class="btn btn-primary btnsubmit">Save</button>
                      <?php //} ?>
                      <a href="#" id="page_priview"><button type="button" class="btn btn-danger">Preview</button></a>
                      <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/page_thum_list/Add"><button type="button" class="btn">Cancel</button></a>
                      <a href="#" id="page_priview_reg"><button type="button" class="btn btn-danger aftreg">After Registration Preview</button></a>
                </div>
              </div>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script src='<?php echo base_url(); ?>asset/color/spectrum.js'></script>
<link rel='stylesheet' href='<?php echo base_url(); ?>asset/color/spectrum.css' />

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
	.cbx_label{
	    font-size:1.5em !important;
	    margin-bottom:8px !important;
	}
</style>

<style>
  
  .btncls{
    border:none;
  }
  .step_div{
     width: 467px;
    display: inline-block;
  }
  .step_div h2{
    font-size:16px;
    text-align:center;
    margin:9px;
    padding:0px;
    margin-top:10px;
    line-height:25px;
  }
  .span12.thumbnails-videos {
    
    width: 900px;
    overflow-x: auto;
    white-space: nowrap;

}

/*.row-scoller {
    overflow-x: auto;
}*/
  .video_frm{
    width: 473px;
    height: 333px;
    overflow:hidden;
    margin:auto;
    background-image:url(<?=base_url();?>asset/images/cap_frm.png);
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    margin-bottom:15px;
  }
  .inner_frm{
    height: 291px;
    width: 390px;
    margin-top: 20px;
    margin-left: 40px;
  }
  .txtdiv{
    width:90%;
    position:relative;
    margin:auto;
  }
  .margin_none{
    margin: 9px !important;
  }
  @media only screen and (max-width: 1200px) {
  .video_frm{
    width: 325px;
    height: 229px;
  }
  .inner_frm{
    height: 202px;
    width: 268px;
    margin-left: 28px;
    margin-top: 13px;
  }
  }
@media  only screen and (max-width: 535px){

.video_frm {
   width: 278px;
  height: 196px;
}

.inner_frm {
    height: 173px;
    width: 230px;
    margin-top: 12px;
    margin-left: 24px;
}
.txtdiv h2{
  font-size:20px !important;
  line-height:25px !important;
}

}
  @media  only screen and (max-width: 310px){
.video_frm {
    width: 190px;
    height: 134px;
}

.inner_frm {
    height: 118px;
width: 157px;
margin-top: 8px;
margin-left: 16px;
}
.txtdiv h2{
  font-size:15px !important;
}
}

.btnlist .btn {
    padding: 2px 12px !important;
}

</style>
<script>
  $(".formvdo").hide();
  $(".formtxt").hide();
  $(".aftreg").hide();
   
 $(document).ready(function() {

  if($("#after_reg_new_tab_op").prop("checked")){
      $('#after_reg_new_tab_div').css('display', 'block');
    }else{
      $('#after_reg_new_tab_div').css('display', 'none');
    }

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

  $("#after_reg_new_tab_op").change(function() {
    $("#after_reg_new_tab").val("");
    if($(this).prop("checked")){
      $('#after_reg_new_tab_div').css('display', 'block');
    }else{
      $('#after_reg_new_tab_div').css('display', 'none');
    }
  });

  //for priview enter url link.
$('#after_reg_new_tab').keyup(function(){
   if($(this).val()==''){
     $('#redirect_url_preview').css('display', 'none');
   } else{
     $('#redirect_url_preview').css('display', 'block');
     $('#redirect_url_href').attr('href', $(this).val());
   }
   })

});
</script>

<script type="text/javascript">
  function switch_col(){
  var checked=$('#head_bg').is(':checked');
  if(checked){
    $('#title_col_hidden').css('display', 'block');
  } else{
    $('#title_col_hidden').css('display', 'none');
  }
 }

 //$('#head_bg_col').minicolors();
$("#head_bg_col").spectrum({
  showAlpha: true,
  preferredFormat: "rgba",
  showInput: true,
  change: function(color) {
    var rgba=color.toRgb();
    var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
      $('#head_bg_col').val(str);
      //$("#head_bg_col").spectrum("set", color.toHex8());
  }
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
             // check for custom submit title or not
               if($('#submit_button_title').val().trim() == ""){
                    $('#submit_button_title').val($('#page_for_submit_button_title').val());
               }
			   if($('#page_for_form_title').val()){
				   if($('#form_title').val().trim() == ""){ //Jay update
						$('#form_title').val($('#page_for_form_title').val());
				   } //By JAY update
			   }
       //////////////
       $.ajax({
               type: 'post',url: post_url,data: form.serialize(),
               success: function (result) {
        // /****/ console.log(result); return false;
        
        var pagecode=$('#priview_code').val();
        params  = 'width='+screen.width;
        params += ', height='+screen.height;
        params += ', top=0, left=0'
        params += ', fullscreen=yes';
        var url='<?php echo base_url();?>index.php/capture/page_priview/'+pagecode+'';
        url=url.replace('ol_admin/', '')
        
        newwin=window.open(url,'', params);
        if (window.focus) {newwin.focus()}
   
             if($("#after_reg_new_tab_op").prop("checked")){
            newwin1=window.open($("#after_reg_new_tab").val(),'', params);
           
          }
        
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
        var url='<?php echo base_url();?>index.php/pages/reg_preview/'+pagecode+'';
        url=url.replace('ol_admin/', '')
        
          newwin=window.open(url,'', params);
        if (window.focus) {newwin.focus()}
        /****/

       if($("#after_reg_new_tab_op").prop("checked")){
          newwin1=window.open($("#after_reg_new_tab").val(),'', params);
          if (window.focus) {newwin1.focus()}
        }
        /****/
               }
             });
      /////////////
    });  
    /////////////////////
    $(document).on('click', '.open_popup', function (e) {
      var value     = $(this).attr('value');
      mediaid     = $(this).attr('destination');
      
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
<script>
   $(".formvdo").hide();
   $(".formtxt").hide();
   $(".aftreg").hide();
    
   $(document).ready(function() {

    if($("#after_reg_new_tab_op").prop("checked")){
      $('#after_reg_new_tab_div').css('display', 'block');
    }else{
      $('#after_reg_new_tab_div').css('display', 'none');
    }

   // submit button title custom input toggle function start
   $('#page_for_submit_button_title').on('change', function() {
       if(this.value == 'false'){
           $('#submit_button_title').val("");
           $('.submit_button_title_cb').css("display",'block');
       }else{
           $('#submit_button_title').val("");
           $('.submit_button_title_cb').css("display",'none');
       }
   });
   // submit button title custom input toggle function end
   
    // Form title custom input toggle function start
   $('#page_for_form_title').on('change', function() {
       if(this.value == 'false'){
           $('#form_title').val("");
           $('.form_title_cb').css("display",'block');
       }else{
           $('#form_title').val("");
           $('.form_title_cb').css("display",'none');
       }
   });
   // Form title custom input toggle function end
   
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
   
   $("#after_reg_new_tab_op").change(function() {
     $("#after_reg_new_tab").val("");
     if($(this).prop("checked")){
       $('#after_reg_new_tab_div').css('display', 'block');
     }else{
       $('#after_reg_new_tab_div').css('display', 'none');
     }
   });
   
   });    
   
   function switch_col(){
   var checked=$('#head_bg').is(':checked');
   if(checked){
     $('#title_col_hidden').css('display', 'block');
   } else{
     $('#title_col_hidden').css('display', 'none');
   }
   }
   
   //$('#head_bg_col').minicolors();
   $("#head_bg_col").spectrum({
   showAlpha: true,
   preferredFormat: "rgba",
   showInput: true,
   change: function(color) {
     console.log(color);
     var rgba=color.toRgb();
     var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
       $('#head_bg_col').val(str);
       //$("#head_bg_col").spectrum("set", color.toHex8());
   }
   });
   
   //Code by Jay//
   function switch_background_col(){
	   var checked=$('#background_bg').is(':checked');
	   if(checked){
		 //$("#background_bg").val("Y");
		 $('#background_col_hidden').css('display', 'block');
	   } else{
		   //$("#background_bg").val("N");
		 $('#background_col_hidden').css('display', 'none');
	   }
   }
   
   function switch_video_col(){
	   var checked=$('#video_bg').is(':checked');
	   if(checked){
		    //$("#video_bg").val("Y");
		 $('#video_col_hidden').css('display', 'block');
	   } else{
		   //$("#video_bg").val("N");
		 $('#video_col_hidden').css('display', 'none');
	   }
   }
   
   function switch_form_col(){
	   var checked=$('#form_bg').is(':checked');
	   if(checked){
		    
		 $('#form_col_hidden').css('display', 'block');
	   } else{
		   
		 $('#form_col_hidden').css('display', 'none');
	   }
   }
   
   function switch_submit_col(){
	   var checked=$('#submit_bg').is(':checked');
	   if(checked){
		   
		 $('#submit_col_hidden').css('display', 'block');
	   } else{
		   
		 $('#submit_col_hidden').css('display', 'none');
	   }
   }
   
   //$('#head_bg_col').minicolors();
   $("#head_bg_col").spectrum({
 	  showAlpha: true,
  	 preferredFormat: "rgba",
   	showInput: true,
  	 change: function(color) {
     		console.log(color);
    		 var rgba=color.toRgb();
     		var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
      		 $('#head_bg_col').val(str);
       
 	  }
   });
   
   


$("#background_bg_col").spectrum({
   	showAlpha: true,
  	 preferredFormat: "rgba",
   	showInput: true,
   	change: function(color) {
     		console.log(color);
    		 var rgba=color.toRgb();
    		 var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
     		  $('#background_bg_col').val(str);

   }
   });
   
   $("#video_bg_col").spectrum({
  	 showAlpha: true,
  	 preferredFormat: "rgba",
  	 showInput: true,
   change: function(color) {
    	 console.log(color);
   	  var rgba=color.toRgb();
    	 var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
     	  $('#video_bg_col').val(str);
      	 //$("#head_bg_col").spectrum("set", color.toHex8());
   }
   });
   
   $("#form_bg_col").spectrum({
   showAlpha: true,
   	preferredFormat: "rgba",
   	showInput: true,
  	 change: function(color) {
   	  var rgba=color.toRgb();
  	   var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
    	   $('#form_bg_col').val(str);
     	  //$("#head_bg_col").spectrum("set", color.toHex8());
 	  }
   });
   
   $("#submit_bg_col").spectrum({
   	showAlpha: true,
   	preferredFormat: "rgba",
 	  showInput: true,
  	 change: function(color) {
     		var rgba=color.toRgb();
     		var str="rgba("+rgba.r+", "+rgba.g+", "+rgba.b+", "+rgba.a+")";
      		 $('#submit_bg_col').val(str);
       	//$("#head_bg_col").spectrum("set", color.toHex8());
  	 }
   });


   $('#redirect_url').keyup(function(){
   if($(this).val()==''){
     $('#redirect_url_preview').css('display', 'none');
   } else{
     $('#redirect_url_preview').css('display', 'block');
     $('#redirect_url_href').attr('href', $(this).val());
   }
   })
</script>
