   <script>
    	
		
		$(document).on('click','.send_login_dt',function(e){
			
			$('.send_processing').remove();
			
			var con=confirm('Send Login Detail ?');
			
			if(!con){
				return false;
			}
			
			
			e.preventDefault();
			
			var url=$(this).attr('href');
			
			var td= $(this).closest('td');
			
			$.ajax({url:url,
				beforeSend: function(){
     				td.append('<span class="send_processing"><br>sending..<span>');	
   				},
   				complete: function(){
     				
   				},
				success:function(result){
					$('.send_processing').html('<br>send successfully');	
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
		});
		
    </script>
   <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Member List</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Member</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">List</li>
        </ul>
      </div>
    </div>
    
  
    
    <div class="row-fluid">
      <div class="span12 membertable">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th width="5%">Sr. No</th>
                <th width="5%">Usercode</th>
                <th>Username</th>
                <th>Password</th>
                
                <th>Name</th>
                <th>Emailid</th>
                <th>Referral</th>
                <th>Join Date</th>
                <th width="20%">#</th>
            </tr>
          </thead>
          <?php
		  	
			
		  
          	for($i=0;$i<count($result);$i++){
				
				$new_date = date('d-M-Y', strtotime($result[$i]['date_dt']));
				$row=$i+1;
				echo'<tr class="'.$status.'">
						<td>'.$row.'</td>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['password'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['ref_name'].' ('.$result[$i]['ref_usercode'].')</td>
						<td>'.$new_date.'</td>
						<td>
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="'.smfund().$this->uri->rsegment(1).'/msg_to_member/'.$result[$i]['usercode'].'">Message</a></li>
									<li><a href="'.smfund().$this->uri->rsegment(1).'/edit_member_profile/'.$result[$i]['usercode'].'">Edit Profile</a></li>
									<li><a class="send_login_dt" href="'.smfund().$this->uri->rsegment(1).'/send_login_detail/'.$result[$i]['usercode'].'">Send Login Detail</a></li>
								</ul>
							</div>
						</td>	
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
.send_processing{
	font-size:12px;
	color:#398014;
	font-weight:bold;
}

</style>