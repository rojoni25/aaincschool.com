<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<link href="<?=base_url();?>asset/css/select2.min.css" rel="stylesheet">



<script>
    // $(function () {
    //             var validator = $(".paymentFrm").validate({
    //                 meta: "validate"
    //             });
    //             $(".btnsubmit").click(function () {
    //                  var validator = $(".paymentFrm").validate({
    //                     meta: "validate"
    //                 });
    //             });
    //             $(".cancel").click(function () {
    //                 validator.resetForm();
    //             });
    //         });
</script>

<div class="row">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Finance</a> </li>
    <li class="active-bre"><a href="#"> Facebook Stripe Payment</a> </li>
  </ul>
</div> 
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Facebook Stripe Payment</h4>
    <br> 
    <div class="hom-cre-acc-left hom-cre-acc-right">
        <?php if($this->session->flashdata('show_msg')!=''){?>
        <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
        </div>
        <?php } ?>

        <div class="col-md-12 thumbnails-videos">
          <table>
            <tr>
                    <?php
              $video_link = explode('||',$cms[0]['video_url']);
              for($i=0;$i<count($video_link);$i++){
                if($video_link[$i]!=''){
                  $spep=$i+1;
                  $cls=("margin_none");
                  echo '<td>';
                  echo '<div class="step_div'.$cls.'"><h2>Step '.$spep.'</h2>';
                  echo '<div class="video_frm">';
                  echo '<div class="inner_frm">';
                  if (strpos($video_link[$i], 'youtube') !== false)
                  {
                      echo '<iframe width="100%" height="100%" src="'.$video_link[$i].'" frameborder="0" allowfullscreen></iframe>';
                  }
                  else{
                      echo '<video width="100%" height="100%" controls="controls"><source src="'.$video_link[$i].'" type="video/mp4"></video>';
                  }
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                 echo '</td>';
                }
              } 
              
              
                  ?>
                  </tr>
                 </table>
                 </div>
                 
                 <p style="text-align: center;"><?php echo $cms[0]['textdt']; ?></p>
                 <!-- VIDEO DISPLAY -->
          
            <input type="hidden" name="status" id="status">
            <input type="hidden" name="stripe_id" id="stripe_id">
            <h3>Facebook Payment Method : </h3>
            <div class="">
              <div class="col-md-12">
                <span class="payment-errors"></span>
                
                <form class="form-horizontal left-align" id="paymentFrm" action="<?php echo base_url();?>index.php/facebook_stripe_payment_100/insertrecord" method="post">

                    <div class="control-group">
                        <label class="control-label">Select Amount</label>
                        <div class="controls">
                            <select class="js-example-basic-multiple select2 col-md-6" name="amount[]" multiple="multiple">
                              <option value="100">100$</option>
                              <option value="200">200$</option>
                              <option value="300">300$</option>
                              <option value="400">400$</option>
                              <option value="500">500$</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Card Holder Name</label>
                        <div class="controls">
                          <input type="text" class="col-md-6" name="name" id="name" class="name"  />
                        </div>
                    </div>


                  <div class="control-group">
                    <label class="control-label">Address</label>
                    <div class="controls">
                      <input type="text" class="col-md-6" name="address" id="address" class="address"  />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Country</label>
                    <div class="controls">
                      <input type="text" class="col-md-6" name="country" id="country" class="country" />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Card Number</label>
                    <div class="controls">
                        <input type="text" name="card_num" id="card_num" size="20" autocomplete="off" class="card-number col-md-6" />
                    </div>
                  </div>
           
                
                <div class="control-group">
                    <label class="control-label">CVC</label>
                    <div class="controls">
                        <input type="text" placeholder="CVC" name="card_cvc" id="card_cvc" size="4" autocomplete="off" class="card-cvc col-md-6" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Expiration (MM/YYYY)</label>
                    <div class="controls">
                        <input type="text" name="card_exp_month" id="exp_month" placeholder="MM" maxlength="2" class="card-expiry-month col-md-6"/>

                        <input type="text" name="card_exp_year" id="exp_year" maxlength="4" placeholder="YYYY" class="card-expiry-year col-md-6"/>

                    </div>
                </div>
            
           
                <div class="form-actions">
                    <button type="button" id="payBtn" onclick="createTokenCall();" class="btn btn-primary btnsubmit">Purchase</button>
                        &nbsp;&nbsp;
                    <a href="<?php echo base_url(); ?>index.php/upgrade_membership/view"><button type="button" class="btn">Cancel</button></a>
                </div>
                
                </form>
              
              </div>
            </div>

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
    </div>
</div>

<style>
    .msg{
        color:#F00;
        text-align:center;
    }
    .msg_show{
        font-weight:bold;
        color:#C00;
    }
