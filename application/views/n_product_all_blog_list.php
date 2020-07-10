<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Blog <a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/my_blog/">
        <button type="button" class="btn btn-info btn_padding"><strong>My Blog</strong></button>
        </a> </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">AMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">My Blog</li>
    </ul>
  </div>
</div>
<?php for($i=0;$i<count($result);$i++){
		$author			=	($result[$i]['usercode']=='-1') ? "Admin" : $result[$i]['name'];
		$description	= 	substr(strip_tags($result[$i]['description']), 0, 500);
		 
	?>
	<div class="row-fluid">
  <div class="span12">
    <div class="content-widgets">
      <div>
        <div class="widget-header-block">
          <h4 class="widget-header blog-title">
		  		<?=$result[$i]['title']?>
               	<span class="pull-right blog-auther">By : <font style="color:#96233c"><?=$author?></font></span>
          </h4>
        </div>
        <div class="content-box">
          <?=$description?>
        </div>
        <div class="blog-footer">
        	<a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/blog_detail/<?=$result[$i]['id']?>" class="blog-readmore"><button type="button" class="btn btn-success">Read More <i class="icon-arrow-right"></i></button></a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } ?>

<style>
	.blog-title{
		border-bottom:#666 dotted 1px;
		margin-bottom:10px;
	}
	.blog-auther{
		font-size:14px;
	}
	.blog-readmore{
		font-weight:bold;
	}
	.blog-footer{
		margin-top:10px;
	}
</style>
