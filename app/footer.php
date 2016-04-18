<?php
$expired = true;
$product_owner = '';
if(isset($_SESSION['app_settings'])){
    $settings = $_SESSION['app_settings'];
    if(@$settings['installation_type']['setting'] && $settings['installation_type']['setting']!= 'enterprise'){
        $trial_days = $settings['trial_days']['setting'];
        $installed_date = $settings['installed_on']['ts'];
        $params = getTrialParams($trial_days, $installed_date);
        $seconds_left = @$params['seconds_left']?$params['seconds_left']:0;
         $days_left = @$params['days_left']?$params['days_left']:0;
             $count_days = @$days_left && $days_left > 0?$days_left:0;
		    $expired = true;
			if($count_days < 0 || $seconds_left < 0){
                $msg = 'This product has been expired. <br>Please purchase the full version of this product to continue.';
            }else{
                $expired = false;
                $no_days = $count_days > 1?$count_days.' days': $count_days.' day';
                $product_info_msg = '<a class="lnk-1" href="framework/index.php/notify">This product will expire in '.$no_days.'.</a>';
            }
    }else if(@$settings['installation_type']['setting']!= 'enterprise'){
        $expired = false;
        if(@$settings['business_title']['setting']){
            $product_info_msg = 'This product is licenced to '.$settings['business_title']['setting'];
        }

    }


    if (@$settings['business_title']['setting']) {
        $product_owner = @$settings['business_title']['setting'];
    }

}

?>
<footer class="footer navbar-fixed-bottom no-print">
<div class="container">
<p class="pull-left footertxt">&copy; 2016-2017 <?php echo @$app_title; ?>  <span style="padding-left: 30px"><?php echo @$product_info_msg ?></span></p>
<?php if($product_owner): ?>
<p class="pull-right footertxt">This product is registered to <?php echo $product_owner; ?></p>
    <?php endif; ?>
</div>

</footer>
<?php if($expired && @$con): ?>
<script type="text/javascript">window.location = "framework/index.php/notify";</script>
<?php endif; ?>