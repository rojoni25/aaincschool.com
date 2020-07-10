<link rel="stylesheet" href="<?=base_url();?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url();?>asset/popover/jquery.webui-popover.min.js"></script>
<script>
	$(document).on('click', '.addnew', function (e) {
		e.preventDefault();
		var html='<tr><td width="15%">Description</td><td width="1%">:</td><td width="84%">';
		html+='<textarea id="description[]" name="business[]" class="span12"  placeholder="Enter Description"></textarea></td></tr>';
		$('#tab_business').append(html);
	})
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=$this->load->view('vma/top_banner')?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
     
      <h3 class="page-header">What business do you want to market</h3>
    </div>
  </div>
</div>
<div class="row-fluid">
	
  <div class="">
   		<form class="form-horizontal left-align" id="form2" method="post" action="<?=vma_base()?><?=$this->uri->rsegment(1)?>/insert_info_business" enctype="multipart/form-data">
        	<table class="table">
            	<tr>
                	<td width="15%">Name</td>
                    <td width="1%">:</td>
                    <td width="84%"> <input id="name" name="name" value="<?=$result[0]['name']?>" class="span12" type="text" placeholder="Name"/></td>
                </tr>
                <tr>
                	<td>Link</td>
                    <td>:</td>
                    <td><input id="link" name="link" value="<?=$result[0]['link']?>" class="span12" type="text" placeholder="Enter Link"/></td>
                </tr>
                <tr>
                	<td>Description / Type</td>
                    <td>:</td>
                    <td>
                    	<textarea id="description" name="description" class="span12"  placeholder="Enter Description"><?=$result[0]['description']?></textarea>
                    </td>
                </tr>
                 <tr>
                	<td></td>
                    <td></td>
                    <td><strong>How many business do you want to market</strong> <br /> 
                    	<a class="addnew" href="#"><span class="label label-success">Add</span></a>
                    </td>
                </tr>
            </table>
            
            <?php
            	$business_info=json_decode($result[0]['business_info'],true);
				
			?>
            
            <table class="table" id="tab_business">
            	<tbody>
                   <?php for($i=0;$i<count($business_info);$i++) { ?>
                   		<tr>
                        	<td width="15%">Description</td>
                            <td width="1%">:</td>
                            <td width="84%"><textarea id="description[]" name="business[]" class="span12"  placeholder="Enter Description"><?=$business_info[$i]?></textarea></td>
                         </tr>
                   <?php } ?>
                </tbody>
            </table>
            
             <table class="table">
           	 <tr>
                	<td width="15%"></td>
                    <td width="1%"></td>
                    <td width="84%"> <button type="submit" class="btn btn-primary btnsubmit">Submit</button></td>
                </tr>
              </table>  
             
        </form>
  </div>
</div>

