<script src="js/complete.js"></script>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-hover-dropdown.min.js"></script>
<script src="js/jquery.dataTables.min-1.9.0.js"  type="text/javascript"></script>
<script src="js/jquery.dataTables.editable-2.3.3.js" type="text/javascript"></script>
<!--<script src="js/dataTables.tableTools.js" type="text/javascript"></script>-->
<script src="js/jquery.jeditable.js"></script>
<script src="js/jquery-ui-1.10.3.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="jAlert/jquery.alerts.js"></script>
<script src="js/dataTables.bootstrap-5.js"></script> 
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
});
</script>

