
	<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">VMA Message</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Message</li>
        </ul>
      </div>
    </div>
    
    <?php if($this->session->flashdata('show_msg')!=''){?>
    	<div class="alert alert-success">
   	 		<button type="button" class="close" data-dismiss="alert">&times;</button>
    		<strong><?=$this->session->flashdata('show_msg')?></strong> 
    	</div>
   <?php } ?>
    
    <div class="row-fluid">
      <div class="span12">
      <form action="<?=vma_base()?><?=$this->uri->rsegment(1)?>/insert" method="post">
      	<input type="hidden"  name="usercode" id="usercode"  value="<?=$result[0]['usercode']?>" />
        <table class="table">
         	<tr>
            	<td width="19%">Usercode</td>
                <td width="1%">:</td>
                <td width="80%"><?=$result[0]['usercode']?></td>
            </tr>
            <tr>
            	<td>Member Name</td>
                <td>:</td>
                <td><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
            </tr>
            <tr>
            	<td>Emailid</td>
                <td>:</td>
                <td><?=$result[0]['emailid']?></td>
            </tr>
            <tr>
            	<td>Subject</td>
                <td>:</td>
                <td><input type="text" class="span12" name="subject" id="subject" placeholder="Enter Subject" value="" /></td>
            </tr>
            <tr>
            	<td>Message</td>
                <td>:</td>
                <td><textarea class="span12" id="msg" name="msg" placeholder="Enter Message Hear"></textarea></td>
            </tr>
              <tr>
         	 	<td></td>
          		<td></td>
          		<td><button type="submit" class="btn btn-success"><strong>Send</strong></button></td>
        </tr>
        </table>
        </form>
      </div>
    </div>

