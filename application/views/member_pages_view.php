<script>
	$(document).ready(function(e) {
		
		
		$('#data-table').dataTable({});
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page/'+pagecode+'/<?=$this->session->userdata['logged_ol_member']['username']?>';
			
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		
		
    });
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Pages
        <?php if($this->session->userdata['logged_ol_member']['status']=='Active'){?>
        <span style="float:right;margin-right:10px;"> <a href="<?=base_url();?>index.php/member_pages/member_page_add/Add" style="float:right;">
        <button type="button" class="btn btn-info"><strong>Add New Page</strong></button>
        </a> </span>
        <?php } ?>
      </h3>
    </div>
  </div>
</div>
<div class="row-fluid ">
  <div class="">
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
  <div style="margin-top:30px;">
    <div class="txtdiv">
      <?=$contain[0]['textdt']?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Page Name</th>
          <th>URL</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
        <?=$html?>
      </tbody>
    </table>
  </div>
</div>
<style>
	@media  only screen and (max-width: 500px){

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
		content: "Page Name";
	}
	.membertable td:nth-of-type(2):before {
		content: "URL";
	}
	.membertable td:nth-of-type(3):before {
		content: "Opration";
	}
	
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
	@media  only screen and (max-width: 1200px){
		.span6{
			float:none !important;
			width:100%;
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
