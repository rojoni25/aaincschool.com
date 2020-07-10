<div class="row">    
  <ul class="top-banner"></ul>
</div>

<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>


<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Friend</a> </li>
    <li class="active-bre"><a href="#"> Friend List</a> </li>
  </ul>
</div>

<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>
      Friend List
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
              <a style="" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invitefriends"><button type="button" class="btn btn-info btn_padding">Invite Friend</button></a>
          </h3>
        </div>
      </div>
    </div>
    <div class="">
      <div class="col-md-12 membertable">
         <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Usercode</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email Id</th>
                <th>Verified</th>
            </tr>
          </thead>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>
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
