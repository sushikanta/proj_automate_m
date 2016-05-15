<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Automate-M</title>
<style type="text/css">
	img.ri
	{
		position: absolute;
		max-width: 80%;
		top: 10%;
		left: 10%;
		border-radius: 3px;
		box-shadow: 0 3px 6px rgba(0,0,0,0.9);
	}

	img.ri:empty
	{
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
		-moz-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		-o-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	@media screen and (orientation: portrait) {
		img.ri { max-width: 90%; }
	}

	@media screen and (orientation: landscape) {
		img.ri { max-height: 90%; }
	}
</style>
	<script src="js/jquery-1.10.2.min.js"></script>


</head>
<body>
<div id="page" style="display: none">

		<img src="images/logos/splash-screen.jpg" class="ri" />

</div>
<script type="text/javascript">
	$(function(){
		$('#page').fadeIn(2000, function(){
			console.log('completed');
			$("#page").delay(4000).fadeOut("slow", function(){
				window.location = "index.php";
			});
		});
	});

</script>
</body>
</html>
