<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-hover-dropdown.min.js"></script>
<script src="js/jquery-ui-1.10.3.js"></script>
<script src="js/moment-with-langs.min.js"></script>

<script type="text/javascript">
var datetime = null,
	formaltime = null,
    date = null;

var update = function () {
    date = moment(new Date())
    datetime.html(date.format('dddd, MMMM Do YYYY, h:mm:ss a'));
	formaltime.html(date.format('DD/MM/YYYY, h:mm:ss a'));
};
$(document).ready(function(){
    datetime = $('#show_date')
	formaltime = $('#long_date_time')
    update();
    setInterval(update, 1000);
	
	$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'patient_receipt.php');
	   myWindow1.close();
	   myWindow4 = window.open('', 'member_old_search_result1.php');
	   myWindow4.close();
	   myWindow6 = window.open('', 'collect_amount_search.php');
	   myWindow6.close();
    });
	
});
</script>