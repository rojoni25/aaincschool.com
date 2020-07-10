<div class="row">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Email</a> </li>
    <li class="active-bre"><a href="#"> Send Email</a> </li>
  </ul>
</div> 
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Send Email</h4>
    <br> 
    <div class="hom-cre-acc-left hom-cre-acc-right">
      <div class="col-md-12">
        <form action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" method="post" id="frmlist">
          <div class="row">
            <div class="col-md-12">
            		<div class="content-widgets gray">
                      
                
                  <div class="widget-container">
                  	<table width="100%">
                      	
                      	<tr>
                          	<td><input type="text" class="span12" id="subject" name="subject" placeholder="Subject" /></td>
                          </tr>
                          <tr>
                          	<td>
                              <input type="checkbox" name="all_member" id="all_member" onchange="all_member_select();" value="Y" class="filled-in" />
                              <label for="all_member" style="font-size: 1.5rem;">Checked If Send To All </label>
                            </td>
                          </tr>
                          <tr>
                          	<td>
                              	<textarea id="msg" name="msg" placeholder="Message" class="txtarea" value=""></textarea>
                  			<script>
                      			CKEDITOR.replace( 'msg' );
                  			</script>
                              </td>
                          </tr>
                          <tr>
                          	<td>
                              <br>
                              <input type="submit" class="btn btn-success" onClick="return vali();" value="Send" />
                            </td>
                          </tr>
                      </table>
                  </div><!------widget-container------>	
                  </div><!----widgets gray------>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 membertable">
              <table class="table table-striped table-bordered" id="data-table">
                <thead>
                  <tr>
                    <th width="10%"><input type="checkbox" class="chkall filled-in" id="chkall" onchange="checkAll();"><label for="chkall"></label></th>
                    	<th>Usercode</th>
                    	<th>Name</th>
                   	<th>Email Id</th>
                  </tr>
                </thead>
                <tbody>
                  
                 </tbody>
              </table>
            </div>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<script>
		function checkAll()
		{
			var chKidall=document.getElementById('chkall');
			if(chKidall.checked==true){ var stu=true;}
			else{ var stu=false;}
			var frmlist=document.getElementById('frmlist');
			for(i=0;i<frmlist.elements.length;i++)
			{
				if(frmlist.elements[i].name =='usercode_list[]')
				{
					frmlist.elements[i].checked=stu;	
				}
			}
		
		}
		
		function all_member_select()
		{
			var chKidall=document.getElementById('all_member');
			if(chKidall.checked==true){ var stu=false; var dis=true;}
			else{ var stu=false; var dis=false;}
			if(stu==true){
				document.getElementById("chkall").disabled = dis;
			}
			else{
				document.getElementById("chkall").disabled = dis;
			}
			var frmlist=document.getElementById('frmlist');
			for(i=0;i<frmlist.elements.length;i++)
			{
				if(frmlist.elements[i].name =='usercode_list[]')
				{
					frmlist.elements[i].checked=stu; 
					frmlist.elements[i].disabled=dis;	
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
