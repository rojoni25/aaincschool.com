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
  <ul class="top-banner"></ul>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<script src="<?php echo base_url();?>/ckeditor/ckeditor.js"></script> 
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
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Master</a> </li>
    <li class="active-bre"><a href="#"> Opportunity</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Opportunity <?=$this->uri->segment(3)?></h4>
    <div class="row">
      <div class="col-md-12 add-opportunity-form ">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$eid?>" />
           <!---------------->
          <div class="form-group ">
            <label class="control-label">Company Name</label>
              <input id="company_name" name="company_name" value="<?=$result[0]['company_name']?>" class="span12 {validate:{required:true}} form-control" type="text" placeholder="Enter Company Name"/>
         
          </div>

          <!---------------->
          <div class="form-group">
            <label class="control-label dsc-label-oprt">Company Short Description</label>
              <textarea id="short_desc" rows="3" name="short_desc" class="span12 {validate:{required:true}} form-control"><?=$result[0]['short_desc']?></textarea>
          </div>
          	
          <!------------------>
           <!---------------->
          <div class="form-group">
            <label class="control-label">Referral Url<br>
              <span id="redirect_url_preview" style="display: block">
                  <a style="color:Red" id="redirect_url_href" target="_blank" href="<?=$result[0]['refurl']?>">Preview Referral URL</a>
              </span>
            </label>
             
              <input id="refurl" name="refurl" value="<?=$result[0]['refurl']?>" class="span12 {validate:{required:true}} form-control" type="text" placeholder="Referral Url"/>
           
          </div>
            <p>Option-1 "https://www.urlname.com?refCode=<font style="font-weight:bold;color:#F00;">membercode</font>" ('membercode' Replace With referral id)<br /> 
                Option-2 "https://www.<font style="font-weight:bold;color:#F00;">membercode</font>.urlname.com ('membercode' Replace With referral id)</p>
          <div class="form-group">
            <label class="control-label">Video 1</label>
               <input id="video_url1" name="video_url1" value="<?=$result[0]['video_url1']?>" class="span8 {validate:{url:true}} form-control" type="text" placeholder="Video Url"/>
               <a href="#" class="open_popup" value="video" destination="video_url1">
               <i class="icon-facetime-video" style="font-size:12px"></i></a>
          </div>

          <div class="form-group">
            <label class="control-label">Video 2</label>
               <input id="video_url2" name="video_url2" value="<?=$result[0]['video_url2']?>" class="span8 {validate:{url:true}} form-control" type="text" placeholder="Video Url"/>
               <a href="#" class="open_popup" value="video" destination="video_url2">
               <i class="icon-facetime-video" style="font-size:12px"></i></a>
          </div>

          <div class="form-group">
            <label class="control-label">Video 3</label>
               <input id="video_url3" name="video_url3" value="<?=$result[0]['video_url3']?>" class="span8 {validate:{url:true}} form-control" type="text" placeholder="Video Url"/>
               <a href="#" class="open_popup" value="video" destination="video_url3">
               <i class="icon-facetime-video" style="font-size:12px"></i></a>
          </div>	
          <!------------------>
          <!---------------->
          	
          <!------------------>
          <div class="form-group">
            <label class="control-label">Company Logo</label>

                <?php if($result[0]['logo']!=''){?>
                		<img src="<?=base_url();?>upload/company/<?=$result[0]['logo']?>" width="50" />
                <?php } ?>
                <input type="file" name="post_img" id="post_img" class="span4 form-control" value=""/>
          </div>
          <!------------------->
        
          <div class="form-group">
            <label class="control-label">Opportunity Page Name</label>
              <input id="pagename" name="pagename" value="<?=$result[0]['pagename']?>" class="span12 {validate:{required:true}} form-control" type="text" placeholder="Opportunity Page Name"/>
          </div>
          
          <div class="form-group">
            <label class="control-label">Status</label>
              	<select id="status2" class="form-control" name="status">
                <?php
                	if($result[0]['status']=='Active'){
          						$sel1='selected="selected"';
          					}
          					if($result[0]['status']=='Inactive'){
          						$sel2='selected="selected"';
          					}
          				?>
                	<option <?=$sel1?> value="Active">Active</option>
                  <option <?=$sel2?> value="Inactive">Inactive</option>
                </select>
          </div><br>
          <!------------------>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/pages_list"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>
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
    <script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click', '.open_popup', function (e) {
          var $ =jQuery.noConflict();
          var value     = $(this).attr('value');
          mediaid     = $(this).attr('destination');
          var url='<?php echo base_url();?>index.php/capture_pages/openpopup/?type='+value;
          e.preventDefault();
          $.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
        });
      
        $(document).on('click', '.popup-modal-dismiss', function (e) {
          e.preventDefault();
          $.magnificPopup.close();
        });
      });

       $('#refurl').keyup(function(){
        if($(this).val()==''){
          $('#redirect_url_preview').css('display', 'none');
        } else{
          $('#redirect_url_preview').css('display', 'block');
          $('#redirect_url_href').attr('href', $(this).val());
        }
      });
    </script>
