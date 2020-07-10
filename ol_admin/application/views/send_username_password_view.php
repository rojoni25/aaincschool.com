<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		 "bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing_active"
	} );
} );

$(document).on('click', '.send_mail_cls', function (e) {
	e.preventDefault();
	var url 		= $(this).attr('href');
	var show_msg 	= $(this).closest('tr').find('.show_msg');
	show_msg.html('Sending..');
	$.ajax({url:url,success:function(result){
		show_msg.html(result);
    }});	
});
</script>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Send Username & Password</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Send Username & Password</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="3%">Id</th>
          <th>Name</th>
          <th width="15%">Username</th>
          <th width="15%">Password</th>
          <th>Email Id</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<style>
.sendbtn{
	border:none;
	padding:0px 10px;
}
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
.show_msg{
	color: #BD2323;
	margin-left: 5px;
}	

</style>
