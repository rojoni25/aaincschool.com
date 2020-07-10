<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">
<script>
	$(document).ready(function(e) {
		
		$(document).on('click', '.btnfilter', function (e) {
			e.preventDefault();
			$('.filter_main_div').toggle(1000);	
		});
		
        $(document).on('change', '#searchby', function (e) {
			var searchby=$('#searchby').val();

			$('.show_hide_div').hide();
			if(searchby=='date'){
				$('.filterdate_div').show(1000);
			}
			else{
			
				$('.filtertext_div').show(1000);
				
			}
		});
		////////////////
		$('form#filter_from').on('submit', function (e) {
			 e.preventDefault();
			 
			 var searchby=$('#searchby').val(); if(searchby==''){alert('Please Select Search By');$('#searchby').focus();return false;}
			 else if(searchby=='date'){if($('.txttodate').val()==''){alert('Please Select Date');$('.txttodate').focus();return false;}}
			 else if(searchby=='name'){var txtfilter=$('#txtfilter').val();if(txtfilter==''){alert('Enter Filter Text');$('#txtfilter').focus();return false;}}
			
			var form = $(this);
            var post_url = form.attr('action');
			$.ajax({
				type: 'post',url: post_url,data: $(this).serialize(),
				success: function (result) {
					$('#data-table').dataTable().fnClearTable();
					$(".tbody_table").html(result);
					$('#data-table').dataTable({"bProcessing": true,"iDisplayLength": 25,"bDestroy": true});
				}
           });
				
		});
		///////////////
		
    });
</script>

<script type="text/javascript">
  $(function() {
	  var nowDate = new Date();
	  var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+1, 0, 0, 0, 0);
    $('#todate').datetimepicker({ pickTime: false,endDate: today});
	 $('#fromdate').datetimepicker({ pickTime: false, endDate: today });
	
  });
</script>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Member Payment List
          	<a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/addnew/Add"><button type="button" class="btn btn-info btn_padding">New Payment</button></a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Member Payment</li>
        </ul>
      </div>
    </div>
    <!-----************************************----->
    <div class="row-fluid">
  <div class="span12">
  	<div class="content-widgets light-gray">
    	<div class="widget-head blue">
			<h3> <a href="#" class="btnfilter"><i class="icon-filter"></i></button>Filter</a></h3>
		</div>
        <div class="widget-container filter_main_div">
       <form action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/listing" method="post" id="filter_from">
    <div class="filter_table">
      <div class="pull-left">
        <select style="width:140px;height:34px;" name="searchby" id="searchby">
          <option value="">--Search By--</option>
          <option value="name">Name</option>
          <option value="date">Date</option>
        </select>
      </div>
       
       <?php
			$toadte = date('d-m-Y');
			$fromdate = date('d-m-Y');						
	   ?>
       <div class="pull-left filterdate_div show_hide_div">
            <div id="todate" class="input-append">
                <input data-format="dd-MM-yyyy" type="text" class="txttodate" name="todate" value="<?=$toadte?>" style="width:100px;"></input>
                <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                </span>
            </div>
       </div>
      <div class="pull-left filterdate_div show_hide_div">
        <div id="fromdate" class="input-append">
            <input data-format="dd-MM-yyyy" type="text" class="txtfromdate" name="fromdate" value="<?=$fromdate?>" style="width:100px;"></input>
            <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
        </div>
      </div>
     
       
       <div class="pull-left filtertext_div show_hide_div text_div">
        <input type="text" id="txtfilter" name="txtfilter" placeholder="Filter Text" style="width:140px;" />
      </div>
      
      <div class="pull-left">
        <button class="btn btn-success" type="submit">Filter</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="button">Refresh</button>
      </div>
      <div style="clear:both;overflow:hidden;"></div>
    </div>
    </form>
        </div><!-----widget-container-------------->
        </div><!------content-widgets light-grauy---------->
   
  </div>
</div>

    <!--------**********************************----------->
  
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Usercode</th>
              	<th>Name</th>
             	<th>Amount</th>
              	<th>Date</th>
                <th>Update</th>
            </tr>
          </thead>
          <tbody class="tbody_table">
            
           </tbody>
        </table>
      </div>
    </div>

<style>
	.btnfilter .active{
		background:#999;
	}
	.filter_table .txtbox{
		width:120px;
		margin:4px 4px;
	}
	.show_hide_div{
		display:none;
	}
	.filter_table .pull-left{
		margin-left:5px !important;
	}
	.btnfilter{
		color:#FFF;
		text-decoration:none;
	}
	.btnfilter:hover{
		text-decoration:none;
	}
	.filter_main_div{
		display:none;
	}
</style>