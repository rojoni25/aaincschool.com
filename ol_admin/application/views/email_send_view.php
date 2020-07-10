<script>
	$(document).ready(function() {
    	$('#data-table').dataTable( {
        "aLengthMenu": [[25, 50, 75, 100, 1000, -1], [25, 50, 75, 100, 1000, "All"]],
        "iDisplayLength": 100,
    		"bProcessing": true,
    		"bServerSide": true,
    		"bSort": false,
    		"sAjaxSource": "<?=base_url()?>index.php/email_send/listing"
    	} );
  } );

</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>


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
                    	<td><input type="text" class="span12" id="subject" name="subject" placeholder="Subject" /></td>
                    </tr>
                    <tr>
                    	<td><input type="checkbox" name="all_member" id="all_member" onchange="all_member_select();" style="margin:0px;padding:0px;" value="Y" />&nbsp;&nbsp;Checked If Send To All </td>
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
                    	<td><input type="submit" class="btn btn-success" onClick="return vali();" value="Send" /></td>
                    </tr>
                </table>
            </div><!------widget-container------>	
            </div><!----widgets gray------>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%"><input type="checkbox" class="chkall" id="chkall" onchange="checkAll();"></th>
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
				if(frmlist.elements[i].id =='chKid')
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
