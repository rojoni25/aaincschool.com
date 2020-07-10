<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
    /*-------------------------------------------------------*/
    /* EMAIL TEMPLATE 
    /*-------------------------------------------------------*/
     .email-tem{
         background: #efefef;
         position: relative;
         overflow: hidden;
    }
     .email-tem-inn{
         width: 50%;
         margin: 0 auto;
         padding: 50px;
         background: #ffffff;
        /* margin-top: 50px;
         */
        /* margin-bottom: 50px;
         */
    }
     .email-tem-main{
        background: #fdfdfd;
        box-shadow: 0px 10px 24px -10px rgba(0, 0, 0, 0.8);
        margin-bottom: 50px;
        border-radius: 10px;
    }
     .email-tem-head{
         width: 100%;
         background: #006df0 url('<?=base_url();?>asset/images/mail/bg.png') repeat;
         padding: 50px;
         box-sizing: border-box;
         border-radius: 5px 5px 0px 0px;
    }
     .email-tem-head h2{
         color: #fff;
         font-size: 32px;
         text-transform: capitalize;
    }
     .email-tem-head h2 img{
         float: left;
         padding-right: 25px;
         width: 100px;
    }
     .email-tem-body{
         padding: 50px;
    }
     .email-tem-body h3{
         margin-bottom: 25px;
    }
     .email-tem-body p{
    }
     .email-tem-body a{
         /*background: #006df0;*/
         
         padding: 12px;
         border-radius: 2px;
         margin-top: 15px;
         position: relative;
         display: inline-block;
    }
     .email-tem-foot{
         text-align: center;
    }
     .email-tem-foot h4{
    }
     .email-tem-foot ul{
         position: relative;
         overflow: hidden;
         margin: 0 auto;
         display: table;
         margin-bottom: 18px;
         margin-top: 25px;
    }
     .email-tem-foot ul li{
         float: left;
         display: inline-block;
         padding: 0px 10px;
    }
     .email-tem-foot ul li a{
    }
     .email-tem-foot ul li a img{
    }
     .email-tem-foot p{
         margin-bottom: 0px;
         padding-top: 5px;
         font-size: 13px;
    }
     .email-point{
         position: relative;
         overflow: hidden;
         width: 100%;
         border-bottom: 1px solid #e6e6e6;
        /* margin-bottom: 25px;
         */
         padding-bottom: 15px;
         padding-top: 20px;
    }
     .email-point-left{
         float: left;
         width: 20%;
    }
     .email-point-left img{
         width: 100%;
         padding: 0px 20px 0px 0px;
    }
     .email-point-righ{
         float: left;
         width: 80%;
    }
     .email-point-righ h4{
         padding-bottom: 10px;
    }
     .email-point-righ p{
         font-size: 13px;
         margin-bottom: 15px;
    }
     .email-list{
    }
     .email-list ul{
         margin-bottom:0px;
    }
     .email-list ul li{
         display:block;
         font-size:14px;
    }
  </style>
</head>

<body>
 
  <section>
    <div class="email-tem">
      <div class="email-tem-inn">
        <div class="email-tem-main" style="box-shadow: 0px 10px 24px -10px rgba(0, 0, 0, 0.8);">
          <div class="email-tem-head">
            <h2><img src="<?=base_url();?>asset/images/mail/letter.png" alt=""> <?=getconfigMeta('comanyname')?> </h2>
          </div>
          <div class="email-tem-body">
            <h3><?=$q['heading']?></h3>
            <p><?=$q['msg']?></p>
            <table cellpadding="10" cellspacing="0" class="table">
                <tbody>
                <tr>
                    <td colspan="2">
                        <?=$q['contain']?>
                    </td>
                </tr>
                <tr>
                    <td>invite User emailId:</td>
                    <td>
                        <?=$q['user_invite_emailid']?>
                    </td>
                </tr>
                <tr>
                    <td>Url:</td>
                    <td>
                        <?=$q['user_send_url']?>
                    </td>
                </tr>
                <tr>
                    <td>Created Date:</td>
                    <td>
                         <?=$q['user_timedt']?>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="email-tem-foot">
          <h4>Stay in touch</h4>
          <ul>
            <li><a href="#"><img src="<?=base_url();?>asset/images/mail/s1.png" alt=""></a></li>
            <li><a href="#"><img src="<?=base_url();?>asset/images/mail/s2.png" alt=""></a></li>
            <li><a href="#"><img src="<?=base_url();?>asset/images/mail/s3.png" alt=""></a></li>
            <li><a href="#"><img src="<?=base_url();?>asset/images/mail/s4.png" alt=""></a></li>
            <li><a href="#"><img src="<?=base_url();?>asset/images/mail/s5.png" alt=""></a></li>
          </ul>
          <p>Email send by <?=getconfigMeta('comanyname')?></p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>