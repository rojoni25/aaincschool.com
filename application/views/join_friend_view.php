
<script>
	$(document).ready(function(e) {
        $(document).on('click', '.btnclssubmit', function (e) {
			var company_code 	= $(this).attr('company_code');
			var value   = $('#txtref'+company_code).val();
			var url='<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/add_company/'+company_code+'/'+value;
			
			$.ajax({url:url,success:function(result){		 	
            	alert('Save Successfully');
			}});	
		});	
		
		$(document).on('click', '.test_link', function (e) {
			e.preventDefault();
			var company_code 	= $(this).attr('company_code');
			var value   = $('#txtref'+company_code).val();
			var url = $(this).attr('url');
			
			var current_url = url.replace("membercode",value);
			window.open(current_url,'_blank');
			
		});		
    });
</script>

<div class="row">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
   <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Friend</a> </li>
    <li class="active-bre"><a href="#"> Join Friend</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
    <div class="tz-2-com tz-2-main">
      <h4>Join Friend</h4>
		<!------------>
		<br>
		<div class="col-md-12" style="margin-bottom:30px;">
		  <?php
				if($contain[0]['video_url']!=''){
					echo '<div class="video_frm">';
					echo '<div class="inner_frm">';
					if (strpos($contain[0]['video_url'], 'youtube') !== false)
					{
						echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
					}
					echo '</div>';
					echo '</div>';
				}
		                    
		                    ?>
		</div>

		<div class="">
		  <div class="col-md-12 membertable">
		    <table class="table table-striped table-bordered" id="data-table">
		      <thead>
		        <tr>
		          <th width="5%">Logo</th>
		          <th width="15%">Company Name</th>
		          <th width="25%">Description</th>
		          <th>Ref Url</th>
		          <th>Your Username or ID</th>
		          <th width="15%">Opration</th>
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
	.btnclssubmit{
		border:none;
		padding: 6px 8px;
	}
	.mycomp {
    	background-color: #ECB2B2 !important;
	}
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
	
@media  only screen and (max-width: 1150px){

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
	content: "Logo";
}
.membertable td:nth-of-type(2):before {
	content: "Company Name";
}
.membertable td:nth-of-type(3):before {
	content: "Description";
}
.membertable td:nth-of-type(4):before {
	content: "Ref Url";
}
.membertable td:nth-of-type(5):before {
	content: "Your Username or ID";
}
.membertable td:nth-of-type(6):before {
	content: "Opration";
}
.membertable1 td:nth-of-type(1):before {
	display:none;
}
.membertable1 td:nth-of-type(2):before {
	display:none;
}
.membertable1 td:nth-of-type(1){
	margin-left:-49%;
}
.membertable1 td:nth-of-type(2){
	margin-left:-49%;
}


}

@media  only screen and (max-width: 500px){
.video_frm {
    width: 330px;
	height: 233px;
 
}
.inner_frm {
  	height: 205px;
	width: 273px;
	margin-top: 14px;
	margin-left: 28px;
}
}
@media  only screen and (max-width: 360px){
.video_frm {
    width: 225px;
	height: 159px;
 
}
.inner_frm {
  	height: 139px;
    width: 186px;
    margin-top: 10px;
    margin-left: 19px;
}
}
</style>