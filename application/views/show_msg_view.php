<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header"><?=$title?></h3>
        </div>
       
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
       		<?=$title?>
      </div>
    </div>
<style>
	.msg{
		color:#F00;
		text-align:center;
	}
</style>
