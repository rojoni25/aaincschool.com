<script>
	$(document).ready(function(e) {
		var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing';
		$.ajax({url:url,success:function(result){		 	
        	$('#data-table2 tbody').html(result);
		}});
		
		$(document).on('click', '.remove_record', function (e) {
			e.preventDefault();
			var url=$(this).attr('href');
			var con=confirm('Are You Sure You Want To Delete Request');
			if(!con){
				return false;
			}
			var tr=$(this).closest('tr');
			$.ajax({
				url:url,
				success: function(result){
					tr.remove();
				}
			})
		});
       
	   
	  
	   
    });
</script>

<div class="row">    
  <ul class="top-banner"></ul>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Friend</a> </li>
    <li class="active-bre"><a href="#"> Request To Renewal Friend</a> </li>
  </ul>
</div>    
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Request To Renewal Friend</h4>
    <div class="  ">
      <div class="col-md-12">
        <div class="primary-head text-right">
          <h3 class="page-header">
              <?php if($balance['main_balance'] >=CW_MIN || $balance['personal_wallet'] >=PW_MIN) { ?>
	          	<a style="" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/send_request">
	            	<button type="button" class="btn btn-success btn_padding"><strong>Send Request</strong></button>
	            </a>
	            <?php } ?>
          </h3>
        </div>
      </div>
    </div>
    <br>

    
    <?php if($this->session->flashdata('msg')!=''){?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('msg')?></strong>
            </div>
    <?php } ?>
   
    
    <div class="">
      <div class="col-md-12 membertable">
         <table class="table table-striped table-bordered" id="data-table2">
          <thead>
            <tr>
              <th width="10%">Usercode</th>
              	<th>username</th>
              	<th>Name</th>
             	<th>Mobile No</th>
              	<th>Date</th>
                <th>Status</th>
               
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
	.remove_record, .remove_record:hover{
		color:#333;
		font-size:14px;
		text-decoration:none
	}
</style>
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
	content: "Username";
}
.membertable td:nth-of-type(3):before {
	content: "Name";
}
.membertable td:nth-of-type(4):before {
	content: "Mobile No";
}
.membertable td:nth-of-type(5):before {
	content: "Date";
}
.membertable td:nth-of-type(6):before {
	content: "Status";
}

}
</style>