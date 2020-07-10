<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>


<script>
	$(document).ready(function(e) {
       	var url 	= '<?=vma_ad()?><?=$this->uri->rsegment(1)?>/get_tree/<?=$this->uri->rsegment(3)?>';
		$.ajax({url:url,
				beforeSend: function(){
     				
   				},
   				complete: function(){
     				
   				},
				success:function(result){
					
					var json = $.parseJSON(result);
					
					$('#tree_panel').html(json['tree']);
					$('#upling_chain').html(json['upling_chain']);
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			}); 
    });
	
	 $(document).on('click', '.tree-user', function (e) {
		e.preventDefault();
		var url 		= $(this).attr('href');
			$.ajax({url:url,
				beforeSend: function(){
     				$('#tree_panel').html('<div class="loading-div"><i class="fa fa-spinner fa-spin"></i></div>');
   				},
   				complete: function(){
     				
   				},
				success:function(result){
					
					var json = $.parseJSON(result);
					$('#tree_panel').html(json['tree']);
					$('#upling_chain').html(json['upling_chain']);
					
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
	});
	
	$(document).on('click', '.select_user', function (e) {
		e.preventDefault();
		var val  =  $(this).attr('href');
		var url 	= '<?=vma_ad()?><?=$this->uri->rsegment(1)?>/select_user/'+val;
		
		$('#selected_user_code').val(val);
		
		$.ajax({url:url,
				beforeSend: function(){
     				
   				},
   				complete: function(){
     				
   				},
				success:function(result){
					var json = $.parseJSON(result);
					$('#select_position_chain').html(json['upling_chain']);
					$.magnificPopup.close();
					
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
		
	});
		 
	
</script>

<body>
<h5>Tree1
  <div class="pull-right"> <a class="popup-modal-dismiss fromclose"><i class="icon-remove"></i></a> </div>
</h5>
	<p id="upling_chain"></p>
    <div id="tree_panel">
    </div>

</body>
</html>
<style>
.mfp-content {
	width: 1000px !important;
	background-color: #fff;
	padding: 15px;
	padding-bottom: 30px;
	margin: 20px auto;
	min-height: 480px !important;
}
</style>
<style>
.loading-div {
	text-align: center;
}
.loading-div i {
	font-size: 30px;
}
#tree_panel {
	width: 100%;
	margin: auto;
}
.level-1 {
	height: 81px;
 background-image:url(<?=base_url()?>asset/images/multitree/44.png);
	background-repeat: no-repeat;
	background-position: 50% 120%;
}
.center {
	text-align: center;
	margin: 0px;
}
.div2-divider {
	margin-top: 30px;
	width: 66.66%;
	margin: auto;
	border-top: #000 solid 1px;
	height: 1px;
}
.level-2 {
	margin-top: -2px;
}
.tree-node {
	width: 33.33%;
 background-image:url(<?=base_url()?>asset/images/multitree/44.png);
	background-repeat: no-repeat;
	background-position: 50% 1px;
	padding-top: 44px;
}
.level-3-section {
	width: 33.33%;
	float: left;
}
#upling_chain ul {
	list-style: none;
	margin: 0px;
	padding: 0px;
}
#upling_chain ul li {
	display: inline;
}
#upling_chain ul li i {
	font-weight: bold;
	margin: 0px 10px;
}
</style>
