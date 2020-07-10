<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
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
                <td><?=$result[0]['fname']?> <?=$result[0]['lname']?> (<?=$result[0]['sender_code']?>)</td>
            </tr>
            <tr>
            	<td>Member Email Id</td>
                <td></td>
                <td><?=$result[0]['emailid']?></td>
            </tr>
            
             <tr>
            	<td>Message</td>
                <td></td>
                <td><?=$result[0]['msg']?></td>
            </tr>
        </table>
      </div>
    </div>

