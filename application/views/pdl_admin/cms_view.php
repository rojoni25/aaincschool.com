
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PDL CMS Page</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">CMS Page</li>
    </ul>
  </div>
</div>


<?php if($this->session->flashdata('show_msg')!='') {?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div> 
<?php } ?>   

<div class="row-fluid">
  <div class="span12">
  
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="5%">Sr</th>
          <th width="25%">Page</th>
          <th width="25%">Page Title</th>
           <th width="25%">Edit</th>
        </tr>
      </thead>
      <tbody>
      <?php
      		for($i=0;$i<count($result);$i++){
				$row=$i+1;
				echo '<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['pagename'].'</td>
						<td>'.$result[$i]['title'].'</td>
						<td><a href="'.base_url().'index.php/pdl/'.$this->uri->rsegment(1).'/Addnew/'.$result[$i]['cms_pages_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a></td>
				</tr>';	
			}
		?>
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
</style>