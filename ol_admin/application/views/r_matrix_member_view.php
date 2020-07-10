<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>	


<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing_active",
		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
		"fnDrawCallback": function (oSettings) {
    
		  ///////////
		  $('.show-pop-event').each(function(i,elem) {
				 		//webuiPopover
						var value=$(this).attr('href');
						$(this).webuiPopover({
							constrains: 'horizontal', 
							trigger:'click',
							multi: false,
							placement:'auto',
							type:'async',
							container: "body",
							url:'<?php echo base_url()?>index.php/<?=$this->uri->segment(1)?>/get_multi_position/'+value+'',
							cache:false,
								content: function(data){
								return data;
							}
						});
						//end webuiPopover
		});
		  //////////
     	}
		
	});
} );

</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">R-Matrix Member</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Memebr</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
            <th width="7%">Id</th>
            <th width="7%">Usercode</th>
            <th>Name</th>
            <th>RM Balance</th>
            <th>Coin Balance</th>
            <th>Position</th>
            <th>Email Id</th>
            <th>Upling</th>
            <th>Active Date</th>
            <th></th>         
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

.webui-popover {
	width:700px !important;
}
</style>