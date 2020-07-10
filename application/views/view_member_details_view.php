<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Member Details
          	<a style="float:right;" href="<?php echo base_url();?>index.php/user">
            	<button type="button" class="btn btn-info btn_padding">Member List</button>
            </a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Member</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Member Details</li>
         
        </ul>
      </div>
    </div>
    

    
    <div class="row-fluid">
      <div class="span12">
       	<div class="row-fluid">
			<div class="span6">
            	<h3 class="page-header">Member</h3>
                <table class="table">
                	<tr>
                    	<td width="24%">Name</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
                    </tr>
                    <tr>
                    	<td>Email Id</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['emailid']?></td>
                    </tr>
                    <tr>
                    	<td>Username</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['username']?></td>
                    </tr>

                    <tr>
                    	<td>Mobile No</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['mobileno']?></td>
                    </tr>
                    <?php if($result[0]['phone_no']!=''){ ?>
                    <tr>
                    	<td>Phone No</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['phone_no']?></td>
                    </tr>
                    <?php } 
						$joindt = date('d-M-Y H:i', strtotime($result[0]['create_date']));
					?>
                      <tr>
                    	<td>Create Date</td>
                        <td width="1%">:</td>
                        <td><?=$joindt?></td>
                    </tr>
                     <tr>
                    	<td>Status</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['status']?></td>
                    </tr>
                    <?php if($result[0]['skype']!=''){ ?>
                     <tr>
                    	<td>Skype</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['skype']?></td>
                    </tr>
                   <?php } ?>
                   <?php if($result[0]['payzapay']!=''){ ?>
                    <tr>
                    	<td>Payza Pay</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['payzapay']?></td>
                    </tr>
                    <?php } ?>
                    <?php if($result[0]['solidtrustpay']!=''){ ?>
                    <tr>
                    	<td>Solid Trust Pay</td>
                        <td width="1%">:</td>
                        <td><?=$result[0]['solidtrustpay']?></td>
                    </tr>
                    <?php } ?>
                   
                </table>
                
            </div><!-----span6------->
            <div class="span6">
           		 <h3 class="page-header">Member</h3>
                 <table class="table">
                 	<tr>
                    	<td width="24%">Total Referral</td>
                        <td width="1%">:</td>
           				<td><?=$tot_ref[0]['tot']?></td>
                    </tr>
                 	<tr>
                    	<td width="24%">Referral</td>
                        <td width="1%">:</td>
           				<?php echo '<td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$referral[0]['username'].'"><strong>'.$referral[0]["fname"].' '.$referral[0]["lname"].'</strong></a></td> '?>
                    </tr>
                    <tr>
                    	<td width="24%">3 x 3 Upling</td>
                        <td width="1%">:</td>
                        <?php echo '<td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$tree_uplig[0]['username'].'"><strong>'.$tree_uplig[0]["fname"].' '.$tree_uplig[0]["lname"].'</strong></a></td> '?>
                    </tr>
                    <tr>
                    	<td width="24%">5 x 3 Upling</td>
                        <td width="1%">:</td>
                        <?php echo '<td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$five_uplig[0]['username'].'"><strong>'.$five_uplig[0]["fname"].' '.$five_uplig[0]["lname"].'</strong></a></td> '?>
                    </tr>
                    <tr>
                    	<td width="24%">10 x 3 Upling</td>
                        <td width="1%">:</td>
                        <?php echo '<td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$ten_uplig[0]['username'].'"><strong>'.$ten_uplig[0]["fname"].' '.$ten_uplig[0]["lname"].'</strong></a></td> '?>
                    </tr>
                 </table>
            </div><!-----span6------->
            </div><!-----row-fluid------->
      </div><!-----span12------->
    </div><!-----row-fluid------->

