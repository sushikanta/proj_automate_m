<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notify - Under Constraction and Coming Soon Template</title>
    <meta charset="utf-8">
    <meta name="author" content="pixelhint.com">
    <meta name="description" content="Notify Under Constraction and Coming Soon Template"/>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/notify/css/reset.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/notify/css/main.css') ?>">

    <script type="text/javascript" src="<?php echo base_url('assets/notify/js/jquery.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/notify/js/TimeCircles.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/notify/js/backstretch.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/notify/js/main.js') ?>"></script>


</head>
<body>

<section class="content wrapper">
    <div class="default-view" >
        <h2 style="line-height: 38px; font-size: 29px;">
            <?php
            $count_days = @$days_left && $days_left > 0 ? $days_left : 0;
            $expired = true;
            if ($count_days < 0 || $seconds_left < 0) {
                $msg = 'This product has been expired. <br>Please purchase the full version of this product to continue.';
            } else {
                $expired = false;
                $no_days = $count_days > 1 ? $count_days . ' days' : $count_days . ' day';
                $msg = 'The trial period for this product will expire in ' . $no_days;
            }
            echo $msg;
            ?>
        </h2>
        <p class="description"><a class="lnk-1 lnk-show-activation" href="javascript:void(0)"">Product key Activation</a></p>
        <?php if (!$expired): ?>
            <p class="description"><a class="lnk-1" href="../../search_ui_admin.php">Click here</a> to continue.</p>
        <?php endif; ?>
    </div>
    <div class="activation-view" style="display: none">
        <p class="description">System key</p>
        <input type="text" style="width: 200px;text-align: center;padding: 7px;" readonly value="<?php echo @$system_key; ?>">
        <br>
        <p class="description">Product key</p>
        <input type="text" class="key-field" style="width: 464px;text-align: center;padding: 7px;">
        <br>
        <span class="error-lbl" style="position: relative; top:10px; color: white"></span>
        <p class="description">

            <a class="lnk-1 lnk-show-default" href="javascript:void(0)"">Cancel</a><a class="lnk-1 lnk-activate"
                                                                                      style="margin-left: 20px"
                                                                                      href="javascript:void(0)"">Activate</a>
        </p>

    </div>


    <!--<div class="subscription_form clearfix">
        <div>
            <form action="#" method="post">
                <input type="email" id="mc-email" placeholder="enter your email">
                <button type="submit"><i class="icon"></i></button>
            </form>
        </div>
    </div>
-->
    <div class="counter clear" data-timer="<?php echo @$seconds_left; ?>"></div>

</section>

<div class="bg_gradient"></div>
<div class="gradient_back_img"></div>

<script type="text/javascript">
    $(function () {
        $(".lnk-show-default").on('click', function () {
            $(".key-field").val('');
            $(".error-lbl").html('');
            $(".activation-view").fadeOut('normal', function () {
                $('.default-view').fadeIn();
            })
        })

        $(".lnk-show-activation").on('click', function () {

            $(".default-view").fadeOut('normal', function () {
                $('.activation-view').fadeIn();
            })
        })
        //---------
        $(".lnk-activate").click(function () {
            $key_val = $(".key-field").val();
           $.post(
                "<?php echo base_url().'index.php/notify/activate'; ?>",
                {key: $key_val},
                function (data) {
                    $(".key-field").val('');
                    if(data.success){
                        $(".error-lbl").html(data.message);
                        window.location.assign("<?php echo base_url().'index.php/notify/'; ?>");
                    }else if(data.already_exists){
                        $(".error-lbl").html(data.message);
                    }
                    else{
                        $(".error-lbl").html("Invalid activation key.")
                    }
                }
            );
        });


    });
</script>
</body>
</html>