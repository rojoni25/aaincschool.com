

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>






<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">CMS (Dreem Student) 
      
      <span class="pull-right"><a href="<?=base_url()?>index.php/dreem_student/ad_dashboard/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a></span>
      
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">CMS</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    	
       
      
             <table class="table table-striped table-bordered" id="data-table">
            	<thead>
                    <tr>
                        <th>Pagename</th>
                        <th>Page Title</th>
                        <th>Opration</th>
                        
   
                    </tr> 
                </thead>
                <tbody>
                	
                	<?php for($i=0;$i<count($result);$i++){ 
							
							echo '<tr>
								
								<td>'.$result[$i]['pagename'].'</td>
								<td>'.$result[$i]['title'].'</td>
								<td><a href="'.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/edit/'.$result[$i]['cms_pages_code'].'">Edit</a></td>
								
							</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>

<style>
	.cls_resiual{
		background-color:#E0AFA9;
	}
</style>