</style>

<script type="text/javascript">
//set your publishable key
//Stripe.setPublishableKey('pk_test_fhbK2k20wgJm2xeL25eiRT5v');
 Stripe.setPublishableKey("<?php echo $this->config->item('publishable_key'); ?>"); 


//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {

        console.log("Error");
        console.log(response.error);

        //enable the submit button
        $('#payBtn').removeAttr("disabled");
        //display the errors on the form
        $(".payment-errors").html(response.error.message);
    } else {

        console.log("Success");
        var form$ = $("#paymentFrm");

         
        //get token id
        var token = response['id'];
            console.log(token);
            alert(token);
      
        //insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        //submit form to the server
        form$.get(0).submit();
    }
}
$(document).ready(function() {
    //on form submit
    $(".paymentFrm").submit(function(event) {
        //disable the submit button to prevent repeated clicks
        $('.payBtn').attr("disabled", "disabled");

        if($('#name').val()==''){
                alert("Enter Card Holder Name");
                $('#name').focus();
                return false;
            }


        if($('#address').val()==''){
                alert("Enter Your Address");
                $('#address').focus();
                return false;
            }

        if($('#country').val()==''){
                alert("enter your Country");
                $('#country').focus();
                return false;
            }


         if($('#card_num').val()==''){
                alert("enter your card number");
                $('#card_num').focus();
                return false;
            }

            if($('#card_cvc').val()==''){
                alert("enter your cvc number");
                $('#card_cvc').focus();
                return false;
            }

            if($('#exp_month').val()==''){
                alert("enter Month ");
                $('#exp_month').focus();
                return false;
            }

            if($('#exp_month').val().length!==2) 
            {
                alert("Enter valid Month MM");
                $('#exp_month').focus();
                return false;
            }

            if($('#exp_year').val()==''){
                alert("enter Year ");
                $('#exp_year').focus();
                return false;
            }

            if($('#exp_year').val().length!==4) 
            {
                alert("Enter valid Year YYYY");
                $('#exp_year').focus();
                return false;
            }

        //create single-use token to charge the user
        Stripe.createToken({
            // name: $('.name').val(),
            // address: $('.address').val(),
            // country: $('.country').val(),
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        
        //submit from callback
        return false;
    });
});

function createTokenCall()
{
    $('.payBtn').attr("disabled", "disabled");

        if($('#name').val()==''){
                alert("Enter Card Holder Name");
                $('#name').focus();
                return false;
            }


        if($('#address').val()==''){
                alert("Enter Your Address");
                $('#address').focus();
                return false;
            }

        if($('#country').val()==''){
                alert("enter your Country");
                $('#country').focus();
                return false;
            }


         if($('#card_num').val()==''){
                alert("enter your card number");
                $('#card_num').focus();
                return false;
            }

            if($('#card_cvc').val()==''){
                alert("enter your cvc number");
                $('#card_cvc').focus();
                return false;
            }

            if($('#exp_month').val()==''){
                alert("enter Month ");
                $('#exp_month').focus();
                return false;
            }

            if($('#exp_month').val().length!==2) 
            {
                alert("Enter valid Month MM");
                $('#exp_month').focus();
                return false;
            }

            if($('#exp_year').val()==''){
                alert("enter Year ");
                $('#exp_year').focus();
                return false;
            }

            if($('#exp_year').val().length!==4) 
            {
                alert("Enter valid Year YYYY");
                $('#exp_year').focus();
                return false;
            }

        //create single-use token to charge the user
        Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);

}
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>

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
  .step_div{
     width: 467px;
    display: inline-block;
  }
  .step_div h2{
    font-size:16px;
    text-align:center;
    margin:9px;
    padding:0px;
    margin-top:10px;
    line-height:25px;
  }
  .span12.thumbnails-videos {
    
    width: 900px;
    overflow-x: auto;
    white-space: nowrap;
    margin-bottom: 10px;
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
    
    @media  only screen and (max-width: 500px){
.video_frm {
    width: 330px;
    height: 233px;
 
}
.inner_frm {
    height: 205px;
    width: 273px;
    margin-top: 14px;
    margin-left: 28px;
}
}
@media  only screen and (max-width: 360px){
.video_frm {
    width: 225px;
    height: 159px;
 
}
.inner_frm {
    height: 139px;
    width: 186px;
    margin-top: 10px;
    margin-left: 19px;
}
}

.payment_btn{
    padding:23px;
    background-color:#999;
}
.txtbox{
    width:90%;
}

.txtarea{
    width:90%;
    resize:none;
    height:180px;
}

</style>
<script src="<?=base_url();?>asset/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(".select2").select2();

</script>