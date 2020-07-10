<?php
	//echo "<pre>";	print_r($result); exit();
       	if($page_section=='capture_page'){
			$title='Company Pages';
		}
		elseif($page_section=='my_page'){
			$title='My Pages';
		}
		
		elseif($page_section=='vma_page'){
			$title='VMA Pages';
		}
		elseif($page_section=='travel_page'){
			$title='Travel Pages';
		}
		else{
			$title = getconfigMeta('comanyshortname').' Pages';
		}
		$newUrlData = $result[0]['after_reg_new_tab'];
        
		
		
?>
<script src="<?=base_url();?>asset/js/datatable.js"></script>
<script src="<?=base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">

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

			if($("#after_reg_new_tab_op").prop("checked")){
          newwin1=window.open($("#after_reg_new_tab").val(),'', params);
         
          if (window.focus) {newwin1.focus()}
        }
			//***********//
		});
		
		$(document).on('click', '.page_priview_reg', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/pages/after_reg_preview/'+pagecode+'';
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}

					 if($("#after_reg_new_tab_op").prop("checked")){
          newwin1=window.open($("#after_reg_new_tab").val(),'', params);

          if (window.focus) {newwin1.focus()}
        }
			//***********//
		});
		
		$(document).on('click', '.report_issue_popup', function (e) {
			var pagecode=$(this).attr('value');
			var url='<?php echo base_url();?>index.php/capture_pages/report_issue_popup/'+pagecode;
			e.preventDefault();
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
    });
</script>

<input style="display: none;" type="checkbox" name="after_reg_new_tab_op" value="Y" id="after_reg_new_tab_op" <?=$result[0]['after_reg_new_tab']?> >
    <input type="hidden" id="after_reg_new_tab" name="after_reg_new_tab" placeholder="url" value="<?=$result[0]['after_reg_new_tab']?>" >

<div class="row">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="sb2-2-2">
  <ul>
     <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Capture Pages</a> </li>
    <li class="active-bre"><a href="#"> <?=$title?></a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
  	<div class="tz-2-com tz-2-main">
	  	<h4>  <?=$title?> 
	  	<?php
        $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
        $referralcount = countreferral($loginusercode);
        if($referralcount>=3){
      ?>
          <span class="pull-right">
            <a href="#" class="btn btn-primary btn-sm" style="padding: 5px;height: 30px;"><strong> Qualified</strong></a>
          </span>
      <?
        }else{
      ?>
          <span class="pull-right">
            <a href="#" class="btn btn-danger btn-sm" style="padding: 5px;height: 30px;"><strong>Not Qualified</strong></a>
          </span>
      <?    
        }
      ?>
      <?
     if($this->session->userdata['tbl']['current_account']=='Pending')
      {
      ?>
        <span class="" style="color: #fff;padding-left: 10px;">
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?></span>
        </span>
        <span class="" style="color: #fff;padding-left: 30px;"> 
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?> /per month</span>
        </span>
      <?
      }else{
       $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
      ?>
        <span class="" style="color: #fff;padding-left: 10px;">
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$<?=GetPaidReferalWallet($loginusercode)?></span>
        </span>
        <span class="" style="color: #fff;padding-left: 30px;"> 
          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
          <span style="color: yellow;font-size: 20px;">$0 /per month</span>
        </span>
      <?  
      }
      ?>
	  	</h4>
	  	<div class="">
			<div class="">
				<div class="tz-2-main-2"> 
					<a class="linkbtn" href="<?=base_url();?>index.php/capture_pages?page_section=main_page"><button type="button" class="btn btn-warning"><strong><?=$title?></strong></button></a>

	                
	                <?php if($this->session->userdata['logged_ol_member']['status']=='Active'){ ?>
	                <a class="linkbtn" href="<?=base_url();?>index.php/capture_pages?page_section=my_page"><button type="button" class="btn btn-info"><strong>My Pages View</strong></button></a>
	                <a class="linkbtn" href="<?=base_url();?>index.php/capture_pages/page_thum_list/Add"><button type="button" class="btn btn-success"><strong>Add New Page</strong></button></a>
	                <?php } 
	                else{ ?>

	                <!--<a class="linkbtn" href="<?=base_url();?>index.php/capture_pages/add_new_page/Add/8"><button type="button" class="btn btn-success"><strong>Make capture pages</strong></button></a>

	                <a class="linkbtn" href="<?=base_url();?>index.php/capture_pages?page_section=capture_page"><button type="button" class="btn btn-danger"><strong>Company Pages</strong></button></a>

	                <a class="linkbtn" href="<?=base_url();?>index.php/capture_pages?page_section=travel_page"><button type="button" class="btn btn-primary"><strong>Travel Pages</strong></button></a>-->
	               	
	               <?php } ?>
				</div>	
			</div>
		</div>
		<div class="row">
		  	<div class="col-md-12 tz-2-main-com">
				<?php
				if($contain[0]['video_url']!=''){
					echo '<div class="video_frm">';
					echo '<div class="inner_frm">';
					if (strpos($contain[0]['video_url'], 'youtube') !== false)
					{
						echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						echo '<video width="100%" height="100%" controls><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
					}
					echo '</div>';
					echo '</div>';
				}
				
				?>
		  	
			  	<div style="margin-top:30px;">
				    <div class="txtdiv">
				      <?=$contain[0]['textdt']?>
				    </div>
				    <div style="clear:both;overflow:hidden;"></div>
			  	</div>
			</div>  	
		</div>

		<div class="db-list-com tz-db-table">
		  <div class="col-md-12 membertable table-responsive">
		    <table class="table bordered" id="data-table">
		      <thead>
		        <tr>
		          <th>Page Name</th>
		          <th>Page Type</th>
		          <th>Page Section</th>
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
	</div>
