<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<script src="<?php echo base_url(); ?>ol_admin/asset/js/jquery-ui-1.10.1.custom.min.js"></script>
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script>
	$(document).ready(function(e) {
        	bind_tree(<?=$id?>);
    });
	
	$(document).on('click','.next_level',function(e){
		
		e.preventDefault();
		var value	=	$(this).attr('href');
		bind_tree(value);
		
	});
	
	$(document).on('click','.set_upling',function(e){
		e.preventDefault();
		var value	=	$(this).attr('href');
		var sname	=	$(this).attr('sname');
		$('#select_downline').val(value);
		$('#selected_name').html(sname);
		$.magnificPopup.close();
		
	});
	
	
	
	$(document).on('click', '.set_member', function (e) {
		e.preventDefault();
		var value 		= $(this).attr('href');	
		var url='<?php echo base_url();?>index.php/r_matrix_tree/get_upling_path_for_pop_up/'+value;
		
		$.ajax({url:url,success:function(result){	
			var data=$.parseJSON(result);
			var html='<span>'+data['msg']+'</span> <a class="set_upling" href="'+value+'" sname="'+data['msg']+'"><button class="btn btn-success">Set</button></a>';
			$('.selected_memebr').html(html);
        }});
		
		
		
	});
	
	$(document).on('click','.btnsearch', function (e) {
		if($('#meberserch').val()==''){
			$('#meberserch').focus();
			return false;
		}
		
		var url='<?php echo base_url();?>index.php/r_matrix_tree/find_member/'+$('#meberserch').val();
		$.ajax({url:url,success:function(result){	
			$('.find_result').html(result);
        }});
		
	});
	
	
		
		$(document).on('change','#multi_position',function(e){
			var value	=	$(this).val();
			bind_tree(value);
			
		});
		
		function bind_tree(value){
			$('.find_result').html('');
			$('#meberserch').val('');
			
			$('.treeinner').html('<h2 class="show_msg">Lording</h2>');
			var url='<?php echo base_url();?>index.php/r_matrix_tree/tree_drow/'+value;
			$.ajax({url:url,success:function(result){	
				var data=$.parseJSON(result)
				$('.treeinner').html(data['tree']);
				$('.breadcrumb').html(data['breadcrumb']);
				$('.position_html').html(data['postion']);
        	}});
		}
	
</script>
<style>
.mfp-content {
	width: 1000px !important;
	background-color: #fff;
	padding: 15px;
	padding-bottom: 30px;
	margin: 20px auto;
	min-height:480px !important;
}
.fromclose {
	float: right;
	text-decoration: none;
	color: #333;
}
.right_fol {
	float: right;
	text-decoration: none;
	margin-right: 10px;
	color: #333;
}
.right_fol:hover {
	text-decoration: none;
}
.fromclose:hover {
	text-decoration: none;
	color: #333;
}
#h2_head {
	font-size: 20px;
}
.table_popup {
	font-size: 15px;
}
.search_txt{
	margin-left:10px;
	font-weight:bold;
}
</style>
<body>
 
<h2>
  <h2 id="h2_head"><span class="selected_memebr"></span><a class="popup-modal-dismiss fromclose" href="#" title="Close"><i class="icon-remove"></i></a></h2>
</h2>

<div class="pull-left">
     <input type="text" id="meberserch" value="" placeholder="Search Member" />
      <input type="hidden" id="user_code" />
      <a href="#" class="btnsearch"><button type="button" class="btn btn-info" style="margin-top:-11px;">Search</button></a>
</div>
<div class="pull-left find_result">
</div>
<div class="pull-right position_html"></div>
<div style="clear:both;overflow:hidden;"></div>

 <ul class="breadcrumb">
 </ul>

<div class="treediv">
  <div class="treeinner"> </div>
  <!----treeinner------> 
</div>
</div>
</body>
</html>
<style>
.treeinner {
	width: 960px;
	margin: auto;
}
.treediv {
	width: 100%;
	overflow: auto;
	direction: rtl;
}
.child3 {
	width: 25%;
	list-style: none;
	margin: 0px;
	padding: 0px;
	padding-top: 10px;
	position: relative;
	float: left;
 background-image:url(<?=base_url();
?>asset/images/multitree/120.png);
	background-repeat: no-repeat;
	background-position: 49.2% 0px;
}
.thirdchild {
	margin-right: 20px;
}
.child3 li {
	width: 50%;
	float: left;
	text-align: center;
	position: relative;
}
.child3 li p {
	font-size: 12px;
}
.child3 .line {
	position: absolute;
	top: -9px;
	left: 49%;
}
.child2 {
	width: 50%;
	list-style: none;
	margin: 0px;
	padding: 0px;
	padding-top: 10px;
	position: relative;
	float: left;
 background-image:url(<?=base_url();
?>asset/images/multitree/240.png);
	background-repeat: no-repeat;
	background-position: 50% 0px;
}
.child2 li {
	width: 50%;
	float: left;
	text-align: center;
	position: relative;
}
.child2 li p {
	font-size: 12px;
}
.child2 .line {
	position: absolute;
	top: -9px;
	left: 50%;
}
.clear {
	clear: both;
	overflow: hidden;
}
.child1 {
 background-image:url(<?=base_url();
?>asset/images/multitree/480.png);
	background-repeat: no-repeat;
	background-position: 50% 0px;
	width: 100%;
	list-style: none;
	margin: 0px;
	padding: 0px;
	margin-left: 5px;
	padding-top: 10px;
	position: relative;
}
.child1 li {
	width: 50%;
	float: left;
	text-align: center;
	position: relative;
}
.child1 li p {
	font-size: 12px;
}
.child1 .line {
	position: absolute;
	top: -9px;
	left: 50%;
}
.linehr {
	position: absolute;
	left: 49%;
	top: -39px;
}
.linehr2 {
	position: absolute;
	left: 49.5%;
	top: -45px;
}
.linehr1 {
	position: absolute;
	left: 49.5%;
	top: -45px;
}
.colorcode {
	list-style: none;
	margin: 0px;
}
.colorcode li {
	float: left;
	margin-right: 15px;
}
.table td {
	padding: 3px !important;
	line-height: 21px !important;
}
.show_msg{
	color:#F00;
	text-align:center;
}
.selected_memebr{
	font-size:14px !important;
}
</style>
