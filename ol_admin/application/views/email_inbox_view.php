<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Inbox</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Inbox</li>
        </ul>
      </div>
    </div>
    
   
    
    <div class="row-fluid">
      <div class="span12">
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

