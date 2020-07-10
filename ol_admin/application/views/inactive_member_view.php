<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": true,
		"sAjaxSource": "<?=base_url()?>index.php/user/listing_inactive",
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
		"iDisplayLength":100
	} );
} );

</script>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Free Member
       <a href="<?php echo base_url();?>index.php/export_excel/member/?r=Pending" style="float:right;" title="Export To Excel"><img src="<?php echo base_url();?>asset/images/excel-icon.png" width="30" /></a>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Free Member</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Username</th>
          <th>Password</th>
          <th>Mobile No</th>
          <th>Email Id</th>
          <th>Referral</th>
          <th>Referral Count</th>
           <th>Ref Page</th>
           <th>Join Date</th>
          <th>Update</th>
          <th>email verify</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
	function email_verify(id)
	{
		alert("User email verified");
		location.href = '<?php echo base_url(); ?>index.php/user/email_verify/'+id;  
	}
</script>
<style>
@media  only screen and (max-width: 760px),  (min-device-width: 768px) and (max-device-width: 1024px) {
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
	content: "Operation";
}
.membertable td:nth-of-type(2):before {
	content: "Name";
}
.membertable td:nth-of-type(3):before {
	content: "Mobile No";
}
.membertable td:nth-of-type(4):before {
	content: "Email Id";
}
.membertable td:nth-of-type(5):before {
	content: "Referral";
}
.membertable td:nth-of-type(6):before {
	content: "Update";
}
}
	
.membertable{
	overflow-x: auto;
}	
.no_verified{
	font-weight:bold;
	color:#F00;
}
.verified{
	font-weight:bold;
	color:#060;
}

</style>