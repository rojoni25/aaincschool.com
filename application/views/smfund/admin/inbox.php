	<script>
    	$(document).on('click','.delete',function(e){
			e.preventDefault();
			var url=$(this).attr('href');
			var tr	=	$(this).closest('tr');
			$.ajax({url:url,success:function(result){
				tr.remove();
			}});
			
		});
    </script>
   <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Inbox</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Message</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Inbox</li>
        </ul>
      </div>
    </div>
    
 
    
    <div class="row-fluid">
      <div class="span12 membertable">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th width="5%">Usercode</th>
                <th width="10%">Name</th>
                <th width="10%">Subject</th>
                <th width="15%">Message</th>
                <th width="15%">Join Date</th>
                <th width="5%">#</th>
            </tr>
          </thead>
          <?php
          	for($i=0;$i<count($result);$i++){
				$new_date = date('d-M-Y', strtotime($result[$i]['create_date']));
				
				echo'<tr class="'.$status.'">
						<td>'.$result[$i]['send_by'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['message'].'</td>
						<td>'.$new_date.'</td>
						<td><a class="delete" href="'.smfund().''.$this->uri->rsegment(1).'/delete_outbox/'.$result[$i]['id'].'">Delete</a></td>
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