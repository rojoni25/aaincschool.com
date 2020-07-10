
<script>
	$(document).ready(function(e) {
		
		$(document).on('submit','#form2',function(e){
			
			
			if($('#membercode').val()==''){
				alert('Select Member !');
				$('#membercode').focus();
				return false;
			}
			var sel=$("#membercode :selected").text();
			var con=confirm('Are You Sour Remove "'+sel+'" From Product True');
			if(!con){
				return false;
			}
		});
		
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Product Member Remove</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Paid Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
        <li><a href="#">Member</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Remove From Tree</li>
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
	<br />
<div class="row-fluid">
  <div class="span12">
    	<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/remove_from_true" enctype="multipart/form-data">
       		
          <div class="control-group">
            <label class="control-label">Select Member</label>
            <div class="controls">
              <select id="membercode" name="membercode" class="span12 {validate:{required:true}}">
              		<option value="">Select Memebr</option>
                    <?php for($i=0;$i<count($member_list);$i++) {?>
                    	<option value="<?=$member_list[$i]['usercode']?>"><?=$member_list[$i]['name']?></option>
                    <?php } ?>
              </select>
            </div>
          </div>
          <!------------------>
         
        
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Remove From Paid</button>
          
          </div>
        </form>
  </div>
</div>
