<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Details <a style="float:right;" href="<?php echo base_url();?>index.php/user">
        <button type="button" class="btn btn-info btn_padding">Member List</button>
        </a> </h3>
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
            <td><?=$result[0]['fname']?>
              <?=$result[0]['lname']?></td>
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
          <tr>
            <td width="24%">Total Referral</td>
            <td width="1%">:</td>
            <td><?=$tot_ref[0]['tot']?></td>
          </tr>
        </table>
        <h3 class="page-header">Free Tree Position</h3>
        <table class="table">
          <tr>
            <td width="20%">3 x 3 Upling</td>
            <td width="1%">:</td>
            <td><strong>Name </strong>:<?php echo '<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$tree_uplig[0]['username'].'"><strong>'.$tree_uplig[0]["fname"].' '.$tree_uplig[0]["lname"].'</strong></a> '?><br />
              <strong>Email</strong> :
              <?=$tree_uplig[0]['emailid']?>
              <br />
              <strong>Skype</strong> :
              <?=$tree_uplig[0]['skype']?>
              <br />
              <strong>Contatc No</strong> :
              <?=$tree_uplig[0]['mobileno'] ?>
              \\
              <?=$tree_uplig[0]['phone_no'] ?></td>
          </tr>
          <tr>
            <td width="20%">5 x 3 Upling</td>
            <td width="1%">:</td>
            <td><strong>Name </strong>:<?php echo '<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$five_uplig[0]['username'].'"><strong>'.$five_uplig[0]["fname"].' '.$five_uplig[0]["lname"].'</strong></a> '?><br />
              <strong>Email</strong> :
              <?=$five_uplig[0]['emailid']?>
              <br />
              <strong>Skype</strong> :
              <?=$five_uplig[0]['skype']?>
              <br />
              <strong>Contatc No</strong> :
              <?=$five_uplig[0]['mobileno'] ?>
              \\
              <?=$five_uplig[0]['phone_no'] ?></td>
          </tr>
          <tr>
            <td width="20%">10 x 3 Upling1</td>
            <td width="1%">:</td>
            <td><strong>Name </strong>:<?php echo '<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$ten_uplig[0]['username'].'"><strong>'.$ten_uplig[0]["fname"].' '.$ten_uplig[0]["lname"].'</strong></a> '?><br />
              <strong>Email</strong> :
              <?=$ten_uplig[0]['emailid']?>
              <br />
              <strong>Skype</strong> :
              <?=$ten_uplig[0]['skype']?>
              <br />
              <strong>Contatc No</strong> :
              <?=$ten_uplig[0]['mobileno'] ?>
              \\
              <?=$ten_uplig[0]['phone_no'] ?></td>
          </tr>
        </table>
        <?php if($result[0]['status']=='Active'){ ?>
        <h3 class="page-header">Paid Tree Position</h3>
        <table class="table">
          <tr>
            <td width="24%">3 x 3 Upling</td>
            <td width="1%">:</td>
            <td><strong>Name </strong>:<?php echo '<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$tree_uplig_paid[0]['username'].'"><strong>'.$tree_uplig_paid[0]["fname"].' '.$tree_uplig_paid[0]["lname"].'</strong></a> '?><br />
              <strong>Email</strong> :
              <?=$tree_uplig_paid[0]['emailid']?>
              <br />
              <strong>Skype</strong> :
              <?=$tree_uplig_paid[0]['skype']?>
              <br />
              <strong>Contatc No</strong> :
              <?=$tree_uplig_paid[0]['mobileno'] ?>
              \\
              <?=$tree_uplig_paid[0]['phone_no'] ?></td>
          </tr>
          <tr>
            <td width="24%">5 x 3 Upling</td>
            <td width="1%">:</td>
            <td><strong>Name </strong>:<?php echo '<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$five_uplig_paid[0]['username'].'"><strong>'.$five_uplig_paid[0]["fname"].' '.$five_uplig_paid[0]["lname"].'</strong></a> '?><br />
              <strong>Email</strong> :
              <?=$five_uplig_paid[0]['emailid']?>
              <br />
              <strong>Skype</strong> :
              <?=$five_uplig_paid[0]['skype']?>
              <br />
              <strong>Contatc No</strong> :
              <?=$five_uplig_paid[0]['mobileno'] ?>
              \\
              <?=$five_uplig_paid[0]['phone_no'] ?></td>
          </tr>
          <tr>
            <td width="24%">10 x 3 Upling</td>
            <td width="1%">:</td>
            <td><strong>Name </strong>:<?php echo '<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$ten_uplig_paid[0]['username'].'"><strong>'.$ten_uplig_paid[0]["fname"].' '.$ten_uplig_paid[0]["lname"].'</strong></a> '?><br />
              <strong>Email</strong> :
              <?=$ten_uplig_paid[0]['emailid']?>
              <br />
              <strong>Skype</strong> :
              <?=$ten_uplig_paid[0]['skype']?>
              <br />
              <strong>Contatc No</strong> :
              <?=$ten_uplig_paid[0]['mobileno'] ?>
              \\
              <?=$ten_uplig_paid[0]['phone_no'] ?></td>
          </tr>
        </table>
        <?php } ?>
      </div>
      <!-----span6------->
      <div class="span6">
        <?php if($result[0]['status']=='Active') {?>
        <h3 class="page-header">Referral Detail (Paid Position)</h3>
        <table class="table">
          <tr>
            <td width="24%">Referral Name</td>
            <td width="1%">:</td>
            <?php echo '<td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$referral_paid[0]['username'].'"><strong>'.$referral_paid[0]["fname"].' '.$referral_paid[0]["lname"].'</strong></a></td> '?> </tr>
          <?php 
						$joindt = date('d-M-Y H:i', strtotime($referral_paid[0]['create_date']));
					?>
          <tr>
            <td>Create Date</td>
            <td width="1%">:</td>
            <td><?=$joindt?></td>
          </tr>
          <tr>
            <td>Contact No</td>
            <td width="1%">:</td>
            <td><?=$referral_paid[0]['mobileno']?>
              ,
              <?=$referral_paid[0]['phone_no']?></td>
          </tr>
          <tr>
            <td>Email Id</td>
            <td width="1%">:</td>
            <td><?=$referral_paid[0]['emailid']?></td>
          </tr>
          <tr>
            <td>Status</td>
            <td width="1%">:</td>
            <td><?=$referral_paid[0]['status']?></td>
          </tr>
          <?php if($referral_paid[0]['skype']!=''){ ?>
          <tr>
            <td>Skype</td>
            <td width="1%">:</td>
            <td><?=$referral_paid[0]['skype']?></td>
          </tr>
          <?php } ?>
          <?php if($referral_paid[0]['payzapay']!=''){ ?>
          <tr>
            <td>Payza Pay</td>
            <td width="1%">:</td>
            <td><?=$referral_paid[0]['payzapay']?></td>
          </tr>
          <?php } ?>
          <?php if($referral_paid[0]['solidtrustpay']!=''){ ?>
          <tr>
            <td>Solid Trust Pay</td>
            <td width="1%">:</td>
            <td><?=$referral_paid[0]['solidtrustpay']?></td>
          </tr>
          <?php } ?>
        </table>
        <?php } /*end if condition*/?>
        <!---------------------------------------------->
        <h3 class="page-header">Referral Detail (Free Position)</h3>
        <table class="table">
          <tr>
            <td width="24%">Referral Name</td>
            <td width="1%">:</td>
            <?php echo '<td><a href="'.base_url().'index.php/comman_controler/member_details_view/'.$referral_free[0]['username'].'"><strong>'.$referral_free[0]["fname"].' '.$referral_free[0]["lname"].'</strong></a></td> '?> </tr>
          <tr>
            <td>Contact No</td>
            <td width="1%">:</td>
            <td><?=$referral_free[0]['mobileno']?>
              ,
              <?=$referral_free[0]['phone_no']?></td>
          </tr>
          <tr>
            <td>Email Id</td>
            <td width="1%">:</td>
            <td><?=$referral_free[0]['emailid']?></td>
          </tr>
          <?php 
						$joindt = date('d-M-Y H:i', strtotime($referral_free[0]['create_date']));
					?>
          <tr>
            <td>Create Date</td>
            <td width="1%">:</td>
            <td><?=$joindt?></td>
          </tr>
          <tr>
            <td>Status</td>
            <td width="1%">:</td>
            <td><?=$referral_free[0]['status']?></td>
          </tr>
          <?php if($referral_free[0]['skype']!=''){ ?>
          <tr>
            <td>Skype</td>
            <td width="1%">:</td>
            <td><?=$referral_free[0]['skype']?></td>
          </tr>
          <?php } ?>
          <?php if($referral_free[0]['payzapay']!=''){ ?>
          <tr>
            <td>Payza Pay</td>
            <td width="1%">:</td>
            <td><?=$referral_free[0]['payzapay']?></td>
          </tr>
          <?php } ?>
          <?php if($referral_free[0]['solidtrustpay']!=''){ ?>
          <tr>
            <td>Solid Trust Pay</td>
            <td width="1%">:</td>
            <td><?=$referral_free[0]['solidtrustpay']?></td>
          </tr>
          <?php } ?>
        </table>
        <h3 class="page-header">Member</h3>
        <table class="table">
          <tr>
            <th colspan="3">Summary for Stream 3 x 3 </th>
          </tr>
          <tr>
            <td width="33%">Level One</td>
            <td width="33%">Level Two</td>
            <td width="33%">Level Three</td>
          </tr>
          <tr>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_one3']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_one3']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_two3']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_two3']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_three3']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_three3']?></td>
          </tr>
          <tr>
            <th colspan="3">Summary for Stream 5 x 3 </th>
          </tr>
          <tr>
            <td width="33%">Level One</td>
            <td width="33%">Level Two</td>
            <td width="33%">Level Three</td>
          </tr>
          <tr>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_one5']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_one5']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_two5']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_two5']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_three5']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_three5']?></td>
          </tr>
          <tr>
            <th colspan="3">Summary for Stream 10 x 3 </th>
          </tr>
          <tr>
            <td width="33%">Level One</td>
            <td width="33%">Level Two</td>
            <td width="33%">Level Three</td>
          </tr>
          <tr>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_one10']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_one10']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_two10']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_two10']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary[0]['level_three10']?>
              <br />
              Active Memeber :
              <?=$level_summary[0]['active_level_three10']?></td>
          </tr>
        </table>

        <table class="table">
          <tr>
            <th colspan="3">Summary for Stream 3 x 3 Free</th>
          </tr>
          <tr>
            <td width="33%">Level One</td>
            <td width="33%">Level Two</td>
            <td width="33%">Level Three</td>
          </tr>
          <tr>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_one3']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_one3']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_two3']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_two3']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_three3']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_three3']?></td>
          </tr>
          <tr>
            <th colspan="3">Summary for Stream 5 x 3 </th>
          </tr>
          <tr>
            <td width="33%">Level One</td>
            <td width="33%">Level Two</td>
            <td width="33%">Level Three</td>
          </tr>
          <tr>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_one5']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_one5']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_two5']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_two5']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_three5']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_three5']?></td>
          </tr>
          <tr>
            <th colspan="3">Summary for Stream 10 x 3 </th>
          </tr>
          <tr>
            <td width="33%">Level One</td>
            <td width="33%">Level Two</td>
            <td width="33%">Level Three</td>
          </tr>
          <tr>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_one10']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_one10']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_two10']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_two10']?></td>
            <td width="33%">Total Memeber :
              <?=$level_summary_free[0]['level_three10']?>
              <br />
              Active Memeber :
              <?=$level_summary_free[0]['active_level_three10']?></td>
          </tr>
        </table>
      </div>
      <!-----span6-------> 
    </div>
    <!-----row-fluid-------> 
  </div>
  <!-----span12-------> 
