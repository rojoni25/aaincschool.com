<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
    /*-------------------------------------------------------*/
    /* EMAIL TEMPLATE 
    /*-------------------------------------------------------*/

  </style>
</head>

<body>
    <div >
        <strong style="color: rgb(34, 34, 34); font-family: Arial; font-size: small;"><span style="color: rgb(0, 128, 0);"><?=$q['heading']?></span></strong>
        <div style="color: rgb(32, 32, 32); font-family: Tahoma, Arial, Verdana;"><?=$q['msg']?></div>

        <?
        if($q['link']!=''){
        ?>
        <div style="color: rgb(32, 32, 32); font-family: Tahoma, Arial, Verdana;"><a href="<?=$q['link']?>" style="color: rgb(17, 85, 204);" target="_blank">Click here to Join Now</a><br />
        <br />
        &nbsp;</div>
        <?
        }
        ?>
            <div style="color: rgb(34, 34, 34); font-family: Arial; font-size: small;">
            <div dejavu="" font-size:="" segoe="" style="font-family: " trebuchet=""><strong><span style="color: rgb(0, 128, 0);">Company Support</span></strong></div>

            <div dejavu="" font-size:="" segoe="" style="font-family: " trebuchet="">&nbsp;</div>

            <div dejavu="" font-size:="" segoe="" style="font-family: " trebuchet="">Company Support chat in your back office. If you have any questions.</div>
            </div>
            <br><br>
            <div dejavu="" font-size:="" segoe="" style="font-family: " trebuchet=""><strong><span style="color: rgb(0, 128, 0);">Payment accepted via Cash App</span></strong></div>
            <div dejavu="" font-size:="" segoe="" style="font-family: " trebuchet="">&nbsp;</div>
            <div dejavu="" font-size:="" segoe="" style="font-family: " trebuchet=""><a href="https://cash.app/app/bsqgrxg" style="color: rgb(17, 85, 204);" target="_blank">Open Cash App</a></div>

            <div style="color: rgb(34, 34, 34); font-family: Arial; font-size: small;">
            <div>&nbsp;</div>

            <div>God bless!</div>
            </div>

            <div style="color: rgb(34, 34, 34); font-family: Arial; font-size: small;"><strong><?=getconfigMeta('comanyname')?></strong>
            </div>

    </div>
</body>
</html>