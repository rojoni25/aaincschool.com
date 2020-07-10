
   <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Invite Friends History</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Invite Friends</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Invite Friends History</li>
        </ul>
      </div>
    </div>
    
  
    
    <div class="row-fluid">
      <div class="span12 membertable">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th width="20%">Emaild</th>
                <th width="20%">Date</th>
             	<th width="20%">Subject</th>
              	<th width="40%">Message</th>
            </tr>
          </thead>
          <?php
          	for($i=0;$i<count($result);$i++){
				$new_date = date('d-M-Y h:ia', strtotime($result[$i]['timedt']));
				echo'<tr class="'.$status.'">
						<td>'.$result[$i]['invite_emailid'].'</td>
						<td>'.$new_date.'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['message'].'</td>
              		</tr>';
			}
		  ?>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>

<style>
@media  only screen and (max-width: 500px){

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
	content: "Emaild";
}
.membertable td:nth-of-type(2):before {
	content: "Date";
}
.membertable td:nth-of-type(3):before {
	content: "Subject";
}
.membertable td:nth-of-type(4):before {
	content: "Message";
}
.page-header {
    font-size: 18px;
	height:30px;
	}
}

@media  only screen and (max-width: 400px){
	.page-header {
    font-size: 18px;
	height:70px;
	}
	.view_friend{
		margin-top:5px;
		margin-left:45%;
		float:right;
	}
}

</style>