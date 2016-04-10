<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div>
Counter : &nbsp;</div>
<div id="counterHour" style="float: left;">
0</div>
<div style="float: left;">
&nbsp; Hours &nbsp;</div>
<div id="counterMin" style="float: left;">
0</div>
<div style="float: left;">
&nbsp; minutes &nbsp;</div>
<div id="counterSec" style="float: left;">
0</div>
<div style="float: left;">
&nbsp; seconds &nbsp;</div>
<input type="button" id="timer" class="start" value="Start Timer" onClick="check_timer()">

<script type="text/javascript">


	
function check_timer(){
 if($('#timer').hasClass('start')){
  $('#counterSec').fadeOut(500).html(0).fadeIn(500);
  $('#counterMin').fadeOut(500).html(0).fadeIn(500);
  $('#counterHour').fadeOut(500).html(0).fadeIn(500);
  $('#timer').val("Stop Timer");
  timer = setInterval ( "increaseCounter()", 1000 );
  $('#timer').removeClass('start')
 }
 else{
  if(typeof timer != "undefined"){
   clearInterval(timer);  
  }
  $('#timer').val("Start Timer");
  $('#timer').addClass('start')
 }
}
 
function increaseCounter(){
 
 var secVal ;
 var minVal ;
 secVal = parseInt($('#counterSec').html(),10) 
 minVal = parseInt($('#counterMin').html(),10)
 if(secVal != 59)
 $('#counterSec').html((secVal+1));
 else{
  if(minVal != 59){
   $('#counterMin').html((minVal+1)); 
  }
  else{
   $('#counterHour').html((parseInt($('#counterHour').html(),10)+1));
   $('#counterMin').html(0);
  }
  $('#counterSec').html(0);
 }
} 
	
    
</script>
</body>
</html>