</div>
<!-----row-fluid-------> 
<div class="row-fluid ">
  <div class="span12">
  <h3 class="page-header">Referral Chain</h3>
  	<div class="section-chain">
    		<div>
            	<ul class="color-code">
                	<li class="mem-act"><strong>Active</strong></li>
                    <li class="mem-free"><strong>Free</strong></li>
                    <li class="mem-send-req"><strong>Send Request</strong></li>
                    <li class="mem-free-paid"><strong>Free But Paid</strong></li>
                    
                </ul>
                <div style="clear:both;overflow:hidden;height:20px;border-bottom:#999 dotted 1px;"></div>
            </div>
            <div style="clear:both;overflow:hidden;height:20px;"></div>
        	<?php for($i=0;$i<count($free_chain);$i++){
					$arrow=($i<(count($free_chain)-1)?"<span><i class='icon-arrow-right'></i></span>":"");
					if($free_chain[$i]['status']=='Active'){
						$cls='mem-act';
					}
					if($free_chain[$i]['status']=='Pending'){
						if($free_chain[$i]['pstatus']=='Active' && $free_chain[$i]['payment']=='N'){
							$cls='mem-send-req';
						}
						elseif($free_chain[$i]['pstatus']=='Active' && $free_chain[$i]['payment']=='Y'){
							$cls='mem-free-paid';
						}
						else{
							$cls='mem-free';
						}
					}
					
            		echo '<div class="div-chain '.$cls.'">
								<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$free_chain[$i]['username'].'">
									<p>'.$free_chain[$i]['name'].'</p>
									<p>'.$free_chain[$i]['usercode'].'</p>
								</a>	
								'.$arrow.'	
						 </div>';
                 } ?>
                 <div style="clear:both;overflow:hidden;"></div>
        	
       
    </div>
  </div>
</div>

<style>
	.section-chain{
		margin-bottom:50px;
	}
	.div-chain{
		float:none;
		border:#999 solid 1px;
		float:left;
		padding:15px 10px;
		margin-right:20px;
		position:relative;
		margin-bottom:20px;
		
	}
	.div-chain a{
		color:#fff;
		font-weight:700;
	}
	.div-chain a:hover{
		text-decoration:none;
	}
	.div-chain p{
		margin:0px;
		padding:0px;
		text-align:center;
	}
	.div-chain span{
		position:absolute;
		right:-17px;
		top:36%;
	}
	.color-code{
		padding:0px;
		margin:0px;
		list-style:none;
	}
	.color-code li{
		float:left;
		padding:5px 15px;
		border:#CCC solid 1px;
		margin-right:10px;
		color:#FFF;
	}
	.mem-act{
		background-color:#009600;
	}
	.mem-free{
		background-color:#983114;
	}
	.mem-send-req{
		background-color:#3498DB;
	}
	.mem-free-paid{
		background-color:#B06700;
	}
</style>