<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		 "bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing_active"
	} );
} );

$(document).on('click', '.send_mail_cls', function (e) {
	e.preventDefault();
	var url 		= $(this).attr('href');
	var show_msg 	= $(this).closest('tr').find('.show_msg');
	show_msg.html('Sending..');
	$.ajax({url:url,success:function(result){
		show_msg.html(result);
    }});	
});
$(document).on('click', '.email-to-all', function (e) {
	e.preventDefault();
	$('.email-to-all-div').slideToggle(500);

  // get all un verified email accounts
  $.ajax({url:"https://affiliworx.com/ol_admin/index.php/send_email_verification/listing_active_to_verify_all",success:function(result){
    //sendVarificationEmail(0,JSON.parse(result));
    if(result=='Send Failed'){
      $("#msg-box-all-mail-send .error").html(result);
    } else{
      $("#msg-box-all-mail-send .to").html(result);
    }
  }});
});
sendVarificationEmail = function($index,$arrJson){
  if($index < $arrJson.length){
      $("#msg-box-all-mail-send .to").html("Email Sent To <strong>"+$arrJson[$index].fname+" "+$arrJson[$index].lname);
      $("#msg-box-all-mail-send .error").html("  </strong>successfuly!!");
    setTimeout(
      function() 
      {
        sendVarificationEmail(++$index,$arrJson);
      }, 200);
  }
}

$(document).on('click', '.delete_recode', function (e) {
	e.preventDefault();
	var tr = $(this).closest('tr');
	var url= $(this).attr('href');
	$.ajax({url:url,success:function(result){		 	
    	tr.remove();
	}});	
});

//

</script>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Send Email Verification <a href="<?php echo base_url();?>index.php/export_excel/unverification_member/" style="float:right;" title="Export To Excel"><img src="<?php echo base_url();?>asset/images/excel-icon.png" width="30" /></a> </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Send Email Verification</li>
      <a href="#" class="pull-right email-to-all"><span class="label label-success">Send Verification To All</span></a>
    </ul>
  </div>
</div>

<?PHP if($this->session->flashdata('show_msg')!='') { ?>
		<div class="alert alert-success">
        	<button type="button" class="close" data-dismiss="alert">&times;</button>
        	<strong><?=$this->session->flashdata('show_msg')?></strong> 
    	</div>
<?PHP } ?>
    

<div class="row-fluid email-to-all-div">
<div class="span12">
  <div class="content-widgets gray tbl-color">
    <div class="widget-head bondi-blue">
      <h3>Send Verification To All</h3>
    </div>
    <div class="widget-container"> 
    	<!-- <table class="stat-table table table-stats table-striped table-sortable table-bordered">
        	<thead>
            	<tr>
                	<th>Id</th>
                    <th>Time Date</th>
                    <th>Total Send</th>
                    <th>Status</th>
                     <th>Status</th>
                </tr>
            </thead>
            <tbody>
        		<?php 
					$new_entry=true;
					for($i=0;$i<count($send_result);$i++){ 
						if($send_result[$i]['status']=='Active'){
							$new_entry=false;
						}
					
				?>
                	<tr>
                    	 <td><?=$send_result[$i]['id']?></td>
                         <td><?=date('d-m-Y',$send_result[$i]['time_dt'])?></td>
                         <td><?=$send_result[$i]['tot_send']?></td>
                         <td><?=$send_result[$i]['status']?></td>
                         <td><a class="delete_recode" href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/delele_record/<?=$send_result[$i]['id']?>"><i class="icon-remove"></i></a></td>
                    </tr>
        		<?php }?>
                		  
                	
            </tbody>
        </table> -->
        <div class="jumbotron" id="msg-box-all-mail-send">
          <h5><i class="icon-spinner icon-spin"></i> We are working on Email Accounts!!!</h5>
          <h6><span class="to"></span> <span class="error"></span></h6>
    	  </div>
        <?php if($new_entry==true){?>
                		<tr>
                    	 <td class="5"><a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/send_varification_to_all">
                         		<span class="label label-important">Send Verification To All Member</span>
                         </a></td>
                    </tr>
                <?php } ?>
        
    </div>
  </div>
</div>
</div>

<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="3%">Id</th>
          <th>Name</th>
          <th width="15%">Username</th>
          <th width="15%">Password</th>
          <th>Email Id</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<style>
.sendbtn{
	border:none;
	padding:0px 10px;
}
.clsbtn{
	color:#FFF;
}
	
.membertable{
	overflow-x: auto;
}
.show_msg{
	color: #BD2323;
	margin-left: 5px;
}	
.email-to-all-div{
	display:none;
}
.tbl-color{
	background-color:#EFC9C9;
}
.delete_recode, .delete_recode:hover{
	color:#666;
	text-decoration:none;
	font-size:16px;
}
</style>
