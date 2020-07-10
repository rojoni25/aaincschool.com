<div class="row">    
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
          	$('#data-table').dataTable();  
        });
    </script>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Invite Friends</a> </li>
    <li class="active-bre"><a href="#"> Invite Friends History</a> </li>
  </ul>
</div>
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>
      Invite Friends History
      <?php
        $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
        $referralcount = countreferral($loginusercode);
        if($referralcount>=3){
      ?>
          <span class="pull-right">
            <a href="#" class="btn btn-primary btn-sm" style="padding: 5px;height: 30px;"><strong> Qualified</strong></a>
          </span>
      <?
        }else{
      ?>
          <span class="pull-right">
            <a href="#" class="btn btn-danger btn-sm" style="padding: 5px;height: 30px;"><strong>Not Qualified</strong></a>
          </span>
      <?    
        }
      ?>
      <?
      if($this->session->userdata['tbl']['current_account']=='Pending')
      {
      ?>
        <!--<span class="" style="color: #fff;padding-left: 10px;">-->
        <!--  <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> -->
        <!--  <span style="color: darkgoldenrod;font-size: 20px;">  Smart Wallet : </span>-->
        <!--  <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?></span>-->
        <!--</span>-->
        <span class="" style="color: #fff;padding-left: 30px;"> 
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?> /per month</span>
        </span>
      <?
      }else{
       $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
      ?>
        <span class="" style="color: #fff;padding-left: 10px;">
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=GetPaidReferalWallet($loginusercode)?></span>
        </span>
        <span class="" style="color: #fff;padding-left: 30px;"> 
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=getCapturePageWalletTotal($loginusercode)?> /per month</span>
        </span>
      <?  
      }
      ?>
    </h4>
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
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th width="20%">Emaild</th>
                <th width="20%">Date</th>
             	<th width="20%">Subject</th>
              	<th width="40%">Message</th>
                <th width="10%">Total</th>
                <th width="30%">Action</th>
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
            <td>'.$result[$i]['total_count'].'</td>
            <td><a href="'.base_url().'index.php/view_friends/invite_analytics/'.$result[$i]['invite_friend_code'].'"><i class="fa fa-eye"></i></a>'. '</td>
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