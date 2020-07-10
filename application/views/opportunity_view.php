<!--Send Notification and Email on clicking join button-->
<script>
    function notifyOnJoining(id,url){
        var url="<?php echo base_url();?>index.php/opportunity/";
        $.ajax({
          type: "POST",
          url: url,
          id: id,
          success: function(data){
              var win = window.open(url, '_blank');
              win.focus();
          }
        });
    }
    
</script>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Pages</a> </li>
    <li class="active-bre"><a href="#"> Opportunity Pages</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
    <div class="tz-2-com tz-2-main">
      <h4>Opportunity Pages</h4>
    <div class="  ">
      <div class="col-md-12">
        <div class="primary-head text-right">
          <h3 class="page-header">
              <a style="" href="<?php echo base_url();?>index.php/opportunity/page"><button type="button" class="btn btn-info btn_padding">View You Money Train</button></a>

              <a style="" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/addnew/Add"><button type="button" class="btn btn-info btn_padding">Add New Opportunity</button></a>
          </h3>
        </div>
      </div>
    </div>
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
    <div class="">
      <div class="col-md-12 membertable">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th>Logo</th>
              <th>Company Name</th>
              <th>Page Name</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?=$html?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>  

<style>
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
	.btncls{
		border:none;
	}
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
	content: "Logo";
}
.membertable td:nth-of-type(2):before {
	content: "Company Name";
}
.membertable td:nth-of-type(3):before {
	content: "Page Name";
}
.membertable td:nth-of-type(4):before {
	content: "Update";
}

}
</style>