<div class="row">    
  <ul class="top-banner"></ul>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Email</a> </li>
    <li class="active-bre"><a href="#"> Inbox</a> </li>
  </ul>
</div> 
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Inbox</h4>
    <br>    
    <div class="">
      <div class="col-md-12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
            	<th>Usercode</th>
            	<th>Name</th>
              <th>Time</th>
             	<th>Subject</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<style>
	sub{
		color:#F00;
	}
</style>
