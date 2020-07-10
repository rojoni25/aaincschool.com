	<script>
    	$(document).on('click','.manual_payment',function(e){
			e.preventDefault();
			var url=$(this).attr('href');
			var tr=$(this).closest('tr');
			$(this).closest('td').html('Processing..');
		
			$.ajax({url:url,success:function(result){
				tr.remove();
			}});
			
			
		});
    </script>


<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<?=kdk_admin_menu();?>

<p class="show_msg"></p>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Cycle Mannual Paymentr</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Cycle Mannual Payment</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
            <th width="20%">Position</th>
            <th width="10%">Usercode</th>
            
            <th width="30%">Member Name</th>
            <th width="15%">Third Level Member</th>
            <th width="15%">Opration</th>
        </tr>
        <?php for($i=0;$i<count($result);$i++){
			echo '<tr>
					<td>'.$result[$i]['idcode'].'</td>
					<td>'.$result[$i]['usercode'].'</td>
					<td>'.$result[$i]['name'].'</td>
					<td>'.$result[$i]['tot'].'</td>
					<td><a class="manual_payment" href="'.base_url().'index.php/r_matrix/manual_payment/'.$result[$i]['idcode'].'"><span class="label label-important">Manual Pay</span></a></td>
				</tr>';
		}?>
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
.inner_div_popup{
	max-height:400px;
	overflow:auto;
}
</style>