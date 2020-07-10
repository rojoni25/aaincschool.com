<div class="">    
  <ul class="top-banner"></ul>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
	<script>
    	$(document).ready(function(e) {
          	$('#data-table2').dataTable();  
        });
    </script>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Invite Friends</a> </li>
    <li class="active-bre"><a href="#"> Invite Friends Analytics</a> </li>
  </ul>
</div>    
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Invite Friends Analytics</h4>
    <div class="  ">
      <div class="col-md-12">
        <div class="primary-head text-right">
          <h3 class="page-header">
              <a style="" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invitefriends"><button type="button" class="btn btn-success btn_padding">Invite Friends</button></a> &nbsp;&nbsp;
              <a class="view_friend" style="float:right;margin-right:10px;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/"><button type="button" class="btn btn-warning btn_padding">Friend View</button></a>
          </h3>
        </div>
      </div>
    </div>
    <br>
       
    <div class="">
      <div class="col-md-12 membertable">
        
        <table class="table table-striped table-bordered">
          <tr>
            <td>Name</td>
            <td><?php echo $friend_view['h_name']; ?></td>
          </tr>

          <tr>
            <td>Contact</td>
            <td><?php echo $friend_view['h_contact']; ?></td>
          </tr>

          <tr>
            <td>Notes</td>
            <td><?php echo $friend_view['h_notes']; ?></td>
          </tr>

          <tr>
            <td>Email ID</td>
            <td><?php echo $friend_view['invite_emailid']; ?></td>
          </tr>

          <tr>
            <td>Subject</td>
            <td><?php echo $friend_view['subject']; ?></td>
          </tr>

          <tr>
            <td>Message</td>
            <td><?php echo $friend_view['message']; ?></td>
          </tr>
        </table>
        <br clear="all">

      </div>
    </div>
    
    <div class="">
      <div class="col-md-12 membertable">
        <table class="table table-striped table-bordered" id="data-table2">
          <thead>
            <tr>
              	<th width="20%">Sr No</th>
                <th width="40%">Emaild</th>
                <th width="40%">Date</th>
            </tr>
          </thead>
          <?php
          	for($i=0;$i<count($analytics_list);$i++){
				$new_date = date('d-M-Y h:ia', strtotime($analytics_list[$i]['created_at']));
				echo '<tr>
						<td>'.(i+1).'</td>
            <td>'.$friend_view['invite_emailid'].'</td>
						<td>'.$new_date.'</td>
          </tr>';
			}
		  ?>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>
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