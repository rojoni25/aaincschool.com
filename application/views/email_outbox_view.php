<div class="row">  <div class="span12">    <ul class="top-banner"></ul></div></div>
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
    <li class="active-bre"><a href="#"> Outbox</a> </li>
  </ul>
</div> 
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Outbox</h4>
    <br>   
   
    <div class="">
        <div class="col-md-4 list_status_div">
      		<select id="select_status" class="select-dropdown">
            	<option value="">Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Delete">Delete</option>
          </select>
        </div>
        <div class="col-md-2 list_status_div">
          <button type="button" class="btn btn_aaply">Apply</button>
        </div>
    </div>
    <br><br>
    <div class="">  
      <div class="col-md-12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Operation</th>
              	<th>Date</th>
             	<th>Subject</th>
              	<th>Total Send</th>
                <th>Update</th>
            </tr>
          </thead>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

