<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Friend List
           	<a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invitefriends"><button type="button" class="btn btn-info btn_padding">Invite Friend</button></a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Friend</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Friend List</li>
        </ul>
      </div>
    </div>
    
   
    
    <div class="row-fluid">
      <div class="span12 tblover">
         <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Usercode</th>
              	<th>Name</th>
             	<th>Mobile No</th>
              	<th>Email Id</th>
                <th>Verified</th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>

<style>
	.tblover{
		overflow-x: auto;
	}
</style>