<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Capture Page</title>
<script src="<?=base_url();?>asset/js/jquery.js"></script>

</head>
<style>
	body{
		background-color:#030000;
	}
	.topmargindiv{
		width:500px;
		min-height:300px;
		background-color:darkgoldenrod;
		margin:auto;
		position:relative;
	}
	.topmargindiv{
		padding:15px;
		position:relative;
	}
	.divmsg{
		font-size:20px;
		line-height:28px;
		color:#FFF;
	}
	.li_login{
		position:absolute;
		bottom:15px;
		left:15px;
	}
	.li_back{
		position:absolute;
		bottom:15px;
		right:15px;
	}
	
	.myButton {
		background-color:#030000;
		-moz-border-radius:4px;
		-webkit-border-radius:4px;
		border-radius:4px;
		display:inline-block;
		cursor:pointer;
		color:#ffffff;
		font-family:arial;
		font-size:17px;
		padding:16px 31px;
		text-decoration:none;
		text-shadow:0px 0px 6px #2f6627;
	}
	.myButton:hover {
		background-color:#030000;
	}

</style>
<body>
        <div class="topmargindiv">
            <div class="bodybackground"> 
            	<div class="divmsg"><?=$contain[0]['textdt']?></div>
                <a href="<?=base_url()?>index.php/login" class="li_login myButton">Login</a>
            	<a href="<?=$_REQUEST['r']?>" class="li_back myButton">Back</a>
            </div>
            
        </div>

</body>
</html>
<script>
	$(document).ready(function(e) {
      	resetall();
	    
    });
	$(window).resize(function(){
		resetall();
	});
	function resetall(){
		var windowHeight = $(window).height();
		var wbodybackground = $('.topmargindiv').height();
		var backmargin=(windowHeight-wbodybackground)/2;
		$(".topmargindiv").css("margin-top",backmargin+"px");
	}
</script>


