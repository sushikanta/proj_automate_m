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
		<h2 style="line-height: 38px; font-size: 29px;">
		 <?php
			$count_days = @$days_left && $days_left > 0?$days_left:0;
		 $expired = true;
			if($count_days < 0 || $seconds_left < 0){
				$msg = 'This product has been expired. <br>Please purchase the full version of this product to continue.';
			}else{
				$expired = false;
				$no_days = $count_days > 1?$count_days.' days': $count_days.' day';
				$msg = 'The trial period for this product will expire in '.$no_days;
			}
			echo $msg;
			?>
			</h2>
		<?php if(!$expired):?>
			<p class="description"><a class="lnk-1" href="../../search_ui_admin.php">Click Here</a> to continue.</p>
		<?php endif;?>


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
	
</body>
</html>