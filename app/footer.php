<?php
$expired = true;
$product_owner = '';

if(isset($_SESSION['app_settings'])){
    $settings = $_SESSION['app_settings'];

    $result = evaluateKeys($settings);

    if(@$result['activated_days'] && $result['activated_date']){
        $trial_days = $result['activated_days'];
        $installed_date = $result['activated_date'];
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