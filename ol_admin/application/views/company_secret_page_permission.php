<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script>
	$(document).ready(function(e) {
		$(document).on('click', '.cls_remove', function (e) {
			e.preventDefault();
			var tr=$(this).closest('tr');
			var url=$(this).attr('href');
			$.ajax({url:url,success:function(result){
				tr.remove();		
			}});
		});
		
		$('form#form2').on('submit', function (e) {				
			e.preventDefault();
			if($('#membername').val()==''){ $('#membername').focus(); return false; }
			var form = $(this);
			var post_url = form.attr('action');		
			$(".tblsubmit").html("<i class='icon-spinner icon-spin'></i> processing......");
			$.ajax({
					type: 'post',url: post_url,data: $(this).serialize(),
					success: function (result) {
						var data = $.parseJSON(result);	
						$('#membername').val('');						
						$(".tblsubmit").html(data['message']);
						$('#data-table tbody').append(data['html']);
					}
			});
		});
        //////////
	   		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/auto_camplate/<?=$this->uri->segment(3)?>',
                        minLength:1,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#user_code').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////
    });
</script>


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Page Member Permission<strong></strong></h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Page</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Page Member Permission</li>
    </ul>
  </div>
</div>
 <div>
 	<form class="form-horizontal" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/add_permission">
        <h5>Page Name : <?=$result[0]['page_name']?></h5>
        <input type="hidden" id="secret_page_code" name="secret_page_code" value="<?=$result[0]['secret_page_code']?>" />
        <input type="text" id="membername" value="" placeholder="Search Member" />
        <input type="hidden" id="user_code" name="usercode" />
        <button type="submit" class="btn btn-info btngoto"><strong>Add</strong></button>
        &nbsp;&nbsp;
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/">
        	<button type="button" class="btn btn-warning btngoto"><strong>Back</strong></button>
        </a>
        <p class="tblsubmit"></p>
   </form> 
    </div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Username</th>
          <th>Name</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
      <?=$html?>
      </tbody>
    </table>
  </div>
</div>

<style>
	.cls_remove, .cls_remove:hover{
		font-size:16px;
		color:#666;
		text-decoration:none;
	}
</style>
