<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Inbox
          	<a href="<?=base_url()?>index.php/email_inbox" style="float:right">GO Back</a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Inbox</li>
        </ul>
      </div>
    </div>
    
   
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          	<tr>
            	<td width="20%">Subject</td>
                <td width="1%"></td>
                <td width="79%"><?=$result[0]['subject']?></td>
            </tr>
            <tr>
            	<td>Date</td>
                <td></td>
                <td><?=$result[0]['timedt']?> (<?=ago_time($result[0]['timedt'])?>)</td>
            </tr>
            <tr>
            	<td>Member</td>
                <td></td>
                <td><?=$sender_name?> <?=$sender_code?></td>
            </tr>
            <tr>
            	<td>Member Email Id</td>
                <td></td>
                <td><?=$sender_email?></td>
            </tr>
            
             <tr>
            	<td>Message</td>
                <td></td>
                <td><?=$result[0]['msg']?></td>
            </tr>
        </table>
      </div>
    </div>

