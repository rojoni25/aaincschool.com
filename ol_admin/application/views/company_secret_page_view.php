<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Company Secret Page</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Page</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Company Secret page</li>
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
    <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/addnew/Add">
    <button type="button" class="btn btn-info btn_padding">Add New</button>
    </a> </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Operation</th>
          <th>Page Name</th>
          <th>Page Title</th>
          <th>Page Key</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
