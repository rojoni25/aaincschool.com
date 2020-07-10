<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Blog 
      <a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/blog_list">
        	<samp class="label label-success">Back</samp>
        </a> </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">AMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">My Blog</li>
    </ul>
  </div>
</div>
<?php $author			=	($result[0]['usercode']=='-1') ? "Admin" : $result[0]['name']; ?>
	<div class="row-fluid">
  <div class="span12">
    <div class="content-widgets">
      <div>
        <div class="widget-header-block">
          <h4 class="widget-header blog-title">
		  		<?=$result[0]['title']?>
               	<span class="pull-right blog-auther">By : <font style="color:#96233c"><?=$author?></font></span>
          </h4>
        </div>
        <div class="content-box">
          <?=$result[0]['description']?>
        </div>
        
      </div>
    </div>
  </div>
</div>



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
