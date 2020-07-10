<section class="com-padd">
    <div class="container">
        <div class="rows">
            <div class="com-title log-in-pop-right" style="float: none;width: 100%;">
              <form action="<?=base_url()?>index.php/email_verification_from/from_submit" method="post" class="registerForm">
                <fieldset style="border:solid #333 1px;padding:15px;width:500px;margin:auto;">
                  <p style="color:#F00;font-size:14px;">Your Email is Not verified Please Enter Correct Email and click For Verification.</p>
                  <legend style="margin-left:30px;">Email Verification</legend>
                  <div>
                    <div class="input-field s12">
                      <input type="text" data-ng-model="emailid" class="validate" name="emailid" required autocomplete="new-password" value="<?=$result[0]['emailid']?>">
                      <label>Your Email Id</label>
                    </div>
                  </div>
                  <div>
                    <div class="input-field s4">
                      <input type="submit" value="Send Verification" class="waves-effect waves-light log-in-btn" name="Send"> </div>
                  </div>
                  <br>
                  <label class="blocklabel">Your Sponser: <?=$result[0]['sponser']?></label>
                  <br>
                  <label class="blocklabel">Name: <?=$result[0]['fname']?> <?=$result[0]['lname']?></label><br>
                  <label class="blocklabel">Email: <?=$result[0]['emailid']?></label>
                  <?php if($error!=''){?>
                  <div class="success">
                    <div class="message-box-wrap"> <strong>
                      <?=$error?>
                    </div>
                  </div>
                  <?php } ?>       
                </fieldset>
              </form>
            </div>
        </div>
    </div>
</section>
<style>
  .comment_submit{
    margin:20px 0px;
  }
  legend{
    font-size:20px;
    padding:0px 4px;
  }
</style>
