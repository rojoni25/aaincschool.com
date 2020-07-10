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
          <h3 class="page-header">Send Email</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Send Email</li>
        </ul>
      </div>
    </div>
    <form action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" method="post" id="frmlist">
    <div class="row-fluid">
      <div class="span12">
      		<div class="content-widgets gray">
                
          
            <div class="widget-container">
            	<table width="100%">
                	
                	<tr>
                    	<td width="10%"><strong>Subject</strong></td>
                        <td width="90%"><?=$result[0]['subject']?></td>
                    </tr>
                    <tr>
                    	<?php
                        	$timedt = date("d/m/Y - g:i a", strtotime($result[0]['timedt']));
						?>
                    	<td><strong>Time</strong></td>
                        <td><?=$timedt?></td>
                    </tr>
                    <tr>
                    	<td valign="top"><strong>Message</strong></td>
                        <td valign="top"><?=$result[0]['msg']?></td>
                    </tr>
                   
                </table>
            </div><!------widget-container------>	
            </div><!----widgets gray------>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              	<th>Usercode</th>
              	<th>Name</th>
             	<th>Email Id</th>
                <th>Send</th>
            </tr>
          </thead>
          <tbody>
            <?php
            	for($i=0;$i<count($member);$i++){
					echo '<tr>
							<td>'.$member[$i]['receiver_code'].'</td>
							<td>'.$member[$i]['fname'].' '.$member[$i]['lname'].'</td>
							<td>'.$member[$i]['emailid'].'</td>
							<td>'.$member[$i]['send_succes'].'</td>
					</tr>';	
				}
			?>
           </tbody>
        </table>
      </div>
    </div>
</form>

<script>
		function checkAll()
		{
			var chKidall=document.getElementById('chkall');
			if(chKidall.checked==true){ var stu=true;}
			else{ var stu=false;}
			var frmlist=document.getElementById('frmlist');
			for(i=0;i<frmlist.elements.length;i++)
			{
				if(frmlist.elements[i].id =='chKid')
				{
					frmlist.elements[i].checked=stu;	
				}
			}
		
		}
		
		function vali(){
			var frmlist=document.getElementById('frmlist');
			var subject=document.getElementById('subject');
			if(subject.value==''){
				subject.focus();
				return false;
			}
			frmlist.submit();
		}
</script>
