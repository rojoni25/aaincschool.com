<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Outbox</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Outbox</li>
        </ul>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12 list_status_div">
      		<select id="select_status">
            	<option value="">Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Delete">Delete</option>
            </select>
            <button type="button" class="btn btn_aaply">Apply</button>
             
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Operation</th>
              	<th>Date</th>
             	<th>Subject</th>
              	<th>Total Send</th>
                <th>All Member</th>
                <th>Update</th>
            </tr>
          </thead>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>

