

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Renewed Request</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Renewed Request</li>
        </ul>
      </div>
    </div>
  
       
    
    <div class="row-fluid">
      <div class="span12">
         <div class="span6">
					<div class="content-widgets gray">
						<div class="widget-head bondi-blue"><h3>Request Send By</h3></div>
						<div class="widget-container">
							<table class="table clstable">
                            	<tr><td width="29%">Name</td><td width="1%">:</td><td width="70%"><?=$req_by[0]['fname']?> <?=$req_by[0]['lname']?></td></tr>
                                <tr><td>Usercode</td><td>:</td><td><?=$req_by[0]['usercode']?></td></tr>
                                <tr><td>Username</td><td>:</td><td><a href="<?=base_url()?>index.php/comman_controler/member_details_view/<?=$req_by[0]['username']?>"><?=$req_by[0]['username']?></a></td></tr>
                                
                                <?php
									$current_sta=(time() > $req_by[0]['due_time'] ? "Due" : "Active")
								?>
                                
                                <tr><td>Current Status</td><td>:</td><td><span class="clsspan"><?=$current_sta?></span></td></tr>
                                <tr><td>Due Date</td><td>:</td><td><span class="clsspan"><?=date('d-m-Y',$req_by[0]['due_time'])?></span></td></tr>
                                <tr><td>Current Balance</td><td>:</td><td><span class="clsspan"><?=$req_by_balance?></span></td></tr>
                                <tr><td>Current Level</td><td>:</td><td><span class="clsspan"><?=$req_by_level[0]['tot']?></span></td></tr>
                                
                                <tr><td>Email Id</td><td>:</td><td><?=$req_by[0]['emailid']?></td></tr>
                                <tr><td>Contact No</td><td>:</td><td><?=$req_by[0]['mobileno']?> / <?=$req_by[0]['phone_no']?></td></tr>
                                <tr><td>Referral Name</td><td>:</td><td><?=$req_by_ref[0]['fname']?> <?=$req_by_ref[0]['lname']?> (<?=$req_by_ref[0]['usercode']?>)</td></tr>
                                <tr><td>Referral Username</td><td>:</td><td><?=$req_by_ref[0]['username']?></td></tr>
                                
                            </table>
						</div>
					</div>
		</div><!--span6---->
        
        <div class="span6">
					<div class="content-widgets gray">
						<div class="widget-head bondi-blue"><h3>Request Send For</h3></div>
						<div class="widget-container">
							<table class="table clstable">
                            	<tr><td width="29%">Name</td><td width="1%">:</td><td width="70%"><?=$req_for[0]['fname']?> <?=$req_for[0]['lname']?></td></tr>
                                <tr><td>Usercode</td><td>:</td><td><?=$req_for[0]['usercode']?></td></tr>
                                <tr><td>Username</td><td>:</td><td><a href="<?=base_url()?>index.php/comman_controler/member_details_view/<?=$req_for[0]['username']?>"><?=$req_for[0]['username']?></a></td></tr>
                                
                                <?php
									if($req_for[0]['status']=='Pending'){
										$current_sta='Free';
									}else{
										$current_sta=(time() > $req_for[0]['due_time'] ? "Due" : "Active");
									}
									
								?>
                                
                                <tr><td>Current Status</td><td>:</td><td><span class="clsspan"><?=$current_sta?></span></td></tr>
                                <tr><td>Due Date</td><td>:</td><td><span class="clsspan"><?=date('d-m-Y',$req_for[0]['due_time'])?></span></td></tr>
                                <tr><td>Current Balance</td><td>:</td><td><span class="clsspan"><?=$req_for_balance?></span></td></tr>
                                <tr><td>Current Level</td><td>:</td><td><span class="clsspan"><?=$req_for_level[0]['tot']?></span></td></tr>
                                
                                <tr><td>Email Id</td><td>:</td><td><?=$req_for[0]['emailid']?></td></tr>
                                <tr><td>Contact No</td><td>:</td><td><?=$req_for[0]['mobileno']?> / <?=$req_for[0]['phone_no']?></td></tr>
                                <tr><td>Referral Name</td><td>:</td><td><?=$req_for_ref[0]['fname']?> <?=$req_for_ref[0]['lname']?> (<?=$req_for_ref[0]['usercode']?>)</td></tr>
                                <tr><td>Referral Username</td><td>:</td><td><?=$req_for_ref[0]['username']?></td></tr>
                            </table>
						</div>
					</div>
		</div><!--span6---->
        	<div>
            	<?php 
					if($req_for[0]['status']=='Active'){ ?>
                    <form action="<?=base_url()?>index.php/auto_payment/request_to_renewal" method="post" id="frmsubmit">
                		<input type="hidden" name="request_code" value="<?=$result[0]['request_code']?>"  />
                      	<button type="submit" class="btn btn-success btnsubmit">Renewed</button>
                	</form>
                <?php } else{ ?>
            		<form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/member_payment" method="post" id="frmsubmit">
                		<input type="hidden" name="request_code" value="<?=$result[0]['request_code']?>"  />
                      	<button type="submit" class="btn btn-success btnsubmit">Payment For Active</button>
                	</form>
                
                <?php } ?>
            </div>
      </div>
    </div>

<style>
	.tblover{
		overflow-x: auto;
	}
	.strong-font{
		font-weight:bold;
		padding-left:10px !important;
	}
	.iconcls, .iconcls:hover{
		font-size:16px;
		color:#666 !important;
		text-decoration:none;
	}
	.clsspan{
		font-weight:bold;
		color:#F00;
	}
	.clstable{
		font-weight:bold;
	}
	.btnsubmit{
		font-weight:bold;
	}
</style>