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
    <li class="active-bre"><a href="#"> Friend</a> </li>
    <li class="active-bre"><a href="#"> Invite Friend</a> </li>
  </ul>
</div>
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>
      Invite Friend
      <?php
        $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
        $referralcount = countreferral($loginusercode);
        if($referralcount>=3){
      ?>
          <span class="pull-right">
            <a href="#" class="btn btn-primary btn-sm" style="padding: 5px;height: 30px;"><strong> Qualified</strong></a>
          </span>
      <?
        }else{
      ?>
          <span class="pull-right">
            <a href="#" class="btn btn-danger btn-sm" style="padding: 5px;height: 30px;"><strong>Not Qualified</strong></a>
          </span>
      <?    
        }
      ?>
      <?
    if($this->session->userdata['tbl']['current_account']=='Pending')
      {
      ?>
        <!--<span class="" style="color: #fff;padding-left: 10px;">-->
        <!--  <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> -->
        <!--  <span style="color: darkgoldenrod;font-size: 20px;">  Smart Wallet : </span>-->
        <!--  <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?></span>-->
        <!--</span>-->
        <span class="" style="color: #fff;padding-left: 30px;"> 
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?> /per month</span>
        </span>
      <?
      }else{
        $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
      ?>
        <span class="" style="color: #fff;padding-left: 10px;">
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=GetPaidReferalWallet($loginusercode)?></span>
        </span>
        <span class="" style="color: #fff;padding-left: 30px;"> 
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=getCapturePageWalletTotal($loginusercode)?> /per month</span>
        </span>
      <?  
      }
      ?>

    </h4>
    <div class="">
      <div class="col-md-12">
        <div class="primary-head text-right">
          <h3 style="margin: 10px 0;border-bottom: 1px solid #eee;padding-bottom: 8px;">
               <a style="" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invite_friends_history"><button type="button" class="btn btn-info btn_padding">Invite History</button></a> &nbsp;&nbsp;
               <a  class="view_friend" style="float:right;margin-right:10px;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/"><button type="button" class="btn btn-danger btn_padding">View Leads</button></a>
          </h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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
        }
            
        ?>
      </div>
      <div style="margin-top:30px;">
        <div class="txtdiv">
          <?=$contain[0]['textdt']?>
        </div>
        <div style="clear:both;overflow:hidden;"></div>
      </div>
    </div>
    <br>
    <div class="">
      <div class="col-md-12 hom-cre-acc-left hom-cre-acc-right">
     		<?php echo $this->session->flashdata('msg'); ?>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invitefriends_insertrecord">
        	 
          <input type="text" name="myInput" id="myInput" value="" style="display: none;" />
       		<input type="hidden" name="ref_link" id="ref_link" value="<?=$b_url?>" />
        	<input type="hidden" name="pagecode" id="pagecode" value="<?=$_REQUEST['page']?>" />
            <input type="hidden" name="current_url" id="current_url" value="<?=$current_url?>" />
            
             <div class="control-group">
            <label class="control-label">Link</label>
            <div class="controls" style="padding-top:5px;">
           
             <a href="<?=$b_url?>" target="_blank"><?=$b_url?></a> &nbsp;&nbsp;<button class="btn btn-danger btn-xs" onclick="return copyUrl('<?=$b_url?>')">Copy</button> 
            </div>
          </div>
          <!------------------>
           
          <div class="control-group">
            <label class="control-label">Name <span style="color: #d9534f;">*</span></label>
            <div class="controls">
              <input id="invite_name" name="invite_name" value="" class="span12 {validate:{required:true}}" required type="text" placeholder="Enter Your Friend Name"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">How did you meet this person?</label>
            <div class="controls">
              <input id="invite_contact" name="invite_contact" value="" class="span12"  type="text" placeholder="How did you meet this person?"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Phone <span style="color: #d9534f;">*</span></label>
            <div class="controls">
              <input id="invite_phone" name="invite_phone" value="" class="span12 {validate:{required:true}}" required type="text" placeholder="Enter Your Friend Phone"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Memory Notes</label>
            <div class="controls">
              <textarea id="invite_notes" name="invite_notes" class="span12" placeholder="Notes"></textarea>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Email Address <span style="color: #d9534f;">*</span></label>
            <div class="controls">
              <input id="invite_emailid" name="invite_emailid" value="" class="span12 {validate:{required:true}}" required type="email" placeholder="Enter Your Friend Email Address"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Subject <span style="color: #d9534f;">*</span></label>
            <div class="controls">
              <input id="subject" name="subject" value="" type="text" class="span12 {validate:{required:true}}" required placeholder="Enter Subject"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Message <span style="color: #d9534f;">*</span></label>
            <div class="controls">
            <textarea id="message" name="message" class="span12 {validate:{required:true}}" placeholder="Message"></textarea>
          <script type="text/javascript">
            CKEDITOR.replace( 'message',
            // {
            // toolbar :
            // [
            //   { name: 'basicstyles', items : [ 'Font', 'Colors','Bold','Italic','Underline','FontSize' ] },
            //   { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            //   { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            // ],
            // removePlugins: 'resize',
            // }
          );
          </script>
            </div>
          </div>
          
          <!-------------------->
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Send</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function copyUrl(url) {
    document.getElementById("myInput").value = url;
    var copyText = document.getElementById("myInput");
    copyText.style.display='block';
    copyText.select();
    document.execCommand("Copy");
    copyText.style.display='none';
    alert("Copied the text: " + copyText.value);
    return false;
  }
</script>
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
  .list_um{
    list-style:none;
    margin:0px;
    padding:0px;
    color:#369;
  }
  .list_um li{
    float:left;
    padding:2px 10px 10px 0px;
  }
@media  only screen and (max-width: 360px){
	.page-header {
    font-size: 20px;
	height:70px;
	}
	.view_friend{
		margin-top:5px;
		margin-left:45%;
		float:right;
	}
}
</style>