<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
            

<div class="row-fluid ">  <div class="span12"><ul class="top-banner"></ul></div></div>

<script>
	$(document).ready(function(e) {
      	$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});  
    });
</script>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=$title?></h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">NDA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=$title?></li>
    </ul>
  </div>
</div>



   
    
<div class="row-fluid">
  <div class="span12 membertable">
     <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Id</th>
            <th>Usercode</th>
            <th>Name</th>
         
            <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++){
			$row=$i+1;
			echo '<tr>
				<td>'.$row.'</td>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.date('d-m-Y',strtotime($result[$i]['timedt'])).'</td>
			</tr>';	
		}?>
       </tbody>
    </table>
  </div>
</div>

<style>
@media  only screen and (max-width: 550px){

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
	content: "Name";
}
.membertable td:nth-of-type(3):before {
	content: "Mobile No";
}
.membertable td:nth-of-type(4):before {
	content: "Email Id";
}
.membertable td:nth-of-type(5):before {
	content: "Verified";
}

}
</style>
