<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>







<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Capture Page (DFSM)
      	 <span class="pull-right">
        <a href="<?=base_url()?>index.php/m2m/capture_master/add/add" class="btn btn-success" href="#" style="font-family:Verdana, Geneva, sans-serif;">Add New Page</a>
         <a href="<?=base_url()?>index.php/m2m/page/view/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a></span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">DFSM Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Capture Page</li>
    </ul>
  </div>
</div>






<div class="row-fluid">
  <div class="span12">
    	
      
        <table class="table table-striped table-bordered">
            	<thead>
                    <tr>
                        <th>Sr</th>
                        <th>Page Name</th>
                        <th>Link</th>
                        <th>Option</th>
                        
                    </tr> 
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($result);$i++){ 
						$row=$i+1;
		
                    	echo '<tr>
                        		<td>'.$row.'</td>
								<td>'.$result[$i]['page_name'].'</td>
                            	<td>'.base_url().'index.php/capture/m2m/'.$result[$i]['page_code'].'/'.$this->session->userdata['logged_ol_member']['username'].'</td>
								<td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-danger btn-xs dropdown-toggle" type="button" id="btnGroupDrop1">Operation
											<span class="caret"></span></button>
											<ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu" style="background-color:#d0cfd6;">
											<li><a href="'.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/add/edit/'.$result[$i]['page_code'].'" class="edit_rcd">Edit</a></li>
											<li><a href="#" class="pageperview" value="267">Preview</a></li>
											
											<li><a href="'.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/cp_delete/'.$result[$i]['page_code'].'" class="page_priview_reg" value="267">Delete</a></li>
											
											</ul>
										</div>
								</td>
                        	</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>




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
.cls_head_btn{
	font-family: Arial, Helvetica, sans-serif;
}

.dropdown-menu{
	background-color:#CCC !important;
}

@media  only screen and (max-width: 535px){
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








