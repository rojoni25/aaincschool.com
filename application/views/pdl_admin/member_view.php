<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": true,
		"sAjaxSource": "<?=base_url('index.php/pdl/')?><?=$this->uri->rsegment(1)?>/member_list",
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]]
	});
} );

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PDL Member List</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member List</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="5%">Usercode</th>
          <th width="7%">Subscription Id</th>
          <th width="10%">Name</th>
          <th width="7%">Username</th>
          <th width="7%">Join Date</th>
          <th width="7%">Due Date</th>
          <th width="5%">Total Subscribe</th>
          <th width="10%">PDL-W.1</th>
          <th width="10%">PDL-W.2</th>
           <th width="10%">Ref. W.</th>
          <th width="15%"></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
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
	content: "Usercode";
}
.membertable td:nth-of-type(2):before {
	content: "Subscription";
}
.membertable td:nth-of-type(3):before {
	content: "Name";
}
.membertable td:nth-of-type(4):before {
	content: "Username";
}
.membertable td:nth-of-type(5):before {
	content: "Join Date";
}
.membertable td:nth-of-type(6):before {
	content: "Due Date";
}
.membertable td:nth-of-type(7):before {
	content: "Total Subscribe";
}
.membertable td:nth-of-type(8):before {
	content: "PDL-W.1";
}
.membertable td:nth-of-type(9):before {
	content: "PDL-W.2";
}
.membertable td:nth-of-type(10):before {
	content: "Ref-W.";
}
.membertable td:nth-of-type(11):before {
	content: "Opration";
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