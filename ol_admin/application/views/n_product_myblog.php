<div class="row-fluid ">  <div class="span12"><ul class="top-banner"></ul></div></div>

<script>
	$(document).on('click','.delete_blog',function(e){
		
		var url=$(this).attr('href');
		
		var tr=$(this).closest('tr');
		
		e.preventDefault();
		
		$.ajax({url:url,success:function(result){
		
			tr.remove();	
		
		}});
		
		
	});
</script>


<?php if($this->session->flashdata('show_msg')!=''){?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
        </div>
<?php }?>


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">AMS My Blog
        <a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/add_new/Add"><button type="button" class="btn btn-info btn_padding">New Blog</button></a>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">AMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">My Blog</li>
    </ul>
  </div>
</div>



   
    
<div class="row-fluid">
  <div class="span12 membertable">
     <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="10%">Id</th>
            <th>Title</th>
            <th>Create Date</th>
            <th>Optation</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++){
			echo '<tr>
				<td>'.$result[$i]['id'].'</td>
				<td>'.$result[$i]['title'].'</td>
				<td>'.date('d-m-Y',$result[$i]['create_date']).'</td>
				<td>
				
					<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/add_new/Edit/'.$result[$i]['id'].'"><i class="icon-edit"></i></a>
					<a class="delete_blog" href="'.base_url().'index.php/'.$this->uri->segment(1).'/delete_blog/'.$result[$i]['id'].'"><i class="icon-remove"></i></a>
				 
				</td>
			</tr>';	
		}?>
       </tbody>
    </table>
  </div>
</div>

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
	content: "Name";
}
.membertable td:nth-of-type(3):before {
	content: "Mobile No";
}
.membertable td:nth-of-type(4):before {
	content: "Email Id";
}
.membertable td:nth-of-type(5):before {
	content: "Verified";
}

}
</style>