</div>
  	<input style="display: none;" type="checkbox" name="after_reg_new_tab_op" value="Y" id="after_reg_new_tab_op" <?=$after_reg_new_tab_op?> >

	<input type="hidden" id="after_reg_new_tab" name="after_reg_new_tab" placeholder="url" value="<?=$result[0]['after_reg_new_tab']?>" >
<script type="text/javascript">
	function copyUrl(id, username) {
		console.log(id);
		console.log(username);
	  var copyText = document.getElementById("myInput");
	  copyText.value="<?php echo base_url(); ?>index.php/capture/page/"+id+'/'+username;
	  copyText.style.display='block';
	  copyText.select();
	  document.execCommand("Copy");
	  copyText.style.display='none';
	  alert("Copied the text: " + copyText.value);
	}
</script>
<style>
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
	#compnay_page{
		float:right;
	}
	#capture_page{
		float:right;
		margin-right:10px;
	}
	#view_page{
		float:right;
		margin-right:10px;

	}
	#add_page{
		float:right;
		margin-right:10px;
	}
	#request_page{
		float:right;
		margin-right:10px;
	}
	.linkbtn{
		padding:2px;
	}
</style>
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
		content: "Page Type";
	}
	.membertable td:nth-of-type(3):before {
		content: "URL";
	}
	.membertable td:nth-of-type(4):before {
		content: "Update";
	}


}
@media  only screen and (max-width: 1110px){

	.page-header{
		height: 75px;
	}
	#request_page{
		margin-top:7px;
		margin-left:18%;
	}
}
@media  only screen and (max-width: 960px){
	#add_page{
		margin-top:7px;
		margin-left:22%;

	}

}
@media  only screen and (max-width: 840px){
	#request_page{
		margin-top:-35px;
		margin-left:0%;
	}
	#add_page{
		margin-top:-35px;
		margin-left:0%;

	}
	#view_page{
		margin-top:10px;
		margin-right:50px;

	}

}
@media  only screen and (max-width: 768px){
	#request_page{
		margin-top:0px;
		margin-left:0%;
	}
	#add_page{
		margin-top:0px;
		margin-left:0%;

	}
	#view_page{
		margin-top:0px;
		margin-right:10px;

	}

}
@media  only screen and (max-width: 660px){
	#request_page{
		margin-top:5px;
		margin-left:5%;
		float:left;
	}
	#add_page{
		margin-top:5px;
		margin-left:18%;

	}
	#view_page{
		margin-top:0px;
		margin-right:10px;

	}

}
@media  only screen and (max-width: 535px){
	#request_page{
		margin-top:5px;
		margin-left:0%;
		float:right;

	}
	#add_page{
		margin-top:5px;
		margin-left:0%;

	}
	#view_page{
		margin-top:10px;
		margin-right:10px;
		float:left;

	}

	.video_frm {
	   width: 284px;
	height: 200px;
	}

	.inner_frm {
	    height: 176px;
	    width: 235px;
	    margin-top: 12px;
	    margin-left: 24px;
	}
}
@media  only screen and (max-width: 476px){
	.page-header{
		height: 160px;
	}

	#request_page{
		
		float:right;
		margin-top:5px;

	}
	#add_page{
		float:left;
	}
	#view_page{
		margin-top:5px;
		float:right;
	}
	#capture_page{
		float:left;
		margin-top:10px;
	}
	#compnay_page{
		float:right;
		margin-top:40px;
	}

}
@media  only screen and (max-width: 310px){
	.video_frm {
	    width: 190px;
	    height: 134px;
	}

	.inner_frm {
	    height: 118px;
	width: 157px;
	margin-top: 8px;
	margin-left: 16px;
	}
}
</style>