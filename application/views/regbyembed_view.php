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
    <li class="active-bre"><a href="#"> Friend</a> </li>
    <li class="active-bre"><a href="#"> Network</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
    <div class="tz-2-com tz-2-main">
      <h4>Network</h4>
      <br>
    <style>
    	.pp{
  			overflow:hidden;
  		}
    </style>
    <div class="">
      <div class="col-md-12 membertable">
         <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th>Name</th>
              	<th>Username</th>
             	  <th>Capture Page</th>
              	<th>Phone No</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Skype</th>
                <th>Friends</th>
                <th>Verify</th>
                <th>Status</th>
                <th>Website URL</th>
                
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
@media  only screen and (max-width: 760px),  (min-device-width: 768px) and (max-device-width: 1100px) {

.membertable table, .membertable thead, .membertable tbody, .membertable th, .membertable td, .membertable tr {
	display: block;
}
.membertable thead tr {
	position: absolute;
	top: -9999px;
	left: -9999px;
}
.membertable tr {
	border: 1px solid #ccc;
}
.membertable td {
	border: none;
	border-bottom: 1px solid #eee;
	position: relative;
	padding-left: 50% !important;
}
.membertable td:before {
	position: absolute;
	top: 6px;
	left: 6px;
	width: 45%;
	padding-right: 10px;
	white-space: nowrap;
}
.membertable td:nth-of-type(1):before {
	content: "Name";
}
.membertable td:nth-of-type(2):before {
	content: "Username";
}
.membertable td:nth-of-type(3):before {
	content: "Capture Page";
}
.membertable td:nth-of-type(4):before {
	content: "Phone No";
}
.membertable td:nth-of-type(5):before {
	content: "Email";
}
.membertable td:nth-of-type(6):before {
	content: "Skype";
}
.membertable td:nth-of-type(7):before {
	content: "Friends";
}
.membertable td:nth-of-type(8):before {
	content: "Verify";
}
.membertable td:nth-of-type(9):before {
	content: "Status";
}
}
</style>