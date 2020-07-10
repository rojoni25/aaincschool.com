<div class="row">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Email</a> </li>
    <li class="active-bre"><a href="#"> Auto Responder Email</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
    <div class="tz-2-com tz-2-main">
      <h4>Auto Responder Email</h4>
    <!------------>
    <br>

    <div class="">
      <div class="col-md-12">
        <?php ?>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Type Email</th>
              <th>Email Subject</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
          <?=$html?>
          </tbody>
        </table>
        <?php ?>
        	<p class="textmsg"></p>
        <?php ?>
      </div>
    </div>
  </div>
</div>


<style>
.textmsg{
	font-size:18px;
	font-weight:bold;
}
</style>