<?PHP
	$page_field=explode(',',$page_dt[0]['option']);
	
?>
<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">

<script>
	
		 $(document).on('click', '.open_popup', function (e) {
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
</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
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
			
			
		$(document).on('change','#filtercode',function(e){	
			var value=$(this).val();
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/get_capture_page_type/'+value;
			$.ajax({url:url,success:function(result){
				$('#pagecode').html(result);
			}});
			
		});
			$(document).on('change', '#pagecode', function (e) {
				e.preventDefault();
				
				var filtercode=$('#filtercode').val();
				var value=$(this).val();
				var url='<?php echo base_url()?>index.php/capture_pages/capture_pages_request/'+value+'/'+filtercode;
				window.location.href=url
			});
			
			
			$(document).on('click', '#page_priview', function (e) {
				e.preventDefault();
				var form = $('#form2');
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
			
</script>

<?php
	//var_dump($result);
?>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Request Capture Pages</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Page</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Request Capture Pages</li>
        </ul>
      </div>
    </div>
    <div style="margin-bottom:20px;">
    	
    </div>
    <div class="row-fluid">
      <div class="span6">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/capture_pages_request_insert" enctype="multipart/form-data">
        	<input type="hidden" name="priview_code" id="priview_code" value="<?=$priview_code?>" />
           <input type="hidden" name="master_page_code" id="master_page_code" 	value="<?=$page_dt[0]['pagename']?>" />
            
            
             <div class="control-group">
            <label class="control-label">Select Page Category</label>
            <div class="controls">
           	  <select name="filtercode" id="filtercode" class="span12">
                	<option value="">--Select--</option>
                    <?php for($i=0;$i<count($page_category);$i++){
							$sel=($page_category[$i]['capture_filter_code']==$this->uri->segment(4) ?"selected='selected'":"");
							echo '<option '.$sel.' value="'.$page_category[$i]['capture_filter_code'].'">'.$page_category[$i]['page_type'].'</option>';
					 }?>
                </select>
               
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label">Select Page Type</label>
            <div class="controls">
              	<select name="pagecode" id="pagecode" class="span12">
                	<option value="">--Select--</option>
                   
                      <?=$page_dt?>
                </select>
               
            </div>
          </div>
          
          <?php if(isset($page_dt[0])){?>
          
          
      		<div class="control-group">
                <label class="control-label">Page Name</label>
                <div class="controls">
                  <input id="page_name" name="page_name" value="" class="span12 {validate:{required:true}}" type="text" placeholder="Page Name"/>
                </div>
              </div>
              <!------------------------>
             
               <?php if (in_array("page_bg_img", $page_field)){?>
              <div class="control-group">
                <label class="control-label">Background Image Url</label>
                <div class="controls">
                  <input id="page_bg_img" name="page_bg_img" value="" class="span8 {validate:{}}" type="text" placeholder="Background Image Url"/>
                  <a href="#" class="open_popup" value="image" destination="page_bg_img"><i class="icon-picture"></i></a>
                </div>
              </div>
              <?php } ?>
              <!------------------------>
              
               <?php if (in_array("video_url1", $page_field)){?>
               <div class="control-group">
                <label class="control-label">Video URL 1(Main)</label>
                <div class="controls">
                  <input id="video_url1" name="video_url1" value="" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
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
              
               <?php if (in_array("video_url2", $page_field)){?>
               <div class="control-group">
                <label class="control-label">Video URL 2</label>
                <div class="controls">
                  <input id="video_url2" name="video_url2" value="" class="span8 {validate:{url:true}}" type="text" placeholder="Video Url"/>
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
              
              
              <div class="control-group">
                <label class="control-label">Headline Text</label>
                <div class="controls">
          		<input id="headline_text" name="headline_text" value="" class="span12 {validate:{required:true}}" type="text" placeholder="Headline Text"/>
                </div>
              </div>
             
              <!------------------------>
               
              <!------------------------>
              <?php if (in_array("main_body_text", $page_field)){?>
              <!------------------------>
              <div class="control-group">
                <label class="control-label">Main Body Text</label>
                <div class="controls">
                 <textarea name="main_body_text" id="main_body_text" class="span"></textarea>
          		
                </div>
              </div>
              <!------------------------>
              <?php } ?>
          
        
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Send Request</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
            <a href="#" id="page_priview"><button type="button" class="btn btn-danger">Priview</button></a>
          </div>
          <?php } ?>
        </form>
      </div>
      <div class="span6">
      	
        
        	<!------------------------------>
            <?php
                  if($contain[0]['video_url']!=''){
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($contain[0]['video_url'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
                  }?>
                  
                <?php if(isset($page_dt[0])){?>
      				<img src="<?=base_url()?>asset/capture_thum/<?=$page_dt[0]['thum_img']?>" style="margin-top:25px;" />
        		<?php } ?> 
            <!------------------------------>
        
      </div>
      
    </div>

<style>
	.btncls{
		border:none;
	}
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
	@media  only screen and (max-width: 1200px){
		.span6{
			float:none !important;
			width:100%;
		}
		
	}
@media  only screen and (max-width: 500px){

.video_frm {
   width: 284px;
height: 200px;
}

.inner_frm {
    height: 176px;
    width: 235px;
    margin-top: 12px;
    margin-left: 24px;
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
}


</style>

<script>
	function Checkfiles()
    {
		
        var fup = document.getElementById('post_img');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		
    	if(ext =="jpeg" ||  ext=="png"  || ext=="jpg")
    	{
        	return true;
   		}
    	else
    	{
        	alert("Upload jpeg,png,jpg Images only");
			fup.value="";
        	return false;
    	}
    }
</script>