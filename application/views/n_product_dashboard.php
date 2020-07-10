
<?php
	$product1=$this->asm_class->check_product(1);
	$product2=$this->asm_class->check_product(2);
?>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>


    <div class="row-fluid">
      <div class="span12">        
         <div class="primary-head"><h3 class="page-header">Dashboard AMS</h3></div>
        	<div class="switch-board gray">
          		<ul class="clearfix switch-item switch_item_custom">
                	 <?php if($product1) {?>
            			<li><a href="<?=base_url()?>index.php/n_product/training/1" class="brown"><i class="icon-folder-open"></i><span>Training $15</span></a></li>
                    <?php } ?>
            		
                    <?php if($product2) {?>
                    	<li><a href="<?=base_url()?>index.php/n_product/training/2" class="magenta"><i class="icon-folder-open"></i><span>Training $100</span></a></li>
                  		
                    	<li><a href="<?=base_url()?>index.php/n_product_blog/blog_list" class="blue-violate"><i class="icon-star"></i><span>My Blog</span></a></li>
                    <?php } ?>
                    
       
                    <li><a href="<?=base_url()?>index.php/auto_responder_email" class="blue"><i class="icon-time "></i><span>Auto Responder Email</span></a></li>
       
       
     
          		</ul>
        	</div>
      </div>
    </div>

		<?php 
			if(!$product2){
				
				$arr=array();
				$arr['product']='2';
				$arr['text']='One Time Payment $100 for 6 Months.';
				
				echo '<div class="row-fluid">
						<div class="primary-head"><h3 class="page-header">Payment Online</h3></div>
						<div class="span4" style="margin-left:0px;">'.get_buttton($arr).'</div>
					</div>';
				
				if(!$product1){
					
					$arr=array();
					$arr['product']='1';
					$arr['text']='One Time Payment $15 for 1 Months.';
				
					echo '<div class="row-fluid">
							<div class="primary-head"><h3 class="page-header">Payment Online</h3></div>
							<div class="span4" style="margin-left:0px;">'.get_buttton($arr).'</div>
						</div>';	
					}
				
			}
		?>
		
	    			
		

 
 
 
 



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
.txtdiv{
	width:90%;
	position:relative;
	margin:auto;
}
.pay_div_cls .n-sources{
	font-size:21px !important;
	padding:15px 0px;
}
.pay_div_cls .board-widgets-botttom a{
	font-size:16px !important;
	padding:10px 10px;
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


	.switch_item_custom li{
		width:250px;
		height:100px;
	}
	.switch_item_custom li a{
		width:250px;
		height:100px;
	}
	.switch_item_custom li p{
		font-size:20px !important;
		font-weight:bold;
		padding-top:20px;
		color:#FFF;
	}
	.switch_item_custom li a span {
		font-weight:bold;
		font-size:14px !important;
	}
	
	

</style>


<?php 
	function get_buttton($arr)
	{
		$html='<div class="board-widgets bondi-blue">
			<a href="'.base_url().'index.php/n_product/detail/'.$arr['product'].'">
    			<div class="board-widgets-content">
                	<span class="n-sources">'.$arr['text'].'</span>
    				<p><img src="'.base_url().'asset/images/credit_card_img.gif" /></p>
    			</div>
			
    	</a>
    		<div class="board-widgets-botttom">
					<a href="'.base_url().'index.php/n_product/detail/'.$arr['product'].'">Click For Online Payment</a>
			</div></div>';
		return $html;
	} 
?>

