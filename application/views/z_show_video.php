<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Video Show</title>
</head>
<style>
	body{
		margin:0px;
		padding:0px;
		background:#CCC;
	}
	.vid_div{
		width:500px;
		height:400px;
		margin:auto;
	}
	iframe{
		width:1350px;
		height:680px;
	}
</style>
<body>

<div class="vid_div1">
<?php
	
				
	if ($video_link[0]['type']== 'youtube')
		{
			echo '<iframe width="100%" height="100%" src="'.$video_link[0]['media_link'].'" frameborder="0" allowfullscreen></iframe>';
		}
		else{
			echo '<video width="100%" height="100%" controls="controls"><source src="'.$video_link[0]['media_link'].'" type="video/mp4"></video>';
		}
		
?>
</div>
</body>
</html>